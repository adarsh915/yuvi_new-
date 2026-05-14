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

                @php
                    $yesCount = 0;
                    $noCount = 0;
                    if (is_array($submission->answers_json)) {
                        foreach ($submission->answers_json as $ans) {
                            if ($ans === 'Yes')
                                $yesCount++;
                            if ($ans === 'No')
                                $noCount++;
                        }
                    }
                @endphp
                <div class="row mb-20">
                    <div class="col-6">
                        <div class="p-12 radius-8 border text-center">
                            <div class="text-xs text-secondary-light fw-bold text-uppercase mb-1">Yes</div>
                            <div class="text-xl fw-bold text-danger-main">{{ $yesCount }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-12 radius-8 border text-center">
                            <div class="text-xs text-secondary-light fw-bold text-uppercase mb-1">No</div>
                            <div class="text-xl fw-bold text-success-main">{{ $noCount }}</div>
                        </div>
                    </div>
                    <div class="col-12 mt-8">
                        <span
                            class="badge w-100 {{ $yesCount > 3 ? 'bg-danger-focus text-danger-main' : ($yesCount > 0 ? 'bg-warning-focus text-warning-main' : 'bg-success-focus text-success-main') }}">
                            {{ $yesCount > 3 ? 'Critical Concern' : ($yesCount > 0 ? 'Potential Risk' : 'Normal Assessment') }}
                        </span>
                    </div>
                </div>

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
            </div>
            <a href="{{ route('admin.quiz.submissions') }}" class="btn btn-outline-secondary w-100 mt-20">Back to
                Submissions</a>
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
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $answer == 'Yes' ? 'bg-danger-focus text-danger-main' : 'bg-success-focus text-success-main' }}">
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