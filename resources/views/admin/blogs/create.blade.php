@extends('layout.layout')

@php
    $title = 'Create Blog Post';
    $subTitle = 'Blog Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#body").summernote({
                    height: 400,
                    placeholder: "Write your blog post content here...",
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

                bindSlugAuto("#blog_title", "#blog_slug");
            });

            function slugifyText(value) {
                return String(value)
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, "")
                    .replace(/\s+/g, "-")
                    .replace(/-+/g, "-");
            }

            function bindSlugAuto(sourceSelector, slugSelector) {
                const $source = $(sourceSelector);
                const $slug = $(slugSelector);

                if (!$source.length || !$slug.length) return;

                $slug.data("manual", false);

                $slug.on("input", function() {
                    $(this).data("manual", $(this).val().trim() !== "");
                });

                $source.on("input", function() {
                    if ($slug.data("manual")) return;
                    $slug.val(slugifyText($source.val()));
                });
            }
        </script>
    ';
@endphp

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Create New Post</h6>
        <a href="{{ route('admin.blogs') }}" class="btn btn-outline-secondary btn-sm radius-8">
            <iconify-icon icon="solar:arrow-left-outline" class="me-1"></iconify-icon> Back to List
        </a>
    </div>
    <div class="card-body p-24">
        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row gy-20">
                <div class="col-md-8">
                    <div class="row gy-20">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Post Title <span class="text-danger">*</span></label>
                            <input type="text" id="blog_title" name="title" class="form-control radius-8" placeholder="Enter post title" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Slug</label>
                            <input type="text" id="blog_slug" name="slug" class="form-control radius-8" placeholder="auto-generated-from-title">
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Excerpt / Summary <span class="text-danger">*</span></label>
                            <textarea name="excerpt" rows="3" class="form-control radius-8" placeholder="Brief summary of the post" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Post Body <span class="text-danger">*</span></label>
                            <textarea name="body" id="body" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border p-16 radius-12 bg-base">
                        <div class="row gy-20">
                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Feature Image <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control radius-8" accept="image/*" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select radius-8" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Tags (Comma separated)</label>
                                <input type="text" name="tags" class="form-control radius-8" placeholder="ivf, health, tips">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked value="1">
                                    <label class="form-check-label fw-semibold" for="is_active">Publish Post</label>
                                </div>
                            </div>

                            <div class="col-12 mt-20">
                                <button type="submit" class="btn btn-primary w-100 radius-8">Save Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
