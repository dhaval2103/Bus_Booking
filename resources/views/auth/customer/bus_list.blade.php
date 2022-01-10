@extends('auth.userlayout.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <p></p>
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Bus List</h3>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Timezone</a></li>
                            <li class="breadcrumb-item active">Dashboard</li> --}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        {{-- <form action="" method="POST" id="searchform"> --}}
            <input type="hidden" class="sessionNo" value="{{Session::get('seat')}}">
            <div class="row">
                @foreach ($searching as $search)
                    <div class="col-sm-6 info" >
                        Bus Name : <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                        Bus No : <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                        Available Seat : <h5>{{ $search->seats }}&nbsp;<button type="click" class="btn btn-primary book" data-id="{{$search->id}}">>></button></h5>
                        Price : <h5 style="text-transform: uppercase;">{{ $search->price }}</h5>
                        <input type="hidden" class="seatNo" value="{{ $search->seats }}">

                        <div class="col-12 abc" id="{{$search->id}}" style="margin-top: 10px"></div>
                        <button  type="click" class="btn btn-warning" data-id="{{$search->id}}" style="margin-top: 10px">Submit</button>
                    </div>
                @endforeach
            </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">

                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">

                </div> <!-- end col-->

            </div>
        {{-- </form> --}}
         <!-- end row-->
    </div> <!-- container-fluid -->
</div>
@endsection
@push('js')
    <script>
         $(document).on('change','.select-seat',function(){
            var totalCheckboxes = $('.select-seat:checked').length;
            var sessionNo=$('.sessionNo').val();

            if(totalCheckboxes>sessionNo)
            {
                alert('you shoud not selected greter than  ' +sessionNo );
            }else{
                
            }
            return false;

        })
        $(document).on('click','.book',function(){
            var a=$('.seatNo').val();

            var id=$(this).data('id');
            var htm="";
            htm+="<form> ";
            for(var i=1;i<=a;i++)
            {
                htm+="<input class='form-check-inline select-seat' type='checkbox'>";
            }
            htm+="</form>"
            $('#'+id).html(htm);



        })

    </script>
@endpush
