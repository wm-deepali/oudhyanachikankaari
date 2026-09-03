@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4;
            --surface: #ffffff;
            --border: #e3e5e8;
            --text-primary: #202223;
            --text-secondary: #6d7175;
            --text-hint: #8c9196;
            --accent: #303d89;
            --accent-light: #f0f1fc;
            --red: #b22222;
            --radius-sm: 8px;
            --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .create-page {
            background: var(--bg);
            padding: 24px 28px;
            min-height: 100vh;
            font-family: var(--font);
            color: var(--text-primary);
        }

        .create-page * {
            box-sizing: border-box;
        }

        /* ── Page header ── */
        .create-page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .create-page-header h1 {
            font-size: 20px;
            font-weight: 650;
            color: var(--text-primary);
            margin: 0;
        }

        .crumb {
            font-size: 12.5px;
            color: var(--text-hint);
            margin-top: 3px;
        }

        .crumb a {
            color: var(--accent);
            text-decoration: none;
        }

        .crumb a:hover {
            text-decoration: underline;
        }

        .crumb span {
            margin: 0 5px;
        }

        /* ── Buttons ── */
        .btn-primary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent);
            color: #fff !important;
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s;
            box-shadow: 0 1px 3px rgba(48, 61, 137, .25);
        }

        .btn-primary-dash:hover:not(:disabled) {
            background: #252f70;
        }

        .btn-primary-dash:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .btn-secondary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--surface);
            color: var(--text-primary) !important;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 18px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s;
            cursor: pointer;
        }

        .btn-secondary-dash:hover {
            background: var(--bg);
        }

        /* ── Two-column layout ── */
        .create-layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 20px;
            align-items: start;
        }

        @media(max-width:900px) {
            .create-layout {
                grid-template-columns: 1fr;
            }
        }

        /* ── Section card ── */
        .section-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            margin-bottom: 16px;
        }

        .section-card:last-child {
            margin-bottom: 0;
        }

        .section-card-header {
            padding: 14px 20px;
            border-bottom: 1px solid var(--border);
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .section-card-header h5 {
            font-size: 13px;
            font-weight: 650;
            color: var(--text-primary);
            margin: 0;
            letter-spacing: .01em;
        }

        .section-card-header .auto-badge {
            font-size: 10.5px;
            font-weight: 600;
            color: var(--accent);
            background: var(--accent-light);
            padding: 3px 8px;
            border-radius: 20px;
            letter-spacing: .02em;
        }

        .section-card-body {
            padding: 20px;
        }

        /* ── Form fields ── */
        .field-group {
            margin-bottom: 16px;
        }

        .field-group:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: .03em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .field-label .req {
            color: var(--red);
            margin-left: 2px;
        }

        .field-input,
        .field-select {
            width: 100%;
            height: 38px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 12px;
            font-size: 13.5px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            font-family: var(--font);
        }

        .field-input,
        .field-textarea {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 12px;
            font-size: 13.5px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            font-family: var(--font);
        }

        .field-textarea {
            padding: 10px 12px;
            resize: vertical;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .field-input:focus,
        .field-textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .field-hint {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 4px;
        }

        .char-count {
            font-size: 11px;
            color: var(--text-hint);
            text-align: right;
            margin-top: 4px;
        }

        .char-count.warn {
            color: #b8860b;
        }

        .char-count.over {
            color: var(--red);
        }

        /* ── Slug / canonical prefix ── */
        .slug-wrap {
            display: flex;
        }

        .slug-prefix {
            display: inline-flex;
            align-items: center;
            padding: 0 10px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-right: none;
            border-radius: var(--radius-sm) 0 0 var(--radius-sm);
            font-size: 12px;
            color: var(--text-hint);
            white-space: nowrap;
        }

        .slug-wrap .field-input {
            border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        }

        /* ── Image upload ── */
        .image-upload {
            border: 1.5px dashed var(--border);
            border-radius: var(--radius-sm);
            padding: 16px;
            text-align: center;
            cursor: pointer;
            position: relative;
            background: var(--bg);
        }

        .image-upload input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload .icon {
            font-size: 20px;
            color: var(--text-hint);
            margin-bottom: 6px;
        }

        .image-upload .txt {
            font-size: 12.5px;
            color: var(--text-secondary);
        }

        #imagePreviewWrap {
            display: none;
            margin-top: 10px;
            text-align: center;
        }

        #imagePreviewWrap img {
            max-width: 100%;
            max-height: 140px;
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
        }

        /* ── Toggle rows (right column) ── */
        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--bg);
        }

        .toggle-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .toggle-row:first-child {
            padding-top: 0;
        }

        .toggle-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .toggle-sub {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 2px;
        }

        .field-select-sm {
            height: 32px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 28px 0 10px;
            font-size: 12.5px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            font-family: var(--font);
            transition: border-color .15s, box-shadow .15s;
            min-width: 100px;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 9px center;
        }

        .field-select-sm:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        /* ── Info note (backend-only fields) ── */
        .info-note {
            display: flex;
            gap: 8px;
            background: var(--accent-light);
            border-radius: var(--radius-sm);
            padding: 10px 12px;
            font-size: 11.5px;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .info-note i {
            color: var(--accent);
            margin-top: 1px;
        }

        /* ── Action bar ── */
        .action-bar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        @media(max-width:768px) {
            .create-page {
                padding: 16px;
            }
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="create-page">

            <!-- Page header -->
            <div class="create-page-header">
                <div>
                    <h1>Add Collection</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.collections.index') }}">Manage Collections</a>
                        <span>›</span>
                        Add Collection
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.collections.store') }}" id="collectionForm" enctype="multipart/form-data">
                @csrf

                <div class="create-layout">

                    <!-- ── LEFT column ── -->
                    <div>
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Collection Details</h5>
                            </div>
                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Name <span class="req">*</span></label>
                                    <input type="text" name="name" id="name" class="field-input" value="{{ old('name') }}" required>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Slug</label>
                                    <div class="slug-wrap">
                                        <span class="slug-prefix">collection/</span>
                                        <input type="text" name="slug" id="slug" class="field-input" value="{{ old('slug') }}">
                                    </div>
                                    <div class="field-hint">Auto-generated from name. You can edit manually.</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">H1 Heading <span class="req">*</span></label>
                                    <input type="text" name="h1_heading" id="h1_heading" class="field-input" value="{{ old('h1_heading') }}" required>
                                    <div class="field-hint">Auto-filled from name. Shown as the page's main heading — edit if you want different on-page wording.</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="field-input" value="{{ old('sort_order', 0) }}"
                                        style="max-width:120px">
                                    <div class="field-hint">Lower numbers appear first.</div>
                                </div>

                                <div class="field-group" style="margin-bottom:0">
                                    <label class="field-label">Collection Image</label>
                                    <div class="image-upload" id="imageUploadBox">
                                        <input type="file" name="image" id="image" accept="image/*">
                                        <div class="icon"><i class="fa fa-cloud-upload-alt"></i></div>
                                        <div class="txt">Click or drag an image here</div>
                                    </div>
                                    <div id="imagePreviewWrap">
                                        <img id="imagePreview" src="" alt="">
                                    </div>
                                    <div class="field-hint">Recommended 1200×630px. Used as the OG image for social sharing and its filename/alt text is auto-set from the collection name below.</div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- ── RIGHT column ── -->
                    <div>
                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>SEO Settings</h5>
                                <span class="auto-badge">Auto-filled</span>
                            </div>

                            <div class="section-card-body">

                                <div class="field-group">
                                    <label class="field-label">Meta Title <span class="req">*</span></label>
                                    <input type="text" name="meta_title" id="meta_title" class="field-input"
                                        value="{{ old('meta_title', $collection->meta_title ?? '') }}"
                                        placeholder="Enter meta title" required maxlength="70">
                                    <div class="char-count" id="metaTitleCount">0 / 60</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Meta Description <span class="req">*</span></label>
                                    <textarea name="meta_description" id="meta_description" class="field-textarea" rows="3"
                                        placeholder="Enter meta description" required maxlength="200">{{ old('meta_description', $collection->meta_description ?? '') }}</textarea>
                                    <div class="char-count" id="metaDescCount">0 / 160</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">Canonical URL</label>
                                    <div class="slug-wrap">
                                        <span class="slug-prefix">{{ url('/collection') }}/</span>
                                        <input type="text" name="canonical" id="canonical" class="field-input" value="{{ old('canonical') }}">
                                    </div>
                                    <div class="field-hint">Auto-set from slug. Edit only if this collection should canonicalize to a different URL.</div>
                                </div>

                                <div class="field-group">
                                    <label class="field-label">OG Title</label>
                                    <input type="text" name="og_title" id="og_title" class="field-input" value="{{ old('og_title') }}"
                                        placeholder="Falls back to Meta Title">
                                    <div class="field-hint">Auto-filled from Meta Title. Edit to customize for social shares.</div>
                                </div>

                                <div class="field-group" style="margin-bottom:0">
                                    <label class="field-label">OG Description</label>
                                    <textarea name="og_description" id="og_description" class="field-textarea" rows="3"
                                        placeholder="Falls back to Meta Description">{{ old('og_description') }}</textarea>
                                    <div class="field-hint">Auto-filled from Meta Description. Edit to customize for social shares.</div>
                                </div>

                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Image Alt Tag</h5>
                            </div>
                            <div class="section-card-body">
                                <div class="field-group" style="margin-bottom:0">
                                    <input type="text" name="image_alt" id="image_alt" class="field-input" value="{{ old('image_alt') }}"
                                        placeholder="Auto-filled from collection name">
                                    <div class="field-hint">Used as the alt attribute on the collection image. Auto-filled from name.</div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-card-header">
                                <h5>Settings</h5>
                            </div>
                            <div class="section-card-body" style="padding:16px 20px">
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-label">Status</div>
                                        <div class="toggle-sub">Visibility on storefront</div>
                                    </div>
                                    <select name="status" class="field-select-sm">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.collections.index') }}" class="btn-secondary-dash">Cancel</a>
                    <button type="submit" id="saveBtn" class="btn-primary-dash">
                        <i class="fa fa-save"></i> Save Collection
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    // ── manual-edit tracking flags: once a user types directly into an
    // auto-filled field, stop overwriting it from its source field ──
    let manualSlug = false;
    let manualH1 = false;
    let manualMetaTitle = false;
    let manualCanonical = false;
    let manualOgTitle = false;
    let manualOgDesc = false;
    let manualAlt = false;

    function slugify(value) {
        return value
            .toLowerCase()
            .trim()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
    }

    // Mark fields as manually edited once the user types in them directly
    $('#slug').on('keyup', function () { manualSlug = true; });
    $('#h1_heading').on('keyup', function () { manualH1 = true; });
    $('#meta_title').on('keyup', function () { manualMetaTitle = true; });
    $('#canonical').on('keyup', function () { manualCanonical = true; });
    $('#og_title').on('keyup', function () { manualOgTitle = true; });
    $('#og_description').on('keyup', function () { manualOgDesc = true; });
    $('#image_alt').on('keyup', function () { manualAlt = true; });

    // Name drives: slug, H1, meta title (if empty), image alt
    $('#name').on('keyup', function () {
        const name = $(this).val();

        if (!manualSlug) {
            const slug = slugify(name);
            $('#slug').val(slug);
            if (!manualCanonical) {
                $('#canonical').val(slug);
            }
        }

        if (!manualH1) {
            $('#h1_heading').val(name);
        }

        if (!manualMetaTitle) {
            $('#meta_title').val(name);
            $('#meta_title').trigger('keyup.count');
        }

        if (!manualAlt) {
            $('#image_alt').val(name);
        }
    });

    // Slug drives canonical (unless canonical was manually edited)
    $('#slug').on('keyup', function () {
        if (!manualCanonical) {
            $('#canonical').val($(this).val());
        }
    });

    // Meta Title drives OG Title
    $('#meta_title').on('keyup', function () {
        if (!manualOgTitle) {
            $('#og_title').val($(this).val());
        }
    });

    // Meta Description drives OG Description
    $('#meta_description').on('keyup', function () {
        if (!manualOgDesc) {
            $('#og_description').val($(this).val());
        }
    });

    // Character counters for meta title / description
    function updateCharCount(inputSel, countSel, optimal, max) {
        const len = $(inputSel).val().length;
        const $count = $(countSel);
        $count.text(len + ' / ' + optimal);
        $count.removeClass('warn over');
        if (len > max) {
            $count.addClass('over');
        } else if (len > optimal) {
            $count.addClass('warn');
        }
    }

    $('#meta_title').on('keyup keyup.count', function () {
        updateCharCount('#meta_title', '#metaTitleCount', 60, 70);
    });

    $('#meta_description').on('keyup', function () {
        updateCharCount('#meta_description', '#metaDescCount', 160, 200);
    });

    // Image preview
    $('#image').on('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function (ev) {
            $('#imagePreview').attr('src', ev.target.result);
            $('#imagePreviewWrap').show();
        };
        reader.readAsDataURL(file);
    });

    $('#collectionForm').on('submit', function () {
        const btn = document.getElementById('saveBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
    });
</script>