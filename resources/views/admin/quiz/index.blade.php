@extends('layout.layout')

@php
    $title = 'Quiz Questions';
    $subTitle = 'Quiz Management';
    $script = '
        <script>
            $(document).ready(function() {
                const table = $("#questionTable").DataTable({
                    "order": [[2, "asc"]]
                });
            });

            function editQuestion(id, question, gender, order) {
                $("#editModal").modal("show");
                $("#edit_question").val(question);
                $("#edit_gender").val(gender);
                $("#edit_order").val(order);
                $("#editForm").attr("action", "/admin/quiz/questions/" + id);
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
</style>

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
    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                <iconify-icon icon="solar:question-square-outline" class="text-primary-600"></iconify-icon>
                Add New Question
            </h6>
            <form action="{{ route('admin.quiz.questions.store') }}" method="POST">
                @csrf
                <div class="mb-20">
                    <label class="form-label mb-8">Question Text</label>
                    <textarea name="question" class="form-control" rows="4" placeholder="Enter question..." required></textarea>
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Target Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="f">Female</option>
                        <option value="m">Male</option>
                    </select>
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Display Order</label>
                    <input type="number" name="order" class="form-control" placeholder="Leave empty for next available">
                </div>
                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
                    Add Question
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card radius-12 bg-base h-100">
            <div class="card-header border-bottom p-24 d-flex justify-content-between align-items-center">
                <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:list-outline" class="text-primary-600"></iconify-icon>
                    Questions List
                </h6>
                <a href="{{ route('admin.quiz.submissions') }}" class="btn btn-outline-info btn-sm d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                    View Submissions
                </a>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0" id="questionTable">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th width="100">Gender</th>
                                <th width="80">Order</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $q)
                            <tr>
                                <td>
                                    <div class="text-sm fw-medium text-dark line-clamp-2" title="{{ $q->question }}">
                                        {{ \Illuminate\Support\Str::limit($q->question, 150) }}
                                    </div>
                                </td>
                                <td>
                                    @if($q->gender == 'f')
                                        <span class="badge bg-danger-focus text-danger-main d-inline-flex align-items-center gap-1">
                                            <i class="ri-women-line"></i> Female
                                        </span>
                                    @else
                                        <span class="badge bg-info-focus text-info-main d-inline-flex align-items-center gap-1">
                                            <i class="ri-men-line"></i> Male
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold text-primary-600">{{ $q->order }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center" 
                                                style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                onclick="editQuestion({{ $q->id }}, {{ json_encode($q->question) }}, '{{ $q->gender }}', {{ $q->order }})">
                                            <i class="ri-edit-line" style="font-size: 18px;"></i>
                                        </button>
                                        <form action="{{ route('admin.quiz.questions.destroy', $q->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure?')">
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
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                    Edit Question
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Question Text</label>
                        <textarea name="question" id="edit_question" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Target Gender</label>
                        <select name="gender" id="edit_gender" class="form-select" required>
                            <option value="f">Female</option>
                            <option value="m">Male</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Display Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                        Update Question
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
