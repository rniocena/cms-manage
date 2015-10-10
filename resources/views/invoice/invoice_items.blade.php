@extends('includes.layout')

@section('content')

    <body>
    <div style="margin-left: 100px">

        <div class="non-shortable-content">
            <br>
            <h1>Add Invoice Items</h1>

            <br>

            <a href="{{action('InvoiceController@anyGenerateInvoice')}}">Create New Invoice</a>
        </div>

        <div class="shortable-content">

            <div class="box _100">
                <div class="box-content">

                    {!! Form::open(['method' => 'POST', 'action' => ['InvoiceController@anyAddInvoiceItems'], 'name' => 'invoiceItemForm', 'id' => 'invoiceItemForm', 'files' => true]) !!}

                    <div class="form-row">
                        <label for="invoice_id"><strong>Select Invoice</strong></label>
                        <div class="form-right-col">
                            <select name="invoice_id" id="invoice_id" class="validate[required] _100F">

                                <option value="">Choose an invoice</option>
                                @foreach($invoices as $invoice)
                                <option value="{{$invoice->id}}">{{$invoice->invoice_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-row">
                        <label for="quantity"><strong>Quantity</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="number" name="quantity" id="quantity" /></div>
                    </div>

                    <div class="form-row">
                        <label for="product"><strong>Product/Service</strong></label>
                        <div class="form-right-col"><input class="_100F" type="text" name="product" id="product" /></div>
                    </div>

                    <div class="form-row">
                        <label for="price"><strong>Price</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="number" name="price" id="price" /></div>
                    </div>

                    <div class="form-row">
                        <label for="currency_code"><strong>Currency Code</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="currency_code" id="currency_code" /></div>
                    </div>

                    <div class="form-row">
                        <input type="submit" value="Submit" class="float_r" />
                    </div>
                    {!! Form::close() !!}
                </div>

                <br><br>
                <div class="box-content">

                    @if(Session::get('success'))
                        <h3 style="color: green; text-align: center">{{Session::get('success')}}</h3>
                    @endif
                    <table border="1" bordercolor="#dfdfdf" class="static_table">
                        <thead>
                            <th>Invoice Number</th>
                            <th>Products/Services</th>
                            <th style="width: 20%">Options</th>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->invoice_number}}</td>
                                    <td>
                                        @foreach($invoice->invoice_items as $item)
                                            {{$item->product}} <br>
                                        @endforeach
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{action('InvoiceController@anySaveInvoice', $invoice->id)}}">PDF</a> ||
                                        {{--<a href="#">Edit</a> ||--}}
                                        <a href="{{action('InvoiceController@anyRemoveInvoice', $invoice->id)}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br><br>
            </div>  <!--GENRAL FORMS ENDS HERE-->

        </div><!--SHORTABLECONTENT-ENDS-->
    </div><!--MAIN ENDS-->

    </body>

@stop