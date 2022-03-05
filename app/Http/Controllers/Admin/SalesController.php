<?php

/**
 * @author     Thank you for using Admiko.com
 * @copyright  2020-2022
 * @link       https://Admiko.com
 * @Help       We are always looking to improve our code. If you know better and more creative way don't hesitate to contact us. Thank you.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Sales;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SalesRequest;
use Gate;
use App\Models\Admin\Product;
use App\Models\Admin\PaymentMethod;
use App\Models\Admin\PaymentStatus;

class SalesController extends Controller
{

    public function index()
    {
        if (Gate::none(['sales_allow', 'sales_edit'])) {
            return redirect(route("admin.home"));
        }
        $admiko_data['sideBarActive'] = "sales";
        $admiko_data["sideBarActiveFolder"] = "";

        $tableData = Sales::orderBy("id")->get();
        return view("admin.sales.index")->with(compact('admiko_data', "tableData"));
    }

    public function create()
    {
        if (Gate::none(['sales_allow'])) {
            return redirect(route("admin.sales.index"));
        }
        $admiko_data['sideBarActive'] = "sales";
        $admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.sales.store");


        $product_all = Product::all()->sortBy("nama")->pluck("nama", "id");
        $payment_method_all = PaymentMethod::all()->sortBy("metode_pembayaran")->pluck("metode_pembayaran", "id");
        $payment_status_all = PaymentStatus::all()->sortBy("payment_status")->pluck("payment_status", "id");
        return view("admin.sales.manage")->with(compact('admiko_data', 'product_all', 'payment_method_all', 'payment_status_all'));
    }

    public function store(SalesRequest $request)
    {
        if (Gate::none(['sales_allow'])) {
            return redirect(route("admin.sales.index"));
        }
        $data = $request->all();

        $Sales = Sales::create($data);

        return redirect(route("admin.sales.index"));
    }

    public function show($id)
    {
        return back();
    }

    public function edit($id)
    {
        $Sales = Sales::find($id);
        if (Gate::none(['sales_allow', 'sales_edit']) || !$Sales) {
            return redirect(route("admin.sales.index"));
        }

        $admiko_data['sideBarActive'] = "sales";
        $admiko_data["sideBarActiveFolder"] = "";
        $admiko_data['formAction'] = route("admin.sales.update", [$Sales->id]);


        $product_all = Product::all()->sortBy("nama")->pluck("nama", "id");
        $payment_method_all = PaymentMethod::all()->sortBy("metode_pembayaran")->pluck("metode_pembayaran", "id");
        $payment_status_all = PaymentStatus::all()->sortBy("payment_status")->pluck("payment_status", "id");
        $data = $Sales;
        return view("admin.sales.manage")->with(compact('admiko_data', 'data', 'product_all', 'payment_method_all', 'payment_status_all'));
    }

    public function update(SalesRequest $request, $id)
    {
        if (Gate::none(['sales_allow', 'sales_edit'])) {
            return redirect(route("admin.sales.index"));
        }
        $data = $request->all();
        $Sales = Sales::find($id);
        $Sales->update($data);

        return redirect(route("admin.sales.index"));
    }

    public function destroy(Request $request)
    {
        if (Gate::none(['sales_allow'])) {
            return redirect(route("admin.sales.index"));
        }
        Sales::destroy($request->idDel);
        return back();
    }
}
