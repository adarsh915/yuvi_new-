@extends('layout.layout')

@php
    $title = 'Contact Leads';
    $subTitle = 'Inquiries';
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

        .form-control,
        .form-select {
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

        {{-- Lead count summary bar --}}
        <div class="px-24 py-12 border-bottom bg-light d-flex align-items-center gap-3 flex-wrap">
            <span class="text-sm text-secondary-light">
                Showing <strong class="text-dark">{{ $leads->count() }}</strong>
                @if(request()->filled('consultation_type'))
                    {{ ['inclinic_visit' => 'In-Clinic Visit', 'online_consultation' => 'Online Consultation', 'whatsapp' => 'NRI Patients'][request('consultation_type')] ?? request('consultation_type') }}
                @else
                    total
                @endif
                lead(s)
            </span>
            @if(request()->hasAny(['q', 'consultation_type', 'preferred_location', 'subject', 'date_from', 'date_to']))
                <a href="{{ route('admin.leads') }}" class="btn btn-sm btn-outline-secondary"
                    style="padding: 3px 12px; font-size: 12px;">
                    <iconify-icon icon="solar:restart-outline"></iconify-icon> Clear Filters
                </a>
            @endif
        </div>
        <div class="card-body p-24">
            <form method="GET" action="{{ route('admin.leads') }}" class="mb-24 p-20 bg-light radius-12 border">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Search</label>
                        <input type="text" name="q" class="form-control" placeholder="Name, email, phone..."
                            value="{{ request('q') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Consultation</label>
                        <select name="consultation_type" class="form-select">
                            <option value="">All Types</option>
                            <option value="inclinic_visit" {{ request('consultation_type') === 'inclinic_visit' ? 'selected' : '' }}>In-Clinic</option>
                            <option value="online_consultation" {{ request('consultation_type') === 'online_consultation' ? 'selected' : '' }}>Online</option>
                            <option value="whatsapp" {{ request('consultation_type') === 'whatsapp' ? 'selected' : '' }}>NRI
                                Patients</option>
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
                                <option value="{{ $subject }}" {{ request('subject') === $subject ? 'selected' : '' }}>
                                    {{ $subject }}</option>
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

            <div class="alert alert-info py-2 px-3 mb-20 d-flex gap-4">
                <span><strong>DB Total:</strong> {{ \App\Models\Lead::count() }}</span>
                <span><strong>In-Clinic:</strong>
                    {{ \App\Models\Lead::where('consultation_type', 'inclinic_visit')->count() }}</span>
                <span><strong>Online:</strong>
                    {{ \App\Models\Lead::where('consultation_type', 'online_consultation')->count() }}</span>
                <span><strong>NRI:</strong> {{ \App\Models\Lead::where('consultation_type', 'whatsapp')->count() }}</span>
            </div>

            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="leadsTable" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                        @forelse($leads as $lead)
                            <tr>
                                <td>#{{ $lead->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:calendar-outline" class="text-secondary-light"></iconify-icon>
                                        {{ $lead->created_at->format('d M, Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">
                                        {{ trim(($lead->first_name ?? '') . ' ' . ($lead->last_name ?? '')) ?: '-' }}</div>
                                </td>
                                <td>
                                    <div class="text-primary-600 fw-medium">{{ $lead->email }}</div>
                                    <div class="text-xs text-secondary-light mt-1 d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:phone-outline"></iconify-icon>
                                        {{ $lead->phone }}
                                    </div>
                                </td>
                                <td>
                                    @php $ctype = trim($lead->consultation_type); @endphp
                                    @if($ctype == 'whatsapp')
                                        <span class="badge bg-success text-white">NRI Patients</span>
                                    @elseif($ctype == 'online_consultation')
                                        <span class="badge bg-info text-white">Online</span>
                                    @elseif($ctype == 'inclinic_visit')
                                        <span class="badge bg-primary text-white">In-Clinic-Visit</span>
                                    @else
                                        <span class="badge bg-secondary text-white">{{ $ctype ?: 'Not Specified' }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:map-point-outline"
                                            class="text-secondary-light"></iconify-icon>
                                        {{ $lead->preferred_location ?? '-' }}
                                    </div>
                                </td>
                                <td>
                                    <span class="text-truncate d-inline-block" style="max-width: 150px;"
                                        title="{{ $lead->subject }}">
                                        {{ $lead->subject }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('admin.leads.details', $lead->id) }}"
                                            class="btn btn-sm btn-outline-primary d-flex align-items-center justify-content-center"
                                            style="width:32px; height:32px; padding:0; border-radius:8px;" title="View Details">
                                            <i class="ri-eye-line" style="font-size: 18px;"></i>
                                        </a>
                                        <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('Delete this lead? This action cannot be undone.')">
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
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <iconify-icon icon="solar:inbox-out-linear"
                                        style="font-size: 40px; color: #ced4da; display: block; margin-bottom: 8px;"></iconify-icon>
                                    <p class="text-secondary-light mb-0">No leads
                                        found{{ request()->hasAny(['q', 'consultation_type', 'preferred_location', 'subject', 'date_from', 'date_to']) ? ' for the selected filters.' : '.' }}
                                    </p>
                                    @if(request()->hasAny(['q', 'consultation_type', 'preferred_location', 'subject', 'date_from', 'date_to']))
                                        <a href="{{ route('admin.leads') }}" class="btn btn-sm btn-outline-secondary mt-2">Clear
                                            Filters</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection