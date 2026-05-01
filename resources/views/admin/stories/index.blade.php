@extends('layout.layout')

@php
    $title = 'Success Stories';
    $subTitle = 'Patient Journeys';
    $script = '
        <script>
            function editStory(id, title, url, type, name, order, is_active) {
                $("#editModal").modal("show");
                $("#edit_title").val(title);
                $("#edit_video_url").val(url);
                $("#edit_treatment_type").val(type);
                $("#edit_patient_name").val(name);
                $("#edit_order").val(order);
                $("#edit_is_active").prop("checked", is_active == 1);
                $("#editForm").attr("action", "/admin/stories/" + id);
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
                    <label class="form-label fw-semibold text-sm mb-8">Treatment Type</label>
                    <input type="text" name="treatment_type" class="form-control" placeholder="e.g. IVF Success" required>
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
                <table class="table bordered-table mb-0">
                    <thead>
                        <tr>
                            <th>Video</th>
                            <th>Info</th>
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
                                <div class="text-xs text-secondary-light">{{ $story->treatment_type }}</div>
                            </td>
                            <td>{{ $story->order }}</td>
                            <td>
                                <span class="badge {{ $story->is_active ? 'bg-success-focus text-success-main' : 'bg-danger-focus text-danger-main' }}">
                                    {{ $story->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick="editStory({{ $story->id }}, '{{ $story->title }}', '{{ $story->video_url }}', '{{ $story->treatment_type }}', '{{ $story->patient_name }}', {{ $story->order }}, {{ $story->is_active }})">
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                    </button>
                                    <form action="{{ route('admin.stories.destroy', $story->id) }}" method="POST" onsubmit="return confirm('Delete this story?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
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
    <div class="modal-dialog">
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
                        <label class="form-label fw-semibold text-sm mb-8">Story Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Video URL</label>
                        <input type="url" name="video_url" id="edit_video_url" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Treatment Type</label>
                        <input type="text" name="treatment_type" id="edit_treatment_type" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Patient Name</label>
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
