@extends('layouts.app')
@section('content')

<div class="container">
  
<form class="row g-3" action="{{route('order.editOrder',$order->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="item_id" value="{{ $order->id }}" required>
       <div class="col-12">
         <label for="" class="form-label">Quantity:</label>
         <input type="number" class="form-control" id="inputAddress" name="quantity" placeholder="Quantitiy" required>
       </div>
       <div class="col-12">
         <button type="submit" class="btn btn-primary">Update</button>
       </div>
     </form>
</div>

     @endsection