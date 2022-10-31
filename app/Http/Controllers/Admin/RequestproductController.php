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
use App\Models\Requestproduct;
use App\Models\Requestproductdetail;
class RequestproductController extends Controller
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

        if (is_null($this->user) || !$this->user->can('request_product_view')) {
            return redirect('/admin/logout_session');
        }

        $total_data = Requestproduct::latest()->count();

        $total_serial_number1= $total_data/10;

        if (is_float($total_serial_number1)){
            $total_serial_number = ceil($total_serial_number1);

        }else{
            $total_serial_number = $total_serial_number1;
        }

        $request_product_list = Requestproduct::latest()->limit(10)->get();

        return view('backend.request_product.index',compact('request_product_list','total_serial_number'));
    }


    public function create()
    {

        if (is_null($this->user) || !$this->user->can('request_product_add')) {
            //abort(403, 'Sorry !! You are Unauthorized to view Product List !');

             return redirect('/admin/logout_session');
        }

        $vendors = Vendor::latest()->get();
        $product_names = MainProduct::latest()->get();
        return view('backend.request_product.create', compact('vendors','product_names'));

    }


    public function get_vendor_for_request_and_purchase(Request $request){

        $main_value = $request->main_value;

        if($main_value == 'Add New Vendor'){
            $vendor_detail = '';

        }else{
            $vendor_detail = Vendor::where('name',$request->main_value)->first();
        }



        $data = view('backend.request_product.get_vendor_for_request_and_purchase',compact('vendor_detail','main_value'))->render();
        return response()->json($data);


    }

    public function store(Request $request){

        if (is_null($this->user) || !$this->user->can('request_product_add')) {
            abort(403, 'Sorry !! You are Unauthorized to add any product !');

             //return redirect('/admin/logout_session');
        }


        $input = $request->all();

        $s_pay_date = date("Y-m-d", strtotime($request->pay_date));

        $s_pay_date1 = date("Y-m-d", strtotime($request->request_delivery_date));
        //dd($input);


    $database_save = new Requestproduct();
    $database_save->vendor_id = $request->vendor_name;
    $database_save->request_number = $request->order_id;
    $database_save->request_date = $s_pay_date;
    $database_save->request_note = $request->request_note;
    $database_save->total_product = $request->total_product;
    $database_save->total_quantity = $request->total_quantity;
    $database_save->urgent =$request->urgent_type;
    $database_save->request_delivery_date = $s_pay_date1;
    $database_save->term = $request->payment_term;
    $database_save->status = 'inc';
    $database_save->save();


    $invoice_id = $database_save->id;






    $condition_main_product_id = $input['nmain_product_id'];

        foreach($condition_main_product_id as $key => $condition_main_product_id){
            $form= new Requestproductdetail();
            $form->product_id=$input['nmain_product_id'][$key];
            $form->request_id=$invoice_id;
            $form->quantity=$input['p_quantity'][$key];
            $form->save();

            //first table quantity update



    }
    return redirect('admin/request_product_view/'.$invoice_id)->with('success','Created Successfully');
}


public function update(Request $request){



    if (is_null($this->user) || !$this->user->can('request_product_update')) {
        abort(403, 'Sorry !! You are Unauthorized to add any product !');

         //return redirect('/admin/logout_session');
    }


    $input = $request->all();

    $s_pay_date = date("Y-m-d", strtotime($request->pay_date));

    $s_pay_date1 = date("Y-m-d", strtotime($request->request_delivery_date));
    //dd($input);


$database_save = Requestproduct::find($request->id);
$database_save->vendor_id = $request->vendor_name;
$database_save->request_number = $request->order_id;
$database_save->request_date = $s_pay_date;
$database_save->request_note = $request->request_note;
$database_save->total_product = $request->total_product;
$database_save->total_quantity = $request->total_quantity;
$database_save->urgent =$request->urgent_type;
$database_save->request_delivery_date = $s_pay_date1;
$database_save->term = $request->payment_term;
$database_save->status = 'inc';
$database_save->save();


$invoice_id = $database_save->id;


$delete_id = Requestproductdetail::where('request_id',$invoice_id)->delete();



$condition_main_product_id = $input['nmain_product_id'];

    foreach($condition_main_product_id as $key => $condition_main_product_id){
        $form= new Requestproductdetail();
        $form->product_id=$input['nmain_product_id'][$key];
        $form->request_id=$invoice_id;
        $form->quantity=$input['p_quantity'][$key];
        $form->save();

        //first table quantity update


}
return redirect('admin/request_product_view/'.$invoice_id)->with('success','Created Successfully');


}


public function view($id){

    $invoice =  Requestproduct::where('id',$id)->first();
    $invoice_detail = Requestproductdetail::where('request_id',$id)->get();



    return view('backend.request_product.view',compact('invoice','invoice_detail'));

}


