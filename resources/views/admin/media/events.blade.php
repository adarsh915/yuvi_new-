@extends('layout.layout')

@php
    $title = 'Manage Media Events';
    $subTitle = 'Media Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#eventTable").DataTable();
            });

            function editEvent(id, title, desc, date, link, active, order) {
                $("#editModal").modal("show");
                $("#edit_title").val(title);
                $("#edit_description").val(desc);
                $("#edit_date_text").val(date);
                $("#edit_link").val(link);
                $("#edit_order").val(order);
                $("#edit_is_active").prop("checked", active == 1);
                $("#editForm").attr("action", "/admin/media-events/" + id);
            }
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
    .form-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d !important;
    }
    .btn {
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
</style>

<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                <iconify-icon icon="solar:calendar-add-outline" class="text-primary-600"></iconify-icon>
                Add New Event
            </h6>
            <form action="{{ route('admin.media-events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-20">
                    <label class="form-label mb-8">Event Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Event Name" required>
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Date Text</label>
                    <input type="text" name="date_text" class="form-control" placeholder="e.g. March 2026">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Event Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">External Link (Optional)</label>
                    <input type="url" name="link" class="form-control" placeholder="https://...">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Brief details..."></textarea>
                </div>
                <div class="mb-20 d-flex align-items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
                    <label class="form-label mb-0" for="is_active">Active</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                    Create Event
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card radius-12 bg-base h-100">
            <div class="card-header border-bottom p-24">
                <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:gallery-wide-outline" class="text-primary-600"></iconify-icon>
                    Events List
                </h6>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0" id="eventTable">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="" class="radius-8" style="width: 48px; height: 48px; object-fit: cover;">
                                        @else
                                            <div class="radius-8 bg-light d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <iconify-icon icon="solar:gallery-outline" class="text-secondary"></iconify-icon>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-semibold text-primary-600">{{ $event->title }}</div>
                                            <div class="text-xs text-secondary-light line-clamp-1" title="{{ $event->description }}">{{ $event->description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info-focus text-info-main">{{ $event->date_text }}</span>
                                </td>
                                <td>
                                    @if($event->is_active)
                                        <span class="badge bg-success-focus text-success-main">Active</span>
                                    @else
                                        <span class="badge bg-danger-focus text-danger-main">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-outline-info" 
                                                style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                onclick='editEvent({{ $event->id }}, @json($event->title), @json($event->description), @json($event->date_text), @json($event->link), {{ $event->is_active }}, {{ $event->order }})'>
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <form action="{{ route('admin.media-events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Delete this event?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="width:32px; height:32px; padding:0; border-radius:8px;">
                                                <i class="ri-delete-bin-line"></i>
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
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                    Edit Media Event
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Event Title</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Date Text</label>
                            <input type="text" name="date_text" id="edit_date_text" class="form-control">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Order</label>
                            <input type="number" name="order" id="edit_order" class="form-control" min="0">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">External Link</label>
                            <input type="url" name="link" id="edit_link" class="form-control">
                        </div>
                        <div class="col-md-12 mb-20">
                            <label class="form-label mb-8">Event Image (Optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-12 mb-20">
                            <label class="form-label mb-8">Description</label>
                            <textarea name="description" id="edit_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="col-md-12 mb-20 d-flex align-items-center gap-2">
                            <input type="checkbox" name="is_active" id="edit_is_active" class="form-check-input">
                            <label class="form-label mb-0" for="edit_is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
