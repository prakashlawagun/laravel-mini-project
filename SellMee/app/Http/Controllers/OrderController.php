<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(){
        $this->middleware('orderCheck')->only('edit');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $order['data']=Order::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        return view('orders.index',$order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'item_id'=>'required',
            'quantity'=>'required',
        ]);

        $data=$request->all();
        $data['user_id']=auth()->user()->id;
        $item=Item::findOrFail($request->item_id);
        $data['price']=$data['quantity']*$item->price_per;
        $data['item']=$item->name;
        
    $order =new Order($data);
    $order->save();
    return redirect()->route('order.index')->with('sucess','Order placed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        $orders = Order::findOrFail($order->id);
        $info['order'] = $orders;

        return view('orders.show', $info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
        $order['order']=Order::findOrFail($order->id);
        return view('orders.edit',$order);

      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
        $request->validate([
            'status'=>'required',
        ]);
        $data=$request->all();
        $order=Order::findOrFail($order->id);
        $order->update($data);
        if(auth()->user()->hasRole('superadmin'))
        return redirect()->route('order.admin',$order)->with('sucess','Order update');

        return redirect()->route('order.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
        $orders= Order::findOrFail($order->id);
        $orders->delete();
        return redirect()->route('order.admin');
    }
    public function admin(){
        $order['orders']=Order::orderBy('id','desc')->get();
        return view('admin.index',$order);
    }
    public function editOrder(Request $request,$id){
        
        $request->validate([
            'quantity'=>'required',
        ]);
        $order=Order::findOrFail($id);

        $item=Item::findOrFail($order->item_id);

        $item->available_item=$item->available_item + $order->quantity;
        $item->available_item=$item->available_item - $request->quantity;
        $item->update();

        $order->quantity=$request->quantity;
        $order->price=$request->quantity*$order->getItem->price_per;
        $order->update();

        return redirect()->route('order.index')->with('sucess','Update sucessful.');
    }
   
}
