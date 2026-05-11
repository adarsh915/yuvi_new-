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
<div class="row gy-4">
    <div class="col-md-4">
        <div class="card p-24 radius-12">
            <h6 class="text-lg fw-semibold mb-20">Add New Category</h6>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Category Name</label>
                    <input type="text" id="create_name" name="name" class="form-control" placeholder="e.g. Fertility Tips" required>
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Slug</label>
                    <input type="text" id="create_slug" name="slug" class="form-control" placeholder="auto-generated-from-name">
                </div>
                <div class="mb-20">
                    <label class="form-label fw-semibold text-sm mb-8">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Optional description..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Create Category</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card p-24 radius-12 h-100">
            <h6 class="text-lg fw-semibold mb-20">Categories List</h6>
            <div class="table-responsive">
                <table class="table bordered-table mb-0" id="categoryTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Blogs Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="fw-medium text-primary-600">{{ $category->name }}</div>
                                <div class="text-xs text-secondary-light">{{ $category->description }}</div>
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>
                                <span class="badge bg-info-focus text-info-main px-12">{{ $category->blogs_count }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick='editCategory({{ $category->id }}, @json($category->name), @json($category->slug), @json($category->description))'>
                                        <iconify-icon icon="solar:pen-new-square-outline"></iconify-icon>
                                    </button>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content radius-16">
            <div class="modal-header border-bottom-0">
                <h6 class="modal-title">Edit Category</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Category Name</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Slug</label>
                        <input type="text" name="slug" id="edit_slug" class="form-control" placeholder="auto-generated-from-name">
                    </div>
                    <div class="mb-20">
                        <label class="form-label fw-semibold text-sm mb-8">Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
