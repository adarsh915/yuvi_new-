@extends('layout.layout')

@php
    $title = 'Manage Sliders';
    $subTitle = 'Homepage Sliders';
    $script = '
        <script>
            $(document).ready(function() {
                $("#sliderTable").DataTable({
                    "order": [[1, "asc"]]
                });
            });
        </script>
    ';
@endphp

@section('content')
<style>
    .slider-card {
        border: 1px solid #e9ecef;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: #fff;
        height: 100%;
        position: relative;
    }

    .slider-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .slider-img-container {
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        background: #f8f9fa;
        position: relative;
    }

    .slider-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
    }

    .slider-info {
        padding: 16px;
    }

    .slider-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s;
    }

    .order-badge {
        background: var(--primary-600);
        color: #fff;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .empty-state {
        padding: 60px;
        text-align: center;
        background: #f8f9fa;
        border-radius: 16px;
        border: 2px dashed #dee2e6;
    }
</style>

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:gallery-wide-outline" class="text-primary-600"></iconify-icon>
            Homepage Sliders
        </h6>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
            Add New Slider
        </a>
    </div>

    <div class="card-body p-24">
        @if($sliders->count() > 0)
            <div class="row gy-4">
                @foreach($sliders as $slider)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="slider-card shadow-sm">
                            <div class="slider-status-badge">
                                @if($slider->is_active)
                                    <span class="badge bg-success-focus text-success-main d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:check-circle-outline"></iconify-icon> Active
                                    </span>
                                @else
                                    <span class="badge bg-danger-focus text-danger-main d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:close-circle-outline"></iconify-icon> Inactive
                                    </span>
                                @endif
                            </div>
                            <div class="slider-img-container">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider">
                            </div>
                            <div class="slider-info">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-xs text-secondary-light fw-medium">DISPLAY ORDER</span>
                                        <div class="order-badge">{{ $slider->order }}</div>
                                    </div>
                                    <div class="slider-actions">
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn-icon btn-outline-info" title="Edit Slider">
                                            <iconify-icon icon="solar:pen-new-square-outline" style="font-size: 18px;"></iconify-icon>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Delete this slider?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-outline-danger" title="Delete Slider">
                                                <iconify-icon icon="solar:trash-bin-trash-outline" style="font-size: 18px;"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <iconify-icon icon="solar:gallery-wide-outline" class="text-secondary-light mb-16" style="font-size: 64px;"></iconify-icon>
                <h5 class="text-secondary-light">No Sliders Found</h5>
                <p class="text-secondary-light mb-24">Get started by adding your first homepage slider.</p>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary radius-8">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Add New Slider
                </a>
            </div>
        @endif
    </div>
</div>
@endsection