@extends('includes.layout')

@section('content')

<div>

    <div class="non-shortable-content">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="carousel slide" id="myCarousel">
                        <div class="carousel-inner">

                            <div class="item active">

                                <div class="bannerImage">
                                    {{--<a href="#"><img src="http://placehold.it/960x405" alt=""></a>--}}
                                    <img src="../../../public/img/slide1.png" title="SMARTCCTVALARM" style="width:100px; height:100px">
                                </div>

                                <div class="caption row-fluid">
                                    <div class="span4"><h3>Nullam Condimentum Nibh Etiam Sem</h3>
                                        <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                    </div>
                                    <div class="span8"><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                                    </div>
                                </div>

                            </div><!-- /Slide1 -->

                            <div class="item">

                                <div class="bannerImage">
                                    <img src="../../../public/img/slide2.png" title="SMARTCCTVALARM" style="width:100px; height:100px">
                                </div>

                                <div class="caption row-fluid">
                                    <div class="span4"><h3>Nullam Condimentum Nibh Etiam Sem</h3>
                                        <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                    </div>
                                    <div class="span8"><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                                    </div>
                                </div>

                            </div><!-- /Slide2 -->

                            <div class="item">

                                <div class="bannerImage">
                                    {{--<a href="#"><img src="http://placehold.it/960x405" alt=""></a>--}}
                                    <img src="../../../public/img/slide3.jpg" title="SMARTCCTVALARM" style="width:100px; height:100px">
                                </div>

                                <div class="caption row-fluid">
                                    <div class="span4"><h3>Nullam Condimentum Nibh Etiam Sem</h3>
                                        <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                    </div>
                                    <div class="span8"><p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                                    </div>
                                </div>

                            </div><!-- /Slide2 -->

                        </div>

                        <div class="control-box">
                            <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
                            <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
                        </div><!-- /.control-box -->

                    </div><!-- /#myCarousel -->

                </div><!-- /.span12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

</div><!--MAIN ENDS-->

@stop
