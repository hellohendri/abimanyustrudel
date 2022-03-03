<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\RawMaterial;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\RawMaterialRequest;
use Gate;

class RawMaterialController extends Controller
{

    public function index()
    {
        if (Gate::none(['raw_material_allow', 'raw_material_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "raw_material";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        
        $tableData = RawMaterial::orderByDesc("id")->get();
        return view("admin.raw_material.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['raw_material_allow'])) {
            return redirect(route("admin.raw_material.index"));
        }
        $admiko_data['sideBarActive'] = "raw_material";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.raw_material.store");
        
        
        return view("admin.raw_material.manage")->with(compact('admiko_data'));
    }

    public function store(RawMaterialRequest $request)
    {
        if (Gate::none(['raw_material_allow'])) {
            return redirect(route("admin.raw_material.index"));
        }
        $data = $request->all();
        
        $RawMaterial = RawMaterial::create($data);
        
        return redirect(route("admin.raw_material.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $RawMaterial = RawMaterial::find($id);
        if (Gate::none(['raw_material_allow', 'raw_material_edit']) || !$RawMaterial) {
            return redirect(route("admin.raw_material.index"));
        }

        $admiko_data['sideBarActive'] = "raw_material";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.raw_material.update", [$RawMaterial->id]);
        
        
        $data = $RawMaterial;
        return view("admin.raw_material.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(RawMaterialRequest $request,$id)
    {
        if (Gate::none(['raw_material_allow', 'raw_material_edit'])) {
            return redirect(route("admin.raw_material.index"));
        }
        $data = $request->all();
        $RawMaterial = RawMaterial::find($id);
        $RawMaterial->update($data);
        
        return redirect(route("admin.raw_material.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['raw_material_allow'])) {
            return redirect(route("admin.raw_material.index"));
        }
        RawMaterial::destroy($request->idDel);
        return back();
    }
    
    
    
}
