@extends('layouts.app')
@section('content')
    @include('include.sucess')
    <h1 class="text-center">Your Cart Section</h1>
    <div class="bg-white p-5">
        @if (count($data) > 0)
            @foreach ($data as $cart)
                <div class="row border my-3 py-2">
                    <div class="col-2">
                        <a href="#">
                            @if ($cart->getItem->getFirstMediaUrl('item_images'))
                                <img src="{{ $cart->getItem->getFirstMediaUrl('item_images') }}"
                                    style="width: 100px; height: 100px; object-fit: cover;" alt=""><br />
                            @endif
                        </a>
                    </div>
                    <div class="col-8">
                        <h4>{{ $cart->item }}</h4><br />
                        <h4>{{ $cart->quantity}}</h4><br />
                        <p>Rs.{{$cart->price}}</p>
                        <a href="{{route('item.index')}}" class="btn btn-success">Proceed To Buy</a><br/>
                       
                        <form action="{{route('cart.destroy',$cart)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger mx-2 " style="margin:20px;">Remove Cart</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <h4 class="text-center">No Cart Add Yet</h4>
        @endif
    </div>
@endsection
