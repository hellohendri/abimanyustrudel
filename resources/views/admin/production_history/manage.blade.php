@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.production_history.index") }}">Production History</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Production History</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.production_history.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage production_history_manage admikoForm">
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
                        <label for="jenis" class="col-md-2 col-form-label">Jenis:*</label>
                        <div class="col-md-10">
                            <select class="form-select" id="jenis" name="jenis" required="true">
                                
                                @foreach($product_category_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('jenis') ? old('jenis') : $data->jenis ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('jenis')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="jenis_help" class="text-muted"></small>
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
                        <label for="hpp" class="col-md-2 col-form-label">HPP:*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control limitPozNegNumbers numbersWidth" id="hpp" name="hpp" required="true" placeholder="HPP"
                                   step="1" 
                                   value="{{{ old('hpp', isset($data)?$data->hpp : '') }}}">
                            <div class="invalid-feedback @if ($errors->has('hpp')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="hpp_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.production_history.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection