@extends('layout.layout')

@php
    $title = 'SEO Settings';
    $subTitle = 'Manage Page Metadata';
    $script = '
                <script>
                    $(document).on("click", ".edit-seo-btn", function() {
                        const id = $(this).data("id");
                        const title = $(this).data("title");
                        const desc = $(this).data("description");
                        const keys = $(this).data("keywords");
                        const page = $(this).data("page");

                        $("#editModal").modal("show");
                        $("#modal_page_name").text(page);
                        $("#edit_meta_title").val(title);
                        $("#edit_meta_description").val(desc);
                        $("#edit_meta_keywords").val(keys);
                        $("#editForm").attr("action", "/admin/seo/" + id);
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
        .form-label {
            font-size: 11px !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6c757d !important;
        }
    </style>

    <div class="row gy-4">
        <div class="col-12">
            <div class="card radius-12 bg-base">
                <div class="card-header border-bottom p-24">
                    <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:global-outline" class="text-primary-600"></iconify-icon>
                        Page SEO Management
                    </h6>
                </div>
                <div class="card-body p-24">
                    <div class="table-responsive">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th>Page Name</th>
                                    <th>Meta Title</th>
                                    <th>Description</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seoSettings as $seo)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold text-primary-600 text-md">
                                                {{ $pageNames[$seo->page_identifier] ?? ucfirst($seo->page_identifier) }}
                                            </span>
                                            <div class="text-xs text-secondary-light">ID: {{ $seo->page_identifier }}</div>
                                        </td>
                                        <td>
                                            <div class="text-sm fw-medium">{{ $seo->meta_title ?? 'Not Set' }}</div>
                                        </td>
                                        <td>
                                            <div class="text-xs text-secondary-light" style="max-width: 300px; white-space: normal;">
                                                {{ Str::limit($seo->meta_description, 100, '...') ?? 'Not Set' }}
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary edit-seo-btn d-inline-flex align-items-center justify-content-center"
                                                style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                data-id="{{ $seo->id }}"
                                                data-page="{{ $pageNames[$seo->page_identifier] ?? ucfirst($seo->page_identifier) }}"
                                                data-title="{{ $seo->meta_title }}"
                                                data-description="{{ $seo->meta_description }}"
                                                data-keywords="{{ $seo->meta_keywords }}">
                                                <i class="ri-edit-line" style="font-size: 18px;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-16">
                <div class="modal-header border-bottom bg-light">
                    <h6 class="modal-title d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                        Edit SEO: <span id="modal_page_name" class="text-primary-main"></span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-24">
                        <div class="mb-20">
                            <label class="form-label mb-8">Meta Title</label>
                            <input type="text" name="meta_title" id="edit_meta_title" class="form-control" placeholder="SEO Title tag">
                        </div>
                        <div class="mb-20">
                            <label class="form-label mb-8">Meta Description</label>
                            <textarea name="meta_description" id="edit_meta_description" class="form-control" rows="4" placeholder="Brief page summary for search results"></textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label mb-8">Meta Keywords</label>
                            <textarea name="meta_keywords" id="edit_meta_keywords" class="form-control" rows="2" placeholder="Keyword1, Keyword2, Keyword3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
