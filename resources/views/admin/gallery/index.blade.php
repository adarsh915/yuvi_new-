@extends('layout.layout')

@php
    $title = 'Gallery';
    $subTitle = 'Manage Gallery Images';
    $script = '
        <script>
            $(document).ready(function() {
                $("#galleryTable").DataTable({
                    "order": [[0, "desc"]]
                });
            });

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
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Gallery Images</h6>
        <button class="btn btn-primary btn-sm radius-8" data-bs-toggle="modal" data-bs-target="#addModal">
            <iconify-icon icon="solar:add-circle-outline" class="me-1"></iconify-icon> Add Image
        </button>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="galleryTable">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($galleries as $gallery)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}" 
                                 style="width: 80px; height: 60px; border-radius: 6px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-medium text-primary-600">{{ $gallery->title }}</div>
                        </td>
                        <td>
                            <div class="text-sm text-secondary-light">{{ $gallery->subtitle ?? '-' }}</div>
                        </td>
                        <td>{{ $gallery->order }}</td>
                        <td>
                            <span class="badge {{ $gallery->is_active ? 'bg-success-focus text-success-main fw-medium' : 'bg-danger-focus text-danger-main fw-medium' }}">
                                {{ $gallery->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-info radius-8" 
                                        onclick="editGallery({{ $gallery->id }}, '{{ addslashes($gallery->title) }}', '{{ addslashes($gallery->subtitle) }}', '{{ asset('storage/' . $gallery->image) }}', {{ $gallery->order }}, {{ $gallery->is_active ? 'true' : 'false' }})">
                                    <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon> Edit
                                </button>
                                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this image?')">
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

<!-- Add Gallery Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Gallery Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Image Title *</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Treatment Room" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Subtitle (Optional)</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="e.g. State of the art facility">
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Image *</label>
                        <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" required>
                        <div class="text-xs text-secondary-light mt-4">Max 5MB. Formats: JPEG, PNG, JPG, GIF, WEBP</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                                <input type="number" name="order" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-20">
                                <div class="form-check form-switch pt-12">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="addIsActive" checked>
                                    <label class="form-check-label" for="addIsActive">Is Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Gallery Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Gallery Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Image Title *</label>
                        <input type="text" id="edit_title" name="title" class="form-control" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Subtitle (Optional)</label>
                        <input type="text" id="edit_subtitle" name="subtitle" class="form-control">
                    </div>

                    <div class="mb-20">
                        <div id="photoPreview" style="display: none; margin-bottom: 10px;">
                            <img id="photoImg" src="" alt="Photo" style="max-width: 100%; max-height: 250px; border-radius: 6px; object-fit: contain;">
                        </div>
                        <label class="form-label fw-semibold text-sm mb-8">Image (Optional)</label>
                        <input type="file" id="edit_image" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewPhoto(event)">
                        <div class="text-xs text-secondary-light mt-4">Max 5MB. Formats: JPEG, PNG, JPG, GIF, WEBP</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                                <input type="number" id="edit_order" name="order" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-20">
                                <div class="form-check form-switch pt-12">
                                    <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active">
                                    <label class="form-check-label" for="edit_is_active">Is Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
