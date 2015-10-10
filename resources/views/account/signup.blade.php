@extends('includes.layout')

@section('content')

<div class="account-container register">

    <div class="content clearfix">

        <form action="{{action('UserController@anyRegister')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            <h1>Signup for Free Account</h1>

            <div class="login-fields">

                <p>Create your free account:</p>

                <div class="field">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="" placeholder="First Name" class="login" />
                </div> <!-- /field -->

                <div class="field">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="" placeholder="Last Name" class="login" />
                </div> <!-- /field -->


                <div class="field">
                    <label for="email">Email Address:</label>
                    <input type="text" id="email" name="email" value="" placeholder="Email" class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="" placeholder="Password" class="login"/>
                </div> <!-- /field -->

                <div class="field">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" value="" placeholder="Confirm Password" class="login"/>
                </div> <!-- /field -->

            </div> <!-- /login-fields -->

            <div class="login-actions">

				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Agree with the Terms & Conditions.</label>
				</span>

                <button class="button btn btn-primary btn-large">Register</button>

            </div> <!-- .actions -->

        </form>

    </div> <!-- /content -->

</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
    Already have an account? <a href="{{action('UserController@getLogin')}}">Login to your account</a>
</div> <!-- /login-extra -->
@stop