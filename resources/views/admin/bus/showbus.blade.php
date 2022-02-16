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
                        {{ $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap dragAndDrop']) }}
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
@endsection
@push('js')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function(){
            $('.dragAndDrop').sortable({
                items : 'tr:not(tr:first-child)',
                cursor : 'pointer',
                axis : 'y',
                dropOnEmpty : false,
            start : function (e,ui) {
                ui.item.addClass("selected");
            },
            stop : function (e,ui) {
                ui.item.removeClass("selected");
                $(this).find("tr").each(function (index) {
                    if(index > 0) {
                        $(this).find("td").eq(2).html(index);
                    }
                });
              }
            });
        });

    </script>
@endpush
