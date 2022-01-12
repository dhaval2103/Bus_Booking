@extends('admin.adminlayout.master')
@section('content')
<div class="content-wrapper">
    <section class="content"><br>
        <h1>Edit Bus Detail</h1>
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.updatebus') }}" id="">
                        @csrf
                        <input type="hidden" class="form-control" name="id" value="{{ $edit->id }}">
                        <div class="alert alert-success d-none" id="msg_div">
                            <span id="res_message"></span>
                        </div>
                        <div class="form-group">
                            <label for="Bus Name" class="col-form-label">Bus Name :</label>
                            <input type="text" class="form-control" name="busname" value="{{ $edit->name }}">
                            @error('busname')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="BusNo" class="col-form-label">Bus No :</label><br>
                            <input type="text" class="form-control" name="busno" style="text-transform: uppercase;" value="{{ $edit->no }}">
                            @error('busno')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Seat" class="col-form-label">Seat :</label><br>
                            <input type="number" class="form-control" name="seat" value="{{ $edit->seats }}">
                            @error('seat')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Date" class="col-form-label">Date :</label><br>
                            <input type="date" class="form-control" name="date" value="{{ $edit->onward }}">
                            @error('date')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Time" class="col-form-label">Time :</label>
                            <input type="time" class="form-control" name="time" value="{{ $edit->time }}">
                            @error('time')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Source" class="col-form-label">Source :</label><br>
                            <select class="form-control js-example-basic-multiple" name="source">
                                <option value="Surat" @if($edit->source=='Surat') selected @endif>Surat</option>
                                <option value="Adajan" @if($edit->source=='Adajan') selected @endif>Adajan</option>
                                <option value="Bhatar" @if($edit->source=='Bhatar') selected @endif>Bhatar</option>
                                <option value="Dabholi" @if($edit->source=='Dabholi') selected @endif>Dabholi</option>
                                <option value="Chowk" @if($edit->source=='Chowk') selected @endif>Chowk</option>
                                <option value="Kamrej" @if($edit->source=='Kamrej') selected @endif>Kamrej</option>
                                <option value="Katargam" @if($edit->source=='Katargam') selected @endif>Katargam</option>
                                <option value="Kosamba" @if($edit->source=='Kosamba') selected @endif>Kosamba</option>
                                <option value="Laskana" @if($edit->source=='Laskana') selected @endif>Laskana</option>
                            </select>
                            @error('source')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Destination" class="col-form-label">Destination :</label><br>
                            <select class="form-control js-example-basic-multiple" name="destination">
                                <option value="Rajkot" @if($edit->destination=='Rajkot') selected @endif>Rajkot</option>
                                <option value="Ahmedabad" @if($edit->destination=='Ahmedabad') selected @endif>Ahmedabad</option>
                                <option value="Vadodara" @if($edit->destination=='Vadodara') selected @endif>Vadodara</option>
                                <option value="Bhavnagar" @if($edit->destination=='Bhavnagar') selected @endif>Bhavnagar</option>
                                <option value="Valsad" @if($edit->destination=='Valsad') selected @endif>Valsad</option>
                                <option value="Amreli" @if($edit->destination=='Amreli') selected @endif>Amreli</option>
                                <option value="Bharuch" @if($edit->destination=='Bharuch') selected @endif>Bharuch</option>
                                <option value="Rajula" @if($edit->destination=='Rajula') selected @endif>Rajula</option>
                                <option value="Patan" @if($edit->destination=='Patan') selected @endif>Patan</option>
                                <option value="Savarkundla" @if($edit->destination=='Savarkundla') selected @endif>Savarkundla</option>
                                <option value="Bhuj" @if($edit->destination=='Bhuj') selected @endif>Bhuj</option>
                            </select>
                            @error('destination')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        @php
                            $a=explode(',',$edit->route);
                        @endphp
                        <div class="form-group">
                            <label for="Route" class="col-form-label">Route :</label><br>
                            <select class="form-control js-example-basic-multiple" multiple name="route[]">
                                <option value="Bharuch" @if(in_array('Bharuch',$a)) selected @endif>Bharuch</option>
                                <option value="Karjan" @if(in_array('Karjan',$a)) selected @endif>Karjan</option>
                                <option value="Vadodara" @if(in_array('Vadodara',$a)) selected @endif>Vadodara</option>
                                <option value="Tarapur" @if(in_array('Tarapur',$a)) selected @endif>Tarapur</option>
                                <option value="Dhola" @if(in_array('Dhola',$a)) selected @endif>Dhola</option>
                                <option value="Dholera" @if(in_array('Dholera',$a)) selected @endif>Dholera</option>
                                <option value="Palitana" @if(in_array('Palitana',$a)) selected @endif>Palitana</option>
                                <option value="Jesar" @if(in_array('Jesar',$a)) selected @endif>Jesar</option>
                                <option value="Borsad" @if(in_array('Borsad',$a)) selected @endif>Borsad</option>
                                <option value="Bhavnagar" @if(in_array('Bhavnagar',$a)) selected @endif>Bhavnagar</option>
                                <option value="Sihor" @if(in_array('Sihor',$a)) selected @endif>Sihor</option>
                                <option value="Anand" @if(in_array('Anand',$a)) selected @endif>Anand</option>
                                <option value="Ahmedabad" @if(in_array('Ahmedabad',$a)) selected @endif>Ahmedabad</option>
                                <option value="Bhachau" @if(in_array('Bhachau',$a)) selected @endif>Bhachau</option>
                                <option value="Kamrej" @if(in_array('Kamrej',$a)) selected @endif>Kamrej</option>
                                <option value="Chotila" @if(in_array('Chotila',$a)) selected @endif>Chotila</option>
                            </select>
                            @error('route')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Price" class="col-form-label">Price :</label><br>
                            <input type="number" class="form-control" name="price" value="{{ $edit->price }}">
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><a
                                    href="{{ route('admin.showbus') }}">Back</a></button>
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
</script>
@endpush
