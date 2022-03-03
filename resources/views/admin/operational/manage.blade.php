@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.operational.index") }}">Operational</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Operational</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.operational.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage operational_manage admikoForm">
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
                        <label for="foto" class="col-md-2 col-form-label">Foto:</label>
                        <div class="col-md-10">
                            @if (isset($data->foto) && Storage::disk(config("admiko_config.filesystem"))->exists($admiko_data['fileInfo']["foto"]['original']["folder"].$data->foto))
                            <a href="{{ Storage::disk(config("admiko_config.filesystem"))->url($admiko_data['fileInfo']["foto"]['original']["folder"].$data->foto)}}" target="_blank">{{$data->foto}}</a><br>
                                <div class="form-check form-checkbox">
                                <input class="form-check-input" type="checkbox" name="foto_admiko_delete" id="foto_admiko_delete" value="1">
                                <label class="form-check-label" for="foto_admiko_delete"> {{trans('admiko.remove_file')}}</label>
                            </div>
                            @endif
                            <input type="file" class="fileUpload mt-1" id="foto"  name="foto" >
                            <input type="hidden" id="foto_admiko_current" name="foto_admiko_current" value="{{$data->foto??''}}">
                            <div class="invalid-feedback @if ($errors->has('foto')) d-block @endif" data-required="{{trans('admiko.required_text')}}" data-size="{{trans('admiko.required_size')}}" data-type="{{trans('admiko.required_type')}}">
                                @if ($errors->has('foto')){{ $errors->first('foto') }}@endif
                            </div>
                            <small id="foto_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="biaya" class="col-md-2 col-form-label">Biaya:*</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control limitPozNegDecNumbers numbersWidth" id="biaya" name="biaya" required="true"
                                       placeholder="Biaya" step="0.01"  data-decimal="2"
                                       value="{{{ old('biaya', isset($data)?$data->biaya : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('biaya')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="biaya_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="tanggal" class="col-md-2 col-form-label">Tanggal:*</label>
                        <div class="col-md-10">
                            <div class="input-group" id="datePicker_tanggal" data-target-input="nearest">
                                <input type="text" autocomplete="off" style="max-width: 170px;border-right: unset;"
                                       data-date_time_format="{{config('admiko_config.form_date_format')}}"
                                       class="form-control datetimepicker-input datePicker"
                                       data-target="#datePicker_tanggal" required="true" id="tanggal" data-toggle="datetimepicker"
                                       placeholder="Tanggal" name="tanggal" value="{{{ old('tanggal', isset($data)?$data->tanggal : '') }}}">
                                <div class="input-group-append input-group-text" data-target="#datePicker_tanggal" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar-alt fa-fw"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback @if ($errors->has('tanggal')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="tanggal_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.operational.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection