<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Reviews;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use function Symfony\Component\String\s;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('filter')) {
            session()->put('filter', $request->post('filter'));
            if (session()->get('filter') === 'default'){
                $posts = Posts::where('status', '1')->simplePaginate(5);
                return view('ajaxHelper.filtered', ['posts' => $posts]);
            }

            $sorted_posts = Posts::where('status', '1')->orderby($request->post('filter'), 'desc')->simplePaginate(5);
            return view('ajaxHelper.filtered', ['posts' => $sorted_posts]);
        }

        if (session()->has('filter')){

            if (session()->get('filter') === 'default'){
                $posts = Posts::where('status', '1')->simplePaginate(5);
                return view('home.index', ['posts' => $posts]);
            }

            $sorted_posts = Posts::where('status', '1')->orderby(session()->get('filter'), 'desc')->simplePaginate(5);
            return view('home.index', ['posts' => $sorted_posts]);
        }

            $posts = Posts::where('status', '1')->simplePaginate(5);
            return view('home.index', ['posts' => $posts]);
    }


    public function post($id)
    {
        $post = Posts::where('id', $id)->first();
        $post->increment('count_views');
        return view('home.post', ['post' => $post]);
    }


    public function reviews(Request $request)
    {
            $reviews = Reviews::where('status', '1')->orderby('date_create', 'desc')->simplePaginate(5);
            return view('home.reviews', ['reviews' => $reviews]);
    }
    public function reviewCreate(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'username' => ['required','max:255','alpha_num'],
            'email' => ['required','email'],
            'content' => ['required'],
        ]);
         htmlspecialchars($request->post('content'));

        if ($validated->passes()) {
            Reviews::create(['username' => $request->post('username'),
                'email' => $request->post('email'),
                'content' => $request->post('content'),
                'date_create' => date('Y:m:d'),
            ]);
            session()->put('success_review', 'Review has been successfully submitted for review');
            return view('ajaxHelper.createReview');
        }else{
            $errors = $validated->errors()->toArray();
            foreach ($errors as $error_key => $error_val) {
                $errors_arr[$error_key] = $error_val;
            }
            session()->put('error_create_user', $errors_arr);
            return view('ajaxHelper.signup')->render();
        }
    }


    public function loginForm()
    {
        return view('home.login');
    }

    public function signing(Request $request)
    {
        $validated = Validator::make($request->post(), [
            'username' => 'required|max:255',
            'password' => 'required',
        ]);

        if ($validated->passes() && Users::where('username', $request->post('username'))->first()->username){
            if (Hash::check($request->post('password'), Users::where('username', $request->post('username'))->first()->password_hash)){
                session()->put('success_signin', 'You are successfully logged in');
                session()->put('auth', 1);
                session()->put('username', Users::where('username', $request->post('username'))->first()->username);
                return redirect('/');
            }else {
                session()->put('error_sign', 'Username or password entered incorrectly. Perhaps you haven\'t registered yet?');
                return view('home.login');
            }
        }else{
            session()->put('error_sign', 'Username or password entered incorrectly. Perhaps you haven\'t registered yet?');
            return view('home.login');
        }
    }


    public function signupCreateForm()
    {
        return view('home.signup');
    }

    public function createUser(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password_hash' => 'required',
        ]);

        if ($validated->passes()) {
            try {
               $user_data = $request->all();
               $user_data['password_hash'] = Hash::make($user_data['password_hash']);
                Users::create($user_data);
            }catch (\Exception $e){
                $e->getMessage();
                session()->put('error_add_user', 'This username or email already exists');
                return view('ajaxHelper.signup')->render();
            }
                session()->put('auth', 1);
                $username = Users::where('username', $user_data['username'])->first();
                session()->put('username', $username->username);
                session()->put('success_create_user', 'You have successfully registered!');
                return view('ajaxHelper.signup')->render();

        }else {
            $errors = $validated->errors()->toArray();
            foreach ($errors as $error_key => $error_val) {
            $errors_arr[$error_key] = $error_val;
            }
            session()->put('error_create_user', $errors_arr);
            return view('ajaxHelper.signup')->render();
        }
    }

    public function exit(Request $request)
    {
        session()->forget('auth');
        session()->forget('username');
        return $this->index($request);
    }


}
