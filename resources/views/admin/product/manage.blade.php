@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.product.index") }}">Product</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Product</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.product.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage product_manage admikoForm">
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
                        <label for="hpp" class="col-md-2 col-form-label">HPP:*</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control limitPozNegDecNumbers numbersWidth" id="hpp" name="hpp" required="true"
                                       placeholder="HPP" step="0.01"  data-decimal="2"
                                       value="{{{ old('hpp', isset($data)?$data->hpp : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('hpp')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="hpp_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="harga_jual" class="col-md-2 col-form-label">Harga Jual:*</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control limitPozNegDecNumbers numbersWidth" id="harga_jual" name="harga_jual" required="true"
                                       placeholder="Harga Jual" step="0.01"  data-decimal="2"
                                       value="{{{ old('harga_jual', isset($data)?$data->harga_jual : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('harga_jual')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="harga_jual_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-2 col-form-label">Deskripsi:</label>
                        <div class="col-md-10">
                            <textarea class="form-control form-control-textarea simple_text_editor" id="deskripsi" name="deskripsi"  placeholder="Deskripsi">{{{ old('deskripsi', isset($data)?$data->deskripsi : '') }}}</textarea>
                            <div class="invalid-feedback @if ($errors->has('deskripsi')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="deskripsi_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.product.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection