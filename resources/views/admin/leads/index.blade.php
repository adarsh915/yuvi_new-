@extends('layout.layout')

@php
    $title = 'Contact Leads';
    $subTitle = 'Inquiries';
    $script = '
        <script>
            $(document).ready(function() {
                $("#leadsTable").DataTable({
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
        margin-bottom: 5px !important;
    }

    .form-control, .form-select {
        padding: 8px 12px;
        font-size: 13px;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
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

</style>

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:users-group-rounded-outline" class="text-primary-600"></iconify-icon>
            Recent Inquiries
        </h6>
        <a href="{{ route('admin.leads.export.csv', request()->query()) }}" class="btn btn-outline-success btn-sm">
            <iconify-icon icon="solar:download-square-outline"></iconify-icon> Export CSV
        </a>
    </div>
    <div class="card-body p-24">
        <form method="GET" action="{{ route('admin.leads') }}" class="mb-24 p-20 bg-light radius-12 border">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" name="q" class="form-control" placeholder="Name, email, phone..." value="{{ request('q') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Consultation</label>
                    <select name="consultation_type" class="form-select">
                        <option value="">All Types</option>
                        <option value="inclinic_visit" {{ request('consultation_type') === 'inclinic_visit' ? 'selected' : '' }}>In-Clinic</option>
                        <option value="online_consultation" {{ request('consultation_type') === 'online_consultation' ? 'selected' : '' }}>Online</option>
                        <option value="whatsapp" {{ request('consultation_type') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Location</label>
                    <select name="preferred_location" class="form-select">
                        <option value="">All Locations</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('preferred_location') === $location ? 'selected' : '' }}>{{ $location }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Concern</label>
                    <select name="subject" class="form-select">
                        <option value="">All Concerns</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject }}" {{ request('subject') === $subject ? 'selected' : '' }}>{{ $subject }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label d-block">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <iconify-icon icon="solar:filter-outline"></iconify-icon> Filter
                        </button>
                        <a href="{{ route('admin.leads') }}" class="btn btn-outline-secondary">
                            <iconify-icon icon="solar:restart-outline"></iconify-icon> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="leadsTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Contact Details</th>
                        <th>Consultation</th>
                        <th>Location</th>
                        <th>Concern</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="solar:calendar-outline" class="text-secondary-light"></iconify-icon>
                                {{ $lead->created_at->format('d M, Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ trim(($lead->first_name ?? '') . ' ' . ($lead->last_name ?? '')) ?: '-' }}</div>
                        </td>
                        <td>
                            <div class="text-primary-600 fw-medium">{{ $lead->email }}</div>
                            <div class="text-xs text-secondary-light mt-1 d-flex align-items-center gap-1">
                                <iconify-icon icon="solar:phone-outline"></iconify-icon>
                                {{ $lead->phone }}
                            </div>
                        </td>
                        <td>
                            @if($lead->consultation_type === 'whatsapp')
                                <span class="badge bg-success-focus text-success-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:whatsapp-outline"></iconify-icon> WhatsApp
                                </span>
                            @elseif($lead->consultation_type === 'online_consultation')
                                <span class="badge bg-info-focus text-info-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:monitor-outline"></iconify-icon> Online
                                </span>
                            @else
                                <span class="badge bg-primary-focus text-primary-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:hospital-outline"></iconify-icon> In-Clinic
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <iconify-icon icon="solar:map-point-outline" class="text-secondary-light"></iconify-icon>
                                {{ $lead->preferred_location ?? '-' }}
                            </div>
                        </td>
                        <td>
                            <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $lead->subject }}">
                                {{ $lead->subject }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.leads.details', $lead->id) }}" class="btn btn-sm btn-outline-primary" style="width:32px; height:32px; padding:0; border-radius:8px;">
                                    <iconify-icon icon="solar:eye-outline"></iconify-icon>
                                </a>
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this lead? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="width:32px; height:32px; padding:0; border-radius:8px;">
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
