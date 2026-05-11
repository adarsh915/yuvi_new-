@extends('layout.layout')

@php
    $title = 'Contact Form Fields';
    $subTitle = 'Form Builder';
    $categories = [
        'all' => 'All Forms',
        'inclinic_visit' => 'In-Clinic Visit',
        'online_consultation' => 'Online Consultation',
        'whatsapp' => 'WhatsApp'
    ];
    $fieldTypes = [
        'text' => 'Text Input',
        'email' => 'Email',
        'tel' => 'Phone Number',
        'number' => 'Number',
        'date' => 'Date',
        'select' => 'Dropdown',
        'textarea' => 'Textarea'
    ];
    $script = '
        <script>
            let selectedCategory = "all";

            $(document).ready(function() {
                $("#fieldTable").DataTable({
                    "order": [[4, "asc"]],
                    "columnDefs": [{
                        "targets": [1, 2, 3, 5],
                        "searchable": false
                    }]
                });

                // Category filter buttons
                $(".category-filter").on("click", function(e) {
                    e.preventDefault();
                    selectedCategory = $(this).data("category");
                    updateTableDisplay();
                    $(this).addClass("btn-primary").removeClass("btn-outline-primary").siblings(".category-filter:not(.all-filter)").addClass("btn-outline-primary").removeClass("btn-primary");
                    $(".all-filter").toggleClass("btn-light btn-outline-primary");
                });

                // Show/hide options field based on type
                $("#type, #edit_type").on("change", function() {
                    const isSelect = $(this).val() === "select";
                    const optionsField = $(this).closest("form").find(".options-field");
                    if (isSelect) {
                        optionsField.slideDown(300);
                    } else {
                        optionsField.slideUp(300);
                    }
                });

                // Initialize type visibility
                if ($("#type").val() !== "select") {
                    $("#addForm .options-field").hide();
                }
            });

            function updateTableDisplay() {
                $(".fieldRow").each(function() {
                    const rowCategory = $(this).find(".category-badge").data("category");
                    if (selectedCategory === "all") {
                        $(this).show();
                    } else if (rowCategory === selectedCategory || rowCategory === "all") {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            function editField(id, label, type, category, options, order, placeholder, is_required) {
                $("#editModal").modal("show");
                $("#edit_label").val(label);
                $("#edit_type").val(type);
                $("#edit_category").val(category);
                $("#edit_options").val(options);
                $("#edit_order").val(order);
                $("#edit_placeholder").val(placeholder);
                $("#edit_required").prop("checked", is_required == 1);
                
                // Show/hide options based on type
                if (type === "select") {
                    $("#editModal .options-field").show();
                } else {
                    $("#editModal .options-field").hide();
                }
                
                $("#editForm").attr("action", "/admin/contact-fields/" + id);
            }

            function getCategoryLabel(category) {
                const labels = {
                    "all": "All Forms",
                    "inclinic_visit": "In-Clinic Visit",
                    "online_consultation": "Online Consultation",
                    "whatsapp": "WhatsApp"
                };
                return labels[category] || category;
            }
        </script>
    ';
@endphp

@section('content')
<div class="row gy-4">
    <!-- Add Field Form -->
    <div class="col-lg-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-24">
                <iconify-icon icon="solar:add-circle-outline" class="me-2"></iconify-icon>Add New Field
            </h6>
            
            <form action="{{ route('admin.contact.fields.store') }}" method="POST" id="addForm">
                @csrf
                
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Field Label *</label>
                    <input type="text" name="label" class="form-control" placeholder="e.g. Age, Preferred Date" required>
                    <div class="text-xs text-secondary-light mt-4">This will be displayed as the field label</div>
                </div>

                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Input Type *</label>
                    <select name="type" id="type" class="form-select" required>
                        <option value="">-- Select Type --</option>
                        @foreach($fieldTypes as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-20 options-field" style="display: none;">
                    <label class="form-label fw-semibold text-sm mb-8">Options *</label>
                    <textarea name="options" class="form-control" rows="3" placeholder="Comma separated&#10;e.g. Option 1, Option 2, Option 3"></textarea>
                    <div class="text-xs text-secondary-light mt-4">One option per line</div>
                </div>

                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Form Category *</label>
                    <select name="category" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="text-xs text-secondary-light mt-4">Fields with "All Forms" appear in every form</div>
                </div>

                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Placeholder</label>
                    <input type="text" name="placeholder" class="form-control" placeholder="Optional hint text...">
                </div>

                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                    <input type="number" name="order" class="form-control" value="1" min="1" required>
                    <div class="text-xs text-secondary-light mt-4">Must be unique. No two fields can have the same order</div>
                </div>

                <div class="mb-24">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_required" id="is_required">
                        <label class="form-check-label fw-medium" for="is_required">Required Field?</label>
                    </div>
                    <div class="text-xs text-secondary-light mt-4">Users must fill this field to submit</div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <iconify-icon icon="solar:add-circle-outline" class="me-2"></iconify-icon>Add Field
                </button>
            </form>
        </div>
    </div>

    <!-- Fields List -->
    <div class="col-lg-8">
        <div class="card radius-12 bg-base h-100">
            <div class="card-header border-bottom p-24 d-flex align-items-center justify-content-between">
                <h6 class="text-lg fw-semibold mb-0">
                    <iconify-icon icon="solar:list-outline" class="me-2"></iconify-icon>Form Fields
                </h6>
            </div>

            <!-- Category Filter Tabs -->
            <div class="p-24 border-bottom">
                <div class="d-flex gap-2 flex-wrap">
                    <a href="#" class="category-filter all-filter btn btn-sm btn-light" data-category="all">
                        <iconify-icon icon="solar:layers-outline" class="me-1"></iconify-icon>All Fields
                    </a>
                    @foreach($categories as $key => $label)
                        @if($key !== 'all')
                            <a href="#" class="category-filter btn btn-sm btn-outline-primary" data-category="{{ $key }}">
                                {{ $label }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Fields Table -->
            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="fieldTable">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th style="min-width: 120px;">Required</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fields as $field)
                        <tr class="fieldRow">
                            <td>
                                <div class="fw-semibold text-primary-600">{{ $field->label }}</div>
                                @if($field->placeholder)
                                    <div class="text-xs text-secondary-light">{{ $field->placeholder }}</div>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info-focus text-info-main fw-medium">
                                    {{ $fieldTypes[$field->type] ?? ucfirst($field->type) }}
                                </span>
                            </td>
                            <td>
                                <span class="category-badge" data-category="{{ $field->category }}">
                                    @if($field->category === 'all')
                                        <span class="badge bg-secondary-focus text-secondary-main fw-medium">All Forms</span>
                                    @elseif($field->category === 'inclinic_visit')
                                        <span class="badge bg-primary-focus text-primary-main fw-medium">In-Clinic</span>
                                    @elseif($field->category === 'online_consultation')
                                        <span class="badge bg-success-focus text-success-main fw-medium">Online</span>
                                    @elseif($field->category === 'whatsapp')
                                        <span class="badge bg-warning-focus text-warning-main fw-medium">WhatsApp</span>
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if($field->is_required)
                                    <span class="badge bg-danger-focus text-danger-main fw-medium">Required</span>
                                @else
                                    <span class="badge bg-light text-secondary-light fw-medium">Optional</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-semibold text-primary-600">{{ $field->order }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info radius-8" 
                                            onclick="editField({{ $field->id }}, '{{ addslashes($field->label) }}', '{{ $field->type }}', '{{ $field->category }}', '{{ addslashes($field->options) }}', {{ $field->order }}, '{{ addslashes($field->placeholder) }}', {{ $field->is_required }})">
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                    </button>
                                    <form action="{{ route('admin.contact.fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Delete this field? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger radius-8">
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

            @if(count($fields) === 0)
                <div class="p-40 text-center">
                    <div class="mb-16">
                        <iconify-icon icon="solar:inbox-archive-outline" class="text-secondary-light" style="font-size: 48px;"></iconify-icon>
                    </div>
                    <p class="text-secondary-light mb-0">No fields added yet. Create your first field to get started!</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title fw-semibold">Edit Field</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Field Label *</label>
                        <input type="text" name="label" id="edit_label" class="form-control" required>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Input Type *</label>
                        <select name="type" id="edit_type" class="form-select" required>
                            @foreach($fieldTypes as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-20 options-field" style="display: none;">
                        <label class="form-label fw-semibold text-sm mb-8">Options *</label>
                        <textarea name="options" id="edit_options" class="form-control" rows="3" placeholder="Comma separated&#10;e.g. Option 1, Option 2, Option 3"></textarea>
                        <div class="text-xs text-secondary-light mt-4">One option per line</div>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Form Category *</label>
                        <select name="category" id="edit_category" class="form-select" required>
                            @foreach($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Placeholder</label>
                        <input type="text" name="placeholder" id="edit_placeholder" class="form-control">
                    </div>

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control" min="1" required>
                        <div class="text-xs text-secondary-light mt-4">Must be unique. No two fields can have the same order</div>
                    </div>

                    <div class="mb-20">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_required" id="edit_required">
                            <label class="form-check-label fw-medium" for="edit_required">Required Field?</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Field</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
