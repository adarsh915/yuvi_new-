@extends('layout.layout')

@php
    $title = 'Success Stories';
    $subTitle = 'Video Stories & Patient Journeys';
    $script = "
            <script>
                $(document).ready(function() {
                    $('#storiesTable').DataTable({
                        'order': [[3, 'asc']]
                    });
                });

                $(document).on('click', '.edit-story-btn', function() {
                    const id = $(this).data('id');
                    const title = $(this).data('title');
                    const url = $(this).data('video_url');
                    const typeId = $(this).data('type_id');
                    const name = $(this).data('patient_name');
                    const order = $(this).data('order');
                    const isActive = $(this).data('active');

                    $('#editForm').attr('action', '/admin/stories/' + id);
                    $('#edit_title').val(title);
                    $('#edit_video_url').val(url);
                    $('#edit_treatment_type_id').val(typeId);
                    $('#edit_patient_name').val(name);
                    $('#edit_order').val(order);
                    $('#edit_is_active').prop('checked', isActive == 1);

                    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                    editModal.show();
                });
            </script>
        ";
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

        .card-header {
            padding: 10px 20px !important;
            background: #fff !important;
            border-bottom: 1px solid #e9ecef !important;
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

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .video-preview-wrapper {
            width: 120px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            background: #000;
            border: 1px solid #eee;
            position: relative;
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
        @if ($errors->any())
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show mb-20" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="col-md-4">
            <div class="card p-24 radius-12 bg-base">
                <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:video-library-outline" class="text-primary-600"></iconify-icon>
                    Add New Story
                </h6>
                <form action="{{ route('admin.stories.store') }}" method="POST">
                    @csrf
                    <div class="mb-20">
                        <label class="form-label mb-8">Story Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. A Journey of Hope" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Video URL (YouTube/Instagram)</label>
                        <input type="url" name="video_url" class="form-control" placeholder="https://youtube.com/shorts/..."
                            required>
                        <div class="text-xs text-secondary-light mt-4 d-flex align-items-center gap-1">
                            <iconify-icon icon="solar:info-circle-outline"></iconify-icon>
                            Supports YouTube Shorts & Instagram Reels.
                        </div>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Treatment Type *</label>
                        <select name="treatment_type_id" class="form-select" required>
                            <option value="">Select a treatment type</option>
                            @foreach($treatmentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Patient Name (Optional)</label>
                        <input type="text" name="patient_name" class="form-control" placeholder="Jane Doe">
                    </div>
                    <div class="row align-items-end mb-20">
                        <div class="col-md-6">
                            <label class="form-label mb-8">Display Order</label>
                            <input type="number" name="order" class="form-control" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">&nbsp;</label>
                            <label class="toggle-row" for="isActive">
                                <span class="tr-label">Active</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                                </div>
                            </label>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                        Save Story
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card radius-12 bg-base h-100">
                <div class="card-header border-bottom p-24">
                    <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:play-circle-outline" class="text-primary-600"></iconify-icon>
                        Manage Stories
                    </h6>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="storiesTable">
                            <thead>
                                <tr>
                                    <th>Video</th>
                                    <th>Details</th>
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
                                            <div class="video-preview-wrapper shadow-sm">
                                                <iframe src="{{ $story->video_url }}"
                                                    style="width:100%; height:100%; border:none;"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-primary-600">{{ $story->title }}</div>
                                            <div class="text-xs text-secondary-light line-clamp-1">Patient:
                                                {{ $story->patient_name ?? 'Anonymous' }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info-focus text-info-main">
                                                {{ $story->treatmentType->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-primary-600">{{ $story->order }}</span>
                                        </td>
                                        <td>
                                            @if($story->is_active)
                                                <span class="badge bg-success-focus text-success-main">Active</span>
                                            @else
                                                <span class="badge bg-danger-focus text-danger-main">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                    <button
                                                        class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center edit-story-btn"
                                                        style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                        data-id="{{ $story->id }}" data-title="{{ $story->title }}"
                                                        data-video_url="{{ $story->video_url }}"
                                                        data-type_id="{{ $story->treatment_type_id }}"
                                                        data-patient_name="{{ $story->patient_name }}"
                                                        data-order="{{ $story->order }}"
                                                        data-active="{{ $story->is_active ? 1 : 0 }}">
                                                        <i class="ri-edit-line" style="font-size: 18px;"></i>
                                                    </button>
                                                    <form action="{{ route('admin.stories.destroy', $story->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center"
                                                            style="width:32px; height:32px; padding:0; border-radius:8px;">
                                                            <i class="ri-delete-bin-line" style="font-size: 18px;"></i>
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
                        Edit Story
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-20">
                            <label class="form-label mb-8">Story Title *</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="mb-20">
                            <label class="form-label mb-8">Video URL *</label>
                            <input type="url" name="video_url" id="edit_video_url" class="form-control" required>
                        </div>
                        <div class="mb-20">
                            <label class="form-label mb-8">Treatment Type *</label>
                            <select name="treatment_type_id" id="edit_treatment_type_id" class="form-select" required>
                                @foreach($treatmentTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-20">
                            <label class="form-label mb-8">Patient Name (Optional)</label>
                            <input type="text" name="patient_name" id="edit_patient_name" class="form-control">
                        </div>
                        <div class="row align-items-end mb-20">
                            <div class="col-md-6">
                                <label class="form-label mb-8">Display Order</label>
                                <input type="number" name="order" id="edit_order" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label mb-8">&nbsp;</label>
                                <label class="toggle-row" for="edit_is_active">
                                    <span class="tr-label">Active</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                            Update Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection