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
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .create-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .create-page * { box-sizing: border-box; }

    /* ── Page header ── */
    .create-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .create-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    /* ── Buttons ── */
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

    /* ── Section card ── */
    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; letter-spacing: .01em; }
    .section-card-body { padding: 20px; }

    /* ── Form fields ── */
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media(max-width:600px) { .field-row { grid-template-columns: 1fr; } }
    .field-group { margin-bottom: 16px; }
    .field-group:last-child { margin-bottom: 0; }
    .field-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; margin-bottom: 6px; }
    .field-label .req { color: var(--red); margin-left: 2px; }

    .field-input, .field-textarea {
        width: 100%; border: 1px solid var(--border);
        border-radius: var(--radius-sm); padding: 0 12px;
        font-size: 13.5px; color: var(--text-primary);
        background: var(--surface); outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: var(--font);
    }
    .field-input { height: 38px; }
    .field-textarea { padding: 10px 12px; resize: vertical; }
    .field-input:focus, .field-textarea:focus {
        border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12);
    }
    .field-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    /* ── Image upload ── */
    .upload-area {
        border: 2px dashed var(--border); border-radius: var(--radius-sm);
        padding: 22px 20px; text-align: center; cursor: pointer;
        transition: border-color .15s, background .15s; position: relative;
    }
    .upload-area:hover { border-color: var(--accent); background: var(--accent-light); }
    .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .upload-icon  { font-size: 22px; color: var(--text-hint); margin-bottom: 6px; }
    .upload-label { font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
    .upload-sub   { font-size: 11.5px; color: var(--text-hint); }
    .upload-preview { display: none; flex-direction: column; align-items: center; gap: 8px; }
    .upload-preview img { width: 64px; height: 64px; object-fit: cover; border-radius: var(--radius-sm); border: 1px solid var(--border); }
    .upload-preview span { font-size: 12px; color: var(--text-hint); }

    /* ── Branch block header / remove ── */
    .branch-number-tag { display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; border-radius: 50%; background: var(--accent-light); color: var(--accent); font-size: 11px; font-weight: 700; margin-right: 8px; }
    .remove-branch-btn {
        display: inline-flex; align-items: center; gap: 5px;
        background: none; border: none; color: var(--text-hint);
        font-size: 12px; cursor: pointer; padding: 4px 8px;
        border-radius: var(--radius-sm); transition: all .15s;
    }
    .remove-branch-btn:hover { background: #fce8e8; color: var(--red); }

    /* ── Add branch button ── */
    .add-branch-btn {
        width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px;
        border: 2px dashed var(--border); border-radius: var(--radius-md);
        background: transparent; color: var(--text-secondary);
        font-size: 13px; font-weight: 600; padding: 14px;
        cursor: pointer; font-family: var(--font);
        transition: all .15s; margin-bottom: 20px;
    }
    .add-branch-btn:hover { border-color: var(--accent); background: var(--accent-light); color: var(--accent); }

    /* ── Action bar ── */
    .action-bar {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); box-shadow: var(--shadow-card);
        padding: 14px 20px; display: flex; align-items: center;
        justify-content: flex-end; gap: 10px;
    }

    @media(max-width:768px) { .create-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="create-page">

            <!-- Page header -->
            <div class="create-page-header">
                <div>
                    <h1>Add Contact Branches</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.contact-branches.index') }}">Contact Branches</a>
                        <span>›</span>
                        Add Branches
                    </div>
                </div>
            </div>

            <form id="branchForm" method="POST" enctype="multipart/form-data"
                  action="{{ route('admin.contact-branches.store') }}">
                @csrf

                <div id="branchWrap">

                    {{-- FIRST ROW (template for cloning) --}}
                    <div class="section-card branch-block">
                        <div class="section-card-header">
                            <h5><span class="branch-number-tag">1</span>Branch <span class="branch-number">1</span></h5>
                            <button type="button" class="remove-branch-btn" style="display:none">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        </div>
                        <div class="section-card-body">

                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label">Branch Name <span class="req">*</span></label>
                                    <input type="text" name="title[]" class="field-input" required>
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Phone</label>
                                    <input type="text" name="phone[]" class="field-input">
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label">Address</label>
                                <textarea name="address[]" class="field-textarea" rows="3"
                                          placeholder="Street, city, state, ZIP…"></textarea>
                            </div>

                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label">Email</label>
                                    <input type="text" name="email[]" class="field-input">
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Working Hours</label>
                                    <input type="text" name="working_hours[]" class="field-input"
                                           placeholder="e.g. Mon–Fri, 9am–6pm">
                                </div>
                            </div>

                            <div class="field-group" style="margin-bottom:0">
                                <label class="field-label">Icon</label>
                                <div class="upload-area">
                                    <input type="file" name="icon[]" class="branch-icon-input" accept="image/*">
                                    <div class="upload-placeholder">
                                        <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                        <div class="upload-label">Click to upload icon</div>
                                        <div class="upload-sub">PNG, JPG, SVG</div>
                                    </div>
                                    <div class="upload-preview">
                                        <img class="preview-img" src="" alt="Preview">
                                        <span class="preview-name"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <button type="button" class="add-branch-btn" onclick="addBranch()">
                    <i class="fa fa-plus"></i> Add Another Branch
                </button>

                <!-- Action bar -->
                <div class="action-bar">
                    <a href="{{ route('admin.contact-branches.index') }}" class="btn-secondary-dash">Cancel</a>
                    <button type="submit" id="saveBtn" class="btn-primary-dash">
                        <i class="fa-solid fa-save"></i> Save Branches
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
function renumberBranches() {
    $('#branchWrap .branch-block').each(function (i) {
        const num = i + 1;
        $(this).find('.branch-number-tag').text(num);
        $(this).find('.branch-number').text(num);
    });
}

function updateRemoveButtons() {
    const blocks = $('#branchWrap .branch-block');
    if (blocks.length > 1) {
        $('.remove-branch-btn').show();
    } else {
        $('.remove-branch-btn').hide();
    }
}

function addBranch() {
    const $clone = $('#branchWrap .branch-block').first().clone();

    // Reset field values
    $clone.find('input[type="text"], textarea').val('');
    $clone.find('input[type="file"]').val('');
    $clone.find('.upload-placeholder').show();
    $clone.find('.upload-preview').hide().css('display', 'none');
    $clone.find('.preview-img').attr('src', '');
    $clone.find('.preview-name').text('');

    $('#branchWrap').append($clone);

    renumberBranches();
    updateRemoveButtons();
}

// Remove a branch block (event delegation, works for cloned blocks too)
$(document).on('click', '.remove-branch-btn', function () {
    $(this).closest('.branch-block').remove();
    renumberBranches();
    updateRemoveButtons();
});

// Icon preview (event delegation, works for cloned blocks too)
$(document).on('change', '.branch-icon-input', function () {
    const file = this.files[0];
    if (!file) return;

    const $area = $(this).closest('.upload-area');
    const reader = new FileReader();

    reader.onload = function (e) {
        $area.find('.preview-img').attr('src', e.target.result);
        $area.find('.preview-name').text(file.name);
        $area.find('.upload-placeholder').hide();
        $area.find('.upload-preview').css('display', 'flex');
    };

    reader.readAsDataURL(file);
});

// Submit spinner
$('#branchForm').on('submit', function () {
    const btn = $('#saveBtn');
    btn.prop('disabled', true);
    btn.html('<i class="fa fa-spinner fa-spin"></i> Saving...');
});
</script>