@extends('layout.layout')

@php
    $title = 'Add Slider';
    $subTitle = 'Homepage Sliders';
@endphp

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:add-circle-outline" class="text-primary-600"></iconify-icon>
            Create Homepage Slider
        </h6>
        <a href="{{ route('admin.sliders') }}" class="btn btn-outline-secondary btn-sm radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
            Back to List
        </a>
    </div>

    <div class="card-body p-24">
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.sliders._form', ['submitButtonText' => 'Create Slider'])
        </form>
    </div>
</div>
@endsection