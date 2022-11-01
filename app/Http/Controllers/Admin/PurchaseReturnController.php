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
use App\Models\Warehouse;

use App\Models\Purchase;
use App\Models\Purchasedetail;
use App\Models\Purchasereturn;
use App\Models\Purchasereturndetail;
class PurchaseReturnController extends Controller
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

        if (is_null($this->user) || !$this->user->can('purchase_return_view')) {
            return redirect('/admin/logout_session');
        }

        $total_data = Purchasereturn::latest()->count();

        $total_serial_number1= $total_data/10;

        if (is_float($total_serial_number1)){
            $total_serial_number = ceil($total_serial_number1);

        }else{
            $total_serial_number = $total_serial_number1;
        }

        $purchase_list = Purchasereturn::latest()->limit(10)->get();

        return view('backend.purchase_return.index',compact('purchase_list','total_serial_number'));
    }

    public function create()
    {

        if (is_null($this->user) || !$this->user->can('purchase_return_add')) {
            //abort(403, 'Sorry !! You are Unauthorized to view Product List !');

             return redirect('/admin/logout_session');
        }


        $ware_house_list = Warehouse::latest()->get();

        $vendors = Vendor::latest()->get();
        $product_names = MainProduct::latest()->get();
        return view('backend.purchase_return.create', compact('vendors','product_names','ware_house_list'));

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


    $database_save = new Purchasereturn();
    $database_save->vendor_id = $request->vendor_name;
    $database_save->request_number = $request->request_number;
    $database_save->warehouse = $request->warehouse;
    $database_save->request_date = $request->request_date;
    $database_save->request_note = $request->request_note;


    $database_save->purchase_date = $request->purchase_date;
    $database_save->purchase_lot_number = $request->purchase_lot_number;


    $database_save->total_product = $request->total_product;
    $database_save->total_quantity = $request->total_quantity;
    $database_save->total_buy_price =$request->total_buy_price;
    //$database_save->request_delivery_date = $s_pay_date1;
    $database_save->term = $request->term;
    $database_save->status = 'inc';
    $database_save->save();


    $invoice_id = $database_save->id;






    $condition_main_product_id = $input['nmain_product_id'];

        foreach($condition_main_product_id as $key => $condition_main_product_id){
            $form= new Purchasereturndetail();
            $form->product_id=$input['nmain_product_id'][$key];
            $form->purchase_id=$invoice_id;
            $form->quantity=$input['p_quantity'][$key];
            $form->buy_price=$input['buying_price'][$key];
            $form->main_buy_price=$input['main_buying_price'][$key];
            $form->save();

            //first table quantity update


    }

    return redirect('admin/purchase_return_view/'.$invoice_id)->with('success','Created Successfully');

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


$database_save = Purchasereturn::find($request->id);
$database_save->vendor_id = $request->vendor_name;
$database_save->request_number = $request->request_number;
$database_save->warehouse = $request->warehouse;
$database_save->request_date = $request->request_date;
$database_save->request_note = $request->request_note;


    $database_save->purchase_date = $request->purchase_date;
    $database_save->purchase_lot_number = $request->purchase_lot_number;


    $database_save->total_product = $request->total_product;
    $database_save->total_quantity = $request->total_quantity;
    $database_save->total_buy_price =$request->total_buy_price;
   // $database_save->request_delivery_date = $s_pay_date1;
    $database_save->term = $request->term;
    $database_save->status = 'inc';
$database_save->save();


$invoice_id = $database_save->id;


$delete_id = Purchasereturndetail::where('purchase_id',$invoice_id)->delete();



$condition_main_product_id = $input['nmain_product_id'];

    foreach($condition_main_product_id as $key => $condition_main_product_id){
        $form= new Purchasereturndetail();
        $form->product_id=$input['nmain_product_id'][$key];
        $form->purchase_id=$invoice_id;
        $form->quantity=$input['p_quantity'][$key];
        $form->buy_price=$input['buying_price'][$key];
        $form->main_buy_price=$input['main_buying_price'][$key];
        $form->save();

        //first table quantity update



}

return redirect('admin/purchase_return_view/'.$invoice_id)->with('success','Created Successfully');
}


    public function view($id){

    $invoice =  Purchasereturn::where('id',$id)->first();
    $invoice_detail = Purchasereturndetail::where('purchase_id',$id)->get();



    return view('backend.purchase_return.view',compact('invoice','invoice_detail'));

}


