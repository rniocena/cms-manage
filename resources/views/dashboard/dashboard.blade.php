@extends('includes.layout')

@section('content')

<div>

    <div class="non-shortable-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget widget-nopad">
                        <div class="widget-header"> <i class="icon-list-alt"></i>
                            <h3> Summary Report</h3>
                        </div>
                        <div class="widget-content">
                            <div class="widget big-stats-container">
                                <div class="widget-content">
                                    <h6 class="bigstats">Overall Report Summary</h6>
                                    <div id="big_stats" class="cf">
                                        <div class="stat"> <i class=" icon-eye-open"></i> Total Views <br> <span class="value">{{$website_views}}</span> </div>

                                        <div class="stat"> <i class="icon-tasks"></i> Total Pending Bookings <br> <span class="value">{{$total_pending}}</span> </div>
                                        <div class="stat"> <i class="icon-time"></i> Total Consulted Bookings <br> <span class="value">{{$total_consulted}}</span> </div>
                                        <div class="stat"> <i class="icon-time"></i> Total Completed Bookings <br> <span class="value">{{$total_completed}}</span> </div>
                                        {{--<div class="stat"> <i class="icon-time"></i> Total Cancelled Bookings <br> <span class="value">{{$total_cancelled}}</span> </div>--}}

                                        {{--<div class="stat"> <i class="icon-money"></i> Total Service Sales <br> <span class="value">{{$total_service_sales}}</span> </div>--}}
                                        {{--<div class="stat"> <i class="icon-money"></i> Total Shop Sales <br> <span class="value">{{$total_shop_sales}}</span> </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</div>

@stop
