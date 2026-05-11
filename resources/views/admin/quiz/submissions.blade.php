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
        <div class="d-flex gap-2">
            <a href="{{ route('admin.quiz.submissions.export', request()->all()) }}" class="btn btn-outline-secondary btn-sm">Export CSV</a>
            <a href="{{ route('admin.quiz.questions') }}" class="btn btn-outline-primary btn-sm">Manage Questions</a>
        </div>
    </div>

    <div class="card-body p-24">
        <form method="GET" class="row gy-12 mb-16">
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" placeholder="From">
            </div>
            <div class="col-md-2">
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" placeholder="To">
            </div>
            <div class="col-md-2">
                <input type="text" name="name" class="form-control" value="{{ request('name') }}" placeholder="Name">
            </div>
            <div class="col-md-2">
                <input type="text" name="phone" class="form-control" value="{{ request('phone') }}" placeholder="Phone">
            </div>
            <div class="col-md-2">
                <input type="text" name="city" class="form-control" value="{{ request('city') }}" placeholder="City">
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.quiz.submissions.export', request()->all()) }}" class="btn btn-outline-secondary">Export CSV</a>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="submissionTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>Contact</th>
                        <th>City</th>
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
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.quiz.submissions.details', $s->id) }}" class="btn btn-sm btn-outline-info">
                                    <iconify-icon icon="solar:eye-outline"></iconify-icon> View
                                </a>
                                <a href="{{ route('admin.quiz.submissions.print', $s->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <iconify-icon icon="solar:printer-outline"></iconify-icon> Print
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
