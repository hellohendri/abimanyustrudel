<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Warehouse;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\WarehouseRequest;
use Gate;
use App\Models\Admin\Product;
use App\Models\Admin\Outlets;

class WarehouseController extends Controller
{

    public function index()
    {
        if (Gate::none(['warehouse_allow', 'warehouse_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "warehouse";
		$admiko_data["sideBarActiveFolder"] = "";
        
        $tableData = Warehouse::orderByDesc("id")->get();
        return view("admin.warehouse.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['warehouse_allow'])) {
            return redirect(route("admin.warehouse.index"));
        }
        $admiko_data['sideBarActive'] = "warehouse";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.warehouse.store");
        
        
		$product_all = Product::all()->sortBy("nama")->pluck("nama", "id");
		$outlets_all = Outlets::all()->sortBy("nama_outlet")->pluck("nama_outlet", "id");
        return view("admin.warehouse.manage")->with(compact('admiko_data','product_all','outlets_all'));
    }

    public function store(WarehouseRequest $request)
    {
        if (Gate::none(['warehouse_allow'])) {
            return redirect(route("admin.warehouse.index"));
        }
        $data = $request->all();
        
        $Warehouse = Warehouse::create($data);
        
        return redirect(route("admin.warehouse.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Warehouse = Warehouse::find($id);
        if (Gate::none(['warehouse_allow', 'warehouse_edit']) || !$Warehouse) {
            return redirect(route("admin.warehouse.index"));
        }

        $admiko_data['sideBarActive'] = "warehouse";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.warehouse.update", [$Warehouse->id]);
        
        
		$product_all = Product::all()->sortBy("nama")->pluck("nama", "id");
		$outlets_all = Outlets::all()->sortBy("nama_outlet")->pluck("nama_outlet", "id");
        $data = $Warehouse;
        return view("admin.warehouse.manage")->with(compact('admiko_data', 'data','product_all','outlets_all'));
    }

    public function update(WarehouseRequest $request,$id)
    {
        if (Gate::none(['warehouse_allow', 'warehouse_edit'])) {
            return redirect(route("admin.warehouse.index"));
        }
        $data = $request->all();
        $Warehouse = Warehouse::find($id);
        $Warehouse->update($data);
        
        return redirect(route("admin.warehouse.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['warehouse_allow'])) {
            return redirect(route("admin.warehouse.index"));
        }
        Warehouse::destroy($request->idDel);
        return back();
    }
    
    
    
}
