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
                            <input type="text" class="form-control" name="busname" placeholder="Enter Bus Name">
                            @error('busname')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="BusNo" class="col-form-label">Bus No :</label><br>
                            <input type="text" class="form-control" name="busno" placeholder="Enter Bus No">
                            @error('busno')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Seat" class="col-form-label">Seat :</label><br>
                            <input type="number" class="form-control" name="seat" placeholder="Enter Seat">
                            @error('seat')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Date" class="col-form-label">Date :</label><br>
                            <input type="date" class="form-control" name="date" placeholder="Enter Date">
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
                                <option value="---Select Source---">---Select Source---</option>
                                <option value="Surat">Surat</option>
                                <option value="Adajan">Adajan</option>
                                <option value="Bhatar">Bhatar</option>
                                <option value="Dabholi">Dabholi</option>
                                <option value="Chowk">Chowk</option>
                                <option value="Kamrej">Kamrej</option>
                                <option value="Katargam">Katargam</option>
                                <option value="Kosamba">Kosamba</option>
                                <option value="Laskana">Laskana</option>
                                <option value="Bharuch">Bharuch</option>
                                <option value="Karjan">Karjan</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Bhavnagar">Tarapur</option>
                                <option value="Dhola">Dhola</option>
                                <option value="Dholera">Dholera</option>
                                <option value="Palitana">Palitana</option>
                                <option value="Jesar">Jesar</option>
                                <option value="Borsad">Borsad</option>
                                <option value="Bhavnagar">Bhavnagar</option>
                                <option value="Sihor">Sihor</option>
                                <option value="Anand">Anand</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Bhachau">Bhachau</option>
                                <option value="Kamrej">Kamrej</option>
                                <option value="Chotila">Chotila</option>
                            </select>
                            @error('source')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Destination" class="col-form-label">Destination :</label><br>
                            <select class="form-control js-example-basic-multiple" name="destination">
                                <option value="---Select Destination---">---Select Destination---</option>
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
                                <option value="Bharuch">Bharuch</option>
                                <option value="Karjan">Karjan</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Bhavnagar">Tarapur</option>
                                <option value="Dhola">Dhola</option>
                                <option value="Dholera">Dholera</option>
                                <option value="Palitana">Palitana</option>
                                <option value="Jesar">Jesar</option>
                                <option value="Borsad">Borsad</option>
                                <option value="Bhavnagar">Bhavnagar</option>
                                <option value="Sihor">Sihor</option>
                                <option value="Anand">Anand</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Bhachau">Bhachau</option>
                                <option value="Kamrej">Kamrej</option>
                                <option value="Chotila">Chotila</option>
                            </select>
                            @error('destination')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Route" class="col-form-label">Route :</label><br>
                            <select class="form-control js-example-basic-multiple" multiple name="route[]">
                                <option value="Bharuch">Bharuch</option>
                                <option value="Karjan">Karjan</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Bhavnagar">Tarapur</option>
                                <option value="Dhola">Dhola</option>
                                <option value="Dholera">Dholera</option>
                                <option value="Palitana">Palitana</option>
                                <option value="Jesar">Jesar</option>
                                <option value="Borsad">Borsad</option>
                                <option value="Bhavnagar">Bhavnagar</option>
                                <option value="Sihor">Sihor</option>
                                <option value="Anand">Anand</option>
                                <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Bhachau">Bhachau</option>
                                <option value="Kamrej">Kamrej</option>
                                <option value="Chotila">Chotila</option>
                            </select>
                            @error('route')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Price" class="col-form-label">Price :</label><br>
                            <input type="number" class="form-control" name="price" placeholder="Enter Ticket Price">
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
                    'time': {
                        required: true
                    },
                    'source': {
                        required:true
                    },
                    'destination': {
                        required:true
                    },
                    'route': {
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
                    'time': {
                        required: "Please Select Time..!!!"
                    },
                    'source': {
                        required: "Please Choose Source..!!!"
                    },
                    'destination': {
                        required: "Please Choose Destination..!!!"
                    },
                    'route': {
                        required: "Please Choose Route..!!"
                    },
                    'price': {
                        required: "Please Enter Price..!!!"
                    },
                },

            });
        });
    </script>
@endpush
