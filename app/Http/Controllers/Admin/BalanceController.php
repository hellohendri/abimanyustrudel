<?php
/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Balance;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BalanceRequest;
use Gate;
use App\Models\Admin\PaymentMethod;

class BalanceController extends Controller
{

    public function index()
    {
        if (Gate::none(['balance_allow', 'balance_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "balance";
		$admiko_data["sideBarActiveFolder"] = "";
        
        $tableData = Balance::orderBy("id", 'ASC')->get();
        return view("admin.balance.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['balance_allow'])) {
            return redirect(route("admin.balance.index"));
        }
        $admiko_data['sideBarActive'] = "balance";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.balance.store");
        
        
		$payment_method_all = PaymentMethod::all()->sortBy("metode_pembayaran")->pluck("metode_pembayaran", "id");
        return view("admin.balance.manage")->with(compact('admiko_data','payment_method_all'));
    }

    public function store(BalanceRequest $request)
    {
        if (Gate::none(['balance_allow'])) {
            return redirect(route("admin.balance.index"));
        }
        $data = $request->all();
        
        $Balance = Balance::create($data);
        
        return redirect(route("admin.balance.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Balance = Balance::find($id);
        if (Gate::none(['balance_allow', 'balance_edit']) || !$Balance) {
            return redirect(route("admin.balance.index"));
        }

        $admiko_data['sideBarActive'] = "balance";
		$admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.balance.update", [$Balance->id]);
        
        
		$payment_method_all = PaymentMethod::all()->sortBy("metode_pembayaran")->pluck("metode_pembayaran", "id");
        $data = $Balance;
        return view("admin.balance.manage")->with(compact('admiko_data', 'data','payment_method_all'));
    }

    public function update(BalanceRequest $request,$id)
    {
        if (Gate::none(['balance_allow', 'balance_edit'])) {
            return redirect(route("admin.balance.index"));
        }
        $data = $request->all();
        $Balance = Balance::find($id);
        $Balance->update($data);
        
        return redirect(route("admin.balance.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['balance_allow'])) {
            return redirect(route("admin.balance.index"));
        }
        Balance::destroy($request->idDel);
        return back();
    }
    
    
    
}
