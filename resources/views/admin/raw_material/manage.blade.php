@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.raw_material.index") }}">Raw Material</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Raw Material</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.raw_material.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage raw_material_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="nama" class="col-md-2 col-form-label">Nama:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="nama" name="nama" required="true" placeholder="Nama"  value="{{{ old('nama', isset($data)?$data->nama : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('nama')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="nama_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-form-label">Jumlah:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="jumlah" name="jumlah" required="true" placeholder="Jumlah"
                                   step="1" 
                                   value="{{{ old('jumlah', isset($data)?$data->jumlah : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('jumlah')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jumlah_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="satuan" class="col-md-2 col-form-label">Satuan:*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="satuan" name="satuan" required="true" placeholder="Satuan"  value="{{{ old('satuan', isset($data)?$data->satuan : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('satuan')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="satuan_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="harga" class="col-md-2 col-form-label">Harga:*</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control limitPozNegDecNumbers numbersWidth" id="harga" name="harga" required="true"
                                       placeholder="Harga" step="0.01"  data-decimal="2"
                                       value="{{{ old('harga', isset($data)?$data->harga : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('harga')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="harga_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tanggal_pembelian" class="col-md-2 col-form-label">Tanggal Pembelian:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="datePicker_tanggal_pembelian" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_format')}}"
                                       class="form-control datetimepicker-input datePicker"
                                       data-target="#datePicker_tanggal_pembelian" required="true" id="tanggal_pembelian" data-toggle="datetimepicker"
                                       placeholder="Tanggal Pembelian" name="tanggal_pembelian" value="{{{ old('tanggal_pembelian', isset($data)?$data->tanggal_pembelian : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#datePicker_tanggal_pembelian" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('tanggal_pembelian')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tanggal_pembelian_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="keterangan" class="col-md-2 col-form-label">Keterangan:</label>
                        <div class="col-md-10">
                            <textarea class="form-control form-control-textarea simple_text_editor" id="keterangan" name="keterangan"  placeholder="Keterangan">{{{ old('keterangan', isset($data)?$data->keterangan : '') }}}</textarea>
                            <div class="invalid-feedback @if ($errors->has('keterangan')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="keterangan_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.raw_material.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection