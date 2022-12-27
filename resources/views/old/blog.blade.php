@extends('frontend.layout.master')
@section('title', get_setting('name')." Blogs")
@section('content')
    <!-- Page header -->
    <div class="pt-15 pb-9 ">
        <div class="container">
            <div class="row ">
                <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 col-md-12 col-12">
                    <div class="text-center mb-5">
                        <h1 class=" display-2 fw-bold">Geeks Newsroom</h1>
                        <p class=" lead">
                            Our features, journey, tips and us being us. Lorem ipsum dolor sit amet, accumsan in,
                            tempor
                            dictum neque.
                        </p>
                    </div>
                    <!-- Form -->
                    <form class="row px-md-20">
                        <div class="mb-3 col ps-0  ms-2 ms-md-0">
                            <input type="email" class="form-control" placeholder="Email Address" required="">
                        </div>
                        <div class="mb-3 col-auto ps-0">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="pb-8">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <!-- Flush Nav -->
                    <div class="flush-nav">
                        <nav class="nav">
                            <a class="nav-link active ps-0" href="#">All</a>
                            <a class="nav-link" href="blog-category.html">Courses</a>
                            <a class="nav-link" href="blog-category.html">Workshop</a>
                            <a class="nav-link" href="blog-category.html">Tutorial</a>
                            <a class="nav-link" href="blog-category.html">Company</a>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <!-- Card -->
                    <div class="card mb-4 shadow-lg">
                        <div class="row g-0">
                            <!-- Image -->
                            <a href="blog-single.html" class="col-lg-8 col-md-12 col-12 bg-cover img-left-rounded"
                               style="background-image: url({{ asset('frontend') }}/assets/images/blog/blogpost-2.jpg);">
                                <img src="{{ asset("frontend") }}/assets/images/blog/blogpost-2.jpg" class="img-fluid d-lg-none invisible" alt=""></a>
                            <div class="col-lg-4 col-md-12 col-12">
                                <!-- Card body -->
                                <div class="card-body">
                                    <a href="#" class="fs-5 mb-3 fw-semi-bold d-block">Courses</a>
                                    <h1 class="mb-2 mb-lg-4"> <a href="blog-single.html" class="text-inherit">
                                            Getting started the Web App JavaScript in 2020
                                        </a>
                                    </h1>
                                    <p>Our features, journey, tips and us being us. Lorem ipsum dolor sit amet,
                                        accumsan
                                        in, tempor dictum neque.</p>
                                    <!-- Media content -->
                                    <div class="row align-items-center g-0 mt-lg-7 mt-4">
                                        <div class="col-auto">
                                            <!-- Img  -->
                                            <img src="{{ asset("frontend") }}/assets/images/avatar/avatar-6.jpg" alt="" class="rounded-circle avatar-sm me-2">
                                        </div>
                                        <div class="col lh-1 ">
                                            <h5 class="mb-1">Dustin Warren</h5>
                                            <p class="fs-6 mb-0">September 13, 2020</p>
                                        </div>
                                        <div class="col-auto">

                                            <p class="fs-6 mb-0">6 Min Read</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            @for($i = 0; $i<= 7; $i++)
                                <div class="col-md-6 col-12">
                                    <!-- Card -->
                                    <div class="card mb-4 shadow-lg">
                                        <a href="blog-single.html" class="card-img-top">
                                            <!-- Img  -->
                                            <img src="{{ asset("frontend") }}/assets/images/blog/blogpost-3.jpg" class="card-img-top rounded-top-md" alt=""></a>
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <a href="#" class="fs-5 mb-2 fw-semi-bold d-block text-success">Courses</a>
                                            <h3>
                                                <a href="blog-single.html" class="text-inherit">
                                                    How to become modern Stack Developer in 2020
                                                </a>
                                            </h3>
                                            <p>Lorem ipsum dolor sit amet, accu msan in, tempor dictum nequrem ipsum...</p>
                                            <!-- Media content -->
                                            <div class="row align-items-center g-0 mt-4">
                                                <div class="col-auto">
                                                    <img src="{{ asset("frontend") }}/assets/images/avatar/avatar-7.jpg" alt="" class="rounded-circle avatar-sm me-2">
                                                </div>
                                                <div class="col lh-1">
                                                    <h5 class="mb-1">Reva Yokk</h5>
                                                    <p class="fs-6 mb-0">September 05, 2020</p>
                                                </div>
                                                <div class="col-auto">
                                                    <p class="fs-6 mb-0">20 Min Read</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores dolorum error libero non omnis! Accusantium distinctio error exercitationem illo illum incidunt magni, odit perspiciatis quas, quibusdam repudiandae saepe suscipit voluptatibus!
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttom -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-4">
                    <a href="#" class="btn btn-primary">
                        <div class="spinner-border spinner-border-sm me-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>Load More
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
