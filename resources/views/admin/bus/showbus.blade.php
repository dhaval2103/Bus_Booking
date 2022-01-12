@extends('admin.adminlayout.master')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <br>
        <h1>Show Bus Detail</h1>
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <div class="table-responsive table-hover">
                        {{ $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) }}
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
@endsection
@push('js')
    {{ $dataTable->scripts() }}
@endpush
