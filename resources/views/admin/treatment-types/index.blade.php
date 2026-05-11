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
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Treatment Types</h6>
        <button class="btn btn-primary btn-sm radius-8" data-bs-toggle="modal" data-bs-target="#addModal">
            <iconify-icon icon="solar:add-circle-outline" class="me-1"></iconify-icon> Add Type
        </button>
    </div>

    <div class="card-body p-24">
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
                            <div class="fw-medium text-primary-600">{{ $treatment->name }}</div>
                        </td>
                        <td>
                            <div class="text-sm" style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $treatment->description }}">
                                {{ $treatment->description ? Str::limit($treatment->description, 60) : '-' }}
                            </div>
                        </td>
                        <td>{{ $treatment->order }}</td>
                        <td>
                            <span class="badge {{ $treatment->is_active ? 'bg-success-focus text-success-main fw-medium' : 'bg-danger-focus text-danger-main fw-medium' }}">
                                {{ $treatment->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-sm btn-outline-info radius-8" 
                                        onclick="editTreatment({{ $treatment->id }}, '{{ addslashes($treatment->name) }}', '{{ addslashes($treatment->description) }}', {{ $treatment->order }}, {{ $treatment->is_active ? 'true' : 'false' }})">
                                    <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon> Edit
                                </button>
                                <form action="{{ route('admin.treatment-types.destroy', $treatment->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this treatment type?')">
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

<!-- Add Treatment Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Treatment Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.treatment-types.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Treatment Name *</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. IVF Success" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Description (Optional)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief description of this treatment..."></textarea>
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
                    <button type="submit" class="btn btn-primary">Save Treatment Type</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Treatment Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Treatment Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Treatment Name *</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Description (Optional)</label>
                        <textarea id="edit_description" name="description" class="form-control" rows="3"></textarea>
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
                    <button type="submit" class="btn btn-primary">Update Treatment Type</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
