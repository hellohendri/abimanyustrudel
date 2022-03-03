<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Operational;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\OperationalRequest;
use Gate;

class OperationalController extends Controller
{

    public function index()
    {
        if (Gate::none(['operational_allow', 'operational_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "operational";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data["fileInfo"] = Operational::$admiko_file_info;
        $tableData = Operational::orderByDesc("id")->get();
        return view("admin.operational.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['operational_allow'])) {
            return redirect(route("admin.operational.index"));
        }
        $admiko_data['sideBarActive'] = "operational";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.operational.store");
        $admiko_data["fileInfo"] = Operational::$admiko_file_info;
        
        return view("admin.operational.manage")->with(compact('admiko_data'));
    }

    public function store(OperationalRequest $request)
    {
        if (Gate::none(['operational_allow'])) {
            return redirect(route("admin.operational.index"));
        }
        $data = $request->all();
        
        $Operational = Operational::create($data);
        
        return redirect(route("admin.operational.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Operational = Operational::find($id);
        if (Gate::none(['operational_allow', 'operational_edit']) || !$Operational) {
            return redirect(route("admin.operational.index"));
        }

        $admiko_data['sideBarActive'] = "operational";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.operational.update", [$Operational->id]);
        $admiko_data["fileInfo"] = Operational::$admiko_file_info;
        
        $data = $Operational;
        return view("admin.operational.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(OperationalRequest $request,$id)
    {
        if (Gate::none(['operational_allow', 'operational_edit'])) {
            return redirect(route("admin.operational.index"));
        }
        $data = $request->all();
        $Operational = Operational::find($id);
        $Operational->update($data);
        
        return redirect(route("admin.operational.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['operational_allow'])) {
            return redirect(route("admin.operational.index"));
        }
        Operational::destroy($request->idDel);
        return back();
    }
    
    
    
}
