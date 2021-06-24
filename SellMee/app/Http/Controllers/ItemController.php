<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Events\ItemEvent;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(){
        $this->middleware('adminOnly')->only(['edit','delete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $info['items']=Item::orderBy('id','desc')->get();
        return view('items.index',$info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('items.create');
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
             'name'=>'required',
             'available_item'=>'required',
             'price_per'=>'required',

        ]);
        $data=$request->all();

        $item=new Item($data);
        $item->save();

        if($request->image){
            $item->addMediaFromRequest('image')->toMediaCollection('item_images');
        }
        event(new ItemEvent($item));
        
        return redirect()->route('item.index')->with('sucess','Item Add Sucessfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
        $item = Item::findOrFail($item->id);
        $info['item']=$item;
        return view('items.show',$info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
        $item =Item::findOrFail($item->id);
        $info['item']=$item;
        return view('items.edit',$info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
        $request->validate([
            'name' => 'required',
            'available_item' => 'required',
            'price_per' => 'required',
        ]);
        $item = Item::findOrFail($item->id);
        $item->name=$request['name'];
        $item->available_item=$request['available_item'];
        $item->price_per=$request['price_per'];
        $item->update();
    
      if($request->image){
        $item->clearMediaCollection('item_images');
        $item->addMediaFromRequest('image')->toMediaCollection('item_images');
      }
      return redirect()->route('item.index')->with('sucess','update sucessfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        $item = Item::findOrFail($item->id);
        if($item->getFirstMediaUrl('item_images'))
        {
            $item->clearMediaCollection('item_images');
        }
        $item->delete();
        return redirect()->route('item.index')->with('sucess','Delete Sucessfully');
    }
    public function markNotification($id)
    {
        $notification = auth()->user()->notifications->find($id);
        $notification->markAsRead();

        $item = Item::findOrFail($notification->data['item_id']);

        return redirect()->route('item.show', $item);
    }
}
