@extends('frontend.comapny.master')

@section('companyContent')
    <div class="row mt-6">
        <div class="col-12">
            <div class="mb-6">
                <!-- text -->
                <h2 class="mb-3 text-capitalize">{{ $company->jobs->count() }} Jobs Openings</h2>
                @foreach($company->jobs as $job)
                    @include('frontend.inc.job_card', ['value' => $job])
                @endforeach

            <!-- pagination -->
                @if ($company->jobs->lastPage() > 1)
                    @include('frontend.inc.paginations', ['paginators' => $company->jobs])
                @endif
            </div>
        </div>
    </div>
@endsection
