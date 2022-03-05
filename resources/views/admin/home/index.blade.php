@extends("admin.layouts.default")
@section('breadcrumbs')@endsection
@section('pageTitle')
<!-- <h1>{{ trans('admiko.home') }}</h1> -->

<div class="card production_history_index admikoIndex">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card text-white bg-success mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Total Omset</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-6 col-lg-3">
                <div class="card text-white bg-warning mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Total Biaya Produksi</h5>
                        <h5 class="card-text">{{"Rp " . number_format($totalCost, 2, ".", ",")}}</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card text-white bg-danger mb-3" style="max-width: 20rem;">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengeluaran</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card text-white bg-primary mb-3">
                    <div class=" card-body">
                        <h5 class="card-title">Total Laba / Rugi</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageInfo')@endsection
@section('backBtn')@endsection
@section('content')
@endsection