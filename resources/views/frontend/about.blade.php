@extends('frontend.layout.master')
@section('title', 'About Hiref')

@push('css')
    <style>
        .before-footer{
            background-image: url("{{ asset('frontend/assets/images/footer_banner.png') }}") !important;
            height: 100%;
            background-size: cover;
            background-position: center center;
            min-height: 500px;
        }
    </style>
@endpush

@section('content')

   <!-- Page Content -->
    <div class="pt-18 bg-white">
        <div class="container">


            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mb-12">
                    <!-- caption-->
                    <h1 class="display-2 fw-bold mb-3 text-center">About <span class="text-success">{{ config("app.name") }}</span></h1>
                    <div class="row mt-10">
                        <div class="col-md-4">
                            <img src="https://www.hirect.in/_nuxt/img/img1.6d8ac03.png" class="rounded-4" style="max-width: 100%; min-height: 100%;" alt="">
                        </div>
                        <div class="col-md-4">
                            <div class="row mb-4">
                                <div class="col">
                                    <img src="https://www.hirect.in/_nuxt/img/img2.a9bce8e.png" class="rounded-4" style="max-width: 100%;" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <img src="https://www.hirect.in/_nuxt/img/img3.246bed6.png" class="rounded-4" style="max-width: 100%;" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="https://www.hirect.in/_nuxt/img/img4.75b77d7.png" class="rounded-4" style="max-width: 100%;min-height: 100%;" alt="">
                        </div>
                    </div>

                    <p class="mt-10 mb-0 h4 text-body lh-lg text-center">
                        Hirect was founded in 2018 as a direct hiring application.

                        Our vision of virtually connecting the skill-oriented workforce with high-growth startups and SMEs has manifested into our service provisions.
                        Hirect's AI algorithm helps connect recruiters directly with relevant candidates equipped with desired skills and experience.

                        Our philosophy has always been to simplify the hiring process. Hirect offers direct chat and video call features which
                        have enabled over 3M job seekers to connect directly with over 190K recruiters on our platform.

                        Our commitment to offering a modern and effective solution to the outdated hiring process has allowed
                        recruiters and startups to efficiently improve their hiring process by connecting directly with candidates.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- features -->
    <div class="py-lg-8 py-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12 offset-right-md-6 col-12 mb-6">
                    <!-- caption -->
                    <h2 class="display-2 mb-3 fw-bold text-center">Meet The <span class="text-success">Team</span></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="row">
                        @for($i=0; $i <= 7; $i++)
                            <div class="col-md-3 mb-4">
                                <div class="card rounded-5 category-card-shadow employee-card">
                                    <div class="card-body">
                                        <div class="card-img-top">
                                            <img src="{{ asset("frontend") }}/assets/images/avatar/avatar-1.jpg" alt="" class="img-fluid rounded-4">
                                        </div>

                                        <div class="content">
                                            <h3 class="mt-3 text-center text-capitalize">Raj Das</h3>
                                            <p class="text-center text-black-50 text-capitalize">position and designations</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- features -->
    <div class="py-lg-8 py-10">
        <div class="container">
            <div class="row">
                <div class="col-md-12 offset-right-md-6 col-12 mb-6">
                    <!-- caption -->
                    <h2 class="display-2 mb-3 fw-bold text-center">Milestones</h2>
                </div>
            </div>

            <div class="col-md-8 mx-auto">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-transparent shadow-none">
                            <div class="card-body bg-transparent shadow-none">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="mdi mdi-account-search-outline card-icon-style"></i>
                                    <h4 class="display-2 mt-3 text-success">185k +</h4>
                                    <p>Verified Recruiters</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-transparent shadow-none">
                            <div class="card-body bg-transparent shadow-none">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <i class="mdi mdi-briefcase-search-outline card-icon-style"></i>
                                    <h4 class="display-3 mt-3 text-success text-center">185k +</h4>
                                    <p>Verified Candidates</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   <div class="py-lg-18 pg-12 bg-cover section-bg">
       <!-- container -->
       <div class="container">
           <div class="row">
               <div class="col-md-6 col-12">
                   <div class="card bg-transparent border-0 shadow-none">
                       <div class="card-body p-0">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28947.37629449789!2d88.71781697811342!3d24.91768872963043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fb7f9eb03e849f%3A0xcfcecd76ce68c05!2sMohadevpur!5e0!3m2!1sen!2sbd!4v1672122353764!5m2!1sen!2sbd"
                                   height="450"
                                   style="border:0; width: 100%"
                                   allowfullscreen=""
                                   loading="lazy"
                                   referrerpolicy="no-referrer-when-downgrade"></iframe>
                       </div>
                   </div>
               </div>
               <div class="offset-1 col-md-5 col-12 d-flex flex-column align-items-start justify-content-center">
                   <h1 class="display-3 mb-5">Dhaka Office</h1>

                   <div class="d-flex align-items-end">
                       <i class="fs-2 fw-semibold text-black fw-normal mdi mdi-map-marker-circle"></i>
                       <p class="ms-3">The Imperial Irish Kingdom, Mo-03 (3rd Floor), Merul Badda, Dhaka 1212</p>
                   </div>
                   <div class="d-flex align-items-end">
                       <i class="fs-2 fw-semibold text-black fw-normal mdi mdi-whatsapp"></i>
                       <p class="ms-3">++8801723-717933</p>
                   </div>
                   <div class="d-flex align-items-end">
                       <i class="fs-2 fw-semibold text-black fw-normal mdi mdi-at"></i>
                       <p class="ms-3">jugolkumar23@gmail.com</p>
                   </div>
               </div>
           </div>
       </div>
   </div>


    @include('frontend.inc.before_footer')

@endsection
