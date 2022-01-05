<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
@extends('layouts.main')
@section('title', 'Register')
@section('content')
    <div class="session_result">

    </div>

        <div class="content">
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
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="mybutton" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success" id="mybutton" onclick="function ()">Submit</button>
                </div>
            </div>
        </div>
@endsection

<script>
    $(document).ready(function(){
        $('#mybutton').click(function(){
                let username = $('#username').val();
                let email = $('#email').val();
                let password_hash = $('#password').val();
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    dataType: 'text',
                    url: "/signup/create",
                    data: {username, email, password_hash},
                    success: function(response){
                        $("#username").val('');
                        $('#email').val('');
                        $('#password').val('');
                        $('.session_result').html(response);

                    }
                });
            }
        )});

</script>
