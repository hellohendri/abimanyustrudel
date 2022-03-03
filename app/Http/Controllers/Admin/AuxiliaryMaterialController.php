<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\AuxiliaryMaterial;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AuxiliaryMaterialRequest;
use Gate;

class AuxiliaryMaterialController extends Controller
{

    public function index()
    {
        if (Gate::none(['auxiliary_material_allow', 'auxiliary_material_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "auxiliary_material";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        
        $tableData = AuxiliaryMaterial::orderBy("id", 'ASC')->get();
        return view("admin.auxiliary_material.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['auxiliary_material_allow'])) {
            return redirect(route("admin.auxiliary_material.index"));
        }
        $admiko_data['sideBarActive'] = "auxiliary_material";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.auxiliary_material.store");
        
        
        return view("admin.auxiliary_material.manage")->with(compact('admiko_data'));
    }

    public function store(AuxiliaryMaterialRequest $request)
    {
        if (Gate::none(['auxiliary_material_allow'])) {
            return redirect(route("admin.auxiliary_material.index"));
        }
        $data = $request->all();
        
        $AuxiliaryMaterial = AuxiliaryMaterial::create($data);
        
        return redirect(route("admin.auxiliary_material.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $AuxiliaryMaterial = AuxiliaryMaterial::find($id);
        if (Gate::none(['auxiliary_material_allow', 'auxiliary_material_edit']) || !$AuxiliaryMaterial) {
            return redirect(route("admin.auxiliary_material.index"));
        }

        $admiko_data['sideBarActive'] = "auxiliary_material";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.auxiliary_material.update", [$AuxiliaryMaterial->id]);
        
        
        $data = $AuxiliaryMaterial;
        return view("admin.auxiliary_material.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(AuxiliaryMaterialRequest $request,$id)
    {
        if (Gate::none(['auxiliary_material_allow', 'auxiliary_material_edit'])) {
            return redirect(route("admin.auxiliary_material.index"));
        }
        $data = $request->all();
        $AuxiliaryMaterial = AuxiliaryMaterial::find($id);
        $AuxiliaryMaterial->update($data);
        
        return redirect(route("admin.auxiliary_material.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['auxiliary_material_allow'])) {
            return redirect(route("admin.auxiliary_material.index"));
        }
        AuxiliaryMaterial::destroy($request->idDel);
        return back();
    }
    
    
    
}
