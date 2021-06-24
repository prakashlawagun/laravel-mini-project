@extends('layouts.app')
@section('content')
<div class="bg-white p-4 row">
    <div class="col-6">
        <img src="{{ $item->getFirstMediaUrl('item_images') ? $item->getFirstMediaUrl('item_images') : asset('images/item_placeholder_image.jpg') }}"
            alt="item image" style="width: 500px; height: 500px; object-fit:cover;">
    </div>
    <div class="col-6 py-4">
        <h3>{{ $item->name }}</h3>
        <p><b>Available:</b>{{$item->available_item}}</p>
        <p><b>Price:</b>Rs.{{ $item->price_per }} per piece</p>
    </div>
</div>
@endsection
