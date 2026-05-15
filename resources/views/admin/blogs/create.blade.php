@extends('layout.layout')

@php
    $title = 'Create Blog Post';
    $subTitle = 'Blog Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#body").summernote({
                    height: 420,
                    placeholder: "Write your blog post content here...",
                    toolbar: [
                        ["style", ["style"]],
                        ["font", ["bold", "italic", "underline", "clear"]],
                        ["color", ["color"]],
                        ["para", ["ul", "ol", "paragraph"]],
                        ["table", ["table"]],
                        ["insert", ["link", "picture", "video"]],
                        ["view", ["fullscreen", "codeview", "help"]]
                    ]
                });

                bindSlugAuto("#blog_title", "#blog_slug");

                // Image preview
                $("#feature_image").on("change", function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $("#imgPreview").attr("src", e.target.result).show();
                            $("#imgPlaceholder").hide();
                            $("#imgOverlay").show();
                        };
                        reader.readAsDataURL(file);
                    }
                });

                $("#changeImgBtn").on("click", function() {
                    $("#feature_image").click();
                });
            });

            function slugifyText(value) {
                return String(value).toLowerCase().trim()
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

<style>
    /* ── Page Layout ── */
    .blog-create-wrap {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
        align-items: start;
    }

    @media (max-width: 991px) {
        .blog-create-wrap { grid-template-columns: 1fr; }
    }

    /* ── Panel Cards ── */
    .panel-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .panel-card:last-child { margin-bottom: 0; }

    .panel-card__header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 20px;
        border-bottom: 1px solid #f0f2f5;
        background: #fafbfc;
    }

    .panel-card__header .ph-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #e8f1ff;
        color: #185fa5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .panel-card__header h6 {
        font-size: 13.5px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0;
    }

    .panel-card__body { padding: 20px; }

    /* ── Form Controls ── */
    .field-group { margin-bottom: 18px; }
    .field-group:last-child { margin-bottom: 0; }

    .field-label {
        font-size: 11.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6c757d;
        margin-bottom: 6px;
        display: block;
    }

    .field-label .req { color: #dc3545; margin-left: 2px; }

    .form-control, .form-select {
        font-size: 13.5px;
        padding: 9px 13px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        background: #f8f9fb;
        color: #1a1a2e;
        transition: border-color .15s, box-shadow .15s;
        width: 100%;
    }

    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 3px rgba(13,110,253,.1);
        background: #fff;
        outline: none;
    }

    /* ── Slug Input Group ── */
    .slug-input-group {
        background: #f8f9fb;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 0 12px;
        display: flex;
        align-items: center;
        transition: border-color .15s, box-shadow .15s;
    }

    .slug-input-group:focus-within {
        border-color: #86b7fe;
        box-shadow: 0 0 0 3px rgba(13,110,253,.1);
        background: #fff;
    }

    .slug-input-group .slug-prefix {
        font-size: 12px;
        color: #adb5bd;
        white-space: nowrap;
    }

    .slug-input-group .form-control,
    .slug-input-group .form-control:focus {
        border: none !important;
        background: transparent !important;
        padding: 0 4px !important;
        box-shadow: none !important;
        width: auto !important;
        flex: 1;
        height: 38px;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
    }

    .field-hint {
        font-size: 11px;
        color: #adb5bd;
        margin-top: 4px;
        display: block;
    }

    /* ── Image Box ── */
    .img-edit-box {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        background: #f0f2f5;
        border: 1px solid #e9ecef;
    }

    .img-edit-box img#imgPreview {
        width: 100%;
        height: 170px;
        object-fit: cover;
        display: none;
    }

    .img-edit-box .img-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, .45);
        display: none;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 8px;
    }

    .img-edit-box:hover .img-overlay {
        display: flex;
    }

    #changeImgBtn {
        background: rgba(255, 255, 255, .9);
        border: none;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 12.5px;
        font-weight: 600;
        color: #1a1a2e;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: background .15s;
    }

    #changeImgBtn:hover {
        background: #fff;
    }

    .img-no-image {
        width: 100%;
        height: 170px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #adb5bd;
        cursor: pointer;
        transition: background .2s;
    }

    .img-no-image:hover {
        background: #e9ecef;
    }

    .img-no-image iconify-icon {
        font-size: 36px;
    }

    .img-no-image span {
        font-size: 12px;
        font-weight: 500;
    }

    /* ── Publish Toggle ── */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        background: #f8f9fb;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        cursor: pointer;
        transition: all .2s;
    }

    .toggle-row:hover { background: #fff; border-color: #dee2e6; }

    .toggle-row .tr-text .tr-label {
        font-size: 13px;
        font-weight: 600;
        color: #1a1a2e;
        display: block;
    }

    .toggle-row .tr-text .tr-sub {
        font-size: 11px;
        color: #868e96;
        display: block;
        margin-top: 1px;
    }

    .toggle-row .form-check { padding: 0; margin: 0; }

    .toggle-row .form-check-input {
        width: 40px !important;
        height: 22px !important;
        cursor: pointer;
        margin: 0 !important;
    }

    /* ── SEO Section ── */
    .seo-divider {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 20px 0 16px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #adb5bd;
    }

    .seo-divider::before,
    .seo-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e9ecef;
    }

    /* ── Submit Button ── */
    .btn-publish {
        width: 100%;
        padding: 11px;
        font-size: 13.5px;
        font-weight: 600;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: none;
        transition: opacity .15s;
    }

    .btn-publish:hover { opacity: .88; }

    /* ── Page Header ── */
    .page-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .page-topbar .pt-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .page-topbar .pt-sub {
        font-size: 12px;
        color: #adb5bd;
        margin-top: 2px;
    }

    /* ── Summernote Fixes ── */
    .note-editor.note-frame {
        border-radius: 8px !important;
        border: 1px solid #dee2e6 !important;
        overflow: hidden;
    }

    .note-toolbar { background: #f8f9fb !important; border-bottom: 1px solid #e9ecef !important; }

    .invalid-feedback { display:block; font-size:11px; color:#dc3545; margin-top:4px; font-weight:500; }
    .form-control.is-invalid, .form-select.is-invalid { border-color:#dc3545 !important; background-image:none !important; }
    .img-drop-zone.is-invalid { border-color: #dc3545 !important; background-color: #fff8f8; }
</style>

@section('content')

<div class="page-topbar">
    <div>
        <h5 class="pt-title">Create New Post</h5>
        <p class="pt-sub">Fill in the details below to publish a new blog article</p>
    </div>
    <a href="{{ route('admin.blogs') }}" class="btn btn-sm btn-outline-secondary radius-8 d-flex align-items-center gap-2">
        <iconify-icon icon="solar:arrow-left-outline"></iconify-icon> Back to List
    </a>
</div>



<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="blog-create-wrap">

        {{-- ═══════════════ LEFT COLUMN ═══════════════ --}}
        <div>
            {{-- Post Content Card --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon">
                        <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                    </div>
                    <h6>Post Content</h6>
                </div>
                <div class="panel-card__body">
                    <div class="field-group">
                        <label class="field-label" for="blog_title">Post Title <span class="req">*</span></label>
                        <input type="text" id="blog_title" name="title" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter a compelling post title…" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="blog_slug">URL Slug</label>
                        <div class="slug-input-group">
                            <span class="slug-prefix">/blog/</span>
                            <input type="text" id="blog_slug" name="slug" class="form-control"
                                placeholder="auto-generated-from-title" value="{{ old('slug') }}">
                        </div>
                        <span class="field-hint">Leave blank to auto-generate from title</span>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="excerpt">Excerpt / Summary <span class="req">*</span></label>
                        <textarea name="excerpt" id="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror"
                            placeholder="A short, compelling summary of this post (shown on listing pages)…" required>{{ old('excerpt') }}</textarea>
                        @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Post Body <span class="req">*</span></label>
                        <textarea name="body" id="body" class="@error('body') is-invalid @enderror" required>{{ old('body') }}</textarea>
                        @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════ RIGHT SIDEBAR ═══════════════ --}}
        <div>

            {{-- Publish Settings --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon">
                        <iconify-icon icon="solar:settings-outline"></iconify-icon>
                    </div>
                    <h6>Publish Settings</h6>
                </div>
                <div class="panel-card__body">

                    {{-- Feature Image --}}
                    <div class="field-group">
                        <label class="field-label">Feature Image <span class="req">*</span></label>
                        <input type="file" name="image" id="feature_image" accept="image/*" style="display:none;">
                        <div class="img-edit-box @error('image') is-invalid @enderror">
                            <div class="img-no-image" id="imgPlaceholder" onclick="document.getElementById('feature_image').click()">
                                <iconify-icon icon="solar:gallery-add-outline"></iconify-icon>
                                <span>Click to upload image</span>
                            </div>
                            <img id="imgPreview" src="" alt="Preview">
                            <div class="img-overlay" id="imgOverlay">
                                <button type="button" id="changeImgBtn">
                                    <iconify-icon icon="solar:camera-outline"></iconify-icon> Change Image
                                </button>
                            </div>
                        </div>
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <span class="field-hint"><iconify-icon icon="solar:info-circle-outline"></iconify-icon> Recommended Size: 800x550px</span>
                    </div>

                    {{-- Category --}}
                    <div class="field-group">
                        <label class="field-label" for="category_id">Category <span class="req">*</span></label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="" disabled {{ old('category_id') == '' ? 'selected' : '' }}>— Select Category —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Tags --}}
                    <div class="field-group">
                        <label class="field-label" for="tags">Tags</label>
                        <input type="text" name="tags" id="tags" class="form-control"
                            placeholder="ivf, health, fertility" value="{{ old('tags') }}">
                        <span class="field-hint">Comma separated values</span>
                    </div>

                    {{-- Author --}}
                    <div class="field-group">
                        <label class="field-label" for="author">Author</label>
                        <input type="text" name="author" id="author" class="form-control"
                            placeholder="Dr. Yuvraj Jadeja" value="{{ old('author', 'Dr. Yuvraj Jadeja') }}">
                    </div>

                    {{-- Publish Toggle --}}
                    <div class="field-group">
                        <label class="toggle-row" for="is_active">
                            <div class="tr-text">
                                <span class="tr-label">Publish Post</span>
                                <span class="tr-sub">Make this post visible on the website</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- SEO Settings Card --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon" style="background:#e8f5e9;color:#2e7d32;">
                        <iconify-icon icon="solar:chart-2-outline"></iconify-icon>
                    </div>
                    <h6>SEO Settings</h6>
                </div>
                <div class="panel-card__body">
                    <div class="field-group">
                        <label class="field-label" for="meta_title">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" class="form-control"
                            placeholder="SEO page title (60 chars max)" value="{{ old('meta_title') }}" maxlength="60">
                        <span class="field-hint">Defaults to post title if left empty</span>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control"
                            placeholder="ivf, fertility, treatment" value="{{ old('meta_keywords') }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="meta_description">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" class="form-control"
                            placeholder="Brief description for search engines (155 chars max)" maxlength="155">{{ old('meta_description') }}</textarea>
                        <span class="field-hint">Defaults to excerpt if left empty</span>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary btn-publish">
                <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                Publish Post
            </button>

        </div>
    </div>
</form>

@endsection