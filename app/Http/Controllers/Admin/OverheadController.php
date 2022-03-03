<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Overhead;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\OverheadRequest;
use Gate;

class OverheadController extends Controller
{

    public function index()
    {
        if (Gate::none(['overhead_allow', 'overhead_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "overhead";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data["fileInfo"] = Overhead::$admiko_file_info;
        $tableData = Overhead::orderByDesc("id")->get();
        return view("admin.overhead.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['overhead_allow'])) {
            return redirect(route("admin.overhead.index"));
        }
        $admiko_data['sideBarActive'] = "overhead";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.overhead.store");
        $admiko_data["fileInfo"] = Overhead::$admiko_file_info;
        
        return view("admin.overhead.manage")->with(compact('admiko_data'));
    }

    public function store(OverheadRequest $request)
    {
        if (Gate::none(['overhead_allow'])) {
            return redirect(route("admin.overhead.index"));
        }
        $data = $request->all();
        
        $Overhead = Overhead::create($data);
        
        return redirect(route("admin.overhead.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Overhead = Overhead::find($id);
        if (Gate::none(['overhead_allow', 'overhead_edit']) || !$Overhead) {
            return redirect(route("admin.overhead.index"));
        }

        $admiko_data['sideBarActive'] = "overhead";
		$admiko_data["sideBarActiveFolder"] = "dropdown_expense";
        $admiko_data['formAction'] = route("admin.overhead.update", [$Overhead->id]);
        $admiko_data["fileInfo"] = Overhead::$admiko_file_info;
        
        $data = $Overhead;
        return view("admin.overhead.manage")->with(compact('admiko_data', 'data'));
    }

    public function update(OverheadRequest $request,$id)
    {
        if (Gate::none(['overhead_allow', 'overhead_edit'])) {
            return redirect(route("admin.overhead.index"));
        }
        $data = $request->all();
        $Overhead = Overhead::find($id);
        $Overhead->update($data);
        
        return redirect(route("admin.overhead.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['overhead_allow'])) {
            return redirect(route("admin.overhead.index"));
        }
        Overhead::destroy($request->idDel);
        return back();
    }
    
    
    
}
