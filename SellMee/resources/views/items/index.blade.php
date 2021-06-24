@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        @if (auth()->user()->hasRole('superadmin'))
                            @include('include.sucess')<br />
                            <a href="{{ route('item.create') }}" class="btn btn-info mx-auto">+ ADD ITEM</a>
                        @endif
                        @if (count($items) > 0)
                            <div class="flex">
                                @foreach ($items as $item)
                                    <div class="d-inline-block bg-white p-3 mx-3 my-2">
                                        <a href="{{ route('item.show', $item) }}">
                                            <img src="{{ $item->getFirstMediaUrl('item_images') ? $item->getFirstMediaUrl('item_images') : asset('images/item_placeholder_image.jpg') }}"
                                                alt="item image" style="width: 200px; height:200px; object-fit:cover;">
                                        </a>
                                        <h3>{{ $item->name }}</h3>
                                        @if(($item->available_item)>0)
                                        <p>In stock:{{ $item->available_item }}</p>
                                        @else
                                        <p>Not  In Stock</p>
                                        @endif
                                        <p>Rs.{{ $item->price_per }} Per Piece</p>
                                        @if (!auth()->user()->hasRole('superadmin'))
                                            <form action="{{ route('order.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item->id }}" required>
                                                <input type="number" name="quantity" required><br/>
                                                <input type="submit" value="Order" class="btn btn-success" style="margin: 10px;"><br/>
                                            </form>
                                            <form action="{{ route('cart.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item->id }}" required>
                                                <input type="submit" value="+ Add To Cart" class="btn btn-success" style="margin: 10px;"><br/>
                                            </form>
                                        @endif
                                        @if (auth()->user()->hasRole('superadmin'))
                                        <form action="{{route('item.destroy',$item)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger mx-2">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                        @endif
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
