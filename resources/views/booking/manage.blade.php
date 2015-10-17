@extends('includes.layout')

@section('content')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10%">Full Name</th>
                            <th style="width: 10%">Email Address</th>
                            <th style="width: 10%">Address</th>
                            <th style="width: 10%">Service Type</th>
                            <th style="width: 10%">Booking Date</th>
                            <th style="width: 10%">Booking Time</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 10%">Action Date</th>
                            <th style="width: 10%">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="table-td-border">
                                    {{$booking->first_name}} {{$booking->last_name}}
                                </td>
                                <td class="table-td-border">
                                    {{$booking->email}}
                                </td>
                                <td class="table-td-border">
                                    {{$booking->address}}, {{$booking->suburb}}
                                    <br>
                                    {{$booking->city}}
                                </td>
                                <td class="table-td-border">
                                    {{$booking->service_type->service}}
                                </td>
                                <td class="table-td-border">
                                    @if($booking->completed == 1)
                                        {{date('D, d M, Y', strtotime($booking->booking_date))}}
                                    @endif
                                </td>
                                <td class="table-td-border">
                                    @if($booking->completed == 1)
                                        {{date('g:i A', strtotime($booking->booking_time))}}
                                    @endif
                                </td>
                                <td class="table-td-border">
                                    @if($booking->pending == 1)
                                        Pending
                                    @elseif($booking->consulted == 1)
                                        Consulted
                                    @elseif($booking->completed == 1)
                                        Completed
                                    @elseif($booking->cancelled == 1)
                                        Cancelled
                                    @else
                                        Invalid
                                    @endif
                                </td>
                                <td class="table-td-border">
                                    @if($booking->pending == 1)
                                        {{$booking->pending_convert}}
                                    @elseif($booking->consulted == 1)
                                        {{$booking->consulted_convert}}
                                    @elseif($booking->completed == 1)
                                        {{$booking->completed_convert}}
                                    @elseif($booking->cancelled == 1)
                                        {{$booking->cancelled_convert}}
                                    @else
                                        Invalid
                                    @endif
                                </td>
                                <td class="table-td-border">
                                    <a href="{{action('BookingController@anyUpdateStatus', [$booking->uid, 'consulted'])}}" class="updateStatus">Consulted</a>
                                    <br>
                                    <a href="{{action('BookingController@anyUpdateStatus', [$booking->uid, 'completed'])}}" class="updateStatus">Completed</a>
                                    <br>
                                    <a href="{{action('BookingController@anyUpdateStatus', [$booking->uid, 'cancelled'])}}" class="updateStatus">Cancelled</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>{!! $bookings->render() !!}</div>
            </div>
        </div>
    </div>

    @include('includes.modal_generic')
@stop