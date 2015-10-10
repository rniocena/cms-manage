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
                                        <div class="stat"> <i class=" icon-eye-open"></i> Total Views <br> <span class="value">851</span> </div>

                                        <div class="stat"> <i class="icon-money"></i> Total Shop Sales <br> <span class="value">$423</span> </div>

                                        <div class="stat"> <i class="icon-time"></i> Total Pending Bookings <br> <span class="value">25%</span> </div>

                                        <div class="stat"> <i class="icon-tasks"></i> Total Bookings <br> <span class="value">922</span> </div>
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
