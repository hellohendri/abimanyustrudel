@extends("admin.layouts.default")
@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route("admin.balance.index") }}">Balance</a></li>
    @if(isset($data))
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_edit')}}</li>
    @else
        <li class="breadcrumb-item active" aria-current="page">{{trans('admiko.page_breadcrumbs_add')}}</li>
    @endIf
@endsection
@section('pageTitle')
<h1>Balance</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{ route("admin.balance.index") }}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<div class="card formPage balance_manage admikoForm">
    <legend class="action">{{ isset($data) ? trans('admiko.update') : trans('admiko.add_new') }}</legend>
    <form method="POST" action="{{ $admiko_data['formAction'] }}" enctype="multipart/form-data" class="needs-validation" novalidate>
        @if(isset($data)) @method('PUT') @endIf
        @csrf
        <div class="card-body">
            @if ($errors->any())<div class="row"><div class="col-2"></div><div class="col"><div class="invalid-feedback d-block">@foreach($errors->all() as $error) {{$error}}<br> @endforeach</div></div></div>@endif
            <div class="row">
                
                <div class=" col-12">
                    <div class="form-group row">
                        <label for="kategori" class="col-md-2 col-form-label">Kategori:</label>
                        <div class="col-md-10">
                            <select class="form-select" id="kategori" name="kategori" >
                                <option value="">{{trans("admiko.select")}}</option>
                                @foreach($payment_method_all as $id => $value)
                                    <option value="{{ $id }}" {{ (old('kategori') ? old('kategori') : $data->kategori ?? '') == $id ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback @if ($errors->has('kategori')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            <small id="kategori_help" class="text-muted"></small>
                        </div>
                    </div>
                </div>

                <div class=" col-12">
                    <div class="form-group row">
                        <label for="jumlah" class="col-md-2 col-form-label">Jumlah:</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" class="form-control limitPozNegDecNumbers numbersWidth" id="jumlah" name="jumlah" 
                                       placeholder="Jumlah" step="0.01"  data-decimal="2"
                                       value="{{{ old('jumlah', isset($data)?$data->jumlah : '') }}}">
                                <div class="invalid-feedback @if ($errors->has('jumlah')) d-block @endif">{{trans('admiko.required_text')}}</div>
                            </div>
                            <small id="jumlah_help" class="text-muted"></small>
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
                    <a href="{{ route("admin.balance.index") }}" class="btn btn-secondary float-end" role="button">{{trans('admiko.table_cancel')}}</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection