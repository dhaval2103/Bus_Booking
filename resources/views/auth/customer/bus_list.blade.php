@extends('auth.userlayout.master')
@section('content')
<style>
    /* .hidden-class{
        display: none
    } */
</style>
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
            <input type="hidden" class="sessionNo" value="{{Session::get('seat')}}">
            <div class="row">

                @foreach ($searching as $search)
                <form action="{{ route('booking') }}" method="POST" id="">
                    @csrf
                    <div class="col-sm-12 info" >

                        <input type="hidden" name="id" value="{{$search->id}}">
                        Bus Name :
                            <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                        Bus No :
                            <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                        Total Seat :
                            <h5>{{ $search->seats }}</h5>
                        Route :
                            <h5>{{ $search->route }}</h5>
                        {{-- <button type="button" class="btn btn-primary book" data-id="{{$search->id}}">>></button> --}}
                        <input type="hidden" class="seatNo" value="{{ $search->seats }}">
                        <input type="hidden" class="seat" name="seat" value="">
                        <div class="col-4 abc" id="{{$search->id}}" style="margin-top: 10px"></div>
                        <div class="col-sm-2 hidden-class">

                            @for ($i =1 ; $i <=$search->seats; $i++)
                                {{$i}}&nbsp;
                                <input class='form-check-inline select-seat' name='check[]' type='checkbox'
                                 value='{{$i}}' @if(in_array($i,$a['0'])) checked @endif>
                            @endfor
                        </div>
                        Price :
                        <h5 style="text-transform: uppercase;">{{ $search->price }}</h5>
                        <button type="submit" class="btn btn-warning" style="margin-top: 10px">Submit</button>
                    </div>
                </form>
                @endforeach
                    @foreach ($rout[0] as $value)
                    <div class="col-sm-12">
                        <label for="Bus Name" class="col-form-label">Bus Name :</label>
                        <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                        <label for="Destination" class="col-form-label">Destination :</label>
                        <span>{{$value}}</span><br>
                        <label for="Bus No" class="col-form-label">Bus No :</label>
                        <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                        <label for="Total Seat" class="col-form-label">Total Seat :</label>
                        <h5>{{ $search->seats }}</h5>
                        <input type="hidden" class="seatNo" value="{{ $search->seats }}">
                        <input type="hidden" class="seat" name="seat" value="">
                        <div class="col-4 abc" id="{{$search->id}}" style="margin-top: 10px"></div>
                        <div class="col-sm-2 hidden-class">

                            @for ($i =1 ; $i <=$search->seats; $i++)
                                {{$i}}&nbsp;
                                <input class='form-check-inline select-seat' name='check[]' type='checkbox'
                                 value='{{$i}}' @if(in_array($i,$a['0'])) checked @endif>
                            @endfor
                        </div>
                        <button type="submit" class="btn btn-warning" style="margin-top: 10px">Submit</button>
                    </div>
                    @endforeach
            </div> <!-- end col-->
         <!-- end row-->
    </div> <!-- container-fluid -->
</div>
@endsection
@push('js')
    <script>
        $(document).on('change','.select-seat',function(e){
            e.preventDefault();
            var totalCheckboxes = $('.select-seat:checked').length;
            var total = $('input[name="check[]"]:checked').length;
            var sessionNo = $('.sessionNo').val();
            $('.seat').val(total);
            if(totalCheckboxes > sessionNo)
            {
                alert('you shoud not selected greter than  ' + sessionNo );
                $(this).prop( "checked", false );
            }
        });

        $(document).on('click','.book',function(){
            var a=$('.seatNo').val();
            var id=$(this).data('id');
            var htm="";
            $('.hidden-class').css('display','block')
            // htm+="<div class='form-group'>";
            // for(var i=1;i<=a;i++)
            // {
            //     htm+="<input class='form-check-inline select-seat' name='check[]' type='checkbox' value='"+i+"'>";
            // }
            // htm+="</div>"
            // $('#'+id).html(htm);
        });
    </script>
@endpush
