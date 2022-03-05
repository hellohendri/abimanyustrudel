@extends("admin.layouts.default")
@section('breadcrumbs')
<li class="breadcrumb-item active" aria-current="page">Production History</li>
@endsection
@section('pageTitle')
<h1>Production History</h1>
@endsection
@section('pageInfo')
@endsection
@section('backBtn')
<a href="{{route("admin.home")}}"><i class="fas fa-angle-left"></i> {{trans('admiko.page_back_btn')}}</a>
@endsection
@section('content')
<form action="/" method="GET">
    <div class="input-group mb-3">
        <input type="date" class="form-control" name="start_date">
        <input type="date" class="form-control" name="end_date">
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>
<div class="card production_history_index admikoIndex">
    <div class="card-body">
        <div class="container" style="padding: 0px !important">
            <div class="row">
                <div class="col-sm">
                    <div class="card border-primary" style="margin-bottom: 10px;">
                        <div class="card-body">
                            <h5 class="card-title">Total Biaya Produksi</h5>
                            <h5 class="card-text">{{"Rp " . number_format($totalCost, 2, ".", ",")}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="col-sm">
                        <div class="card border-info" style="margin-bottom: 10px;">
                            <div class="card-body">
                                <h5 class="card-title">Biaya Produksi Pastry</h5>
                                <h5 class="card-text">{{"Rp " . number_format($costPastry, 2, ".", ",")}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="col-sm">
                        <div class="card border-warning" style="margin-bottom: 10px;">
                            <div class="card-body">
                                <h5 class="card-title">Biaya Produksi Strudel</h5>
                                <h5 class="card-text">{{"Rp " . number_format($costStrudel, 2, ".", ",")}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tableBox" id="tableBox">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <div class="pb-2 pb-sm-0">
                        <div class="lengthTable"></div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-start justify-content-sm-end">
                            <div class="searchTable">
                                <div class="input-group ps-2">
                                    <input type="text" name="admiko_search" class="form-control searchTableInput" placeholder="Search" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tableLayout pb-2">
                <table class="table tableSort" style="width:100%" data-dom="ltrip">
                    <thead>
                        <tr data-sort-method='thead'>
                            <!-- <th scope="col" class="w-5" data-sort-method="number" >ID</th> -->
                            <th scope="col" class="text-nowrap">Nama</th>
                            <th scope="col" class="text-nowrap d-none d-sm-table-cell">Jenis</th>
                            <th scope="col" class="text-nowrap d-none d-md-table-cell">Jumlah</th>
                            <th scope="col" class="text-nowrap d-none d-lg-table-cell">HPP</th>
                            <th scope="col" class="d-none d-lg-table-cell">Tanggal Produksi</th>
                            <th scope="col" class="d-none d-lg-table-cell">Tanggal Expired</th>
                            <th scope="col" class="w-5 no-sort" data-orderable="false">{{trans("admiko.table_edit")}}</th>
                            @if(Gate::allows('production_history_allow'))
                            <th scope="col" class="w-5 no-sort" data-orderable="false">{{trans('admiko.table_delete')}}</th>
                            @endIf
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tableData as $data)
                        <tr>
                            <!-- <td class="w-5"><a href="{{route("admin.production_history.edit",[$data->id])}}">{{$data->id}}</a></td> -->
                            <td class="text-nowrap">{{$data->nama}}</td>
                            <td class="text-nowrap d-none d-sm-table-cell">{{$data->jenis_id->jenis_roti??""}}</td>
                            <td class="text-nowrap d-none d-md-table-cell">{{$data->jumlah}}</td>
                            <td class="text-nowrap d-none d-lg-table-cell">{{$data->hpp}}</td>
                            <td class="d-none d-lg-table-cell">{{$data->tanggal_produksi}}</td>
                            <td class="d-none d-lg-table-cell">{{$data->tanggal_expired}}</td>
                            <td class="w-5 no-sort"><a href="{{route("admin.production_history.edit",[$data->id])}}"><i class="fas fa-edit fa-fw"></i></a></td>
                            @if(Gate::allows(['production_history_allow']))
                            <td class="w-5 no-sort">
                                <a href="#" data-id="{{$data->id}}" class="admiko_deleteConfirm" data-bs-toggle="modal" data-bs-target="#deleteConfirm"><i class="fas fa-trash fa-fw"></i></a>
                            </td>
                            @endIf
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12 col-sm order-3 order-sm-0 pt-2">
                    @if(Gate::any(['production_history_allow']))
                    <a href="{{route('admin.production_history.create')}}" class="btn btn-primary" role="button"><i class="fas fa-plus fa-fw"></i> {{trans('admiko.table_add')}}</a>
                    @endIf
                </div>
                <div class="col-12 col-sm-auto order-0 order-sm-3 pt-2 align-self-center paginationInfo"></div>
                <div class="col-12 col-sm-auto order-0 order-sm-3 pt-2 text-end paginationBox"></div>
            </div>
        </div>
    </div>
    @if(Gate::allows('production_history_allow'))
    <!-- Delete confirm -->
    <div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="deleteConfirm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="post" class="w-100" action="{{route("admin.production_history.delete")}}">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{trans('admiko.delete_confirm')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">{{trans('admiko.delete_message')}}</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('admiko.delete_close_btn')}}</button>
                        <button type="submit" class="btn btn-danger deleteSoft">{{trans('admiko.delete_delete_btn')}}</button>
                    </div>
                </div>
                <div class="dataDelete"></div>
            </form>
        </div>
    </div>
    @endIf

</div>
@endsection