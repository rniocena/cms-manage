@extends('includes.layout')

@section('content')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <table class="table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 10%">Service Type</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Confirmed Schedule Date</th>
                        <th style="width: 10%">Confirmed Schedule Time</th>
                        <th style="width: 10%">Date Submitted</th>
                        <th style="width: 10%">Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="table-td-border">
                                {{$booking->service_type->service}}
                            </td>
                            <td class="table-td-border">
                                @if($booking->pending == 1)
                                    Pending
                                @elseif($booking->completed == 1)
                                    Completed
                                @elseif($booking->consulted == 1)
                                    Consulted
                                @elseif($booking->cancelled == 1)
                                    Cancelled
                                @endif
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
                                {{date('D, d M, Y g:i A', strtotime($booking->created_at))}}
                            </td>
                            <td class="table-td-border">
                                {{date('D, d M, Y g:i A', strtotime($booking->updated_at))}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('includes.modal_generic')
@stop