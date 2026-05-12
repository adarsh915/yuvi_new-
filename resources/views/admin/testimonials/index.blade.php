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
<style>
    .card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: none;
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

    .star-rating {
        color: #ffc107;
        font-size: 14px;
        display: flex;
        gap: 2px;
    }

    .form-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d !important;
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
    .toggle-row .tr-label { font-size: 13px; font-weight: 600; color: #1a1a2e; display: block; }
    .toggle-row .tr-sub { font-size: 11px; color: #868e96; display: block; margin-top: 1px; }
    .toggle-row .form-check { padding: 0; margin: 0; }
    .toggle-row .form-check-input {
        width: 40px !important;
        height: 22px !important;
        cursor: pointer;
        margin: 0 !important;
        flex-shrink: 0;
    }
</style>

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:chat-round-dots-outline" class="text-primary-600"></iconify-icon>
            Customer Reviews
        </h6>
        <button class="btn btn-primary btn-sm radius-8" data-bs-toggle="modal" data-bs-target="#addModal">
            <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
            Add Review
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
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="testimonialTable">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Review Text</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $testimonial)
                    <tr>
                        <td>
                            <div class="fw-semibold text-primary-600 d-flex align-items-center gap-2">
                                <iconify-icon icon="solar:user-circle-outline" class="text-secondary-light"></iconify-icon>
                                {{ $testimonial->name }}
                            </div>
                        </td>
                        <td>
                            <div class="star-rating" title="{{ $testimonial->rating }}/5">
                                @for($i = 1; $i <= 5; $i++)
                                    <iconify-icon icon="{{ $i <= $testimonial->rating ? 'solar:star-bold' : 'solar:star-outline' }}"></iconify-icon>
                                @endfor
                            </div>
                        </td>
                        <td>
                            <div class="text-xs text-secondary-light line-clamp-2" style="max-width: 300px;" title="{{ $testimonial->review }}">
                                {{ $testimonial->review }}
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold text-primary-600">{{ $testimonial->order }}</span>
                        </td>
                        <td>
                            @if($testimonial->is_active)
                                <span class="badge bg-success-focus text-success-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon> Active
                                </span>
                            @else
                                <span class="badge bg-danger-focus text-danger-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:close-circle-outline"></iconify-icon> Inactive
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center" 
                                        style="width:32px; height:32px; padding:0; border-radius:8px;"
                                        onclick="editTestimonial({{ $testimonial->id }}, '{{ addslashes($testimonial->name) }}', {{ $testimonial->rating }}, '{{ addslashes($testimonial->review) }}', {{ $testimonial->order }}, {{ $testimonial->is_active ? 'true' : 'false' }})">
                                    <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                </button>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this review?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center"
                                            style="width:32px; height:32px; padding:0; border-radius:8px;">
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

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:add-circle-outline" class="text-primary-600"></iconify-icon>
                    Add New Review
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.testimonials.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Customer Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Rating (Stars) *</label>
                        <select name="rating" class="form-select" required>
                            <option value="">Select Rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent (5)</option>
                            <option value="4">⭐⭐⭐⭐ Very Good (4)</option>
                            <option value="3">⭐⭐⭐ Good (3)</option>
                            <option value="2">⭐⭐ Fair (2)</option>
                            <option value="1">⭐ Poor (1)</option>
                        </select>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Review Text *</label>
                        <textarea name="review" class="form-control" rows="5" placeholder="Share your experience..." required></textarea>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Display Order</label>
                        <input type="number" name="order" class="form-control" placeholder="Leave empty for next available">
                    </div>

                    <div class="mb-20">
                        <label class="toggle-row" for="addIsActive">
                            <div>
                                <span class="tr-label">Active</span>
                                <span class="tr-sub">Show this testimonial on the website</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="addIsActive" value="1" checked>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                        Save Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Testimonial Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                    Edit Review
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Customer Name *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Rating (Stars) *</label>
                        <select id="edit_rating" name="rating" class="form-select" required>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent (5)</option>
                            <option value="4">⭐⭐⭐⭐ Very Good (4)</option>
                            <option value="3">⭐⭐⭐ Good (3)</option>
                            <option value="2">⭐⭐ Fair (2)</option>
                            <option value="1">⭐ Poor (1)</option>
                        </select>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Review Text *</label>
                        <textarea id="edit_review" name="review" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Display Order</label>
                        <input type="number" id="edit_order" name="order" class="form-control">
                    </div>

                    <div class="mb-20">
                        <label class="toggle-row" for="edit_is_active">
                            <div>
                                <span class="tr-label">Active</span>
                                <span class="tr-sub">Show this testimonial on the website</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit_is_active" name="is_active" value="1">
                            </div>
                        </label>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                        Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

