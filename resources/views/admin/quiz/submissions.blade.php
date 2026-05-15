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
    <style>
        .card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: none;
        }

        .card-header {
            padding: 10px 20px !important;
            background: #fff !important;
            border-bottom: 1px solid #e9ecef !important;
        }

        .form-label {
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6c757d !important;
        }


        .btn {
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 500;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }

        .filter-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 24px;
        }

    </style>

    <div class="card h-100 p-0 radius-12">
        <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between">
            <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                <iconify-icon icon="solar:document-text-outline" class="text-primary-600"></iconify-icon>
                User Submissions
            </h6>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.quiz.questions') }}"
                    class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:question-square-outline"></iconify-icon>
                    Manage Questions
                </a>
            </div>
        </div>

        <div class="card-body p-24">
            <div class="filter-card">
                <form method="GET" class="row gy-3">
                    <div class="col-md-2">
                        <label class="form-label mb-8">From Date</label>
                        <input type="date" name="date_from" class="form-control form-control-sm"
                            value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-8">To Date</label>
                        <input type="date" name="date_to" class="form-control form-control-sm"
                            value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-8">Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" value="{{ request('name') }}"
                            placeholder="Search name...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-8">Phone</label>
                        <input type="text" name="phone" class="form-control form-control-sm" value="{{ request('phone') }}"
                            placeholder="Search phone...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-8">City</label>
                        <input type="text" name="city" class="form-control form-control-sm" value="{{ request('city') }}"
                            placeholder="Search city...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-8">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm flex-grow-1">
                                <iconify-icon icon="solar:filter-outline"></iconify-icon>
                                Filter
                            </button>
                            <a href="{{ route('admin.quiz.submissions.export', request()->all()) }}"
                                class="btn btn-outline-success btn-sm flex-grow-1">
                                <iconify-icon icon="solar:file-download-outline"></iconify-icon>
                                Export
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="submissionTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User Name</th>
                            <th>Contact</th>
                            <th class="text-center-column">City</th>
                            <th>Responses</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $s)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:calendar-outline" class="text-secondary-light"></iconify-icon>
                                        {{ $s->created_at->format('d M, Y') }}
                                        <span class="text-xs text-secondary-light">{{ $s->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-primary-600">{{ $s->name }}</div>
                                    <div class="text-xs text-secondary-light mt-1 d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:letter-outline"></iconify-icon>
                                        {{ $s->email ?? 'No Email' }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:phone-outline" class="text-secondary-light"></iconify-icon>
                                        {{ $s->phone }}
                                    </div>
                                </td>
                                <td class="text-center-column">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <iconify-icon icon="solar:map-point-outline"
                                            class="text-secondary-light"></iconify-icon>
                                        {{ $s->city ?? '-' }}
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $yesCount = 0;
                                        $noCount = 0;
                                        if (is_array($s->answers_json)) {
                                            foreach ($s->answers_json as $val) {
                                                $ans = is_array($val) ? ($val['answer'] ?? '') : $val;
                                                if ($ans === 'Yes') $yesCount++;
                                                if ($ans === 'No') $noCount++;
                                            }
                                        }
                                    @endphp
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-danger-focus text-danger-main">Yes: {{ $yesCount }}</span>
                                        <span class="badge bg-success-focus text-success-main">No: {{ $noCount }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('admin.quiz.submissions.details', $s->id) }}"
                                            class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center"
                                            style="width:32px; height:32px; padding:0; border-radius:8px;" title="View Details">
                                            <i class="ri-eye-line" style="font-size: 18px;"></i>
                                        </a>
                                        <a href="{{ route('admin.quiz.submissions.print', $s->id) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary d-flex align-items-center justify-content-center"
                                            style="width:32px; height:32px; padding:0; border-radius:8px;" title="Print">
                                            <i class="ri-printer-line" style="font-size: 18px;"></i>
                                        </a>
                                        <form action="{{ route('admin.quiz.submissions.destroy', $s->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center"
                                                style="width:32px; height:32px; padding:0; border-radius:8px;" title="Delete">
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
@endsection