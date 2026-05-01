@extends('layout.layout')

@php
    $title = 'Submission Details';
    $subTitle = 'Quiz Management';
@endphp

@section('content')
<div class="row gy-4">
    {{-- User Info --}}
    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-20">User Information</h6>
            <div class="mb-16">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Full Name</label>
                <div class="text-lg fw-medium">{{ $submission->name }}</div>
            </div>
            <div class="mb-16">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Phone Number</label>
                <div class="text-lg fw-medium">{{ $submission->phone }}</div>
            </div>
            <div class="mb-16">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Email Address</label>
                <div class="text-lg fw-medium">{{ $submission->email ?? 'N/A' }}</div>
            </div>
            <div class="mb-16">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">City</label>
                <div class="text-lg fw-medium">{{ $submission->city ?? 'N/A' }}</div>
            </div>
            <hr class="my-20">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-secondary-light">Total "Yes"</span>
                <span class="badge {{ $submission->yes_count > 3 ? 'bg-danger-focus text-danger-main' : 'bg-warning-focus text-warning-main' }} py-8 px-16 text-md">
                    {{ $submission->yes_count }}
                </span>
            </div>
        </div>
        <a href="{{ route('admin.quiz.submissions') }}" class="btn btn-outline-secondary w-100 mt-20">Back to Submissions</a>
    </div>

    {{-- Answers --}}
    <div class="col-md-8">
        <div class="card p-24 radius-12 bg-base h-100">
            <h6 class="text-lg fw-semibold mb-20">Quiz Responses</h6>
            <div class="table-responsive">
                <table class="table bordered-table">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th style="width: 100px;">Answer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submission->answers_json as $q_id => $answer)
                            @php
                                $question = \App\Models\QuizQuestion::where('id', $q_id)->first();
                            @endphp
                            <tr>
                                <td>
                                    <div class="text-sm fw-medium">{{ $question->question ?? 'Question Deleted' }}</div>
                                    <div class="text-xs text-secondary-light mt-4">ID: {{ $q_id }}</div>
                                </td>
                                <td>
                                    <span class="badge {{ $answer == 'Yes' ? 'bg-danger-focus text-danger-main' : 'bg-success-focus text-success-main' }}">
                                        {{ $answer }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
