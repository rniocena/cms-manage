@extends('includes.layout')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong style="text-align: center">Great! We have received your email.</strong>
        </div>
    @endif

    <div class="account-container">
        <div class="content clearfix">

            <form action="{{action('ContactController@anySendMessage')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <h1>Contact Us</h1>

                <div class="login-fields">
                    <div class="field">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" value="" placeholder="Your Name" class="username-field" />
                    </div>

                    <div class="field">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="" placeholder="Email Address" class="username-field" />
                    </div>

                    <div class="field">
                        <label for="message">Your Message</label>
                        <textarea rows="6" cols="50" id="message" name="message"></textarea>
                    </div>
                </div>

                <div class="login-actions">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>

        </div>

    </div>
@stop