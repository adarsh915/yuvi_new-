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
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Homepage Sliders</h6>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm radius-8">
            <iconify-icon icon="solar:add-circle-outline" class="me-1"></iconify-icon> Add New Slider
        </a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="sliderTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                        <tr>
                            <td style="width: 220px;">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider image" style="width: 180px; height: 90px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td>{{ $slider->order }}</td>
                            <td>
                                @if($slider->is_active)
                                    <span class="badge bg-success-focus text-success-main fw-medium">Active</span>
                                @else
                                    <span class="badge bg-danger-focus text-danger-main fw-medium">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-outline-info">
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon> Edit
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Delete this slider? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection