@extends('frontend.layout.master')
@section('title', 'Profile bio')

@push('css')

    <style>
        .maleFemale:hover {
            cursor: pointer !important;
        }

        .maleFemale {
            font-size: 15px;
            height: 40px;
            width: 100px;
            border: 1px solid #ebebeb;
            text-align: center;
        }
        .btn-sık {
            min-width: 150px;
            border-radius: 4px;
        }

        input[type="radio"] {
            position: absolute;
            visibility: hidden;
        }
        input[type="radio"] + div {
            position: relative;
        }
        input[type="radio"]:checked + div {
            background-color:  #754ffe;
        }
        input[type="radio"]:checked + div>span {
            color: white;
        }
        input[type="radio"] + div>span {
            position: relative;
            top: 25%;}



        input[type="radio"]:checked + div::before {
            font-family: FontAwesome;
            content: "\f08d";
            position: absolute;
            bottom: 31px;
            font-size: 21px;
            color: white;
            right: -5px;
        }
    </style>


@endpush

@section('content')

    <div class="bg-light-primary py-lg-14 py-12 bg-cover">
        <div class="container">
            <div class="row">
                <div class="col-7 mx-auto">
                    <form id="personal_details">
                        @csrf
                        <div class="card mb-3 ">
                            <div class="card-header border-bottom px-4 py-3">
                                <h4 class="mb-0">Need a job ?</h4>
                            </div>
                            <!-- Card body -->
                            <div class="card-body">

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-4 mb-lg-0 justify-content-between">
                                        <div class="ms-3">
                                            <h4 class="mb-0">Click Image For Change Your avatar</h4>
                                            <p class="mb-0">
                                                Choose PNG or JPG file picture for set your profile picture.
                                            </p>
                                        </div>
                                        <div class="logoSection pe-13">
                                            <div class="icon-shape icon-xxl border rounded-circle position-relative">
                                                <span class="position-absolute imageShow"> <i class="bi bi-image fs-3  text-muted"></i></span>
                                                <input name="profile_pic" class="form-control border-0 opacity-0 uploadFile" type="file" >
                                                @error('profile_pic')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-4 mb-lg-0 justify-content-between">
                                        <div class="ms-3">
                                            <h4 class="mb-0">My gender</h4>
                                        </div>
                                        <div class="">
                                            <label>
                                                <input type="radio" checked name="gender" value="male">
                                                <div  class="maleFemale btn-sık">
                                                    <span>Male</span>
                                                </div>
                                            </label>
                                            <label>
                                                <input  type="radio"  name="gender" value="female">
                                                <div class="maleFemale btn-sık">
                                                    <span>Female</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">First Name</label>
                                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Division</label>
                                        <select id="designation" class="selectpicker" data-width="100%" name="designation">
                                            <option selected disabled value="">Select Your Position On Your Company</option>
                                            <option value="COO">COO</option>
                                            <option value="CMO">CMO</option>
                                            <option value="CTO">CTO</option>
                                            <option value="Founder/CEO">Founder/CEO</option>
                                            <option value="HR">HR</option>
                                            <option value="OTHER">OTHER</option>
                                        </select>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Company Full Name</label>
                                        <input type="text" name="c_full_name" class="form-control" placeholder="Company Full Name">
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Company Short Name</label>
                                        <input type="text" name="c_short_name" class="form-control" placeholder="Company Short Name">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Hot Industry</label>
                                        <input type="text" name="emp_size" class="form-control" placeholder="Hot Industry">
                                    </div>

                                    <div class="col">
                                        <label class="form-label">Employee Size</label>
                                        <input type="text" name="hot_industry" class="form-control" placeholder="Employee Size">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Company Full Address</label>
                                    <textarea name="full_address" class="form-control" placeholder="company full address"></textarea>
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
                url: `{{ route('recruiter.updateBio') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    // console.log(res);
                    window.location.replace(res.url);
                }
            })
        });


        $(function() {
            $(document).on("change", ".uploadFile", function () {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
                if (/^image/.test(files[0].type)) { // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file
                    reader.onloadend = function () { // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".logoSection").find("i").remove();
                        uploadFile.closest(".logoSection").find('.imageShow').css({
                            "background-image": "url(" + this.result + ")",
                            "width": "100%",
                            "height": "100%",
                            "background-position": "center center",
                            "background-size": "cover",
                            "border-radius": "5px"
                        });
                    }
                }
            });
        });


    </script>
@endpush
