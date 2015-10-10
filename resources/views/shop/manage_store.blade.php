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
                                <i class="icon-user"></i>
                                <h3>Add New Product</h3>
                            </div>
                            <div class="widget-content">
                                {!! Form::open(['method' => 'POST', 'action' => ['ProductController@anyManageShop'], 'name' => 'formManageShop', 'class' => 'form-horizontal formManageShop', 'files' => true]) !!}
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label" for="main_product_image">Main Product Image</label>
                                            <div class="controls">
                                                <input type="file" class="span4" id="main_product_image" name="main_product_image">
                                                @if($errors->first('main_product_image'))
                                                    <br><span class="text-danger">{{$errors->first('main_product_image')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="product_category">Product Category</label>
                                            <div class="controls">
                                                <select class="select2" id="product_category" name="product_category">
                                                    @foreach($product_types as $product)
                                                        <option value="{{$product->id}}">{{$product->human_name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->first('product_category'))
                                                    <br><span class="text-danger">{{$errors->first('product_category')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="product_name">Product Name</label>
                                            <div class="controls">
                                                <input type="text" class="span4" id="product_name" name="product_name">
                                                @if($errors->first('product_name'))
                                                    <br><span class="text-danger">{{$errors->first('product_name')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="short_description">Product Short Description</label>
                                            <div class="controls">
                                                <textarea rows="4" cols="50" id="short_description" name="short_description"></textarea>
                                                @if($errors->first('short_description'))
                                                    <br><span class="text-danger">{{$errors->first('short_description')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="product_description">Product Description</label>
                                            <div class="controls">
                                                <textarea rows="4" cols="50" id="product_description" name="product_description"></textarea>
                                                @if($errors->first('product_description'))
                                                    <br><span class="text-danger">{{$errors->first('product_description')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="price">Price ($)</label>
                                            <div class="controls">
                                                <input type="text" class="span4" id="price" name="price">
                                                @if($errors->first('price'))
                                                    <br><span class="text-danger">{{$errors->first('price')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="price">Quantity</label>
                                            <div class="controls">
                                                <input type="number" class="span4" id="quantity" name="quantity">
                                                @if($errors->first('price'))
                                                    <br><span class="text-danger">{{$errors->first('price')}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary">Add Product</button>
                                            <button class="btn">Cancel</button>
                                        </div>
                                    </fieldset>
                                {{--</form>--}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop