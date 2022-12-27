@extends('frontend.layout.master')
@section('title', get_setting('name')." Blogs")
@push('meta')
    <meta property="og:image" content="{{ $blog->image }}" />
    <meta property="og:title" content="{{ $blog->title }}" />
    <meta property="og:description" content="{{ $blog->description }}"/>

    <meta name="twitter:title" content="{{ $blog->title }}" />
    <meta name="twitter:image" content="{{ $blog->image }}">
    <meta name="twitter:description" content="{{ $blog->description }}">
@endpush
@push("css")
    <link rel="stylesheet" href="/assets/css/theme.min.css">
@endpush
@section('content')
    <div class="py-4 py-lg-8 pb-14 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-12 mb-2">
                    <div class="text-center mb-4">
                        <a href="/" class="fs-5 fw-semi-bold d-block mb-4 text-primary">Courses</a>
                        <h1 class="display-3 fw-bold mb-4">{{ $blog->title }}</h1>
                        <span class="mb-3 d-inline-block">{{ $blog->view_count }} min read</span>
                    </div>
                    <!-- Media -->
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="d-flex align-items-center">
                            <img src="{{ $blog->user->photo }}" alt="" class="rounded-circle avatar-md">
                            <div class="ms-2 lh-1">
                                <h5 class="mb-1 ">{{ $blog->user->name  }}</h5>
                                <span class="text-primary">{{ $blog->user->role  }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="ms-2 text-muted">Share</span>
                            <a href="#" class="ms-2 text-muted" id="facebook-btn"><i class="mdi mdi-facebook fs-4"></i></a>
                            <a href="#" class="ms-2 text-muted" id="twitter-btn"><i class="mdi mdi-twitter fs-4"></i></a>
                            <a href="#" class="ms-2 text-muted " id="linkedin-btn"><i class="mdi mdi-linkedin fs-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- Image -->
                <div class="col-xl-10 col-lg-10 col-md-12 col-12 mb-6">
                    <img src="{{ $blog->image }}" alt="" class="img-fluid rounded-3 w-100">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8 col-md-12 col-12 mb-2">
                    <!-- Descriptions -->
                    <div>
                        {!! $blog->content !!}
                    </div>
                    <!-- Media -->
                    <hr class="mt-8 mb-5">
                    <h2>Releted Tags:</h2>
                    @foreach(json_decode($blog->tags) as $tag)
                        <span class="badge bg-primary me-1">{{ $tag }}</span>
                    @endforeach
                    <hr class="mt-8 mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div class="d-flex align-items-center">
                            <img src="{{ $blog->user->photo }}" alt="" class="rounded-circle avatar-md">
                            <div class="ms-2 lh-1">
                                <h5 class="mb-1 ">{{ $blog->user->name }}</h5>
                                <span class="text-primary">{{ $blog->user->role }}</span>
                            </div>
                        </div>
                        <div>
                            <span class="ms-2 text-muted">Share</span>
                            <a href="#" class="ms-2 text-muted" id="facebook-btn"><i class="mdi mdi-facebook fs-4"></i></a>
                            <a href="#" class="ms-2 text-muted" id="twitter-btn"><i class="mdi mdi-twitter fs-4"></i></a>
                            <a href="#" class="ms-2 text-muted " id="linkedin-btn"><i class="mdi mdi-linkedin fs-4"></i></a>
                        </div>
                    </div>
                    <!-- Subscribe to Newsletter -->
                    <div class="py-2">
                        @auth
                            <div class="mb-6">
                                @if(Session::has('msg'))
                                    <h2 class="text-success">{{ Session::get('msg') }}</h2>
                                @endif
                            <div class="">
                                <form action="{{ route('submit_comment') }}" method="post">
                                    @csrf
                                    <label for="comment">Write Your Comment</label>
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <textarea name="message" id="comment" cols="30" rows="5" class="form-control" placeholder="message"></textarea>
                                    <button class="btn btn-primary mt-1" type="submit">Comment</button>
                                </form>
                            </div>
                        </div>
                        @endauth
                        @guest
                            <div class="mb-6">
                                <p class="fs-4 display-4"><a href="/register">Sign up</a> or <a href="/login">Login</a> for comment this blog</p>
                            </div>
                        @endguest
                    </div>

                    <div class="py-2">
                        <div class="col-12">
                            @if($blog->comments->count() > 0)
                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col">
                                                @include("inc.dispaly_comments", ['comments' => $blog->comments])
                                            <form action="{{ route('replay_comment') }}" method="post" class="mt-2 d-none" id="replayCommentForm">
                                                @csrf
                                                <input type="hidden" id="commentId" name="commentId" value="">
                                                <input type="hidden" name="blogId" value="{{ $blog->id }}">
                                                <textarea name="message" rows="3" value="" placeholder="Reply Message" class="form-control"></textarea>
                                                <button type="submit" id="replayCommentButton" class="btn btn-sm btn-primary mt-1 btn-sm">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="my-5">
                        <h2>Related Post</h2>
                    </div>
                </div>

                @foreach( $blog->category->blogs as $blog)
                    @include('frontend.blog_card')
                @endforeach
            </div>
        </div>
    </div>

@endsection

@push("js")
    <script>
        // $(document).on("click", ".bookmark", function (e) {
        //     $.post("/bookmark", {id: $(this).data("id")}, function (response) {
        //         if (response.status != 200) {
        //             window.location.replace("/login")
        //         } else {
        //             alert(response.msg)
        //         }
        //     })
        // });



        function replayButton(id){
            $("#commentId").val(id);
            $("#replayCommentForm").removeClass('d-none');
        }



        // Social Share links.
        const facebookBtn = document.getElementById('facebook-btn');
        const linkedinBtn = document.getElementById('linkedin-btn');
        const twitterBtn = document.getElementById('twitter-btn');

        // posturl posttitle

        let postUrl = encodeURI(document.location.href);
        let postTitle = encodeURI('{{$blog->title}}');

        facebookBtn.setAttribute("href",`https://www.facebook.com/sharer.php?u=${postUrl}`);
        twitterBtn.setAttribute("href", `https://twitter.com/share?url=${postUrl}&text=${postTitle}`);
        linkedinBtn.setAttribute("href", `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);

        /*
        const gmailBtn = document.getElementById('gmail-btn');
        const gplusBtn = document.getElementById('gplus-btn');
        const whatsappBtn = document.getElementById('whatsapp-btn');
        const socialLinks = document.getElementById('social-links');

        whatsappBtn.setAttribute("href",`https://wa.me/?text=${postTitle} ${postUrl}`);
        gmailBtn.setAttribute("href",`https://mail.google.com/mail/?view=cm&su=${postTitle}&body=${postUrl}`);
        gplusBtn.setAttribute("href",`https://plus.google.com/share?url=${postUrl}`);
        */


    </script>
@endpush
