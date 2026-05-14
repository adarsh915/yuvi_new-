@extends('layout.layout')

@php
    $title = 'Contact Form Fields';
    $subTitle = 'Form Builder';
    $categories = [
        'all' => 'All Forms',
        'inclinic_visit' => 'In-Clinic Visit',
        'online_consultation' => 'Online Consultation',
        'whatsapp' => 'NRI Patients'
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
                                            // Toggle card active state
                                            $(document).on("change", ".form-check-input", function() {
                                                const card = $(this).closest(".toggle-card");
                                                if ($(this).is(":checked")) {
                                                    card.addClass("active");
                                                } else {
                                                    card.removeClass("active");
                                                }
                                            });

                                            // Initial state for toggle cards
                                            $(".form-check-input").each(function() {
                                                if ($(this).is(":checked")) {
                                                    $(this).closest(".toggle-card").addClass("active");
                                                }
                                            });
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

                                        function editField(id, label, type, category, options, order, placeholder, is_required, is_active) {
                                            $("#editModal").modal("show");
                                            $("#edit_label").val(label);
                                            $("#edit_type").val(type);
                                            $("#edit_category").val(category);
                                            $("#edit_options").val(options);
                                            $("#edit_order").val(order);
                                            $("#edit_placeholder").val(placeholder);
                                            $("#edit_required").prop("checked", is_required == 1).trigger("change");
                                            $("#edit_active").prop("checked", is_active == 1).trigger("change");

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
                                                "whatsapp": "NRI Patients"
                                            };
                                            return labels[category] || category;
                                        }
                                    </script>
                                ';
@endphp
<style>
    /* ===== PAGE LAYOUT ===== */


    /* ===== CARDS ===== */
    .card.p-24 {
        padding: 0 !important;
    }

    .card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: none;
    }

    .card-header {
        padding: 10px 20px !important;
        background: #fff;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header .header-icon {
        width: 32px;
        height: 32px;
        background: #e8f4fd;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #185FA5;
        font-size: 16px;
        flex-shrink: 0;
    }

    /* ===== FORM BODY ===== */
    .card .form-body,
    .card form {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* ===== FORM LABELS ===== */
    .form-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d !important;
        margin-bottom: 5px !important;
    }

    .form-label.fw-semibold {
        font-weight: 600 !important;
    }

    /* ===== INPUTS, SELECTS, TEXTAREA ===== */
    .form-control,
    .form-select {
        padding: 8px 11px;
        font-size: 13px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background-color: #f8f9fa;
        color: #212529;
        transition: border-color 0.15s, box-shadow 0.15s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        background-color: #fff;
        outline: none;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 72px;
    }

    /* ===== HINT TEXT ===== */
    .text-xs.text-secondary-light {
        font-size: 11px !important;
        color: #adb5bd !important;
        margin-top: 3px;
        line-height: 1.4;
    }

    /* ===== CHECKBOX ROW ===== */
    .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        margin: 0;
    }

    .form-check-input {
        margin: 0;
        flex-shrink: 0;
        cursor: pointer;
    }

    /* ===== FORM SWITCH (Toggle) ===== */
    .form-switch {
        padding-left: 0 !important;
    }
    
    .form-switch .form-check-input {
        width: 38px !important;
        height: 20px !important;
        margin-left: 0 !important;
        cursor: pointer;
    }

    .form-check-label {
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        color: #212529;
        margin: 0;
    }

    /* ===== MODERN TOGGLE CARD ===== */
    .toggle-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .toggle-card:hover {
        border-color: #dee2e6;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }

    .toggle-card.active {
        border-color: rgba(13, 110, 253, 0.2);
        background: #f0f7ff;
    }

    .toggle-card .form-check {
        padding: 0;
        background: transparent;
        border: none;
        margin: 0;
        gap: 0;
    }

    .toggle-card .form-switch {
        padding-left: 0 !important;
        margin-bottom: 0 !important;
        display: flex;
        align-items: center;
    }

    .toggle-card .form-check-input {
        width: 42px !important;
        height: 22px !important;
        cursor: pointer;
        margin: 0 !important;
        background-color: #dee2e6;
        border-color: #dee2e6;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='white'/%3e%3c/svg%3e");
        transition: background-position 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .toggle-card .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .toggle-card .info-box {
        flex: 1;
    }

    .toggle-card .label-text {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 2px;
    }

    .toggle-card .hint-text {
        font-size: 11px;
        color: #718096;
        display: block;
    }

    /* ===== SUBMIT BUTTON ===== */
    .card form .btn.btn-primary.w-100 {
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: none;
        transition: opacity 0.15s;
    }

    .card form .btn.btn-primary.w-100:hover {
        opacity: 0.88;
    }

    /* ===== FILTER TABS ===== */
    .p-24.border-bottom {
        padding: 12px 20px !important;
    }

    .p-24.border-bottom .d-flex.gap-2 {
        gap: 6px !important;
    }

    .category-filter {
        padding: 5px 14px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 500 !important;
        transition: all 0.15s !important;
        border-width: 1px !important;
    }

    .category-filter.btn-light {
        background: #0d6efd !important;
        color: #fff !important;
        border-color: #0d6efd !important;
    }

    .category-filter.btn-outline-primary:hover {
        background: #e8f1ff !important;
        color: #0d6efd !important;
    }

    /* ===== TABLE ===== */
    .table-responsive {
        overflow-x: auto;
    }

    .table.bordered-table {
        width: 100%;
        border-collapse: collapse;
    }



    .table.bordered-table tbody tr {
        border-bottom: 1px solid #f1f3f5;
        transition: background 0.1s;
    }

    .table.bordered-table tbody tr:hover {
        background: #f8f9fa;
    }

    .table.bordered-table tbody tr:last-child {
        border-bottom: none;
    }



    /* field name cell */
    .table.bordered-table td .fw-semibold.text-primary-600 {
        font-size: 13px;
        font-weight: 500;
        color: #1a1a2e;
    }

    .table.bordered-table td .text-xs.text-secondary-light {
        font-size: 11px;
        color: #adb5bd;
        margin-top: 2px;
    }

    /* ===== BADGES ===== */
    .badge {
        padding: 3px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge.bg-info-focus.text-info-main {
        background: #e8f4fd !important;
        color: #185FA5 !important;
    }

    .badge.bg-secondary-focus.text-secondary-main {
        background: #f1f3f5 !important;
        color: #5c636a !important;
    }

    .badge.bg-primary-focus.text-primary-main {
        background: #e8f1ff !important;
        color: #0a58ca !important;
    }

    .badge.bg-success-focus.text-success-main {
        background: #eaf3de !important;
        color: #3B6D11 !important;
    }

    .badge.bg-warning-focus.text-warning-main {
        background: #faeeda !important;
        color: #854F0B !important;
    }

    .badge.bg-danger-focus.text-danger-main {
        background: #fcebeb !important;
        color: #A32D2D !important;
    }

    .badge.bg-light.text-secondary-light {
        background: #f1f3f5 !important;
        color: #868e96 !important;
    }

    /* ===== ACTION BUTTONS ===== */
    .d-flex.align-items-center.gap-2 {
        gap: 6px !important;

    }

    .btn.btn-sm.btn-outline-info.radius-8 {
        width: 30px;
        height: 30px;
        padding: 0;
        border-radius: 8px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        border: 1px solid #dee2e6;
        background: #f8f9fa;
        color: #6c757d;
        transition: all 0.15s;
    }

    .btn.btn-sm.btn-outline-info.radius-8:hover {
        background: #e8f4fd;
        border-color: #86c5f3;
        color: #185FA5;
    }

    .btn.btn-sm.btn-outline-danger.radius-8 {
        width: 30px;
        height: 30px;
        padding: 0;
        border-radius: 8px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        border: 1px solid #dee2e6;
        background: #f8f9fa;
        color: #6c757d;
        transition: all 0.15s;
    }

    .btn.btn-sm.btn-outline-danger.radius-8:hover {
        background: #fcebeb;
        border-color: #f09595;
        color: #A32D2D;
    }

    /* ===== EMPTY STATE ===== */
    .p-40.text-center {
        padding: 48px 20px;
        text-align: center;
    }

    .p-40.text-center iconify-icon {
        font-size: 40px !important;
        display: block;
        margin-bottom: 12px;
        color: #ced4da;
    }

    .p-40.text-center p {
        font-size: 13px;
        color: #adb5bd;
    }

    /* ===== EDIT MODAL ===== */
    .modal-content.radius-16 {
        border-radius: 14px !important;
        border: 1px solid #dee2e6;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .modal-header.border-bottom.bg-light {
        padding: 14px 20px;
        background: #f8f9fa !important;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
    }

    .modal-title.fw-semibold {
        font-size: 15px !important;
        font-weight: 500 !important;
    }

    .modal-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .modal-body .mb-20 {
        margin-bottom: 0 !important;
    }

    .modal-footer.border-top.bg-light {
        padding: 12px 20px;
        background: #f8f9fa !important;
        border-top: 1px solid #e9ecef;
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .modal-footer .btn-outline-secondary {
        padding: 7px 16px;
        font-size: 13px;
        border-radius: 8px;
        border: 1px solid #dee2e6;
    }

    .modal-footer .btn-primary {
        padding: 7px 20px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 8px;
    }

    /* ===== SPACING FIXES ===== */
    .mb-20 {
        margin-bottom: 14px !important;
    }

    .mb-24 {
        margin-bottom: 16px !important;
    }

    .p-24 {
        padding: 10px 20px 20px 20px !important;
    }


</style>
@section('content')
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
        <!-- Add Field Form -->
        <div class="col-lg-4">
            <div class="card p-24 radius-12 bg-base">
                <h6 class="text-lg fw-semibold mb-24 d-flex align-items-center gap-2" style="padding: 10px 20px;">
                    <iconify-icon icon="solar:add-circle-outline" class="text-primary-600"></iconify-icon>Add New Field
                </h6>

                <form action="{{ route('admin.contact.fields.store') }}" method="POST" id="addForm">
                    @csrf

                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Field Label *</label>
                        <input type="text" name="label" class="form-control" placeholder="e.g. Age, Preferred Date"
                            required>
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
                        <textarea name="options" class="form-control" rows="3"
                            placeholder="Comma separated&#10;e.g. Option 1, Option 2, Option 3"></textarea>
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
                        <input type="number" name="order" class="form-control" placeholder="Leave empty for next available" min="1">
                        <div class="text-xs text-secondary-light mt-4">Must be unique. No two fields can have the same order
                        </div>
                    </div>

                    <div class="mb-16">
                        <label class="toggle-card" for="is_required">
                            <div class="info-box">
                                <span class="label-text">Required Field?</span>
                                <span class="hint-text">Users must fill this field to submit</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_required" id="is_required" value="1">
                            </div>
                        </label>
                    </div>

                    <div class="mb-24">
                        <label class="toggle-card active" for="is_active">
                            <div class="info-box">
                                <span class="label-text">Is Active?</span>
                                <span class="hint-text">Show this field in the selected form</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                            </div>
                        </label>
                    </div>

                    <button type="submit"
                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <iconify-icon icon="solar:add-circle-outline"></iconify-icon>Add Field
                    </button>
                </form>
            </div>
        </div>

        <!-- Fields List -->
        <div class="col-lg-8">
            <div class="card radius-12 bg-base h-100">
                <div class="card-header border-bottom p-24 d-flex align-items-center justify-content-between">
                    <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:list-outline" class="text-primary-600"></iconify-icon>Form Fields
                    </h6>
                </div>

                <!-- Category Filter Tabs -->
                <div class="p-24 border-bottom">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="#"
                            class="category-filter all-filter btn btn-sm btn-light d-inline-flex align-items-center gap-1"
                            data-category="all">
                            <iconify-icon icon="solar:layers-outline"></iconify-icon>All Fields
                        </a>
                        @foreach($categories as $key => $label)
                            @if($key !== 'all')
                                <a href="#"
                                    class="category-filter btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1"
                                    data-category="{{ $key }}">
                                    @if($key === 'inclinic_visit')
                                        <iconify-icon icon="solar:calendar-date-outline"></iconify-icon>
                                    @elseif($key === 'online_consultation')
                                        <iconify-icon icon="solar:monitor-outline"></iconify-icon>
                                    @elseif($key === 'whatsapp')
                                        <iconify-icon icon="solar:chat-round-line-outline"></iconify-icon>
                                    @endif
                                    {{ $label }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="card-body p-24">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="fieldTable">
                            <thead>
                                <tr>
                                    <th>Label</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Required</th>
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
                                                    <span class="badge bg-secondary-focus text-secondary-main fw-medium">All
                                                        Forms</span>
                                                @elseif($field->category === 'inclinic_visit')
                                                    <span class="badge bg-primary-focus text-primary-main fw-medium">In-Clinic</span>
                                                @elseif($field->category === 'online_consultation')
                                                    <span class="badge bg-success-focus text-success-main fw-medium">Online</span>
                                                @elseif($field->category === 'whatsapp')
                                                    <span class="badge bg-warning-focus text-warning-main fw-medium">NRI Patients</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            @if($field->is_active)
                                                <span class="badge bg-success-focus text-success-main fw-medium">Active</span>
                                            @else
                                                <span class="badge bg-danger-focus text-danger-main fw-medium">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($field->is_required)
                                                <span class="badge bg-danger-focus text-danger-main fw-medium">Required</span>
                                            @else
                                                <span class="badge bg-light text-secondary-light fw-medium">Optional</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-primary-600">{{ $field->order }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center"
                                                    style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                    onclick='editField({{ $field->id }}, {{ json_encode($field->label) }}, "{{ $field->type }}", "{{ $field->category }}", {{ json_encode($field->options) }}, {{ $field->order }}, {{ json_encode($field->placeholder) }}, {{ $field->is_required ? 1 : 0 }}, {{ $field->is_active ? 1 : 0 }})'>
                                                    <i class="ri-edit-line" style="font-size: 18px;"></i>
                                                </button>
                                                <form action="{{ route('admin.contact.fields.destroy', $field->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this field? This action cannot be undone.')">
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

                @if(count($fields) === 0)
                    <div class="p-40 text-center">
                        <div class="mb-16">
                            <iconify-icon icon="solar:inbox-archive-outline" class="text-secondary-light"
                                style="font-size: 48px;"></iconify-icon>
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
                    <h6 class="modal-title fw-semibold d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>Edit Field
                    </h6>
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
                            <textarea name="options" id="edit_options" class="form-control" rows="3"
                                placeholder="Comma separated&#10;e.g. Option 1, Option 2, Option 3"></textarea>
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
                            <div class="text-xs text-secondary-light mt-4">Must be unique. No two fields can have the same
                                order</div>
                        </div>

                        <div class="mb-16">
                            <label class="toggle-card" for="edit_required">
                                <div class="info-box">
                                    <span class="label-text">Required Field?</span>
                                    <span class="hint-text">Users must fill this field to submit</span>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_required" id="edit_required" value="1">
                                </div>
                            </label>
                        </div>

                        <div class="mb-20">
                            <label class="toggle-card" for="edit_active">
                                <div class="info-box">
                                    <span class="label-text">Is Active?</span>
                                    <span class="hint-text">Show this field in the selected form</span>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="edit_active" value="1">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer border-top bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:check-read-outline"></iconify-icon>Update Field
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection