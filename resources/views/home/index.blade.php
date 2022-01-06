<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

@extends('layouts.main')
@section('title', 'Home')
@section('content')

    <div class="session_result">
        <?php if (session()->has('success_signin')): ?>
        <div class="alert alert-success" role="alert">
            <?php
            echo session()->get('success_signin');
            session()->forget('success_signin');
            ?>
        </div>
        <?php endif; ?>
    </div>

    <h3>Sort by</h3>
    <button class="button322" value="count_views" type="submit" onclick="function()">Views more to less</button>
    <button class="button323" value="date_create" type="submit" onclick="function()">New to Old</button>
    <button class="button324" value="title" type="submit" onclick="function()">Default</button>

    <div class="content">
    <?php foreach($posts as $post): ?>
        <?php $id = $post->id; ?>
    <div class="card" style="width: 18rem; margin-top: 30px; border: #781919; border-radius: 100px">
        <img src=/storage/myImage/<?php echo $post->image ?> class="card-img-top" style="width: 150px; height: 70px">
        <div class="card-body" style="width: 500px">
            <h3 class="card-title"><a href="/post/{{$id}}"><?php echo $post->title?></a></h3>
            <p class="card-text" style=" width: 300px; height: 100px; overflow: hidden; text-overflow: ellipsis;"><?php echo $post->content?><a href="/post/{{$id}}" class="mybutton" style="color: #058edc;">detailed...</a></p>
           <div><h6 class="counter">viewed: <?php echo $post->count_views?></h6></div></td>
           <div><h6 class="counter">publication date: <?php echo $post->date_create?></h6></div></td>

        </div>
        <hr style="width: 500px">
    </div>
    <?php endforeach;?>

        {{$posts->links()}}
    </div>
@endsection
<script>
    $(document).ready(function(){
        $('.button322').click(function(){
                let filter_count = $(this).val();
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'text',
                    data: {filter : filter_count},
                    success: function(response){
                        $('.content').html(response);
                    }
                });
            }
        )});

</script>

<script>
    $(document).ready(function(){
        $('.button323').click(function(){
                let filter_data = $(this).val();

                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/',
                    dataType: 'text',
                    data: {filter : filter_data},
                    success: function(response){
                        $('.content').html(response);
                    }
                });
            }
        )});

</script>

<script>
    $(document).ready(function(){
        $('.button324').click(function(){
                let filter_data = $(this).val();

                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/',
                    dataType: 'text',
                    data: {filter : filter_data},
                    success: function(response){
                        $('.content').html(response);
                    }
                });
            }
        )});

</script>




