@extends('layout.layout')

@php
    $title = 'All Notifications';
    $subTitle = 'Monitor Patient Inquiries & Submissions';
@endphp

@section('content')
<style>
    .notif-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 10px 16px;
        margin-bottom: 12px;
        align-items: center;
        transition: all 0.2s ease;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        position: relative;
    }
    .notif-card.unread {
        background: #fcfdfe;
        border-color: #dbeafe;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.04);
    }
    .notif-card.unread::before {
        content: "";
        position: absolute;
        left: 0;
        top: 20%;
        bottom: 20%;
        width: 4px;
        background: #2563eb;
        border-radius: 0 4px 4px 0;
    }
    .notif-icon-wrap {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .notif-content { flex-grow: 1; }
    .notif-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px; }
    .notif-type { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; display: block; }
    .notif-title { font-size: 14px; font-weight: 600; color: #1a1a2e; margin-bottom: 0px; }
    .notif-time { font-size: 12px; color: #94a3b8; }
    .notif-body { font-size: 13px; color: #64748b; margin-top: 2px; line-height: 1.3; }
    .notif-actions { display: flex; gap: 8px; margin-top: 0; flex-shrink: 0; }
    
    .empty-state { text-align: center; padding: 60px 20px; background: #fff; border-radius: 16px; border: 1px solid #e9ecef; }
    .unread-badge { background: #2563eb; color: #fff; padding: 2px 8px; border-radius: 6px; font-size: 10px; font-weight: 700; }
</style>

<div class="d-flex align-items-center justify-content-between mb-24">
    <div>
        <h5 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin: 0;">Inbound Alerts</h5>
        <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Track all incoming leads, consultation requests, and quiz results.</p>
    </div>
    @if($notifications->where('is_read', false)->count() > 0)
        <a href="{{ route('admin.notifications.markAllRead') }}" class="btn btn-sm btn-outline-primary radius-10 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:check-read-outline" style="font-size: 18px;"></iconify-icon>
            <span>Mark All as Read</span>
        </a>
    @endif
</div>

@if($notifications->count() > 0)
    <div class="row">
        <div class="col-12">
            @foreach($notifications as $notif)
                @php
                    $isQuiz = ($notif->type === 'Quiz Submission');
                    $typeName = $isQuiz ? 'quiz' : 'lead';
                @endphp
                <div class="notif-card {{ !$notif->is_read ? 'unread' : '' }}">
                    <div class="notif-icon-wrap bg-{{ $notif->color }}-focus text-{{ $notif->color }}-main">
                        <iconify-icon icon="{{ $notif->icon }}"></iconify-icon>
                    </div>
                    <div class="notif-content">
                        <div class="notif-header">
                            <div>
                                <span class="notif-type text-{{ $notif->color }}-main d-flex align-items-center gap-1">
                                    {{ $notif->type }}
                                    @if(!$notif->is_read)
                                        <span class="unread-badge ml-2">NEW</span>
                                    @endif
                                </span>
                                <h6 class="notif-title">{{ $isQuiz ? $notif->name : $notif->full_name }}</h6>
                            </div>
                        </div>
                        <div class="notif-body">
                            @if($isQuiz)
                                Patient completed the health assessment quiz from <strong>{{ $notif->city ?? 'Unknown City' }}</strong>.
                            @else
                                New inquiry received regarding <strong>{{ $notif->subject }}</strong>. 
                                <span class="d-block mt-1 text-xs opacity-75">Contact: {{ $notif->phone }} | {{ $notif->email }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="notif-actions" style="flex-direction: column; align-items: flex-end; gap: 4px;">
                        <span class="notif-time d-flex align-items-center gap-1 mb-4">
                            <iconify-icon icon="solar:clock-circle-outline"></iconify-icon>
                            {{ $notif->created_at->diffForHumans() }}
                        </span>
                        <div class="d-flex gap-2">
                            <a href="{{ $notif->route }}" class="btn btn-sm btn-light radius-8 px-12">
                                <iconify-icon icon="solar:eye-outline"></iconify-icon> View
                            </a>
                            @if(!$notif->is_read)
                                <a href="{{ route('admin.notifications.markRead', [$typeName, $notif->id]) }}" class="btn btn-sm btn-outline-{{ $notif->color }} radius-8 px-12">
                                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon> Read
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <div class="empty-state">
        <div class="mb-20" style="display: inline-flex; width: 80px; height: 80px; background: #f8fafc; border-radius: 50%; align-items: center; justify-content: center; font-size: 40px; color: #cbd5e1;">
            <iconify-icon icon="solar:bell-off-outline"></iconify-icon>
        </div>
        <h5 style="font-size: 18px; font-weight: 600; color: #1a1a2e;">No notifications yet</h5>
        <p style="font-size: 14px; color: #64748b; max-width: 300px; margin: 8px auto 0;">When patients submit forms or quizzes, they will appear here in real-time.</p>
    </div>
@endif

@endsection
