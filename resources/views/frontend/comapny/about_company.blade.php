@extends('frontend.comapny.master')

@section('companyContent')
    <div class="row mt-6">
        <div class="col-12">
            <div class="mb-6">
                <!-- text -->
                <h2 class="mb-3">About the company</h2>
                {!! $company?->details !!}
            </div>
            <!-- text -->
            <!--                    <div class="mb-6">
                                    <h2 class="mb-3">Mission</h2>
                                    <p>Aliquam pellentesque mollis interdum. Proin ligula lacus, maximus quis ante a, luctus sodales
                                        sapien. Donec ut tristique nisi. Nulla a quam sit amet
                                        turpis convallis porttitor vel sed quam. Ut in odio enim. Maecenas eu tellus erat. Maecenas
                                        nec maximus elit, ac suscipit justo. Maecenas nisl
                                        tellus, sodales non gravida eget, placerat sit amet erat. </p>
                                </div>
                                &lt;!&ndash; text &ndash;&gt;
                                <div class="mb-6">
                                    <h2 class="mb-3">Vision</h2>
                                    <p>Proin ligula lacus, maximus quis ante a, luctus sodales sapien. Aliquam pellentesque mollis
                                        interdum. Nulla a quam sit amet turpis convallis port
                                        titor vel sed quam. Donec ut tristique nisi. </p>
                                </div>-->
            <div>
                <!-- table -->

                <table class="table table-borderless w-lg-50 w-md-50">
                    <tr>
                        <td class="ps-0 pb-0"><span class="text-dark fw-semi-bold">Founded:</span></td>
                        <td class="ps-0 pb-0">
                            <span>
                                @php
                                    $date = Carbon\Carbon::parse($company?->starting_date);
                                    $diffYears = \Carbon\Carbon::now()->diffInYears($date);
                                @endphp
                                {{ $diffYears }} Years
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-0 pb-0"><span class="text-dark fw-semi-bold">Company size:</span></td>
                        <td class="ps-0 pb-0"><span>{{ $company?->employee_size }} Employees</span></td>
                    </tr>
                    <tr>
                        <td class="ps-0 pb-0"><span class="text-dark fw-semi-bold">Website:</span></td>
                        <td class="ps-0 pb-0"><a href="{{ $company?->webiste }}" target="_blank">{{ Str::limit($company?->website, 50) }}</a></td>
                    </tr>
                    <tr>
                        <td class="ps-0 pb-0"><span class="text-dark fw-semi-bold">Industry:</span></td>
                        <td class="ps-0 pb-0 text-capitalize">{{ $company?->type }}</td>
                    </tr>
                    <tr>
                        <td class="ps-0 pb-0"><span class="text-dark fw-semi-bold">Social Presence:</span></td>
                        <td class="ps-0 pb-0"> <a href="#" class="mdi mdi-facebook fs-4 text-muted me-2"></a>
                            <a href="#" class="mdi mdi-twitter text-muted me-2"></a>
                            <a href="#" class="mdi mdi-linkedin text-muted "></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
