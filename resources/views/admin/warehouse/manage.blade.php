@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.warehouse.index") }}">Warehouse</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Warehouse</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.warehouse.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage warehouse_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="nama" class="col-md-2 col-form-label">Nama:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="nama" name="nama" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($product_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('nama') ? old('nama') : $data->nama ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('nama')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="nama_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row multiSelect">
                        <label for="outlet" class="col-md-2 col-form-label">Outlet:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="outlet" name="outlet" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">
                                
                                @foreach($outlets_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('outlet') ? old('outlet') : $data->outlet ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('outlet')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="outlet_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah_stock" class="col-md-2 col-form-label">Jumlah Stock:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="jumlah_stock" name="jumlah_stock" required="true" placeholder="Jumlah Stock"
                                   step="1" 
                                   value="{{{ old('jumlah_stock', isset($data)?$data->jumlah_stock : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('jumlah_stock')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jumlah_stock_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tanggal_produksi" class="col-md-2 col-form-label">Tanggal Produksi:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="datePicker_tanggal_produksi" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_format')}}"
                                       class="form-control datetimepicker-input datePicker"
                                       data-target="#datePicker_tanggal_produksi" required="true" id="tanggal_produksi" data-toggle="datetimepicker"
                                       placeholder="Tanggal Produksi" name="tanggal_produksi" value="{{{ old('tanggal_produksi', isset($data)?$data->tanggal_produksi : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#datePicker_tanggal_produksi" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('tanggal_produksi')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tanggal_produksi_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tanggal_expired" class="col-md-2 col-form-label">Tanggal Expired:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="datePicker_tanggal_expired" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_format')}}"
                                       class="form-control datetimepicker-input datePicker"
                                       data-target="#datePicker_tanggal_expired" required="true" id="tanggal_expired" data-toggle="datetimepicker"
                                       placeholder="Tanggal Expired" name="tanggal_expired" value="{{{ old('tanggal_expired', isset($data)?$data->tanggal_expired : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#datePicker_tanggal_expired" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('tanggal_expired')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tanggal_expired_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer form-actions" id="form-group-buttons">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary float-start me-1 mb-1 mb-sm-0 save-button">{{trans('admiko.table_save')}}</button>
                    <a href="{{ route("admin.warehouse.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection