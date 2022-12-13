@extends('frontend.layout.master')

@section('title', 'verification number')

@section('content')

    <div class="bg-light-primary py-lg-14 py-12 bg-cover ">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Cancle Your Verification Request</h2>
                        <h5>Dare <span class="text-success">{{ Auth::user()->name }}</span></h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab architecto distinctio eligendi ex in libero, molestiae natus placeat quibusdam quidem! Consectetur dolore doloremque, ea facilis molestiae numquam odit sequi. Quo!</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aspernatur commodi, consequatur distinctio earum facere, facilis fugit illo itaque magni necessitatibus nihil nisi odio officia quasi sit ullam vel. Lorem ipsum dolor sit amet, consectetur
                            <a href="#" class="text-success">info@hiref.net</a> adipisicing elit. Cupiditate dicta doloremque eaque eum expedita iusto magnam maiores quos rerum sequi! Aliquid impedit, minus. Autem eius nesciunt, numquam quis quo voluptatum?</p>
                        <a href="/" class="btn btn-primary btn-sm">Go To Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
