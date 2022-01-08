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
                                <option value="Ahmedabad" @if($edit->source=='Ahmedabad') selected @endif>Ahmedabad</option>
                                <option value="Vadodara" @if($edit->source=='Vadodara') selected @endif>Vadodara</option>
                                <option value="Bhavnagar" @if($edit->source=='Bhavnagar') selected @endif>Bhavnagar</option>
                                <option value="Valsad" @if($edit->source=='Valsad') selected @endif>Valsad</option>
                            </select>
                            @error('source')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Destination" class="col-form-label">Destination :</label><br>
                            <select class="form-control js-example-basic-multiple" name="destination">
                                <option value="Surat" @if($edit->destination=='Surat') selected @endif>Surat</option>
                                <option value="Ahmedabad" @if($edit->destination=='Ahmedabad') selected @endif>Ahmedabad</option>
                                <option value="Vadodara" @if($edit->destination=='Vadodara') selected @endif>Vadodara</option>
                                <option value="Bhavnagar" @if($edit->destination=='Bhavnagar') selected @endif>Bhavnagar</option>
                                <option value="Valsad" @if($edit->destination=='Valsad') selected @endif>Valsad</option>
                            </select>
                            @error('destination')
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
