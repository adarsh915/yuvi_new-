@extends('layout.layout')

@php
    $title = 'Manage Blogs';
    $subTitle = 'Blog Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#blogTable").DataTable({
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

</style>

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:document-text-outline" class="text-primary-600"></iconify-icon>
            Blogs List
        </h6>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm radius-8 d-flex align-items-center gap-2">
            <iconify-icon icon="solar:add-circle-outline"></iconify-icon>
            Add New Post
        </a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="blogTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Image</th>
                        <th>Blog Details</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <iconify-icon icon="solar:calendar-outline" class="text-secondary-light"></iconify-icon>
                                {{ $blog->created_at->format('d M, Y') }}
                            </div>
                        </td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="" 
                                     style="width:50px; height:50px; object-fit:cover; border-radius:10px; border: 1px solid #eee;">
                            @else
                                <div style="width:50px; height:50px; background:#f8f9fa; border-radius:10px; display:flex; align-items:center; justify-content:center; border: 1px solid #eee;">
                                    <iconify-icon icon="solar:gallery-outline" class="text-secondary-light" style="font-size: 20px;"></iconify-icon>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold text-dark">{{ $blog->title }}</div>
                            <div class="text-xs text-secondary-light mt-1">/{{ $blog->slug }}</div>
                            <div class="text-xs text-primary-600 mt-1 d-flex align-items-center gap-1">
                                <iconify-icon icon="solar:user-outline"></iconify-icon>
                                {{ $blog->author ?? 'Admin' }}
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info-focus text-info-main">
                                {{ $blog->category_rel->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td>
                            @if($blog->is_active)
                                <span class="badge bg-success-focus text-success-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                                    Active
                                </span>
                            @else
                                <span class="badge bg-danger-focus text-danger-main d-inline-flex align-items-center gap-1">
                                    <iconify-icon icon="solar:close-circle-outline"></iconify-icon>
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center"
                                   style="width:32px; height:32px; padding:0; border-radius:8px;">
                                    <i class="ri-edit-line" style="font-size: 18px;"></i>
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this blog? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center"
                                            style="width:32px; height:32px; padding:0; border-radius:8px;">
                                        <i class="ri-delete-bin-line" style="font-size: 18px;"></i>
                                    </button>
                                </form>
                            </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
