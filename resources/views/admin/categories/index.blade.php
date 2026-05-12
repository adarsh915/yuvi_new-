@extends('layout.layout')

@php
    $title = 'Manage Categories';
    $subTitle = 'Blog Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#categoryTable").DataTable();

                bindSlugAuto("#create_name", "#create_slug");
                bindSlugAuto("#edit_name", "#edit_slug");
            });

            function editCategory(id, name, slug, desc) {
                $("#editModal").modal("show");
                $("#edit_name").val(name);
                $("#edit_slug").val(slug);
                $("#edit_slug").data("manual", false);
                $("#edit_description").val(desc);
                $("#editForm").attr("action", "/admin/categories/" + id);
            }

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


    .btn {
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
    }

</style>

<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12 bg-base">
            <h6 class="text-lg fw-semibold mb-20 d-flex align-items-center gap-2">
                <iconify-icon icon="solar:add-circle-outline" class="text-primary-600"></iconify-icon>
                Add New Category
            </h6>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-20">
                    <label class="form-label mb-8">Category Name</label>
                    <input type="text" id="create_name" name="name" class="form-control" placeholder="e.g. Fertility Tips" required>
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Slug</label>
                    <input type="text" id="create_slug" name="slug" class="form-control" placeholder="auto-generated-from-name">
                </div>
                <div class="mb-20">
                    <label class="form-label mb-8">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Optional description..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center gap-2">
                    <iconify-icon icon="solar:check-circle-outline"></iconify-icon>
                    Create Category
                </button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card radius-12 bg-base h-100">
            <div class="card-header border-bottom p-24">
                <h6 class="text-lg fw-semibold mb-0 d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:list-outline" class="text-primary-600"></iconify-icon>
                    Categories List
                </h6>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive">
                    <table class="table bordered-table mb-0" id="categoryTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Blogs</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="fw-semibold text-primary-600">{{ $category->name }}</div>
                                    <div class="text-xs text-secondary-light line-clamp-1" title="{{ $category->description }}">{{ $category->description }}</div>
                                </td>
                                <td>
                                    <code class="text-primary-600 bg-primary-50 px-2 py-1 radius-4" style="font-size: 11px;">{{ $category->slug }}</code>
                                </td>
                                <td>
                                    <span class="badge bg-info-focus text-info-main d-inline-flex align-items-center gap-1">
                                        <iconify-icon icon="solar:document-text-outline"></iconify-icon>
                                        {{ $category->blogs_count }} Posts
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-outline-info d-flex align-items-center justify-content-center" 
                                                style="width:32px; height:32px; padding:0; border-radius:8px;"
                                                onclick='editCategory({{ $category->id }}, @json($category->name), @json($category->slug), @json($category->description))'>
                                            <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                        </button>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center justify-content-center"
                                                    style="width:32px; height:32px; padding:0; border-radius:8px;">
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
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
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom bg-light">
                <h6 class="modal-title d-flex align-items-center gap-2">
                    <iconify-icon icon="solar:pen-new-square-outline" class="text-primary-600"></iconify-icon>
                    Edit Category
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label mb-8">Category Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Slug</label>
                        <input type="text" name="slug" id="edit_slug" class="form-control" placeholder="auto-generated-from-name">
                    </div>
                    <div class="mb-20">
                        <label class="form-label mb-8">Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:check-read-outline"></iconify-icon>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
