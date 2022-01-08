<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BusDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BusValidation;
use App\Http\Requests\SearchBus;
use App\Interfaces\BusInterface;
use App\Models\Bus;
use Illuminate\Http\Request;
use Session;

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
        Session::put('seat',$request->seat);
        $searching=Bus::where('source','LIKE','%'.$request->source.'%')
            ->Where('destination','LIKE','%'.$request->destination.'%')
            ->get();
        return view('auth.customer.bus_list',compact('searching'));

    }

}