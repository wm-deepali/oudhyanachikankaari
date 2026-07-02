@include('admin.top-header')
<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --sp-bg: #f1f2f4; --sp-surface: #ffffff; --sp-border: #e3e5e8; --sp-border-hover: #c9cccf;
        --sp-text-primary: #202223; --sp-text-secondary: #6d7175; --sp-text-hint: #8c9196;
        --sp-accent: #303d89; --sp-accent-hover: #2a3579; --sp-accent-light: #eef0fc;
        --sp-green: #007a5e; --sp-green-bg: #e3f1ec; --sp-green-border: #9fcfc3;
        --sp-red: #c0392b; --sp-red-bg: #fce8e8; --sp-red-border: #f5c6c6;
        --sp-amber: #916a00; --sp-amber-bg: #fff5cc; --sp-amber-border: #e8d080;
        --sp-blue: #0069d9; --sp-blue-bg: #e8f2ff;
        --sp-radius-sm: 6px; --sp-radius-md: 8px; --sp-radius-lg: 12px;
        --sp-shadow-card: 0 1px 0 rgba(0,0,0,.05), 0 0 0 1px rgba(0,0,0,.07);
        --sp-font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .sp-page { background: var(--sp-bg); padding: 24px 28px; min-height: 100vh; font-family: var(--sp-font); color: var(--sp-text-primary); font-size: 14px; }
    .sp-page * { box-sizing: border-box; }

    /* ── Page header ── */
    .sp-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .sp-page-title  { font-size: 20px; font-weight: 660; margin: 0 0 4px; letter-spacing: -.2px; }
    .sp-crumb { font-size: 12.5px; color: var(--sp-text-hint); display: flex; align-items: center; gap: 4px; flex-wrap: wrap; }
    .sp-crumb a { color: var(--sp-accent); text-decoration: none; }
    .sp-crumb a:hover { text-decoration: underline; }

    /* ── Buttons ── */
    .sp-btn-primary { display: inline-flex; align-items: center; gap: 6px; background: var(--sp-accent); color: #fff; border: 1px solid transparent; border-radius: var(--sp-radius-md); padding: 8px 16px; font-size: 13.5px; font-weight: 580; font-family: var(--sp-font); cursor: pointer; text-decoration: none; line-height: 1.4; transition: background .15s; white-space: nowrap; }
    .sp-btn-primary:hover { background: var(--sp-accent-hover); color: #fff; }
    .sp-btn-secondary { display: inline-flex; align-items: center; gap: 6px; background: var(--sp-surface); color: var(--sp-text-primary); border: 1px solid var(--sp-border); border-radius: var(--sp-radius-md); padding: 8px 14px; font-size: 13px; font-weight: 540; font-family: var(--sp-font); cursor: pointer; text-decoration: none; line-height: 1.4; transition: all .15s; white-space: nowrap; }
    .sp-btn-secondary:hover { background: var(--sp-bg); border-color: var(--sp-border-hover); }
    .sp-btn-danger { display: inline-flex; align-items: center; gap: 6px; background: var(--sp-surface); color: var(--sp-red); border: 1px solid var(--sp-red-border); border-radius: var(--sp-radius-md); padding: 8px 14px; font-size: 13px; font-weight: 540; font-family: var(--sp-font); cursor: pointer; transition: all .15s; white-space: nowrap; }
    .sp-btn-danger:hover { background: var(--sp-red-bg); }

    /* ── Info banner ── */
    .sp-banner { display: flex; align-items: flex-start; gap: 12px; padding: 14px 16px; border-radius: var(--sp-radius-md); margin-bottom: 20px; font-size: 13px; }
    .sp-banner i { font-size: 15px; flex-shrink: 0; margin-top: 1px; }
    .sp-banner.blue  { background: var(--sp-blue-bg);   border: 1px solid #b8d4f5; color: var(--sp-blue); }
    .sp-banner.amber { background: var(--sp-amber-bg);  border: 1px solid var(--sp-amber-border); color: var(--sp-amber); }

    /* ── Layout ── */
    .sp-layout { display: grid; grid-template-columns: 1fr 280px; gap: 20px; align-items: start; }
    @media(max-width:960px) { .sp-layout { grid-template-columns: 1fr; } }

    /* ── Cards ── */
    .sp-card { background: var(--sp-surface); border-radius: var(--sp-radius-lg); box-shadow: var(--sp-shadow-card); border: 1px solid var(--sp-border); overflow: hidden; margin-bottom: 16px; }
    .sp-card:last-child { margin-bottom: 0; }
    .sp-card-header { padding: 13px 20px; border-bottom: 1px solid var(--sp-border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .sp-card-header h5 { font-size: 13px; font-weight: 650; color: var(--sp-text-primary); margin: 0; }
    .sp-card-body { padding: 20px 24px; }
    .sp-card-body-sm { padding: 14px 20px; }

    /* ── Add redirect form ── */
    .sp-redirect-form { display: grid; grid-template-columns: 1fr 1fr 130px 44px; gap: 10px; align-items: end; padding: 16px 20px; border-bottom: 1px solid var(--sp-border); background: #f9fafb; }
    @media(max-width:700px) { .sp-redirect-form { grid-template-columns: 1fr 1fr; } }
    .sp-field { display: flex; flex-direction: column; gap: 5px; }
    .sp-label { font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--sp-text-hint); }
    .sp-input, .sp-select { width: 100%; border: 1px solid var(--sp-border); border-radius: var(--sp-radius-md); padding: 0 10px; height: 36px; font-size: 13px; color: var(--sp-text-primary); background: var(--sp-surface); outline: none; font-family: var(--sp-font); transition: border-color .15s, box-shadow .15s; appearance: none; }
    .sp-input:focus, .sp-select:focus { border-color: var(--sp-accent); box-shadow: 0 0 0 3px rgba(48,61,137,.10); }
    .sp-input:hover:not(:focus), .sp-select:hover:not(:focus) { border-color: var(--sp-border-hover); }
    .sp-select-wrap { position: relative; }
    .sp-select-wrap::after { content:''; pointer-events:none; position:absolute; right:10px; top:50%; transform:translateY(-50%); width:0; height:0; border-left:4px solid transparent; border-right:4px solid transparent; border-top:5px solid var(--sp-text-hint); }
    .sp-add-btn { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: var(--sp-accent); color: #fff; border: none; border-radius: var(--sp-radius-md); cursor: pointer; font-size: 14px; transition: background .15s; flex-shrink: 0; }
    .sp-add-btn:hover { background: var(--sp-accent-hover); }

    /* ── Search / filter bar ── */
    .sp-filter-bar { padding: 10px 20px; border-bottom: 1px solid var(--sp-border); background: #fafafa; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .sp-search-wrap { position: relative; flex: 1; min-width: 180px; }
    .sp-search { width: 100%; height: 32px; border: 1px solid var(--sp-border); border-radius: var(--sp-radius-md); padding: 0 10px 0 30px; font-size: 12.5px; font-family: var(--sp-font); color: var(--sp-text-primary); background: var(--sp-surface); outline: none; transition: border-color .15s; }
    .sp-search:focus { border-color: var(--sp-accent); box-shadow: 0 0 0 3px rgba(48,61,137,.10); }
    .sp-search-icon { position: absolute; left: 9px; top: 50%; transform: translateY(-50%); color: var(--sp-text-hint); font-size: 11px; pointer-events: none; }
    .sp-filter-select { height: 32px; border: 1px solid var(--sp-border); border-radius: var(--sp-radius-md); padding: 0 26px 0 10px; font-size: 12.5px; color: var(--sp-text-primary); background: var(--sp-surface); outline: none; font-family: var(--sp-font); appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 8px center; }
    .sp-count-badge { font-size: 12px; color: var(--sp-text-hint); white-space: nowrap; }

    /* ── Redirect table ── */
    .sp-table { width: 100%; border-collapse: collapse; font-size: 13px; font-family: var(--sp-font); }
    .sp-table thead th { padding: 10px 16px; background: #fafafa; border-bottom: 1px solid var(--sp-border); font-size: 11px; font-weight: 650; letter-spacing: .055em; text-transform: uppercase; color: var(--sp-text-hint); text-align: left; white-space: nowrap; }
    .sp-table tbody tr { border-bottom: 1px solid var(--sp-border); transition: background .1s; }
    .sp-table tbody tr:last-child { border-bottom: none; }
    .sp-table tbody tr:hover { background: #f7f8f9; }
    .sp-table td { padding: 12px 16px; vertical-align: middle; }

    /* ── URL cells ── */
    .sp-url { font-family: 'SF Mono','Fira Code',monospace; font-size: 12.5px; color: var(--sp-text-secondary); max-width: 260px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; display: block; }
    .sp-url-from { color: var(--sp-red); }
    .sp-url-to   { color: var(--sp-green); }
    .sp-url-arrow { color: var(--sp-text-hint); font-size: 11px; margin: 0 4px; }

    /* ── Type pill ── */
    .sp-type-pill { display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 5px; letter-spacing: .04em; white-space: nowrap; }
    .sp-301 { background: #eef0fc; color: var(--sp-accent); border: 1px solid #c5c9f0; }
    .sp-302 { background: var(--sp-amber-bg); color: var(--sp-amber); border: 1px solid var(--sp-amber-border); }
    .sp-410 { background: var(--sp-red-bg); color: var(--sp-red); border: 1px solid var(--sp-red-border); }

    /* ── Status pill ── */
    .sp-status-pill { display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; font-weight: 620; padding: 3px 9px; border-radius: 20px; white-space: nowrap; }
    .sp-status-pill::before { content:''; width:5px; height:5px; border-radius:50%; display:inline-block; flex-shrink:0; }
    .sp-active   { background: var(--sp-green-bg); color: var(--sp-green); }
    .sp-active::before   { background: var(--sp-green); }
    .sp-inactive { background: #f3f4f6; color: var(--sp-text-hint); }
    .sp-inactive::before { background: var(--sp-text-hint); }

    /* ── Hit count chip ── */
    .sp-hits { display: inline-flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 600; color: var(--sp-text-secondary); }
    .sp-hits i { font-size: 10px; color: var(--sp-text-hint); }

    /* ── Row action buttons ── */
    .sp-actions { display: flex; gap: 5px; }
    .sp-action-btn { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: var(--sp-radius-sm); border: 1px solid var(--sp-border); background: var(--sp-surface); color: var(--sp-text-secondary); cursor: pointer; font-size: 12px; transition: all .15s; }
    .sp-action-btn:hover { background: var(--sp-bg); border-color: var(--sp-border-hover); color: var(--sp-text-primary); }
    .sp-action-btn.danger:hover { background: var(--sp-red-bg); border-color: var(--sp-red-border); color: var(--sp-red); }

    /* ── Empty state ── */
    .sp-empty { padding: 48px 24px; text-align: center; color: var(--sp-text-hint); font-size: 14px; }
    .sp-empty i { font-size: 36px; color: var(--sp-border); display: block; margin-bottom: 12px; }

    /* ── Sidebar info rows ── */
    .sp-info-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid var(--sp-bg); font-size: 13px; }
    .sp-info-row:first-child { padding-top: 0; }
    .sp-info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .sp-info-label { color: var(--sp-text-hint); font-size: 11.5px; font-weight: 620; text-transform: uppercase; letter-spacing: .03em; }
    .sp-info-value { font-weight: 650; color: var(--sp-text-primary); }

    /* ── Pagination ── */
    .sp-pagination { padding: 13px 20px; border-top: 1px solid var(--sp-border); display: flex; align-items: center; justify-content: space-between; background: var(--sp-surface); font-size: 12.5px; color: var(--sp-text-hint); }
    .sp-pag-btns { display: flex; gap: 4px; }
    .sp-pag-btn { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border: 1px solid var(--sp-border); border-radius: var(--sp-radius-sm); background: var(--sp-surface); color: var(--sp-text-secondary); font-size: 12.5px; cursor: pointer; transition: all .12s; font-family: var(--sp-font); }
    .sp-pag-btn:hover { background: var(--sp-bg); }
    .sp-pag-btn.active { background: var(--sp-accent); border-color: var(--sp-accent); color: #fff; }
    .sp-pag-btn:disabled { opacity:.4; cursor:not-allowed; }

    /* ── Toggle switch ── */
    .sp-switch { position: relative; width: 36px; height: 20px; flex-shrink: 0; }
    .sp-switch input { opacity: 0; width: 0; height: 0; position: absolute; }
    .sp-switch-track { position: absolute; inset: 0; background: var(--sp-border); border-radius: 20px; cursor: pointer; transition: background .2s; }
    .sp-switch-track::after { content:''; position:absolute; left:2px; top:2px; width:16px; height:16px; background:#fff; border-radius:50%; transition:transform .2s; box-shadow:0 1px 3px rgba(0,0,0,.2); }
    .sp-switch input:checked + .sp-switch-track { background: var(--sp-accent); }
    .sp-switch input:checked + .sp-switch-track::after { transform: translateX(16px); }

    /* ── Bulk import area ── */
    .sp-import-zone { border: 2px dashed var(--sp-border); border-radius: var(--sp-radius-md); padding: 20px; text-align: center; cursor: pointer; transition: all .15s; position: relative; }
    .sp-import-zone:hover { border-color: var(--sp-accent); background: var(--sp-accent-light); }
    .sp-import-zone input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .sp-import-zone .iz-icon { font-size: 22px; color: var(--sp-text-hint); margin-bottom: 6px; }
    .sp-import-zone .iz-title { font-size: 13px; font-weight: 600; color: var(--sp-text-primary); }
    .sp-import-zone .iz-sub { font-size: 11.5px; color: var(--sp-text-hint); margin-top: 3px; }

    @media(max-width:768px) { .sp-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="sp-page">

            <!-- Page header -->
            <div class="sp-page-header">
                <div>
                    <h1 class="sp-page-title">Redirect Settings</h1>
                    <div class="sp-crumb">
                        <a href="/admin/dashboard">Dashboard</a>
                        <span style="color:var(--sp-border-hover)">›</span>
                        <span>Redirect Settings</span>
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <button class="sp-btn-secondary" onclick="exportCSV()">
                        <i class="fa fa-download"></i> Export CSV
                    </button>
                    <button class="sp-btn-primary" onclick="document.getElementById('addRowForm').scrollIntoView({behavior:'smooth'})">
                        <i class="fa fa-plus"></i> Add Redirect
                    </button>
                </div>
            </div>

            <!-- Info banner -->
            <div class="sp-banner blue">
                <i class="fa fa-circle-info"></i>
                <div>
                    <strong>What are redirects?</strong> When you rename a product, change a URL slug, or remove a page, the old URL becomes a dead link (404). Setting a redirect tells Google and browsers to automatically send visitors from the old URL to the new one — protecting your SEO rankings and customer experience.
                    <div style="margin-top:6px;display:flex;gap:16px;font-size:12px;flex-wrap:wrap">
                        <span><strong>301 Permanent</strong> — Page moved forever. Google transfers full SEO value to the new URL.</span>
                        <span><strong>302 Temporary</strong> — Page moved short-term. Google keeps the old URL indexed.</span>
                        <span><strong>410 Gone</strong> — Page deleted permanently. No destination needed.</span>
                    </div>
                </div>
            </div>

            <div class="sp-layout">

                <!-- LEFT — main redirect table + add form -->
                <div>

                    <!-- Main card -->
                    <div class="sp-card">

                        <div class="sp-card-header">
                            <h5><i class="fa fa-route" style="color:var(--sp-accent);margin-right:6px"></i> All Redirects</h5>
                            <div id="bulkActions" style="display:none;gap:8px">
                                <span style="font-size:12.5px;color:var(--sp-text-secondary)" id="bulkCount">0 selected</span>
                                <button class="sp-btn-danger" onclick="bulkDelete()" style="height:28px;padding:0 10px;font-size:12px"><i class="fa fa-trash"></i> Delete Selected</button>
                                <button class="sp-btn-secondary" onclick="bulkToggle('enable')" style="height:28px;padding:0 10px;font-size:12px"><i class="fa fa-check"></i> Enable</button>
                                <button class="sp-btn-secondary" onclick="bulkToggle('disable')" style="height:28px;padding:0 10px;font-size:12px"><i class="fa fa-ban"></i> Disable</button>
                            </div>
                        </div>

                        <!-- Add redirect inline form -->
                        <div class="sp-redirect-form" id="addRowForm">
                            <div class="sp-field">
                                <label class="sp-label">From URL (Old) <span style="color:var(--sp-red)">*</span></label>
                                <input type="text" id="newFrom" class="sp-input" placeholder="/old-product-name">
                            </div>
                            <div class="sp-field">
                                <label class="sp-label">To URL (New)</label>
                                <input type="text" id="newTo" class="sp-input" placeholder="/new-product-name">
                            </div>
                            <div class="sp-field">
                                <label class="sp-label">Type</label>
                                <div class="sp-select-wrap">
                                    <select id="newType" class="sp-select">
                                        <option value="301">301 — Permanent</option>
                                        <option value="302">302 — Temporary</option>
                                        <option value="410">410 — Gone</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="sp-add-btn" onclick="addRedirect()" title="Add Redirect">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>

                        <!-- Filter bar -->
                        <div class="sp-filter-bar">
                            <div class="sp-search-wrap">
                                <i class="fa fa-search sp-search-icon"></i>
                                <input type="text" class="sp-search" placeholder="Search URLs…" oninput="filterTable(this.value)" id="searchInput">
                            </div>
                            <select class="sp-filter-select" id="typeFilter" onchange="filterTable()">
                                <option value="">All Types</option>
                                <option value="301">301</option>
                                <option value="302">302</option>
                                <option value="410">410</option>
                            </select>
                            <select class="sp-filter-select" id="statusFilter" onchange="filterTable()">
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <span class="sp-count-badge" id="rowCount">Showing all redirects</span>
                        </div>

                        <!-- Table -->
                        <div style="overflow-x:auto">
                            <table class="sp-table" id="redirectTable">
                                <thead>
                                    <tr>
                                        <th style="width:36px">
                                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)" style="cursor:pointer">
                                        </th>
                                        <th>From URL (Old)</th>
                                        <th>To URL (New)</th>
                                        <th style="width:110px">Type</th>
                                        <th style="width:90px">Hits</th>
                                        <th style="width:100px">Status</th>
                                        <th style="width:130px">Added On</th>
                                        <th style="width:90px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="redirectBody">

                                    <tr data-type="301" data-status="active">
                                        <td><input type="checkbox" class="row-check" onchange="updateBulk()"></td>
                                        <td>
                                            <span class="sp-url sp-url-from" title="/chikankari-kurta-white-xl">/chikankari-kurta-white-xl</span>
                                            <span style="font-size:11px;color:var(--sp-text-hint);margin-top:2px;display:block">Product renamed</span>
                                        </td>
                                        <td><span class="sp-url sp-url-to" title="/chikankari-kurta-set-white-xl">/chikankari-kurta-set-white-xl</span></td>
                                        <td><span class="sp-type-pill sp-301">301</span></td>
                                        <td><span class="sp-hits"><i class="fa fa-mouse-pointer"></i> 142</span></td>
                                        <td>
                                            <label class="sp-switch">
                                                <input type="checkbox" checked onchange="toggleStatus(this)">
                                                <span class="sp-switch-track"></span>
                                            </label>
                                        </td>
                                        <td style="font-size:12.5px;color:var(--sp-text-hint)">12 Jun 2025</td>
                                        <td>
                                            <div class="sp-actions">
                                                <button class="sp-action-btn" title="Edit" onclick="editRow(this)"><i class="fa fa-pencil"></i></button>
                                                <button class="sp-action-btn danger" title="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-type="301" data-status="active">
                                        <td><input type="checkbox" class="row-check" onchange="updateBulk()"></td>
                                        <td>
                                            <span class="sp-url sp-url-from" title="/summer-collection-2024">/summer-collection-2024</span>
                                            <span style="font-size:11px;color:var(--sp-text-hint);margin-top:2px;display:block">Collection updated</span>
                                        </td>
                                        <td><span class="sp-url sp-url-to" title="/summer-collection-2025">/summer-collection-2025</span></td>
                                        <td><span class="sp-type-pill sp-301">301</span></td>
                                        <td><span class="sp-hits"><i class="fa fa-mouse-pointer"></i> 389</span></td>
                                        <td>
                                            <label class="sp-switch">
                                                <input type="checkbox" checked onchange="toggleStatus(this)">
                                                <span class="sp-switch-track"></span>
                                            </label>
                                        </td>
                                        <td style="font-size:12.5px;color:var(--sp-text-hint)">01 Jun 2025</td>
                                        <td>
                                            <div class="sp-actions">
                                                <button class="sp-action-btn" title="Edit" onclick="editRow(this)"><i class="fa fa-pencil"></i></button>
                                                <button class="sp-action-btn danger" title="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-type="302" data-status="active">
                                        <td><input type="checkbox" class="row-check" onchange="updateBulk()"></td>
                                        <td>
                                            <span class="sp-url sp-url-from" title="/sale">/sale</span>
                                            <span style="font-size:11px;color:var(--sp-text-hint);margin-top:2px;display:block">Temporary sale redirect</span>
                                        </td>
                                        <td><span class="sp-url sp-url-to" title="/eid-sale-2025">/eid-sale-2025</span></td>
                                        <td><span class="sp-type-pill sp-302">302</span></td>
                                        <td><span class="sp-hits"><i class="fa fa-mouse-pointer"></i> 1,204</span></td>
                                        <td>
                                            <label class="sp-switch">
                                                <input type="checkbox" checked onchange="toggleStatus(this)">
                                                <span class="sp-switch-track"></span>
                                            </label>
                                        </td>
                                        <td style="font-size:12.5px;color:var(--sp-text-hint)">18 May 2025</td>
                                        <td>
                                            <div class="sp-actions">
                                                <button class="sp-action-btn" title="Edit" onclick="editRow(this)"><i class="fa fa-pencil"></i></button>
                                                <button class="sp-action-btn danger" title="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-type="410" data-status="active">
                                        <td><input type="checkbox" class="row-check" onchange="updateBulk()"></td>
                                        <td>
                                            <span class="sp-url sp-url-from" title="/discontinued-zari-saree">/discontinued-zari-saree</span>
                                            <span style="font-size:11px;color:var(--sp-text-hint);margin-top:2px;display:block">Product removed</span>
                                        </td>
                                        <td><span style="font-size:12px;color:var(--sp-text-hint);font-style:italic">None (Gone — 410)</span></td>
                                        <td><span class="sp-type-pill sp-410">410</span></td>
                                        <td><span class="sp-hits"><i class="fa fa-mouse-pointer"></i> 28</span></td>
                                        <td>
                                            <label class="sp-switch">
                                                <input type="checkbox" checked onchange="toggleStatus(this)">
                                                <span class="sp-switch-track"></span>
                                            </label>
                                        </td>
                                        <td style="font-size:12.5px;color:var(--sp-text-hint)">10 May 2025</td>
                                        <td>
                                            <div class="sp-actions">
                                                <button class="sp-action-btn" title="Edit" onclick="editRow(this)"><i class="fa fa-pencil"></i></button>
                                                <button class="sp-action-btn danger" title="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-type="301" data-status="inactive">
                                        <td><input type="checkbox" class="row-check" onchange="updateBulk()"></td>
                                        <td>
                                            <span class="sp-url sp-url-from" title="/old-about-us">/old-about-us</span>
                                            <span style="font-size:11px;color:var(--sp-text-hint);margin-top:2px;display:block">Page restructured</span>
                                        </td>
                                        <td><span class="sp-url sp-url-to" title="/about">/about</span></td>
                                        <td><span class="sp-type-pill sp-301">301</span></td>
                                        <td><span class="sp-hits"><i class="fa fa-mouse-pointer"></i> 7</span></td>
                                        <td>
                                            <label class="sp-switch">
                                                <input type="checkbox" onchange="toggleStatus(this)">
                                                <span class="sp-switch-track"></span>
                                            </label>
                                        </td>
                                        <td style="font-size:12.5px;color:var(--sp-text-hint)">02 Apr 2025</td>
                                        <td>
                                            <div class="sp-actions">
                                                <button class="sp-action-btn" title="Edit" onclick="editRow(this)"><i class="fa fa-pencil"></i></button>
                                                <button class="sp-action-btn danger" title="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-type="302" data-status="inactive">
                                        <td><input type="checkbox" class="row-check" onchange="updateBulk()"></td>
                                        <td>
                                            <span class="sp-url sp-url-from" title="/festive-offers">/festive-offers</span>
                                            <span style="font-size:11px;color:var(--sp-text-hint);margin-top:2px;display:block">Old campaign</span>
                                        </td>
                                        <td><span class="sp-url sp-url-to" title="/diwali-collection-2024">/diwali-collection-2024</span></td>
                                        <td><span class="sp-type-pill sp-302">302</span></td>
                                        <td><span class="sp-hits"><i class="fa fa-mouse-pointer"></i> 54</span></td>
                                        <td>
                                            <label class="sp-switch">
                                                <input type="checkbox" onchange="toggleStatus(this)">
                                                <span class="sp-switch-track"></span>
                                            </label>
                                        </td>
                                        <td style="font-size:12.5px;color:var(--sp-text-hint)">15 Mar 2025</td>
                                        <td>
                                            <div class="sp-actions">
                                                <button class="sp-action-btn" title="Edit" onclick="editRow(this)"><i class="fa fa-pencil"></i></button>
                                                <button class="sp-action-btn danger" title="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="sp-pagination">
                            <span id="paginationInfo">Showing 6 of 6 redirects</span>
                            <div class="sp-pag-btns">
                                <button class="sp-pag-btn" disabled><i class="fa fa-chevron-left"></i></button>
                                <button class="sp-pag-btn active">1</button>
                                <button class="sp-pag-btn" disabled><i class="fa fa-chevron-right"></i></button>
                            </div>
                        </div>

                    </div>

                    <!-- Bulk Import card -->
                    <div class="sp-card">
                        <div class="sp-card-header"><h5><i class="fa fa-file-csv" style="color:var(--sp-accent);margin-right:6px"></i> Bulk Import via CSV</h5></div>
                        <div class="sp-card-body">
                            <div class="sp-banner amber" style="margin-bottom:16px">
                                <i class="fa fa-triangle-exclamation"></i>
                                <div>CSV must have 3 columns: <strong>from_url, to_url, type</strong> (301 / 302 / 410). First row should be the header. Max 1,000 rows per import.</div>
                            </div>
                            <div class="sp-import-zone" id="importZone">
                                <input type="file" accept=".csv" id="csvInput" onchange="handleCSV(this)">
                                <div class="iz-icon"><i class="fa fa-file-csv"></i></div>
                                <div class="iz-title">Click or drop CSV file here</div>
                                <div class="iz-sub">Columns: from_url, to_url, type · Max 1,000 rows</div>
                            </div>
                            <div style="margin-top:12px;display:flex;gap:8px;justify-content:flex-end">
                                <a href="#" onclick="downloadTemplate()" class="sp-btn-secondary" style="font-size:12.5px">
                                    <i class="fa fa-download"></i> Download Template
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT — sidebar -->
                <div>

                    <!-- Summary -->
                    <div class="sp-card">
                        <div class="sp-card-header"><h5>Summary</h5></div>
                        <div class="sp-card-body-sm">
                            <div class="sp-info-row">
                                <span class="sp-info-label">Total Rules</span>
                                <span class="sp-info-value" id="totalCount">6</span>
                            </div>
                            <div class="sp-info-row">
                                <span class="sp-info-label">Active</span>
                                <span class="sp-info-value" style="color:var(--sp-green)" id="activeCount">4</span>
                            </div>
                            <div class="sp-info-row">
                                <span class="sp-info-label">Inactive</span>
                                <span class="sp-info-value" style="color:var(--sp-text-hint)" id="inactiveCount">2</span>
                            </div>
                            <div class="sp-info-row">
                                <span class="sp-info-label">301 Rules</span>
                                <span class="sp-info-value">3</span>
                            </div>
                            <div class="sp-info-row">
                                <span class="sp-info-label">302 Rules</span>
                                <span class="sp-info-value">2</span>
                            </div>
                            <div class="sp-info-row">
                                <span class="sp-info-label">410 Rules</span>
                                <span class="sp-info-value">1</span>
                            </div>
                            <div class="sp-info-row">
                                <span class="sp-info-label">Total Hits</span>
                                <span class="sp-info-value">1,824</span>
                            </div>
                        </div>
                    </div>

                    <!-- When to use -->
                    <div class="sp-card">
                        <div class="sp-card-header"><h5>When to Use</h5></div>
                        <div class="sp-card-body-sm" style="font-size:12.5px;line-height:1.7;color:var(--sp-text-secondary)">

                            <div style="margin-bottom:12px">
                                <div style="display:inline-flex;align-items:center;gap:6px;margin-bottom:4px">
                                    <span class="sp-type-pill sp-301" style="font-size:10px">301</span>
                                    <strong style="color:var(--sp-text-primary);font-size:13px">Permanent Move</strong>
                                </div>
                                <ul style="margin:0;padding-left:16px;color:var(--sp-text-secondary)">
                                    <li>Product URL / slug changed</li>
                                    <li>Category restructured</li>
                                    <li>Old blog post URL updated</li>
                                    <li>Domain migration</li>
                                </ul>
                            </div>

                            <div style="margin-bottom:12px">
                                <div style="display:inline-flex;align-items:center;gap:6px;margin-bottom:4px">
                                    <span class="sp-type-pill sp-302" style="font-size:10px">302</span>
                                    <strong style="color:var(--sp-text-primary);font-size:13px">Temporary Move</strong>
                                </div>
                                <ul style="margin:0;padding-left:16px;color:var(--sp-text-secondary)">
                                    <li>Seasonal sale page</li>
                                    <li>A/B test landing page</li>
                                    <li>Maintenance redirect</li>
                                </ul>
                            </div>

                            <div>
                                <div style="display:inline-flex;align-items:center;gap:6px;margin-bottom:4px">
                                    <span class="sp-type-pill sp-410" style="font-size:10px">410</span>
                                    <strong style="color:var(--sp-text-primary);font-size:13px">Gone (Deleted)</strong>
                                </div>
                                <ul style="margin:0;padding-left:16px;color:var(--sp-text-secondary)">
                                    <li>Product discontinued</li>
                                    <li>Page permanently removed</li>
                                    <li>Tells Google to deindex fast</li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <!-- SEO Tips -->
                    <div class="sp-card">
                        <div class="sp-card-header"><h5>SEO Tips</h5></div>
                        <div class="sp-card-body-sm" style="font-size:12.5px;line-height:1.8;color:var(--sp-text-secondary)">
                            <div style="display:flex;gap:7px;margin-bottom:8px">
                                <i class="fa fa-circle-check" style="color:var(--sp-green);margin-top:2px;flex-shrink:0"></i>
                                <span>Use <strong style="color:var(--sp-text-primary)">301</strong> for all permanent URL changes — Google passes ~99% link equity.</span>
                            </div>
                            <div style="display:flex;gap:7px;margin-bottom:8px">
                                <i class="fa fa-circle-check" style="color:var(--sp-green);margin-top:2px;flex-shrink:0"></i>
                                <span>Avoid <strong style="color:var(--sp-text-primary)">redirect chains</strong> — A→B→C hurts crawl speed. Always go A→C directly.</span>
                            </div>
                            <div style="display:flex;gap:7px;margin-bottom:8px">
                                <i class="fa fa-circle-check" style="color:var(--sp-green);margin-top:2px;flex-shrink:0"></i>
                                <span>Add redirects <strong style="color:var(--sp-text-primary)">before</strong> changing URLs in your product/page settings.</span>
                            </div>
                            <div style="display:flex;gap:7px">
                                <i class="fa fa-circle-check" style="color:var(--sp-green);margin-top:2px;flex-shrink:0"></i>
                                <span>Submit an updated sitemap to <a href="https://search.google.com/search-console" target="_blank" style="color:var(--sp-accent);font-weight:600">Google Search Console</a> after major changes.</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
/* ── Add new redirect row ── */
let rowIndex = 7;
function addRedirect() {
    const from = document.getElementById('newFrom').value.trim();
    const to   = document.getElementById('newTo').value.trim();
    const type = document.getElementById('newType').value;

    if (!from) {
        Swal.fire({ icon:'warning', title:'From URL required', text:'Please enter the old URL to redirect from.', timer:2000, showConfirmButton:false });
        return;
    }
    if (type !== '410' && !to) {
        Swal.fire({ icon:'warning', title:'To URL required', text:'Please enter the destination URL (not needed for 410 Gone).', timer:2000, showConfirmButton:false });
        return;
    }

    const today = new Date().toLocaleDateString('en-GB', { day:'2-digit', month:'short', year:'numeric' });
    const toCell = type === '410'
        ? `<span style="font-size:12px;color:var(--sp-text-hint);font-style:italic">None (Gone — 410)</span>`
        : `<span class="sp-url sp-url-to" title="${to}">${to}</span>`;
    const pillClass = type === '301' ? 'sp-301' : type === '302' ? 'sp-302' : 'sp-410';

    const tr = document.createElement('tr');
    tr.setAttribute('data-type', type);
    tr.setAttribute('data-status', 'active');
    tr.innerHTML = `
        <td><input type="checkbox" class="row-check" onchange="updateBulk()"></td>
        <td><span class="sp-url sp-url-from" title="${from}">${from}</span><span style="font-size:11px;color:var(--sp-text-hint);margin-top:2px;display:block">Just added</span></td>
        <td>${toCell}</td>
        <td><span class="sp-type-pill ${pillClass}">${type}</span></td>
        <td><span class="sp-hits"><i class="fa fa-mouse-pointer"></i> 0</span></td>
        <td><label class="sp-switch"><input type="checkbox" checked onchange="toggleStatus(this)"><span class="sp-switch-track"></span></label></td>
        <td style="font-size:12.5px;color:var(--sp-text-hint)">${today}</td>
        <td><div class="sp-actions"><button class="sp-action-btn" title="Edit" onclick="editRow(this)"><i class="fa fa-pencil"></i></button><button class="sp-action-btn danger" title="Delete" onclick="deleteRow(this)"><i class="fa fa-trash"></i></button></div></td>`;

    document.getElementById('redirectBody').prepend(tr);
    document.getElementById('newFrom').value = '';
    document.getElementById('newTo').value   = '';
    updateRowCount();
    Swal.fire({ icon:'success', title:'Redirect Added', text:`${from} → ${type === '410' ? '(Gone)' : to} [${type}]`, timer:2000, showConfirmButton:false });
}

/* ── Delete row ── */
function deleteRow(btn) {
    Swal.fire({
        title:'Delete Redirect?',
        text:'This will permanently remove this redirect rule.',
        icon:'warning', showCancelButton:true,
        confirmButtonColor:'#c0392b', cancelButtonColor:'#6d7175',
        confirmButtonText:'Yes, Delete'
    }).then(r => {
        if (r.isConfirmed) {
            const row = btn.closest('tr');
            row.style.transition = 'opacity .2s';
            row.style.opacity = '0';
            setTimeout(() => { row.remove(); updateRowCount(); }, 200);
            Swal.fire({ icon:'success', title:'Deleted', timer:1500, showConfirmButton:false });
        }
    });
}

/* ── Edit row (inline) ── */
function editRow(btn) {
    const row   = btn.closest('tr');
    const fromEl = row.querySelector('.sp-url-from');
    const toEl   = row.querySelector('.sp-url-to');
    const typeEl = row.querySelector('.sp-type-pill');
    if (!fromEl) return;

    const oldFrom = fromEl.textContent.trim();
    const oldTo   = toEl ? toEl.textContent.trim() : '';
    const oldType = typeEl ? typeEl.textContent.trim() : '301';

    Swal.fire({
        title:'Edit Redirect',
        html:`
            <div style="text-align:left;margin-bottom:8px">
                <label style="font-size:11px;font-weight:700;text-transform:uppercase;color:#8c9196;letter-spacing:.05em;display:block;margin-bottom:4px">From URL</label>
                <input id="swal-from" class="swal2-input" style="margin:0;width:100%" value="${oldFrom}">
            </div>
            <div style="text-align:left;margin-bottom:8px">
                <label style="font-size:11px;font-weight:700;text-transform:uppercase;color:#8c9196;letter-spacing:.05em;display:block;margin-bottom:4px">To URL</label>
                <input id="swal-to" class="swal2-input" style="margin:0;width:100%" value="${oldTo}">
            </div>
            <div style="text-align:left">
                <label style="font-size:11px;font-weight:700;text-transform:uppercase;color:#8c9196;letter-spacing:.05em;display:block;margin-bottom:4px">Type</label>
                <select id="swal-type" class="swal2-input" style="margin:0;width:100%;height:38px">
                    <option value="301" ${oldType==='301'?'selected':''}>301 — Permanent</option>
                    <option value="302" ${oldType==='302'?'selected':''}>302 — Temporary</option>
                    <option value="410" ${oldType==='410'?'selected':''}>410 — Gone</option>
                </select>
            </div>`,
        showCancelButton:true,
        confirmButtonColor:'#303d89',
        confirmButtonText:'Save',
        focusConfirm:false,
        preConfirm:() => ({
            from: document.getElementById('swal-from').value.trim(),
            to:   document.getElementById('swal-to').value.trim(),
            type: document.getElementById('swal-type').value
        })
    }).then(r => {
        if (!r.isConfirmed) return;
        const { from, to, type } = r.value;
        if (!from) return;
        if (fromEl) { fromEl.textContent = from; fromEl.title = from; }
        if (toEl)   { toEl.textContent   = to;   toEl.title   = to; }
        if (typeEl) {
            typeEl.textContent = type;
            typeEl.className   = 'sp-type-pill ' + (type==='301'?'sp-301':type==='302'?'sp-302':'sp-410');
        }
        row.setAttribute('data-type', type);
        Swal.fire({ icon:'success', title:'Updated!', timer:1500, showConfirmButton:false });
    });
}

/* ── Toggle enable/disable ── */
function toggleStatus(chk) {
    const row = chk.closest('tr');
    const wasActive = !chk.checked;
    row.setAttribute('data-status', chk.checked ? 'active' : 'inactive');
    updateRowCount();
}

/* ── Bulk actions ── */
function toggleSelectAll(chk) {
    document.querySelectorAll('.row-check').forEach(c => {
        if (c.closest('tr').style.display !== 'none') c.checked = chk.checked;
    });
    updateBulk();
}
function updateBulk() {
    const checked = document.querySelectorAll('.row-check:checked').length;
    const bar = document.getElementById('bulkActions');
    bar.style.display = checked > 0 ? 'flex' : 'none';
    document.getElementById('bulkCount').textContent = checked + ' selected';
}
function bulkDelete() {
    const checked = document.querySelectorAll('.row-check:checked');
    if (!checked.length) return;
    Swal.fire({
        title:`Delete ${checked.length} redirect(s)?`, icon:'warning',
        showCancelButton:true, confirmButtonColor:'#c0392b', confirmButtonText:'Yes, Delete All'
    }).then(r => {
        if (r.isConfirmed) {
            checked.forEach(c => c.closest('tr').remove());
            updateRowCount(); updateBulk();
            Swal.fire({ icon:'success', title:'Deleted!', timer:1500, showConfirmButton:false });
        }
    });
}
function bulkToggle(action) {
    document.querySelectorAll('.row-check:checked').forEach(c => {
        const row = c.closest('tr');
        const sw  = row.querySelector('.sp-switch input[type=checkbox]');
        if (sw) { sw.checked = action === 'enable'; row.setAttribute('data-status', action === 'enable' ? 'active' : 'inactive'); }
    });
    updateRowCount(); updateBulk();
}

/* ── Filter table ── */
function filterTable(val) {
    const search = (val || document.getElementById('searchInput').value || '').toLowerCase();
    const type   = document.getElementById('typeFilter').value;
    const status = document.getElementById('statusFilter').value;
    let visible  = 0;
    document.querySelectorAll('#redirectBody tr').forEach(row => {
        const text    = row.textContent.toLowerCase();
        const rowType = row.getAttribute('data-type');
        const rowSt   = row.getAttribute('data-status');
        const show = (!search || text.includes(search)) &&
                     (!type   || rowType === type) &&
                     (!status || rowSt   === status);
        row.style.display = show ? '' : 'none';
        if (show) visible++;
    });
    const total = document.querySelectorAll('#redirectBody tr').length;
    document.getElementById('rowCount').textContent = visible === total
        ? `Showing all ${total} redirects`
        : `Showing ${visible} of ${total} redirects`;
    document.getElementById('paginationInfo').textContent = visible === total
        ? `Showing ${total} of ${total} redirects`
        : `Showing ${visible} of ${total} redirects`;
}

function updateRowCount() {
    const total    = document.querySelectorAll('#redirectBody tr').length;
    const active   = document.querySelectorAll('#redirectBody tr[data-status="active"]').length;
    const inactive = total - active;
    document.getElementById('totalCount').textContent   = total;
    document.getElementById('activeCount').textContent  = active;
    document.getElementById('inactiveCount').textContent= inactive;
    document.getElementById('rowCount').textContent     = `Showing all ${total} redirects`;
    document.getElementById('paginationInfo').textContent = `Showing ${total} of ${total} redirects`;
}

/* ── CSV export ── */
function exportCSV() {
    const rows   = document.querySelectorAll('#redirectBody tr');
    let csv      = 'from_url,to_url,type,status,hits\n';
    rows.forEach(row => {
        const from   = row.querySelector('.sp-url-from')?.textContent.trim() || '';
        const to     = row.querySelector('.sp-url-to')?.textContent.trim()   || '';
        const type   = row.querySelector('.sp-type-pill')?.textContent.trim() || '';
        const status = row.getAttribute('data-status') || '';
        const hits   = row.querySelector('.sp-hits')?.textContent.replace(/\D/g,'').trim() || '0';
        csv += `"${from}","${to}","${type}","${status}","${hits}"\n`;
    });
    const a = document.createElement('a');
    a.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
    a.download = 'redirects.csv';
    a.click();
}

/* ── CSV import handler ── */
function handleCSV(input) {
    const file = input.files[0];
    if (!file) return;
    Swal.fire({ icon:'info', title:'CSV Selected', text:`"${file.name}" — connect this to your backend to process the import.`, confirmButtonColor:'#303d89' });
}

/* ── Download template ── */
function downloadTemplate() {
    const csv = 'from_url,to_url,type\n/old-page,/new-page,301\n/temp-sale,/sale-2025,302\n/deleted-product,,410\n';
    const a   = document.createElement('a');
    a.href    = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
    a.download= 'redirect-template.csv';
    a.click();
}
</script>