<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Category;
use App\Models\SupplierCategory;
use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Http\Requests;
use DB;
use Validator;
use Response;
use Redirect;
class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    public function index()
    {
    	if(!Core::setConnection())
        {
            return redirect()->intended('login');
        }


    	return view('supplier.index');
    }

    public function create()
    {
      if(!Core::setConnection())
            return redirect()->intended('login');

        $categories = Category::get();
        return view("supplier.create", compact('categories'));
    }

    public function store(Request $req)
    {
    	Core::setConnection();
        $validate = Validator::make($req->all(), Supplier::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $supplier = Supplier::create($req->all());
        if($supplier) {
            return Response::json(['status'=>true,'message' => "Successfully created!"]);
        }
        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function supplier_list(Request $req)
    {
    	Core::setConnection();

      $start = $req->offset;
      $limit = $req->limit;
      $search = @$req->searchStr;
      $sql =  Supplier::whereRaw("supplier_name LIKE ('%".$search."%') OR contact_person LIKE ('%".$search."%')");
      $total = $sql->count();
      $list = $sql->skip($start)->take($limit)->get();

      $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['supplier_id']."' href='javascript:void(0)' title='Edit Supplier' class='supplier-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        $action .= "<a data-id='".$row['supplier_id']."' href='javascript:void(0)' title='Delete Supplier' class='supplier-delete text-danger ml-5'><i class='fa fa-times-circle' aria-hidden='true'></i></i></a>";
        $action .= "</div>";
        return [
            'action' => $action,
            'supplier_name' => $row['supplier_name'],
            'contact_person' => $row['contact_person']
          ];
      },$list->toArray());
      return response()->json(['total'=>$total,'rows'=>$rows]);
    }

    public function edit($id)
    {
        Core::setConnection();
        $supplier = Supplier::find($id);
        $mylist = [];
        foreach ($supplier->category as $key) {
            array_push($mylist,$key->pivot->category_id);
        }

        $categories = Category::get();
        return view('supplier.edit',compact('supplier','categories','mylist'));
    }

    public function update(Request $request,$id)
    {
        Core::setConnection();
        $jdata['status'] = false;
        $jdata['message'] = "Error in updating, Please contact the administrator";

        $validate = Validator::make($request->all(), self::rules($id));
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $supplier = Supplier::find($id);
        $supplier->supplier_name = $request->supplier_name;
        $supplier->contact_person = $request->contact_person;
        $supplier->mobile1_no = $request->mobile1_no;
        $supplier->mobile2_no = $request->mobile2_no;
        $supplier->landline_no = $request->landline_no;
        $supplier->email = $request->email;
        $supplier->notes = $request->notes;
        $supplier->lock = (isset($request->lock))?1:0;
        $supplier->suspended = (isset($request->suspended))?1:0;
        if($supplier->save())
        {
            if(count($request->category) > 0){
                $supplier->category()->detach();
                foreach ($request->category as $val) {
                   $supplier->category()->attach($val);
                }
            }
            $jdata['status'] = true;
            $jdata['message'] = "Successfully updated!";

        }


        return $jdata;
    }

    private function rules($param)
    {
        return [
               'supplier_name' => 'required|unique:supplier,supplier_name,'.$param.',supplier_id',
               'email' => 'email'
            ];
    }
}
