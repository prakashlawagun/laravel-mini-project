@extends('layouts.app')
@section('content')
    @include('include.sucess')
    <div class="bg-white p-5">
        @if (count($data) > 0)
            @foreach ($data as $order)
                <div class="row border my-3 py-2">
                    <div class="col-2">
                        <a href="{{route('order.show',$order)}}">
                            @if ($order->getItem->getFirstMediaUrl('item_images'))
                                <img src="{{ $order->getItem->getFirstMediaUrl('item_images') }}"
                                    style="width: 100px; height: 100px; object-fit: cover;" alt=""><br />
                            @endif
                        </a>
                    </div>
                    <div class="col-8">
                        <h4>{{ $order->item }}</h4><br />
                        <p>{{ $order->quantity }}</p>
                        @if ($order->status == 'Packing')
                            <p class="text-info">Packing</p>
                        @elseif($order->status == 'Shipping')
                            <p class="text-primary">Shipping</p>
                        @elseif ($order->status == 'Delivered')
                            <p class="text-success">Delivered</p>
                        @else
                            <p class="text-danger">Canceled</p>
                        @endif
                        @if($order->status=='Packing')
                        <a href="#" class="btn btn-danger">Cancel</a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <h4 class="text-center">No Order placed yet</h4>
        @endif
    </div>
@endsection
