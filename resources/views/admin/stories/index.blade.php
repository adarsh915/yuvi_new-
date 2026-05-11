@extends('layout.layout')

@php
    $title = 'Success Stories';
    $subTitle = 'Video Stories & Patient Journeys';
    $script = '
        <script>
            $(document).ready(function() {
                $("#storiesTable").DataTable({
                    "order": [[3, "asc"]]
                });
            });

            function editStory(id, title, url, typeId, name, order, is_active) {
                document.getElementById("editForm").action = "/admin/stories/" + id;
                document.getElementById("edit_title").value = title;
                document.getElementById("edit_video_url").value = url;
                document.getElementById("edit_treatment_type_id").value = typeId;
                document.getElementById("edit_patient_name").value = name;
                document.getElementById("edit_order").value = order;
                document.getElementById("edit_is_active").checked = is_active;
                const editModal = new bootstrap.Modal(document.getElementById("editModal"));
                editModal.show();
            }
        </script>
    ';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-20">Add New Story</h6>
            <form action="{{ route('admin.stories.store') }}" method="POST">
                @csrf
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Story Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. A Journey of Hope" required>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Video URL (YouTube/Instagram)</label>
                    <input type="url" name="video_url" class="form-control" placeholder="https://youtube.com/shorts/..." required>
                    <div class="text-xs text-secondary-light mt-4">Supports YouTube Shorts, Standard YouTube, and Instagram Reels.</div>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Treatment Type *</label>
                    <select name="treatment_type_id" class="form-control" required>
                        <option value="">Select a treatment type</option>
                        @foreach($treatmentTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <div class="text-xs text-secondary-light mt-4">
                        <a href="{{ route('admin.treatment-types') }}" target="_blank">Manage treatment types</a>
                    </div>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Patient Name (Optional)</label>
                    <input type="text" name="patient_name" class="form-control" placeholder="Jane Doe">
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                <div class="mb-20">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                        <label class="form-check-label" for="isActive">Is Active</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Save Story</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card p-24 radius-12 bg-base h-100">
            <h6 class="text-lg fw-semibold mb-20">Manage Stories</h6>
            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="storiesTable">
                    <thead>
                        <tr>
                            <th>Video</th>
                            <th>Info</th>
                            <th>Treatment</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stories as $story)
                        <tr>
                            <td>
                                <div class="radius-8 overflow-hidden" style="width: 120px; height: 80px; background: #000;">
                                    <iframe src="{{ $story->video_url }}" width="100%" height="100%" frameborder="0" style="pointer-events: none;"></iframe>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-primary-600">{{ $story->title }}</div>
                                <div class="text-xs text-secondary-light">{{ $story->patient_name ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="text-sm fw-medium">{{ $story->treatmentType->name ?? '-' }}</div>
                            </td>
                            <td>{{ $story->order }}</td>
                            <td>
                                <span class="badge {{ $story->is_active ? 'bg-success-focus text-success-main' : 'bg-danger-focus text-danger-main' }}">
                                    {{ $story->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info radius-8" 
                                            onclick="editStory({{ $story->id }}, '{{ addslashes($story->title) }}', '{{ $story->video_url }}', {{ $story->treatment_type_id }}, '{{ addslashes($story->patient_name) }}', {{ $story->order }}, {{ $story->is_active }})">
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon> Edit
                                    </button>
                                    <form action="{{ route('admin.stories.destroy', $story->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this story?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger radius-8">
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
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom-0">
                <h6 class="modal-title">Edit Story</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Story Title *</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Video URL *</label>
                        <input type="url" name="video_url" id="edit_video_url" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Treatment Type *</label>
                        <select name="treatment_type_id" id="edit_treatment_type_id" class="form-control" required>
                            @foreach($treatmentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Patient Name (Optional)</label>
                        <input type="text" name="patient_name" id="edit_patient_name" class="form-control">
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control">
                    </div>
                    <div class="mb-20">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                            <label class="form-check-label" for="edit_is_active">Is Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
