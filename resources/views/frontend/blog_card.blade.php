<div class="col-xl-4 col-lg-4 col-md-6 col-12">
    <!-- Card -->
    <div class="card mb-4 shadow-lg ">
        <a href="{{ route('single_blog', $blog->slug) }}" class="card-img-top">
            <img src="{{ $blog->image }}" class="card-img-top rounded-top-md" alt="">
        </a>
        <!-- Card body -->
        <div class="card-body">
            <a href="#" class="fs-5 fw-semi-bold d-block mb-3 text-success">{{ $blog->category->name }}</a>
            <a href="{{ route('single_blog', $blog->slug) }}">
                <h3 class="text-success">{{ Str::limit($blog->title, 50) }}</h3>
            </a>
            <p>{{ Str::limit($blog->description, 80) }}</p>
            <!-- Media content -->
            <div class="row align-items-center g-0 mt-4">
                <div class="col-auto">
                    <img src="{{ $blog->user->photo }}" alt="" class="rounded-circle avatar-sm me-2">
                </div>
                <div class="col lh-1">
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
