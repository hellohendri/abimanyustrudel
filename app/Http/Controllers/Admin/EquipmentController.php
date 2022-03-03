<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Equipment;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EquipmentRequest;
use Gate;

class EquipmentController extends Controller
{

    public function index()
    {
        if (Gate::none(['equipment_allow', 'equipment_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "equipment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        
        $tableData = Equipment::orderByDesc("id")->get();
        return view("admin.equipment.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['equipment_allow'])) {
            return redirect(route("admin.equipment.index"));
        }
        $admiko_data['sideBarActive'] = "equipment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.equipment.store");
        
        
        return view("admin.equipment.manage")->with(compact('admiko_data'));
    }

    public function store(EquipmentRequest $request)
    {
        if (Gate::none(['equipment_allow'])) {
            return redirect(route("admin.equipment.index"));
        }
        $data = $request->all();
        
        $Equipment = Equipment::create($data);
        
        return redirect(route("admin.equipment.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Equipment = Equipment::find($id);
        if (Gate::none(['equipment_allow', 'equipment_edit']) || !$Equipment) {
            return redirect(route("admin.equipment.index"));
        }

        $admiko_data['sideBarActive'] = "equipment";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.equipment.update", [$Equipment->id]);
        
        
        $data = $Equipment;
        return view("admin.equipment.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(EquipmentRequest $request,$id)
    {
        if (Gate::none(['equipment_allow', 'equipment_edit'])) {
            return redirect(route("admin.equipment.index"));
        }
        $data = $request->all();
        $Equipment = Equipment::find($id);
        $Equipment->update($data);
        
        return redirect(route("admin.equipment.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['equipment_allow'])) {
            return redirect(route("admin.equipment.index"));
        }
        Equipment::destroy($request->idDel);
        return back();
    }
    
    
    
}
