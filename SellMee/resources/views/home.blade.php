@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}<br />
                        <h2>Welcome,{{ Auth::user()->name }}</h2><br />
                        <div class="card-body">
                            <div class="row p-3">
                                <div class="col-4">
                                    @if ($profile->getFirstMediaUrl('profile_images'))
                                        <img src="{{ $profile->getFirstMediaUrl('profile_images') }}" alt="profile image" style="width: 100px; height:100px;  border-radius:50%; object-fit:cover;">
                                    @endif
                                </div>
                                <div class="col-8">
                                    <h3>Your Address</h3>
                                    <p><b>Addresss: </b>{{ $profile->address}}</p>
                                    <p><b>Phone number: </b>{{ $profile->phone }}</p>
                                    <p>
                                        <a href="{{ route('profile.edit', $profile) }}" class="btn btn-info">Update Profile</a>
                                    </p>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
