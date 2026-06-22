@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg:            #f1f2f4;
        --surface:       #ffffff;
        --border:        #e3e5e8;
        --text-primary:  #202223;
        --text-secondary:#6d7175;
        --text-hint:     #8c9196;
        --accent:        #303d89;
        --accent-light:  #f0f1fc;
        --green:         #007a5e;
        --green-bg:      #e3f1ec;
        --red:           #b22222;
        --red-bg:        #fce8e8;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .edit-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .edit-page * { box-sizing: border-box; }

    /* ── Page header ────────────────────────────────────────── */
    .edit-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .edit-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    /* ── Identity chip ─────────────────────────────────────── */
    .prod-identity {
        display: flex; align-items: center; gap: 12px;
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); padding: 10px 14px;
        box-shadow: var(--shadow-card);
    }
    .prod-identity-thumb { width: 44px; height: 44px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; }
    .prod-identity-icon { width: 44px; height: 44px; border-radius: var(--radius-sm); background: var(--accent-light); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 18px; flex-shrink: 0; }
    .prod-identity-name { font-size: 14px; font-weight: 650; color: var(--text-primary); max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .prod-identity-id   { font-size: 12px; color: var(--text-hint); margin-top: 2px; display: flex; align-items: center; gap: 6px; }

    /* ── Buttons ────────────────────────────────────────────── */
    .btn-primary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent); color: #fff !important; border: none;
        border-radius: var(--radius-sm); padding: 8px 18px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s; box-shadow: 0 1px 3px rgba(48,61,137,.25);
    }
    .btn-primary-dash:hover:not(:disabled) { background: #252f70; }
    .btn-primary-dash:disabled { opacity: .65; cursor: not-allowed; }

    .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--surface); color: var(--text-primary) !important;
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 8px 18px; font-size: 13px; font-weight: 500;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s; cursor: pointer;
    }
    .btn-secondary-dash:hover { background: var(--bg); }

    .btn-accent-outline {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent-light); color: var(--accent) !important;
        border: 1px solid rgba(48,61,137,.25); border-radius: var(--radius-sm);
        padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s;
    }
    .btn-accent-outline:hover { background: #e3e5f7; }

    /* ── Layout ─────────────────────────────────────────────── */
    .edit-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }
    @media(max-width:960px) { .edit-layout { grid-template-columns: 1fr; } }

    /* ── Section card ───────────────────────────────────────── */
    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .section-card-body { padding: 20px; }

    /* ── Form fields ────────────────────────────────────────── */
    .field-group { margin-bottom: 16px; }
    .field-group:last-child { margin-bottom: 0; }
    .field-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; margin-bottom: 6px; }
    .field-label .req { color: var(--red); margin-left: 2px; }

    .field-input, .field-select, .field-textarea {
        width: 100%; border: 1px solid var(--border);
        border-radius: var(--radius-sm); padding: 0 12px;
        font-size: 13.5px; color: var(--text-primary);
        background: var(--surface); outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: var(--font);
    }
    .field-input, .field-select { height: 38px; }
    .field-textarea { padding: 10px 12px; resize: vertical; min-height: 90px; }
    .field-input:focus, .field-select:focus, .field-textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .field-input[readonly] { background: var(--bg); color: var(--text-secondary); cursor: not-allowed; }
    .field-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    /* ── Slug prefix ────────────────────────────────────────── */
    .slug-wrap { display: flex; }
    .slug-prefix { display: inline-flex; align-items: center; padding: 0 10px; background: var(--bg); border: 1px solid var(--border); border-right: none; border-radius: var(--radius-sm) 0 0 var(--radius-sm); font-size: 12px; color: var(--text-hint); white-space: nowrap; }
    .slug-wrap .field-input { border-radius: 0 var(--radius-sm) var(--radius-sm) 0; }

    /* ── Price grid ─────────────────────────────────────────── */
    .price-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; }
    @media(max-width:600px) { .price-grid { grid-template-columns: 1fr 1fr; } }

    .final-price-box { background: var(--accent-light); border: 1px solid #c7cdf5; border-radius: var(--radius-sm); padding: 12px 16px; display: flex; align-items: center; justify-content: space-between; margin-top: 14px; }
    .final-price-box .fp-label { font-size: 12px; font-weight: 600; color: var(--accent); text-transform: uppercase; letter-spacing: .04em; }
    .final-price-box .fp-value { font-size: 20px; font-weight: 700; color: var(--accent); }

    /* ── Inventory grid ─────────────────────────────────────── */
    .inv-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

    /* ── Checkbox pill ──────────────────────────────────────── */
    .check-pill { display: flex; align-items: center; gap: 8px; padding: 9px 12px; border: 1px solid var(--border); border-radius: var(--radius-sm); background: var(--surface); cursor: pointer; transition: border-color .15s, background .15s; font-size: 13px; color: var(--text-primary); margin-bottom: 8px; user-select: none; }
    .check-pill:last-child { margin-bottom: 0; }
    .check-pill:hover { border-color: var(--accent); background: var(--accent-light); }
    .check-pill input[type="checkbox"] { accent-color: var(--accent); width: 15px; height: 15px; flex-shrink: 0; cursor: pointer; }
    .check-pill input[type="checkbox"]:checked ~ span { font-weight: 600; color: var(--accent); }
    .check-pill:has(input:checked) { border-color: var(--accent); background: var(--accent-light); }

    .check-pill-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 12px; }
    @media(max-width:600px) { .check-pill-grid { grid-template-columns: 1fr; } }

    /* ── Media thumbnails ───────────────────────────────────── */
    .media-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 4px; }
    .thumb-box { position: relative; }
    .thumb-box img { width: 80px; height: 80px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); display: block; }
    .thumb-remove { position: absolute; top: -6px; right: -6px; width: 20px; height: 20px; border-radius: 50%; background: var(--red); color: #fff; border: 2px solid #fff; font-size: 11px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
    .thumb-default { text-align: center; margin-top: 4px; font-size: 11px; color: var(--text-hint); }
    .thumb-default input { accent-color: var(--accent); }

    /* ── Upload area ────────────────────────────────────────── */
    .upload-area { border: 2px dashed var(--border); border-radius: var(--radius-sm); padding: 20px; text-align: center; cursor: pointer; transition: border-color .15s, background .15s; position: relative; }
    .upload-area:hover { border-color: var(--accent); background: var(--accent-light); }
    .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .upload-icon  { font-size: 20px; color: var(--text-hint); margin-bottom: 4px; }
    .upload-label { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .upload-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }

    /* ── Toggle rows (right sidebar) ────────────────────────── */
    .toggle-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .toggle-row:last-child { border-bottom: none; padding-bottom: 0; }
    .toggle-row:first-child { padding-top: 0; }
    .toggle-label { font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .toggle-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }
    .field-select-sm {
        height: 32px; border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 0 28px 0 10px; font-size: 12.5px; color: var(--text-primary);
        background: var(--surface); outline: none; font-family: var(--font);
        transition: border-color .15s, box-shadow .15s; min-width: 100px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 9px center;
    }
    .field-select-sm:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }

    /* ── Status pills ───────────────────────────────────────── */
    .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
    .pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .pill-active   { background: var(--green-bg); color: var(--green); }
    .pill-active::before { background: var(--green); }
    .pill-inactive { background: var(--red-bg); color: var(--red); }
    .pill-inactive::before { background: var(--red); }

    /* ── Attributes (dynamic) ───────────────────────────────── */
    #attribute-container .section-card,
    #variant-container   .section-card { margin-bottom: 16px; }

    #variant-container table { font-size: 12.5px; }
    #variant-container table th { background: #fafafa; font-size: 11px; text-transform: uppercase; letter-spacing: .04em; color: var(--text-secondary); font-weight: 650; padding: 10px; }
    #variant-container table td { padding: 8px 10px; vertical-align: middle; }
    #variant-container .form-control,
    #attribute-container .form-control { height: 34px; border-radius: var(--radius-sm); font-size: 12.5px; border: 1px solid var(--border); background: var(--surface); font-family: var(--font); padding: 0 10px; outline: none; transition: border-color .15s, box-shadow .15s; }
    #variant-container .form-control:focus,
    #attribute-container .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }

    #attribute-container .attr-check-wrap { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 6px; }
    #attribute-container .attr-check-item { display: inline-flex; align-items: center; gap: 6px; padding: 5px 10px; border: 1px solid var(--border); border-radius: var(--radius-sm); background: var(--surface); font-size: 12.5px; cursor: pointer; transition: border-color .12s, background .12s; }
    #attribute-container .attr-check-item:hover { border-color: var(--accent); background: var(--accent-light); }
    #attribute-container .attr-check-item input { accent-color: var(--accent); }

    /* ── CKEditor ───────────────────────────────────────────── */
    .cke { border-radius: var(--radius-sm) !important; border: 1px solid var(--border) !important; overflow: hidden; }
    .cke_top { background: #fafafa !important; border-bottom: 1px solid var(--border) !important; }

    /* ── Action bar ─────────────────────────────────────────── */
    .action-bar { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 14px 20px; display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 20px; }

    @media(max-width:768px) { .edit-page { padding: 16px; } .price-grid { grid-template-columns: 1fr 1fr; } .inv-grid { grid-template-columns: 1fr; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="edit-page">

            <!-- Page header -->
            <div class="edit-page-header">
                <div>
                    <h1>Edit Product</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.products.index') }}">Products</a>
                        <span>›</span>
                        Edit Product
                    </div>
                </div>

                <!-- Identity chip -->
                <div class="prod-identity">
                    @php $defaultImg = $product->images->firstWhere('is_default', true) ?? $product->images->first(); @endphp
                    @if($defaultImg)
                        <img src="{{ asset('storage/' . $defaultImg->image) }}" class="prod-identity-thumb" alt="{{ $product->name }}">
                    @else
                        <div class="prod-identity-icon"><i class="fa fa-box"></i></div>
                    @endif
                    <div>
                        <div class="prod-identity-name">{{ $product->name }}</div>
                        <div class="prod-identity-id">
                            ID #{{ $product->id }}
                            &middot;
                            @if($product->status)
                                <span class="pill pill-active">Active</span>
                            @else
                                <span class="pill pill-inactive">Inactive</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Validation errors summary --}}
            @if ($errors->any())
                <div class="section-card" style="border-color:#f3b9b9;">
                    <div class="section-card-body" style="padding:14px 20px;">
                        <strong style="color:var(--red);font-size:13px;">Please fix the following:</strong>
                        <ul style="margin:8px 0 0 18px; padding:0; font-size:13px; color:var(--red);">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                  enctype="multipart/form-data" class="save-form" id="productForm">
                @csrf
                @method('PUT')

                <div class="edit-layout">

                    <!-- ══════════ LEFT COLUMN ══════════ -->
                    <div>

                        <!-- Basic Info -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Basic Information</h5></div>
                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Category <span class="req">*</span></label>
                                    <select name="category_id" id="category_id" class="field-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field-group" id="subcategory-wrapper"
                                     style="{{ $product->category_id ? '' : 'display:none' }}">
                                    <label class="field-label">Sub Category</label>
                                    <select name="subcategory_id" id="subcategory_id" class="field-select">
                                        <option value="">Select Sub Category</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Product Name <span class="req">*</span></label>
                                    <input type="text" name="name" id="product_name" class="field-input"
                                           value="{{ old('name', $product->name) }}" required>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Slug</label>
                                    <div class="slug-wrap">
                                        <span class="slug-prefix">product/</span>
                                        <input type="text" name="slug" id="slug" class="field-input"
                                               value="{{ old('slug', $product->slug) }}">
                                    </div>
                                    <div class="field-hint">Optional — auto-generated from product name if left blank</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Short Description</label>
                                    <textarea name="short_description" class="field-textarea"
                                              rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                </div>

                            </div>
                        </div>

                        <!-- Content -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Content</h5></div>
                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Product Details</label>
                                    <textarea name="description" id="description" class="field-textarea"
                                              style="min-height:140px">{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Delivery &amp; Returns</label>
                                    <textarea name="delivery_returns" id="delivery_returns" class="field-textarea"
                                              style="min-height:100px">{{ old('delivery_returns', $product->delivery_returns) }}</textarea>
                                </div>

                                 <div class="field-group">
                                    <label class="field-label">Fabric &amp; Care</label>
                                    <textarea name="fabric_care" id="fabric_care" class="field-textarea"
                                              style="min-height:100px">{{ old('fabric_care', $product->fabric_care) }}</textarea>
                                </div>

                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Pricing</h5></div>
                            <div class="section-card-body">

                                <div class="field-hint" style="margin-bottom:14px;">MRP and Discount are optional. Leave blank if not applicable — Final Price will simply equal MRP (or 0 if MRP is also blank).</div>

                                <div class="price-grid">
                                    <div class="field-group" style="margin:0">
                                        <label class="field-label">MRP</label>
                                        <input type="number" step="0.01" name="mrp" id="mrp" class="field-input"
                                               value="{{ old('mrp', $product->mrp) }}">
                                    </div>
                                    <div class="field-group" style="margin:0">
                                        <label class="field-label">Discount Type</label>
                                        <select name="discount_type" id="discount_type" class="field-select">
                                            <option value="amount"     {{ old('discount_type', $product->discount_type) == 'amount'     ? 'selected' : '' }}>Amount (₹)</option>
                                            <option value="percentage" {{ old('discount_type', $product->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                        </select>
                                    </div>
                                    <div class="field-group" style="margin:0">
                                        <label class="field-label">Discount</label>
                                        <input type="number" step="0.01" name="discount" id="discount" class="field-input"
                                               value="{{ old('discount', $product->discount) }}">
                                    </div>
                                </div>

                                <div class="final-price-box">
                                    <span class="fp-label">Final Price</span>
                                    <span class="fp-value">₹<span id="price-display">{{ old('price', $product->price) }}</span></span>
                                    <input type="hidden" name="price" id="price" value="{{ old('price', $product->price) }}">
                                </div>

                            </div>
                        </div>

                        <!-- Media -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Media</h5></div>
                            <div class="section-card-body">

                                @if($product->images->count())
                                    <div class="field-group">
                                        <label class="field-label">Current Images</label>
                                        <div class="media-grid" id="existingMedia">
                                            @foreach($product->images as $img)
                                                <div class="thumb-box" id="img_{{ $img->id }}">
                                                    <img src="{{ asset('storage/' . $img->image) }}" alt="">
                                                    <button type="button" class="thumb-remove"
                                                            onclick="removeExistingImage({{ $img->id }})">×</button>
                                                    <div class="thumb-default">
                                                        <input type="radio" name="default_type"
                                                               value="old_{{ $img->id }}"
                                                               {{ $img->is_default ? 'checked' : '' }}>
                                                        Default
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="field-group">
                                    <label class="field-label">Upload New Images <span style="font-weight:400;text-transform:none;font-size:11px">(max 6 total)</span></label>
                                    <div class="upload-area">
                                        <input type="file" id="images" name="images[]" multiple accept="image/*">
                                        <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                        <div class="upload-label">Click or drag to upload</div>
                                        <div class="upload-sub">PNG, JPG, WEBP &middot; max 6 images</div>
                                    </div>
                                    <div id="previewContainer" class="media-grid"></div>
                                </div>

                            </div>
                        </div>

                    </div><!-- /left column -->

                    <!-- ══════════ RIGHT COLUMN ══════════ -->
                    <div>

                        <!-- Status -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Status</h5></div>
                            <div class="section-card-body" style="padding:14px 20px">
                                <div class="toggle-row" style="padding:0;border:none">
                                    <div>
                                        <div class="toggle-label">Visibility</div>
                                        <div class="toggle-sub">Shown on storefront</div>
                                    </div>
                                    <select name="status" class="field-select-sm">
                                        <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Inventory</h5></div>
                            <div class="section-card-body">

                                <div class="inv-grid" style="margin-bottom:14px">
                                    <div class="field-group" style="margin:0">
                                        <label class="field-label">SKU</label>
                                        <input type="text" name="sku" class="field-input"
                                               value="{{ old('sku', $product->sku) }}">
                                    </div>
                                    <div class="field-group" style="margin:0">
                                        <label class="field-label">Product Code</label>
                                        <input type="text" name="product_code" class="field-input"
                                               value="{{ old('product_code', $product->product_code) }}">
                                    </div>
                                    <div class="field-group" style="margin:0">
                                        <label class="field-label">Stock</label>
                                        <input type="number" name="stock" class="field-input"
                                               value="{{ old('stock', $product->stock) }}">
                                    </div>
                                    <div class="field-group" style="margin:0">
                                        <label class="field-label">Min Qty</label>
                                        <input type="number" name="min_qty" class="field-input"
                                               value="{{ old('min_qty', $product->min_qty) }}">
                                    </div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Delivery Time</label>
                                    <input type="text" name="delivery_time" class="field-input"
                                           value="{{ old('delivery_time', $product->delivery_time) }}"
                                           placeholder="e.g. 3–5 business days">
                                </div>

                                <div>
    <label class="check-pill">
        <input type="checkbox" name="quality" {{ old('quality', $product->quality) ? 'checked' : '' }}>
        <span>Quality Assurance</span>
    </label>
    <label class="check-pill">
        <input type="checkbox" name="pan_india" {{ old('pan_india', $product->pan_india) ? 'checked' : '' }}>
        <span>PAN India Delivery</span>
    </label>
</div>

                            </div>
                        </div>

                        <!-- Occasions -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Occasions</h5></div>
                            <div class="section-card-body">
                                @foreach($occasions as $o)
                                    <label class="check-pill">
                                        <input type="checkbox" name="occasions[]" value="{{ $o->id }}"
                                               {{ in_array($o->id, old('occasions', $selectedOccasions)) ? 'checked' : '' }}>
                                        <span>{{ $o->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Collections -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>Collections</h5></div>
                            <div class="section-card-body">
                                @foreach($collections as $collection)
                                    <label class="check-pill">
                                        <input type="checkbox" name="collections[]" value="{{ $collection->id }}"
                                               {{ in_array($collection->id, old('collections', $product->collections->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <span>{{ $collection->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- SEO -->
                        <div class="section-card">
                            <div class="section-card-header"><h5>SEO</h5></div>
                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="field-input"
                                           value="{{ old('meta_title', $product->meta_title) }}">
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Meta Description</label>
                                    <textarea name="meta_description" class="field-textarea">{{ old('meta_description', $product->meta_description) }}</textarea>
                                </div>

                            </div>
                        </div>

                    </div><!-- /right column -->

                </div><!-- /edit-layout -->

                <!-- ── Attributes & Variants (full width below grid) ── -->
                <div id="attribute-container"></div>

                <div id="variant-btn-wrapper" style="display:none; margin: 16px 0;">
                    <button type="button" id="generate-variants" class="btn-accent-outline">
                        <i class="fa fa-cogs"></i> Generate Variants
                    </button>
                </div>

                <div id="variant-container"></div>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.products.index') }}" class="btn-secondary-dash">Cancel</a>
                    <button type="submit" id="saveBtn" class="btn-primary-dash save-btn">
                        <i class="fa fa-save"></i> Update Product
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
let selectedAttributeValues = @json($selectedAttributeValues);
let existingVariants        = @json($existingVariants);

CKEDITOR.config.versionCheck = false;
CKEDITOR.replace('description');
CKEDITOR.replace('delivery_returns');
CKEDITOR.replace('fabric_care');

$(document).ready(function () {
    let categoryId = $('#category_id').val();
    if (categoryId) {
        loadAttributes(categoryId);
        if (existingVariants.length > 0) renderExistingVariants();
    }
    calcPrice(); // ✅ keep hidden #price + display in sync on load, in case product had no MRP/discount saved
});

// Slug auto-gen
$(document).on('keyup', '#product_name', function () {
    $('#slug').val($(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, ''));
});

// Price calc — also updates the visible display span
function calcPrice() {
    let m = +$('#mrp').val() || 0;
    let d = +$('#discount').val() || 0;
    let t = $('#discount_type').val();
    let p = t == 'percentage' ? m - (m * d / 100) : m - d;
    if (p < 0) p = 0;
    $('#price').val(p.toFixed(2));
    $('#price-display').text(p.toFixed(2));
}
$('#mrp,#discount,#discount_type').on('keyup change', calcPrice);

// Submit spinner
$(document).on('submit', '.save-form', function () {
    let btn = $(this).find('.save-btn');
    btn.prop('disabled', true);
    btn.html('<i class="fa fa-spinner fa-spin"></i> Updating...');
});

// ── Image handling ────────────────────────────────────────────
let selectedFiles = [];

$('#images').on('change', function (e) {
    let files = Array.from(e.target.files);
    if ((selectedFiles.length + files.length) > 6) { alert('Max 6 images allowed'); return; }
    files.forEach(file => selectedFiles.push(file));
    renderPreview();
});

function renderPreview() {
    $('#previewContainer').html('');
    selectedFiles.forEach((file, index) => {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#previewContainer').append(`
                <div class="thumb-box">
                    <img src="${e.target.result}">
                    <button type="button" class="thumb-remove" onclick="removeImage(${index})">×</button>
                    <div class="thumb-default">
                        <input type="radio" name="default_type" value="new_${index}" ${index === 0 ? 'checked' : ''}> Default
                    </div>
                </div>
            `);
        };
        reader.readAsDataURL(file);
    });
}

function removeImage(index) { selectedFiles.splice(index, 1); renderPreview(); }

function removeExistingImage(id) {
    if (confirm('Remove this image?')) {
        $('#img_' + id).remove();
        $('<input>').attr({ type: 'hidden', name: 'delete_images[]', value: id }).appendTo('form');
    }
}

$('form').on('submit', function () {
    let dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    document.getElementById('images').files = dataTransfer.files;
});

// ── Category → sub + attributes ──────────────────────────────
$('#category_id').on('change', function () {
    let categoryId = $(this).val();
    $('#variant-container').html('');
    $('#variant-btn-wrapper').hide();
    $('#subcategory_id').html('<option value="">Loading...</option>');
    if (!categoryId) { $('#subcategory-wrapper').hide(); return; }
    loadAttributes(categoryId);
    window.subCategoryUrl = "{{ url('admin/products/subcategories') }}";
    $.get(window.subCategoryUrl + '/' + categoryId, function (response) {
        if (response.length > 0) {
            let html = '<option value="">Select Sub Category</option>';
            $.each(response, function (i, item) { html += `<option value="${item.id}">${item.name}</option>`; });
            $('#subcategory_id').html(html);
            $('#subcategory-wrapper').show();
        } else {
            $('#subcategory-wrapper').hide();
        }
    });
});

function loadAttributes(categoryId) {
    $('#attribute-container').html('');
    window.attributeUrl = "{{ url('admin/products/category-attributes') }}";
    $.get(window.attributeUrl + '/' + categoryId, function (response) {
        if (response.length > 0) {
            let html = `
                <div class="section-card">
                    <div class="section-card-header"><h5>Attributes</h5></div>
                    <div class="section-card-body">
            `;
            response.forEach(function (item) {
                html += `<div class="field-group">
                    <label class="field-label">${item.attribute.name}</label>`;
                if (item.attribute.has_values) {
                    html += `<div class="attr-check-wrap">`;
                    item.attribute.values.forEach(function (value) {
                        let checked = selectedAttributeValues.includes(value.id) ? 'checked' : '';
                        html += `
                            <label class="attr-check-item">
                                <input type="checkbox" class="attribute-value"
                                    data-attribute-id="${item.attribute.id}"
                                    data-attribute-name="${item.attribute.name}"
                                    data-value-name="${value.value}"
                                    data-variant="${item.used_for_variant}"
                                    name="attribute_values[${item.attribute.id}][]"
                                    value="${value.id}" ${checked}>
                                ${value.value}
                            </label>`;
                    });
                    html += `</div>`;
                }
                html += `</div>`;
            });
            html += `</div></div>`;
            $('#attribute-container').html(html);
            $('#variant-btn-wrapper').show();
        } else {
            $('#attribute-container').html('');
            $('#variant-btn-wrapper').hide();
        }
    });
}

$(document).on('click', '#generate-variants', function () {
    let variantAttributes = {};
    $('.attribute-value:checked').each(function () {
        if ($(this).data('variant') != 1) return;
        let attributeId = $(this).data('attribute-id');
        if (!variantAttributes[attributeId]) variantAttributes[attributeId] = [];
        variantAttributes[attributeId].push({ id: $(this).val(), name: $(this).data('value-name') });
    });
    let groups = Object.values(variantAttributes);
    if (groups.length === 0) { alert('Please select at least one value from attributes marked as Variant.'); return; }
    renderVariants(cartesian(groups));
});

function cartesian(arr) {
    if (arr.length === 1) return arr[0].map(item => [item]);
    return arr.reduce((a, b) => a.flatMap(d => b.map(e => [].concat(d, e))));
}

function variantRowHTML(index, variantName, data = {}) {
    return `
    <tr>
        <td>${variantName}${data.id ? `<input type="hidden" name="variants[${index}][id]" value="${data.id}">` : ''}</td>
        <td><input type="text"   name="variants[${index}][sku]"           class="form-control" value="${data.sku ?? ''}"></td>
        <td><input type="number" name="variants[${index}][mrp]"           class="form-control" step="0.01" value="${data.mrp ?? ''}"></td>
        <td>
            <select name="variants[${index}][discount_type]" class="form-control">
                <option value="amount"     ${(data.discount_type ?? '') == 'amount'     ? 'selected' : ''}>Amount</option>
                <option value="percentage" ${(data.discount_type ?? '') == 'percentage' ? 'selected' : ''}>%</option>
            </select>
        </td>
        <td><input type="number" name="variants[${index}][discount]"      class="form-control" step="0.01" value="${data.discount ?? ''}"></td>
        <td><input type="number" name="variants[${index}][price]"         class="form-control" step="0.01" value="${data.price ?? ''}" readonly></td>
        <td><input type="number" name="variants[${index}][stock]"         class="form-control" value="${data.stock ?? ''}"></td>
        <td>
            ${data.image ? `<img src="/storage/${data.image}" style="width:50px;height:50px;object-fit:cover;border-radius:6px;border:1px solid var(--border);margin-bottom:6px;display:block">` : ''}
            <input type="file" name="variants[${index}][image]" class="form-control" style="height:auto;padding:4px">
            ${data.image ? `<input type="hidden" name="variants[${index}][old_image]" value="${data.image}">` : ''}
        </td>
    </tr>`;
}

function variantTableWrap(tbody) {
    return `<div class="section-card" style="margin-bottom:16px">
        <div class="section-card-header"><h5>Variants</h5></div>
        <div class="section-card-body" style="padding:0;overflow-x:auto">
            <table class="table table-bordered" style="margin:0">
                <thead><tr>
                    <th>Variant</th><th>SKU</th><th>MRP</th><th>Discount Type</th><th>Discount</th><th>Final Price</th><th>Stock</th><th>Image</th>
                </tr></thead>
                <tbody>${tbody}</tbody>
            </table>
        </div>
    </div>`;
}

function renderVariants(combinations) {
    let tbody = '';
    combinations.forEach(function (combo, index) {
        if (!Array.isArray(combo)) combo = [combo];
        let names = combo.map(x => x.name).join(' / ');
        let hiddenInputs = combo.map(x => `<input type="hidden" name="variants[${index}][values][]" value="${x.id}">`).join('');
        tbody += variantRowHTML(index, names + hiddenInputs);
    });
    $('#variant-container').html(variantTableWrap(tbody));
}

function renderExistingVariants() {
    let tbody = '';
    existingVariants.forEach(function (variant, index) {
        tbody += variantRowHTML(index, variant.variant_name, variant);
    });
    $('#variant-container').html(variantTableWrap(tbody));
}

// Variant price calc
$(document).on('keyup change',
    'input[name$="[mrp]"], input[name$="[discount]"], select[name$="[discount_type]"]',
    function () {
        let row = $(this).closest('tr');
        let mrp = parseFloat(row.find('input[name$="[mrp]"]').val()) || 0;
        let discount = parseFloat(row.find('input[name$="[discount]"]').val()) || 0;
        let discountType = row.find('select[name$="[discount_type]"]').val();
        let finalPrice = discountType === 'percentage' ? mrp - (mrp * discount / 100) : mrp - discount;
        if (finalPrice < 0) finalPrice = 0;
        row.find('input[name$="[price]"]').val(finalPrice.toFixed(2));
    }
);
</script>

@include('admin.footer')