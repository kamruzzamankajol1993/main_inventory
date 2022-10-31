<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MainProduct;
use App\Models\Imageupload;
use App\Models\Category;
use App\Models\AttributeDetail;
use App\Models\Unit;
use App\Models\Brand;
use PDF;
use DB;
use App\Models\ImageList;
use App\Models\FeatureProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\AssaignCategory;
use App\Models\AssaignSize;
use App\Models\SizeChart;
use App\Models\ProductColor;
use App\Models\ProductCategory;
use App\Models\ProductQuantity;
use App\Models\Client;
use App\Models\DelivaryAddress;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\ShippingAddress;
use App\Models\Payment;
use App\Models\Exchangedetail;
use App\Models\Exchange;
use App\Models\Orderby;
use App\Models\Onlineexpense;
use App\Models\Vendor;

use App\Models\Purchase;
use App\Models\Purchasedetail;
class PurchaseController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }



    public function index(){

        if (is_null($this->user) || !$this->user->can('purchase_view')) {
            return redirect('/admin/logout_session');
        }

        $total_data = Purchase::latest()->count();

        $total_serial_number1= $total_data/10;

        if (is_float($total_serial_number1)){
            $total_serial_number = ceil($total_serial_number1);

        }else{
            $total_serial_number = $total_serial_number1;
        }

        $purchase_list = Purchase::latest()->limit(10)->get();

        return view('backend.purchase.index',compact('purchase_list','total_serial_number'));
    }


    public function create()
    {

        if (is_null($this->user) || !$this->user->can('purchase_add')) {
            //abort(403, 'Sorry !! You are Unauthorized to view Product List !');

             return redirect('/admin/logout_session');
        }



        $vendors = Vendor::latest()->get();
        $product_names = MainProduct::latest()->get();
        return view('backend.purchase.create', compact('vendors','product_names'));

    }


    public function get_vendor_for_request_and_purchase(Request $request){

        $main_value = $request->main_value;

        if($main_value == 'Add New Vendor'){
            $vendor_detail = '';

        }else{
            $vendor_detail = Vendor::where('name',$request->main_value)->first();
        }



        $data = view('backend.purchase.get_vendor_for_request_and_purchase',compact('vendor_detail','main_value'))->render();
        return response()->json($data);


    }

    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('purchase_add')) {
            abort(403, 'Sorry !! You are Unauthorized to add any product !');

             //return redirect('/admin/logout_session');
        }


        $input = $request->all();

        $s_pay_date = date("Y-m-d", strtotime($request->request_date));

        $s_pay_date1 = date("Y-m-d", strtotime($request->purchase_date));
        //dd($input);


    $database_save = new Purchase();
    $database_save->vendor_id = $request->vendor_name;
    $database_save->request_number = $request->request_date;
    $database_save->request_date = $request->request_date;
    $database_save->request_note = $request->request_note;


    $database_save->purchase_date = $request->purchase_date;
    $database_save->purchase_lot_number = $request->purchase_lot_number;


    $database_save->total_product = $request->total_product;
    $database_save->total_quantity = $request->total_quantity;
    $database_save->total_buy_price =$request->total_buy_price;
    //$database_save->request_delivery_date = $s_pay_date1;
    $database_save->term = $request->payment_term;
    $database_save->status = 'inc';
    $database_save->save();


    $invoice_id = $database_save->id;






    $condition_main_product_id = $input['nmain_product_id'];

        foreach($condition_main_product_id as $key => $condition_main_product_id){
            $form= new Purchasedetail();
            $form->product_id=$input['nmain_product_id'][$key];
            $form->purchase_id=$invoice_id;
            $form->quantity=$input['p_quantity'][$key];
            $form->buy_price=$input['buying_price'][$key];
            $form->save();

            //first table quantity update


    }

    return redirect('admin/purchase_view/'.$invoice_id)->with('success','Created Successfully');

}


public function update(Request $request){



    if (is_null($this->user) || !$this->user->can('purchase_update')) {
        abort(403, 'Sorry !! You are Unauthorized to add any product !');

         //return redirect('/admin/logout_session');
    }


    $input = $request->all();

    $s_pay_date = date("Y-m-d", strtotime($request->pay_date));

    $s_pay_date1 = date("Y-m-d", strtotime($request->request_date));
    //dd($input);


$database_save = Purchase::find($request->id);
$database_save->vendor_id = $request->vendor_name;
    $database_save->request_number = $request->request_date;
    $database_save->request_date = $request->request_date;
    $database_save->request_note = $request->request_note;


    $database_save->purchase_date = $request->purchase_date;
    $database_save->purchase_lot_number = $request->purchase_lot_number;


    $database_save->total_product = $request->total_product;
    $database_save->total_quantity = $request->total_quantity;
    $database_save->oo =$request->total_buy_price;
   // $database_save->request_delivery_date = $s_pay_date1;
    $database_save->term = $request->payment_term;
    $database_save->status = 'inc';
$database_save->save();


$invoice_id = $database_save->id;


$delete_id = Purchasedetail::where('request_id',$invoice_id)->delete();



$condition_main_product_id = $input['nmain_product_id'];

    foreach($condition_main_product_id as $key => $condition_main_product_id){
        $form= new Purchasedetail();
        $form->product_id=$input['nmain_product_id'][$key];
        $form->purchase_id=$invoice_id;
        $form->quantity=$input['p_quantity'][$key];
        $form->buy_price=$input['buying_price'][$key];
        $form->save();

        //first table quantity update



}

return redirect('admin/purchase_view/'.$invoice_id)->with('success','Created Successfully');
}


    public function view($id){

    $invoice =  Purchase::where('id',$id)->first();
    $invoice_detail = Purchasedetail::where('purchase_id',$id)->get();



    return view('backend.purchase.view',compact('invoice','invoice_detail'));

}


public function edit($id){

    $invoice =  Purchase::where('id',$id)->first();
    $invoice_detail = Purchasedetail::where('request_id',$id)->get();
    $vendors = Vendor::latest()->get();
    $product_names = MainProduct::latest()->get();

    return view('backend.purchase.edit',compact('product_names','vendors','invoice','invoice_detail'));

}
}
