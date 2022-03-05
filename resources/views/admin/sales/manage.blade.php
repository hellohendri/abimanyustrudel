@extends("admin.layouts.default")
@section('breadcrumbs')
<li class="breadcrumb-item active"><a href="{{ route("admin.sales.index") }}">Sales</a></li>
@if(isset($data))
<li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
@else
<li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
@endIf
@endsection
@section('pageTitle')
<h1>Sales</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.sales.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage sales_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row">
                <div class="col-2"></div>
                <div class="col">
                    <div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div>
                </div>
            </div>@endif
            <div class="row">

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label">Nama:*</label>
                        <div class="col-md-10">
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
                        <label for="metode_pembayaran" class="col-md-2 col-form-label">Metode Pembayaran:*</label>
                        <div class="col-md-10" style="position: relative">
                            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required="true" data-placeholder="{{trans('admiko.select')}}" style="width: 100%" data-width="100%" data-allow-clear="true">

                                @foreach($payment_method_all as $id => $value)
                                <option value="{{ $id }}" {{ (old('metode_pembayaran') ? old('metode_pembayaran') : $data->metode_pembayaran ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('metode_pembayaran')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="metode_pembayaran_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="status_pembayaran" class="col-md-2 col-form-label">Status Pembayaran:*</label>
                        <div class="col-md-10">
                            <select class="form-select" id="status_pembayaran" name="status_pembayaran" required="true">

                                @foreach($payment_status_all as $id => $value)
                                <option value="{{ $id }}" {{ (old('status_pembayaran') ? old('status_pembayaran') : $data->status_pembayaran ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('status_pembayaran')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="status_pembayaran_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-form-label">Jumlah:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="jumlah" name="jumlah" required="true" placeholder="Jumlah" step="1" value="{{{ old('jumlah', isset($data)?$data->jumlah : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('jumlah')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jumlah_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-2 col-form-label">Tanggal:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="dateTimePicker_tanggal" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;" data-date_time_format="{{config('admiko_config.form_date_time_format')}}" class="form-control datetimepicker-input dateTimePicker" data-target="#dateTimePicker_tanggal" required="true" id="tanggal" data-toggle="datetimepicker" placeholder="Tanggal" name="tanggal" value="{{{ old('tanggal', isset($data)?$data->tanggal : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#dateTimePicker_tanggal" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('tanggal')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tanggal_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.sales.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection