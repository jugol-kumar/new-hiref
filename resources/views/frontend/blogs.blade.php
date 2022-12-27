@extends('frontend.layout.master')
@section('title', get_setting('name')." Blogs")
@push("css")
    <link rel="stylesheet" href="/assets/css/theme.min.css">
    <style>
        .card-img-top img{
            max-height: 250px;
        }
    </style>
@endpush
@section('content')
    <div class="bg-primary py-18 py-lg-18 mb-5 shadow-sm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="d-flex align-items-center justify-content-between flex-column">
                        <h1 class="mb-0 text-white display-4">All Blogs</h1>
                        <form class="d-flex align-items-center form-control" method="get" action="{{  route('all_approve_blogs') }}">
                            @csrf
                            <input type="text" name="searchText" class="form-control border-0" value="{{ $text }}" placeholder="What Your Looking For.......!">
                            <button type="submit" class="btn bg-light-primary btn-sm">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="pb-8">
        <div class="container">
            <div class="row">
<!--                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    &lt;!&ndash; Flush Nav &ndash;&gt;
                    <div class="flush-nav">
                        <nav class="nav">
                            <a class="nav-link active ps-0" href="#">All</a>
                            <a class="nav-link" href="blog-category.html">Courses</a>
                            <a class="nav-link" href="blog-category.html">Workshop</a>
                            <a class="nav-link" href="blog-category.html">Tutorial</a>
                            <a class="nav-link" href="blog-category.html">Company</a>
                        </nav>
                    </div>
                </div>-->
                @forelse($blogs as $key => $blog)
                    @if($key == 0)
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                            <!-- Card -->
                            <div class="card mb-4 shadow-lg">
                                <div class="row g-0">
                                    <!-- Image -->
                                    <a href="{{ route('single_blog', $blog->slug) }}" class="col-lg-8 col-md-12 col-12 bg-cover img-left-rounded"
                                       style="background-image: url({{ $blog->image }});">
                                        <img src="{{ $blog->image }}" class="img-fluid d-lg-none invisible" alt=""></a>
                                    <div class="col-lg-4 col-md-12 col-12">
                                        <!-- Card body -->
                                        <div class="card-body">
                                            <a href="#" class="fs-5 mb-3 fw-semi-bold d-block">Courses</a>
                                            <h1 class="mb-2 mb-lg-4">
                                                <a href="{{ route('single_blog', $blog->slug) }}" class="text-inherit">
                                                    {{ $blog->title }}
                                                </a>
                                            </h1>
                                            <p>{{ $blog->descriptoin }}</p>
                                            <!-- Media content -->
                                            <div class="row align-items-center g-0 mt-lg-7 mt-4">
                                                <div class="col-auto">
                                                    <!-- Img  -->
                                                    <img src="{{ $blog->user->photo }}" alt="" class="rounded-circle avatar-sm me-2">
                                                </div>
                                                <div class="col lh-1 ">
                                                    <h5 class="mb-1">{{ $blog->user->name }}</h5>
                                                    <p class="fs-6 mb-0">{{ $blog->created_at->format('F m, Y') }}</p>
                                                </div>
                                                <div class="col-auto">
                                                    <p class="fs-6 mb-0">{{ $blog->view_count }} Read</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @include('frontend.blog_card')
                @empty
                    <h2>No have blogs</h2>
                @endforelse
                <!-- Buttom -->
                @if($blogs->count() > 16)
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mt-4">
                        <a href="#" class="btn btn-primary">
                            <div class="spinner-border spinner-border-sm me-2" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>Load More
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function searchHere(e){
            $.get(`{{  route('all_approve_blogs', ["?q"=> ""]) }}${e.value}`, (res)=>{
                console.log(res)
            })
            $.ajax({
                url: "{{ route('all_approve_blogs', ["?q"=> ""]) }}"+e.value,
                success:((res)=>{
                    console.log(res);
                })
            })
            console.log(e.value);
        }
    </script>
@endpush
