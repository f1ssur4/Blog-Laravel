<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $fillable = ['username', 'email', 'content', 'date_create'];

    public function getAll()
    {
        $reviews = Reviews::where('status', '1')->orderby('date_create', 'desc')->simplePaginate(5);
        return view('home.reviews', ['reviews' => $reviews]);
    }

    public function createReview($request)
    {
        htmlspecialchars($request['content']);
        Reviews::create(['username' => $request['username'],
            'email' => $request['email'],
            'content' => $request['content'],
            'date_create' => date('Y:m:d'),
        ]);
        session()->put('success_review', 'Review has been successfully submitted for review');
        return view('ajaxHelper.createReview');
    }

    public function destroyById($id)
    {
        $id = intval($id);
        Reviews::destroy($id);
    }

    public function updateById($id, $arrData)
    {
        Reviews::where('id', $id)->update($arrData);
    }
}
