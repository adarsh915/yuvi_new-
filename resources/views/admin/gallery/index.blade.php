@extends('layout.layout')

@php
    $title = 'Gallery';
    $subTitle = 'Manage Gallery Images';
    $script = '
        <script>

            function editGallery(id, title, subtitle, image, order, is_active) {
                document.getElementById("editForm").action = "/admin/gallery/" + id;
                document.getElementById("edit_title").value = title;
                document.getElementById("edit_subtitle").value = subtitle;
                document.getElementById("edit_order").value = order;
                document.getElementById("edit_is_active").checked = is_active;
                
                const photoPreview = document.getElementById("photoPreview");
                if (image) {
                    document.getElementById("photoImg").src = image;
                    photoPreview.style.display = "block";
                } else {
                    photoPreview.style.display = "none";
                }
                
                const editModal = new bootstrap.Modal(document.getElementById("editModal"));
                editModal.show();
            }

            function previewPhoto(event) {
                const file = event.target.files[0];
                if (file) {
                    const preview = document.getElementById("photoPreview");
                    const img = document.getElementById("photoImg");
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        preview.style.display = "block";
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
    ';
@endphp

@section('content')
<style>
    .gallery-card {
        border: 1px solid #e9ecef;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: #fff;
        height: 100%;
        position: relative;
    }

    .gallery-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .gallery-img-container-v2 {
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        background: #f8f9fa;
        position: relative;
    }

    .gallery-img-container-v2 img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
    }

    .gallery-info {
        padding: 12px;
    }

    .gallery-actions {
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

    /* ── Toggle Row ── */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 14px;
        background: #f8f9fb;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        cursor: pointer;
        transition: all .15s;
        margin: 0;
    }
    .toggle-row:hover { background: #fff; border-color: #dee2e6; }
    .toggle-row .tr-label {
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
        display: block;
    }
    .toggle-row .tr-sub {
        font-size: 11px;
        color: #868e96;
        display: block;
        margin-top: 1px;
    }
    .toggle-row .form-check { padding: 0; margin: 0; }
    .toggle-row .form-check-input {
        width: 40px !important;
        height: 22px !important;
        cursor: pointer;
        margin: 0 !important;
        flex-shrink: 0;
    }
    .svc-field-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:6px;display:block;}
    .svc-field-label .req{color:#dc3545;margin-left:2px;}
</style>

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between py-16 px-24">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:gallery-outline" class="text-primary-600"></iconify-icon>
            Gallery Images
        </h6>
        <button class="btn btn-primary btn-sm radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addModal">
            <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
            Add New Image
        </button>
    </div>

    <div class="card-body p-24">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-20" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($galleries->count() > 0)
            <div class="row gy-4">
                @foreach($galleries as $gallery)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="gallery-card shadow-sm">
                            <div class="gallery-status-badge">
                                @if($gallery->is_active)
                                    <span class="badge bg-success-focus text-success-main d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:check-circle-outline"></iconify-icon> Active
                                    </span>
                                @else
                                    <span class="badge bg-danger-focus text-danger-main d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:close-circle-outline"></iconify-icon> Inactive
                                    </span>
                                @endif
                            </div>
                            <div class="gallery-img-container-v2">
                                <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery Image">
                            </div>
                            <div class="gallery-info">
                                <h6 class="text-sm fw-semibold mb-2 line-clamp-1">{{ $gallery->title }}</h6>
                                <p class="text-xxs text-secondary-light mb-8 line-clamp-1">{{ $gallery->subtitle ?? 'No Subtitle' }}</p>
                                
                                <div class="d-flex align-items-center justify-content-between border-top pt-12">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="text-xs text-secondary-light fw-medium">ORDER</span>
                                        <div class="order-badge">{{ $gallery->order }}</div>
                                    </div>
                                    <div class="gallery-actions">
                                        <button class="btn-icon btn-outline-info d-flex align-items-center justify-content-center"
                                                style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                title="Edit Image"
                                                onclick="editGallery({{ $gallery->id }}, '{{ addslashes($gallery->title) }}', '{{ addslashes($gallery->subtitle) }}', '{{ asset('storage/' . $gallery->image) }}', {{ $gallery->order }}, {{ $gallery->is_active ? 'true' : 'false' }})">
                                            <i class="ri-edit-line" style="font-size: 18px;"></i>
                                        </button>
                                        <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-outline-danger d-flex align-items-center justify-content-center"
                                                    style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                    title="Delete Image">
                                                <i class="ri-delete-bin-line" style="font-size: 18px;"></i>
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
                <iconify-icon icon="solar:gallery-outline" class="text-secondary-light mb-16" style="font-size: 64px;"></iconify-icon>
                <h5 class="text-secondary-light">No Gallery Images Found</h5>
                <p class="text-secondary-light mb-24">Start building your gallery by adding your first image.</p>
                <button class="btn btn-primary radius-8" data-bs-toggle="modal" data-bs-target="#addModal">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Add New Image
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Add Gallery Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:add-circle-outline" class="text-primary-600"></iconify-icon>
                    Add New Gallery Image
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Image Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Clinical Facility" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Subtitle (Optional)</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="Optional context">
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Image File *</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <div class="text-xs text-secondary-light mt-4 d-flex align-items-center gap-1">
                            <iconify-icon icon="solar:info-circle-outline"></iconify-icon>
                            Max 5MB. Formats: JPEG, PNG, JPG, WEBP
                        </div>
                    </div>

                    <div class="row align-items-end mb-20">
                        <div class="col-md-6">
                            <label class="form-label mb-8">Display Order</label>
                            <input type="number" name="order" class="form-control" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">&nbsp;</label>
                            <label class="toggle-row" for="addIsActive">
                                <span class="tr-label">Active Visibility</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="addIsActive" value="1" checked>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                        Save Gallery Image
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Gallery Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                    Edit Gallery Image
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Image Title *</label>
                        <input type="text" id="edit_title" name="title" class="form-control" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Subtitle (Optional)</label>
                        <input type="text" id="edit_subtitle" name="subtitle" class="form-control">
                    </div>

                    <div class="mb-20">
                        <div id="photoPreview" style="display: none; margin-bottom: 12px;" class="p-8 border radius-12 bg-light text-center">
                            <img id="photoImg" src="" alt="Photo" style="max-height: 150px; border-radius: 8px; object-fit: contain;">
                        </div>
                        <label class="form-label mb-8">Change Image (Optional)</label>
                        <input type="file" id="edit_image" name="image" class="form-control" accept="image/*" onchange="previewPhoto(event)">
                    </div>

                    <div class="row align-items-end mb-20">
                        <div class="col-md-6">
                            <label class="form-label mb-8">Display Order</label>
                            <input type="number" id="edit_order" name="order" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">&nbsp;</label>
                            <label class="toggle-row" for="edit_is_active">
                                <span class="tr-label">Active Visibility</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
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

