<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
@extends('layouts.main')
@section('title', 'Reviews')
@section('content')

    <div class="session_result">

    </div>

    <?php if (session()->has('auth')): ?>
    <h2>Send your review</h2>

    <div class="content">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" id="username">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="Email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text"  class="form-control" id="email">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputContent" class="col-sm-2 col-form-label">Review</label>
            <div class="col-sm-10">
                <textarea  class="form-control" id="content"></textarea>
            </div>
        </div>
        <div>
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            @if ($errors->has('g-recaptcha-response'))
                <span class="help-block">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
            @endif

        </div>

        <div class="mb-3 row">
            <label for="mybutton" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success" id="mybutton" onclick="function ()">Submit</button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="content">
        <?php foreach($reviews as $review): ?>
        <?php $id = $review->id; ?>
        <div class="card" style="width: 200px; margin-top: 30px; border: #781919">
            <div class="card-body" style="width: 500px">
                <h3 class="card-title"><?php echo $review->username?></h3>
                <p class="card-text" ><?php echo $review->content?></p>
{{--                <div><h6 class="counter">viewed: <?php echo $post->count_views?></h6></div></td>--}}
                <div><h6 class="counter"> written at: <?php echo $review->date_create?></h6></div>
            </div>
            <hr style="width: 500px">
        </div>
        <?php endforeach;?>

        {{ $reviews->links() }}
    </div>
@endsection


<script>
    $(document).ready(function(){
        $('#mybutton').click(function(){
                let username = $('#username').val();
                let email = $('#email').val();
                let content = $('#content').val();
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    dataType: 'text',
                    url: "/review/create",
                    data: {username, email, content},
                    success: function(response){
                        $("#username").val('');
                        $('#email').val('');
                        $('#content').val('');
                        $('.session_result').html(response);

                    }
                });
            }
        )});

</script>




