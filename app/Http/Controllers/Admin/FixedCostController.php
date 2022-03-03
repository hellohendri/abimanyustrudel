<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\FixedCost;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FixedCostRequest;
use Gate;

class FixedCostController extends Controller
{

    public function index()
    {
        if (Gate::none(['fixed_cost_allow', 'fixed_cost_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "fixed_cost";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        
        $tableData = FixedCost::orderByDesc("id")->get();
        return view("admin.fixed_cost.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['fixed_cost_allow'])) {
            return redirect(route("admin.fixed_cost.index"));
        }
        $admiko_data['sideBarActive'] = "fixed_cost";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.fixed_cost.store");
        
        
        return view("admin.fixed_cost.manage")->with(compact('admiko_data'));
    }

    public function store(FixedCostRequest $request)
    {
        if (Gate::none(['fixed_cost_allow'])) {
            return redirect(route("admin.fixed_cost.index"));
        }
        $data = $request->all();
        
        $FixedCost = FixedCost::create($data);
        
        return redirect(route("admin.fixed_cost.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $FixedCost = FixedCost::find($id);
        if (Gate::none(['fixed_cost_allow', 'fixed_cost_edit']) || !$FixedCost) {
            return redirect(route("admin.fixed_cost.index"));
        }

        $admiko_data['sideBarActive'] = "fixed_cost";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.fixed_cost.update", [$FixedCost->id]);
        
        
        $data = $FixedCost;
        return view("admin.fixed_cost.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(FixedCostRequest $request,$id)
    {
        if (Gate::none(['fixed_cost_allow', 'fixed_cost_edit'])) {
            return redirect(route("admin.fixed_cost.index"));
        }
        $data = $request->all();
        $FixedCost = FixedCost::find($id);
        $FixedCost->update($data);
        
        return redirect(route("admin.fixed_cost.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['fixed_cost_allow'])) {
            return redirect(route("admin.fixed_cost.index"));
        }
        FixedCost::destroy($request->idDel);
        return back();
    }
    
    
    
}
