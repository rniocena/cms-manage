@extends('includes.layout')

@section('content')

    <div class="main">
        <div class="main-inner">
            <div class="container-fluid">

                <div class="row">

                    @if(count($products) > 0)

                        <p>

                        </p>

                        <table>
                            @foreach($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{$main_image}}" style="width: 120px; height: 100px">
                                    </td>
                                    <td style="width: 5%">&nbsp;</td>
                                    <td>
                                        <h3>{{$product->name}}</h3>
                                        <strong><span>${{ number_format($product->price_in_cents / 100, 0, '.', ',') }}</span></strong>
                                        <br><br>
                                        <a href="{{action('ProductController@anyProductDescription', $product->uid)}}" class="btn btn-info">View Details</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            @endforeach
                        </table>

                    @else
                        <div class="error-container">
                            <h2>Sorry. No products are available at the moment.</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop