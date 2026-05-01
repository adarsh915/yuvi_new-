@extends('layout.layout')

@php
    $title = 'Edit Blog Post';
    $subTitle = 'Blog Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#body").summernote({
                    height: 400,
                    toolbar: [
                        ["style", ["style"]],
                        ["font", ["bold", "underline", "clear"]],
                        ["color", ["color"]],
                        ["para", ["ul", "ol", "paragraph"]],
                        ["table", ["table"]],
                        ["insert", ["link", "picture", "video"]],
                        ["view", ["fullscreen", "codeview", "help"]]
                    ]
                });
            });
        </script>
    ';
@endphp

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Edit Post: {{ $blog->title }}</h6>
        <a href="{{ route('admin.blogs') }}" class="btn btn-outline-secondary btn-sm radius-8">
            <iconify-icon icon="solar:arrow-left-outline" class="me-1"></iconify-icon> Back to List
        </a>
    </div>
    <div class="card-body p-24">
        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row gy-20">
                <div class="col-md-8">
                    <div class="row gy-20">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Post Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control radius-8" value="{{ $blog->title }}" required>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Excerpt / Summary <span class="text-danger">*</span></label>
                            <textarea name="excerpt" rows="3" class="form-control radius-8" required>{{ $blog->excerpt }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Post Body <span class="text-danger">*</span></label>
                            <textarea name="body" id="body" required>{{ $blog->body }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border p-16 radius-12 bg-base">
                        <div class="row gy-20">
                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Feature Image (Leave blank to keep current)</label>
                                <input type="file" name="image" class="form-control radius-8" accept="image/*">
                                @if($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" class="mt-8 radius-8" style="width: 100%; height: 150px; object-fit: cover;">
                                @endif
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select radius-8" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Author Name</label>
                                <input type="text" name="author" class="form-control radius-8" value="{{ $blog->author }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Tags (Comma separated)</label>
                                <input type="text" name="tags" class="form-control radius-8" value="{{ $blog->tags }}">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $blog->is_active ? 'checked' : '' }} value="1">
                                    <label class="form-check-label fw-semibold" for="is_active">Publish Post</label>
                                </div>
                            </div>

                            <div class="col-12 mt-20">
                                <button type="submit" class="btn btn-primary w-100 radius-8">Update Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
