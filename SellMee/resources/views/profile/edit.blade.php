@extends('layouts.app')
@section('content')
    <h3>Update Profile</h3>
    <div class="p-3">
        <form action="{{ route('profile.update', $item) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-6">
                    <label for="">Address *</label>
                    <input type="text"  name="address" value="{{ old('address', $item->address??'') }}" required class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Phone Number *</label>
                    <input type="number" name="phone" value="{{ old('phone', $item->phone??'') }}"required class="form-control">
                </div>
                <div class="col-6">
                    <label for="">Profile Image</label>
                    <input type="file" name="image" class="form-control"><br/>
                </div>
                <div class="col-12">
                    <input type="submit" value="Update" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </div>
@endsection