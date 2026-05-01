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
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Blogs List</h6>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm radius-8">
            <iconify-icon icon="solar:add-circle-outline" class="me-1"></iconify-icon> Add New Post
        </a>
    </div>

    <div class="card-body p-24">
        <div class="table-responsive">
            <table class="table bordered-table mb-0" id="blogTable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->created_at->format('d M, Y') }}</td>
                        <td>
                            @if($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="" 
                                     style="width:50px; height:50px; object-fit:cover; border-radius:6px;">
                            @else
                                <div style="width:50px; height:50px; background:#f1f5f9; border-radius:6px; display:flex; align-items:center; justify-content:center;">
                                    <iconify-icon icon="solar:gallery-outline" class="text-secondary-light"></iconify-icon>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $blog->title }}</div>
                            <div class="text-xs text-secondary-light">By {{ $blog->author ?? 'Admin' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info-focus text-info-main fw-medium px-8 py-4 radius-4 text-sm">
                                {{ $blog->category_rel->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td>
                            @if($blog->is_active)
                                <span class="badge bg-success-focus text-success-main fw-medium">Active</span>
                            @else
                                <span class="badge bg-danger-focus text-danger-main fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-info radius-8">
                                    <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon> Edit
                                </a>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" 
                                      onsubmit="return confirm('Are you sure you want to delete this post?')">
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
