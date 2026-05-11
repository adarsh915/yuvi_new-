@extends('layout.layout')

@php
    $title = 'Frequently Asked Questions';
    $subTitle = 'Manage FAQs';
    $script = '
        <script>
            $(document).ready(function() {
                $("#faqsTable").DataTable({
                    "order": [[1, "asc"]]
                });
            });

            $(document).on("click", ".edit-faq-btn", function() {
                const id = $(this).data("id");
                const question = $(this).data("question");
                const answer = $(this).data("answer");
                const order = $(this).data("order");
                const isActive = $(this).data("active");

                $("#editModal").modal("show");
                $("#edit_question").val(question);
                $("#edit_answer").val(answer);
                $("#edit_order").val(order);
                $("#edit_is_active").prop("checked", isActive == 1);
                $("#editForm").attr("action", "/admin/faqs/" + id);
            });
        </script>
    ';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-20">Add New FAQ</h6>
            <form action="{{ route('admin.faqs.store') }}" method="POST">
                @csrf
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Question</label>
                    <input type="text" name="question" class="form-control" placeholder="e.g. What is IVF?" required>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Answer</label>
                    <textarea name="answer" class="form-control" rows="4" placeholder="Enter answer here..." required></textarea>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                <div class="mb-20">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActive" checked>
                        <label class="form-check-label" for="isActive">Is Active</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Save FAQ</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card p-24 radius-12 bg-base h-100">
            <h6 class="text-lg fw-semibold mb-20">Manage FAQs</h6>
            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="faqsTable">
                    <thead>
                        <tr>
                            <th>Question & Answer</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqs as $faq)
                        <tr>
                            <td>
                                <div class="fw-semibold text-primary-600 mb-4">{{ $faq->question }}</div>
                                <div class="text-xs text-secondary-light line-clamp-2">{{ $faq->answer }}</div>
                            </td>
                            <td>{{ $faq->order }}</td>
                            <td>
                                <span class="badge {{ $faq->is_active ? 'bg-success-focus text-success-main' : 'bg-danger-focus text-danger-main' }}">
                                    {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info edit-faq-btn" 
                                            data-id="{{ $faq->id }}"
                                            data-question="{{ $faq->question }}"
                                            data-answer="{{ $faq->answer }}"
                                            data-order="{{ $faq->order }}"
                                            data-active="{{ $faq->is_active }}">
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                    </button>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Delete this FAQ?')">
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
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom-0">
                <h6 class="modal-title">Edit FAQ</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Question</label>
                        <input type="text" name="question" id="edit_question" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Answer</label>
                        <textarea name="answer" id="edit_answer" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control">
                    </div>
                    <div class="mb-20">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                            <label class="form-check-label" for="edit_is_active">Is Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
