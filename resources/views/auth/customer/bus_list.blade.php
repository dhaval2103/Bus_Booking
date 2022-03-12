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
        <input type="hidden" class="sessionNo" value="{{Session::get('price')}}">
        <div class="row">
            <div class="col-xl-12">
                @foreach ($searching as $search)
                <form action="{{ route('booking') }}" method="POST" id="">
                    @csrf
                    <input type="hidden" name="price" class="seatprice" value="{{$search->price}}">
                    <div class="col-sm-12 show">
                        <input type="hidden" name="id" value="{{$search->id}}">
                        Bus Name :
                        <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                        Bus No :
                        <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                        Destination :
                        <h5>Surat To {{ $search->destination }}</h5>
                        Via :
                        <h5>{{ $search->route }}</h5>
                        <button type="button" class="btn btn-primary book" data-id="{{$search->id}}">{{ $search->seats }} >></button>
                        <input type="hidden" class="seatNo" value="{{ $search->seats }}">
                        <input type="hidden" class="seat" name="seat" value="">
                        <div class="col-4 abc" id="{{$search->id}}" style="margin-top: 10px"></div>
                        <div class="col-sm-2 hidden-class checkseat">
                            @for ($i = 1 ; $i <= $search->seats; $i++)
                                {{$i}}&nbsp;
                                <input class='form-check-inline select-seat clickload' id="seating{{$i}}" name='check[]' type='checkbox' value='{{$i}}' @if(!empty($search->disable_seat) && in_array($i,$search->disable_seat)) checked disabled @endif>
                                @endfor

                                <br>
                                <b>Email : </b><input type="email" name="email" id="" class="form-control" placeholder="Enter Email" required>
                                @for ($i = 0 ; $i < Session::get('seat'); $i++) <input type="hidden" name="pid" value="">
                                    <b>Name : </b><input type="text" name="passenger[name][{{$i}}]" id="" placeholder="Enter Name" required>
                                    <b>Gender : </b><br>
                                    Male <input type="radio" name="passenger[gender][{{$i}}]" value="male" required>
                                    Female <input type="radio" name="passenger[gender][{{$i}}]" value="female" required>
                                    <br>
                                    <b>Age : </b><input type="number" name="passenger[age][{{$i}}]" id="" placeholder="Enter Age" required>
                                    @endfor

                        </div>
                        Price :
                        <h5 style="text-transform: uppercase;" class="showprice">{{ $search->price }}</h5>
                        <button type="submit" class="btn btn-success sdsubmit" style="margin-top: 10px" disabled>Book</button>
                    </div>
                </form>
                @endforeach

                {{-- Bus Route --}}
                <div class="row col-md-12">
                    {{-- @foreach ($rout[0] as $key=>$value)
                    <div class="col-md-6" style="border-bottom: 1px solid black;">

                        <form action="{{ route('busRoute') }}" method="POST">
                    @csrf
                    <div class="col-sm-12 busroutershow">
                        <input type="hidden" name="id" value="{{ $search->id }}">
                        <label for="Bus Name" class="col-form-label">Bus Name :</label>
                        <h5 style="text-transform: uppercase;">{{ $search->name }}</h5>
                        <label for="Destination" class="col-form-label">Destination :</label>
                        <span><b>Surat To {{ $value }}</b></span><br>
                        <label for="Bus No" class="col-form-label">Bus No :</label>
                        <h5 style="text-transform: uppercase;">{{ $search->no }}</h5>
                        <button type="button" class="btn btn-primary rseatbook" data-id="{{$key}}">{{ $search->seats }} >> </button>

                        <input type="hidden" class="seatNo" value="{{ $search->seats }}">
                        <input type="hidden" class="seat" name="seat" value="">
                        <div class="col-4 abc" id="{{ $search->id }}" style="margin-top: 10px"></div>
                        <div class="col-sm-2 hidden-class routeseat" data-id="{{$key}}">

                            @for ($i = 1 ; $i <= $search->seats; $i++)
                                {{ $i }}&nbsp;
                                <input class='form-check-inline select-routeSeat routeclickload' id="busseat{{$i}}" name='check[]' type='checkbox' value='{{ $i }}' @if(!empty($a) && in_array($i,$a['0'])) checked disabled @endif>
                                @endfor

                        </div>
                        <label for="Price" class="col-form-label">Price :</label>
                        <h5 style="text-transform: uppercase;">{{ $search->price }}</h5>
                        <button type="submit" class="btn btn-success routsubmit" style="margin-top: 10px" disabled>Book</button>
                    </div>
                    </form>
                </div>
                @endforeach --}}
            </div>
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
    var per_seat_price = '';
    var price = '';
    $(document).ready(function() {
        total_prev = $('.select-seat:checkbox:checked').length;
        total_prev_route = $('.select-routeSeat:checkbox:checked').length;
    });

    $(document).on('change', '.select-seat', function(e) {
        var price = $('.seatprice').val();
        e.preventDefault();
        var totalCheckboxes = $('.select-seat').length - 1;
        var total = $('.select-seat:checkbox:checked').length;
        var $input = $('input[type=checkbox]');
        var lengthcheckn = $input.not(':disabled').filter(':checked').length - 1;
        var sessionNo = $('.sessionNo').val();
        var total_seat = parseInt(total_prev) + parseInt(sessionNo);
        $('.seat').val(total);
        for (var i = 1; i <= total_seat; i++) {

            if (i <= sessionNo) {
                if (total <= total_seat) {

                } else {
                    toastr.error('You Should Not Selected Greater Than Seats ' + sessionNo);
                    $(this).prop('checked', false);
                    break;
                }
            }

        }
        if (total <= total_seat) {
            price = (lengthcheckn * price);
            $('.showprice').text(price);
        }
    });


    // Bus Route Checkbox Select

    $(document).on('change', '.select-routeSeat', function(e) {
        e.preventDefault();
        var totalRouteCheckboxes = $('.select-routeSeat').length;
        var totalCheck = $('.select-routeSeat:checkbox:checked').length;
        var sessionNo = $('.sessionNo').val();
        var total_route_seat = parseInt(total_prev_route) + parseInt(sessionNo);
        console.log(total_route_seat);
        $('.seat').val(totalCheck);
        for (var i = 1; i <= total_route_seat; i++) {
            if (i <= sessionNo) {
                if (totalCheck <= total_route_seat) {
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

    $(document).ready(function() {
        $(".checkseat").hide();
        $(document).on("click", ".book", function() {
            $(".checkseat").toggle();
            // $('.rseatbook').prop('disabled', function(i, v) { return !v; });
            // (function($) {
            //         $.fn.toggleDisabled = function() {
            //             return this.each(function() {
            //                 var $this = $(this);
            //                 if ($this.attr('disabled')) $this.removeAttr('disabled');
            //                 else $this.attr('disabled', 'disabled');
            //             });
            //         };
            //     })(jQuery);
            // $(".rseatbook").toggle();
            // $(".rseatbook").prop('disabled',true);
            var diId = $(this).attr("data-id");
            $(".checkseat").hide();
            $(".book").prop('disabled', true);
            $(this).parents(".show").find(".checkseat").show();
            $(this).parents(".show").find(".checkseat").prop('disabled', false);
            $(".book").prop('disabled', true);
            $(".routsubmit").prop('disabled', true);

        });
    });

    $(document).ready(function() {
        $(".routeseat").hide();
        $(document).on("click", ".rseatbook", function() {
            var diId = $(this).attr("data-id");
            $(".routeseat").hide();
            $(".rseatbook").prop('disabled', true);
            $(this).parents(".busroutershow").find(".routeseat").show();
            $(this).parents(".busroutershow").find(".rseatbook").prop('disabled', false);
            $(".book").prop('disabled', true);
            $(".sdsubmit").prop('disabled', true);
        });
    });


    // Submit Button Disabled

    $(document).on("click", ".clickload", function() {
        $(".sdsubmit").prop('disabled', false);
    });

    $(document).on("click", ".routeclickload", function() {
        // $(this).parents(".routsubmit").prop('disabled',false);
        $(".routsubmit").prop('disabled', false);
    });

</script>
@endpush
