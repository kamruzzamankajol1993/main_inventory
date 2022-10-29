<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Purchase;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class VendorController extends Controller
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

        if (is_null($this->user) || !$this->user->can('vendor_view')) {
            return redirect('/admin/logout_session');
        }


        $total_data = Vendor::latest()->count();

        $total_serial_number1= $total_data/10;

        if (is_float($total_serial_number1)){
            $total_serial_number = ceil($total_serial_number1);

        }else{
            $total_serial_number = $total_serial_number1;
        }

        //$brand_list = Brand::latest()->limit(10)->get();

        $vendor_infromation = Vendor::latest()->limit(10)->get();
$admin_list = Admin::latest()->get();
        return view('backend.vendor.index',compact('admin_list','vendor_infromation','total_serial_number'));
    }


    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('vendor_add')) {
            abort(403, 'Sorry !! You are Unauthorized to add any data !');
        }
// dd(11);

        $category_list = new Vendor();
        $category_list->name = $request->name;
        $category_list->address = $request->address;
        $category_list->company_name = $request->company_name;
        $category_list->phone_number = $request->phone_number;
        $category_list->email = $request->email;
        $category_list->city = $request->city;
        $category_list->postal_code = $request->postal_code;
        $category_list->country = $request->country;
        $category_list->taxid = $request->taxid;
        $category_list->status = $request->status;
        $category_list->save();


        return redirect()->back()->with('success','Created Successfully');

    }


    public function update(Request $request){
        if (is_null($this->user) || !$this->user->can('vendor_update')) {
            abort(403, 'Sorry !! You are Unauthorized to update any data !');
        }

        $category_list = Vendor::find($request->id);
        $category_list->name = $request->name;
        $category_list->address = $request->address;
        $category_list->company_name = $request->company_name;
        $category_list->phone_number = $request->phone_number;
        $category_list->email = $request->email;
        $category_list->city = $request->city;
        $category_list->postal_code = $request->postal_code;
        $category_list->country = $request->country;
        $category_list->taxid = $request->taxid;
        $category_list->status = $request->status;
        $category_list->save();


        return redirect()->back()->with('info','Updated Successfully');

    }

    public function delete($id)
    {
        //dd(1);
        if (is_null($this->user) || !$this->user->can('vendor_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any data !');
        }
        $admins = Vendor::find($id);
        if (!is_null($admins)) {
            $admins->delete();
        }


        return back()->with('error','Deleted successfully!');
    }


    public function vendor_pagination_start(Request $request){


        $id_for_pass = $request->id_for_pass;


        if($id_for_pass == 1){

            $total_data =Vendor::latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $product_list = Vendor::latest()->limit(10)->get();
            $minus_one = 0;
        }else{
            $total_data = Vendor::latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $minus_one = ($id_for_pass - 1)*10;

            $product_list = Vendor::latest()->skip($minus_one)->take(10)->get();
        }

        $data = view('backend.vendor.vendor_pagination_start',compact('minus_one','product_list','total_serial_number','id_for_pass'))->render();
                return response()->json(['options'=>$data]);


    }


    public function vendor_pagination_start_delete(Request $request){

        $update_data = Vendor::whereIn('id',$request->numberOfSubChecked)->delete();




 $total_data = Vendor::latest()->count();

 $total_serial_number1= $total_data/10;

 if (is_float($total_serial_number1)){
     $total_serial_number = ceil($total_serial_number1);

 }else{
     $total_serial_number = $total_serial_number1;
 }

  //dd($total_serial_number);

     $product_list = Vendor::latest()->limit(10)->get();



$data = view('backend.vendor.vendor_pagination_start_delete',compact('product_list','total_serial_number'))->render();
return response()->json(['options'=>$data]);
    }


    public function vendor_pagination_start_search(Request $request){


        $search_value = $request->search_value;



        $total_data = Vendor::Where('name','LIKE','%'.$search_value.'%')
        ->orWhere('address','LIKE','%'.$search_value.'%')
        ->orWhere('phone_number','LIKE','%'.$search_value.'%')
        ->orWhere('company_name','LIKE','%'.$search_value.'%')
        ->orWhere('email','LIKE','%'.$search_value.'%')
        ->orWhere('postal_code','LIKE','%'.$search_value.'%')
        ->orWhere('country','LIKE','%'.$search_value.'%')->latest()->count();

            $total_serial_number1= $total_data/10;

            if (is_float($total_serial_number1)){
                $total_serial_number = ceil($total_serial_number1);

            }else{
                $total_serial_number = $total_serial_number1;
            }

             //dd($total_serial_number);

                $product_list = Vendor::Where('name','LIKE','%'.$search_value.'%')
                ->orWhere('address','LIKE','%'.$search_value.'%')
                ->orWhere('phone_number','LIKE','%'.$search_value.'%')
                ->orWhere('company_name','LIKE','%'.$search_value.'%')
                ->orWhere('email','LIKE','%'.$search_value.'%')
                ->orWhere('postal_code','LIKE','%'.$search_value.'%')
                ->orWhere('country','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();

                $data = view('backend.vendor.vendor_pagination_start_search',compact('search_value','product_list','total_serial_number'))->render();
                return response()->json(['options'=>$data]);


    }


    public function vendor_pagination_start_search_ajax(Request $request){


        $search_value = $request->search_value;

        $id_for_pass = $request->id_for_pass;



        if($id_for_pass == 1){

            $total_data =Vendor::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')
            ->orWhere('phone_number','LIKE','%'.$search_value.'%')
            ->orWhere('company_name','LIKE','%'.$search_value.'%')
            ->orWhere('email','LIKE','%'.$search_value.'%')
            ->orWhere('postal_code','LIKE','%'.$search_value.'%')
            ->orWhere('country','LIKE','%'.$search_value.'%')->latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $product_list = Vendor::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')
            ->orWhere('phone_number','LIKE','%'.$search_value.'%')
            ->orWhere('company_name','LIKE','%'.$search_value.'%')
            ->orWhere('email','LIKE','%'.$search_value.'%')
            ->orWhere('postal_code','LIKE','%'.$search_value.'%')
            ->orWhere('country','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();
            $minus_one = 0;
        }else{
            $total_data = Vendor::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')
            ->orWhere('phone_number','LIKE','%'.$search_value.'%')
            ->orWhere('company_name','LIKE','%'.$search_value.'%')
            ->orWhere('email','LIKE','%'.$search_value.'%')
            ->orWhere('postal_code','LIKE','%'.$search_value.'%')
            ->orWhere('country','LIKE','%'.$search_value.'%')->latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $minus_one = ($id_for_pass - 1)*10;

            $product_list = Vendor::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')
            ->orWhere('phone_number','LIKE','%'.$search_value.'%')
            ->orWhere('company_name','LIKE','%'.$search_value.'%')
            ->orWhere('email','LIKE','%'.$search_value.'%')
            ->orWhere('postal_code','LIKE','%'.$search_value.'%')
            ->orWhere('country','LIKE','%'.$search_value.'%')
            ->latest()->skip($minus_one)->take(10)->get();
        }
        $data = view('backend.vendor.vendor_pagination_start_search_ajax',compact('id_for_pass','minus_one','search_value','product_list','total_serial_number'))->render();
                return response()->json(['options'=>$data]);


    }


    public function view($id)
    {
        $vendors = Vendor::where('id', '=', $id)->get();
        $total_amount = Purchase::where('vendor_id', '=', $id)->sum('total_buy_price');
        $total_paid = Purchase::where('vendor_id', '=', $id)->sum('total_paid');
        $total_due = Purchase::where('vendor_id', '=', $id)->sum('total_due');

        $buy_lists = Purchase::where('vendor_id', '=', $id)->get();
//        $total_buy = PurchaseProduct::where()
        return view('backend.vendor.view', compact('vendors', 'buy_lists', 'total_due', 'total_paid', 'total_amount'));
    }
}
