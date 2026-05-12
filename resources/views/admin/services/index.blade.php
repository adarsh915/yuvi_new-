@extends('layout.layout')

@php
    $title = 'Manage Services';
    $subTitle = 'Service Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#serviceTable").DataTable({
                    "order": [[0, "asc"]]
                });
            });
        </script>
    ';
@endphp

@section('content')
<style>
    .card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: none;
    }

    .card-header {
        padding: 16px 24px !important;
        background: #fff !important;
        border-bottom: 1px solid #e9ecef !important;
    }

</style>

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:globus-outline" class="text-primary-600"></iconify-icon>
            Services List
        </h6>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
            Add New Service
        </a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="serviceTable">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tag</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>
                            <span class="fw-semibold text-primary-600">{{ $service->order }}</span>
                        </td>
                        <td>
                            @if($service->listing_image)
                                <img src="{{ asset('storage/' . $service->listing_image) }}" alt="{{ $service->title }}"
                                     style="width:50px; height:50px; object-fit:cover; border-radius:10px; border: 1px solid #eee;">
                            @else
                                <div style="width:50px; height:50px; background:#f8f9fa; border-radius:10px; display:flex; align-items:center; justify-content:center; border: 1px solid #eee;">
                                    <iconify-icon icon="solar:gallery-outline" class="text-secondary-light" style="font-size: 20px;"></iconify-icon>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $service->title }}</div>
                            <div class="text-xs text-secondary-light">/{{ $service->slug }}</div>
                        </td>
                        <td>
                            <div class="fw-semibold text-primary-600">{{ $service->category->name ?? 'Uncategorized' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info-focus text-info-main">
                                {{ $service->category_tag }}
                            </span>
                        </td>
                        <td>
                            @if($service->is_active)
                                <span class="badge bg-success-focus text-success-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger-focus text-danger-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:close-circle-outline"></iconify-icon>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-info d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                    Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this service? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                        Delete
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
