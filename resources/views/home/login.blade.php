<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
@extends('layouts.main')
@section('title', 'Register')
@section('content')
    <div class="session_result">
        <?php if (session()->has('error_sign')): ?>
        <div class="alert alert-danger" role="alert">
            <?php
            echo session()->get('error_sign') . '      ' . '<a href="/signup">SignUp</a>';
            session()->forget('error_sign');
            ?>
        </div>
        <?php endif; ?>
    </div>

    <form action="/signing" method="post">
        @csrf
        <div class="content">
            <div class="mb-3 row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text"  class="form-control" id="username" name="username">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="mybutton" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-success" id="mybutton">Submit</button>
                </div>
            </div>
        </div>
    </form>
@endsection


