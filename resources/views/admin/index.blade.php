@extends('layout.layout')

@php
    $title = 'Dashboard';
    $subTitle = 'Home';
@endphp

@section('content')
<style>
    .card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card-link {
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .stat-card-link:hover .card {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        border-color: #4f84ae;
    }

    .stat-card {
        padding: 24px;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
    }

    .table th {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d;
        background: #f8f9fa;
        padding: 12px 20px !important;
    }

    .table td {
        padding: 16px 20px !important;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: background-color 0.2s;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>

<div class="row gy-4">
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('admin.leads') }}" class="stat-card-link">
            <div class="card stat-card border-0 shadow-sm">
                <div class="stat-icon bg-primary-focus text-primary-600">
                    <iconify-icon icon="solar:users-group-rounded-outline"></iconify-icon>
                </div>
                <p class="text-secondary-light fw-medium mb-1">Total Leads</p>
                <h3 class="fw-bold mb-0 text-dark">{{ $stats['leads_count'] }}</h3>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('admin.blogs') }}" class="stat-card-link">
            <div class="card stat-card border-0 shadow-sm">
                <div class="stat-icon bg-success-focus text-success-main">
                    <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                </div>
                <p class="text-secondary-light fw-medium mb-1">Total Blogs</p>
                <h3 class="fw-bold mb-0 text-dark">{{ $stats['blogs_count'] }}</h3>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('admin.services') }}" class="stat-card-link">
            <div class="card stat-card border-0 shadow-sm">
                <div class="stat-icon bg-info-focus text-info-main">
                    <iconify-icon icon="solar:medical-kit-outline"></iconify-icon>
                </div>
                <p class="text-secondary-light fw-medium mb-1">Total Services</p>
                <h3 class="fw-bold mb-0 text-dark">{{ $stats['services_count'] }}</h3>
            </div>
        </a>
    </div>
    <div class="col-xl-3 col-sm-6">
        <a href="{{ route('admin.testimonials') }}" class="stat-card-link">
            <div class="card stat-card border-0 shadow-sm">
                <div class="stat-icon bg-warning-focus text-warning-main">
                    <iconify-icon icon="solar:chat-round-dots-outline"></iconify-icon>
                </div>
                <p class="text-secondary-light fw-medium mb-1">Reviews</p>
                <h3 class="fw-bold mb-0 text-dark">{{ $stats['testimonials_count'] }}</h3>
            </div>
        </a>
    </div>
</div>

<div class="row gy-4 mt-4">
    <div class="col-xl-8">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom d-flex align-items-center justify-content-between py-20 px-24">
                <h6 class="text-lg fw-semibold mb-0">Recent Leads</h6>
                <a href="{{ route('admin.leads') }}" class="text-primary-600 fw-semibold text-sm">View All</a>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Consultation</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_leads as $lead)
                            <tr onclick="window.location='{{ route('admin.leads.details', $lead->id) }}'" style="cursor: pointer;">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="w-32-px h-32-px bg-light rounded-circle d-flex align-items-center justify-content-center text-primary-600 fw-bold">
                                            {{ strtoupper(substr($lead->first_name, 0, 1)) }}
                                        </div>
                                        <span class="fw-semibold">{{ $lead->first_name }} {{ $lead->last_name }}</span>
                                    </div>
                                </td>
                                <td>{{ $lead->email }}</td>
                                <td><span class="badge bg-light text-secondary-light">{{ $lead->subject ?? 'General' }}</span></td>
                                <td>
                                    @php $ctype = trim($lead->consultation_type); @endphp
                                    @if($ctype == 'whatsapp')
                                        <span class="badge bg-success text-white">NRI Patients</span>
                                    @elseif($ctype == 'online_consultation')
                                        <span class="badge bg-info text-white">Online</span>
                                    @elseif($ctype == 'inclinic_visit')
                                        <span class="badge bg-primary text-white">In-Clinic</span>
                                    @else
                                        <span class="badge bg-secondary text-white">{{ $ctype ?: 'Not Specified' }}</span>
                                    @endif
                                </td>
                                <td>{{ $lead->created_at->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.leads.details', $lead->id) }}" class="btn btn-sm btn-outline-primary px-12" onclick="event.stopPropagation();">Details</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom py-20 px-24 text-lg fw-semibold">
                Quick Actions
            </div>
            <div class="card-body p-24">
                <div class="d-grid gap-3">
                    <a href="{{ route('admin.blogs') }}" class="d-flex align-items-center gap-3 p-16 border rounded-12 text-secondary-light hover-bg-light transition-all">
                        <div class="w-40-px h-40-px bg-success-focus text-success-main rounded-circle d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0 text-dark">Write Blog</p>
                            <span class="text-xs">Create new blog post</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.faqs') }}" class="d-flex align-items-center gap-3 p-16 border rounded-12 text-secondary-light hover-bg-light transition-all">
                        <div class="w-40-px h-40-px bg-info-focus text-info-main rounded-circle d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:question-circle-outline"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0 text-dark">Manage FAQs</p>
                            <span class="text-xs">Update common questions</span>
                        </div>
                    </a>
                    <a href="{{ route('admin.settings') }}" class="d-flex align-items-center gap-3 p-16 border rounded-12 text-secondary-light hover-bg-light transition-all">
                        <div class="w-40-px h-40-px bg-warning-focus text-warning-main rounded-circle d-flex align-items-center justify-content-center">
                            <iconify-icon icon="solar:settings-outline"></iconify-icon>
                        </div>
                        <div>
                            <p class="fw-semibold mb-0 text-dark">Site Settings</p>
                            <span class="text-xs">Manage logos & info</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
