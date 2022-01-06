<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\MyValidator;
use App\Models\Posts;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public $admin;
    public $posts;
    public $reviews;
    public $validateModel;

    public function __construct()
    {
        $this->admin = new Admin();
        $this->posts = new Posts();
        $this->reviews = new Reviews();
        $this->validateModel = new MyValidator();
    }

    public function index(Request $request)
    {

        if ($request->has('table')) {
           return $this->admin->tableNavigate($request->get('table'));
        }
        return view('admin.index');
    }

    public function delete(Request $request)
    {
        if (session()->get('table') === 'posts'){
          return $this->admin->destroyPost($request->post('id'));
        }elseif (session()->get('table') === 'reviews') {
            return $this->admin->destroyReview($request->post('id'));
        }
    }

    public function publish(Request $request)
    {

        if (session()->get('table') === 'posts'){
            return $this->admin->updatePost($request->post('id'), ['status' => '1']);
        }elseif (session()->get('table') === 'reviews') {
            return $this->admin->updateReview($request->post('id'), ['status' => '1']);
        }
    }

    public function createPost(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
        ];
        if ($this->validateModel->validate($request->post(), $rules) === true) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $date = date('Y:m:d');
            Storage::disk('public')->put('myImage', $image);
                if ($this->admin->createPost([  'title' => $request->post('title'),
                                                'content' => $request->post('content'),
                                                'image' => $imageName,
                                                'date_create' => $date])) {
                    return redirect('/admin');
                }else{
                    session()->put('error_create_post', 'Error creating post, please, try again!');
                    return view('ajaxHelper.createPost')->render();
                }
        }else{
            session()->put('error_create_post', $this->validateModel->validate($request->post(), $rules));
            return view('ajaxHelper.createPost')->render();

        }

    }

    public function save(Request $request)
    {
        $this->reviews->updateById($request->post('id'), ['content' => $request->post('content')]);
        return $this->admin->tableNavigate('reviews');
    }
}
