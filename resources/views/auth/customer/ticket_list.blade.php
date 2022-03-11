@extends('auth.userlayout.master')
@section('content')
<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Ticket History</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<div class="panel-body">
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
</div>
 <section class="content" style="border: none;">
        <div class="container-fluid" style="border: none;">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            @foreach ($exist as $exists)
                 <div class="card" style="width:630px;margin-left: 40px;background-color:silver">
                        <a href="{{ route('ticket',$exists->ticket_no) }}" class=""><i class="feather icon-chevron-right"></i>
                            <div class="card-body display" id="show">
                                <h4>Ticket-<b>No</b></h4>
                                <h5>#{{ $exists->ticket_no }}</h5>
                            </div>
                        </a>
                 </div>
            @endforeach
            </div>
        </div>
    </section>
@endsection
