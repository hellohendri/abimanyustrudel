<?php
/** Admiko routes. This file will be overwritten on page import. Don't add your code here! **/

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

/**Balance**/
Route::delete("balance/destroy", [BalanceController::class,"destroy"])->name("balance.delete");
Route::resource("balance", BalanceController::class)->parameters(["balance" => "balance"]);
/**Product**/
Route::delete("product/destroy", [ProductController::class,"destroy"])->name("product.delete");
Route::resource("product", ProductController::class)->parameters(["product" => "product"]);
/**ProductCategory**/
Route::delete("product_category/destroy", [ProductCategoryController::class,"destroy"])->name("product_category.delete");
Route::resource("product_category", ProductCategoryController::class)->parameters(["product_category" => "product_category"]);
/**ProductionHistory**/
Route::delete("production_history/destroy", [ProductionHistoryController::class,"destroy"])->name("production_history.delete");
Route::resource("production_history", ProductionHistoryController::class)->parameters(["production_history" => "production_history"]);
/**Outlets**/
Route::delete("outlets/destroy", [OutletsController::class,"destroy"])->name("outlets.delete");
Route::resource("outlets", OutletsController::class)->parameters(["outlets" => "outlets"]);
/**Warehouse**/
Route::delete("warehouse/destroy", [WarehouseController::class,"destroy"])->name("warehouse.delete");
Route::resource("warehouse", WarehouseController::class)->parameters(["warehouse" => "warehouse"]);
/**Sales**/
Route::delete("sales/destroy", [SalesController::class,"destroy"])->name("sales.delete");
Route::resource("sales", SalesController::class)->parameters(["sales" => "sales"]);
/**PaymentMethod**/
Route::delete("payment_method/destroy", [PaymentMethodController::class,"destroy"])->name("payment_method.delete");
Route::resource("payment_method", PaymentMethodController::class)->parameters(["payment_method" => "payment_method"]);
/**PaymentStatus**/
Route::delete("payment_status/destroy", [PaymentStatusController::class,"destroy"])->name("payment_status.delete");
Route::resource("payment_status", PaymentStatusController::class)->parameters(["payment_status" => "payment_status"]);
/**Losses**/
Route::delete("losses/destroy", [LossesController::class,"destroy"])->name("losses.delete");
Route::resource("losses", LossesController::class)->parameters(["losses" => "losses"]);
/**LossesType**/
Route::delete("losses_type/destroy", [LossesTypeController::class,"destroy"])->name("losses_type.delete");
Route::resource("losses_type", LossesTypeController::class)->parameters(["losses_type" => "losses_type"]);
/**AuxiliaryMaterial**/
Route::delete("auxiliary_material/destroy", [AuxiliaryMaterialController::class,"destroy"])->name("auxiliary_material.delete");
Route::resource("auxiliary_material", AuxiliaryMaterialController::class)->parameters(["auxiliary_material" => "auxiliary_material"]);
/**Equipment**/
Route::delete("equipment/destroy", [EquipmentController::class,"destroy"])->name("equipment.delete");
Route::resource("equipment", EquipmentController::class)->parameters(["equipment" => "equipment"]);
/**FixedCost**/
Route::delete("fixed_cost/destroy", [FixedCostController::class,"destroy"])->name("fixed_cost.delete");
Route::resource("fixed_cost", FixedCostController::class)->parameters(["fixed_cost" => "fixed_cost"]);
/**RawMaterial**/
Route::delete("raw_material/destroy", [RawMaterialController::class,"destroy"])->name("raw_material.delete");
Route::resource("raw_material", RawMaterialController::class)->parameters(["raw_material" => "raw_material"]);
/**Operational**/
Route::delete("operational/destroy", [OperationalController::class,"destroy"])->name("operational.delete");
Route::resource("operational", OperationalController::class)->parameters(["operational" => "operational"]);
/**Overhead**/
Route::delete("overhead/destroy", [OverheadController::class,"destroy"])->name("overhead.delete");
Route::resource("overhead", OverheadController::class)->parameters(["overhead" => "overhead"]);
