<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
class StoreController extends Controller
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

        if (is_null($this->user) || !$this->user->can('store_view')) {
            return redirect('/admin/logout_session');
        }


        $total_data = Store::latest()->count();

        $total_serial_number1= $total_data/10;

        if (is_float($total_serial_number1)){
            $total_serial_number = ceil($total_serial_number1);

        }else{
            $total_serial_number = $total_serial_number1;
        }

        //$brand_list = Brand::latest()->limit(10)->get();

        $store_infromation = Store::latest()->limit(10)->get();
$admin_list = Admin::latest()->get();
        return view('backend.store.index',compact('admin_list','store_infromation','total_serial_number'));
    }


    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('store_add')) {
            abort(403, 'Sorry !! You are Unauthorized to add any data !');
        }
// dd(11);

        $category_list = new Store();
        $category_list->name = $request->name;
        $category_list->address = $request->address;
        $category_list->incharge = $request->incharge;

        $category_list->save();


        return redirect()->back()->with('success','Created Successfully');

    }


    public function update(Request $request){
        if (is_null($this->user) || !$this->user->can('store_update')) {
            abort(403, 'Sorry !! You are Unauthorized to update any data !');
        }

        $category_list = Store::find($request->id);
        $category_list->name = $request->name;
        $category_list->address = $request->address;
        $category_list->incharge = $request->incharge;

        $category_list->save();


        return redirect()->back()->with('info','Updated Successfully');

    }

    public function delete($id)
    {
        //dd(1);
        if (is_null($this->user) || !$this->user->can('store_delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any data !');
        }
        $admins = Store::find($id);
        if (!is_null($admins)) {
            $admins->delete();
        }


        return back()->with('error','Deleted successfully!');
    }


    public function store_pagination_start(Request $request){


        $id_for_pass = $request->id_for_pass;


        if($id_for_pass == 1){

            $total_data =Store::latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $product_list = Store::latest()->limit(10)->get();
            $minus_one = 0;
        }else{
            $total_data = Store::latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $minus_one = ($id_for_pass - 1)*10;

            $product_list = Store::latest()->skip($minus_one)->take(10)->get();
        }

        $data = view('backend.store.store_pagination_start',compact('minus_one','product_list','total_serial_number','id_for_pass'))->render();
                return response()->json(['options'=>$data]);


    }


    public function store_pagination_start_delete(Request $request){

        $update_data = Store::whereIn('id',$request->numberOfSubChecked)->delete();




 $total_data = Store::latest()->count();

 $total_serial_number1= $total_data/10;

 if (is_float($total_serial_number1)){
     $total_serial_number = ceil($total_serial_number1);

 }else{
     $total_serial_number = $total_serial_number1;
 }

  //dd($total_serial_number);

     $product_list = Store::latest()->limit(10)->get();



$data = view('backend.store.store_pagination_start_delete',compact('product_list','total_serial_number'))->render();
return response()->json(['options'=>$data]);
    }


    public function store_pagination_start_search(Request $request){


        $search_value = $request->search_value;



        $total_data = Store::Where('name','LIKE','%'.$search_value.'%')
        ->orWhere('address','LIKE','%'.$search_value.'%')->orWhere('incharge','LIKE','%'.$search_value.'%')->latest()->count();

            $total_serial_number1= $total_data/10;

            if (is_float($total_serial_number1)){
                $total_serial_number = ceil($total_serial_number1);

            }else{
                $total_serial_number = $total_serial_number1;
            }

             //dd($total_serial_number);

                $product_list = Store::Where('name','LIKE','%'.$search_value.'%')
                ->orWhere('address','LIKE','%'.$search_value.'%')->orWhere('incharge','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();

                $data = view('backend.store.store_pagination_start_search',compact('search_value','product_list','total_serial_number'))->render();
                return response()->json(['options'=>$data]);


    }


    public function store_pagination_start_search_ajax(Request $request){


        $search_value = $request->search_value;

        $id_for_pass = $request->id_for_pass;



        if($id_for_pass == 1){

            $total_data =Store::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')->orWhere('incharge','LIKE','%'.$search_value.'%')->latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $product_list = Store::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')->orWhere('incharge','LIKE','%'.$search_value.'%')->latest()->limit(10)->get();
            $minus_one = 0;
        }else{
            $total_data = Store::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')->orWhere('incharge','LIKE','%'.$search_value.'%')->latest()->count();
            $total_serial_number1= $total_data/10;

    if (is_float($total_serial_number1)){
        $total_serial_number = ceil($total_serial_number1);

    }else{
        $total_serial_number = $total_serial_number1;
    }
            $minus_one = ($id_for_pass - 1)*10;

            $product_list = Store::Where('name','LIKE','%'.$search_value.'%')
            ->orWhere('address','LIKE','%'.$search_value.'%')->orWhere('incharge','LIKE','%'.$search_value.'%')->latest()->skip($minus_one)->take(10)->get();
        }
        $data = view('backend.store.store_pagination_start_search_ajax',compact('id_for_pass','minus_one','search_value','product_list','total_serial_number'))->render();
                return response()->json(['options'=>$data]);


    }
}
