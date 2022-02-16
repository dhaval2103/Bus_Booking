{{-- @extends('layouts.app') --}}
@extends('auth.userlayout.master')
@section('content')
@prepend('css')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
@endprepend

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Search Bus</h3>
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
        <form action="{{ route('buslist') }}" method="POST" id="searchform">
            @csrf
            <div class="row">
                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Source" class="col-form-label">Source :</label>
                        {{-- <input type="text" class="form-control" name="source"> --}}
                            <select class="form-control js-example-basic-multiple" name="source">
                                <option value="">Select Source</option>
                                <option value="Surat">Surat</option>
                                <option value="Adajan">Adajan</option>
                                <option value="Bhatar">Bhatar</option>
                                <option value="Dabholi">Dabholi</option>
                                <option value="Chowk">Chowk</option>
                                <option value="Kamrej">Kamrej</option>
                                <option value="Katargam">Katargam</option>
                                <option value="Kosamba">Kosamba</option>
                                <option value="Laskana">Laskana</option>
                            </select>
                    </div>
                        @error('source')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
            </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Destination" class="col-form-label">Destination :</label>
                        {{-- <input type="text" class="form-control" name="destination"> --}}
                        <select class="form-control js-example-basic-multiple" name="destination">
                            <option value="">Select Destination</option>
                            <option value="Rajkot">Rajkot</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                            <option value="Vadodara">Vadodara</option>
                            <option value="Bhavnagar">Bhavnagar</option>
                            <option value="Valsad">Valsad</option>
                            <option value="Amreli">Amreli</option>
                            <option value="Bharuch">Bharuch</option>
                            <option value="Rajula">Rajula</option>
                            <option value="Patan">Patan</option>
                            <option value="Savarkundla">Savarkundla</option>
                            <option value="Bhuj">Bhuj</option>
                        </select>
                    </div>
                        @error('destination')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Date" class="col-form-label">Date :</label>
                            <input type="text" class="form-control onward" name="date" id="txtdate">
                    </div>
                    @error('date')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div> <!-- end col-->

                {{-- <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Time" class="col-form-label">Time :</label>
                            <input type="time" class="form-control" name="time">
                            @error('time')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div> <!-- end col--> --}}

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Seat" class="col-form-label">Seat :</label>
                            {{-- <input type="text" class="form-control" name="seat"> --}}
                            <select name="seat" id="" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                            @error('seat')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <button style="margin-top:38px" type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    {{-- @foreach ($searching as $search)
                        <div class="card">
                            <h1>{{ $search->name }}</h1>
                        </div>
                    @endforeach --}}
                </div> <!-- end col-->

            </div>
        </form>
         <!-- end row-->
    </div> <!-- container-fluid -->
</div>
@endsection
@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <script>

         $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            var currentDate = new Date();
            $('.onward').datepicker({
                dateFormat: "yy-mm-dd",
                numberOfMonths:1,
                minDate: +1,
                changeMonth:true,
                changeYear:true,
            }).on('changeDate', function(ev) {
                $(this).datepicker('hide');
            });
            $('.onward').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });


            $("#searchform").validate({
                rules: {
                    'seat': {
                        required: true
                    },
                    'date': {
                        required: true
                    },
                    'source': {
                        required:true
                    },
                    'destination': {
                        required:true
                    },
                },
                messages: {
                    'seat': {
                        required: "Please Enter Seat..!!!"
                    },
                    'date': {
                        required: "Please Select Date..!!!"
                    },
                    'source': {
                        required: "Please Select Source..!!!"
                    },
                    'destination': {
                        required: "Please Select Destination..!!!"
                    },
                },

            });

        });

     </script>
@endpush
