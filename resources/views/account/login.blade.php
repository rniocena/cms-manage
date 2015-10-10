@extends('includes.layout')

@section('content')

<div class="account-container">

    <div class="content clearfix">

        <form action="{{action('UserController@postLogin')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <h1>Member Login</h1>

            <div class="login-fields">

                <p>Please provide your details</p>

                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="" placeholder="Email" class="login username-field" />
                </div>

                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
                </div>

            </div>

            <div class="login-actions">
                <button class="button btn btn-success btn-large">Sign In</button>
            </div>
        </form>

    </div>

</div>

<div class="login-extra">
    <a href="#">Reset Password</a> ||
    <a href="{{action('UserController@anyRegister')}}">Don't have an account?</a>
</div>

@stop