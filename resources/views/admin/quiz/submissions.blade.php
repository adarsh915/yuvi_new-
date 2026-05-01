@extends('layout.layout')

@php
    $title = 'Quiz Submissions';
    $subTitle = 'Quiz Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#submissionTable").DataTable({
                    "order": [[0, "desc"]]
                });
            });
        </script>
    ';
@endphp

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">User Submissions</h6>
        <a href="{{ route('admin.quiz.questions') }}" class="btn btn-outline-primary btn-sm">Manage Questions</a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="submissionTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Contact</th>
                        <th>City</th>
                        <th>Yes Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $s)
                    <tr>
                        <td>{{ $s->created_at->format('d M, Y H:i') }}</td>
                        <td>
                            <div class="fw-medium">{{ $s->name }}</div>
                            <div class="text-xs text-secondary-light">{{ $s->email ?? 'No Email' }}</div>
                        </td>
                        <td>{{ $s->phone }}</td>
                        <td>{{ $s->city ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $s->yes_count > 3 ? 'bg-danger-focus text-danger-main' : ($s->yes_count > 0 ? 'bg-warning-focus text-warning-main' : 'bg-success-focus text-success-main') }}">
                                {{ $s->yes_count }} Yes
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.quiz.submissions.details', $s->id) }}" class="btn btn-sm btn-outline-info">
                                    <iconify-icon icon="solar:eye-outline"></iconify-icon> View
                                </a>
                                <form action="{{ route('admin.quiz.submissions.destroy', $s->id) }}" method="POST" 
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
@endsection
