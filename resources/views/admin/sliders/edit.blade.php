@extends('layout.layout')

@php
    $title = 'Edit Slider';
    $subTitle = 'Homepage Sliders';
@endphp

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Edit Homepage Slider</h6>
        <a href="{{ route('admin.sliders') }}" class="btn btn-outline-secondary btn-sm radius-8">
            <iconify-icon icon="solar:arrow-left-outline" class="me-1"></iconify-icon> Back to List
        </a>
    </div>

    <div class="card-body p-24">
        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.sliders._form', ['submitButtonText' => 'Update Slider'])
        </form>
    </div>
</div>
@endsection