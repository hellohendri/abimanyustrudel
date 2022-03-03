{{--IMPORTANT: this page will be overwritten and any change will be lost!! Use custom_sidebar_bottom.blade.php and custom_sidebar_top.blade.php--}}

@if(Gate::any(['balance_allow', 'balance_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "balance" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.balance.index')}}"><i class="fas fa-file-invoice-dollar fa-fw"></i>Balance</a></li>
@endIf
@if(Gate::any(['product_allow', 'product_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "product" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.product.index')}}"><i class="fas fa-cookie-bite fa-fw"></i>Product</a></li>
@endIf
@if(Gate::any(['product_category_allow', 'product_category_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "product_category" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.product_category.index')}}"><i class="fas fa-bread-slice fa-fw"></i>Product Category</a></li>
@endIf
@if(Gate::any(['production_history_allow', 'production_history_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "production_history" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.production_history.index')}}"><i class="fas fa-history fa-fw"></i>Production History</a></li>
@endIf
@if(Gate::any(['outlets_allow', 'outlets_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "outlets" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.outlets.index')}}"><i class="fas fa-store fa-fw"></i>Outlets</a></li>
@endIf
@if(Gate::any(['warehouse_allow', 'warehouse_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "warehouse" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.warehouse.index')}}"><i class="fas fa-warehouse fa-fw"></i>Warehouse</a></li>
@endIf
@if(Gate::any(['sales_allow', 'sales_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "sales" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.sales.index')}}"><i class="fas fa-shopping-cart fa-fw"></i>Sales</a></li>
@endIf
@if(Gate::any(['payment_method_allow', 'payment_method_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "payment_method" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.payment_method.index')}}"><i class="fas fa-credit-card fa-fw"></i>Payment Method</a></li>
@endIf
@if(Gate::any(['payment_status_allow', 'payment_status_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "payment_status" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.payment_status.index')}}"><i class="fas fa-check-circle fa-fw"></i>Payment Status</a></li>
@endIf
@if(Gate::any(['losses_allow', 'losses_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "losses" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.losses.index')}}"><i class="fas fa-fire-alt fa-fw"></i>Losses</a></li>
@endIf
@if(Gate::any(['losses_type_allow', 'losses_type_edit']))
<li class="nav-item{{ $admiko_data['sideBarActive'] === "losses_type" ? " active" : "" }}"><a class="nav-link" href="{{route('admin.losses_type.index')}}"><i class="fas fa-exclamation-circle fa-fw"></i>Losses Type</a></li>
@endIf
@if(Gate::any(['auxiliary_material_allow','auxiliary_material_edit','equipment_allow','equipment_edit','fixed_cost_allow','fixed_cost_edit','raw_material_allow','raw_material_edit','operational_allow','operational_edit','overhead_allow','overhead_edit']))
<li class="nav-item dropdown{{ $admiko_data['sideBarActiveFolder'] === "dropdown_expense" ? " open" : "" }}">
    <a href="#" class="nav-link dropdown-link"><i class="fas fa-money-bill-wave fa-fw"></i>Expense</a>
    <ul class="nav flex-column dropdown-content" {!! $admiko_data['sideBarActiveFolder'] === "dropdown_expense" ? ' style="display:block"' : '' !!}>
	@if(Gate::any(['auxiliary_material_allow', 'auxiliary_material_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "auxiliary_material" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.auxiliary_material.index')}}"><i class="fas fa-file-alt fa-fw"></i>Auxiliary Material</a></li>
	@endIf
	@if(Gate::any(['equipment_allow', 'equipment_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "equipment" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.equipment.index')}}"><i class="fas fa-file-alt fa-fw"></i>Equipment</a></li>
	@endIf
	@if(Gate::any(['fixed_cost_allow', 'fixed_cost_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "fixed_cost" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.fixed_cost.index')}}"><i class="fas fa-file-alt fa-fw"></i>Fixed Cost</a></li>
	@endIf
	@if(Gate::any(['raw_material_allow', 'raw_material_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "raw_material" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.raw_material.index')}}"><i class="fas fa-file-alt fa-fw"></i>Raw Material</a></li>
	@endIf
	@if(Gate::any(['operational_allow', 'operational_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "operational" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.operational.index')}}"><i class="fas fa-file-alt fa-fw"></i>Operational</a></li>
	@endIf
	@if(Gate::any(['overhead_allow', 'overhead_edit']))
		<li class="nav-item{{ $admiko_data['sideBarActive'] === "overhead" ? " active" : "" }}"><a class="nav-link dropdown-item" href="{{route('admin.overhead.index')}}"><i class="fas fa-file-alt fa-fw"></i>Overhead</a></li>
	@endIf
    </ul>
</li>
@endIf