public function edit($id){

    $invoice =  Requestproduct::where('id',$id)->first();
    $invoice_detail = Requestproductdetail::where('request_id',$id)->get();
    $vendors = Vendor::latest()->get();
    $product_names = MainProduct::latest()->get();

    return view('backend.request_product.edit',compact('product_names','vendors','invoice','invoice_detail'));

}


public function request_product_pagination_start(Request $request){


    $id_for_pass = $request->id_for_pass;


    if($id_for_pass == 1){

        $total_data =Requestproduct::latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $product_list = Requestproduct::latest()->limit(10)->get();
        $minus_one = 0;
    }else{
        $total_data = Requestproduct::latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $minus_one = ($id_for_pass - 1)*10;

        $product_list = Requestproduct::latest()->skip($minus_one)->take(10)->get();
    }

    $data = view('backend.request_product.request_product_pagination_start',compact('minus_one','product_list','total_serial_number','id_for_pass'))->render();
            return response()->json(['options'=>$data]);


}


public function request_product_pagination_start_delete(Request $request){

    $update_data = Requestproduct::whereIn('id',$request->numberOfSubChecked)->delete();




$total_data = Requestproduct::latest()->count();

$total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
 $total_serial_number = ceil($total_serial_number1);

}else{
 $total_serial_number = $total_serial_number1;
}

//dd($total_serial_number);

 $product_list = Requestproduct::latest()->limit(10)->get();



$data = view('backend.request_product.request_product_pagination_start_delete',compact('product_list','total_serial_number'))->render();
return response()->json(['options'=>$data]);
}


public function request_product_pagination_start_search(Request $request){


    $search_value = $request->search_value;



    $total_data = Requestproduct::Where('vendor_id','LIKE','%'.$search_value.'%')
    ->orWhere('request_number','LIKE','%'.$search_value.'%')
    ->orWhere('request_date','LIKE','%'.$search_value.'%')
    ->orWhere('urgent','LIKE','%'.$search_value.'%')
    ->orWhere('request_note','LIKE','%'.$search_value.'%')
    ->orWhere('request_delivery_date','LIKE','%'.$search_value.'%')
    ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->count();

        $total_serial_number1= $total_data/10;

        if (is_float($total_serial_number1)){
            $total_serial_number = ceil($total_serial_number1);

        }else{
            $total_serial_number = $total_serial_number1;
        }

         //dd($total_serial_number);

            $product_list = Requestproduct::Where('vendor_id','LIKE','%'.$search_value.'%')
            ->orWhere('request_number','LIKE','%'.$search_value.'%')
            ->orWhere('request_date','LIKE','%'.$search_value.'%')
            ->orWhere('urgent','LIKE','%'.$search_value.'%')
            ->orWhere('request_note','LIKE','%'.$search_value.'%')
            ->orWhere('request_delivery_date','LIKE','%'.$search_value.'%')
            ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();

            $data = view('backend.request_product.request_product_pagination_start_search',compact('search_value','product_list','total_serial_number'))->render();
            return response()->json(['options'=>$data]);


}


public function request_product_pagination_start_search_ajax(Request $request){


    $search_value = $request->search_value;

    $id_for_pass = $request->id_for_pass;



    if($id_for_pass == 1){

        $total_data =Requestproduct::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_date','LIKE','%'.$search_value.'%')
        ->orWhere('urgent','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('request_delivery_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $product_list = Requestproduct::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_date','LIKE','%'.$search_value.'%')
        ->orWhere('urgent','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('request_delivery_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();
        $minus_one = 0;
    }else{
        $total_data = Requestproduct::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_date','LIKE','%'.$search_value.'%')
        ->orWhere('urgent','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('request_delivery_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')->latest()->count();
        $total_serial_number1= $total_data/10;

if (is_float($total_serial_number1)){
    $total_serial_number = ceil($total_serial_number1);

}else{
    $total_serial_number = $total_serial_number1;
}
        $minus_one = ($id_for_pass - 1)*10;

        $product_list = Requestproduct::Where('vendor_id','LIKE','%'.$search_value.'%')
        ->orWhere('request_number','LIKE','%'.$search_value.'%')
        ->orWhere('request_date','LIKE','%'.$search_value.'%')
        ->orWhere('urgent','LIKE','%'.$search_value.'%')
        ->orWhere('request_note','LIKE','%'.$search_value.'%')
        ->orWhere('request_delivery_date','LIKE','%'.$search_value.'%')
        ->orWhere('term','LIKE','%'.$search_value.'%')
        ->latest()->skip($minus_one)->take(10)->get();
    }
    $data = view('backend.request_product.request_product_pagination_start_search_ajax',compact('id_for_pass','minus_one','search_value','product_list','total_serial_number'))->render();
            return response()->json(['options'=>$data]);


}
}
