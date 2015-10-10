<?php namespace App\Http\Controllers;

use App\Models\InvoiceDetails;
use App\Models\InvoiceItems;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class InvoiceController extends Controller
{
    protected $roles = null;
    protected $super_admin = false;

    public function __construct()
    {
        // Require that the user is a guest (logged out)
        $this->middleware('guest', ['only' => ['getLogin', 'postLogin']]);

        // Require that the user is logged in
        $this->middleware('auth', ['only' => ['getLogout', 'getProfile']]);

        if(User::get()) {

//            $this->roles = User::get()->checkRole(Seller::get()->id, User::get()->id);

            $this->super_admin = User::get()->isSuperAdmin(User::$user->id);
        }

//        View::share('user_roles', $this->roles);

        View::share('super_admin', $this->super_admin);
    }

    public function anyGenerateInvoice()
    {
        if(Request::method() == 'POST') {

            /** TODO use in editing invoices */
//            $invoice_details = InvoiceDetails::first();
//
//            if($invoice_details) {
//                $invoice_details->update(Input::all());
//            } else {
//                new InvoiceDetails(Input::all());
//            }

            $invoice = new InvoiceDetails(Input::all());

//            $invoice = new InvoiceDetails();
//
//            $invoice->company_name = Input::get('company_name');
//            $invoice->customer_name = Input::get('customer_name');
//            $invoice->street_address = Input::get('street_address');
//            $invoice->city = Input::get('city');
//            $invoice->zip_code = Input::get('zip_code');
//            $invoice->country = Input::get('country');
//            $invoice->invoice_number = Input::get('invoice_number');
//            $invoice->order_number = Input::get('order_number');
//            $invoice->save();

            return Redirect::back()->with('success', 'Invoice Created!');
        } else {

            return View::make('invoice.index');
        }
    }

    public function anyAddInvoiceItems()
    {
        $invoice_details = InvoiceDetails::get();

        $items = InvoiceItems::all();

        if(Request::method() == 'POST') {

            $invoice_items = new InvoiceItems();

            $invoice_items->invoice_id = Input::get('invoice_id');
            $invoice_items->quantity = Input::get('quantity');
            $invoice_items->product = Input::get('product');
            $invoice_items->price_in_cents = Input::get('price') * 100;
            $invoice_items->currency_code = Input::get('currency_code');

            $invoice_items->save();

            return Redirect::back()->with('success', 'Items Added!');
        } else {

            return View::make('invoice.invoice_items', [
                'invoices' => $invoice_details,
                'invoice_items' => $items
            ]);
        }
    }

    public function anyRemoveInvoice($invoice_id)
    {
        $invoice = InvoiceDetails::find($invoice_id);

        if($invoice) {
            foreach($invoice->invoice_items as $item) {
                $item->delete();
            }

            $invoice->delete();

            return Redirect::back()->with('success', 'Invoice Removed');
        } else {
            return Redirect::back()->with('error', 'Invalid Invoice');
        }
    }

    public function anySaveInvoice($invoice_id)
    {
        $invoice = InvoiceDetails::find($invoice_id);
        $invoice_items = InvoiceItems::where('invoice_id', $invoice_id)->get();

        // create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //set auto page breaks
        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
        //set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $l = [
            'a_meta_charset' => 'UTF-8',
            'a_meta_dir' => 'ltr',
            'a_meta_language' => 'en',
            'w_page' => 'page',
        ];
        //set some language-dependent strings
        $pdf->setLanguageArray($l);

        // ---------------------------------------------------------

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($invoice->company_name);
        $pdf->SetTitle($invoice->customer_name . '_' . $invoice->invoice_number);
        $pdf->SetSubject($invoice->customer_name . '_' . $invoice->invoice_number);
        $pdf->SetKeywords($invoice->customer_name . ', ' . $invoice->invoice_number . ', ' . $invoice->company_name);

        // add a page
        $pdf->AddPage();

        // create address box
//        $this->CreateTextBox('Customer name Inc.', 0, 55, 80, 10, 10, 'B');

//        $textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L'
        $pdf->SetXY(20, 55); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(80, 10, $invoice->company_name, 0, false, 'L');

//        $this->CreateTextBox('Mr. Tom Cat', 0, 60, 80, 10, 10);
        $pdf->SetXY(20, 60); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
        $pdf->Cell(80, 10, $invoice->customer_name, 0, false, 'L');

//        $this->CreateTextBox('Street address', 0, 65, 80, 10, 10);
        $pdf->SetXY(20, 65); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
        $pdf->Cell(80, 10, $invoice->street_addess, 0, false, 'L');

//        $this->CreateTextBox('Zip, city name', 0, 70, 80, 10, 10);
        $pdf->SetXY(20, 70); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
        $pdf->Cell(80, 10, $invoice->city . ' ' . $invoice->zip_code . ', ' . $invoice->country, 0, false, 'L');

        // invoice title / number
//        $this->CreateTextBox('Invoice #201012345', 0, 90, 120, 20, 16);
        $pdf->SetXY(20, 90); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 16);
        $pdf->Cell(120, 20, 'Invoice #' . $invoice->invoice_number, 0, false, 'L');

        // date, order ref
//        $this->CreateTextBox('Date: '.date('Y-m-d'), 0, 100, 0, 10, 10, '', 'R');
        $pdf->SetXY(20, 100); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
        $pdf->Cell(0, 10, 'Date: ' . date('Y-m-d'), 0, false, 'R');

