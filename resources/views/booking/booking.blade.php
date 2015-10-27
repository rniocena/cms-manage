@extends('includes.layout')

@section('content')

<div class="main">
    <div class="main-inner">
        <div class="container">
            @if(count($success_msg) > 0)
                @foreach($success_msg as $success)
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{$success}}</strong>
                    </div>
                @endforeach
            @endif

            @if(count($error_msg) > 0)
                @foreach($error_msg as $error)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{$error}}</strong>
                    </div>
                @endforeach
            @endif
            <div class="row">
                <div class="span12">
                    <div class="widget ">
                        <div class="widget-header">
                            <h3>Book a service</h3>
                        </div>
                        <div class="widget-content">
                            <form action="{{action('BookingController@anyBooking')}}" method="POST" class="form-horizontal formBookings">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <fieldset>
                                    <div class="control-group">
                                        <label class="control-label" for="first_name">First Name</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="first_name" name="first_name" value="{{$user->first_name}}">
                                            @if($errors->first('first_name'))
                                                <br><span class="text-danger">{{$errors->first('first_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="last_name">Last Name</label>
                                        <div class="controls">
                                            <input type="text" class="span6" id="last_name" name="last_name" value="{{$user->last_name}}">
                                            @if($errors->first('last_name'))
                                                <br><span class="text-danger">{{$errors->first('last_name')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="email">Email Address</label>
                                        <div class="controls">
                                            <input type="email" class="span4" id="email" name="email" value="{{$user->email}}">
                                            @if($errors->first('email'))
                                                <br><span class="text-danger">{{$errors->first('email')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="email">Contact Number</label>
                                        <div class="controls">
                                            <input type="text" class="span4" id="phone" name="phone" value="{{$user->phone}}">
                                            @if($errors->first('phone'))
                                                <br><span class="text-danger">{{$errors->first('phone')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="street_address">Street Address</label>
                                        <div class="controls">
                                            <input type="text" class="span4" id="street_address" name="address">
                                            @if($errors->first('address'))
                                                <br><span class="text-danger">{{$errors->first('address')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="suburb">Suburb</label>
                                        <div class="controls">
                                            <input type="text" class="span4" id="suburb" name="suburb">
                                            @if($errors->first('suburb'))
                                                <br><span class="text-danger">{{$errors->first('suburb')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="city">Region</label>
                                        <div class="controls">
                                            <select class="select2" id="city" name="city">
                                                <option>Auckland</option>
                                                <option>Hamilton</option>
                                                <option>Whangarei</option>
                                            </select>
                                            @if($errors->first('city'))
                                                <br><span class="text-danger">{{$errors->first('city')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="service_type_id">Service Type</label>
                                        <div class="controls">
                                            <select class="select2" id="service_type_id" name="service_type_id">
                                                @foreach($service_types as $service_type)
                                                    <option value="{{$service_type->id}}">{{$service_type->service}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->first('service_type_id'))
                                                <br><span class="text-danger">{{$errors->first('service_type_id')}}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="booking_date">Date</label>
                                        <div class="controls">
                                            {{--<a href="" class="span4 date-picker" id="booking_date"><span class="dateSelect">Select a date</span></a>--}}
                                            <input type="text" class="span4 date-picker" id="booking_date" name="booking_date">
                                            @if($errors->first('booking_date'))
                                                <br><span class="text-danger">{{$errors->first('booking_date')}}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <p>
                                            As soon as your booking is received, we will get in touch with you to inform
                                            you if your selected date is available. Otherwise, we will arrange another date
                                            that would suit your request.
                                        </p>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Continue</button>
                                        <button class="btn">Cancel</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop