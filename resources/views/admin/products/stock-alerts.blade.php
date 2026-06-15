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
        --amber-border:  #f0d060;
        --blue:          #0069d9;
        --blue-bg:       #e8f2ff;
        --purple:        #6d28d9;
        --purple-bg:     #ede9fe;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }










    .alert-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .alert-page * { box-sizing: border-box; }

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
        text-decoration: none; font-family: var(--font);
        transition: background .15s; box-shadow: 0 1px 2px rgba(0,0,0,.04);
    }
    .btn-secondary-dash:hover { background: var(--bg); color: var(--text-primary); }

    .btn-danger-soft {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--red-bg); color: var(--red);
        border: 1px solid #f5c6c6; border-radius: var(--radius-sm);
        padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none; font-family: var(--font); transition: all .15s;
    }
    .btn-danger-soft:hover { background: var(--red); color: #fff; border-color: var(--red); }

    /* ── KPI strip ─────────────────────────────────────────── */
    .kpi-strip { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:900px) { .kpi-strip { grid-template-columns: repeat(2,1fr); } }

    .kpi-tile { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 18px 20px; box-shadow: var(--shadow-card); display: flex; align-items: center; gap: 14px; }
    .kpi-icon { width: 42px; height: 42px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .kpi-icon.red    { background: var(--red-bg);    color: var(--red); }
    .kpi-icon.amber  { background: var(--amber-bg);  color: var(--amber); }
    .kpi-icon.green  { background: var(--green-bg);  color: var(--green); }
    .kpi-icon.purple { background: var(--purple-bg); color: var(--purple); }
    .kpi-label { font-size: 11.5px; font-weight: 600; color: var(--text-hint); text-transform: uppercase; letter-spacing: .04em; }
    .kpi-value { font-size: 24px; font-weight: 750; color: var(--text-primary); line-height: 1.1; margin-top: 3px; }
    .kpi-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    /* ── Top priority banner ───────────────────────────────── */
    .priority-banner {
        background: linear-gradient(135deg, #fff0f0 0%, #fff8f8 100%);
        border: 1px solid #f5c6c6;
        border-left: 4px solid var(--red);
        border-radius: var(--radius-md);
        padding: 16px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        box-shadow: var(--shadow-card);
    }
    .priority-banner-left { display: flex; align-items: center; gap: 12px; }
    .priority-banner-icon { width: 40px; height: 40px; border-radius: var(--radius-sm); background: var(--red-bg); display: flex; align-items: center; justify-content: center; font-size: 18px; color: var(--red); flex-shrink: 0; }
    .priority-banner-title { font-size: 14px; font-weight: 650; color: var(--red); }
    .priority-banner-sub   { font-size: 12.5px; color: var(--text-secondary); margin-top: 2px; }

    /* ── Main layout: table left + settings right ──────────── */
    .main-layout { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }
    @media(max-width:1024px) { .main-layout { grid-template-columns: 1fr; } }

    /* ── Section card ──────────────────────────────────────── */
    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .section-card-body { padding: 20px; }

    /* ── Status tabs ───────────────────────────────────────── */
    .status-tabs { display: flex; border-bottom: 1px solid var(--border); background: var(--surface); padding: 0 20px; overflow-x: auto; }
    .status-tab { display: inline-flex; align-items: center; gap: 6px; padding: 12px 16px; font-size: 13px; font-weight: 500; color: var(--text-secondary); text-decoration: none; border-bottom: 2px solid transparent; white-space: nowrap; transition: color .15s; cursor: pointer; }
    .status-tab:hover { color: var(--text-primary); }
    .status-tab.active { color: var(--accent); border-bottom-color: var(--accent); font-weight: 600; }
    .tab-count { background: var(--bg); color: var(--text-hint); font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 20px; }
    .status-tab.active .tab-count { background: var(--accent-light); color: var(--accent); }
    .tab-count.red    { background: var(--red-bg);   color: var(--red); }
    .tab-count.amber  { background: var(--amber-bg); color: var(--amber); }
    .tab-count.green  { background: var(--green-bg); color: var(--green); }

    /* ── Filter bar ────────────────────────────────────────── */
    .filter-bar { padding: 14px 20px; border-bottom: 1px solid var(--border); }
    .filter-row { display: flex; flex-wrap: wrap; gap: 10px; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; gap: 5px; }
    .filter-group label { font-size: 11.5px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; }
    .filter-control { height: 36px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 11px; font-size: 13px; color: var(--text-primary); background: var(--surface); outline: none; transition: border-color .15s; font-family: var(--font); min-width: 150px; }
    .filter-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .btn-filter { height: 36px; display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff; border: none; border-radius: var(--radius-sm); padding: 0 16px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font); transition: background .15s; }
    .btn-filter:hover { background: #252f70; }
    .btn-filter-reset { height: 36px; display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 14px; font-size: 13px; font-weight: 500; cursor: pointer; font-family: var(--font); transition: background .15s; }
    .btn-filter-reset:hover { background: var(--bg); }

    /* ── Alert table ───────────────────────────────────────── */
    .table-wrap { overflow-x: auto; }
    .alert-table { width: 100%; border-collapse: collapse; font-size: 13px; font-family: var(--font); }
    .alert-table thead th { font-size: 11px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--text-hint); padding: 10px 16px; border-bottom: 1px solid var(--border); background: #fafafa; text-align: left; white-space: nowrap; }
    .alert-table tbody tr { border-bottom: 1px solid var(--border); transition: background .1s; }
    .alert-table tbody tr:last-child { border-bottom: none; }
    .alert-table tbody tr:hover { background: #fafbfc; }
    .alert-table tbody tr.row-critical { background: #fff8f8; }
    .alert-table tbody tr.row-critical:hover { background: #fff0f0; }
    .alert-table tbody tr.row-low { background: #fffcf2; }
    .alert-table tbody tr.row-low:hover { background: #fff9e6; }
    .alert-table tbody td { padding: 13px 16px; vertical-align: middle; }

    /* ── ID chip ───────────────────────────────────────────── */
    .id-chip { display: inline-block; background: var(--bg); color: var(--text-secondary); font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 6px; font-family: 'SF Mono','Fira Code',monospace; }

    /* ── Product cell ──────────────────────────────────────── */
    .prod-thumb { width: 46px; height: 46px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; }
    .prod-name { font-weight: 600; font-size: 13px; color: var(--text-primary); }
    .prod-meta { font-size: 11.5px; color: var(--text-hint); font-family: 'SF Mono','Fira Code',monospace; margin-top: 2px; }

    /* ── Category tag ──────────────────────────────────────── */
    .cat-tag { display: inline-flex; align-items: center; gap: 4px; background: var(--accent-light); color: var(--accent); font-size: 11.5px; font-weight: 600; padding: 3px 8px; border-radius: 6px; }

    /* ── Stock gauge ───────────────────────────────────────── */
    .gauge-wrap { min-width: 100px; }
    .gauge-numbers { display: flex; align-items: baseline; gap: 4px; }
    .gauge-current { font-size: 18px; font-weight: 750; line-height: 1; }
    .gauge-divider { font-size: 12px; color: var(--text-hint); }
    .gauge-min { font-size: 12px; color: var(--text-hint); }
    .gauge-bar { height: 5px; border-radius: 10px; background: var(--bg); overflow: hidden; margin-top: 6px; }
    .gauge-fill { height: 100%; border-radius: 10px; }
    .gauge-label { font-size: 10.5px; color: var(--text-hint); margin-top: 3px; }

    /* ── Severity badge ────────────────────────────────────── */
    .severity { display: inline-flex; align-items: center; gap: 5px; font-size: 11.5px; font-weight: 700; padding: 4px 10px; border-radius: 6px; }
    .severity i { font-size: 10px; }
    .sev-critical { background: var(--red-bg);   color: var(--red);   border: 1px solid #f5c6c6; }
    .sev-low      { background: var(--amber-bg); color: var(--amber); border: 1px solid var(--amber-border); }
    .sev-watch    { background: var(--blue-bg);  color: var(--blue);  border: 1px solid #b8d4f5; }

    /* ── Pills ─────────────────────────────────────────────── */
    .pill { display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; font-weight: 600; padding: 3px 9px; border-radius: 20px; }
    .pill::before { content: ''; width: 5px; height: 5px; border-radius: 50%; }
    .pill-out  { background: var(--red-bg);   color: var(--red); }
    .pill-out::before  { background: var(--red); }
    .pill-low  { background: var(--amber-bg); color: var(--amber); }
    .pill-low::before  { background: var(--amber); }
    .pill-watch { background: var(--blue-bg);  color: var(--blue); }
    .pill-watch::before { background: var(--blue); }

    /* ── Restock input ─────────────────────────────────────── */
    .restock-input { width: 72px; height: 30px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 8px; font-size: 12.5px; font-weight: 600; color: var(--text-primary); background: var(--surface); outline: none; font-family: var(--font); text-align: center; transition: border-color .15s; }
    .restock-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .btn-restock { display: inline-flex; align-items: center; gap: 4px; height: 30px; background: var(--green-bg); color: var(--green); border: 1px solid #b2d8cc; border-radius: var(--radius-sm); padding: 0 10px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: var(--font); transition: all .15s; white-space: nowrap; }
    .btn-restock:hover { background: var(--green); color: #fff; border-color: var(--green); }

    /* ── Action buttons ────────────────────────────────────── */
    .action-btn { display: inline-flex; align-items: center; justify-content: center; width: 30px; height: 30px; border-radius: var(--radius-sm); border: 1px solid var(--border); background: var(--surface); color: var(--text-secondary); font-size: 12px; cursor: pointer; transition: all .12s; text-decoration: none; }
    .action-btn:hover               { background: var(--bg); color: var(--text-primary); }
    .action-btn-view:hover          { background: var(--blue-bg);   border-color: #b8d4f5; color: var(--blue); }
    .action-btn-edit:hover          { background: var(--accent-light); border-color: #c7cdf5; color: var(--accent); }
    .action-btn-dismiss:hover       { background: var(--green-bg);  border-color: #b2d8cc; color: var(--green); }

    /* ── Tooltip ───────────────────────────────────────────── */
    .action-wrap { position: relative; display: inline-flex; }
    .action-wrap .tooltip-label { position: absolute; bottom: calc(100% + 6px); left: 50%; transform: translateX(-50%); background: #202223; color: #fff; font-size: 11px; white-space: nowrap; padding: 3px 8px; border-radius: 5px; pointer-events: none; opacity: 0; transition: opacity .15s; z-index: 10; }
    .action-wrap:hover .tooltip-label { opacity: 1; }

    /* ── Last alert time ───────────────────────────────────── */
    .time-cell { font-size: 12.5px; color: var(--text-secondary); }
    .time-cell small { display: block; font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }

    /* ── Pagination ────────────────────────────────────────── */
    .pag-row { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; }
    .pag-info { font-size: 12.5px; color: var(--text-hint); }

    /* ── Right sidebar ─────────────────────────────────────── */
    .stock-sidebar-section { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .sidebar-section:last-child { margin-bottom: 0; }
    .sidebar-header { padding: 13px 18px; border-bottom: 1px solid var(--border); background: #fafafa; }
    .sidebar-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .sidebar-body { padding: 16px 18px; }

    /* ── Threshold settings ────────────────────────────────── */
    .threshold-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .threshold-row:last-child { border-bottom: none; padding-bottom: 0; }
    .threshold-row:first-child { padding-top: 0; }
    .threshold-label { font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .threshold-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }
    .threshold-input { width: 64px; height: 32px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 8px; font-size: 13px; font-weight: 600; color: var(--text-primary); text-align: center; outline: none; font-family: var(--font); transition: border-color .15s; }
    .threshold-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }

    /* ── Notification toggles ──────────────────────────────── */
    .notif-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .notif-row:first-child { padding-top: 0; }
    .notif-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .notif-label { font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .notif-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }

    /* Toggle switch */
    .toggle-switch { position: relative; width: 36px; height: 20px; flex-shrink: 0; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-track { position: absolute; inset: 0; background: var(--border); border-radius: 20px; cursor: pointer; transition: background .2s; }
    .toggle-track::after { content:''; position: absolute; left: 3px; top: 3px; width: 14px; height: 14px; background: #fff; border-radius: 50%; transition: transform .2s; box-shadow: 0 1px 3px rgba(0,0,0,.15); }
    .toggle-switch input:checked + .toggle-track { background: var(--accent); }
    .toggle-switch input:checked + .toggle-track::after { transform: translateX(16px); }

    /* ── Top critical mini-list ────────────────────────────── */
    .critical-item { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .critical-item:first-child { padding-top: 0; }
    .critical-item:last-child  { border-bottom: none; padding-bottom: 0; }
    .critical-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
    .critical-name { font-size: 13px; font-weight: 500; color: var(--text-primary); flex: 1; }
    .critical-stock { font-size: 13px; font-weight: 700; color: var(--red); }
    .critical-stock.amber { color: var(--amber); }

    /* ── Category breakdown ────────────────────────────────── */
    .cat-breakdown-row { display: flex; align-items: center; justify-content: space-between; padding: 9px 0; border-bottom: 1px solid var(--bg); font-size: 13px; }
    .cat-breakdown-row:first-child { padding-top: 0; }
    .cat-breakdown-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .cat-breakdown-name { color: var(--text-primary); font-weight: 500; }
    .cat-breakdown-count { display: flex; gap: 6px; align-items: center; }
    .mini-pill { display: inline-flex; align-items: center; font-size: 11px; font-weight: 700; padding: 2px 6px; border-radius: 20px; }
    .mini-pill.red    { background: var(--red-bg);   color: var(--red); }
    .mini-pill.amber  { background: var(--amber-bg); color: var(--amber); }

    @media(max-width:768px) { .alert-page { padding: 16px; } .filter-row { flex-direction: column; } .filter-control { min-width: 100%; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="alert-page">

            <!-- Page header -->
            <div class="page-header">
                <div>
                    <h1>Stock Alerts</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        <a href="#">Stock Management</a>
                        <span>›</span>
                        Stock Alerts
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-download"></i> Export Report
                    </a>
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-bell-slash"></i> Dismiss All
                    </a>
                    <a href="#" class="btn-primary-dash">
                        <i class="fa fa-refresh"></i> Restock All Critical
                    </a>
                </div>
            </div>

            <!-- KPI strip -->
            <div class="kpi-strip">
                <div class="kpi-tile">
                    <div class="kpi-icon red"><i class="fa fa-times-circle"></i></div>
                    <div>
                        <div class="kpi-label">Out of Stock</div>
                        <div class="kpi-value" style="color:var(--red)">12</div>
                        <div class="kpi-sub">Needs immediate action</div>
                    </div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-icon amber"><i class="fa fa-exclamation-triangle"></i></div>
                    <div>
                        <div class="kpi-label">Low Stock</div>
                        <div class="kpi-value" style="color:var(--amber)">38</div>
                        <div class="kpi-sub">Below threshold</div>
                    </div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-icon purple"><i class="fa fa-eye"></i></div>
                    <div>
                        <div class="kpi-label">Watch List</div>
                        <div class="kpi-value">24</div>
                        <div class="kpi-sub">Approaching threshold</div>
                    </div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-icon green"><i class="fa fa-check-circle"></i></div>
                    <div>
                        <div class="kpi-label">Resolved Today</div>
                        <div class="kpi-value" style="color:var(--green)">7</div>
                        <div class="kpi-sub">Restocked this session</div>
                    </div>
                </div>
            </div>

            <!-- Priority banner -->
            <div class="priority-banner">
                <div class="priority-banner-left">
                    <div class="priority-banner-icon"><i class="fa fa-fire"></i></div>
                    <div>
                        <div class="priority-banner-title">🔴 Critical: 12 products are completely out of stock</div>
                        <div class="priority-banner-sub">These products are live on your store and cannot be purchased. Restock immediately to avoid lost sales.</div>
                    </div>
                </div>
                <a href="#" class="btn-danger-soft" style="flex-shrink:0">
                    <i class="fa fa-bolt"></i> View Critical Only
                </a>
            </div>

            <!-- Main layout -->
            <div class="main-layout">

                <!-- ═══ LEFT: Alert Table ═══ -->
                <div>
                    <div class="section-card">

                        <!-- Status tabs -->
                        <div class="status-tabs">
                            <a class="status-tab active">
                                All Alerts <span class="tab-count">74</span>
                            </a>
                            <a class="status-tab">
                                Out of Stock <span class="tab-count red">12</span>
                            </a>
                            <a class="status-tab">
                                Low Stock <span class="tab-count amber">38</span>
                            </a>
                            <a class="status-tab">
                                Watch List <span class="tab-count">24</span>
                            </a>
                            <a class="status-tab">
                                Dismissed <span class="tab-count">5</span>
                            </a>
                        </div>

                        <!-- Filter bar -->
                        <div class="filter-bar">
                            <div class="filter-row">
                                <div class="filter-group" style="flex:1">
                                    <label>Search</label>
                                    <input type="text" class="filter-control" style="min-width:200px" placeholder="Product name, SKU…">
                                </div>
                                <div class="filter-group">
                                    <label>Category</label>
                                    <select class="filter-control">
                                        <option>All Categories</option>
                                        <option>Electronics</option>
                                        <option>Clothing</option>
                                        <option>Footwear</option>
                                        <option>Home &amp; Kitchen</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Severity</label>
                                    <select class="filter-control">
                                        <option>All Severities</option>
                                        <option>Critical (Out of Stock)</option>
                                        <option>Low Stock</option>
                                        <option>Watch List</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Sort By</label>
                                    <select class="filter-control">
                                        <option>Severity: High First</option>
                                        <option>Stock: Low to High</option>
                                        <option>Most Recent Alert</option>
                                        <option>Product Name A–Z</option>
                                    </select>
                                </div>
                                <div style="display:flex;gap:8px;align-items:flex-end">
                                    <button class="btn-filter"><i class="fa fa-search"></i> Filter</button>
                                    <a href="#" class="btn-filter-reset"><i class="fa fa-refresh"></i> Reset</a>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-wrap">
                            <table class="alert-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Stock vs Min</th>
                                        <th>Severity</th>
                                        <th>Alerted At</th>
                                        <th>Quick Restock</th>
                                        <th style="width:110px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- 1 — Critical / Out of Stock -->
                                    <tr class="row-critical">
                                        <td><span class="id-chip">1</span></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <img src="https://placehold.co/46x46/fce8e8/b22222?text=P" class="prod-thumb" alt="">
                                                <div>
                                                    <div class="prod-name">Sony WH-1000XM6</div>
                                                    <div class="prod-meta">SKU-00211 · CODE: SNY-WH1000XM6</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                        <td>
                                            <div class="gauge-wrap">
                                                <div class="gauge-numbers">
                                                    <span class="gauge-current" style="color:var(--red)">0</span>
                                                    <span class="gauge-divider">/</span>
                                                    <span class="gauge-min">10</span>
                                                </div>
                                                <div class="gauge-bar"><div class="gauge-fill" style="width:0%;background:var(--red)"></div></div>
                                                <div class="gauge-label">0% of threshold</div>
                                            </div>
                                        </td>
                                        <td><span class="severity sev-critical"><i class="fa fa-circle"></i> Critical</span></td>
                                        <td>
                                            <div class="time-cell">14 Jun 2026<small>9:14 AM</small></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;align-items:center">
                                                <input type="number" class="restock-input" placeholder="Qty" value="50">
                                                <button class="btn-restock" onclick="handleRestock(this)"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:5px">
                                                <div class="action-wrap">
                                                    <a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a>
                                                    <span class="tooltip-label">View Product</span>
                                                </div>
                                                <div class="action-wrap">
                                                    <a href="#" class="action-btn action-btn-edit"><i class="fa fa-pencil"></i></a>
                                                    <span class="tooltip-label">Edit Stock</span>
                                                </div>
                                                <div class="action-wrap">
                                                    <button class="action-btn action-btn-dismiss" onclick="handleDismiss(this)"><i class="fa fa-check"></i></button>
                                                    <span class="tooltip-label">Dismiss Alert</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 2 — Critical -->
                                    <tr class="row-critical">
                                        <td><span class="id-chip">2</span></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <img src="https://placehold.co/46x46/fce8e8/b22222?text=P" class="prod-thumb" alt="">
                                                <div>
                                                    <div class="prod-name">Dyson V15 Detect</div>
                                                    <div class="prod-meta">SKU-00688 · CODE: DYS-V15-DET</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Home &amp; Kitchen</span></td>
                                        <td>
                                            <div class="gauge-wrap">
                                                <div class="gauge-numbers">
                                                    <span class="gauge-current" style="color:var(--red)">0</span>
                                                    <span class="gauge-divider">/</span>
                                                    <span class="gauge-min">5</span>
                                                </div>
                                                <div class="gauge-bar"><div class="gauge-fill" style="width:0%;background:var(--red)"></div></div>
                                                <div class="gauge-label">0% of threshold</div>
                                            </div>
                                        </td>
                                        <td><span class="severity sev-critical"><i class="fa fa-circle"></i> Critical</span></td>
                                        <td>
                                            <div class="time-cell">14 Jun 2026<small>8:50 AM</small></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;align-items:center">
                                                <input type="number" class="restock-input" placeholder="Qty" value="20">
                                                <button class="btn-restock" onclick="handleRestock(this)"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:5px">
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a><span class="tooltip-label">View Product</span></div>
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-edit"><i class="fa fa-pencil"></i></a><span class="tooltip-label">Edit Stock</span></div>
                                                <div class="action-wrap"><button class="action-btn action-btn-dismiss" onclick="handleDismiss(this)"><i class="fa fa-check"></i></button><span class="tooltip-label">Dismiss Alert</span></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 3 — Low Stock -->
                                    <tr class="row-low">
                                        <td><span class="id-chip">3</span></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <img src="https://placehold.co/46x46/fff5cc/916a00?text=P" class="prod-thumb" alt="">
                                                <div>
                                                    <div class="prod-name">MacBook Pro 16" M4</div>
                                                    <div class="prod-meta">SKU-00076 · CODE: MBP16-M4-SLV</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                        <td>
                                            <div class="gauge-wrap">
                                                <div class="gauge-numbers">
                                                    <span class="gauge-current" style="color:var(--amber)">18</span>
                                                    <span class="gauge-divider">/</span>
                                                    <span class="gauge-min">20</span>
                                                </div>
                                                <div class="gauge-bar"><div class="gauge-fill" style="width:18%;background:var(--amber)"></div></div>
                                                <div class="gauge-label">90% depleted</div>
                                            </div>
                                        </td>
                                        <td><span class="severity sev-low"><i class="fa fa-exclamation-triangle"></i> Low Stock</span></td>
                                        <td>
                                            <div class="time-cell">13 Jun 2026<small>3:22 PM</small></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;align-items:center">
                                                <input type="number" class="restock-input" placeholder="Qty" value="30">
                                                <button class="btn-restock" onclick="handleRestock(this)"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:5px">
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a><span class="tooltip-label">View Product</span></div>
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-edit"><i class="fa fa-pencil"></i></a><span class="tooltip-label">Edit Stock</span></div>
                                                <div class="action-wrap"><button class="action-btn action-btn-dismiss" onclick="handleDismiss(this)"><i class="fa fa-check"></i></button><span class="tooltip-label">Dismiss Alert</span></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 4 — Low Stock -->
                                    <tr class="row-low">
                                        <td><span class="id-chip">4</span></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <img src="https://placehold.co/46x46/fff5cc/916a00?text=P" class="prod-thumb" alt="">
                                                <div>
                                                    <div class="prod-name">Nike Air Max 270</div>
                                                    <div class="prod-meta">SKU-00419 · CODE: NK-AM270-BLK-42</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Footwear</span></td>
                                        <td>
                                            <div class="gauge-wrap">
                                                <div class="gauge-numbers">
                                                    <span class="gauge-current" style="color:var(--amber)">7</span>
                                                    <span class="gauge-divider">/</span>
                                                    <span class="gauge-min">15</span>
                                                </div>
                                                <div class="gauge-bar"><div class="gauge-fill" style="width:7%;background:var(--amber)"></div></div>
                                                <div class="gauge-label">53% depleted</div>
                                            </div>
                                        </td>
                                        <td><span class="severity sev-low"><i class="fa fa-exclamation-triangle"></i> Low Stock</span></td>
                                        <td>
                                            <div class="time-cell">13 Jun 2026<small>11:05 AM</small></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;align-items:center">
                                                <input type="number" class="restock-input" placeholder="Qty" value="50">
                                                <button class="btn-restock" onclick="handleRestock(this)"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:5px">
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a><span class="tooltip-label">View Product</span></div>
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-edit"><i class="fa fa-pencil"></i></a><span class="tooltip-label">Edit Stock</span></div>
                                                <div class="action-wrap"><button class="action-btn action-btn-dismiss" onclick="handleDismiss(this)"><i class="fa fa-check"></i></button><span class="tooltip-label">Dismiss Alert</span></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 5 — Watch -->
                                    <tr>
                                        <td><span class="id-chip">5</span></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <img src="https://placehold.co/46x46/e8f2ff/0069d9?text=P" class="prod-thumb" alt="">
                                                <div>
                                                    <div class="prod-name">Levi's 511 Slim Jeans</div>
                                                    <div class="prod-meta">SKU-00532 · CODE: LVS-511-IND-32</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Clothing</span></td>
                                        <td>
                                            <div class="gauge-wrap">
                                                <div class="gauge-numbers">
                                                    <span class="gauge-current" style="color:var(--blue)">22</span>
                                                    <span class="gauge-divider">/</span>
                                                    <span class="gauge-min">20</span>
                                                </div>
                                                <div class="gauge-bar"><div class="gauge-fill" style="width:22%;background:var(--blue)"></div></div>
                                                <div class="gauge-label">Slightly above threshold</div>
                                            </div>
                                        </td>
                                        <td><span class="severity sev-watch"><i class="fa fa-eye"></i> Watch</span></td>
                                        <td>
                                            <div class="time-cell">12 Jun 2026<small>7:40 PM</small></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;align-items:center">
                                                <input type="number" class="restock-input" placeholder="Qty" value="100">
                                                <button class="btn-restock" onclick="handleRestock(this)"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:5px">
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a><span class="tooltip-label">View Product</span></div>
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-edit"><i class="fa fa-pencil"></i></a><span class="tooltip-label">Edit Stock</span></div>
                                                <div class="action-wrap"><button class="action-btn action-btn-dismiss" onclick="handleDismiss(this)"><i class="fa fa-check"></i></button><span class="tooltip-label">Dismiss Alert</span></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 6 — Critical -->
                                    <tr class="row-critical">
                                        <td><span class="id-chip">6</span></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <img src="https://placehold.co/46x46/fce8e8/b22222?text=P" class="prod-thumb" alt="">
                                                <div>
                                                    <div class="prod-name">Fitbit Charge 6</div>
                                                    <div class="prod-meta">SKU-00741 · CODE: FBT-CHG6-BLK</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Electronics</span></td>
                                        <td>
                                            <div class="gauge-wrap">
                                                <div class="gauge-numbers">
                                                    <span class="gauge-current" style="color:var(--red)">0</span>
                                                    <span class="gauge-divider">/</span>
                                                    <span class="gauge-min">15</span>
                                                </div>
                                                <div class="gauge-bar"><div class="gauge-fill" style="width:0%;background:var(--red)"></div></div>
                                                <div class="gauge-label">0% of threshold</div>
                                            </div>
                                        </td>
                                        <td><span class="severity sev-critical"><i class="fa fa-circle"></i> Critical</span></td>
                                        <td>
                                            <div class="time-cell">12 Jun 2026<small>2:10 PM</small></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;align-items:center">
                                                <input type="number" class="restock-input" placeholder="Qty" value="40">
                                                <button class="btn-restock" onclick="handleRestock(this)"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:5px">
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a><span class="tooltip-label">View Product</span></div>
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-edit"><i class="fa fa-pencil"></i></a><span class="tooltip-label">Edit Stock</span></div>
                                                <div class="action-wrap"><button class="action-btn action-btn-dismiss" onclick="handleDismiss(this)"><i class="fa fa-check"></i></button><span class="tooltip-label">Dismiss Alert</span></div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- 7 — Low Stock -->
                                    <tr class="row-low">
                                        <td><span class="id-chip">7</span></td>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:10px">
                                                <img src="https://placehold.co/46x46/fff5cc/916a00?text=P" class="prod-thumb" alt="">
                                                <div>
                                                    <div class="prod-name">Adidas Ultraboost 22</div>
                                                    <div class="prod-meta">SKU-00823 · CODE: ADI-UB22-WHT-44</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="cat-tag"><i class="fa fa-folder-o" style="font-size:10px"></i> Footwear</span></td>
                                        <td>
                                            <div class="gauge-wrap">
                                                <div class="gauge-numbers">
                                                    <span class="gauge-current" style="color:var(--amber)">4</span>
                                                    <span class="gauge-divider">/</span>
                                                    <span class="gauge-min">10</span>
                                                </div>
                                                <div class="gauge-bar"><div class="gauge-fill" style="width:4%;background:var(--amber)"></div></div>
                                                <div class="gauge-label">60% depleted</div>
                                            </div>
                                        </td>
                                        <td><span class="severity sev-low"><i class="fa fa-exclamation-triangle"></i> Low Stock</span></td>
                                        <td>
                                            <div class="time-cell">11 Jun 2026<small>5:30 PM</small></div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:6px;align-items:center">
                                                <input type="number" class="restock-input" placeholder="Qty" value="60">
                                                <button class="btn-restock" onclick="handleRestock(this)"><i class="fa fa-plus"></i> Add</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display:flex;gap:5px">
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-view"><i class="fa fa-eye"></i></a><span class="tooltip-label">View Product</span></div>
                                                <div class="action-wrap"><a href="#" class="action-btn action-btn-edit"><i class="fa fa-pencil"></i></a><span class="tooltip-label">Edit Stock</span></div>
                                                <div class="action-wrap"><button class="action-btn action-btn-dismiss" onclick="handleDismiss(this)"><i class="fa fa-check"></i></button><span class="tooltip-label">Dismiss Alert</span></div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="pag-row">
                            <div class="pag-info">Showing 1–7 of 74 alerts</div>
                            <nav>
                                <ul class="pagination mb-0" style="font-size:13px">
                                    <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                                    <li class="page-item active"><a class="page-link" href="#" style="background:var(--accent);border-color:var(--accent)">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">…</a></li>
                                    <li class="page-item"><a class="page-link" href="#">11</a></li>
                                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>

                <!-- ═══ RIGHT: Sidebar ═══ -->
                <div>

                    <!-- Top Critical Items -->
                    <div class="sidebar-section">
                        <div class="sidebar-header">
                            <h5>🔴 Most Critical</h5>
                        </div>
                        <div class="sidebar-body">
                            <div class="critical-item">
                                <div class="critical-dot" style="background:var(--red)"></div>
                                <span class="critical-name">Sony WH-1000XM6</span>
                                <span class="critical-stock">0 left</span>
                            </div>
                            <div class="critical-item">
                                <div class="critical-dot" style="background:var(--red)"></div>
                                <span class="critical-name">Dyson V15 Detect</span>
                                <span class="critical-stock">0 left</span>
                            </div>
                            <div class="critical-item">
                                <div class="critical-dot" style="background:var(--red)"></div>
                                <span class="critical-name">Fitbit Charge 6</span>
                                <span class="critical-stock">0 left</span>
                            </div>
                            <div class="critical-item">
                                <div class="critical-dot" style="background:var(--amber)"></div>
                                <span class="critical-name">Adidas Ultraboost 22</span>
                                <span class="critical-stock amber">4 left</span>
                            </div>
                            <div class="critical-item">
                                <div class="critical-dot" style="background:var(--amber)"></div>
                                <span class="critical-name">Nike Air Max 270</span>
                                <span class="critical-stock amber">7 left</span>
                            </div>
                        </div>
                    </div>

                    <!-- Alerts by Category -->
                    <div class="sidebar-section">
                        <div class="sidebar-header"><h5>Alerts by Category</h5></div>
                        <div class="sidebar-body">
                            <div class="cat-breakdown-row">
                                <span class="cat-breakdown-name">Electronics</span>
                                <div class="cat-breakdown-count">
                                    <span class="mini-pill red">8 critical</span>
                                    <span class="mini-pill amber">12 low</span>
                                </div>
                            </div>
                            <div class="cat-breakdown-row">
                                <span class="cat-breakdown-name">Footwear</span>
                                <div class="cat-breakdown-count">
                                    <span class="mini-pill red">2 critical</span>
                                    <span class="mini-pill amber">9 low</span>
                                </div>
                            </div>
                            <div class="cat-breakdown-row">
                                <span class="cat-breakdown-name">Clothing</span>
                                <div class="cat-breakdown-count">
                                    <span class="mini-pill red">1 critical</span>
                                    <span class="mini-pill amber">10 low</span>
                                </div>
                            </div>
                            <div class="cat-breakdown-row">
                                <span class="cat-breakdown-name">Home &amp; Kitchen</span>
                                <div class="cat-breakdown-count">
                                    <span class="mini-pill red">1 critical</span>
                                    <span class="mini-pill amber">7 low</span>
                                </div>
                            </div>
                            <div class="cat-breakdown-row">
                                <span class="cat-breakdown-name">Sports</span>
                                <div class="cat-breakdown-count">
                                    <span class="mini-pill amber">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Thresholds -->
                    <div class="sidebar-section">
                        <div class="sidebar-header"><h5>Alert Thresholds</h5></div>
                        <div class="sidebar-body">
                            <div class="threshold-row">
                                <div>
                                    <div class="threshold-label">Low Stock Threshold</div>
                                    <div class="threshold-sub">Alert when stock falls below</div>
                                </div>
                                <input type="number" class="threshold-input" value="20">
                            </div>
                            <div class="threshold-row">
                                <div>
                                    <div class="threshold-label">Watch List Threshold</div>
                                    <div class="threshold-sub">Monitor when approaching</div>
                                </div>
                                <input type="number" class="threshold-input" value="30">
                            </div>
                            <div class="threshold-row">
                                <div>
                                    <div class="threshold-label">Critical Threshold</div>
                                    <div class="threshold-sub">Immediate action needed</div>
                                </div>
                                <input type="number" class="threshold-input" value="0">
                            </div>
                            <div style="margin-top:14px">
                                <button class="btn-primary-dash" style="width:100%;justify-content:center;font-size:13px">
                                    <i class="fa fa-save"></i> Save Thresholds
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Preferences -->
                    <div class="sidebar-section">
                        <div class="sidebar-header"><h5>Notifications</h5></div>
                        <div class="sidebar-body">
                            <div class="notif-row">
                                <div>
                                    <div class="notif-label">Email Alerts</div>
                                    <div class="notif-sub">Send to admin email</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="notif-row">
                                <div>
                                    <div class="notif-label">Dashboard Banner</div>
                                    <div class="notif-sub">Show on admin dashboard</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="notif-row">
                                <div>
                                    <div class="notif-label">Daily Summary</div>
                                    <div class="notif-sub">Email digest every morning</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                            <div class="notif-row">
                                <div>
                                    <div class="notif-label">Auto-Disable Listings</div>
                                    <div class="notif-sub">Hide product when out of stock</div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-track"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /right sidebar -->

            </div><!-- /main-layout -->

        </div>
    </div>
</div>

@include('admin.footer')

<script>
// Quick restock button feedback
function handleRestock(btn) {
    const orig = btn.innerHTML;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    btn.disabled = true;
    setTimeout(() => {
        btn.innerHTML = '<i class="fa fa-check"></i> Done!';
        btn.style.background = 'var(--green)';
        btn.style.color = '#fff';
        btn.style.borderColor = 'var(--green)';
        // Fade out the row
        const row = btn.closest('tr');
        setTimeout(() => {
            row.style.transition = 'opacity .5s';
            row.style.opacity = '0.35';
            setTimeout(() => {
                btn.innerHTML = orig;
                btn.style.background = '';
                btn.style.color = '';
                btn.style.borderColor = '';
                btn.disabled = false;
                row.style.opacity = '1';
            }, 2000);
        }, 600);
    }, 700);
}

// Dismiss alert
function handleDismiss(btn) {
    const row = btn.closest('tr');
    row.style.transition = 'opacity .4s, transform .4s';
    row.style.opacity = '0';
    row.style.transform = 'translateX(20px)';
    setTimeout(() => {
        row.style.display = 'none';
    }, 400);
}

// Threshold save feedback
document.querySelector('.sidebar-section:nth-child(3) .btn-primary-dash')?.addEventListener('click', function() {
    const orig = this.innerHTML;
    this.innerHTML = '<i class="fa fa-check"></i> Saved!';
    this.style.background = 'var(--green)';
    setTimeout(() => {
        this.innerHTML = orig;
        this.style.background = '';
    }, 1800);
});
</script>