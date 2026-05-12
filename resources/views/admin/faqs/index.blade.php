@extends('layout.layout')

@php
    $title = 'Frequently Asked Questions';
    $subTitle = 'Manage FAQs';
    $script = '
                <script>
                    $(document).ready(function() {
                        const table = $("#faqsTable").DataTable({
                            "order": [[1, "asc"]]
                        });
                    });

                    $(document).on("click", ".edit-faq-btn", function() {
                        const id = $(this).data("id");
                        const question = $(this).data("question");
                        const answer = $(this).data("answer");
                        const categoryId = $(this).data("category_id");
                        const order = $(this).data("order");
                        const isActive = $(this).data("active");

                        $("#editModal").modal("show");
                        $("#edit_question").val(question);
                        $("#edit_answer").val(answer);
                        $("#edit_faq_category_id").val(categoryId);
                        $("#edit_order").val(order);
                        $("#edit_is_active").prop("checked", isActive == 1);
                        $("#editForm").attr("action", "/admin/faqs/" + id);
                    });
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

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
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
        .toggle-row .form-check {
            padding: 0;
            margin: 0;
        }
        .toggle-row .form-check-input {
            width: 40px !important;
            height: 22px !important;
            cursor: pointer;
            margin: 0 !important;
            flex-shrink: 0;
        }
    </style>

    <div class="row gy-4">
        @if ($errors->any())
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="col-md-4">
            <div class="card p-24 radius-12 bg-base">
                <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:question-square-outline" class="text-primary-600"></iconify-icon>
                    Add New FAQ
                </h6>
                <form action="{{ route('admin.faqs.store') }}" method="POST">
                    @csrf
                    <div class="mb-20">
                        <label class="form-label mb-8">Question</label>
                        <input type="text" name="question" class="form-control" placeholder="e.g. What is IVF?" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Answer</label>
                        <textarea name="answer" class="form-control" rows="4" placeholder="Enter answer here..."
                            required></textarea>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">FAQ Category</label>
                        <select name="faq_category_id" class="form-select">
                            <option value="">No Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Display Order</label>
                        <input type="number" name="order" class="form-control" placeholder="Leave empty for next available">
                    </div>
                    <div class="mb-20">
                        <label class="toggle-row" for="isActive">
                            <div>
                                <span class="tr-label">Active</span>
                                <span class="tr-sub">Show this FAQ on the website</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1" checked>
                            </div>
                        </label>
                    </div>
                    <button type="submit"
                        class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                        <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                        Save FAQ
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card radius-12 bg-base h-100">
                <div class="card-header border-bottom p-24">
                    <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:list-outline" class="text-primary-600"></iconify-icon>
                        Manage FAQs
                    </h6>
                    <a href="{{ route('admin.faq.categories') }}" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:settings-outline"></iconify-icon>
                        Manage Categories
                    </a>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0" id="faqsTable">
                            <thead>
                                <tr>
                                    <th>Question & Answer</th>
                                    <th>Category</th>
                                    <th width="80">Order</th>
                                    <th width="100">Status</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faqs as $faq)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-primary-600 mb-4 line-clamp-2"
                                                title="{{ $faq->question }}">
                                                {{ \Illuminate\Support\Str::limit($faq->question, 60) }}
                                            </div>
                                            <div class="text-xs text-secondary-light line-clamp-2" title="{{ $faq->answer }}">
                                                {{ \Illuminate\Support\Str::limit($faq->answer, 60) }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($faq->category)
                                                <span class="badge bg-primary-focus text-primary-main">
                                                    {{ $faq->category->name }}
                                                </span>
                                            @else
                                                <span class="text-xs text-secondary-light">Uncategorized</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-primary-600">{{ $faq->order }}</span>
                                        </td>
                                        <td>
                                            @if($faq->is_active)
                                                <span
                                                    class="badge bg-success-focus text-success-main d-inline-flex align-items-center gap-1">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                    Active
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-danger-focus text-danger-main d-inline-flex align-items-center gap-1">
                                                    <i class="ri-close-circle-line"></i>
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <button
                                                    class="btn btn-sm btn-outline-info edit-faq-btn d-inline-flex align-items-center justify-content-center"
                                                    style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                    data-id="{{ $faq->id }}" data-question="{{ $faq->question }}"
                                                    data-answer="{{ $faq->answer }}" 
                                                    data-category_id="{{ $faq->faq_category_id }}"
                                                    data-order="{{ $faq->order }}"
                                                    data-active="{{ $faq->is_active }}">
                                                    <i class="ri-edit-line" style="font-size: 18px;"></i>
                                                </button>
                                                <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this FAQ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger d-inline-flex align-items-center justify-content-center"
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
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-16">
                <div class="modal-header border-bottom bg-light">
                    <h6 class="modal-title d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                        Edit FAQ
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-20">
                            <label class="form-label mb-8">Question</label>
                            <input type="text" name="question" id="edit_question" class="form-control" required>
                        </div>
                        <div class="mb-20">
                            <label class="form-label mb-8">Answer</label>
                            <textarea name="answer" id="edit_answer" class="form-control" rows="6" required></textarea>
                        </div>
                        <div class="mb-20">
                            <label class="form-label mb-8">FAQ Category</label>
                            <select name="faq_category_id" id="edit_faq_category_id" class="form-select">
                                <option value="">No Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-20">
                            <label class="form-label mb-8">Display Order</label>
                            <input type="number" name="order" id="edit_order" class="form-control">
                        </div>
                        <div class="mb-20">
                            <label class="toggle-row" for="edit_is_active">
                                <div>
                                    <span class="tr-label">Active</span>
                                    <span class="tr-sub">Show this FAQ on the website</span>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer border-top bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                            Update FAQ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection