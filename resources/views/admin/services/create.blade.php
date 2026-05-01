@extends('layout.layout')

@php
    $title = 'Add New Service';
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
        <h6 class="text-lg fw-semibold mb-0">Create Service Pathway</h6>
        <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary btn-sm radius-8">
            <iconify-icon icon="solar:arrow-left-outline" class="me-1"></iconify-icon> Back to List
        </a>
    </div>
    <div class="card-body p-24">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row gy-20">
                {{-- Left Column: Main Content --}}
                <div class="col-md-8">
                    <div class="row gy-20">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Service Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control radius-8" placeholder="e.g. IVF & Assisted Reproduction" required>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Short Description (Listing Page) <span class="text-danger">*</span></label>
                            <textarea name="short_description" rows="2" class="form-control radius-8" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">The Approach Content <span class="text-danger">*</span></label>
                            <textarea name="approach_text" id="approach_text" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-sm mb-8">Safety & Ethics Content <span class="text-danger">*</span></label>
                            <textarea name="safety_text" id="safety_text" required></textarea>
                        </div>

                        <hr class="my-20">
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm mb-8">Protocol Steps (Typical Protocol)</label>
                            <div id="protocol-container">
                                <div class="protocol-item border p-12 radius-8 mb-12">
                                    <div class="d-flex justify-content-between align-items-center mb-8">
                                        <span class="badge bg-primary-focus text-primary-main">Step 1</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-item" style="display:none;">Remove</button>
                                    </div>
                                    <input type="text" name="protocol[0][title]" class="form-control mb-8" placeholder="Step Title">
                                    <textarea name="protocol[0][desc]" class="form-control" rows="2" placeholder="Description..."></textarea>
                                </div>
                            </div>
                            <button type="button" id="add-protocol" class="btn btn-sm btn-outline-primary mt-4">
                                <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Another Step
                            </button>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-sm mb-8">Expectations List (What to Expect)</label>
                            <div id="expect-container">
                                <div class="expect-item d-flex gap-8 mb-8">
                                    <input type="text" name="expectations[]" class="form-control" placeholder="Point...">
                                    <button type="button" class="btn btn-outline-danger remove-expect" style="display:none;">
                                        <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                    </button>
                                </div>
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
                                <input type="text" name="category_tag" class="form-control radius-8" placeholder="e.g. IVF & ART" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Accent Style</label>
                                <select name="accent_class" class="form-control radius-8">
                                    <option value="ivf">IVF (Crimson)</option>
                                    <option value="pcos">PCOS (Purple)</option>
                                    <option value="male">Male (Blue)</option>
                                    <option value="obs">Obstetrics (Green)</option>
                                    <option value="pres">Preservation (Indigo)</option>
                                    <option value="surg">Surgical (Teal)</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Listing Image <span class="text-danger">*</span></label>
                                <input type="file" name="listing_image" class="form-control radius-8" accept="image/*" required>
                            </div>

                            <hr>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Eyebrow</label>
                                <input type="text" name="hero_eyebrow" class="form-control radius-8" value="Advanced Protocol">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Lead Text <span class="text-danger">*</span></label>
                                <textarea name="hero_lead" rows="2" class="form-control radius-8" required></textarea>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Image <span class="text-danger">*</span></label>
                                <input type="file" name="hero_image" class="form-control radius-8" accept="image/*" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Hero Pills (Tags)</label>
                                <div id="pills-container">
                                    <div class="pill-item d-flex gap-8 mb-8">
                                        <input type="text" name="hero_pills[]" class="form-control" placeholder="Tag">
                                        <button type="button" class="btn btn-outline-danger remove-pill" style="display:none;">
                                            <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                        </button>
                                    </div>
                                </div>
                                <button type="button" id="add-pill" class="btn btn-sm btn-outline-primary mt-4">
                                    <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Pill
                                </button>
                            </div>

                            <hr>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Quick Stats</label>
                                <div class="input-group mb-8">
                                    <input type="text" name="stat1_num" class="form-control" placeholder="68%">
                                    <input type="text" name="stat1_label" class="form-control" placeholder="Rate">
                                </div>
                                <div class="input-group mb-8">
                                    <input type="text" name="stat2_num" class="form-control" placeholder="3200+">
                                    <input type="text" name="stat2_label" class="form-control" placeholder="Cycles">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-sm mb-8">Display Order</label>
                                <input type="number" name="order" class="form-control radius-8" value="0">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch d-flex align-items-center gap-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked value="1">
                                    <label class="form-check-label fw-semibold" for="is_active">Service Active</label>
                                </div>
                            </div>

                            <div class="col-12 mt-20">
                                <button type="submit" class="btn btn-primary w-100 radius-8">Create Service</button>
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
    // Protocol Repeater
    let protocolIndex = 1;
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
