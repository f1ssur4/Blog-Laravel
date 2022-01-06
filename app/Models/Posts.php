<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'image', 'date_create'];


    public function getAll($filter)
    {
        switch ($filter){
            case '':
                $posts = Posts::where('status', '1')->simplePaginate(5);
                return view('home.index', ['posts' => $posts]);

            case '1':
                if (session()->get('filter') === 'title'){
                    $sorted_posts = Posts::where('status', '1')->orderby(session()->get('filter'), 'asc')->simplePaginate(5);
                    return view('ajaxHelper.filtered', ['posts' => $sorted_posts]);
                }elseif(session()->get('filter') === 'count_views'){
                    $sorted_posts = Posts::where('status', '1')->orderby(session()->get('filter'), 'desc')->simplePaginate(5);
                    return view('ajaxHelper.filtered', ['posts' => $sorted_posts]);
                }else{
                    $sorted_posts = Posts::where('status', '1')->orderby(session()->get('filter'), 'asc')->simplePaginate(5);
                    return view('ajaxHelper.filtered', ['posts' => $sorted_posts]);
                }

        }
    }

    public function getAllPaginate($filter)
    {
                if (session()->get('filter') === 'title'){
                    $sorted_posts = Posts::where('status', '1')->orderby(session()->get('filter'), 'asc')->simplePaginate(5);
                    return view('home.index', ['posts' => $sorted_posts]);
                }elseif(session()->get('filter') === 'count_views'){
                    $sorted_posts = Posts::where('status', '1')->orderby(session()->get('filter'), 'desc')->simplePaginate(5);
                    return view('home.index', ['posts' => $sorted_posts]);
                }else{
                    $sorted_posts = Posts::where('status', '1')->orderby(session()->get('filter'), 'asc')->simplePaginate(5);
                    return view('home.index', ['posts' => $sorted_posts]);
                }

    }

    public function getOne($id)
    {
        $post = Posts::where('id', $id)->first();
        $post->increment('count_views');
        return view('home.post', ['post' => $post]);
    }

    public function destroyById($id)
    {
        $id = intval($id);
        Posts::destroy($id);
    }

    public function updateById($id, $arrData)
    {
        Posts::where('id', $id)->update($arrData);
    }

}
