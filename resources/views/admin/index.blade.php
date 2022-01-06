<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

@extends('layouts.main')
@section('title', 'Home')
@section('content')
<h1>Admin Panel</h1>

<?php if (session()->has('success_create_post')): ?>
<div class="alert alert-success" role="alert">
    <?php
        echo session()->get('success_create_post') . '<br>';
    session()->forget('success_create_post');
    ?>
</div>
<?php endif; ?>


<div class="mb-3 row">
    <p>Table Posts  <button type="button" value="posts" class="btn btn-secondary" id="button_posts" onclick="function ()">Go!</button></p>
    <p>Table Reviews  <button type="button" value="reviews" class="btn btn-success" id="button_reviews" onclick="function ()">Go!</button></p>
</div>

    <div class="content">

    </div>
<div class="session_result">

</div>

@endsection

<script>
    $(document).ready(function(){
        $('button').click(function(){
                let table = $(this).val();
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/admin',
                    dataType: 'text',
                    data: {table},
                    success: function(response){
                        $('.content').html(response);
                    }
                });
            }
        )});

</script>