//        $this->CreateTextBox('Order ref.: #6765765', 0, 105, 0, 10, 10, '', 'R');
        $pdf->SetXY(20, 105); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
        $pdf->Cell(0, 10, 'Order ref: #' . $invoice->order_number, 0, false, 'R');

        // list headers
//        $this->CreateTextBox('Quantity', 0, 120, 20, 10, 10, 'B', 'C');
        $pdf->SetXY(20, 120); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(20, 10, 'Quantity', 0, false, 'C');

//        $this->CreateTextBox('Product or service', 20, 120, 90, 10, 10, 'B');
        $pdf->SetXY(20 + 20, 120); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(90, 10, 'Product/Service', 0, false, 'L');

//        $this->CreateTextBox('Price', 110, 120, 30, 10, 10, 'B', 'R');
        $pdf->SetXY(110 + 20, 120); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(30, 10, 'Price', 0, false, 'R');

//        $this->CreateTextBox('Amount', 140, 120, 30, 10, 10, 'B', 'R');
        $pdf->SetXY(140 + 20, 120); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(30, 10, 'Amount', 0, false, 'R');

        $pdf->Line(20, 129, 195, 129);

// some example data
//        $orders[] = array('quant' => 5, 'descr' => '.com domain registration', 'price' => 9.95);
//        $orders[] = array('quant' => 3, 'descr' => '.net domain name renewal', 'price' => 11.95);
//        $orders[] = array('quant' => 1, 'descr' => 'SSL certificate 256-Byte encryption', 'price' => 99.95);
//        $orders[] = array('quant' => 1, 'descr' => '25GB VPS Hosting, 200GB Bandwidth', 'price' => 19.95);

        $orders = [];

        foreach($invoice_items as $item) {
            $orders[] = [
                'quant' => $item->quantity,
                'descr' => $item->product,
                'price' => $item->price_in_cents / 100,
                'currency' => $item->currency_code
            ];
        }

        $currY = 128;
        $total = 0;
        foreach ($orders as $row) {
//            $this->CreateTextBox($row['quant'], 0, $currY, 20, 10, 10, '', 'C');
            $pdf->SetXY(20, $currY); // 20 = margin left
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->Cell(20, 10, $row['quant'], 0, false, 'C');

//            $this->CreateTextBox($row['descr'], 20, $currY, 90, 10, 10, '');
            $pdf->SetXY(20 + 20, $currY); // 20 = margin left
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->Cell(90, 10, $row['descr'], 0, false, 'L');

//            $this->CreateTextBox('$'.$row['price'], 110, $currY, 30, 10, 10, '', 'R');
            $pdf->SetXY(110 + 20, $currY); // 20 = margin left
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->Cell(30, 10, '$' . $row['price'], 0, false, 'R');

            $amount = $row['quant'] * $row['price'];
//            $this->CreateTextBox('$'.$amount, 140, $currY, 30, 10, 10, '', 'R');
            $pdf->SetXY(140 + 20, $currY); // 20 = margin left
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
            $pdf->Cell(30, 10, '$' . $amount, 0, false, 'R');

            $currY = $currY + 5;
            $total = $total + $amount;
        }
        $pdf->Line(20, $currY + 4, 195, $currY + 4);

        $total_gst = ($total * 0.15);
        $sub_total = $total - $total_gst;
        $total_price = $sub_total + $total_gst;

        // output the sub total row
//        $this->CreateTextBox('Total', 20, $currY+5, 135, 10, 10, 'B', 'R');
        $pdf->SetXY(20, $currY + 5); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(135, 10, 'Sub Total', 0, false, 'R');

//        $this->CreateTextBox('$'.number_format($total, 2, '.', ''), 140, $currY+5, 30, 10, 10, 'B', 'R');
        $pdf->SetXY(140 + 20, $currY + 5); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(30, 10, '$' . number_format($sub_total, 2, '.', ''), 0, false, 'R');

        // output GST
//        $this->CreateTextBox('Total', 20, $currY+5, 135, 10, 10, 'B', 'R');
        $pdf->SetXY(20, $currY + 5); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(135, 20, 'GST Total', 0, false, 'R');

//        $this->CreateTextBox('$'.number_format($total, 2, '.', ''), 140, $currY+5, 30, 10, 10, 'B', 'R');
        $pdf->SetXY(140 + 20, $currY + 5); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10);
        $pdf->Cell(30, 20, '$' . number_format($total_gst, 2, '.', ''), 0, false, 'R');

        // output the total row
//        $this->CreateTextBox('Total', 20, $currY+5, 135, 10, 10, 'B', 'R');
        $pdf->SetXY(20, $currY + 5); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 15);
        $pdf->Cell(135, 40, 'Total', 0, false, 'R');

//        $this->CreateTextBox('$'.number_format($total, 2, '.', ''), 140, $currY+5, 30, 10, 10, 'B', 'R');
        $pdf->SetXY(140 + 20, $currY + 5); // 20 = margin left
        $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 15);
        $pdf->Cell(30, 40, '$' . number_format($total_price, 2, '.', ''), 0, false, 'R');

// some payment instructions or information
        $pdf->setXY(20, $currY + 50);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
//        $pdf->MultiCell(175, 10, '<em>Lorem ipsum dolor sit amet, consectetur adipiscing elit</em>', 0, 'L', 0, 1, '', '', true, null, true);
        $pdf->MultiCell(175, 10, '<em></em>', 0, 'L', 0, 1, '', '', true, null, true);


        $storage = storage_path();
        $file_name = 'invoice' . '.pdf';

        $pdf->Output($file_name, 'I');
        return true;
    }
}