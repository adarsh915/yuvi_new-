@extends('layout.layout')

@php
    $title = 'Lead Details';
    $subTitle = 'Contact Leads';
@endphp

@section('content')
<style>
    .card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: none;
    }

    .text-uppercase {
        letter-spacing: 0.05em;
        font-size: 11px !important;
    }

    .bg-light {
        background-color: #f8f9fa !important;
        border: 1px solid #e9ecef;
    }

    .table.bordered-table td {
        padding: 12px 16px;
    }
</style>

<div class="row gy-4">
    <div class="col-md-5">
        <div class="card p-24 radius-12 bg-base h-100">
            <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                <iconify-icon icon="solar:user-id-outline" class="text-primary-600"></iconify-icon>
                Core Information
            </h6>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">First Name</label>
                <div class="text-lg fw-medium">{{ $lead->first_name ?? '-' }}</div>
            </div>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Last Name</label>
                <div class="text-lg fw-medium">{{ $lead->last_name ?? '-' }}</div>
            </div>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Email Address</label>
                <div class="text-lg fw-medium text-primary-600">{{ $lead->email }}</div>
            </div>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Phone Number</label>
                <div class="text-lg fw-medium">{{ $lead->phone }}</div>
            </div>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Preferred Location</label>
                <div class="text-lg fw-medium">{{ $lead->preferred_location ?? '-' }}</div>
            </div>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Subject / Concern</label>
                <div class="text-lg fw-medium">{{ $lead->subject }}</div>
            </div>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Consultation Type</label>
                <div class="text-lg fw-medium">
                    <span class="badge bg-info-focus text-info-main">
                        {{ $lead->consultation_type ?? '-' }}
                    </span>
                </div>
            </div>
            <div class="mb-0">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Date Received</label>
                <div class="text-md d-flex align-items-center gap-1 text-secondary">
                    <iconify-icon icon="solar:calendar-outline"></iconify-icon>
                    {{ $lead->created_at->format('d M, Y - h:i A') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card p-24 radius-12 bg-base h-100">           
            <div class="mb-24">
                <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:chat-line-outline" class="text-primary-600"></iconify-icon>
                    Message / Story
                </h6>
                <div class="p-16 bg-light radius-8 mt-8 text-dark" style="white-space: pre-wrap; line-height: 1.6;">{{ $lead->message }}</div>
            </div>

            @if($lead->dynamic_data && count($lead->dynamic_data) > 0)
                <h6 class="text-md fw-semibold mb-16 border-top pt-20 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:document-text-outline" class="text-primary-600"></iconify-icon>
                    Additional Form Fields
                </h6>
                <div class="table-responsive">
                    <table class="table bordered-table">
                        <tbody>
                            @foreach($lead->dynamic_data as $label => $value)
                            <tr>
                                <td class="fw-bold text-secondary" style="width: 200px; font-size: 13px;">{{ $label }}</td>
                                <td class="text-dark" style="font-size: 13px;">{{ $value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="mt-24">
    <a href="{{ route('admin.leads') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
        <iconify-icon icon="solar:arrow-left-outline"></iconify-icon>
        Back to Leads
    </a>
</div>
@endsection
