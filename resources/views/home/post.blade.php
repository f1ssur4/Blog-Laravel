@extends('layouts.main')
@section('title', 'Home')
@section('content')

    <a href="/" class="submit_btn"><-back</a>
    <table>
        <tr>
            <td><h1> {{$post->title}} </h1></td>
            <td style="padding-left: 100px"> <img src=/storage/myImage/<?= $post->image?> class="card-img-top" style="width: 250px; height: 120px"></td>
        </tr>
    </table>
 <hr>
 <p>{{$post->content}} </p>

@endsection




