@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
    /* ── Design Tokens ──────────────────────────────────────── */
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

    /* ── Identity chip ──────────────────────────────────────── */
    .attr-identity {
        display: flex; align-items: center; gap: 12px;
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); padding: 12px 16px;
        box-shadow: var(--shadow-card);
    }
    .attr-identity-icon {
        width: 48px; height: 48px; border-radius: var(--radius-sm);
        background: var(--accent-light); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        color: var(--accent); font-size: 18px; flex-shrink: 0;
    }
    .attr-identity-name { font-size: 14px; font-weight: 650; color: var(--text-primary); }
    .attr-identity-id   { font-size: 12px; color: var(--text-hint); margin-top: 2px; }

    /* ── Buttons ────────────────────────────────────────────── */
    .btn-primary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent); color: #fff !important; border: none;
        border-radius: var(--radius-sm); padding: 8px 18px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s, box-shadow .15s;
        box-shadow: 0 1px 3px rgba(48,61,137,.25);
    }
    .btn-primary-dash:hover:not(:disabled) { background: #252f70; }
    .btn-primary-dash:disabled { opacity: .65; cursor: not-allowed; }

    .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--surface); color: var(--text-primary) !important;
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 8px 18px; font-size: 13px; font-weight: 500; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s;
    }
    .btn-secondary-dash:hover { background: var(--bg); }

    /* ── Two-column layout ──────────────────────────────────── */
    .edit-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }
    @media(max-width:900px) { .edit-layout { grid-template-columns: 1fr; } }

    /* ── Section card ───────────────────────────────────────── */
    .section-card {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); box-shadow: var(--shadow-card);
        overflow: hidden; margin-bottom: 16px;
    }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header {
        padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa;
    }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; letter-spacing: .01em; }
    .section-card-body { padding: 20px; }

    /* ── Form fields ────────────────────────────────────────── */
    .field-group { margin-bottom: 16px; }
    .field-group:last-child { margin-bottom: 0; }
    .field-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; margin-bottom: 6px; }
    .field-label .req { color: var(--red); margin-left: 2px; }

    .field-input, .field-select {
        width: 100%; height: 38px; border: 1px solid var(--border);
        border-radius: var(--radius-sm); padding: 0 12px;
        font-size: 13.5px; color: var(--text-primary);
        background: var(--surface); outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: var(--font);
    }
    .field-input:focus, .field-select:focus {
        border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12);
    }
    .field-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    /* ── Toggle rows ────────────────────────────────────────── */
    .toggle-row { display: flex; align-items: center; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--bg); }
    .toggle-row:last-child { border-bottom: none; padding-bottom: 0; }
    .toggle-row:first-child { padding-top: 0; }
    .toggle-label { font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .toggle-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }

    .field-select-sm {
        height: 32px; border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 0 28px 0 10px; font-size: 12.5px; color: var(--text-primary);
        background: var(--surface); outline: none; font-family: var(--font);
        transition: border-color .15s, box-shadow .15s; min-width: 90px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 9px center;
    }
    .field-select-sm:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }

    /* ── Action bar ─────────────────────────────────────────── */
    .action-bar {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); box-shadow: var(--shadow-card);
        padding: 14px 20px; display: flex; align-items: center;
        justify-content: flex-end; gap: 10px; margin-top: 20px;
    }

    @media(max-width:768px) { .edit-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="edit-page">

            <!-- Page header -->
            <div class="edit-page-header">
                <div>
                    <h1>Edit Category Attribute</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.category-attributes.index') }}">Category Attributes</a>
                        <span>›</span>
                        Edit Mapping
                    </div>
                </div>

                <!-- Identity chip -->
                <div class="attr-identity">
                    <div class="attr-identity-icon">
                        <i class="fa fa-tags"></i>
                    </div>
                    <div>
                        <div class="attr-identity-name">{{ $categoryAttribute->attribute->name ?? 'Attribute' }}</div>
                        <div class="attr-identity-id">ID #{{ $categoryAttribute->id }} &middot; {{ $categoryAttribute->category->name ?? '—' }}</div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.category-attributes.update', $categoryAttribute->id) }}" class="save-form">
                @csrf
                @method('PUT')

                <div class="edit-layout">

                    <!-- ── LEFT column ──────────────────────────────── -->
                    <div>

                        <!-- Mapping -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Mapping</h5>
                            </div>
                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Category <span class="req">*</span></label>
                                    <select name="category_id" class="field-select" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $categoryAttribute->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Attribute <span class="req">*</span></label>
                                    <select name="attribute_id" class="field-select" required>
                                        @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}"
                                                {{ $categoryAttribute->attribute_id == $attribute->id ? 'selected' : '' }}>
                                                {{ $attribute->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="field-input"
                                        value="{{ old('sort_order', $categoryAttribute->sort_order) }}"
                                        style="max-width:120px">
                                    <div class="field-hint">Lower numbers appear first.</div>
                                </div>

                            </div>
                        </div>

                        <!-- Visibility -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Visibility</h5>
                            </div>
                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Show In Filter</label>
                                    <select name="show_in_filter" class="field-select">
                                        <option value="1" {{ $categoryAttribute->show_in_filter  ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$categoryAttribute->show_in_filter ? 'selected' : '' }}>No</option>
                                    </select>
                                    <div class="field-hint">Customer can filter products using this attribute.</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Show On Listing</label>
                                    <select name="show_on_listing" class="field-select">
                                        <option value="1" {{ $categoryAttribute->show_on_listing  ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$categoryAttribute->show_on_listing ? 'selected' : '' }}>No</option>
                                    </select>
                                    <div class="field-hint">Show attribute on product cards / category pages.</div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- ── RIGHT column ─────────────────────────────── -->
                    <div>

                        <!-- Settings -->
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Settings</h5>
                            </div>
                            <div class="section-card-body" style="padding:16px 20px">

                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-label">Status</div>
                                        <div class="toggle-sub">Enable this mapping</div>
                                    </div>
                                    <select name="status" class="field-select-sm">
                                        <option value="1" {{ $categoryAttribute->status  ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$categoryAttribute->status ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-label">Required</div>
                                        <div class="toggle-sub">Must be filled by seller</div>
                                    </div>
                                    <select name="is_required" class="field-select-sm">
                                        <option value="1" {{ $categoryAttribute->is_required  ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$categoryAttribute->is_required ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-label">Used For Variant</div>
                                        <div class="toggle-sub">e.g. Color, Size, RAM</div>
                                    </div>
                                    <select name="used_for_variant" class="field-select-sm">
                                        <option value="1" {{ $categoryAttribute->used_for_variant  ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$categoryAttribute->used_for_variant ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.category-attributes.index') }}" class="btn-secondary-dash">
                        Cancel
                    </a>
                    <button type="submit" id="updateBtn" class="btn-primary-dash save-btn">
                        <i class="fa fa-save"></i> Update Mapping
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
$(document).on('submit', '.save-form', function () {
    const btn = document.getElementById('updateBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating…';
});
</script>