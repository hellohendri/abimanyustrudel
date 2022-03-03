<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProductionHistory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductionHistoryRequest;
use Gate;
use App\Models\Admin\ProductCategory;

class ProductionHistoryController extends Controller
{

    public function index()
    {
        if (Gate::none(['production_history_allow', 'production_history_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "production_history";
		$admiko_data["sideBarActiveFolder"] = "";
        
        $tableData = ProductionHistory::orderByDesc("id")->get();
        return view("admin.production_history.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['production_history_allow'])) {
            return redirect(route("admin.production_history.index"));
        }
        $admiko_data['sideBarActive'] = "production_history";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.production_history.store");
        
        
		$product_category_all = ProductCategory::all()->sortBy("jenis_roti")->pluck("jenis_roti", "id");
        return view("admin.production_history.manage")->with(compact('admiko_data','product_category_all'));
    }

    public function store(ProductionHistoryRequest $request)
    {
        if (Gate::none(['production_history_allow'])) {
            return redirect(route("admin.production_history.index"));
        }
        $data = $request->all();
        
        $ProductionHistory = ProductionHistory::create($data);
        
        return redirect(route("admin.production_history.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $ProductionHistory = ProductionHistory::find($id);
        if (Gate::none(['production_history_allow', 'production_history_edit']) || !$ProductionHistory) {
            return redirect(route("admin.production_history.index"));
        }

        $admiko_data['sideBarActive'] = "production_history";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.production_history.update", [$ProductionHistory->id]);
        
        
		$product_category_all = ProductCategory::all()->sortBy("jenis_roti")->pluck("jenis_roti", "id");
        $data = $ProductionHistory;
        return view("admin.production_history.manage")->with(compact('admiko_data', 'data','product_category_all'));
    }

    public function update(ProductionHistoryRequest $request,$id)
    {
        if (Gate::none(['production_history_allow', 'production_history_edit'])) {
            return redirect(route("admin.production_history.index"));
        }
        $data = $request->all();
        $ProductionHistory = ProductionHistory::find($id);
        $ProductionHistory->update($data);
        
        return redirect(route("admin.production_history.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['production_history_allow'])) {
            return redirect(route("admin.production_history.index"));
        }
        ProductionHistory::destroy($request->idDel);
        return back();
    }
    
    
    
}
