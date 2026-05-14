@extends('layout.layout')

@php
    $title = 'Manage Podcasts';
    $subTitle = 'Media Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#podcastTable").DataTable();
            });

            function editPodcast(id, title, desc, ep, dur, spotify, apple, active, order) {
                $("#editModal").modal("show");
                $("#edit_title").val(title);
                $("#edit_description").val(desc);
                $("#edit_episode_no").val(ep);
                $("#edit_duration").val(dur);
                $("#edit_spotify_link").val(spotify);
                $("#edit_apple_link").val(apple);
                $("#edit_order").val(order);
                $("#edit_is_active").prop("checked", active == 1);
                $("#editForm").attr("action", "/admin/media-podcasts/" + id);
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
                <iconify-icon icon="solar:add-circle-outline" class="text-primary-600"></iconify-icon>
                Add New Episode
            </h6>
            <form action="{{ route('admin.media-podcasts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-20">
                    <label class="form-label mb-8">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Episode Title" required>
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Episode Number</label>
                    <input type="text" name="episode_no" class="form-control" placeholder="e.g. Episode 12">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Duration</label>
                    <input type="text" name="duration" class="form-control" placeholder="e.g. 45 mins">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Cover Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Spotify Link</label>
                    <input type="url" name="spotify_link" class="form-control" placeholder="https://open.spotify.com/...">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Apple Podcasts Link</label>
                    <input type="url" name="apple_link" class="form-control" placeholder="https://podcasts.apple.com/...">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Brief summary..."></textarea>
                </div>
                <div class="mb-20 d-flex align-items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
                    <label class="form-label mb-0" for="is_active">Active</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                    Create Episode
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card radius-12 bg-base h-100">
            <div class="card-header border-bottom p-24">
                <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:list-outline" class="text-primary-600"></iconify-icon>
                    Podcasts List
                </h6>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0" id="podcastTable">
                        <thead>
                            <tr>
                                <th>Episode</th>
                                <th>Meta</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($podcasts as $podcast)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        @if($podcast->image)
                                            <img src="{{ asset('storage/' . $podcast->image) }}" alt="" class="radius-8" style="width: 48px; height: 48px; object-fit: cover;">
                                        @else
                                            <div class="radius-8 bg-light d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                                <iconify-icon icon="solar:play-circle-outline" class="text-secondary"></iconify-icon>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-semibold text-primary-600">{{ $podcast->title }}</div>
                                            <div class="text-xs text-secondary-light">{{ $podcast->episode_no }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-xs mb-4">Duration: <b>{{ $podcast->duration }}</b></div>
                                    <div class="d-flex gap-2">
                                        @if($podcast->spotify_link)
                                            <iconify-icon icon="logos:spotify-icon" title="Spotify Link"></iconify-icon>
                                        @endif
                                        @if($podcast->apple_link)
                                            <iconify-icon icon="logos:apple-app-store" title="Apple Podcasts Link"></iconify-icon>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($podcast->is_active)
                                        <span class="badge bg-success-focus text-success-main">Active</span>
                                    @else
                                        <span class="badge bg-danger-focus text-danger-main">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-outline-info" 
                                                style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                onclick='editPodcast({{ $podcast->id }}, @json($podcast->title), @json($podcast->description), @json($podcast->episode_no), @json($podcast->duration), @json($podcast->spotify_link), @json($podcast->apple_link), {{ $podcast->is_active }}, {{ $podcast->order }})'>
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <form action="{{ route('admin.media-podcasts.destroy', $podcast->id) }}" method="POST" onsubmit="return confirm('Delete this episode?')">
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
                    Edit Podcast Episode
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Title</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Episode Number</label>
                            <input type="text" name="episode_no" id="edit_episode_no" class="form-control">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Duration</label>
                            <input type="text" name="duration" id="edit_duration" class="form-control">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Order</label>
                            <input type="number" name="order" id="edit_order" class="form-control" min="0">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Spotify Link</label>
                            <input type="url" name="spotify_link" id="edit_spotify_link" class="form-control">
                        </div>
                        <div class="col-md-6 mb-20">
                            <label class="form-label mb-8">Apple Podcasts Link</label>
                            <input type="url" name="apple_link" id="edit_apple_link" class="form-control">
                        </div>
                        <div class="col-md-12 mb-20">
                            <label class="form-label mb-8">Cover Image (Optional)</label>
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
                    <button type="submit" class="btn btn-primary">Update Episode</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
