@extends('frontend.layout.master')
@section('title', 'Profile bio')

@push('css')
@endpush

@section('content')

    <div class="bg-light-primary py-lg-14 py-12 bg-cover">
        <div class="container">
            <div class="row">
                <div class="col-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Your Profile Is Inactive</h2>
                            <p>
                                Dare <span class="text-success fw-semi-bold">{{ Auth::user()->name }}</span>
                            </p>
                            <p>We get an issue in your profile, so we will deactive you profile. if you want to active again this profile
                            then please contact with us <span class="text-success fw-semi-bold">@companyemail</span></p>
                            <a class="btn btn-success btn-sm" href="{{ route('logout') }}">Back To home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
