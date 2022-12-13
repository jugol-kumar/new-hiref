@extends('frontend.layout.master')
@section('content')
{{--    @include('recruiters.inc.topbar')--}}
    <div class="pt-5 pb-5">
        <div class="container">
            <!-- User info -->

            @include('seekers.inc.user_info')
            <div class="row mt-0 mt-md-4">
                <div class="col-lg-3 col-md-4 col-12">
                    <!-- User profile -->
                    @include('seekers.inc.sidebar')
                </div>
                @yield('seeker_content')
            </div>
        </div>
    </div>
@endsection
