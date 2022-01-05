<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Reviews;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('table')) {
            switch ($request->post('table')) {
                case 'users':
                    session()->put('table', 'users');
                    return view('admin.table.users');
                case 'posts':
                    session()->put('table', 'posts');
                    $posts_1 = Posts::where('status', '1')->orderby('date_create', 'desc')->get();
                    $posts_0 = Posts::where('status', '0')->orderby('date_create', 'desc')->get();
                    return view('admin.table.posts', ['posts_1' => $posts_1, 'posts_0' => $posts_0]);
                case 'reviews':
                    session()->put('table', 'reviews');
                    $reviews_1 = Reviews::where('status', '1')->orderby('date_create', 'desc')->get();
                    $reviews_0 = Reviews::where('status', '0')->orderby('date_create', 'desc')->get();
                    return view('admin.table.reviews', ['reviews_1' => $reviews_1, 'reviews_0' => $reviews_0]);
            }
        }
        return view('admin.index');
    }

    public function delete(Request $request)
    {
        switch (session()->get('table')){
            case 'users':
                //
            case 'posts':
                $id = intval($request->post('id'));
                Posts::destroy($id);
                $posts_1 = Posts::where('status', '1')->orderby('date_create', 'desc')->get();
                $posts_0 = Posts::where('status', '0')->orderby('date_create', 'desc')->get();
                return view('admin.table.posts', ['posts_1' => $posts_1, 'posts_0' => $posts_0]);
            case 'reviews':
                $id = intval($request->post('id'));
                Reviews::destroy($id);
                $reviews_1 = Reviews::where('status', '1')->orderby('date_create', 'desc')->get();
                $reviews_0 = Reviews::where('status', '0')->orderby('date_create', 'desc')->get();
                return view('admin.table.reviews', ['reviews_1' => $reviews_1, 'reviews_0' => $reviews_0]);

        }

    }

    public function publish(Request $request)
    {

        switch (session()->get('table')){
            case 'users':
                //
            case 'posts':
                Posts::where('id', $request->post('id'))->update(['status' => 1]);
                $posts_1 = Posts::where('status', '1')->orderby('date_create', 'desc')->get();
                $posts_0 = Posts::where('status', '0')->orderby('date_create', 'desc')->get();
                return view('admin.table.posts', ['posts_1' => $posts_1, 'posts_0' => $posts_0]);
            case 'reviews':
                Reviews::where('id', $request->post('id'))->update(['status' => 1]);
                $reviews_1 = Reviews::where('status', '1')->orderby('date_create', 'desc')->get();
                $reviews_0 = Reviews::where('status', '0')->orderby('date_create', 'desc')->get();
                return view('admin.table.reviews', ['reviews_1' => $reviews_1, 'reviews_0' => $reviews_0]);

        }
    }

    public function createPost(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        if ($validated->passes()) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $date = date('Y:m:d');
            if (Storage::disk('public')->put('myImage', $image)) {
                Posts::create(['title' => $request->post('title'),
                    'content' => $request->post('content'),
                    'image' => $imageName,
                    'date_create' => $date]);
                    return redirect('/admin');
            }
        }else{
            $errors = $validated->errors()->toArray();
            foreach ($errors as $error_key => $error_val) {
                $errors_arr[$error_key] = $error_val;
            }
            session()->put('error_create_post', $errors_arr);
            return view('ajaxHelper.createPost')->render();

        }

    }

    public function save(Request $request)
    {
        Reviews::where('id', $request->post('id'))->update(['content' => $request->post('content')]);
        $reviews_1 = Reviews::where('status', '1')->orderby('date_create', 'desc')->get();
        $reviews_0 = Reviews::where('status', '0')->orderby('date_create', 'desc')->get();
        return view('admin.table.reviews', ['reviews_1' => $reviews_1, 'reviews_0' => $reviews_0]);
    }
}
