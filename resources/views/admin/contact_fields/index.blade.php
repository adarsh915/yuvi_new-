@extends('layout.layout')

@php
    $title = 'Contact Form Fields';
    $subTitle = 'Form Builder';
    $script = '
        <script>
            $(document).ready(function() {
                $("#fieldTable").DataTable({
                    "order": [[3, "asc"]]
                });
            });

            function editField(id, label, type, options, order, placeholder, is_required) {
                $("#editModal").modal("show");
                $("#edit_label").val(label);
                $("#edit_type").val(type);
                $("#edit_options").val(options);
                $("#edit_order").val(order);
                $("#edit_placeholder").val(placeholder);
                $("#edit_required").prop("checked", is_required == 1);
                $("#editForm").attr("action", "/admin/contact-fields/" + id);
            }
        </script>
    ';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12">
            <h6 class="text-lg fw-semibold mb-20">Add Dynamic Field</h6>
            <form action="{{ route('admin.contact.fields.store') }}" method="POST">
                @csrf
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Field Label</label>
                    <input type="text" name="label" class="form-control" placeholder="e.g. Alternative Phone" required>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Input Type</label>
                    <select name="type" class="form-select" required>
                        <option value="text">Text Input</option>
                        <option value="email">Email</option>
                        <option value="tel">Phone (Tel)</option>
                        <option value="select">Dropdown (Select)</option>
                        <option value="textarea">Textarea</option>
                    </select>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Placeholder</label>
                    <input type="text" name="placeholder" class="form-control" placeholder="Optional placeholder...">
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Options (for Select)</label>
                    <textarea name="options" class="form-control" rows="2" placeholder="Comma separated: Opt 1, Opt 2"></textarea>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                    <input type="number" name="order" class="form-control" value="{{ count($fields) + 1 }}" required>
                </div>
                <div class="mb-20">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_required" id="is_required">
                        <label class="form-check-label" for="is_required">Is Required?</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Field</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card p-24 radius-12 h-100">
            <h6 class="text-lg fw-semibold mb-20">Active Form Fields</h6>
            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="fieldTable">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Type</th>
                            <th>Key (Name)</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fields as $field)
                        <tr>
                            <td>
                                <div class="fw-medium text-primary-600">{{ $field->label }}</div>
                                @if($field->is_required)
                                    <span class="badge bg-danger-focus text-danger-main text-xs">Required</span>
                                @endif
                            </td>
                            <td>{{ ucfirst($field->type) }}</td>
                            <td><code>{{ $field->name }}</code></td>
                            <td>{{ $field->order }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick="editField({{ $field->id }}, '{{ $field->label }}', '{{ $field->type }}', '{{ $field->options }}', {{ $field->order }}, '{{ $field->placeholder }}', {{ $field->is_required }})">
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                    </button>
                                    <form action="{{ route('admin.contact.fields.destroy', $field->id) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure?')">
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
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom-0">
                <h6 class="modal-title">Edit Field</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Field Label</label>
                        <input type="text" name="label" id="edit_label" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Input Type</label>
                        <select name="type" id="edit_type" class="form-select" required>
                            <option value="text">Text Input</option>
                            <option value="email">Email</option>
                            <option value="tel">Phone (Tel)</option>
                            <option value="select">Dropdown (Select)</option>
                            <option value="textarea">Textarea</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Placeholder</label>
                        <input type="text" name="placeholder" id="edit_placeholder" class="form-control">
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Options (for Select)</label>
                        <textarea name="options" id="edit_options" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_required" id="edit_required">
                            <label class="form-check-label" for="edit_required">Is Required?</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Field</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
