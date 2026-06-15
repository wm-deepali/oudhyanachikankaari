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
        --amber:         #916a00;
        --amber-bg:      #fff5cc;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .settings-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .settings-page * { box-sizing: border-box; }

    /* ── Page header ── */
    .page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; }
    .page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    /* ── Buttons ── */
    .btn-primary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent); color: #fff !important; border: none;
        border-radius: var(--radius-sm); padding: 9px 20px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s; box-shadow: 0 1px 3px rgba(48,61,137,.25);
    }
    .btn-primary-dash:hover { background: #252f70; }
    .btn-primary-dash:disabled { opacity: .65; cursor: not-allowed; }

    .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--surface); color: var(--text-primary) !important;
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 9px 20px; font-size: 13px; font-weight: 500; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s;
    }
    .btn-secondary-dash:hover { background: var(--bg); }

    .btn-danger-soft {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--red-bg); color: var(--red) !important;
        border: 1px solid #f5c0c0; border-radius: var(--radius-sm);
        padding: 9px 20px; font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font); transition: all .15s;
    }
    .btn-danger-soft:hover { background: var(--red); color: #fff !important; }

    /* ── Tab navigation ── */
    .tab-shell {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        overflow: hidden;
    }

    .tab-nav {
        display: flex;
        border-bottom: 1px solid var(--border);
        background: #fafafa;
        overflow-x: auto;
        scrollbar-width: none;
    }
    .tab-nav::-webkit-scrollbar { display: none; }

    .tab-btn {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 14px 22px;
        font-size: 13px; font-weight: 500;
        color: var(--text-secondary);
        border: none; background: none; cursor: pointer;
        border-bottom: 2px solid transparent;
        white-space: nowrap; font-family: var(--font);
        transition: color .15s, border-color .15s;
        position: relative;
    }
    .tab-btn i { font-size: 14px; color: var(--text-hint); transition: color .15s; }
    .tab-btn:hover { color: var(--text-primary); }
    .tab-btn:hover i { color: var(--text-secondary); }
    .tab-btn.active { color: var(--accent); border-bottom-color: var(--accent); font-weight: 600; }
    .tab-btn.active i { color: var(--accent); }

    /* ── Tab panels ── */
    .tab-panel { display: none; }
    .tab-panel.active { display: block; }

    /* ── Two-column settings layout ── */
    .settings-layout { display: grid; grid-template-columns: 220px 1fr; min-height: 600px; }
    @media(max-width:860px) { .settings-layout { grid-template-columns: 1fr; } }

    /* ── Settings sidebar (section nav within tab) ── */
    .settings-sidenav {
        border-right: 1px solid var(--border);
        padding: 20px 0;
        background: #fafafa;
    }
    .settings-sidenav-label {
        font-size: 10px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .08em; color: var(--text-hint);
        padding: 0 18px 8px; display: block;
    }
    .settings-sidenav a {
        display: flex; align-items: center; gap: 8px;
        padding: 9px 18px; font-size: 13px; font-weight: 500;
        color: var(--text-secondary); text-decoration: none;
        border-left: 2px solid transparent;
        transition: all .13s;
    }
    .settings-sidenav a i { font-size: 12px; color: var(--text-hint); width: 14px; text-align: center; }
    .settings-sidenav a:hover { color: var(--text-primary); background: rgba(48,61,137,.04); }
    .settings-sidenav a.active { color: var(--accent); border-left-color: var(--accent); background: var(--accent-light); font-weight: 600; }
    .settings-sidenav a.active i { color: var(--accent); }

    /* ── Settings content area ── */
    .settings-content { padding: 28px 32px; }
    @media(max-width:860px) { .settings-content { padding: 20px; } }

    /* ── Section block ── */
    .settings-section { margin-bottom: 36px; }
    .settings-section:last-child { margin-bottom: 0; }
    .settings-section-title {
        font-size: 14px; font-weight: 650; color: var(--text-primary);
        margin: 0 0 4px; display: flex; align-items: center; gap: 8px;
    }
    .settings-section-title i { font-size: 14px; color: var(--accent); }
    .settings-section-desc { font-size: 12.5px; color: var(--text-hint); margin: 0 0 18px; }
    .section-divider { border: none; border-top: 1px solid var(--border); margin: 28px 0; }

    /* ── Form grid ── */
    .form-grid   { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
    .col-full    { grid-column: 1 / -1; }
    @media(max-width:640px) {
        .form-grid, .form-grid-3 { grid-template-columns: 1fr; }
        .col-full { grid-column: 1; }
    }

    /* ── Field ── */
    .field-group { display: flex; flex-direction: column; gap: 6px; }
    .field-label {
        font-size: 12px; font-weight: 600; color: var(--text-secondary);
        letter-spacing: .03em; text-transform: uppercase;
    }
    .field-label .req { color: var(--red); margin-left: 2px; }
    .field-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }

    .field-input, .field-select, .field-textarea {
        width: 100%; border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 0 12px; font-size: 13.5px; color: var(--text-primary);
        background: var(--surface); outline: none;
        transition: border-color .15s, box-shadow .15s;
        font-family: var(--font);
    }
    .field-input, .field-select { height: 38px; }
    .field-textarea { padding: 10px 12px; resize: vertical; min-height: 90px; }
    .field-input:focus, .field-select:focus, .field-textarea:focus {
        border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12);
    }
    .field-input[readonly] { background: var(--bg); color: var(--text-secondary); cursor: not-allowed; }
    .field-input.monospace { font-family: 'SF Mono','Fira Mono',monospace; font-size: 13px; letter-spacing: .02em; }

    /* Input with prefix */
    .input-wrap { display: flex; }
    .input-prefix {
        display: inline-flex; align-items: center; padding: 0 12px;
        background: var(--bg); border: 1px solid var(--border); border-right: none;
        border-radius: var(--radius-sm) 0 0 var(--radius-sm);
        font-size: 12.5px; color: var(--text-hint); white-space: nowrap; flex-shrink: 0;
    }
    .input-wrap .field-input { border-radius: 0 var(--radius-sm) var(--radius-sm) 0; }

    /* ── Toggle switch ── */
    .toggle-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 13px 0; border-bottom: 1px solid var(--bg);
    }
    .toggle-row:last-child { border-bottom: none; padding-bottom: 0; }
    .toggle-row:first-child { padding-top: 0; }
    .toggle-info-label { font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .toggle-info-sub   { font-size: 12px; color: var(--text-hint); margin-top: 2px; }
    .toggle-switch { position: relative; width: 38px; height: 22px; flex-shrink: 0; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-track { position: absolute; inset: 0; background: var(--border); border-radius: 22px; cursor: pointer; transition: background .2s; }
    .toggle-track::after { content:''; position:absolute; left:3px; top:3px; width:16px; height:16px; background:#fff; border-radius:50%; transition:transform .2s; box-shadow:0 1px 3px rgba(0,0,0,.2); }
    .toggle-switch input:checked + .toggle-track { background: var(--accent); }
    .toggle-switch input:checked + .toggle-track::after { transform: translateX(16px); }

    /* ── Upload area ── */
    .upload-area {
        border: 2px dashed var(--border); border-radius: var(--radius-sm);
        padding: 22px 20px; text-align: center; cursor: pointer;
        transition: border-color .15s, background .15s; position: relative;
    }
    .upload-area:hover { border-color: var(--accent); background: var(--accent-light); }
    .upload-area input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .upload-icon  { font-size: 22px; color: var(--text-hint); margin-bottom: 6px; }
    .upload-label { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .upload-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }

    /* ── Info / warning banners ── */
    .info-banner {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 14px 16px; border-radius: var(--radius-sm);
        margin-bottom: 20px; font-size: 13px;
    }
    .info-banner i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }
    .info-banner.blue  { background: #e8f2ff; border: 1px solid #b8d4f5; color: #0069d9; }
    .info-banner.amber { background: var(--amber-bg); border: 1px solid #f0d060; color: var(--amber); }
    .info-banner.green { background: var(--green-bg); border: 1px solid #b0ddd0; color: var(--green); }

    /* ── API key box ── */
    .api-key-card {
        background: #fafafa; border: 1px solid var(--border);
        border-radius: var(--radius-sm); padding: 16px;
        margin-bottom: 16px;
    }
    .api-key-card-title { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--text-hint); margin-bottom: 10px; }

    /* ── Razorpay branding strip ── */
    .razorpay-header {
        display: flex; align-items: center; gap: 12px;
        background: linear-gradient(135deg, #072654 0%, #0d3f8f 100%);
        border-radius: var(--radius-sm); padding: 16px 20px; margin-bottom: 20px;
    }
    .razorpay-logo { width: 44px; height: 44px; border-radius: 8px; background: #fff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .razorpay-logo i { font-size: 22px; color: #072654; }
    .razorpay-name { font-size: 16px; font-weight: 700; color: #fff; }
    .razorpay-desc { font-size: 12px; color: rgba(255,255,255,.7); margin-top: 2px; }

    /* ── GST invoice preview strip ── */
    .invoice-preview-bar {
        background: linear-gradient(90deg, #303d89 0%, #4f5db3 100%);
        border-radius: var(--radius-sm); padding: 14px 18px; margin-bottom: 24px;
        display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;
    }
    .invoice-preview-bar span { font-size: 13px; color: rgba(255,255,255,.85); display: flex; align-items: center; gap: 7px; }
    .invoice-preview-bar span strong { color: #fff; }

    /* ── Serial number preview ── */
    .serial-preview {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent-light); border: 1px solid rgba(48,61,137,.2);
        border-radius: var(--radius-sm); padding: 8px 14px; margin-top: 10px;
    }
    .serial-preview-label { font-size: 12px; color: var(--text-hint); }
    .serial-preview-value { font-size: 14px; font-weight: 700; color: var(--accent); font-family: 'SF Mono','Fira Mono',monospace; }

    /* ── Action bar (bottom) ── */
    .action-bar {
        display: flex; align-items: center; justify-content: flex-end; gap: 10px;
        padding: 18px 32px; border-top: 1px solid var(--border);
        background: #fafafa;
    }
    @media(max-width:860px) { .action-bar { padding: 14px 20px; } }

    /* ── Test connection button ── */
    .btn-test {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--amber-bg); color: var(--amber) !important;
        border: 1px solid #f0d060; border-radius: var(--radius-sm);
        padding: 9px 18px; font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font); transition: all .15s;
    }
    .btn-test:hover { background: var(--amber); color: #fff !important; }

    /* ── Mode pill ── */
    .mode-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 700;
    }
    .mode-pill::before { content:''; width:6px; height:6px; border-radius:50%; }
    .mode-test { background: var(--amber-bg); color: var(--amber); }
    .mode-test::before { background: var(--amber); }
    .mode-live { background: var(--green-bg); color: var(--green); }
    .mode-live::before { background: var(--green); }

    @media(max-width:768px) { .settings-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="settings-page">

            <!-- Page header -->
            <div class="page-header">
                <div>
                    <h1>Admin Settings</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Admin Settings
                    </div>
                </div>
            </div>

            <!-- Tab shell -->
            <div class="tab-shell">

                <!-- Tab navigation -->
                <div class="tab-nav">
                    <button class="tab-btn active" onclick="switchTab('general', this)">
                        <i class="fa-solid fa-sliders"></i> General Settings
                    </button>
                    <button class="tab-btn" onclick="switchTab('smtp', this)">
                        <i class="fa-solid fa-envelope"></i> SMTP / Email
                    </button>
                    <button class="tab-btn" onclick="switchTab('payment', this)">
                        <i class="fa-solid fa-credit-card"></i> Payment Gateway
                    </button>
                    <button class="tab-btn" onclick="switchTab('gst', this)">
                        <i class="fa-solid fa-file-invoice"></i> GST &amp; Invoice
                    </button>
                </div>

                <!-- ══════════════════════════════════
                     TAB 1 — GENERAL SETTINGS
                ══════════════════════════════════ -->
                <div class="tab-panel active" id="tab-general">
                    <div class="settings-layout">

                        <!-- Section nav -->
                        <div class="settings-sidenav">
                            <span class="settings-sidenav-label">Sections</span>
                            <a href="#gs-site" class="active"><i class="fa-solid fa-globe"></i> Site Identity</a>
                            <a href="#gs-contact"><i class="fa-solid fa-phone"></i> Contact Info</a>
                            <a href="#gs-regional"><i class="fa-solid fa-map-pin"></i> Regional</a>
                            <a href="#gs-security"><i class="fa-solid fa-shield"></i> Security</a>
                            <a href="#gs-misc"><i class="fa-solid fa-toggle-on"></i> Features</a>
                        </div>

                        <!-- Content -->
                        <div class="settings-content">

                            <!-- Site Identity -->
                            <div class="settings-section" id="gs-site">
                                <div class="settings-section-title"><i class="fa-solid fa-globe"></i> Site Identity</div>
                                <p class="settings-section-desc">Basic information about your store shown to customers and used across the admin panel.</p>

                                <div class="form-grid">
                                    <div class="field-group col-full">
                                        <label class="field-label">Site / Store Name <span class="req">*</span></label>
                                        <input type="text" class="field-input" value="Oudhyana Chikankari" placeholder="Your store name">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Tagline</label>
                                        <input type="text" class="field-input" placeholder="e.g. Authentic Lucknowi Chikankari">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Site Logo</label>
                                        <div class="upload-area">
                                            <input type="file" accept="image/*">
                                            <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                            <div class="upload-label">Upload Logo</div>
                                            <div class="upload-sub">PNG, SVG · recommended 200×60px</div>
                                        </div>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Favicon</label>
                                        <div class="upload-area">
                                            <input type="file" accept="image/*">
                                            <div class="upload-icon"><i class="fa fa-image"></i></div>
                                            <div class="upload-label">Upload Favicon</div>
                                            <div class="upload-sub">ICO, PNG · 32×32px</div>
                                        </div>
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Site URL</label>
                                        <div class="input-wrap">
                                            <span class="input-prefix">https://</span>
                                            <input type="text" class="field-input" value="oudhyanachikankaari.com">
                                        </div>
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Admin Email</label>
                                        <input type="email" class="field-input" value="admin@oudhyanachikankaari.com">
                                        <span class="field-hint">Used for system notifications and order alerts.</span>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Contact Info -->
                            <div class="settings-section" id="gs-contact">
                                <div class="settings-section-title"><i class="fa-solid fa-phone"></i> Contact Info</div>
                                <p class="settings-section-desc">Displayed on invoices, emails, and the storefront footer.</p>

                                <div class="form-grid">
                                    <div class="field-group">
                                        <label class="field-label">Phone Number</label>
                                        <input type="text" class="field-input" placeholder="+91 98765 43210">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">WhatsApp Number</label>
                                        <input type="text" class="field-input" placeholder="+91 98765 43210">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Support Email</label>
                                        <input type="email" class="field-input" placeholder="support@yourdomain.com">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Business Address</label>
                                        <textarea class="field-textarea" rows="3" placeholder="Full registered address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Regional -->
                            <div class="settings-section" id="gs-regional">
                                <div class="settings-section-title"><i class="fa-solid fa-map-pin"></i> Regional Settings</div>
                                <p class="settings-section-desc">Currency, timezone and date format used across the panel and storefront.</p>

                                <div class="form-grid">
                                    <div class="field-group">
                                        <label class="field-label">Currency</label>
                                        <select class="field-select">
                                            <option selected>INR — Indian Rupee (₹)</option>
                                            <option>USD — US Dollar ($)</option>
                                            <option>EUR — Euro (€)</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Currency Symbol</label>
                                        <input type="text" class="field-input" value="₹">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Timezone</label>
                                        <select class="field-select">
                                            <option selected>Asia/Kolkata (IST +5:30)</option>
                                            <option>UTC</option>
                                            <option>America/New_York</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Date Format</label>
                                        <select class="field-select">
                                            <option>DD/MM/YYYY</option>
                                            <option>MM/DD/YYYY</option>
                                            <option selected>D MMM YYYY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Security -->
                            <div class="settings-section" id="gs-security">
                                <div class="settings-section-title"><i class="fa-solid fa-shield"></i> Security</div>
                                <p class="settings-section-desc">Control admin panel access and session behaviour.</p>

                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Maintenance Mode</div>
                                        <div class="toggle-info-sub">Take the storefront offline for visitors while you work.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox"><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Force HTTPS</div>
                                        <div class="toggle-info-sub">Redirect all HTTP traffic to HTTPS automatically.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Admin Session Timeout</div>
                                        <div class="toggle-info-sub">Auto-logout after inactivity (minutes).</div>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <input type="number" class="field-input" value="60" style="width:80px;height:32px;font-size:13px">
                                        <span style="font-size:12.5px;color:var(--text-hint)">min</span>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Feature Toggles -->
                            <div class="settings-section" id="gs-misc">
                                <div class="settings-section-title"><i class="fa-solid fa-toggle-on"></i> Store Features</div>
                                <p class="settings-section-desc">Enable or disable core storefront features.</p>

                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Customer Registration</div>
                                        <div class="toggle-info-sub">Allow new customers to create accounts.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Guest Checkout</div>
                                        <div class="toggle-info-sub">Let customers order without registering.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Product Reviews</div>
                                        <div class="toggle-info-sub">Show customer reviews on product pages.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Wishlist</div>
                                        <div class="toggle-info-sub">Allow customers to save products to a wishlist.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Stock Alerts to Customers</div>
                                        <div class="toggle-info-sub">Email customers when out-of-stock items are restocked.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox"><span class="toggle-track"></span></label>
                                </div>
                            </div>

                        </div><!-- /settings-content -->
                    </div><!-- /settings-layout -->

                    <div class="action-bar">
                        <button class="btn-secondary-dash">Discard Changes</button>
                        <button class="btn-primary-dash" onclick="saveSettings(this)">
                            <i class="fa fa-save"></i> Save General Settings
                        </button>
                    </div>
                </div><!-- /tab-general -->

                <!-- ══════════════════════════════════
                     TAB 2 — SMTP / EMAIL
                ══════════════════════════════════ -->
                <div class="tab-panel" id="tab-smtp">
                    <div class="settings-layout">

                        <div class="settings-sidenav">
                            <span class="settings-sidenav-label">Sections</span>
                            <a href="#smtp-config" class="active"><i class="fa-solid fa-server"></i> SMTP Config</a>
                            <a href="#smtp-sender"><i class="fa-solid fa-user"></i> Sender Details</a>
                            <a href="#smtp-templates"><i class="fa-solid fa-envelope-open-text"></i> Email Events</a>
                        </div>

                        <div class="settings-content">

                            <div class="info-banner blue">
                                <i class="fa-solid fa-circle-info"></i>
                                <div>Configure your SMTP credentials to send order confirmations, OTPs, and notification emails through your own mail server.</div>
                            </div>

                            <!-- SMTP Config -->
                            <div class="settings-section" id="smtp-config">
                                <div class="settings-section-title"><i class="fa-solid fa-server"></i> SMTP Configuration</div>
                                <p class="settings-section-desc">Enter your mail server credentials. Works with Gmail, Mailgun, SendGrid, and any SMTP provider.</p>

                                <div class="form-grid">
                                    <div class="field-group col-full">
                                        <label class="field-label">Mailer Driver</label>
                                        <select class="field-select">
                                            <option selected>SMTP</option>
                                            <option>Mailgun</option>
                                            <option>SendGrid</option>
                                            <option>SES (Amazon)</option>
                                            <option>Log (testing only)</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">SMTP Host <span class="req">*</span></label>
                                        <input type="text" class="field-input" placeholder="smtp.gmail.com">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">SMTP Port <span class="req">*</span></label>
                                        <select class="field-select">
                                            <option>465 (SSL)</option>
                                            <option selected>587 (TLS)</option>
                                            <option>25</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">SMTP Username <span class="req">*</span></label>
                                        <input type="email" class="field-input" placeholder="your@gmail.com">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">SMTP Password <span class="req">*</span></label>
                                        <div class="input-wrap">
                                            <input type="password" class="field-input" id="smtpPass" placeholder="App password or SMTP password">
                                            <button type="button" onclick="togglePass('smtpPass', this)" style="border:1px solid var(--border);border-left:none;border-radius:0 var(--radius-sm) var(--radius-sm) 0;background:var(--bg);padding:0 12px;cursor:pointer;color:var(--text-hint);flex-shrink:0"><i class="fa fa-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Encryption</label>
                                        <select class="field-select">
                                            <option selected>TLS</option>
                                            <option>SSL</option>
                                            <option>None</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Sender Details -->
                            <div class="settings-section" id="smtp-sender">
                                <div class="settings-section-title"><i class="fa-solid fa-user"></i> Sender Details</div>
                                <p class="settings-section-desc">The name and address your customers see in their inbox.</p>

                                <div class="form-grid">
                                    <div class="field-group">
                                        <label class="field-label">From Name</label>
                                        <input type="text" class="field-input" placeholder="Oudhyana Chikankari">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">From Email</label>
                                        <input type="email" class="field-input" placeholder="noreply@oudhyana.com">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Reply-To Name</label>
                                        <input type="text" class="field-input" placeholder="Support Team">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Reply-To Email</label>
                                        <input type="email" class="field-input" placeholder="support@oudhyana.com">
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Email Events -->
                            <div class="settings-section" id="smtp-templates">
                                <div class="settings-section-title"><i class="fa-solid fa-envelope-open-text"></i> Email Notification Events</div>
                                <p class="settings-section-desc">Choose which events trigger an email to the customer or admin.</p>

                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Order Confirmation</div>
                                        <div class="toggle-info-sub">Email customer when order is placed successfully.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Order Shipped</div>
                                        <div class="toggle-info-sub">Send tracking details when order is dispatched.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Order Delivered</div>
                                        <div class="toggle-info-sub">Notify customer on delivery confirmation.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Password Reset</div>
                                        <div class="toggle-info-sub">Send password reset link when requested.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">New Order Alert (Admin)</div>
                                        <div class="toggle-info-sub">Notify admin email on every new order.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Low Stock Alert (Admin)</div>
                                        <div class="toggle-info-sub">Notify admin when stock falls below threshold.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox"><span class="toggle-track"></span></label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="action-bar">
                        <button class="btn-test" onclick="testSmtp(this)">
                            <i class="fa fa-paper-plane"></i> Send Test Email
                        </button>
                        <button class="btn-secondary-dash">Discard Changes</button>
                        <button class="btn-primary-dash" onclick="saveSettings(this)">
                            <i class="fa fa-save"></i> Save SMTP Settings
                        </button>
                    </div>
                </div><!-- /tab-smtp -->

                <!-- ══════════════════════════════════
                     TAB 3 — PAYMENT GATEWAY
                ══════════════════════════════════ -->
                <div class="tab-panel" id="tab-payment">
                    <div class="settings-content" style="max-width:720px">

                        <!-- Razorpay header card -->
                        <div class="razorpay-header">
                            <div class="razorpay-logo">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div>
                                <div class="razorpay-name">Razorpay</div>
                                <div class="razorpay-desc">India's leading payment gateway — UPI, Cards, Net Banking, Wallets &amp; EMI</div>
                            </div>
                            <div style="margin-left:auto">
                                <span class="mode-pill mode-test" id="modePill">Test Mode</span>
                            </div>
                        </div>

                        <!-- Mode toggle -->
                        <div class="info-banner amber">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <div>You are currently in <strong>Test Mode</strong>. Payments will not be captured. Switch to Live Mode only when you are ready to accept real payments.</div>
                        </div>

                        <div class="settings-section">
                            <div class="settings-section-title"><i class="fa-solid fa-toggle-on"></i> Mode</div>
                            <div class="toggle-row" style="padding:14px 0">
                                <div>
                                    <div class="toggle-info-label">Live Mode</div>
                                    <div class="toggle-info-sub">Toggle ON to accept real payments from customers.</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="liveToggle" onchange="toggleMode(this)">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Test Keys -->
                        <div class="settings-section" id="rp-test">
                            <div class="settings-section-title"><i class="fa-solid fa-flask"></i> Test API Keys</div>
                            <p class="settings-section-desc">Use these keys in development. No real money is processed.</p>

                            <div class="api-key-card">
                                <div class="api-key-card-title">Test Key ID</div>
                                <div class="input-wrap">
                                    <span class="input-prefix"><i class="fa fa-key"></i></span>
                                    <input type="text" class="field-input monospace" placeholder="rzp_test_XXXXXXXXXXXX">
                                </div>
                            </div>
                            <div class="api-key-card">
                                <div class="api-key-card-title">Test Key Secret</div>
                                <div class="input-wrap">
                                    <span class="input-prefix"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="field-input monospace" id="testSecret" placeholder="••••••••••••••••••••">
                                    <button type="button" onclick="togglePass('testSecret', this)" style="border:1px solid var(--border);border-left:none;border-radius:0 var(--radius-sm) var(--radius-sm) 0;background:var(--bg);padding:0 12px;cursor:pointer;color:var(--text-hint);flex-shrink:0"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Live Keys -->
                        <div class="settings-section" id="rp-live">
                            <div class="settings-section-title"><i class="fa-solid fa-circle-check"></i> Live API Keys</div>
                            <p class="settings-section-desc">Enter your production keys from the Razorpay Dashboard. Keep these secret.</p>

                            <div class="api-key-card">
                                <div class="api-key-card-title">Live Key ID</div>
                                <div class="input-wrap">
                                    <span class="input-prefix"><i class="fa fa-key"></i></span>
                                    <input type="text" class="field-input monospace" placeholder="rzp_live_XXXXXXXXXXXX">
                                </div>
                            </div>
                            <div class="api-key-card">
                                <div class="api-key-card-title">Live Key Secret</div>
                                <div class="input-wrap">
                                    <span class="input-prefix"><i class="fa fa-lock"></i></span>
                                    <input type="password" class="field-input monospace" id="liveSecret" placeholder="••••••••••••••••••••">
                                    <button type="button" onclick="togglePass('liveSecret', this)" style="border:1px solid var(--border);border-left:none;border-radius:0 var(--radius-sm) var(--radius-sm) 0;background:var(--bg);padding:0 12px;cursor:pointer;color:var(--text-hint);flex-shrink:0"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </div>

                        <hr class="section-divider">

                        <!-- Payment Methods -->
                        <div class="settings-section">
                            <div class="settings-section-title"><i class="fa-solid fa-wallet"></i> Accepted Payment Methods</div>
                            <p class="settings-section-desc">Choose which methods appear on the checkout page.</p>

                            <div class="toggle-row">
                                <div><div class="toggle-info-label">UPI (PhonePe, GPay, Paytm)</div><div class="toggle-info-sub">Fastest payment method in India.</div></div>
                                <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div><div class="toggle-info-label">Credit / Debit Cards</div><div class="toggle-info-sub">Visa, Mastercard, RuPay.</div></div>
                                <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div><div class="toggle-info-label">Net Banking</div><div class="toggle-info-sub">All major Indian banks.</div></div>
                                <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div><div class="toggle-info-label">EMI</div><div class="toggle-info-sub">No-cost EMI on eligible cards.</div></div>
                                <label class="toggle-switch"><input type="checkbox"><span class="toggle-track"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div><div class="toggle-info-label">Wallets (Paytm, Mobikwik)</div><div class="toggle-info-sub">Digital wallet payments.</div></div>
                                <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                            </div>
                            <div class="toggle-row">
                                <div><div class="toggle-info-label">Cash on Delivery (COD)</div><div class="toggle-info-sub">Handled separately outside Razorpay.</div></div>
                                <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                            </div>
                        </div>

                    </div>

                    <div class="action-bar">
                        <button class="btn-secondary-dash">Discard Changes</button>
                        <button class="btn-primary-dash" onclick="saveSettings(this)">
                            <i class="fa fa-save"></i> Save Payment Settings
                        </button>
                    </div>
                </div><!-- /tab-payment -->

                <!-- ══════════════════════════════════
                     TAB 4 — GST & INVOICE
                ══════════════════════════════════ -->
                <div class="tab-panel" id="tab-gst">
                    <div class="settings-layout">

                        <div class="settings-sidenav">
                            <span class="settings-sidenav-label">Sections</span>
                            <a href="#inv-header" class="active"><i class="fa-solid fa-building"></i> Invoice Header</a>
                            <a href="#inv-tax"><i class="fa-solid fa-percent"></i> Tax (GST)</a>
                            <a href="#inv-settings"><i class="fa-solid fa-sliders"></i> Invoice Settings</a>
                        </div>

                        <div class="settings-content">

                            <div class="invoice-preview-bar">
                                <span><i class="fa-solid fa-file-invoice" style="color:rgba(255,255,255,.7)"></i> Invoice preview will reflect these settings in real time.</span>
                                <button class="btn-secondary-dash" style="padding:6px 14px;font-size:12.5px">
                                    <i class="fa fa-eye"></i> Preview Invoice
                                </button>
                            </div>

                            <!-- Invoice Header -->
                            <div class="settings-section" id="inv-header">
                                <div class="settings-section-title"><i class="fa-solid fa-building"></i> Invoice Header</div>
                                <p class="settings-section-desc">This information appears at the top of every invoice sent to customers.</p>

                                <div class="form-grid">
                                    <div class="field-group col-full">
                                        <label class="field-label">Company Name <span class="req">*</span></label>
                                        <input type="text" class="field-input" placeholder="e.g. Oudhyana Chikankari Pvt. Ltd." value="Oudhyana Chikankari">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Company Logo</label>
                                        <div class="upload-area">
                                            <input type="file" accept="image/*">
                                            <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                            <div class="upload-label">Upload Invoice Logo</div>
                                            <div class="upload-sub">PNG, JPG · recommended 300×80px, will appear on PDF invoices</div>
                                        </div>
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Full Registered Address <span class="req">*</span></label>
                                        <textarea class="field-textarea" rows="3" placeholder="House / Building No., Street, Area"></textarea>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">City <span class="req">*</span></label>
                                        <input type="text" class="field-input" placeholder="e.g. Lucknow">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">State <span class="req">*</span></label>
                                        <select class="field-select">
                                            <option value="">Select State</option>
                                            <option selected>Uttar Pradesh</option>
                                            <option>Maharashtra</option>
                                            <option>Delhi</option>
                                            <option>Karnataka</option>
                                            <option>Tamil Nadu</option>
                                            <option>Gujarat</option>
                                            <option>Rajasthan</option>
                                            <option>West Bengal</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Pin Code <span class="req">*</span></label>
                                        <input type="text" class="field-input" placeholder="226001" maxlength="6">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Country</label>
                                        <input type="text" class="field-input" value="India" readonly>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">GST Number (GSTIN) <span class="req">*</span></label>
                                        <input type="text" class="field-input monospace" placeholder="22AAAAA0000A1Z5" maxlength="15">
                                        <span class="field-hint">15-character GST Identification Number.</span>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">PAN Number <span class="req">*</span></label>
                                        <input type="text" class="field-input monospace" placeholder="AAAAA0000A" maxlength="10">
                                        <span class="field-hint">10-character Permanent Account Number.</span>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Contact Phone</label>
                                        <input type="text" class="field-input" placeholder="+91 98765 43210">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Contact Email</label>
                                        <input type="email" class="field-input" placeholder="billing@oudhyana.com">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Invoice Footer Note</label>
                                        <textarea class="field-textarea" rows="2" placeholder="e.g. Thank you for shopping with us! For queries contact support@oudhyana.com"></textarea>
                                        <span class="field-hint">Appears at the bottom of every invoice.</span>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Tax / GST -->
                            <div class="settings-section" id="inv-tax">
                                <div class="settings-section-title"><i class="fa-solid fa-percent"></i> Tax / GST Settings</div>
                                <p class="settings-section-desc">Define how GST is applied to orders and displayed on invoices.</p>

                                <div class="form-grid">
                                    <div class="field-group">
                                        <label class="field-label">Default GST Rate (%)</label>
                                        <select class="field-select">
                                            <option>0% — Exempt</option>
                                            <option>5%</option>
                                            <option selected>12%</option>
                                            <option>18%</option>
                                            <option>28%</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Tax Inclusive / Exclusive</label>
                                        <select class="field-select">
                                            <option selected>Tax Inclusive (prices include GST)</option>
                                            <option>Tax Exclusive (GST added on checkout)</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">State Code (for GST)</label>
                                        <input type="text" class="field-input monospace" placeholder="09" value="09">
                                        <span class="field-hint">Uttar Pradesh = 09</span>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Business Type</label>
                                        <select class="field-select">
                                            <option selected>Regular Taxpayer</option>
                                            <option>Composition Scheme</option>
                                            <option>Unregistered</option>
                                        </select>
                                    </div>
                                </div>

                                <div style="margin-top:16px">
                                    <div class="toggle-row">
                                        <div><div class="toggle-info-label">Show GST Breakup on Invoice</div><div class="toggle-info-sub">Display CGST + SGST / IGST split separately.</div></div>
                                        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                    </div>
                                    <div class="toggle-row">
                                        <div><div class="toggle-info-label">Reverse Charge Applicable</div><div class="toggle-info-sub">Mark applicable for B2B reverse charge transactions.</div></div>
                                        <label class="toggle-switch"><input type="checkbox"><span class="toggle-track"></span></label>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Invoice Settings -->
                            <div class="settings-section" id="inv-settings">
                                <div class="settings-section-title"><i class="fa-solid fa-sliders"></i> Invoice Settings</div>
                                <p class="settings-section-desc">Control how invoice numbers are generated and formatted.</p>

                                <div class="form-grid">
                                    <div class="field-group">
                                        <label class="field-label">Invoice Prefix <span class="req">*</span></label>
                                        <input type="text" class="field-input monospace" id="invPrefix" value="OC" placeholder="e.g. INV, OC, GST" oninput="updatePreview()">
                                        <span class="field-hint">Short code prefixed to every invoice number.</span>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Starting Serial Number <span class="req">*</span></label>
                                        <input type="number" class="field-input monospace" id="invSerial" value="1001" min="1" oninput="updatePreview()">
                                        <span class="field-hint">Next invoice will use this number.</span>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Year in Invoice No.</label>
                                        <select class="field-select" id="invYear" onchange="updatePreview()">
                                            <option value="none">None</option>
                                            <option value="slash" selected>FY Slash (2025-26)</option>
                                            <option value="year">Year Only (2025)</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Separator</label>
                                        <select class="field-select" id="invSep" onchange="updatePreview()">
                                            <option value="/">/</option>
                                            <option value="-" selected>-</option>
                                            <option value="#">#</option>
                                        </select>
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Preview</label>
                                        <div class="serial-preview">
                                            <span class="serial-preview-label">Next invoice:</span>
                                            <span class="serial-preview-value" id="serialPreview">OC-2025-26-1001</span>
                                        </div>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Invoice Date Format</label>
                                        <select class="field-select">
                                            <option>DD/MM/YYYY</option>
                                            <option selected>D MMM YYYY</option>
                                            <option>MM-DD-YYYY</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Payment Terms (Days)</label>
                                        <input type="number" class="field-input" value="0" min="0">
                                        <span class="field-hint">0 = due immediately. Set 30 for Net-30 etc.</span>
                                    </div>
                                </div>

                                <div style="margin-top:20px">
                                    <div class="toggle-row">
                                        <div><div class="toggle-info-label">Auto-generate Invoice on Order</div><div class="toggle-info-sub">Automatically create invoice when order is placed.</div></div>
                                        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                    </div>
                                    <div class="toggle-row">
                                        <div><div class="toggle-info-label">Email Invoice to Customer</div><div class="toggle-info-sub">Attach PDF invoice to the order confirmation email.</div></div>
                                        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                    </div>
                                    <div class="toggle-row">
                                        <div><div class="toggle-info-label">Show Signature Line</div><div class="toggle-info-sub">Print "Authorised Signatory" line at invoice bottom.</div></div>
                                        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="action-bar">
                        <button class="btn-secondary-dash">Discard Changes</button>
                        <button class="btn-primary-dash" onclick="saveSettings(this)">
                            <i class="fa fa-save"></i> Save GST &amp; Invoice Settings
                        </button>
                    </div>
                </div><!-- /tab-gst -->

            </div><!-- /tab-shell -->

        </div>
    </div>
</div>

@include('admin.footer')

<script>
// ── Tab switching ──
function switchTab(name, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('tab-' + name).classList.add('active');
}

// ── Save feedback ──
function saveSettings(btn) {
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving…';
    setTimeout(() => {
        btn.innerHTML = '<i class="fa fa-check"></i> Saved!';
        btn.style.background = '#007a5e';
        setTimeout(() => {
            btn.innerHTML = orig;
            btn.style.background = '';
            btn.disabled = false;
        }, 2000);
    }, 800);
}

// ── SMTP test email ──
function testSmtp(btn) {
    const orig = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Sending…';
    setTimeout(() => {
        btn.innerHTML = '<i class="fa fa-check"></i> Test sent!';
        btn.style.background = '#007a5e';
        btn.style.color = '#fff';
        btn.style.borderColor = '#007a5e';
        setTimeout(() => {
            btn.innerHTML = orig;
            btn.style.background = '';
            btn.style.color = '';
            btn.style.borderColor = '';
            btn.disabled = false;
        }, 2500);
    }, 1000);
}

// ── Toggle password visibility ──
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const isPass = input.type === 'password';
    input.type = isPass ? 'text' : 'password';
    btn.querySelector('i').className = isPass ? 'fa fa-eye-slash' : 'fa fa-eye';
}

// ── Razorpay mode toggle ──
function toggleMode(checkbox) {
    const pill = document.getElementById('modePill');
    if (checkbox.checked) {
        pill.textContent = 'Live Mode';
        pill.className = 'mode-pill mode-live';
    } else {
        pill.textContent = 'Test Mode';
        pill.className = 'mode-pill mode-test';
    }
}

// ── Invoice number preview ──
function updatePreview() {
    const prefix = document.getElementById('invPrefix').value || 'INV';
    const serial = document.getElementById('invSerial').value || '1001';
    const yearMode = document.getElementById('invYear').value;
    const sep = document.getElementById('invSep').value;

    const now = new Date();
    const y = now.getFullYear();
    const nextY = (y + 1).toString().slice(-2);

    let yearPart = '';
    if (yearMode === 'slash')  yearPart = `${y}-${nextY}`;
    if (yearMode === 'year')   yearPart = `${y}`;

    const parts = [prefix];
    if (yearPart) parts.push(yearPart);
    parts.push(serial);

    document.getElementById('serialPreview').textContent = parts.join(sep);
}

// Init preview on load
updatePreview();

// ── Section sidenav smooth scroll ──
document.querySelectorAll('.settings-sidenav a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        this.closest('.settings-sidenav').querySelectorAll('a').forEach(a => a.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>