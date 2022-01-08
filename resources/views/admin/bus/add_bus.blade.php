@extends('admin.adminlayout.master')
@section('content')
<div class="content-wrapper">
    <section class="content"><br>
        <h1>Add Bus</h1>
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.insertbus') }}" id="insertform">
                        @csrf
                        {{-- <input type="hidden" class="form-control" name=""> --}}
                        <div class="alert alert-success d-none" id="msg_div">
                            <span id="res_message"></span>
                        </div>
                        <div class="form-group">
                            <label for="Bus Name" class="col-form-label">Bus Name :</label>
                            <input type="text" class="form-control" name="busname">
                            @error('busname')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="BusNo" class="col-form-label">Bus No :</label><br>
                            <input type="text" class="form-control" name="busno" style="text-transform: uppercase;">
                            @error('busno')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Seat" class="col-form-label">Seat :</label><br>
                            <input type="number" class="form-control" name="seat">
                            @error('seat')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Date" class="col-form-label">Date :</label><br>
                            <input type="date" class="form-control" name="date">
                            @error('date')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Time" class="col-form-label">Time :</label>
                            <input type="time" class="form-control" name="time">
                            @error('time')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Source" class="col-form-label">Source :</label><br>
                            <select class="form-control js-example-basic-multiple" name="source">
                                <option value="Surat">Surat</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Bhavnagar">Bhavnagar</option>
                                <option value="Valsad">Valsad</option>
                            </select>
                            @error('source')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Destination" class="col-form-label">Destination :</label><br>
                            <select class="form-control js-example-basic-multiple" name="destination">
                                <option value="Surat">Surat</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Bhavnagar">Bhavnagar</option>
                                <option value="Valsad">Valsad</option>
                            </select>
                            @error('destination')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Price" class="col-form-label">Price :</label><br>
                            <input type="number" class="form-control" name="price">
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><a
                                    href="">Back</a></button>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <div id="msgdisplay"></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

        $(document).ready(function(){
            $("#insertform").validate({
                rules: {
                    'busname':{
                        required:true
                    },
                    'busno': {
                        required: true
                    },
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
                    'price': {
                        required:true
                    },
                },
                messages: {
                    'busname':{
                        required: "Please Enter BusName..!!!"
                    },
                    'busno': {
                        required: "Please Enter BusNo..!!!"
                    },
                    'seat': {
                        required: "Please Enter Seat..!!!"
                    },
                    'date': {
                        required: "Please Select Date..!!!"
                    },
                    'source': {
                        required: "Please Enter Source..!!!"
                    },
                    'destination': {
                        required: "Please Enter Destination..!!!"
                    },
                    'price': {
                        required: "Please Enter Price..!!!"
                    },
                },

            });
        });
    </script>
@endpush
