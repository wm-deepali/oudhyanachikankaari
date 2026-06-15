@include('admin.top-header')
<div class="main-section">
    @include('admin.header')

    <style>
        /*
 ═══════════════════════════════════════════════════════════════
  SIDEBAR LAYOUT PROTECTION
  Paste this at the very TOP of your <style> block on any page
  where the sidebar (#cssmenu) gets squeezed or wraps.

  Root cause: the page's content area doesn't have min-width:0,
  so it pushes the sidebar out. This fix locks the sidebar at
  280px and tells the content to absorb remaining space only.
 ═══════════════════════════════════════════════════════════════
*/

/* 1. Force outer shell into a proper side-by-side flex row */
.main-section {
    display: flex !important;
    flex-direction: row !important;
    align-items: stretch !important;
    min-height: 100vh !important;
    overflow: hidden !important;
}

/* 2. Sidebar: hard lock — never shrinks, never grows, sticky scroll */
.main-section #cssmenu {
    flex-shrink: 0 !important;
    flex-grow: 0 !important;
    width: 280px !important;
    min-width: 280px !important;
    max-width: 280px !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    position: sticky !important;
    top: 0 !important;
    height: 100vh !important;
    align-self: flex-start !important;
}

/* 3. Content area: fills remaining space
   min-width: 0 is the KEY fix — without it, flex children
   can overflow their container and squeeze siblings */