public function edit($id){

    $invoice =  Purchasereturn::where('id',$id)->first();
    $invoice_detail = Purchasereturndetail::where('purchase_id',$id)->get();
    $vendors = Vendor::latest()->get();
    $product_names = MainProduct::latest()->get();

    $ware_house_list = Warehouse::latest()->get();

    return view('backend.purchase_return.edit',compact('ware_house_list','product_names','vendors','invoice','invoice_detail'));

}


public function get_buying_price_from_data(Request $request){


    $get_buying_price_value = MainProduct::where('id',$request->main_product_id)->value('buying_price');

      $data = $get_buying_price_value;
 return response()->json($data);
}


public function purchase_return_pagination_start(Request $request){


    $id_for_pass = $request->id_for_pass;


    if($id_for_pass == 1){

        $total_data =Purchasereturn::latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $product_list = Purchasereturn::latest()->limit(10)->get();
        $minus_one = 0;
    }else{
        $total_data = Purchasereturn::latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $minus_one = ($id_for_pass - 1)*10;

        $product_list = Purchasereturn::latest()->skip($minus_one)->take(10)->get();
    }

    $data = view('backend.purchase_return.purchase_return_pagination_start',compact('minus_one','product_list','total_serial_number','id_for_pass'))->render();
            return response()->json(['options'=>$data]);


}


public function purchase_return_pagination_start_delete(Request $request){

    $update_data = Purchasereturn::whereIn('id',$request->numberOfSubChecked)->delete();




$total_data = Purchasereturn::latest()->count();

$total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
 $total_serial_number = ceil($total_serial_number1);

}else{
 $total_serial_number = $total_serial_number1;
}

//dd($total_serial_number);

 $product_list = Purchasereturn::latest()->limit(10)->get();



$data = view('backend.purchase_return.purchase_return_pagination_start_delete',compact('product_list','total_serial_number'))->render();
return response()->json(['options'=>$data]);
}


public function purchase_return_pagination_start_search(Request $request){


    $search_value = $request->search_value;



    $total_data = Purchasereturn::Where('vendor_id','LIKE','%'.$search_value.'%')
    ->orWhere('request_number','LIKE','%'.$search_value.'%')
    ->orWhere('warehouse','LIKE','%'.$search_value.'%')
    ->orWhere('purchase_lot_number','LIKE','%'.$search_value.'%')
    ->orWhere('request_note','LIKE','%'.$search_value.'%')
    ->orWhere('purchase_date','LIKE','%'.$search_value.'%')
    ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->count();

        $total_serial_number1= $total_data/10;

        if (is_float($total_serial_number1)){
            $total_serial_number = ceil($total_serial_number1);

        }else{
            $total_serial_number = $total_serial_number1;
        }

         //dd($total_serial_number);

            $product_list = Purchasereturn::Where('vendor_id','LIKE','%'.$search_value.'%')
            ->orWhere('request_number','LIKE','%'.$search_value.'%')
            ->orWhere('warehouse','LIKE','%'.$search_value.'%')
            ->orWhere('purchase_lot_number','LIKE','%'.$search_value.'%')
            ->orWhere('request_note','LIKE','%'.$search_value.'%')
            ->orWhere('purchase_date','LIKE','%'.$search_value.'%')
            ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();

            $data = view('backend.purchase_return.purchase_return_pagination_start_search',compact('search_value','product_list','total_serial_number'))->render();
            return response()->json(['options'=>$data]);


}


public function purchase_return_pagination_start_search_ajax(Request $request){


    $search_value = $request->search_value;

    $id_for_pass = $request->id_for_pass;



    if($id_for_pass == 1){

        $total_data =Purchasereturn::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('warehouse','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_lot_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $product_list = Purchasereturn::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('warehouse','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_lot_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();
        $minus_one = 0;
    }else{
        $total_data = Purchasereturn::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('warehouse','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_lot_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $minus_one = ($id_for_pass - 1)*10;

        $product_list = Purchasereturn::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('warehouse','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_lot_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('purchase_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')
        ->latest()->skip($minus_one)->take(10)->get();
    }
    $data = view('backend.purchase_return.purchase_return_pagination_start_search_ajax',compact('id_for_pass','minus_one','search_value','product_list','total_serial_number'))->render();
            return response()->json(['options'=>$data]);


}
}
