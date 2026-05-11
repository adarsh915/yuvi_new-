@extends('layout.layout')

@php
    $title = 'Customer Reviews';
    $subTitle = 'Testimonials & Ratings';
    $script = '
        <script>
            $(document).ready(function() {
                $("#testimonialTable").DataTable({
                    "order": [[0, "desc"]]
                });
            });

            function editTestimonial(id, name, rating, review, order, is_active) {
                document.getElementById("editForm").action = "/admin/testimonials/" + id;
                document.getElementById("edit_name").value = name;
                document.getElementById("edit_rating").value = rating;
                document.getElementById("edit_review").value = review;
                document.getElementById("edit_order").value = order;
                document.getElementById("edit_is_active").checked = is_active;
                const editModal = new bootstrap.Modal(document.getElementById("editModal"));
                editModal.show();
            }
        </script>
    ';
@endphp

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Customer Reviews</h6>
        <button class="btn btn-primary btn-sm radius-8" data-bs-toggle="modal" data-bs-target="#addModal">
            <iconify-icon icon="solar:add-circle-outline" class="me-1"></iconify-icon> Add Review
        </button>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="testimonialTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rating</th>
                        <th>Review</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>
                            <div class="fw-medium text-primary-600">{{ $testimonial->name }}</div>
                        </td>
                        <td>
                            <span class="text-warning" title="{{ $testimonial->rating }}/5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $testimonial->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </span>
                        </td>
                        <td>
                            <div class="text-sm" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $testimonial->review }}">
                                {{ Str::limit($testimonial->review, 60) }}
                            </div>
                        </td>
                        <td>{{ $testimonial->order }}</td>
                        <td>
                            <span class="badge {{ $testimonial->is_active ? 'bg-success-focus text-success-main fw-medium' : 'bg-danger-focus text-danger-main fw-medium' }}">
                                {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-info radius-8" 
                                        onclick="editTestimonial({{ $testimonial->id }}, '{{ addslashes($testimonial->name) }}', {{ $testimonial->rating }}, '{{ addslashes($testimonial->review) }}', {{ $testimonial->order }}, {{ $testimonial->is_active ? 'true' : 'false' }})">
                                    <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon> Edit
                                </button>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this review?')">
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

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.testimonials.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Customer Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Rating (Stars) *</label>
                        <select name="rating" class="form-control" required>
                            <option value="">Select Rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent (5)</option>
                            <option value="4">⭐⭐⭐⭐ Very Good (4)</option>
                            <option value="3">⭐⭐⭐ Good (3)</option>
                            <option value="2">⭐⭐ Fair (2)</option>
                            <option value="1">⭐ Poor (1)</option>
                        </select>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Review Text *</label>
                        <textarea name="review" class="form-control" rows="4" placeholder="Share your experience..." required></textarea>
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
                    <button type="submit" class="btn btn-primary">Save Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Testimonial Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Customer Name *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Rating (Stars) *</label>
                        <select id="edit_rating" name="rating" class="form-control" required>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent (5)</option>
                            <option value="4">⭐⭐⭐⭐ Very Good (4)</option>
                            <option value="3">⭐⭐⭐ Good (3)</option>
                            <option value="2">⭐⭐ Fair (2)</option>
                            <option value="1">⭐ Poor (1)</option>
                        </select>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Review Text *</label>
                        <textarea id="edit_review" name="review" class="form-control" rows="4" required></textarea>
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
                    <button type="submit" class="btn btn-primary">Update Review</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

