@extends('layout.layout')

@php
    $title = 'Dashboard';
    $subTitle = 'Home';
@endphp

@section('content')
<div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Leads</p>
                        <h6 class="mb-0">{{ $stats['leads_count'] }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-2 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total FAQs</p>
                        <h6 class="mb-0">{{ $stats['faqs_count'] }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fa-solid:question-circle" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-3 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Video Stories</p>
                        <h6 class="mb-0">{{ $stats['stories_count'] }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fluent:people-community-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Customer Reviews</p>
                        <h6 class="mb-0">{{ $stats['testimonials_count'] }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-warning rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="solar:chat-round-dots-outline" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-4 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Blogs</p>
                        <h6 class="mb-0">{{ $stats['blogs_count'] }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="solar:document-text-outline" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Total Services</p>
                        <h6 class="mb-0">{{ $stats['services_count'] }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="solar:medical-kit-outline" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base py-16 px-24">
            <h6 class="text-lg fw-semibold mb-0">Quick Links</h6>
        </div>
        <div class="card-body p-24">
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('admin.leads') }}" class="btn btn-primary">View Leads</a>
                <a href="{{ route('admin.faqs') }}" class="btn btn-info">Manage FAQs</a>
                <a href="{{ route('admin.stories') }}" class="btn btn-success">Video Stories</a>
                <a href="{{ route('admin.testimonials') }}" class="btn btn-warning">Customer Reviews</a>
                <a href="{{ route('admin.blogs') }}" class="btn btn-primary" style="background-color: #4f84ae; border-color: #4f84ae;">Manage Blogs</a>
                <a href="{{ route('admin.services') }}" class="btn btn-info" style="background-color: #b82430; border-color: #b82430;">Manage Services</a>
                <a href="{{ route('admin.settings') }}" class="btn btn-warning">Site Settings</a>
            </div>
        </div>
    </div>
</div>
@endsection
