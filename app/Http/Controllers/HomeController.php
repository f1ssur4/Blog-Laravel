<?php

namespace App\Http\Controllers;

use App\Models\MyValidator;
use App\Models\Posts;
use App\Models\Reviews;
use App\Models\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $posts;
    public $reviews;
    public $validateModel;
    public $users;

    public function __construct()
    {
        $this->posts = new Posts();
        $this->reviews = new Reviews();
        $this->users = new Users();
        $this->validateModel = new MyValidator();
    }

    public function index(Request $request)
    {

        if ($request->has('filter')) {
            session()->put('filter', $request->post('filter'));
                return $this->posts->getAll(session()->has('filter'));
        }

        if (session()->has('filter')){
            return $this->posts->getAllPaginate(session()->has('filter'));
        }
        return $this->posts->getAll('');
    }


    public function post($id)
    {
        return $this->posts->getOne($id);
    }


    public function reviews(Request $request)
    {
        return $this->reviews->getAll();
    }
    public function reviewCreate(Request $request)
    {
         $rules = [
             'username' => ['required','max:255','alpha_num'],
             'email' => ['required','email'],
             'content' => ['required'],
         ];
        if ($this->validateModel->validate($request->post(), $rules) === true) {
            return $this->reviews->createReview($request->post());
        }else{
            session()->put('error_create_user', $this->validateModel->validate($request->post(), $rules));
            return view('ajaxHelper.signup')->render();
        }
    }


    public function loginForm()
    {
        return view('home.login');
    }

    public function signing(Request $request)
    {
        $rules = [
            'username' => 'required|max:255',
            'password' => 'required',
        ];

        if ($this->validateModel->validate($request->post(), $rules) === true) {
            return $this->users->signin($request->post());
        }else {
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
        $rules = [
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password_hash' => 'required',
        ];

        if ($this->validateModel->validate($request->post(), $rules) === true) {
            return $this->users->signup($request->post());
        }else {
            session()->put('error_create_user', $this->validateModel->validate($request->post(), $rules));
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
