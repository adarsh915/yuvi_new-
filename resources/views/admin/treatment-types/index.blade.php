@extends('layout.layout')

@php
    $title = 'Treatment Types';
    $subTitle = 'Manage Treatment Categories';
    $script = '
        <script>
            $(document).ready(function() {
                $("#treatmentTable").DataTable({
                    "order": [[0, "desc"]]
                });
            });

            function editTreatment(id, name, description, order, is_active) {
                document.getElementById("editForm").action = "/admin/treatment-types/" + id;
                document.getElementById("edit_name").value = name;
                document.getElementById("edit_description").value = description;
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
        padding: 0 14px;
        background: #f8f9fb;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        cursor: pointer;
        transition: all .15s;
        margin: 0;
        height: 42px; /* Matches standard input height */
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

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:folder-with-files-outline" class="text-primary-600"></iconify-icon>
            Treatment Types
        </h6>
        <button class="btn btn-primary btn-sm radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addModal">
            <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
            Add Type
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
            <table class="table bordered-table mb-0" id="treatmentTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($treatmentTypes as $treatment)
                    <tr>
                        <td>
                            <div class="fw-semibold text-primary-600 d-flex align-items-center gap-2">
                                <iconify-icon icon="solar:tag-outline" class="text-secondary-light"></iconify-icon>
                                {{ $treatment->name }}
                            </div>
                        </td>
                        <td>
                            <div class="text-xs text-secondary-light line-clamp-1" style="max-width: 300px;" title="{{ $treatment->description }}">
                                {{ $treatment->description ? $treatment->description : '-' }}
                            </div>
                        </td>
                        <td>
                            <span class="fw-semibold text-primary-600">{{ $treatment->order }}</span>
                        </td>
                        <td>
                            @if($treatment->is_active)
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
                                        onclick="editTreatment({{ $treatment->id }}, '{{ addslashes($treatment->name) }}', '{{ addslashes($treatment->description) }}', {{ $treatment->order }}, {{ $treatment->is_active ? 'true' : 'false' }})">
                                    <i class="ri-edit-line" style="font-size: 18px;"></i>
                                </button>
                                <form action="{{ route('admin.treatment-types.destroy', $treatment->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this treatment type?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center"
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

<!-- Add Treatment Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:add-circle-outline" class="text-primary-600"></iconify-icon>
                    Add New Treatment Type
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.treatment-types.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Treatment Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. IVF Success" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Description (Optional)</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Brief description of this treatment..."></textarea>
                    </div>

                    <div class="row align-items-end mb-20">
                        <div class="col-md-6">
                            <label class="form-label mb-8">Display Order</label>
                            <input type="number" name="order" class="form-control" placeholder="Leave empty for next available">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">&nbsp;</label>
                            <label class="toggle-row" for="addIsActive">
                                <span class="tr-label">Active Status</span>
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
                        Save Treatment Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Treatment Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                    Edit Treatment Type
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Treatment Name *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label mb-8">Description (Optional)</label>
                        <textarea id="edit_description" name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="row align-items-end mb-20">
                        <div class="col-md-6">
                            <label class="form-label mb-8">Display Order</label>
                            <input type="number" id="edit_order" name="order" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-8">&nbsp;</label>
                            <label class="toggle-row" for="edit_is_active">
                                <span class="tr-label">Active Status</span>
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
                        Update Treatment Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
