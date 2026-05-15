@extends('layout.layout')

@php
    $title = 'Manage Media Highlights';
    $subTitle = 'Media Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#highlightTable").DataTable();
            });

            function editHighlight(id, title, type, url, active, order) {
                $("#editModal").modal("show");
                $("#edit_title").val(title);
                $("#edit_type").val(type);
                $("#edit_video_url").val(url);
                $("#edit_order").val(order);
                $("#edit_is_active").prop("checked", active == 1);
                $("#editForm").attr("action", "/admin/media-highlights/" + id);
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
    /* ── Toggle Row ── */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 14px;
        background: #f8f9fb;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        cursor: pointer;
        transition: all .15s;
        margin: 0;
        height: 42px;
    }
    .toggle-row:hover { background: #fff; border-color: #dee2e6; }
    .toggle-row .tr-label { font-size: 13px; font-weight: 600; color: #1a1a2e; }
    .toggle-row .form-check { padding: 0; margin: 0; display: flex; align-items: center; }
    .toggle-row .form-check-input {
        width: 38px !important;
        height: 20px !important;
        cursor: pointer;
        margin: 0 !important;
        flex-shrink: 0;
    }
</style>

<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                <iconify-icon icon="solar:star-circle-outline" class="text-primary-600"></iconify-icon>
                Add Highlight
            </h6>
            <form action="{{ route('admin.media-highlights.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-20">
                    <label class="form-label mb-8">Caption / Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Health Times Feature">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Cover Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Video URL (If Video)</label>
                    <input type="text" name="video_url" class="form-control" placeholder="YouTube/Vimeo link">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Display Order</label>
                    <input type="number" name="order" class="form-control" placeholder="Optional" min="0">
                </div>
                <div class="mb-20">
                    <label class="toggle-row" for="is_active">
                        <span class="tr-label">Active Status</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                        </div>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                    Create Highlight
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card radius-12 bg-base h-100">
            <div class="card-header border-bottom p-24">
                <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:videocamera-record-outline" class="text-primary-600"></iconify-icon>
                    Highlights List
                </h6>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0" id="highlightTable">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>Caption</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($highlights as $highlight)
                            <tr>
                                <td>
                                    @if($highlight->image)
                                        <img src="{{ asset('storage/' . $highlight->image) }}" alt="" class="radius-8" style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="radius-8 bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 40px;">
                                            <iconify-icon icon="solar:gallery-outline" class="text-secondary"></iconify-icon>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-primary-600">{{ $highlight->title ?: 'No caption' }}</div>
                                </td>
                                <td>
                                    @if($highlight->type == 'video')
                                        <span class="badge bg-info-focus text-info-main d-inline-flex align-items-center gap-1">
                                            <iconify-icon icon="solar:play-circle-outline"></iconify-icon> Video
                                        </span>
                                    @else
                                        <span class="badge bg-warning-focus text-warning-main d-inline-flex align-items-center gap-1">
                                            <iconify-icon icon="solar:gallery-outline"></iconify-icon> Image
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($highlight->is_active)
                                        <span class="badge bg-success-focus text-success-main">Active</span>
                                    @else
                                        <span class="badge bg-danger-focus text-danger-main">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-outline-info" 
                                                style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                onclick='editHighlight({{ $highlight->id }}, @json($highlight->title), @json($highlight->type), @json($highlight->video_url), {{ $highlight->is_active }}, {{ $highlight->order }})'>
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <form action="{{ route('admin.media-highlights.destroy', $highlight->id) }}" method="POST" onsubmit="return confirm('Delete highlight?')">
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
    <div class="modal-dialog">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                    Edit Highlight
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Caption / Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control">
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Type</label>
                        <select name="type" id="edit_type" class="form-select" required>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Cover Image (Optional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Video URL</label>
                        <input type="text" name="video_url" id="edit_video_url" class="form-control">
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control" min="0">
                    </div>
                    <div class="mb-20">
                        <label class="toggle-row" for="edit_is_active">
                            <span class="tr-label">Active Status</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1">
                            </div>
                        </label>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Highlight</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
