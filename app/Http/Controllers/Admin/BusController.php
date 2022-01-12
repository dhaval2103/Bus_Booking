<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BusDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusValidation;
use App\Http\Requests\SearchBus;
use App\Interfaces\BusInterface;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;
use Session;
use Stripe;
use Stripe\Customer;
use PDF;
use PhpParser\Node\Expr\Cast\Bool_;

class BusController extends Controller
{
    public $bus;

    public function __construct(BusInterface $bus)
    {
        $this->bus=$bus;
    }

    public function addbus()
    {
        return view('admin.bus.add_bus');
    }

    public function insertbus(BusValidation $request)
    {
        $this->bus->creates($request->all());
        return redirect()->route('admin.showbus');
    }

    public function showbus(BusDatatable $request)
    {
        return $request->render('admin.bus.showbus');
    }

    public function editbus($id)
    {
       $edit= $this->bus->edit($id);
       return view('admin.bus.editbus',compact('edit'));
    }

    public function updatebus(Request $request)
    {
        $this->bus->update($request->all());
        return redirect()->route('admin.showbus');
    }

    public function deletebus($id)
    {
        $this->bus->delete($id);
        return redirect()->route('admin.showbus');
    }

    public function searchbus()
    {
        return view('auth.customer.bus_list');
    }

    public function buslist(Request $request)
    {
        session()->forget('seat');
        session()->forget('date');
        Session::put('seat',$request->seat);
        Session::put('date',$request->date);
        $searching=Bus::where('source','LIKE','%'.$request->source.'%')
            ->Where('destination','LIKE','%'.$request->destination.'%')
            ->get();
        $ans=[];
        foreach($searching as $value)
        {
                $ans[]=Booking::select('book_seat')->where('bus_id',$value->id)->first();
        }
        $a=[];
        foreach($ans as $values)
        {
            if($values!=null)
            {
                $a[]=explode(',',$values['book_seat']);
            }
        }
        return view('auth.customer.bus_list',compact('searching','a'));
    }

    // public function selectcheck(Request $request)
    // {
        // $seat=0;
        // $totalprice=0;
        // $seats=Bus::where('id',$request->id)->first();
        // if($seat){
        //     $seat=$request->id;
        //     $totalprice=$seat*$seats->price;
        //     $arr=[
        //         'seats'=>$seat,
        //         'price'=>$totalprice
        //     ];
        //     Bus::where('id',$request->id)->update($arr);
        // }
        // $price=Bus::where('id',$request->id)->first();
        // return response()->json(['data'=>$price]);
    // }

    public function booking(Request $request)
    {
        $date=Session::get('date');
        $ticket_no = generateTicketNumber(rand(100000, 999999));
        $data=Bus::where('id',$request->id)->first();
        $total = 0;
        $totalSeat=count($request->check);
        $total = $data->price * $totalSeat;
        $add=new Booking;
        $add->ticket_no=$ticket_no;
        $add->user_id=Auth::user()->id;
        $add->bus_id=$request->id;
        $add->date=$date;
        $add->book_seat=implode(',',$request->check);
        $add->price=$data->price;
        $add->total_price=$total;
        $add->save();
        return view('auth.customer.payment');
    }

    public function payment()
    {
        return view('auth.customer.payment');
    }

    public function stripe(Request $request)
    {
        DB::beginTransaction();
        try {
            $a = explode('/',$request->exp_month);
            $exp_month = trim($a[0]);
            $exp_year = trim($a[1]);
            $booking = Booking::where('user_id',Auth::user()->id)->orderBy('ticket_no')->first();
            $total = 0;
            $stripe = new \Stripe\StripeClient(
                'sk_test_51KBGw9SFWtePUTo2aYHcyRbH79ZfN1LEa64xNuE2tW2smFglHV4Kil2gijPgYtMQobHHSQ221SYZMZnFWyxoTHcM00nBGSeZv6'
            );

            $sti = $stripe->tokens->create([
                'card' => [
                    'number' => $request->number,
                    'cvc' => $request->cvc,
                    'exp_month' => $exp_month,
                    'exp_year' => $exp_year
                ]
            ]);
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $invoice = Stripe\Charge::create([
                "amount" => $booking->total_price * 100,
                "currency" => "inr",
                "source" => $sti->id,
                "description" => "This Payment Only Testing Purpose"
            ]);
            if ($invoice['amount_refunded'] == 0 && empty($invoice['failure_code']) && $invoice['paid'] == 1 && $invoice['captured'] == 1)
            {

            }

            DB::commit();
            return redirect()->route('ticket')->with('Success','Payment Received Successfully');

        } catch (\Throwable $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function ticket(Request $request)
    {
        $b = Booking::where('id',$request->id)->first();
        $view = Booking::where('user_id',Auth::user()->id)->get();
        return view('auth.customer.ticket',compact('view'));
    }

    public function generatepdf(Request $request, $id)
    {
        $view = Booking::where('user_id',Auth::user()->id)->where('ticket_no',$id)->get();
        $data = [
            'view' => $view,
        ];
        $pdf = PDF::loadview('auth.customer.generatepdf',compact('view'));
        return $pdf->stream('ticket.pdf');
    }

}