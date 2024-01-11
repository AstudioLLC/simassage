@extends('admin.layouts.app')

@section('content')

<div class="header bg-primary py-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-12 col-12 text-right">


                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="container mt-4">
                <h1 class="text-white mb-4">Job Application Details</h1>
                <div class="mt-5">
                    <p><strong>ID:</strong> {{ $item['id'] }}</p>
                    <p><strong>Name:</strong> {{ $item['name'] }}</p>
                    <p><strong>Phone:</strong> {{ $item['phone'] }}</p>
                    <p><strong>Email:</strong> {{ $item['email'] }}</p>
                    <p><strong>Position:</strong> {{ $item['job_position'] }}</p>
                    <p><strong>Message:</strong> {{ $item['message'] }}</p>
{{--                    <p><strong>CV File:</strong> <a href="{{ route('admin.applyJobs.download', ['id' => $item['id']]) }}">Download CV</a></p>--}}
                </div>
            </div>
    </div>
</div>
@include('admin.layouts.footers.auth')
@include('admin.pages.applyJobs._script')
@endsection
