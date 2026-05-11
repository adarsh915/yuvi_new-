@extends('layout.layout')

@php
    $title = 'Edit Service';
    $subTitle = 'Service Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#approach_text").summernote({ height: 250 });
                $("#safety_text").summernote({ height: 250 });
            });
        </script>
    ';
@endphp

@section('content')
<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
        <h6 class="text-lg fw-semibold mb-0">Edit Service: {{ $service->title }}</h6>
        <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary btn-sm radius-8">
            <iconify-icon icon="solar:arrow-left-outline" class="me-1"></iconify-icon> Back to List
        </a>
    </div>
    <div class="card-body p-24">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row gy-20">
                {{-- Left Column: Main Content --}}
                <div class="col-md-8">
                    <div class="row gy-20">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Service Title <span class="text-danger">*</span></label>
                            <input type="text" id="service_title" name="title" class="form-control radius-8" value="{{ $service->title }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Slug</label>
                            <input type="text" id="service_slug" name="slug" class="form-control radius-8" value="{{ $service->slug }}" placeholder="auto-generated-from-title">
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Short Description (Listing Page) <span class="text-danger">*</span></label>
                            <textarea name="short_description" rows="2" class="form-control radius-8" required>{{ $service->short_description }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">The Approach Content <span class="text-danger">*</span></label>
                            <textarea name="approach_text" id="approach_text" required>{{ $service->approach_text }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Safety & Ethics Content <span class="text-danger">*</span></label>
                            <textarea name="safety_text" id="safety_text" required>{{ $service->safety_text }}</textarea>
                        </div>

                        <hr class="my-20">
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm mb-8">Protocol Steps (Typical Protocol)</label>
                            <div id="protocol-container">
                                @if($service->protocol_json)
                                    @foreach($service->protocol_json as $index => $step)
                                        <div class="protocol-item border p-12 radius-8 mb-12">
                                            <div class="d-flex justify-content-between align-items-center mb-8">
                                                <span class="badge bg-primary-focus text-primary-main">Step {{ $index + 1 }}</span>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-item" {{ $index == 0 ? 'style=display:none;' : '' }}>Remove</button>
                                            </div>
                                            <input type="text" name="protocol[{{ $index }}][title]" class="form-control mb-8" value="{{ $step['title'] ?? '' }}" placeholder="Step Title">
                                            <textarea name="protocol[{{ $index }}][desc]" class="form-control" rows="2" placeholder="Description...">{{ $step['desc'] ?? '' }}</textarea>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="protocol-item border p-12 radius-8 mb-12">
                                        <div class="d-flex justify-content-between align-items-center mb-8">
                                            <span class="badge bg-primary-focus text-primary-main">Step 1</span>
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-item" style="display:none;">Remove</button>
                                        </div>
                                        <input type="text" name="protocol[0][title]" class="form-control mb-8" placeholder="Step Title">
                                        <textarea name="protocol[0][desc]" class="form-control" rows="2" placeholder="Description..."></textarea>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-protocol" class="btn btn-sm btn-outline-primary mt-4">
                                <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Another Step
                            </button>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm mb-8">Expectations List (What to Expect)</label>
                            <div id="expect-container">
                                @if($service->expect_json)
                                    @foreach($service->expect_json as $index => $item)
                                        <div class="expect-item d-flex gap-8 mb-8">
                                            <input type="text" name="expectations[]" class="form-control" value="{{ $item }}" placeholder="Point...">
                                            <button type="button" class="btn btn-outline-danger remove-expect" {{ $index == 0 ? 'style=display:none;' : '' }}>
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="expect-item d-flex gap-8 mb-8">
                                        <input type="text" name="expectations[]" class="form-control" placeholder="Point...">
                                        <button type="button" class="btn btn-outline-danger remove-expect" style="display:none;">
                                            <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-expect" class="btn btn-sm btn-outline-primary mt-4">
                                <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Another Point
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Settings & Meta --}}
                <div class="col-md-4">
                    <div class="card border p-16 radius-12 bg-base">
                        <div class="row gy-20">
                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Category Tag <span class="text-danger">*</span></label>
                                <input type="text" name="category_tag" class="form-control radius-8" value="{{ $service->category_tag }}" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Accent Style</label>
                                <select name="accent_class" class="form-control radius-8">
                                    <option value="ivf" {{ $service->accent_class == 'ivf' ? 'selected' : '' }}>IVF (Crimson)</option>
                                    <option value="pcos" {{ $service->accent_class == 'pcos' ? 'selected' : '' }}>PCOS (Purple)</option>
                                    <option value="male" {{ $service->accent_class == 'male' ? 'selected' : '' }}>Male (Blue)</option>
                                    <option value="obs" {{ $service->accent_class == 'obs' ? 'selected' : '' }}>Obstetrics (Green)</option>
                                    <option value="pres" {{ $service->accent_class == 'pres' ? 'selected' : '' }}>Preservation (Indigo)</option>
                                    <option value="surg" {{ $service->accent_class == 'surg' ? 'selected' : '' }}>Surgical (Teal)</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Listing Image (Leave blank to keep)</label>
                                <input type="file" name="listing_image" class="form-control radius-8" accept="image/*">
                                @if($service->listing_image)
                                    <img src="{{ asset('storage/' . $service->listing_image) }}" class="mt-8 radius-8" style="width: 100%; height: 100px; object-fit: cover;">
                                @endif
                            </div>

                            <hr>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Eyebrow</label>
                                <input type="text" name="hero_eyebrow" class="form-control radius-8" value="{{ $service->hero_eyebrow }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Lead Text <span class="text-danger">*</span></label>
                                <textarea name="hero_lead" rows="2" class="form-control radius-8" required>{{ $service->hero_lead }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Image (Leave blank to keep)</label>
                                <input type="file" name="hero_image" class="form-control radius-8" accept="image/*">
                                @if($service->hero_image)
                                    <img src="{{ asset('storage/' . $service->hero_image) }}" class="mt-8 radius-8" style="width: 100%; height: 100px; object-fit: cover;">
                                @endif
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Pills (Tags)</label>
                                <div id="pills-container">
                                    @if($service->hero_pills)
                                        @foreach($service->hero_pills as $index => $pill)
                                            <div class="pill-item d-flex gap-8 mb-8">
                                                <input type="text" name="hero_pills[]" class="form-control" value="{{ $pill }}" placeholder="Tag">
                                                <button type="button" class="btn btn-outline-danger remove-pill" {{ $index == 0 ? 'style=display:none;' : '' }}>
                                                    <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                                </button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="pill-item d-flex gap-8 mb-8">
                                            <input type="text" name="hero_pills[]" class="form-control" placeholder="Tag">
                                            <button type="button" class="btn btn-outline-danger remove-pill" style="display:none;">
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-pill" class="btn btn-sm btn-outline-primary mt-4">
                                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Pill
                                </button>
                            </div>

                            <hr>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Quick Stats</label>
                                <div class="input-group mb-8">
                                    <input type="text" name="stat1_num" class="form-control" value="{{ $service->stat1_num }}">
                                    <input type="text" name="stat1_label" class="form-control" value="{{ $service->stat1_label }}">
                                </div>
                                <div class="input-group mb-8">
                                    <input type="text" name="stat2_num" class="form-control" value="{{ $service->stat2_num }}">
                                    <input type="text" name="stat2_label" class="form-control" value="{{ $service->stat2_label }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                                <input type="number" name="order" class="form-control radius-8" value="{{ $service->order }}">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $service->is_active ? 'checked' : '' }} value="1">
                                    <label class="form-check-label fw-semibold" for="is_active">Service Active</label>
                                </div>
                            </div>

                            <div class="col-12 mt-20">
                                <button type="submit" class="btn btn-primary w-100 radius-8">Update Service</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function slugifyText(value) {
        return String(value)
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    function bindSlugAuto(sourceId, slugId) {
        const source = document.getElementById(sourceId);
        const slug = document.getElementById(slugId);
        if (!source || !slug) return;

        slug.dataset.manual = '0';

        slug.addEventListener('input', function() {
            this.dataset.manual = this.value.trim() !== '' ? '1' : '0';
        });

        source.addEventListener('input', function() {
            if (slug.dataset.manual === '1') return;
            slug.value = slugifyText(source.value);
        });
    }

    bindSlugAuto('service_title', 'service_slug');

    // Protocol Repeater
    let protocolIndex = {{ count($service->protocol_json ?? [1]) }};
    const protocolContainer = document.getElementById('protocol-container');
    const addProtocolBtn = document.getElementById('add-protocol');

    addProtocolBtn.addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.className = 'protocol-item border p-12 radius-8 mb-12';
        newItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-8">
                <span class="badge bg-primary-focus text-primary-main">Step ${protocolIndex + 1}</span>
                <button type="button" class="btn btn-sm btn-outline-danger remove-item">Remove</button>
            </div>
            <input type="text" name="protocol[${protocolIndex}][title]" class="form-control mb-8" placeholder="Step Title">
            <textarea name="protocol[${protocolIndex}][desc]" class="form-control" rows="2" placeholder="Description..."></textarea>
        `;
        protocolContainer.appendChild(newItem);
        protocolIndex++;
    });

    protocolContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item')) {
            e.target.closest('.protocol-item').remove();
            reorderSteps();
        }
    });

    function reorderSteps() {
        const items = protocolContainer.querySelectorAll('.protocol-item');
        items.forEach((item, index) => {
            item.querySelector('.badge').textContent = `Step ${index + 1}`;
            item.querySelector('input').name = `protocol[${index}][title]`;
            item.querySelector('textarea').name = `protocol[${index}][desc]`;
        });
        protocolIndex = items.length;
    }

    // Expectations Repeater
    const expectContainer = document.getElementById('expect-container');
    const addExpectBtn = document.getElementById('add-expect');

    addExpectBtn.addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.className = 'expect-item d-flex gap-8 mb-8';
        newItem.innerHTML = `
            <input type="text" name="expectations[]" class="form-control" placeholder="Point...">
            <button type="button" class="btn btn-outline-danger remove-expect">
                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
            </button>
        `;
        expectContainer.appendChild(newItem);
    });

    expectContainer.addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-expect');
        if (btn) {
            btn.closest('.expect-item').remove();
        }
    });

    // Hero Pills Repeater
    const pillsContainer = document.getElementById('pills-container');
    const addPillBtn = document.getElementById('add-pill');

    addPillBtn.addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.className = 'pill-item d-flex gap-8 mb-8';
        newItem.innerHTML = `
            <input type="text" name="hero_pills[]" class="form-control" placeholder="Tag">
            <button type="button" class="btn btn-outline-danger remove-pill">
                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
            </button>
        `;
        pillsContainer.appendChild(newItem);
    });

    pillsContainer.addEventListener('click', function(e) {
        const btn = e.target.closest('.remove-pill');
        if (btn) {
            btn.closest('.pill-item').remove();
        }
    });
});
</script>
@endsection
