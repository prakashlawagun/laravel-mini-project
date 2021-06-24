@extends('layouts.app')
@section('content')
<div class="container">
<form class="row g-3" action="{{route('item.store')}}" method="Post" enctype="multipart/form-data">
 @csrf
    <div class="col-12">
      <label for="" class="form-label">Name</label>
      <input type="text" class="form-control" id="inputAddress" name="name" placeholder="Item Name" required>
    </div>
    <div class="col-12">
      <label for="inputAddress2" class="form-label">Available Item</label>
      <input type="number" class="form-control" id="inputAddress2" name="available_item" placeholder="Item Available" required>
    </div>
    <div class="col-md-6">
      <label for="inputCity" class="form-label">Price</label>
      <input type="number" class="form-control" id="inputCity" name="price_per" placeholder="Price per Piece" required>
    </div>
    <div class="col-6">
        <label for="">Add Photo </label> <br>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">+ ADD ITEM</button>
    </div>
  </form>
</div>
  @endsection