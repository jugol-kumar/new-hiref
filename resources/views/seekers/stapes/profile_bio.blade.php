@extends('frontend.layout.master')
@section('title', 'Profile bio')

@push('css')
@endpush

@section('content')

    <div class="bg-light-primary py-lg-14 py-12 bg-cover">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <!-- Bg -->
                    <div class="pt-16 rounded-top-md" style="
                        background: url({{ asset("frontend") }}/assets/images/background/seeker-profile-bg.png) no-repeat;
                        background-size: cover;
                        "></div>
                    <div class="d-flex align-items-end justify-content-between px-4 pt-2 pb-4 rounded-none rounded-bottom-md">
                        <div class="d-flex align-items-center m-auto">
                            <div class="me-2 position-relative d-flex justify-content-end align-items-end mt-n5">
                                <img src="{{ auth()->user()->photo  }}" class="avatar-xl rounded-circle border border-4 border-white position-relative"
                                     alt="" />
                                <a href="#" class="position-absolute top-0 end-0" data-bs-toggle="tooltip" data-placement="top"
                                   title="Verified">
                                    <img src="{{ asset("frontend") }}/assets/images/svg/checked-mark.svg" alt="" height="30" width="30" />
                                </a>
                            </div>
                            <div class="lh-1">
                                <h2 class="mb-0 text-capitalize">{{ auth()->user()->name }}</h2>
                                <p class="mb-0 d-block">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="print-error-msg text-danger text-center">
                    <ul></ul>
                </div>
                <div class="col-10 mx-auto">
                    <form id="personal_details">
                        @csrf
                        <div class="card mb-3 ">
                            <div class="card-header border-bottom px-4 py-3">
                                <h4 class="mb-0">Give your more details.</h4>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control"
                                               @if($user->first_name == null)
                                                    placeholder="Enter First Name"
                                               @else
                                                   value="{{ $user->first_name }}"
                                               @endif
                                        >
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                               @if($user->first_name == null)
                                                placeholder="Enter Last Name"
                                               @else
                                                value="{{ $user->first_name }}"
                                               @endif >
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control"
                                               @if($user->email == null)
                                               placeholder="e.g example@hiref.com"
                                               @else
                                               value="{{ $user->email }}"
                                            @endif >
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Upload Latest Updated CV</label>
                                        <input class="form-control form-control-md" name="resume" id="formFileLg" placeholder="Upload your reume" type="file">
                                    </div>

                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Division</label>
                                    <select name="division" class="selectpicker"
                                            data-live-search="true"
                                            data-width="100%">
                                        <option value="">Select Division</option>
                                        @foreach($districts as $dis)
                                            <option value="{{ $dis->id }}">{{ $dis->name}} / {!!  $dis->bn_name  !!}</option>
                                        @endforeach
                                    </select>
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Full Address</label>
                                        <textarea type="text" name="full_address" class="form-control" >
                                            {{ trim($user->address) }}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">About Yourself</label>
                                        <textarea type="text" name="about_bio" class="form-control" rows="8" placeholder="Please say something about your self">
                                            {{ trim($user->about) }}
                                        </textarea>
                                        <small>Describe yourself about 300 words</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button -->
                        <button type="submit" class="btn btn-primary">
                            Update Details
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });


        $('#personal_details').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('seeker.updateBio') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    window.location.replace(res.url);
                    $('#id_label_multiple').empty();
                },
                error:function (res){

                    Toast.fire({
                        icon: 'error',
                        title: res.responseJSON.message,
                    })
                    $(".print-error-msg").find("ul").empty();
                    $.each(res.responseJSON.errors,function(field_name,error){
                        $(".print-error-msg").find("ul").append('<li>'+error+'</li>');
                    })
                }
            })
        });
    </script>
@endpush