.main-section .app-content,
.main-section .app-content.content.container-fluid {
    flex: 1 1 0% !important;
    min-width: 0 !important;
    max-width: 100% !important;
    overflow-x: auto !important;
    box-sizing: border-box !important;
}
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
        --blue:          #0069d9;
        --blue-bg:       #e8f2ff;
        --purple:        #6d28d9;
        --purple-bg:     #ede9fe;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .stock-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .stock-page * { box-sizing: border-box; }

    /* ── Page header ───────────────────────────────────────── */
    .page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    /* ── Buttons ───────────────────────────────────────────── */
    .btn-primary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent); color: #fff; border: none;
        border-radius: var(--radius-sm); padding: 8px 16px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none; font-family: var(--font);
        transition: background .15s; box-shadow: 0 1px 3px rgba(48,61,137,.25);
    }
    .btn-primary-dash:hover { background: #252f70; color: #fff; }

    .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--surface); color: var(--text-primary);
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 8px 16px; font-size: 13px; font-weight: 500; cursor: pointer;
        text-decoration: none; font-family: var(--font); transition: background .15s;
        box-shadow: 0 1px 2px rgba(0,0,0,.04);
    }
    .btn-secondary-dash:hover { background: var(--bg); color: var(--text-primary); }

    /* ── KPI strip ─────────────────────────────────────────── */
    .kpi-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:900px) { .kpi-strip { grid-template-columns: repeat(2,1fr); } }

    .kpi-tile { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 18px 20px; box-shadow: var(--shadow-card); display: flex; align-items: center; gap: 14px; }
    .kpi-icon { width: 42px; height: 42px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .kpi-icon.green  { background: var(--green-bg);  color: var(--green); }
    .kpi-icon.red    { background: var(--red-bg);    color: var(--red); }
    .kpi-icon.amber  { background: var(--amber-bg);  color: var(--amber); }
    .kpi-icon.blue   { background: var(--blue-bg);   color: var(--blue); }
    .kpi-label { font-size: 11.5px; font-weight: 600; color: var(--text-hint); text-transform: uppercase; letter-spacing: .04em; }
    .kpi-value { font-size: 24px; font-weight: 750; color: var(--text-primary); line-height: 1.1; margin-top: 3px; }
    .kpi-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    /* ── Main card ─────────────────────────────────────────── */
    .stock-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }

    /* ── Alert banner ──────────────────────────────────────── */
    .alert-banner { display: flex; align-items: center; gap: 10px; padding: 12px 20px; border-bottom: 1px solid var(--border); background: var(--amber-bg); font-size: 13px; color: var(--amber); font-weight: 500; }
    .alert-banner i { font-size: 15px; flex-shrink: 0; }
    .alert-banner a { color: var(--amber); font-weight: 700; text-decoration: underline; cursor: pointer; }

    /* ── Status tabs ───────────────────────────────────────── */
    .status-tabs { display: flex; border-bottom: 1px solid var(--border); background: var(--surface); padding: 0 20px; overflow-x: auto; }
    .status-tab { display: inline-flex; align-items: center; gap: 6px; padding: 12px 16px; font-size: 13px; font-weight: 500; color: var(--text-secondary); text-decoration: none; border-bottom: 2px solid transparent; white-space: nowrap; transition: color .15s; cursor: pointer; }
    .status-tab:hover { color: var(--text-primary); }
    .status-tab.active { color: var(--accent); border-bottom-color: var(--accent); font-weight: 600; }
    .tab-count { background: var(--bg); color: var(--text-hint); font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 20px; }
    .status-tab.active .tab-count { background: var(--accent-light); color: var(--accent); }

    /* ── Filter bar ────────────────────────────────────────── */
    .filter-bar { padding: 14px 20px; border-bottom: 1px solid var(--border); }
    .filter-row { display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; gap: 5px; }
    .filter-group label { font-size: 11.5px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; }
    .filter-control {
        height: 36px; border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 0 11px; font-size: 13px; color: var(--text-primary); background: var(--surface);
        outline: none; transition: border-color .15s; font-family: var(--font); min-width: 160px;
    }
    .filter-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .btn-filter { height: 36px; display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff; border: none; border-radius: var(--radius-sm); padding: 0 16px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font); transition: background .15s; }
    .btn-filter:hover { background: #252f70; }
    .btn-filter-reset { height: 36px; display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 14px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; font-family: var(--font); transition: background .15s; }
    .btn-filter-reset:hover { background: var(--bg); }

    /* ── Table ─────────────────────────────────────────────── */
    .table-wrap { overflow-x: auto; }
    .stock-table { width: 100%; border-collapse: collapse; font-size: 13px; font-family: var(--font); }
    .stock-table thead th { font-size: 11px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--text-hint); padding: 10px 16px; border-bottom: 1px solid var(--border); background: #fafafa; text-align: left; white-space: nowrap; }
    .stock-table tbody tr { border-bottom: 1px solid var(--border); transition: background .1s; }
    .stock-table tbody tr:last-child { border-bottom: none; }
    .stock-table tbody tr:hover { background: #fafbfc; }
    .stock-table tbody td { padding: 13px 16px; vertical-align: middle; }

    /* ── ID chip ───────────────────────────────────────────── */
    .id-chip { display: inline-block; background: var(--bg); color: var(--text-secondary); font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 6px; font-family: 'SF Mono','Fira Code',monospace; }

    /* ── Product cell ──────────────────────────────────────── */
    .prod-thumb { width: 48px; height: 48px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; }
    .prod-name { font-weight: 600; font-size: 13px; color: var(--text-primary); }
    .prod-sku  { font-size: 11.5px; color: var(--text-hint); font-family: 'SF Mono','Fira Code',monospace; margin-top: 2px; }

    /* ── Category tag ──────────────────────────────────────── */
    .cat-tag { display: inline-flex; align-items: center; gap: 4px; background: var(--accent-light); color: var(--accent); font-size: 11.5px; font-weight: 600; padding: 3px 8px; border-radius: 6px; }

    /* ── Stock indicator ───────────────────────────────────── */
    .stock-bar-wrap { width: 90px; }
    .stock-bar { height: 5px; border-radius: 10px; background: var(--bg); overflow: hidden; margin-top: 5px; }
    .stock-bar-fill { height: 100%; border-radius: 10px; transition: width .3s; }
    .stock-qty { font-size: 15px; font-weight: 700; color: var(--text-primary); }
    .stock-min  { font-size: 11px; color: var(--text-hint); margin-top: 1px; }

    /* ── Status pills ──────────────────────────────────────── */
    .pill { display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; font-weight: 600; padding: 3px 9px; border-radius: 20px; white-space: nowrap; }
    .pill::before { content: ''; width: 5px; height: 5px; border-radius: 50%; }
    .pill-in     { background: var(--green-bg); color: var(--green); }
    .pill-in::before     { background: var(--green); }
    .pill-low    { background: var(--amber-bg); color: var(--amber); }
    .pill-low::before    { background: var(--amber); }
    .pill-out    { background: var(--red-bg);   color: var(--red); }
    .pill-out::before    { background: var(--red); }
    .pill-active { background: var(--green-bg); color: var(--green); }
    .pill-active::before { background: var(--green); }
    .pill-inactive { background: var(--red-bg); color: var(--red); }
    .pill-inactive::before { background: var(--red); }

    /* ── Inline edit input ─────────────────────────────────── */
    .stock-input { width: 80px; height: 32px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 10px; font-size: 13px; font-weight: 600; color: var(--text-primary); background: var(--surface); outline: none; font-family: var(--font); text-align: center; transition: border-color .15s, box-shadow .15s; }
    .stock-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }

    /* ── Update button (inline) ────────────────────────────── */
    .btn-update { display: inline-flex; align-items: center; gap: 4px; height: 30px; background: var(--accent-light); color: var(--accent); border: 1px solid #c7cdf5; border-radius: var(--radius-sm); padding: 0 10px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: var(--font); transition: all .15s; white-space: nowrap; }
    .btn-update:hover { background: var(--accent); color: #fff; border-color: var(--accent); }

    /* ── Action buttons ────────────────────────────────────── */
    .action-btn { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: var(--radius-sm); border: 1px solid var(--border); background: var(--surface); color: var(--text-secondary); font-size: 12px; cursor: pointer; transition: all .12s; text-decoration: none; }
    .action-btn:hover { background: var(--bg); color: var(--text-primary); }
    .action-btn-view:hover { background: var(--blue-bg); border-color: #b8d4f5; color: var(--blue); }
    .action-btn-hist:hover { background: var(--purple-bg); border-color: #c8b7f5; color: var(--purple); }

    /* ── Tooltip ───────────────────────────────────────────── */
    .action-wrap { position: relative; display: inline-flex; }
    .action-wrap .tooltip-label { position: absolute; bottom: calc(100% + 6px); left: 50%; transform: translateX(-50%); background: #202223; color: #fff; font-size: 11px; white-space: nowrap; padding: 3px 8px; border-radius: 5px; pointer-events: none; opacity: 0; transition: opacity .15s; z-index: 10; }
    .action-wrap:hover .tooltip-label { opacity: 1; }

    /* ── Low stock alert row ───────────────────────────────── */
    .stock-table tbody tr.row-low  { background: #fffcf2; }
    .stock-table tbody tr.row-out  { background: #fff8f8; }
    .stock-table tbody tr.row-low:hover  { background: #fff9e6; }
    .stock-table tbody tr.row-out:hover  { background: #fff0f0; }

    /* ── Pagination ────────────────────────────────────────── */
    .pag-row { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    .pag-info { font-size: 12.5px; color: var(--text-hint); }

    /* ── History modal overlay ─────────────────────────────── */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 1000; align-items: center; justify-content: center; }
    .modal-overlay.open { display: flex; }
    .modal-box { background: var(--surface); border-radius: var(--radius-md); box-shadow: 0 20px 60px rgba(0,0,0,.2); width: 560px; max-width: 95vw; max-height: 85vh; overflow: hidden; display: flex; flex-direction: column; }
    .modal-header { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; background: #fafafa; }
    .modal-header h5 { font-size: 14px; font-weight: 650; margin: 0; }
    .modal-close { background: none; border: none; font-size: 18px; color: var(--text-hint); cursor: pointer; padding: 0; line-height: 1; }
    .modal-close:hover { color: var(--text-primary); }
    .modal-body { padding: 20px; overflow-y: auto; flex: 1; }

    /* ── History timeline ──────────────────────────────────── */
    .hist-timeline { position: relative; padding-left: 24px; }
    .hist-timeline::before { content:''; position: absolute; left: 7px; top: 6px; bottom: 6px; width: 2px; background: var(--border); border-radius: 2px; }
    .hist-item { position: relative; margin-bottom: 18px; }
    .hist-item:last-child { margin-bottom: 0; }
    .hist-dot { position: absolute; left: -21px; top: 3px; width: 12px; height: 12px; border-radius: 50%; border: 2px solid var(--surface); }
    .hist-dot.add    { background: var(--green); }
    .hist-dot.remove { background: var(--red); }
    .hist-dot.adjust { background: var(--amber); }
    .hist-title { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .hist-meta  { font-size: 11.5px; color: var(--text-hint); margin-top: 3px; }
    .hist-qty   { display: inline-flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 700; margin-top: 4px; padding: 2px 8px; border-radius: 6px; }
    .hist-qty.add    { background: var(--green-bg); color: var(--green); }
    .hist-qty.remove { background: var(--red-bg);   color: var(--red); }
    .hist-qty.adjust { background: var(--amber-bg); color: var(--amber); }

    @media(max-width:768px) { .stock-page { padding: 16px; } .filter-row { flex-direction: column; } .filter-control { min-width: 100%; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="stock-page">

            <!-- Page header -->
            <div class="page-header">
                <div>
                    <h1>Stock Management</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        Stock Management
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-download"></i> Export CSV
                    </a>
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-upload"></i> Bulk Update
                    </a>
                    <a href="#" class="btn-primary-dash">
                        <i class="fa fa-plus"></i> Add Stock Entry
                    </a>
                </div>
            </div>

            <!-- KPI strip -->
            <div class="kpi-strip">
                <div class="kpi-tile">
                    <div class="kpi-icon green"><i class="fa fa-cubes"></i></div>
                    <div>
                        <div class="kpi-label">Total Products</div>
                        <div class="kpi-value">2,458</div>
                        <div class="kpi-sub">In inventory</div>
                    </div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-icon amber"><i class="fa fa-exclamation-triangle"></i></div>
                    <div>
                        <div class="kpi-label">Low Stock</div>
                        <div class="kpi-value">38</div>
                        <div class="kpi-sub">Below threshold</div>
                    </div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-icon red"><i class="fa fa-times-circle"></i></div>
                    <div>
                        <div class="kpi-label">Out of Stock</div>
                        <div class="kpi-value">12</div>
                        <div class="kpi-sub">Need restocking</div>
                    </div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-icon blue"><i class="fa fa-boxes"></i></div>
                    <div>
                        <div class="kpi-label">Total Units</div>
                        <div class="kpi-value">1,24,890</div>
                        <div class="kpi-sub">Across all products</div>
                    </div>
                </div>
            </div>

            <!-- Main card -->
            <div class="stock-card">

                <!-- Alert banner -->
                <div class="alert-banner">
                    <i class="fa fa-exclamation-triangle"></i>
                    <span>12 products are <strong>out of stock</strong> and 38 are running low. <a href="#">View critical items →</a></span>
                </div>

                <!-- Status tabs -->
                <div class="status-tabs">
                    <a class="status-tab active">All <span class="tab-count">2,458</span></a>
                    <a class="status-tab">In Stock <span class="tab-count">2,408</span></a>
                    <a class="status-tab">Low Stock <span class="tab-count">38</span></a>
                    <a class="status-tab">Out of Stock <span class="tab-count">12</span></a>
                </div>

                <!-- Filter bar -->
                <div class="filter-bar">
                    <div class="filter-row">
                        <div class="filter-group" style="flex:1">
                            <label>Search</label>
                            <input type="text" class="filter-control" style="min-width:220px" placeholder="Product name, SKU, or code…">
                        </div>
                        <div class="filter-group">
                            <label>Category</label>
                            <select class="filter-control">
                                <option>All Categories</option>
                                <option>Electronics</option>
                                <option>Clothing</option>
                                <option>Home &amp; Kitchen</option>
                                <option>Sports</option>
                                <option>Books</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Stock Status</label>
                            <select class="filter-control">
                                <option>All</option>
                                <option>In Stock</option>
                                <option>Low Stock</option>
                                <option>Out of Stock</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Sort By</label>
                            <select class="filter-control">
                                <option>Stock: Low to High</option>
                                <option>Stock: High to Low</option>
                                <option>Product Name A–Z</option>
                                <option>Last Updated</option>
                            </select>
                        </div>
                        <div style="display:flex;gap:8px;align-items:flex-end">
                            <button class="btn-filter"><i class="fa fa-search"></i> Search</button>
                            <a href="#" class="btn-filter-reset"><i class="fa fa-refresh"></i> Reset</a>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-wrap">
                    <table class="stock-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>SKU</th>
                                <th>Current Stock</th>
                                <th>Min Threshold</th>
                                <th>Stock Status</th>
                                <th>Visibility</th>
                                <th>Update Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Row 1 — In Stock -->
                            <tr>
                                <td><span class="id-chip">1</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/e8f2ff/0069d9?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">iPhone 16 Pro Max</div>
                                            <div class="prod-sku">CODE: IPH16PM-BLK</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00142</span></td>
                                <td>
                                    <div class="stock-qty">450</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:90%;background:var(--green)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">20</span></td>
                                <td><span class="pill pill-in">In Stock</span></td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="450">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('iPhone 16 Pro Max')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2 — In Stock -->
                            <tr>
                                <td><span class="id-chip">2</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/e3f1ec/007a5e?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">Samsung Galaxy S26 Ultra</div>
                                            <div class="prod-sku">CODE: SAM-S26U-WHT</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00198</span></td>
                                <td>
                                    <div class="stock-qty">390</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:78%;background:var(--green)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">25</span></td>
                                <td><span class="pill pill-in">In Stock</span></td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="390">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('Samsung Galaxy S26 Ultra')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3 — Low Stock -->
                            <tr class="row-low">
                                <td><span class="id-chip">3</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/fff5cc/916a00?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">MacBook Pro 16" M4</div>
                                            <div class="prod-sku">CODE: MBP16-M4-SLV</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00076</span></td>
                                <td>
                                    <div class="stock-qty" style="color:var(--amber)">18</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:18%;background:var(--amber)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--amber);font-weight:600">20</span></td>
                                <td><span class="pill pill-low">Low Stock</span></td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="18" style="border-color:var(--amber)">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('MacBook Pro 16')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 4 — Out of Stock -->
                            <tr class="row-out">
                                <td><span class="id-chip">4</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/fce8e8/b22222?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">Sony WH-1000XM6</div>
                                            <div class="prod-sku">CODE: SNY-WH1000XM6</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00211</span></td>
                                <td>
                                    <div class="stock-qty" style="color:var(--red)">0</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:0%;background:var(--red)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">10</span></td>
                                <td><span class="pill pill-out">Out of Stock</span></td>
                                <td><span class="pill pill-inactive">Inactive</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="0" style="border-color:var(--red)">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('Sony WH-1000XM6')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 5 — In Stock -->
                            <tr>
                                <td><span class="id-chip">5</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/ede9fe/6d28d9?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">AirPods Pro (3rd Gen)</div>
                                            <div class="prod-sku">CODE: APP-3GEN-WHT</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00305</span></td>
                                <td>
                                    <div class="stock-qty">250</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:62%;background:var(--green)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">30</span></td>
                                <td><span class="pill pill-in">In Stock</span></td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="250">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('AirPods Pro')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 6 — Low Stock -->
                            <tr class="row-low">
                                <td><span class="id-chip">6</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/fff5cc/916a00?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">Nike Air Max 270</div>
                                            <div class="prod-sku">CODE: NK-AM270-BLK-42</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Footwear</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00419</span></td>
                                <td>
                                    <div class="stock-qty" style="color:var(--amber)">7</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:7%;background:var(--amber)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--amber);font-weight:600">15</span></td>
                                <td><span class="pill pill-low">Low Stock</span></td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="7" style="border-color:var(--amber)">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('Nike Air Max 270')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 7 — In Stock -->
                            <tr>
                                <td><span class="id-chip">7</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/e8f2ff/0069d9?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">Levi's 511 Slim Jeans</div>
                                            <div class="prod-sku">CODE: LVS-511-IND-32</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Clothing</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00532</span></td>
                                <td>
                                    <div class="stock-qty">182</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:45%;background:var(--green)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">20</span></td>
                                <td><span class="pill pill-in">In Stock</span></td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="182">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('Levi\'s 511')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 8 — Out of Stock -->
                            <tr class="row-out">
                                <td><span class="id-chip">8</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/48x48/fce8e8/b22222?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name">Dyson V15 Detect</div>
                                            <div class="prod-sku">CODE: DYS-V15-DET</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Home &amp; Kitchen</span></td>
                                <td><span style="font-family:'SF Mono','Fira Code',monospace;font-size:12px;color:var(--text-secondary)">SKU-00688</span></td>
                                <td>
                                    <div class="stock-qty" style="color:var(--red)">0</div>
                                    <div class="stock-bar-wrap">
                                        <div class="stock-bar"><div class="stock-bar-fill" style="width:0%;background:var(--red)"></div></div>
                                    </div>
                                </td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">5</span></td>
                                <td><span class="pill pill-out">Out of Stock</span></td>
                                <td><span class="pill pill-inactive">Inactive</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;align-items:center">
                                        <input type="number" class="stock-input" value="0" style="border-color:var(--red)">
                                        <button class="btn-update"><i class="fa fa-check"></i> Save</button>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <div class="action-wrap">
                                            <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                            <span class="tooltip-label">View Product</span>
                                        </div>
                                        <div class="action-wrap">
                                            <button class="action-btn action-btn-hist" onclick="openHistory('Dyson V15 Detect')"><i class="fa fa-history"></i></button>
                                            <span class="tooltip-label">Stock History</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pag-row">
                    <div class="pag-info">Showing 1–8 of 2,458 products</div>
                    <nav>
                        <ul class="pagination mb-0" style="font-size:13px">
                            <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                            <li class="page-item active"><a class="page-link" href="#" style="background:var(--accent);border-color:var(--accent)">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">…</a></li>
                            <li class="page-item"><a class="page-link" href="#">308</a></li>
                            <li class="page-item"><a class="page-link" href="#">›</a></li>
                        </ul>
                    </nav>
                </div>

            </div><!-- /stock-card -->

        </div>
    </div>

    <!-- ── Stock History Modal ───────────────────────────────── -->
    <div class="modal-overlay" id="historyModal">
        <div class="modal-box">
            <div class="modal-header">
                <h5><i class="fa fa-history" style="color:var(--accent);margin-right:8px"></i> Stock History — <span id="modalProductName"></span></h5>
                <button class="modal-close" onclick="closeHistory()">×</button>
            </div>
            <div class="modal-body">

                <!-- Summary row -->
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:20px">
                    <div style="background:var(--green-bg);border-radius:var(--radius-sm);padding:12px 14px;text-align:center">
                        <div style="font-size:11px;font-weight:600;color:var(--green);text-transform:uppercase;letter-spacing:.04em">Total Added</div>
                        <div style="font-size:22px;font-weight:750;color:var(--green);margin-top:4px">+580</div>
                    </div>
                    <div style="background:var(--red-bg);border-radius:var(--radius-sm);padding:12px 14px;text-align:center">
                        <div style="font-size:11px;font-weight:600;color:var(--red);text-transform:uppercase;letter-spacing:.04em">Total Sold</div>
                        <div style="font-size:22px;font-weight:750;color:var(--red);margin-top:4px">-130</div>
                    </div>
                    <div style="background:var(--accent-light);border-radius:var(--radius-sm);padding:12px 14px;text-align:center">
                        <div style="font-size:11px;font-weight:600;color:var(--accent);text-transform:uppercase;letter-spacing:.04em">Current</div>
                        <div style="font-size:22px;font-weight:750;color:var(--accent);margin-top:4px">450</div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="hist-timeline">

                    <div class="hist-item">
                        <div class="hist-dot add"></div>
                        <div class="hist-title">Stock Added — Manual Entry</div>
                        <div class="hist-meta">By Admin (Rahul Sharma) &nbsp;·&nbsp; 14 Jun 2026, 10:22 AM</div>
                        <span class="hist-qty add"><i class="fa fa-arrow-up"></i> +100 units</span>
                    </div>

                    <div class="hist-item">
                        <div class="hist-dot remove"></div>
                        <div class="hist-title">Stock Deducted — Order #00821</div>
                        <div class="hist-meta">Automatic deduction on order placement &nbsp;·&nbsp; 13 Jun 2026, 3:45 PM</div>
                        <span class="hist-qty remove"><i class="fa fa-arrow-down"></i> −2 units</span>
                    </div>

                    <div class="hist-item">
                        <div class="hist-dot remove"></div>
                        <div class="hist-title">Stock Deducted — Order #00814</div>
                        <div class="hist-meta">Automatic deduction on order placement &nbsp;·&nbsp; 12 Jun 2026, 11:10 AM</div>
                        <span class="hist-qty remove"><i class="fa fa-arrow-down"></i> −1 unit</span>
                    </div>

                    <div class="hist-item">
                        <div class="hist-dot adjust"></div>
                        <div class="hist-title">Stock Adjusted — Damage Write-off</div>
                        <div class="hist-meta">By Admin (Priya Singh) &nbsp;·&nbsp; 10 Jun 2026, 9:00 AM</div>
                        <span class="hist-qty adjust"><i class="fa fa-pencil"></i> −3 units (damaged)</span>
                    </div>

                    <div class="hist-item">
                        <div class="hist-dot add"></div>
                        <div class="hist-title">Stock Added — Bulk Import</div>
                        <div class="hist-meta">Via CSV import &nbsp;·&nbsp; 5 Jun 2026, 2:30 PM</div>
                        <span class="hist-qty add"><i class="fa fa-arrow-up"></i> +200 units</span>
                    </div>

                    <div class="hist-item">
                        <div class="hist-dot add"></div>
                        <div class="hist-title">Initial Stock Set</div>
                        <div class="hist-meta">Product created &nbsp;·&nbsp; 1 Jun 2026, 10:00 AM</div>
                        <span class="hist-qty add"><i class="fa fa-arrow-up"></i> +280 units</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@include('admin.footer')

<script>
function openHistory(name) {
    document.getElementById('modalProductName').textContent = name;
    document.getElementById('historyModal').classList.add('open');
}
function closeHistory() {
    document.getElementById('historyModal').classList.remove('open');
}
// Close on backdrop click
document.getElementById('historyModal').addEventListener('click', function(e) {
    if (e.target === this) closeHistory();
});
// Save button feedback
document.querySelectorAll('.btn-update').forEach(btn => {
    btn.addEventListener('click', function() {
        const orig = this.innerHTML;
        this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving…';
        this.disabled = true;
        setTimeout(() => {
            this.innerHTML = '<i class="fa fa-check"></i> Saved!';
            this.style.background = 'var(--green-bg)';
            this.style.color = 'var(--green)';
            this.style.borderColor = 'var(--green)';
            setTimeout(() => {
                this.innerHTML = orig;
                this.style.background = '';
                this.style.color = '';
                this.style.borderColor = '';
                this.disabled = false;
            }, 1500);
        }, 600);
    });
});
</script>