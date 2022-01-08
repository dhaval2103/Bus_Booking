{{-- @extends('layouts.app') --}}
@extends('auth.userlayout.master')
@section('content')
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
                        <select class="form-control js-example-basic-multiple" name="source">
                            <option value="">Select Source</option>
                            <option value="Surat">Surat</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                            <option value="Vadodara">Vadodara</option>
                            <option value="Bhavnagar">Bhavnagar</option>
                            <option value="Valsad">Valsad</option>
                        </select>
                        @error('source')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    {{-- </div> --}}
                </div>
            </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Destination" class="col-form-label">Destination :</label>
                        <select class="form-control js-example-basic-multiple" name="destination">
                            <option value="">Select Destination</option>
                            <option value="Ahmedabad">Ahmedabad</option>
                            <option value="Vadodara">Vadodara</option>
                            <option value="Bhavnagar">Bhavnagar</option>
                            <option value="Valsad">Valsad</option>
                        </select>
                        @error('destination')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Date" class="col-form-label">Date :</label>
                            <input type="date" class="form-control" name="date">
                            @error('date')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Time" class="col-form-label">Time :</label>
                            <input type="time" class="form-control" name="time">
                            @error('time')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-2">
                    <div class="card">
                        <label for="Seat" class="col-form-label">Seat :</label>
                            <input type="text" class="form-control" name="seat">
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
     <script>
         $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $("#searchform").validate({
                rules: {
                    'seat': {
                        required: true
                    },
                    'date': {
                        required: true
                    },
                    'time': {
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
                    'time': {
                        required: "Please Choose Time..!!!"
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
