<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function tableNavigate($table)
    {
        switch ($table) {
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

    public function destroyPost($id)
    {
        $model = new Posts();
        $model->destroyById($id);
        return $this->tableNavigate('posts');

    }

    public function destroyReview($id)
    {
        $model = new Reviews();
        $model->destroyById($id);
        return $this->tableNavigate('reviews');
    }

    public function updatePost($id, $arrData)
    {
        $model = new Posts();
        $model->updateById($id, $arrData);
        return $this->tableNavigate('posts');

    }

    public function updateReview($id, $arrData)
    {
        $model = new Reviews();
        $model->updateById($id, $arrData);
        return $this->tableNavigate('reviews');

    }

    public function createPost($data)
    {
        try {
            Posts::create($data);
            return true;
        }catch(\Exception $exception){
            return false;
        }
    }
}
