@extends('frontend.layout.master')
@section('title', get_setting('name')."Filter Jobs")
@push('css')
    <style>
        .company-bg-image {
            background: url({{ Storage::url($company?->photos[0]?->filename) }}) no-repeat;
            background-position: center;
            background-size: cover;
            height: 400px;
            box-shadow: 0px 9px 18px -5px #ff959587;
        }

        .company-bg-image::after {
            content: "";
            background: linear-gradient(#ff000063, #0000ff69, #00000066);
            position: absolute;
            width: 100% !important;
            height: inherit;
            top: 0;
            left: 0;
        }
    </style>
@endpush
@section('content')

    <!-- Page header -->
    <div class="py-20 company-bg-image"></div>
    <div>
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row align-items-center">
                <!-- col -->
                <div class=" col-12">
                    <div class="d-md-flex align-items-center">
                        <!-- img -->
                        <div class="position-relative mt-n5">
                            <img src="{{ Storage::url($company?->photos[1]?->filename) }}" alt="" width="150" height="150"
                                 class="rounded-3 border bg-white">

                        </div>

                        <div class="w-100 ms-md-4 mt-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <!-- heading -->
                                    <h1 class="mb-0 text-capitalize">{{ $company?->name }}
                                    </h1>
                                    <div>
                                        <!-- reviews -->
                                        <span class="text-dark fw-medium text-black-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                                         class="bi bi-star-fill text-warning align-baseline" viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                    4.5
                                </span>
                                        |
                                        <span class="ms-0 text-black-50">131 Reviews</span>
                                    </div>
                                </div>
                                <div>
                                    <!-- button -->
                                    <a href="#" class="btn btn-outline-primary">Follow</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- nav -->
                    <div>
                        <ul class="nav nav-line-bottom">
                            <li class="nav-item">
                                <a href="{{ route('client.singleCompany', ['company' => $company?->name, 'id' => $company?->id]) }}"
                                   class="nav-link {{ Route::is("client.singleCompany") ? 'active' : '' }}">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('client.singleCompanyJobs', ['company' => $company?->name, 'id' => $company?->id]) }}"
                                   class="nav-link {{ Route::is("client.singleCompanyJobs") ? 'active' : '' }}">
                                    Jobs ({{ $company?->jobs_count }})</a>
                            </li>
                            <li class="nav-item">
                                <a href="company-benefits.html" class="nav-link">Benefits</a>
                            </li>
                            <li class="nav-item">
                                <a href="company-photos.html" class="nav-link">Photos</a>
                            </li>
                            <!--                            <li class="nav-item">
                                                            <a href="company-reviews.html" class="nav-link ">Review <span class="text-inherit">(11.7k)</span></a>
                                                        </li>-->
                        </ul>
                    </div>
                </div>
            </div>
            @yield('companyContent')
        </div>
    </div>
@endsection
