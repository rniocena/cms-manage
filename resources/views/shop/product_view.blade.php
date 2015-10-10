@extends('includes.layout')

@section('content')
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <div class="widget ">
                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3>{{$product->name}}</h3>
                            </div> <!-- /widget-header -->
                            <div class="widget-content">

                                <img src="{{$main_image}}" style="width: 320px; height: 300px">

                                <br><br><br>


                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#description" data-toggle="tab">Description</a>
                                        </li>
                                        <li><a href="#reviews" data-toggle="tab">Reviews ({{count($reviews)}})</a></li>
                                    </ul>
                                    <br>

                                    <div class="tab-content">
                                        {{--======= PRODUCT DESCRIPTION =======--}}
                                        <div class="tab-pane active" id="description">
                                            {{nl2br($product->description)}}
                                        </div>

                                        {{--======= PRODUCT REVIEWS =======--}}
                                        <div class="tab-pane" id="reviews">
                                            @if(count($reviews) > 0)

                                            @else
                                                <div class="error-container">
                                                    <h2>No reviews yet.</h2>

                                                    <h3>Want to leave a review about this product?</h3>

                                                    <div class="error-actions">
                                                        <h4>Click<a href="">here</a></h4>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>

                                    </div>


                                </div>





                            </div> <!-- /widget-content -->

                        </div> <!-- /widget -->

                    </div> <!-- /span8 -->




                </div> <!-- /row -->

            </div> <!-- /container -->

        </div> <!-- /main-inner -->

    </div>
@stop
