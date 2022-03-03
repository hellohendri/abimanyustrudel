@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.outlets.index") }}">Outlets</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Outlets</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.outlets.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage outlets_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="nama_outlet" class="col-md-2 col-form-label">Nama Outlet:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama_outlet" name="nama_outlet" required="true" placeholder="Nama Outlet"  value="{{{ old('nama_outlet', isset($data)?$data->nama_outlet : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('nama_outlet')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="nama_outlet_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="nomor_telp" class="col-md-2 col-form-label">Nomor Telp:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nomor_telp" name="nomor_telp"  placeholder="Nomor Telp"  value="{{{ old('nomor_telp', isset($data)?$data->nomor_telp : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('nomor_telp')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="nomor_telp_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="alamat" class="col-md-2 col-form-label">Alamat:</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="alamat" name="alamat"  placeholder="Alamat"  value="{{{ old('alamat', isset($data)?$data->alamat : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('alamat')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="alamat_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.outlets.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection