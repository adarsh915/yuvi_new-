@extends('layout.layout')

@php
    $title = 'Quiz Questions';
    $subTitle = 'Quiz Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#questionTable").DataTable({
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
<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12">
            <h6 class="text-lg fw-semibold mb-20">Add New Question</h6>
            <form action="{{ route('admin.quiz.questions.store') }}" method="POST">
                @csrf
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Question Text</label>
                    <textarea name="question" class="form-control" rows="3" placeholder="Enter question..." required></textarea>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Target Gender</label>
                    <select name="gender" class="form-select" required>
                        <option value="f">Female</option>
                        <option value="m">Male</option>
                    </select>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                    <input type="number" name="order" class="form-control" value="{{ count($questions) + 1 }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Question</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card p-24 radius-12 h-100">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <h6 class="text-lg fw-semibold mb-0">Questions List</h6>
                <a href="{{ route('admin.quiz.submissions') }}" class="btn btn-outline-info btn-sm">View Submissions</a>
            </div>
            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="questionTable">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Gender</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($questions as $q)
                        <tr>
                            <td>{{ $q->question }}</td>
                            <td>
                                <span class="badge {{ $q->gender == 'f' ? 'bg-danger-focus text-danger-main' : 'bg-info-focus text-info-main' }}">
                                    {{ $q->gender == 'f' ? 'Female' : 'Male' }}
                                </span>
                            </td>
                            <td>{{ $q->order }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick="editQuestion({{ $q->id }}, '{{ addslashes($q->question) }}', '{{ $q->gender }}', {{ $q->order }})">
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                    </button>
                                    <form action="{{ route('admin.quiz.questions.destroy', $q->id) }}" method="POST" 
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
                <h6 class="modal-title">Edit Question</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Question Text</label>
                        <textarea name="question" id="edit_question" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Target Gender</label>
                        <select name="gender" id="edit_gender" class="form-select" required>
                            <option value="f">Female</option>
                            <option value="m">Male</option>
                        </select>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
