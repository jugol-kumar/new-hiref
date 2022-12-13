@extends('frontend.layout.master')

@section('title', 'Profile Complete')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
    <div class="bg-light-primary py-lg-14 py-12 bg-cover ">
        <div class="container">
            <div class="col-md-9 mx-auto">
                <div id="courseForm" class="bs-stepper">
                    <div class="row">
                        <div class="print-error-msg text-danger">
                            <ul></ul>
                        </div>
                        <div class="col-lg-12 col-md-8 col-12">
                            <!-- Stepper Button -->
                            <div class="bs-stepper-header shadow-sm" role="tablist">
                                <div class="step" data-target="#test-l-1">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger1" aria-controls="test-l-1">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Job Preference</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-2">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger2" aria-controls="test-l-2">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Profile Details</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-3">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger3" aria-controls="test-l-3">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Experience</span>
                                    </button>
                                </div>
                                <div class="bs-stepper-line"></div>
                                <div class="step" data-target="#test-l-4">
                                    <button type="button" class="step-trigger" role="tab" id="courseFormtrigger4" aria-controls="test-l-4">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Educations</span>
                                    </button>
                                </div>
                            </div>
                            <!-- Stepper content -->
                            <div class="bs-stepper-content mt-5">
                            <!-- Content one -->
                                <div id="test-l-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger1">
                                    <!-- Card -->
                                    <form id="first_stepe">
{{--                                    <form action="{{ route('seeker.firstStapeSave') }}" method="post">--}}
                                        @csrf
                                        <div class="card mb-3 ">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Need a job ?</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Job Type</label>
                                                    <select name="types" class="selectpicker" data-width="100%">
                                                        <option value="">Select Type</option>
                                                        <option value="Full Time">Full Time</option>
                                                        <option value="Part Time">Part Time</option>
                                                        <option value="Contract">Contract</option>
                                                        <!--                                                        <option value="Seasonal">Seasonal</option>
                                                                                                            <option value="Freelance">Freelance</option>
                                                                                                            <option value="Internship">Internship</option>
                                                                                                            <option value="Temporary">Temporary</option>-->
                                                    </select>
                                                    @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Functional Address</label>
                                                    <select class="selectpicker" data-width="100%"
                                                            name="category_id" id="cateogry" onchange="subCateory(this)">
                                                        <option selected disabled  value="">Select category</option>
                                                        @foreach($categories as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                <div class="mb-3" id="subCategoryCard" style="display: none">
                                                    <label for="id_label_multiple form-label">Functional Arias</label>
                                                    <select class="select2"
                                                            data-live-search="true"
                                                            name="subcategories[]"
                                                            data-width="100%" id="id_label_multiple" multiple="multiple">
                                                    </select>
                                                </div>



                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="form-label">Preferred State</label>
                                                            <select class="selectpicker"
                                                                    data-live-search="true"
                                                                    name="division"
                                                                    onchange="getCityByState(this)" data-width="100%">
                                                                <option value="">Select Preferred State</option>
                                                                @foreach($states as $state)
                                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('types')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="col" id="city-card" style="display: none">
                                                            <label class="form-label">Job category</label>
                                                            <select name="district" class="selectpicker"
                                                                    data-live-search="true"
                                                                    onchange="getUpoByDid(this)"
                                                                    data-width="100%"  id="city_id" >
                                                                <option selected disabled  value="">Select child category</option>
                                                            </select>
                                                            @error('child_category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col" id="upozila-card" style="display: none">
                                                            <label class="form-label">Job Places</label>
                                                            <select name="upozillas[]" class="selectpicker"
                                                                    data-live-search="true"
                                                                    multiple="multiple"
                                                                    data-width="100%"  id="upozila_id" >
                                                            </select>
                                                            @error('child_category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3 align-items-center">
                                                        <label class="form-label">Expacted Salary</label>
                                                        <div class="col">
                                                            <input type="number" name="exp_min_sal" class="form-control" placeholder="Min Expected Salary"/>
                                                        </div>
                                                        <-->
                                                        <div class="col">
                                                            <input type="number" name="exp_max_sal" class="form-control" placeholder="Max Expected Salary"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <button type="button" class="btn btn-primary" onclick="fistStapeForm()">
{{--                                        <button type="submit" class="btn btn-primary">--}}
                                            Next
                                        </button>
                                    </form>
                                </div>
                                <!-- Content two -->
                                <div id="test-l-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger2">
                                    <!-- Card -->
                                    <form id="upload_form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card mb-3  border-0">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Personal Details</h4>
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

                                                <div class="mb-3">
                                                    <div class="d-flex align-items-center mb-4 mb-lg-0 justify-content-between">
                                                        <div class="ms-3">
                                                            <h4 class="mb-0">I'm</h4>
                                                        </div>
                                                        <div class="">
                                                            <label>
                                                                <input type="radio" checked name="experience" value="exp">
                                                                <div  class="maleFemale btn-sık">
                                                                    <span>Experienced</span>
                                                                </div>
                                                            </label>
                                                            <label>
                                                                <input  type="radio"  name="experience" value="fre">
                                                                <div class="maleFemale btn-sık">
                                                                    <span>Fresher</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label class="form-label">Job Start Date</label>
                                                    <div class="input-group me-3">
                                                        <input class="form-control flatpickr flatpickr-input active"
                                                               type="text" placeholder="Select Date"
                                                               name="declined_date"
                                                               aria-describedby="basic-addon2" readonly="readonly">
                                                        <span class="input-group-text text-muted" id="basic-addon2">
                                                            <i class="fe fe-calendar"></i>
                                                        </span>
                                                        @error('declined_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" onclick="event.preventDefault();courseForm.previous()">
                                                Previous
                                            </button>
                                            <button type="submit" class="btn btn-primary" onclick="//secondStapeForm()">
                                                Next
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Content three -->
                                <div id="test-l-3" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger3">
                                    <form id="thard_form">
                                        <!-- Card -->
                                        <div class="card mb-3  border-0">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Experience</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body ">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <label class="form-label">Start & End Date <span class="text-danger">*</span></label>
                                                        <div class="col">
                                                            <div class="input-group me-3">
                                                                <input class="form-control flatpickr flatpickr-input active"
                                                                       type="text" placeholder="Select Start Date"
                                                                       name="start_date"
                                                                       aria-describedby="basic-addon2" readonly="readonly">
                                                                <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                @error('declined_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="input-group me-3">
                                                                <input class="form-control flatpickr flatpickr-input active"
                                                                       type="text" placeholder="Select End Date"
                                                                       name="end_date"
                                                                       aria-describedby="basic-addon2" readonly="readonly">
                                                                <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                @error('declined_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <label class="form-label">Start & End Date <span class="text-danger">*</span></label>
                                                        <div class="col">
                                                            <input type="text" name="company_name" class="form-control" placeholder="Company Name" />
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" name="designation" class="form-control" placeholder="Your Designations" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label">Job Content</label>
                                                    <textarea name="job_content" class="form-control" rows="5" placeholder="About Old Experience"></textarea>
                                                    @error('job_content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Button -->
                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-secondary" onclick="event.preventDefault();courseForm.previous()">
                                                Previous
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Next
                                            </button>
                                        </div>
                                    </form>
                                </div>


                                <!-- Content four -->
                                <div id="test-l-4" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="courseFormtrigger4">
                                    <form id="last_form">
                                        <!-- Card -->
                                        <div class="card mb-3  border-0">
                                            <div class="card-header border-bottom px-4 py-3">
                                                <h4 class="mb-0">Hire Eduction's</h4>
                                            </div>
                                            <!-- Card body -->
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <div class="col">
                                                        <label class="form-label">University<span class="text-danger">*</span></label>
                                                        <div class="col">
                                                            <input type="text" name="university" class="form-control" placeholder="Enter University" />
                                                        </div>
                                                        @error('university')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <label class="form-label">Start & End Date Of University <span class="text-danger">*</span></label>
                                                        <div class="col">
                                                            <div class="input-group me-3">
                                                                <input class="form-control flatpickr flatpickr-input active"
                                                                       type="text" placeholder="Select Start Date"
                                                                       name="uni_start_date"
                                                                       aria-describedby="basic-addon2" readonly="readonly">
                                                                <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                @error('declined_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="input-group me-3">
                                                                <input class="form-control flatpickr flatpickr-input active"
                                                                       type="text" placeholder="Select End Date"
                                                                       name="uni_end_date"
                                                                       aria-describedby="basic-addon2" readonly="readonly">
                                                                <span class="input-group-text text-muted" id="basic-addon2"><i class="fe fe-calendar"></i></span>

                                                                @error('declined_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('uni_end_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label">Education Level</label>
                                                            <select class="selectpicker" data-width="100%"
                                                                    name="degree_label" onchange="educations(this)">
                                                                <option selected disabled  value="">Select category</option>
                                                                @foreach($degrees as $deg)
                                                                    <option value="{{ $deg->id }}">{{ $deg->label }}</option>
                                                                @endforeach
                                                            </select>

                                                            @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col mb-3" id="degrees" style="display: none">
                                                        <label class="form-label">Degrees</label>
                                                        <select class="selectpicker"
                                                                data-live-search="true"
                                                                name="degree_id"
                                                                data-width="100%" id="degreesSelect">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-22">
                                            <!-- Button -->
                                            <button type="button" class="btn btn-secondary mt-5" onclick="event.preventDefault();courseForm.previous()">
                                                Previous
                                            </button>
                                            <button type="submit" class="btn btn-danger mt-5 submitButton">
                                                Submit & Complate
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function subCateory(event){
            let categoryId = event.value;
            if (categoryId){
                $.ajax({
                    url: `{{ route('seeker.getSubCat', '') }}/${categoryId}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success:function (data) {
                        if (data.length == 0){
                            $('#subCategory-card').hide('slow');
                            swal({
                                position: 'top-end',
                                type: 'error',
                                title: 'error',
                                text:'no have any Sub Category for this Category',
                                showConfirmButton: true,
                            });
                        }
                        else{
                            $("#subCategoryCard").show();
                            $("#id_label_multiple").select2({
                                tags: false,
                                placeholder: "~~ Functional Arias ~~"
                            });

                            $('#id_label_multiple').empty();
                            $.each(data, function(key, opGroup){
                                var group = $('<optgroup label="' + opGroup.name + '" />');
                                $.each(opGroup.child_categories, function(key, value){
                                    $('<option value="'+[opGroup.id,value.id]+'">'+value.name+'</option>').html(this.name).appendTo(group);
                                });
                                group.appendTo($("#id_label_multiple"));
                            });
                            // $("#id_label_multiple").selectpicker('refresh');
                        }
                    },
                    errors:function (res){
                        return res;
                    }
                })
            } else{
                $('#sub_category').empty();
            }
        }


        function getCityByState(event){
            let stateId = event.value;
            let city = $("#city_id");
            if (stateId) {
                $.ajax({
                    url: `{{ route('seeker.getCities', '') }}/${stateId}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success:function(res){
                        city.empty();
                        $("#city-card").show();
                        city.append('<option selected disabled value="">'+'Select Districts'+'</option>');
                        $.each(res.districts, function (key, value) {
                            city.append('<option value="'+value.id+'" >'+value.name+'</option>');
                        })
                        city.selectpicker('refresh');
                    }
                })
            }
        }

        function getUpoByDid(event){
            let stateId = event.value;
            let upozila = $("#upozila_id");
            if (stateId) {
                $.ajax({
                    url: `{{ route('seeker.getupozela', '') }}/${stateId}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success:function(res){
                        upozila.empty();
                        $("#upozila-card").show();
                        upozila.append('<option disabled value="">'+'Select Districts'+'</option>');
                        $.each(res.upozilas, function (key, value) {
                            upozila.append('<option value="'+value.id+'" >'+value.name+'</option>');
                        })
                        upozila.selectpicker('refresh');
                    }
                })
            }
        }

        function educations(event){
            let eduId = event.value;
            let degree = $("#degreesSelect");
            if (eduId) {
                $.ajax({
                    url: `{{ route('seeker.getEducations', '') }}/${eduId}`,
                    method: 'GET',
                    dataType: 'JSON',
                    success:function(res){
                        degree.empty();
                        $("#degrees").show();
                        degree.append('<option selected disabled value="">'+'Select Degree'+'</option>');
                        $.each(res, function (key, value) {
                            degree.append('<option value="'+value.id+'" >'+value.education_name+'</option>');
                        })
                        degree.selectpicker('refresh');
                    }
                })
            }
        }


        function fistStapeForm(){
            event.preventDefault();

            let data = $("#first_stepe").serialize();
            $.ajax({
                url: `{{ route('seeker.firstStapeSave', '') }}`,
                method: 'POST',
                data : data,
                dataType: 'JSON',
                success:function (res){
                    if (res){
                        courseForm.next()
                    }
                },
                error:function (response){
                    Toast.fire({
                        icon: 'error',
                        title: response.responseJSON.message,
                    })
                    $(".print-error-msg").find("ul").empty();
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $(".print-error-msg").find("ul").append('<li>'+error+'</li>');
                    })
                }
            })
        }


        $('#upload_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('seeker.secondStapeSave') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    if (res){
                        courseForm.next()
                    }
                }
            })
        });


        $('#thard_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('seeker.thirdStapeSave') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    if (res){
                        courseForm.next()
                    }
                }
            })
        });

        $('#last_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('seeker.lastFormSave') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
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
