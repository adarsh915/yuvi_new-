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
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Recent Inquiries</h6>
    </div>
    <div class="card-body p-24">
        <form method="GET" action="{{ route('admin.leads') }}" class="mb-20">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" name="q" class="form-control" placeholder="Name, email, phone, concern..." value="{{ request('q') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Consultation Type</label>
                    <select name="consultation_type" class="form-select">
                        <option value="">All</option>
                        <option value="inclinic_visit" {{ request('consultation_type') === 'inclinic_visit' ? 'selected' : '' }}>In-Clinic</option>
                        <option value="online_consultation" {{ request('consultation_type') === 'online_consultation' ? 'selected' : '' }}>Online</option>
                        <option value="whatsapp" {{ request('consultation_type') === 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Preferred Location</label>
                    <select name="preferred_location" class="form-select">
                        <option value="">All</option>
                        @foreach($locations as $location)
                            <option value="{{ $location }}" {{ request('preferred_location') === $location ? 'selected' : '' }}>{{ $location }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Concern</label>
                    <select name="subject" class="form-select">
                        <option value="">All</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject }}" {{ request('subject') === $subject ? 'selected' : '' }}>{{ $subject }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <label class="form-label">From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-1">
                    <label class="form-label">To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.leads') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('admin.leads.export.csv', request()->query()) }}" class="btn btn-outline-success w-100">Export CSV</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="leadsTable">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Type</th>
                        <th scope="col">Location</th>
                        <th scope="col">Concern</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                    <tr>
                        <td>{{ $lead->created_at->format('d M, Y') }}</td>
                        <td>{{ trim(($lead->first_name ?? '') . ' ' . ($lead->last_name ?? '')) ?: '-' }}</td>
                        <td>
                            <div class="text-xs">{{ $lead->email }}</div>
                            <div class="text-secondary-light">{{ $lead->phone }}</div>
                        </td>
                        <td>{{ $lead->consultation_type ?? '-' }}</td>
                        <td>{{ $lead->preferred_location ?? '-' }}</td>
                        <td>{{ $lead->subject }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.leads.details', $lead->id) }}" class="btn btn-sm btn-outline-primary radius-8">
                                    <iconify-icon icon="solar:eye-outline"></iconify-icon> View
                                </a>
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this lead? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger radius-8">
                                        <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon> Delete
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
