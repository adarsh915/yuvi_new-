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
<style>
.svc-field-label{font-size:11.5px;font-weight:600;text-transform:uppercase;letter-spacing:.05em;color:#6c757d;margin-bottom:8px;margin-top:4px;display:block;}
.svc-field-label .req{color:#dc3545;margin-left:2px;}
.svc-panel{background:#fff;border:1px solid #e9ecef;border-radius:14px;overflow:hidden;margin-bottom:20px;}
.svc-panel-header{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1px solid #f0f2f5;background:#fafbfc;}
.svc-panel-header .ph-icon{width:32px;height:32px;border-radius:8px;background:#e8f1ff;color:#185fa5;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;}
.svc-panel-header h6{font-size:13.5px;font-weight:600;color:#1a1a2e;margin:0;}
.svc-panel-body{padding:20px;}
.toggle-row{display:flex;align-items:center;justify-content:space-between;padding:11px 14px;background:#f8f9fb;border:1px solid #e9ecef;border-radius:10px;cursor:pointer;transition:all .15s;margin:0;}
.toggle-row:hover{background:#fff;border-color:#dee2e6;}
.toggle-row .tr-label{font-size:13px;font-weight:600;color:#1a1a2e;display:block;}
.toggle-row .tr-sub{font-size:11px;color:#868e96;display:block;margin-top:1px;}
.toggle-row .form-check{padding:0;margin:0;}
.toggle-row .form-check-input{width:40px!important;height:22px!important;cursor:pointer;margin:0!important;flex-shrink:0;}
.img-thumb-wrap{position:relative;border-radius:10px;overflow:hidden;border:1px solid #e9ecef;margin-top:8px;}
.img-thumb-wrap img{width:100%;height:110px;object-fit:cover;display:block;}
.img-thumb-wrap .img-change-overlay{position:absolute;inset:0;background:rgba(0,0,0,.45);display:none;align-items:center;justify-content:center;}
.img-thumb-wrap:hover .img-change-overlay{display:flex;}
.img-change-btn{background:rgba(255,255,255,.9);border:none;border-radius:8px;padding:6px 14px;font-size:12px;font-weight:600;cursor:pointer;display:flex;align-items:center;gap:5px;}
.new-img-badge{display:none;margin-top:6px;}
.protocol-item{background:#f8f9fb;border:1px solid #e9ecef;border-radius:10px;padding:14px;margin-bottom:12px;}
.btn-remove-sm{width:34px;height:34px;flex-shrink:0;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;border:1px solid #dee2e6;background:#f8f9fb;color:#6c757d;cursor:pointer;}
.btn-remove-sm:hover{background:#fcebeb;border-color:#f09595;color:#A32D2D;}
.stat-row{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:8px;}
.note-editor.note-frame{border-radius:8px!important;border:1px solid #dee2e6!important;overflow:hidden;}
.note-toolbar{background:#f8f9fb!important;border-bottom:1px solid #e9ecef!important;}
.status-pill{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:20px;font-size:11.5px;font-weight:600;}
.status-pill.published{background:#d4edda;color:#155724;}
.status-pill.draft{background:#fff3cd;color:#856404;}
.status-pill .dot{width:6px;height:6px;border-radius:50%;background:currentColor;display:inline-block;}
</style>
<div class="d-flex align-items-center justify-content-between mb-24">
  <div>
    <h5 style="font-size: 20px; font-weight: 700; color: #1a1a2e; margin: 0;">Edit Clinical Service</h5>
    <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Update information, protocols, and clinical expectations for your patients.</p>
  </div>
  <div class="d-flex align-items-center gap-3">
    <span class="status-pill {{ $service->is_active ? 'published' : 'draft' }}">
        <span class="dot"></span>{{ $service->is_active ? 'Public' : 'Hidden' }}
    </span>
    <a href="{{ route('admin.services') }}" class="btn btn-sm btn-outline-secondary radius-12 d-flex align-items-center gap-2" style="padding: 8px 16px;">
        <iconify-icon icon="solar:arrow-left-outline" style="font-size: 18px;"></iconify-icon> 
        <span>Back to Services</span>
    </a>
  </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mb-24 radius-12" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="solar:danger-circle-outline" style="font-size: 20px;"></iconify-icon>
            <strong>Validation Error</strong>
        </div>
        <ul class="mb-0 mt-8 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        {{-- Left Column: Core Content --}}
        <div class="col-lg-8">
            {{-- Panel: Basic Information --}}
            <div class="svc-panel">
                <div class="svc-panel-header">
                    <div class="ph-icon"><iconify-icon icon="solar:document-text-outline"></iconify-icon></div>
                    <h6>Core Information</h6>
                </div>
                <div class="svc-panel-body">
                    <div class="row gy-28">
                        <div class="col-12">
                            <label class="svc-field-label">Service Title <span class="req">*</span></label>
                            <input type="text" id="service_title" name="title" class="form-control radius-10" value="{{ old('title', $service->title) }}" placeholder="e.g., In-Vitro Fertilization (IVF)" required>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Slug / URL Path</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 radius-start-10" style="font-size: 12px; color: #94a3b8;">/services/</span>
                                <input type="text" id="service_slug" name="slug" class="form-control radius-end-10 border-start-0 ps-0" value="{{ old('slug', $service->slug) }}" placeholder="url-friendly-slug">
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Short Excerpt <span class="req">*</span></label>
                            <textarea name="short_description" rows="2" class="form-control radius-10" placeholder="A brief summary for listing cards..." required>{{ old('short_description', $service->short_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel: Approach & Safety --}}
            <div class="svc-panel">
                <div class="svc-panel-header" style="background: #fff;">
                    <div class="ph-icon" style="background: #f0fdf4; color: #166534;"><iconify-icon icon="solar:medal-star-outline"></iconify-icon></div>
                    <h6>Clinical Philosophy & Safety</h6>
                </div>
                <div class="svc-panel-body">
                    <div class="row gy-24">
                        <div class="col-12">
                            <label class="svc-field-label">The Clinical Approach <span class="req">*</span></label>
                            <textarea name="approach_text" id="approach_text">{{ old('approach_text', $service->approach_text) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Safety & Ethics Standards <span class="req">*</span></label>
                            <textarea name="safety_text" id="safety_text">{{ old('safety_text', $service->safety_text) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel: Protocol --}}
            <div class="svc-panel">
                <div class="svc-panel-header" style="background: #fff; justify-content: space-between;">
                    <div class="d-flex align-items-center gap-10">
                        <div class="ph-icon" style="background: #fef2f2; color: #991b1b;"><iconify-icon icon="solar:checklist-minimalistic-outline"></iconify-icon></div>
                        <h6>Typical Protocol Steps</h6>
                    </div>
                    <button type="button" id="add-protocol" class="btn btn-sm btn-outline-primary radius-8">
                        <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Step
                    </button>
                </div>
                <div class="svc-panel-body">
                    <div id="protocol-container">
                        @php $protocols = old('protocol', $service->protocol_json ?? []); @endphp
                        @forelse($protocols as $index => $step)
                            <div class="protocol-item">
                                <div class="d-flex justify-content-between align-items-center mb-12">
                                    <span class="badge" style="background: #e0f2fe; color: #0369a1; padding: 6px 12px; border-radius: 6px;">Step {{ $index + 1 }}</span>
                                    <button type="button" class="btn-remove-sm remove-item" {{ $index == 0 ? 'style=display:none;' : '' }}><iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon></button>
                                </div>
                                <input type="text" name="protocol[{{ $index }}][title]" class="form-control mb-10 radius-8" value="{{ $step['title'] ?? '' }}" placeholder="Step Title (e.g., Initial Stimulation)">
                                <textarea name="protocol[{{ $index }}][desc]" class="form-control radius-8" rows="2" placeholder="Describe the clinical process...">{{ $step['desc'] ?? '' }}</textarea>
                            </div>
                        @empty
                            <div class="protocol-item">
                                <div class="d-flex justify-content-between align-items-center mb-12">
                                    <span class="badge" style="background: #e0f2fe; color: #0369a1; padding: 6px 12px; border-radius: 6px;">Step 1</span>
                                    <button type="button" class="btn-remove-sm remove-item" style="display:none;"><iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon></button>
                                </div>
                                <input type="text" name="protocol[0][title]" class="form-control mb-10 radius-8" placeholder="Step Title">
                                <textarea name="protocol[0][desc]" class="form-control radius-8" rows="2" placeholder="Description..."></textarea>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Panel: Expectations --}}
            <div class="svc-panel">
                <div class="svc-panel-header" style="background: #fff; justify-content: space-between;">
                    <div class="d-flex align-items-center gap-10">
                        <div class="ph-icon" style="background: #fffbeb; color: #92400e;"><iconify-icon icon="solar:star-outline"></iconify-icon></div>
                        <h6>What to Expect</h6>
                    </div>
                    <button type="button" id="add-expect" class="btn btn-sm btn-outline-primary radius-8">
                        <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Point
                    </button>
                </div>
                <div class="svc-panel-body">
                    <div id="expect-container">
                        @php $expectations = old('expectations', $service->expect_json ?? []); @endphp
                        @forelse($expectations as $index => $item)
                            <div class="expect-item d-flex gap-8 mb-10">
                                <input type="text" name="expectations[]" class="form-control radius-8" value="{{ $item }}" placeholder="e.g., Painless procedure, Same-day discharge...">
                                <button type="button" class="btn-remove-sm remove-expect" {{ $index == 0 ? 'style=display:none;' : '' }}><iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon></button>
                            </div>
                        @empty
                            <div class="expect-item d-flex gap-8 mb-10">
                                <input type="text" name="expectations[]" class="form-control radius-8" placeholder="Point...">
                                <button type="button" class="btn-remove-sm remove-expect" style="display:none;"><iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon></button>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Side Settings --}}
        <div class="col-lg-4">
            {{-- Panel: Visibility & Category --}}
            <div class="svc-panel">
                <div class="svc-panel-header">
                    <div class="ph-icon" style="background: #f8fafc; color: #475569;"><iconify-icon icon="solar:settings-outline"></iconify-icon></div>
                    <h6>Settings</h6>
                </div>
                <div class="svc-panel-body">
                    <div class="row gy-28">
                        <div class="col-12">
                            <label class="svc-field-label">Status</label>
                            <label class="toggle-row" for="is_active">
                                <div>
                                    <span class="tr-label">Service Active</span>
                                    <span class="tr-sub">Visible on website</span>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                </div>
                            </label>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Clinical Category <span class="req">*</span></label>
                            <select name="service_category_id" class="form-select radius-10" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('service_category_id', $service->service_category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Category Badge Text <span class="req">*</span></label>
                            <input type="text" name="category_tag" class="form-control radius-10" value="{{ old('category_tag', $service->category_tag) }}" placeholder="e.g., FERTILITY" required>
                            <span style="font-size:11px;color:#94a3b8;margin-top:6px;display:block;">Short tag shown on cards (usually caps)</span>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Accent Theme</label>
                            <select name="accent_class" class="form-select radius-10">
                                <option value="ivf" {{ old('accent_class', $service->accent_class) == 'ivf' ? 'selected' : '' }}>IVF (Crimson)</option>
                                <option value="pcos" {{ old('accent_class', $service->accent_class) == 'pcos' ? 'selected' : '' }}>PCOS (Purple)</option>
                                <option value="male" {{ old('accent_class', $service->accent_class) == 'male' ? 'selected' : '' }}>Male (Blue)</option>
                                <option value="obs" {{ old('accent_class', $service->accent_class) == 'obs' ? 'selected' : '' }}>Obstetrics (Green)</option>
                                <option value="pres" {{ old('accent_class', $service->accent_class) == 'pres' ? 'selected' : '' }}>Preservation (Indigo)</option>
                                <option value="surg" {{ old('accent_class', $service->accent_class) == 'surg' ? 'selected' : '' }}>Surgical (Teal)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Display Order</label>
                            <input type="number" name="order" class="form-control radius-10" value="{{ old('order', $service->order) }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel: Quick Stats --}}
            <div class="svc-panel">
                <div class="svc-panel-header">
                    <div class="ph-icon" style="background: #ecfdf5; color: #059669;"><iconify-icon icon="solar:chart-outline"></iconify-icon></div>
                    <h6>Quick Highlights (Stats)</h6>
                </div>
                <div class="svc-panel-body">
                    <div class="row gy-12">
                        <div class="col-6">
                            <label class="svc-field-label text-xs">Stat 1 Value</label>
                            <input type="text" name="stat1_num" class="form-control radius-8" value="{{ old('stat1_num', $service->stat1_num) }}" placeholder="e.g. 15+ Yrs">
                        </div>
                        <div class="col-6">
                            <label class="svc-field-label text-xs">Stat 1 Label</label>
                            <input type="text" name="stat1_label" class="form-control radius-8" value="{{ old('stat1_label', $service->stat1_label) }}" placeholder="e.g. Experience">
                        </div>
                        <div class="col-6">
                            <label class="svc-field-label text-xs">Stat 2 Value</label>
                            <input type="text" name="stat2_num" class="form-control radius-8" value="{{ old('stat2_num', $service->stat2_num) }}" placeholder="e.g. 10k+">
                        </div>
                        <div class="col-6">
                            <label class="svc-field-label text-xs">Stat 2 Label</label>
                            <input type="text" name="stat2_label" class="form-control radius-8" value="{{ old('stat2_label', $service->stat2_label) }}" placeholder="e.g. Procedures">
                        </div>
                        <div class="col-6">
                            <label class="svc-field-label text-xs">Stat 3 Value</label>
                            <input type="text" name="stat3_num" class="form-control radius-8" value="{{ old('stat3_num', $service->stat3_num) }}" placeholder="e.g. 100%">
                        </div>
                        <div class="col-6">
                            <label class="svc-field-label text-xs">Stat 3 Label</label>
                            <input type="text" name="stat3_label" class="form-control radius-8" value="{{ old('stat3_label', $service->stat3_label) }}" placeholder="e.g. Satisfaction">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel: Media --}}
            <div class="svc-panel">
                <div class="svc-panel-header">
                    <div class="ph-icon" style="background: #fff7ed; color: #c2410c;"><iconify-icon icon="solar:gallery-outline"></iconify-icon></div>
                    <h6>Service Media</h6>
                </div>
                <div class="svc-panel-body">
                    <div class="row gy-28">
                        <div class="col-12">
                            <label class="svc-field-label">Thumbnail Image</label>
                            <input type="file" id="listing_file" name="listing_image" accept="image/*" style="display:none;">
                            <div class="img-thumb-wrap" style="height: 110px;">
                                <img id="listing_preview" src="{{ $service->listing_image ? asset('storage/' . $service->listing_image) : 'https://placehold.co/600x400/f8f9fb/adb5bd?text=No+Thumbnail' }}" alt="">
                                <div class="img-change-overlay"><button type="button" class="img-change-btn" onclick="document.getElementById('listing_file').click()"><iconify-icon icon="solar:camera-outline"></iconify-icon> Change</button></div>
                            </div>
                            <div id="listing_badge" class="mt-8 text-success text-xs fw-bold" style="display:none;"><iconify-icon icon="solar:check-circle-outline"></iconify-icon> New selection ready</div>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Hero Banner Image</label>
                            <input type="file" id="hero_file" name="hero_image" accept="image/*" style="display:none;">
                            <div class="img-thumb-wrap" style="height: 110px;">
                                <img id="hero_preview" src="{{ $service->hero_image ? asset('storage/' . $service->hero_image) : 'https://placehold.co/1200x600/f8f9fb/adb5bd?text=No+Hero+Banner' }}" alt="">
                                <div class="img-change-overlay"><button type="button" class="img-change-btn" onclick="document.getElementById('hero_file').click()"><iconify-icon icon="solar:camera-outline"></iconify-icon> Change</button></div>
                            </div>
                            <div id="hero_badge" class="mt-8 text-success text-xs fw-bold" style="display:none;"><iconify-icon icon="solar:check-circle-outline"></iconify-icon> New selection ready</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panel: SEO --}}
            <div class="svc-panel">
                <div class="svc-panel-header">
                    <div class="ph-icon" style="background: #faf5ff; color: #7e22ce;"><iconify-icon icon="solar:globus-outline"></iconify-icon></div>
                    <h6>Search Optimization</h6>
                </div>
                <div class="svc-panel-body">
                    <div class="row gy-20">
                        <div class="col-12">
                            <label class="svc-field-label">Hero Eyebrow</label>
                            <input type="text" name="hero_eyebrow" class="form-control radius-10" value="{{ old('hero_eyebrow', $service->hero_eyebrow) }}" placeholder="e.g., Advanced Protocol">
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Hero Lead Text <span class="req">*</span></label>
                            <textarea name="hero_lead" rows="2" class="form-control radius-10" placeholder="A strong opening headline for the hero section..." required>{{ old('hero_lead', $service->hero_lead) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control radius-10" value="{{ old('meta_title', $service->meta_title) }}" placeholder="SEO Title">
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control radius-10" placeholder="SEO Summary...">{{ old('meta_description', $service->meta_description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="svc-field-label">Hero Pills (Tags)</label>
                            <div id="pills-container">
                                @php $pills = old('hero_pills', $service->hero_pills ?? []); @endphp
                                @forelse($pills as $index => $pill)
                                    <div class="pill-item d-flex gap-8 mb-10">
                                        <input type="text" name="hero_pills[]" class="form-control radius-8" value="{{ $pill }}" placeholder="Tag">
                                        <button type="button" class="btn-remove-sm remove-pill" {{ $index == 0 ? 'style=display:none;' : '' }}><iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon></button>
                                    </div>
                                @empty
                                    <div class="pill-item d-flex gap-8 mb-10">
                                        <input type="text" name="hero_pills[]" class="form-control radius-8" placeholder="Tag">
                                        <button type="button" class="btn-remove-sm remove-pill" style="display:none;"><iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon></button>
                                    </div>
                                @endforelse
                            </div>
                            <button type="button" id="add-pill" class="btn btn-sm btn-outline-primary mt-4 radius-8">
                                <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Pill
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-40">
                <button type="submit" class="btn btn-primary w-100 radius-12 d-flex align-items-center justify-content-center gap-2" style="padding: 14px; font-weight: 700; box-shadow: 0 10px 20px rgba(79, 132, 174, 0.2);">
                    <iconify-icon icon="solar:check-read-outline" style="font-size: 20px;"></iconify-icon>
                    <span>Save Service Changes</span>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image change preview
    function bindImgChange(fileId, previewId, badgeId) {
        const f = document.getElementById(fileId);
        if(!f) return;
        f.addEventListener('change', function(){
            const file = this.files[0]; if(!file) return;
            const r = new FileReader();
            r.onload = e => {
                const p = document.getElementById(previewId);
                if(p){ p.src = e.target.result; p.style.display='block'; }
                const b = document.getElementById(badgeId);
                if(b) b.style.display='inline-flex';
            };
            r.readAsDataURL(file);
        });
    }
    bindImgChange('listing_file','listing_preview','listing_badge');
    bindImgChange('hero_file','hero_preview','hero_badge');
    // Slug: manual mode in edit
    const slugEl = document.getElementById('service_slug');
    if(slugEl) slugEl.dataset.manual = '1';
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
    let protocolIndex = {{ !empty($protocols) ? count($protocols) : 1 }};
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
