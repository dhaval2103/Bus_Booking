<?php

namespace App\Repository;
use App\Interfaces\BusInterface;
use App\Models\Bus;
use Illuminate\Support\Arr;

class BusRepository implements BusInterface
{
    public function creates(array $request)
    {
        $bus=new Bus;
        $bus->name=$request['busname'];
        $bus->no=$request['busno'];
        $bus->seats=$request['seat'];
        $bus->time=$request['time'];
        $bus->source=$request['source'];
        $bus->destination=$request['destination'];
        $bus->route=implode(',',$request['route']);
        $bus->price=$request['price'];
        $bus->save();
        return $bus;
    }

    public function edit($id)
    {
        $query=Bus::where('id',$id)->first();
        return $query;
    }

    public function update(array $request)
    {
        if($request['id']) {
            $arr=[
                'name'=>$request['busname'],
                'no'=>$request['busno'],
                'seats'=>$request['seat'],
                'onward'=>$request['date'],
                'time'=>$request['time'],
                'source'=>$request['source'],
                'destination'=>$request['destination'],
                'route'=>implode(',',$request['route']),
                'price'=>$request['price'],
            ];
            Bus::where('id',$request['id'])->update($arr);
        }
    }

    public function delete($id)
    {
        $query=Bus::where('id',$id)->delete();
        return $query;
    }

}


?>