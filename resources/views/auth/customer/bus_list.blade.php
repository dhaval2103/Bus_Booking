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
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        {{-- Add Source Destination --}}
        <input type="hidden" class="sessionNo" value="{{Session::get('seat')}}">
            <div class="row">
                <div class="col-xl-12">
                    @foreach ($searching as $search)
                        <form action="{{ route('booking') }}" method="POST" id="">
                            @csrf
                            <div class="col-sm-12">
                                <input type="hidden" name="id" value="{{$search->id}}">
                                Bus Name :
                                    <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                                Bus No :
                                    <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                                {{-- Total Seat :
                                    <h5>{{ $search->seats }}</h5> --}}
                                Destination :
                                    <h5>Surat To {{ $search->destination }}</h5>
                                {{-- Route :
                                    <h5>{{ $search->route }}</h5> --}}
                                <button type="button" class="btn btn-primary book" data-id="{{$search->id}}">{{ $search->seats }} >></button>
                                <input type="hidden" class="seatNo" value="{{ $search->seats }}">
                                <input type="hidden" class="seat" name="seat" value="">
                                <div class="col-4 abc" id="{{$search->id}}" style="margin-top: 10px"></div>
                                <div class="col-sm-2 hidden-class checkseat">
                                    @for ($i = 1 ; $i <= $search->seats; $i++)
                                        {{$i}}&nbsp;
                                        <input class='form-check-inline select-seat clickload' id="seating{{$i}}"  name='check[]' type='checkbox'
                                         value='{{$i}}' @if(!empty($a) && in_array($i,$a['0'])) checked disabled @endif >
                                    @endfor
                                </div>
                                Price :
                                <h5 style="text-transform: uppercase;">{{ $search->price }}</h5>
                                <button type="submit" class="btn btn-success" style="margin-top: 10px">Book</button>
                            </div>
                        </form>
                    @endforeach

                {{-- Bus Route --}}
                    @foreach ($rout[0] as $value)
                        <form action="{{ route('busRoute') }}" method="POST">
                            @csrf
                            <div class="col-sm-12">
                                <input type="hidden" name="id" value="{{ $search->id }}">
                                <label for="Bus Name" class="col-form-label">Bus Name :</label>
                                    <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                                <label for="Destination" class="col-form-label">Destination :</label>
                                    <span><b>Surat To {{ $value }}</b></span><br>
                                <label for="Bus No" class="col-form-label">Bus No :</label>
                                    <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                                {{-- <label for="Total Seat" class="col-form-label">Total Seat :</label>
                                    <h5>{{ $search->seats }}</h5> --}}
                                <button type="button" class="btn btn-primary rseatbook" data-id="{{$search->id}}">{{ $search->seats }} >></button>
                                <input type="hidden" class="seatNo" value="{{ $search->seats }}">
                                <input type="hidden" class="seat" name="seat" value="">
                                <div class="col-4 abc" id="{{ $search->id }}" style="margin-top: 10px"></div>
                                <div class="col-sm-2 hidden-class routeseat">

                                    @for ($i = 1 ; $i <= $search->seats; $i++)
                                        {{ $i }}&nbsp;
                                        <input class='form-check-inline select-routeSeat' id="busseat{{$i}}" name='check[]' type='checkbox'
                                        value='{{ $i }}' @if(!empty($a) && in_array($i,$a['0'])) checked disabled @endif>
                                    @endfor

                                </div>
                                <label for="Price" class="col-form-label">Price :</label>
                                <h5 style="text-transform: uppercase;">{{ $search->price }}</h5>
                                <button type="submit" class="btn btn-success" style="margin-top: 10px">Book</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div> <!-- end col-->
    </div> <!-- container-fluid -->
</div>
@endsection

@push('js')
    <script>

        // Checkbox Select

        var total_prev = '';
        var total_prev_route = '';

        $(document).ready(function(){
            total_prev = $('.select-seat:checkbox:checked').length;
            total_prev_route = $('.select-routeSeat:checkbox:checked').length;
        });

        $(document).on('change','.select-seat',function(e) {
            e.preventDefault();
            var totalCheckboxes = $('.select-seat').length;
            var total = $('.select-seat:checkbox:checked').length;
            var sessionNo = $('.sessionNo').val();
            var total_seat = parseInt(total_prev) + parseInt(sessionNo);
            $('.seat').val(total);
            for(var i=1; i<=total_seat; i++)
            {
                if(i <= sessionNo)
                {
                    if(total <= total_seat) {
                        // $(this).prop('checked', true);
                        // if ($(this).is(':checked')) {

                        //     $(this).prop('checked', false);
                        // }
                    } else {
                        toastr.error('You Should Not Selected Greater Than Seats ' + sessionNo);
                        $(this).prop('checked', false);
                        break;
                    }
                }
            }
        });

        // Bus Route Checkbox Select

        $(document).on('change','.select-routeSeat',function(e) {
            e.preventDefault();
            var totalRouteCheckboxes = $('.select-routeSeat').length;
            var totalCheck = $('.select-routeSeat:checkbox:checked').length;
            var sessionNo = $('.sessionNo').val();
            var total_route_seat = parseInt(total_prev_route) + parseInt(sessionNo);
            $('.seat').val(totalCheck);
            for(var i=1; i<=total_route_seat; i++)
            {
                if(i <= sessionNo)
                {
                    if(totalCheck <= total_route_seat) {
                        // $(this).prop('checked', true);
                        // if ($(this).is(':checked')) {

                        //     $(this).prop('checked', false);
                        // }
                    } else {
                        toastr.error('You Should Not Selected Greater Than Seats ' + sessionNo);
                        $(this).prop('checked', false);
                        break;
                    }
                }
            }
        });

        // Hide-Show Seat

        $(document).ready(function(){
            $(".checkseat").hide();
            $(document).on("click",".book",function(){
                $(".checkseat").toggle();
            });
        });

        $(document).ready(function(){
            $(".routeseat").hide();
            $(document).on("click",".rseatbook",function(){
                $(".routeseat").toggle();
            });
        });

        // $(document).on("click",".clickload",function(){
        //     alert();
        // });

    </script>
@endpush
