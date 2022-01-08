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
        {{-- <form action="{{ route('searchbus') }}" method="POST" id="searchform"> --}}
            <input type="hidden" class="seatNo" value="{{Session::get('seat')}}">
            <div class="row">
                @foreach ($searching as $search)
                    <div class="col-sm-3 info" >
                        <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                        <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                        <h5>{{ $search->seats }}</h5>
                    </div>
                    <button  type="click" class="btn btn-primary book" data-id="{{$search->id}}">Booking</button>
                    <div class="abc" id="{{$search->id}}"></div>
                    @endforeach


                </div>
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
        $(document).on('click','.book',function(){
            var a=$('.seatNo').val();
            var id=$(this).data('id');
            var htm="";
            htm+="<form> ";
            for(var i=1;i<=a;i++)
            {
                htm+="<input type='checkbox'>";
            }
            htm+="</form>"
            console.log(htm);
            $('#'+id).html(htm);
        })
    </script>
@endpush
