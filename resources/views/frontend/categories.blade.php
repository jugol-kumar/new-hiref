@extends('frontend.layout.master')
@section('title', get_setting('name')." Categories")
@push("css")
    <link rel="stylesheet" href="/assets/css/theme.min.css">
    <style>
        .card-img-top img{
            max-height: 250px;
        }
    </style>
@endpush
@section('content')

    <!-- Content -->
    <div class="pt-18">
        <div class="container">
            @foreach($categories as $cat)
                <h1 class="mb-4 text-capitalize">{{ $cat->name }}</h1>
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
                    @forelse($cat->sub_categories as $key => $scat)
                        <div class="col-md-3 col-6 mb-5">
                            <a href="{{ route('client.searchJObs', ['s_cat_id' => $cat->id]) }}">
                                <div class="card category-card-shadow rounded-5 category-card-hover">
                                    <div class="card-body py-6">
                                        <div class="d-flex align-items-center justify-content-center flex-column">
                                            <p class="fw-semibold fs-4 text-capitalize text-black">{{ $scat->name }}</p>
                                            <p class="text-black-50">{{ $scat->jobs->count() }}+ jobs</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h2>No have blogs</h2>
                    @endforelse
                </div>
            @endforeach
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
