@extends('seekers.layout.master')
@section('title', get_setting('name')." Seeker Dashboard")
@push('css')
    <style>
        .counter_card{
            background: linear-gradient(45deg, #5dff79, #ccffc4);
            border-radius: 10px;
            box-shadow: 0px 4px 8px 0px #a1a1a1;
        }
    </style>
@endpush
@section('seeker_content')
    <h1>Seeker Save ALl Jobs</h1>
@endsection
