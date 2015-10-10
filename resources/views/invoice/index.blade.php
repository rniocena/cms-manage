@extends('includes.layout')

@section('content')

<body>
<div style="margin-left: 100px">

    <div class="non-shortable-content">
        <br>
        <h1>Generate Invoice</h1>

        <br>
        <a href="{{action('InvoiceController@anyAddInvoiceItems')}}">Add Invoice Items</a>
    </div>

    <div class="shortable-content">

        <div class="box _100">
            <div class="box-content">

                {!! Form::open(['method' => 'POST', 'action' => ['InvoiceController@anyGenerateInvoice'], 'name' => 'generateInvoiceForm', 'id' => 'generateInvoiceForm', 'files' => true]) !!}
                    <div class="form-row">
                        <label for="company_name"><strong>Company Name</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="company_name" id="company_name" /></div>
                    </div>

                    <div class="form-row">
                        <label for="street_address"><strong>Street Address</strong></label>
                        <div class="form-right-col"><input class="_100F" type="text" name="street_address" id="street_address" /></div>
                    </div>

                    <div class="form-row">
                        <label for="city"><strong>City</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="city" id="city" /></div>
                    </div>

                    <div class="form-row">
                        <label for="zip_code"><strong>Zip Code</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="zip_code" id="zip_code" /></div>
                    </div>

                    <div class="form-row">
                        <label for="country"><strong>Country</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="country" id="country" /></div>
                    </div>

                    <div class="form-row">
                        <label for="customer_name"><strong>Customer Name</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="customer_name" id="customer_name" /></div>
                    </div>

                    <div class="form-row">
                        <label for="invoice_number"><strong>Invoice Number</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="invoice_number" id="invoice_number" /></div>
                    </div>

                    <div class="form-row">
                        <label for="order_number"><strong>Order Number</strong></label>
                        <div class="form-right-col"><input value="" class="_100F" type="text" name="order_number" id="order_number" /></div>
                    </div>

                    {{--<div class="form-row">--}}
                        {{--<label for="invoice_date"><strong>Invoice Date</strong></label>--}}
                        {{--<div class="form-right-col"><input value="" class="_100F" type="text" name="invoice_date" id="invoice_date" /></div>--}}
                    {{--</div>--}}

                    <div class="form-row">
                        <input type="submit" value="Submit" class="float_r" />
                    </div>
                {!! Form::close() !!}
                <br><br>
            </div>
        </div>  <!--GENRAL FORMS ENDS HERE-->

    </div><!--SHORTABLECONTENT-ENDS-->
</div><!--MAIN ENDS-->

</body>

@stop