
<html>

    <head>
        <meta charset="utf-8">
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,800&display=swap"
            rel="stylesheet">

        <title>PDF Ticket</title>
        <style>
            @media print {
                .noprint {
                    display: none;
                }
                body,
                html {
                    margin: 0;
                    padding: 0;
                    width: 100%;
                    height: 100%;
                }
            }
            @page {
                margin: 0;
            }

        </style>
    </head>
    <div class="panel-body">
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
    </div>
        <section class="inner_page_head">
            <div class="container_fuild">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            {{-- <h3>Invoice</h3> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
    <body style="margin: 0px; background-color: #ebeef3;">

        <table width="100%" cellpadding="0" cellspacing="0" align="center" style="font-family: 'Open Sans', sans-serif; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;">
            <tr>
                <td style="vertical-align: top;" align="center">
                    <table cellpadding="0" cellspacing="0" align="center" style="width: 760px; margin: 24px auto; background-color: #fff; box-shadow: 0px 2px 4px rgba(0,0,0,0.16);">
                        <tr>
                            <td>
                                <table width="100%" height="100%" cellpadding="0" cellspacing="0" align="left">
                                    <tr>
                                        <td>
                                            <table width="100%" cellpadding="0" cellspacing="0" align="left">
                                                <tr style="vertical-align: middle; background-color: #eaf1f2;">
                                                    <td align="left" style="padding: 40px">
                                                    </td>
                                                </tr>
                                                <tr style="vertical-align: middle; background-color: #eaf1f2; padding-bottom: 20px;">
                                                    <td style="width: 50%; padding: 0px 15px 40px 40px;">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td align="left" style="padding-bottom: 15px;">
                                                                    <h4 style="margin-top: 0px; margin-bottom: 0px; font-size: 18px; text-transform: uppercase;">
                                                                        <b>{{ Auth::user()->name }}</b></h4>
                                                                </td>
                                                            </tr>

                                                            <tr style="text-align: left;">
                                                            </tr>

                                                            <tr style="text-align: left;">
                                                                <td align="left" style="padding-bottom: 5px;">
                                                                    <p style="font-size: 14px; color: #6f7177; line-height: 22px; margin: 0; letter-spacing: 0.6px;">
                                                                       <b>Email :</b><span>{{ Auth::user()->email }}</span></p>
                                                                </td>

                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="width: 50%; padding: 0px 40px 40px 15px;">
                                                        @foreach ($view as $views)
                                                        @endforeach

                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tr>
                                                                <td align="right" style="display: inline-block; width: 100%; padding-bottom: 6px;">
                                                                    <h4 style="margin: 0px; font-size: 15px; font-weight: 600; text-transform: uppercase; ">
                                                                        Ticket No.</h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="display: inline-block; width: 100%; padding-bottom: 15px;">
                                                                    <p style="font-size: 14px; color: #6f7177; line-height: 22px; margin: 0; letter-spacing: 0.6px;">
                                                                        {{ $views->ticket_no }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="display: inline-block; width: 100%; padding-bottom: 6px;">
                                                                    <h4 style="margin: 0px; font-size: 15px; font-weight: 600; text-transform: uppercase; ">
                                                                        Ticket Date.</h4>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="right" style="display: inline-block; width: 100%; padding-bottom: 15px;">
                                                                    <p style="font-size: 14px; color: #6f7177; line-height: 22px; margin: 0; letter-spacing: 0.6px;">
                                                                        {{ $views->created_at }}</p>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 20px 40px;">
                                            <table width="100%" height="100%" cellpadding="0" cellspacing="0">
                                                <tr style="vertical-align: middle;">
                                                    <th align="left" style="border-bottom: 3px solid #e8e8e8; padding:15px 13px; width: 50%; ">
                                                        <p style="font-size: 15px;margin: 0; color: #6f7177; letter-spacing: 0.2px; text-transform: uppercase;">
                                                            Source</p>
                                                    </th>
                                                    <th align="left" style="border-bottom: 3px solid #e8e8e8; padding:15px 13px; ">
                                                        <p style="font-size: 15px;margin: 0; color: #6f7177; letter-spacing: 0.2px; text-transform: uppercase;">
                                                            Destination</p>
                                                    </th>
                                                    <th align="left" style="border-bottom: 3px solid #e8e8e8; padding:15px 13px;">
                                                        <p style="font-size: 15px;margin: 0; color: #6f7177; letter-spacing: 0.2px; text-transform: uppercase;">
                                                            Date</p>
                                                    </th>
                                                    <th align="right" style="border-bottom: 3px solid #e8e8e8; padding:15px 13px;">
                                                        <p style="font-size: 15px;margin: 0; color: #6f7177; letter-spacing: 0.2px; text-transform: uppercase;">
                                                            Seat</p>
                                                    </th>
                                                    <th align="right" style="border-bottom: 3px solid #e8e8e8; padding:15px 13px;">
                                                        <p style="font-size: 15px;margin: 0; color: #6f7177; letter-spacing: 0.2px; text-transform: uppercase;">
                                                            Per Seat Price</p>
                                                    </th>
                                                    <th align="right" style="border-bottom: 3px solid #e8e8e8; padding:15px 13px;">
                                                        <p style="font-size: 15px;margin: 0; color: #6f7177; letter-spacing: 0.2px; text-transform: uppercase;">
                                                           Total Price</p>
                                                    </th>
                                                </tr>
                                                @foreach ($view as $views)
                                                @php
                                                    $p=DB::table('buses')->where('id',$views->bus_id)->first();
                                                @endphp
                                                <tr style="vertical-align: top;">
                                                    <td align="left" style="border-bottom: 1px solid #e7e8ec; padding: 13px;">
                                                        <p style="font-size: 15px; color: #000; margin: 0; letter-spacing: 0.6px;">
                                                            {{ $p->source }}</p>
                                                    </td>
                                                    <td align="left" style="border-bottom: 1px solid #e7e8ec; padding: 13px;">
                                                        <p style="font-size: 15px; color: #000; margin: 0; letter-spacing: 0.6px;">
                                                            {{ $p->destination }}</p>
                                                    </td>
                                                    <td align="left" style="border-bottom: 1px solid #e7e8ec; padding: 13px;">
                                                        <p style="font-size: 15px; color: #000; margin: 0; letter-spacing: 0.6px;">
                                                            {{ $views->date }}</p>
                                                    </td>
                                                    <td align="left" style="border-bottom: 1px solid #e7e8ec; padding: 13px;">
                                                        <p style="font-size: 15px; color: #000; margin: 0; letter-spacing: 0.6px;">
                                                            {{ $views->book_seat }}</p>
                                                    </td>
                                                    <td align="left" style="border-bottom: 1px solid #e7e8ec; padding: 13px;">
                                                        <p style="font-size: 15px; color: #000; margin: 0; letter-spacing: 0.6px;">
                                                            {{ $views->price }}</p>
                                                    </td>
                                                    <td align="right" style="border-bottom: 1px solid #e7e8ec; padding: 13px;">
                                                        <p style="font-size: 15px; color: #000; margin: 0; letter-spacing: 0.6px;">
                                                            {{ $views->total_price }}</p>
                                                @endforeach
                                                    </td>
                                                </tr>
                                                <tr style="vertical-align: bottom;">
                                                    <td colspan="2"></td>
                                                    <td colspan="1"></td>
                                                    <td colspan="2" align="left" style=" padding: 13px;  ">
                                                        <p style="font-size: 16px; margin: 0; color: #000; letter-spacing: 0.2px; text-transform: uppercase; ">
                                                            {{-- <strong>Total  :-  {{$grandTotal}}</strong> --}}
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr style="vertical-align: bottom;">
                                                    <td colspan="2"></td>
                                                </tr>
                                                {{-- @php
                                                    $total=0;
                                                @endphp --}}
                                                {{-- @foreach ($view as $grand) --}}
                                                <tr style="vertical-align: bottom;">
                                                    <td colspan="2"></td>
                                                    <td colspan="2" align="left" style="padding: 13px; border-top: 1px solid #e7e8ec;  color: #f7941d; vertical-align: middle; font-weight: 700;">
                                                        {{-- <p style="font-size: 16px; margin: 0; color: #000; letter-spacing: 0.2px; text-transform: uppercase; ">
                                                            Total</p> --}}
                                                    </td>
                                                    <td align="right" style="padding: 13px; border-top: 1px solid #e7e8ec;  color: #f7941d; vertical-align: middle; font-weight: 700;">
                                                        <p style="font-size: 16px; margin: 0; color: #000; letter-spacing: 0.2px; text-transform: uppercase; ">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 40px;">
                                            <table width="100%" height="100%" cellpadding="0" cellspacing="0">
                                                <tr style="vertical-align: middle;">
                                                    <td style="background-color: #eaf1f2; padding: 5px;">
                                                        <table width="100%" cellpadding="0" cellspacing="0" align="left">
                                                            <tr>
                                                                <td align="left" style="padding: 10px 20px;">
                                                                    <h4 style=" font-size: 20px; margin: 0; color: #000;  font-weight: 500;"></h4>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" cellpadding="0" cellspacing="0" align="left">
                                                            <tr>
                                                                <td style="padding: 0px 10px; background-color: #fff;">
                                                                    <table width="100%" cellpadding="0" cellspacing="0" align="left">
                                                                        <tr>
                                                                            <td style=" padding: 15px 16px; border-bottom: 2px solid #eaf1f2;">
                                                                                <table width="100%" height="100%" cellpadding="0" cellspacing="0">
                                                                                    <tr style="vertical-align: top;">
                                                                                        <td align="left" style="width: 50%;  padding-right: 20px; border-right: 1px solid #eaf1f2;">
                                                                                            <table cellpadding="2" cellspacing="0" width="100%">
                                                                                                <tr>
                                                                                                    <td align="left" style="padding-bottom: 5px; text-transform: uppercase;">
                                                                                                        <h4>
                                                                                                            {{-- <b>Shipping Details</b> --}}
                                                                                                        </h4>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr style="text-align: left;">
                                                                                                    <td align="left">
                                                                                                        {{-- <h5 style="margin: 0px; font-size: 15px; font-weight: 600; ">
                                                                                                           {{ $address->name }}</h5> --}}
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr style="text-align: left;">
                                                                                                    <td align="left">
                                                                                                        {{-- <p style="font-size: 14px; color: #6f7177; line-height: 22px; margin: 0; letter-spacing: 0.6px;">
                                                                                                            Address :- {{ $address->address }} --}}
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr style="text-align: left;">
                                                                                                    <td align="left">
                                                                                                        {{-- <p style="font-size: 14px; color: #6f7177; line-height: 22px; margin: 0; letter-spacing: 0.6px;">
                                                                                                            Email :- {{ $address->email }} --}}
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr style="text-align: left;">
                                                                                                    <td align="left">
                                                                                                        {{-- <p style="font-size: 14px; color: #6f7177; line-height: 22px; margin: 0; letter-spacing: 0.6px;">
                                                                                                            Mobile No. :- {{ $address->phone }} --}}
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </body>

    </html>


