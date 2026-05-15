@extends('layout.layout')

@php
    $title = 'Add New Service';
    $subTitle = 'Service Management';
    $script = '
        <script>
            $(document).ready(function() {
                $("#approach_text").summernote({ height: 280, placeholder: "Describe the approach and methodology..." });
                $("#safety_text").summernote({ height: 280, placeholder: "Describe safety protocols and ethics..." });
            });
        </script>
    ';
@endphp

<style>
    .svc-wrap { display: grid; grid-template-columns: 1fr 340px; gap: 24px; align-items: start; }
    @media(max-width:991px){ .svc-wrap { grid-template-columns: 1fr; } }

    .panel-card { background:#fff; border:1px solid #e9ecef; border-radius:14px; overflow:hidden; margin-bottom:20px; }
    .panel-card:last-child { margin-bottom:0; }
    .panel-card__header { display:flex; align-items:center; gap:10px; padding:14px 20px; border-bottom:1px solid #f0f2f5; background:#fafbfc; }
    .panel-card__header .ph-icon { width:32px; height:32px; border-radius:8px; background:#e8f1ff; color:#185fa5; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
    .panel-card__header h6 { font-size:13.5px; font-weight:600; color:#1a1a2e; margin:0; }
    .panel-card__body { padding:20px; }

    .field-group { margin-bottom:18px; }
    .field-group:last-child { margin-bottom:0; }
    .field-label { font-size:11.5px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:#6c757d; margin-bottom:6px; display:block; }
    .field-label .req { color:#dc3545; margin-left:2px; }
    .form-control, .form-select { font-size:13.5px; padding:9px 13px; border:1px solid #dee2e6; border-radius:8px; background:#f8f9fb; color:#1a1a2e; transition:border-color .15s,box-shadow .15s; width:100%; }
    .form-control:focus, .form-select:focus { border-color:#86b7fe; box-shadow:0 0 0 3px rgba(13,110,253,.1); background:#fff; outline:none; }
    textarea.form-control { resize:vertical; min-height:80px; }
    .field-hint { font-size:11px; color:#adb5bd; margin-top:4px; display:block; }

    /* Repeater items */
    .protocol-item { background:#f8f9fb; border:1px solid #e9ecef; border-radius:10px; padding:14px; margin-bottom:12px; }
    .protocol-item .step-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .expect-item, .pill-item { display:flex; gap:8px; margin-bottom:8px; align-items:center; }
    .expect-item .form-control, .pill-item .form-control { flex:1; }
    .btn-remove-sm { width:34px; height:34px; flex-shrink:0; border-radius:8px; display:inline-flex; align-items:center; justify-content:center; border:1px solid #dee2e6; background:#f8f9fb; color:#6c757d; cursor:pointer; transition:all .15s; }
    .btn-remove-sm:hover { background:#fcebeb; border-color:#f09595; color:#A32D2D; }
    .btn-add-more { font-size:12px; font-weight:600; padding:6px 12px; border-radius:8px; display:inline-flex; align-items:center; gap:6px; margin-top:4px; }

    /* Image upload drop zone */
    .img-drop-zone { border:2px dashed #dee2e6; border-radius:10px; padding:18px 14px; text-align:center; cursor:pointer; background:#f8f9fb; transition:all .2s; }
    .img-drop-zone:hover { border-color:#86b7fe; background:#f0f7ff; }
    .img-drop-zone iconify-icon { font-size:28px; color:#adb5bd; display:block; margin-bottom:6px; }
    .img-drop-zone .dz-label { font-size:12.5px; color:#6c757d; font-weight:500; }
    .img-drop-zone .dz-sub { font-size:11px; color:#adb5bd; margin-top:3px; }
    .img-preview { width:100%; height:110px; object-fit:cover; border-radius:8px; display:none; margin-top:8px; }

    /* Toggle row */
    .toggle-row { display:flex; align-items:center; justify-content:space-between; padding:11px 14px; background:#f8f9fb; border:1px solid #e9ecef; border-radius:10px; cursor:pointer; transition:all .15s; margin:0; }
    .toggle-row:hover { background:#fff; border-color:#dee2e6; }
    .toggle-row .tr-label { font-size:13px; font-weight:600; color:#1a1a2e; display:block; }
    .toggle-row .tr-sub { font-size:11px; color:#868e96; display:block; margin-top:1px; }
    .toggle-row .form-check { padding:0; margin:0; }
    .toggle-row .form-check-input { width:40px !important; height:22px !important; cursor:pointer; margin:0 !important; flex-shrink:0; }

    /* Stats row */
    .stat-row { display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:8px; }
    .stat-row input { font-size:13px; }

    /* Section divider */
    .section-div { display:flex; align-items:center; gap:10px; margin:20px 0 16px; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#adb5bd; }
    .section-div::before,.section-div::after { content:''; flex:1; height:1px; background:#e9ecef; }

    /* Submit */
    .btn-submit { width:100%; padding:11px; font-size:13.5px; font-weight:600; border-radius:10px; display:flex; align-items:center; justify-content:center; gap:8px; border:none; transition:opacity .15s; }
    .btn-submit:hover { opacity:.88; }

    /* Page topbar */
    .page-topbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; }
    .page-topbar .pt-title { font-size:18px; font-weight:700; color:#1a1a2e; margin:0; }
    .page-topbar .pt-sub { font-size:12px; color:#adb5bd; margin-top:2px; }

    /* Summernote */
    .note-editor.note-frame { border-radius:8px !important; border:1px solid #dee2e6 !important; overflow:hidden; }
    .note-toolbar { background:#f8f9fb !important; border-bottom:1px solid #e9ecef !important; }

    /* Slug prefix */
    .slug-wrap { position:relative; }
    .slug-prefix { position:absolute; left:12px; top:50%; transform:translateY(-50%); font-size:12px; color:#adb5bd; pointer-events:none; }

    .invalid-feedback { display:block; font-size:11px; color:#dc3545; margin-top:4px; font-weight:500; }
    .form-control.is-invalid, .form-select.is-invalid { border-color:#dc3545 !important; background-image:none !important; }
</style>

@section('content')

<div class="page-topbar">
    <div>
        <h5 class="pt-title">Create Service Pathway</h5>
        <p class="pt-sub">Fill in all details to publish a new service page</p>
    </div>
    <a href="{{ route('admin.services') }}" class="btn btn-sm btn-outline-secondary radius-8 d-flex align-items-center gap-2">
        <iconify-icon icon="solar:arrow-left-outline"></iconify-icon> Back to List
    </a>
</div>



<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="svc-wrap">

        {{-- ═══ LEFT: Main Content ═══ --}}
        <div>
            {{-- Basic Info --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon"><iconify-icon icon="solar:stethoscope-outline"></iconify-icon></div>
                    <h6>Service Information</h6>
                </div>
                <div class="panel-card__body">
                    <div class="field-group">
                        <label class="field-label">Service Title <span class="req">*</span></label>
                        <input type="text" id="service_title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. IVF & Assisted Reproduction" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">URL Slug</label>
                        <div class="slug-wrap">
                            <span class="slug-prefix">/services/</span>
                            <input type="text" id="service_slug" name="slug" class="form-control" placeholder="auto-generated-from-title" value="{{ old('slug') }}" style="padding-left:72px;">
                        </div>
                        <span class="field-hint">Leave blank to auto-generate from title</span>
                    </div>
                </div>
            </div>

            {{-- Rich Content --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon"><iconify-icon icon="solar:document-text-outline"></iconify-icon></div>
                    <h6>Detailed Content</h6>
                </div>
                <div class="panel-card__body">
                    <div class="field-group">
                        <label class="field-label">The Approach Content <span class="req">*</span></label>
                        <textarea name="approach_text" id="approach_text" class="@error('approach_text') is-invalid @enderror" required>{{ old('approach_text') }}</textarea>
                        @error('approach_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group" style="margin-top:24px;">
                        <label class="field-label">Safety & Ethics Content <span class="req">*</span></label>
                        <textarea name="safety_text" id="safety_text" class="@error('safety_text') is-invalid @enderror" required>{{ old('safety_text') }}</textarea>
                        @error('safety_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Repeaters --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon" style="background:#f3e8ff;color:#7c3aed;"><iconify-icon icon="solar:list-check-outline"></iconify-icon></div>
                    <h6>Protocol & Expectations</h6>
                </div>
                <div class="panel-card__body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
                        {{-- Protocol --}}
                        <div>
                            <label class="field-label" style="margin-bottom:12px;">Protocol Steps</label>
                            <div id="protocol-container">
                                @if(old('protocol'))
                                    @foreach(old('protocol') as $index => $step)
                                        <div class="protocol-item">
                                            <div class="step-header">
                                                <span class="badge bg-primary-focus text-primary-main">Step {{ $index + 1 }}</span>
                                                <button type="button" class="btn btn-sm btn-outline-danger remove-item" {{ $index == 0 ? 'style=display:none;' : '' }}>Remove</button>
                                            </div>
                                            <input type="text" name="protocol[{{ $index }}][title]" class="form-control" style="margin-bottom:8px;" placeholder="Step Title" value="{{ $step['title'] ?? '' }}">
                                            <textarea name="protocol[{{ $index }}][desc]" class="form-control" rows="2" placeholder="Description…">{{ $step['desc'] ?? '' }}</textarea>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="protocol-item">
                                        <div class="step-header">
                                            <span class="badge bg-primary-focus text-primary-main">Step 1</span>
                                            <button type="button" class="btn btn-sm btn-outline-danger remove-item" style="display:none;">Remove</button>
                                        </div>
                                        <input type="text" name="protocol[0][title]" class="form-control" style="margin-bottom:8px;" placeholder="Step Title">
                                        <textarea name="protocol[0][desc]" class="form-control" rows="2" placeholder="Description…"></textarea>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-protocol" class="btn btn-sm btn-outline-primary btn-add-more">
                                <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Step
                            </button>
                        </div>

                        {{-- Expectations --}}
                        <div>
                            <label class="field-label" style="margin-bottom:12px;">Expectations (What to Expect)</label>
                            <div id="expect-container">
                                @if(old('expectations'))
                                    @foreach(old('expectations') as $index => $item)
                                        <div class="expect-item">
                                            <input type="text" name="expectations[]" class="form-control" value="{{ $item }}" placeholder="Point…">
                                            <button type="button" class="btn-remove-sm remove-expect" {{ $index == 0 ? 'style=display:none;' : '' }}>
                                                <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                            </button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="expect-item">
                                        <input type="text" name="expectations[]" class="form-control" placeholder="Point…">
                                        <button type="button" class="btn-remove-sm remove-expect" style="display:none;">
                                            <iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-expect" class="btn btn-sm btn-outline-primary btn-add-more">
                                <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Point
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ RIGHT: Sidebar ═══ --}}
        <div>
            {{-- Publish Settings --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon"><iconify-icon icon="solar:settings-outline"></iconify-icon></div>
                    <h6>Publish Settings</h6>
                </div>
                <div class="panel-card__body">
                    <div class="field-group">
                        <label class="field-label" for="service_category_id">Clinical Category <span class="req">*</span></label>
                        <select name="service_category_id" id="service_category_id" class="form-select @error('service_category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('service_category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Category Badge Text <span class="req">*</span></label>
                        <input type="text" name="category_tag" class="form-control @error('category_tag') is-invalid @enderror" placeholder="e.g. IVF & ART" value="{{ old('category_tag') }}" required>
                        @error('category_tag')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <span class="field-hint">Visual tag shown on service card</span>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Accent Style</label>
                        <select name="accent_class" class="form-select">
                            <option value="ivf" {{ old('accent_class')=='ivf'?'selected':'' }}>IVF (Crimson)</option>
                            <option value="pcos" {{ old('accent_class')=='pcos'?'selected':'' }}>PCOS (Purple)</option>
                            <option value="male" {{ old('accent_class')=='male'?'selected':'' }}>Male (Blue)</option>
                            <option value="obs" {{ old('accent_class')=='obs'?'selected':'' }}>Obstetrics (Green)</option>
                            <option value="pres" {{ old('accent_class')=='pres'?'selected':'' }}>Preservation (Indigo)</option>
                            <option value="surg" {{ old('accent_class')=='surg'?'selected':'' }}>Surgical (Teal)</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Listing Image <span class="req">*</span></label>
                        <input type="file" id="listing_image_file" name="listing_image" accept="image/*" style="display:none;" required>
                        <div class="img-drop-zone @error('listing_image') border-danger @enderror" onclick="document.getElementById('listing_image_file').click()">
                            <iconify-icon icon="solar:gallery-add-outline"></iconify-icon>
                            <div class="dz-label">Click to upload listing image</div>
                            <div class="dz-sub">PNG, JPG, WEBP · max 5 MB</div>
                        </div>
                        @error('listing_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="listing_preview" class="img-preview" src="" alt="">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', '') }}" placeholder="Leave empty for auto">
                    </div>
                    <div class="field-group">
                        <label class="toggle-row" for="is_active">
                            <div>
                                <span class="tr-label">Service Active</span>
                                <span class="tr-sub">Show this service on the website</span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Hero Section --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon" style="background:#fff3e0;color:#e65100;"><iconify-icon icon="solar:star-outline"></iconify-icon></div>
                    <h6>Hero Section</h6>
                </div>
                <div class="panel-card__body">
                    <div class="field-group">
                        <label class="field-label">Hero Eyebrow</label>
                        <input type="text" name="hero_eyebrow" class="form-control" value="{{ old('hero_eyebrow', 'Advanced Protocol') }}" placeholder="e.g. Advanced Protocol">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Hero Lead Text <span class="req">*</span></label>
                        <textarea name="hero_lead" rows="2" class="form-control @error('hero_lead') is-invalid @enderror" required placeholder="Short headline for the hero section…">{{ old('hero_lead') }}</textarea>
                        @error('hero_lead')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Hero Image <span class="req">*</span></label>
                        <input type="file" id="hero_image_file" name="hero_image" accept="image/*" style="display:none;" required>
                        <div class="img-drop-zone @error('hero_image') border-danger @enderror" onclick="document.getElementById('hero_image_file').click()">
                            <iconify-icon icon="solar:gallery-add-outline"></iconify-icon>
                            <div class="dz-label">Click to upload hero image</div>
                            <div class="dz-sub">PNG, JPG, WEBP · max 5 MB</div>
                        </div>
                        @error('hero_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <img id="hero_preview" class="img-preview" src="" alt="">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Hero Pills (Tags)</label>
                        <div id="pills-container">
                            @if(old('hero_pills'))
                                @foreach(old('hero_pills') as $index => $pill)
                                    <div class="pill-item">
                                        <input type="text" name="hero_pills[]" class="form-control" value="{{ $pill }}" placeholder="Tag">
                                        <button type="button" class="btn-remove-sm remove-pill" {{ $index == 0 ? 'style=display:none;' : '' }}>
                                            <iconify-icon icon="solar:close-outline"></iconify-icon>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="pill-item">
                                    <input type="text" name="hero_pills[]" class="form-control" placeholder="Tag">
                                    <button type="button" class="btn-remove-sm remove-pill" style="display:none;">
                                        <iconify-icon icon="solar:close-outline"></iconify-icon>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <button type="button" id="add-pill" class="btn btn-sm btn-outline-primary btn-add-more">
                            <iconify-icon icon="solar:add-circle-outline"></iconify-icon> Add Tag
                        </button>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Quick Stats</label>
                        <div class="stat-row">
                            <input type="text" name="stat1_num" class="form-control" placeholder="68%" value="{{ old('stat1_num') }}">
                            <input type="text" name="stat1_label" class="form-control" placeholder="Label" value="{{ old('stat1_label') }}">
                        </div>
                        <div class="stat-row">
                            <input type="text" name="stat2_num" class="form-control" placeholder="3200+" value="{{ old('stat2_num') }}">
                            <input type="text" name="stat2_label" class="form-control" placeholder="Label" value="{{ old('stat2_label') }}">
                        </div>
                        <div class="stat-row">
                            <input type="text" name="stat3_num" class="form-control" placeholder="100%" value="{{ old('stat3_num') }}">
                            <input type="text" name="stat3_label" class="form-control" placeholder="Label" value="{{ old('stat3_label') }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <div class="panel-card">
                <div class="panel-card__header">
                    <div class="ph-icon" style="background:#e8f5e9;color:#2e7d32;"><iconify-icon icon="solar:chart-2-outline"></iconify-icon></div>
                    <h6>SEO Settings</h6>
                </div>
                <div class="panel-card__body">
                    <div class="field-group">
                        <label class="field-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" placeholder="SEO title (60 chars max)" value="{{ old('meta_title') }}" maxlength="60">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" placeholder="ivf, fertility, treatment" value="{{ old('meta_keywords') }}">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control" placeholder="SEO description (155 chars max)" maxlength="155">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-submit">
                <iconify-icon icon="solar:check-read-outline"></iconify-icon> Create Service
            </button>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Slug
    function slugify(v){ return String(v).toLowerCase().trim().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-'); }
    const slugEl = document.getElementById('service_slug');
    slugEl.dataset.manual = '0';
    slugEl.addEventListener('input', function(){ this.dataset.manual = this.value.trim() !== '' ? '1' : '0'; });
    document.getElementById('service_title').addEventListener('input', function(){ if(slugEl.dataset.manual==='1') return; slugEl.value=slugify(this.value); });

    // Image previews
    function bindImgPreview(inputId, previewId) {
        document.getElementById(inputId).addEventListener('change', function(){
            const f=this.files[0]; if(!f) return;
            const r=new FileReader(); r.onload=e=>{ const p=document.getElementById(previewId); p.src=e.target.result; p.style.display='block'; }; r.readAsDataURL(f);
        });
    }
    bindImgPreview('listing_image_file','listing_preview');
    bindImgPreview('hero_image_file','hero_preview');

    // Protocol repeater
    let protocolIndex = {{ old('protocol') ? count(old('protocol')) : 1 }};
    document.getElementById('add-protocol').addEventListener('click', function(){
        const d=document.createElement('div'); d.className='protocol-item';
        d.innerHTML=`<div class="step-header"><span class="badge bg-primary-focus text-primary-main">Step ${protocolIndex+1}</span><button type="button" class="btn btn-sm btn-outline-danger remove-item">Remove</button></div><input type="text" name="protocol[${protocolIndex}][title]" class="form-control" style="margin-bottom:8px;" placeholder="Step Title"><textarea name="protocol[${protocolIndex}][desc]" class="form-control" rows="2" placeholder="Description…"></textarea>`;
        document.getElementById('protocol-container').appendChild(d); protocolIndex++;
    });
    document.getElementById('protocol-container').addEventListener('click', function(e){
        if(e.target.classList.contains('remove-item')){ e.target.closest('.protocol-item').remove(); reorderSteps(); }
    });
    function reorderSteps(){ const items=document.querySelectorAll('.protocol-item'); items.forEach((el,i)=>{ el.querySelector('.badge').textContent=`Step ${i+1}`; el.querySelector('input').name=`protocol[${i}][title]`; el.querySelector('textarea').name=`protocol[${i}][desc]`; }); protocolIndex=items.length; }

    // Expectations
    document.getElementById('add-expect').addEventListener('click', function(){
        const d=document.createElement('div'); d.className='expect-item';
        d.innerHTML=`<input type="text" name="expectations[]" class="form-control" placeholder="Point…"><button type="button" class="btn-remove-sm remove-expect"><iconify-icon icon="solar:trash-bin-trash-outline"></iconify-icon></button>`;
        document.getElementById('expect-container').appendChild(d);
    });
    document.getElementById('expect-container').addEventListener('click', function(e){ const b=e.target.closest('.remove-expect'); if(b) b.closest('.expect-item').remove(); });

    // Pills
    document.getElementById('add-pill').addEventListener('click', function(){
        const d=document.createElement('div'); d.className='pill-item';
        d.innerHTML=`<input type="text" name="hero_pills[]" class="form-control" placeholder="Tag"><button type="button" class="btn-remove-sm remove-pill"><iconify-icon icon="solar:close-outline"></iconify-icon></button>`;
        document.getElementById('pills-container').appendChild(d);
    });
    document.getElementById('pills-container').addEventListener('click', function(e){ const b=e.target.closest('.remove-pill'); if(b) b.closest('.pill-item').remove(); });
});
</script>
@endsection
