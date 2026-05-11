@extends('layout.layout')

@php
    $title = 'Lead Details';
    $subTitle = 'Contact Leads';
@endphp

@section('content')
<div class="row gy-4">
    <div class="col-md-5">
        <div class="card p-24 radius-12 bg-base h-100">
            <h6 class="text-lg fw-semibold mb-20">Core Information</h6>
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
                <div class="text-lg fw-medium">{{ $lead->email }}</div>
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
                <div class="text-lg fw-medium text-primary-600">{{ $lead->subject }}</div>
            </div>
            <div class="mb-20">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Consultation Type</label>
                <div class="text-lg fw-medium">{{ $lead->consultation_type ?? '-' }}</div>
            </div>
            <div class="mb-0">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Date Received</label>
                <div class="text-md">{{ $lead->created_at->format('d M, Y - h:i A') }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card p-24 radius-12 bg-base h-100">           
            <div class="mb-24">
                <label class="text-secondary-light text-xs fw-bold text-uppercase">Message / Story</label>
                <div class="p-16 bg-light radius-8 mt-8" style="white-space: pre-wrap;">{{ $lead->message }}</div>
            </div>

            @if($lead->dynamic_data && count($lead->dynamic_data) > 0)
                <h6 class="text-md fw-semibold mb-16 border-top pt-20">Additional Form Fields</h6>
                <div class="table-responsive">
                    <table class="table bordered-table">
                        <tbody>
                            @foreach($lead->dynamic_data as $label => $value)
                            <tr>
                                <td class="fw-bold" style="width: 200px;">{{ $label }}</td>
                                <td>{{ $value }}</td>
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
    <a href="{{ route('admin.leads') }}" class="btn btn-outline-secondary">Back to Leads</a>
</div>
@endsection
