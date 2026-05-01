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
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Services List</h6>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm radius-8">
            <iconify-icon icon="solar:add-circle-outline" class="me-1"></iconify-icon> Add New Service
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
                        <th>Tag</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $service->order }}</td>
                        <td>
                            @if($service->listing_image)
                                <img src="{{ asset('storage/' . $service->listing_image) }}" alt="{{ $service->title }}"
                                     style="width:60px; height:45px; object-fit:cover; border-radius:6px;">
                            @else
                                <div style="width:60px; height:45px; background:#f1f5f9; border-radius:6px; display:flex; align-items:center; justify-content:center;">
                                    <iconify-icon icon="solar:gallery-outline" class="text-secondary-light"></iconify-icon>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $service->title }}</div>
                            <div class="text-sm text-secondary-light text-truncate" style="max-width:220px;">{{ $service->short_description }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info-focus text-info-main fw-medium px-8 py-4 radius-4 text-sm">
                                {{ $service->category_tag }}
                            </span>
                        </td>
                        <td>
                            @if($service->is_active)
                                <span class="badge bg-success-focus text-success-main fw-medium">Active</span>
                            @else
                                <span class="badge bg-danger-focus text-danger-main fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-info">
                                    <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon> Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this service? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-32 text-secondary-light">
                            <iconify-icon icon="solar:bill-list-outline" class="text-4xl mb-8 d-block"></iconify-icon>
                            No services yet. <a href="{{ route('admin.services.create') }}">Add your first service.</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
