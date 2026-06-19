@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        --blue:          #0069d9;
        --blue-bg:       #e8f2ff;
        --purple:        #6d28d9;
        --purple-bg:     #ede9fe;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .creport-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .creport-page * { box-sizing: border-box; }

    /* ── Page header ───────────────────────────────────────── */
    .page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .page-header h1 { font-size: 20px; font-weight: 650; margin: 0; }
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

    /* ── Date bar ──────────────────────────────────────────── */
    .date-bar { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 14px 20px; margin-bottom: 20px; box-shadow: var(--shadow-card); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
    .date-bar-left { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .date-preset { display: inline-flex; align-items: center; padding: 6px 14px; border: 1px solid var(--border); border-radius: 20px; font-size: 12.5px; font-weight: 500; color: var(--text-secondary); cursor: pointer; transition: all .15s; background: var(--surface); }
    .date-preset:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-light); }
    .date-preset.active { border-color: var(--accent); color: var(--accent); background: var(--accent-light); font-weight: 600; }
    .date-input { height: 34px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 10px; font-size: 13px; color: var(--text-primary); background: var(--surface); outline: none; font-family: var(--font); }
    .date-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .btn-apply { height: 34px; display: inline-flex; align-items: center; gap: 5px; background: var(--accent); color: #fff; border: none; border-radius: var(--radius-sm); padding: 0 14px; font-size: 13px; font-weight: 600; cursor: pointer; }
    .btn-apply:hover { background: #252f70; }

    /* ── KPI strip ─────────────────────────────────────────── */
    .kpi-strip { display: grid; grid-template-columns: repeat(5,1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:1100px) { .kpi-strip { grid-template-columns: repeat(3,1fr); } }
    @media(max-width:650px)  { .kpi-strip { grid-template-columns: repeat(2,1fr); } }

    .kpi-tile { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 18px 18px 14px; box-shadow: var(--shadow-card); }
    .kpi-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
    .kpi-label { font-size: 11.5px; font-weight: 600; color: var(--text-hint); text-transform: uppercase; letter-spacing: .04em; }
    .kpi-icon { width: 34px; height: 34px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 14px; }
    .kpi-icon.green  { background: var(--green-bg);  color: var(--green); }
    .kpi-icon.blue   { background: var(--blue-bg);   color: var(--blue); }
    .kpi-icon.purple { background: var(--purple-bg); color: var(--purple); }
    .kpi-icon.amber  { background: var(--amber-bg);  color: var(--amber); }
    .kpi-icon.red    { background: var(--red-bg);    color: var(--red); }
    .kpi-value { font-size: 22px; font-weight: 750; color: var(--text-primary); line-height: 1; }
    .kpi-badge { display: inline-flex; align-items: center; gap: 3px; font-size: 11px; font-weight: 600; padding: 2px 7px; border-radius: 20px; margin-top: 7px; }
    .kpi-badge.up      { background: var(--green-bg); color: var(--green); }
    .kpi-badge.down    { background: var(--red-bg);   color: var(--red); }
    .kpi-badge.neutral { background: var(--bg);       color: var(--text-hint); }

    /* ── Section card ──────────────────────────────────────── */
    .sc { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
    .sc-head { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .sc-head h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .sc-body { padding: 20px; }
    .sc-sub { font-size: 12px; color: var(--text-hint); }

    /* ── Grid layouts ──────────────────────────────────────── */
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px; }
    .grid-3-1 { display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 20px; }
    @media(max-width:960px) { .grid-2,.grid-3,.grid-3-1 { grid-template-columns: 1fr; } }

    /* ── Chart wrappers ────────────────────────────────────── */
    .chart-lg { position: relative; height: 260px; }
    .chart-md { position: relative; height: 210px; }
    .chart-sm { position: relative; height: 175px; }

    /* ── Table ─────────────────────────────────────────────── */
    .data-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .data-table thead th { font-size: 11px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--text-hint); padding: 10px 16px; border-bottom: 1px solid var(--border); background: #fafafa; text-align: left; white-space: nowrap; }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .1s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table tbody td { padding: 12px 16px; vertical-align: middle; }
    .data-table tfoot td { padding: 12px 16px; border-top: 2px solid var(--border); font-weight: 700; font-size: 13px; background: #fafafa; }

    /* ── Customer avatar ───────────────────────────────────── */
    .cust-av { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; flex-shrink: 0; }
    .cust-name { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .cust-email { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }

    /* ── Rank numbers ──────────────────────────────────────── */
    .rank { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; font-size: 11px; font-weight: 700; background: var(--bg); color: var(--text-secondary); }
    .rank.gold   { background: #fff8e1; color: #b8860b; }
    .rank.silver { background: #f5f5f5; color: #707070; }
    .rank.bronze { background: #fdf0e8; color: #9c5400; }

    /* ── Segment pills ─────────────────────────────────────── */
    .seg-pill { display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; font-weight: 600; padding: 3px 9px; border-radius: 20px; }
    .seg-vip      { background: #fff8e1; color: #b8860b; }
    .seg-loyal    { background: var(--green-bg);  color: var(--green); }
    .seg-new      { background: var(--blue-bg);   color: var(--blue); }
    .seg-at-risk  { background: var(--red-bg);    color: var(--red); }
    .seg-dormant  { background: var(--bg);         color: var(--text-hint); }
    .seg-promising{ background: var(--purple-bg); color: var(--purple); }

    /* ── Growth badge ──────────────────────────────────────── */
    .growth { display: inline-flex; align-items: center; gap: 3px; font-size: 11.5px; font-weight: 600; padding: 2px 7px; border-radius: 20px; }
    .growth.up   { background: var(--green-bg); color: var(--green); }
    .growth.down { background: var(--red-bg);   color: var(--red); }

    /* ── Progress mini bar ─────────────────────────────────── */
    .prog-bar { height: 5px; border-radius: 10px; background: var(--bg); overflow: hidden; margin-top: 5px; }
    .prog-fill { height: 100%; border-radius: 10px; }

    /* ── Info rows ─────────────────────────────────────────── */
    .info-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid var(--bg); font-size: 13px; }
    .info-row:first-child { padding-top: 0; }
    .info-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .info-label { color: var(--text-hint); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .03em; }
    .info-value { font-weight: 600; color: var(--text-primary); }

    /* ── Funnel bars ───────────────────────────────────────── */
    .funnel-row { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
    .funnel-row:last-child { margin-bottom: 0; }
    .funnel-label { font-size: 12.5px; font-weight: 500; color: var(--text-secondary); width: 140px; flex-shrink: 0; }
    .funnel-bar-wrap { flex: 1; }
    .funnel-bar { height: 28px; border-radius: var(--radius-sm); display: flex; align-items: center; padding: 0 10px; font-size: 12px; font-weight: 700; color: #fff; transition: width .3s; }
    .funnel-count { font-size: 12.5px; font-weight: 700; color: var(--text-primary); width: 60px; text-align: right; flex-shrink: 0; }
    .funnel-pct   { font-size: 11.5px; color: var(--text-hint); width: 40px; text-align: right; flex-shrink: 0; }

    /* ── Cohort-style grid ─────────────────────────────────── */
    .cohort-grid { display: grid; grid-template-columns: 130px repeat(6,1fr); gap: 1px; background: var(--border); border-radius: var(--radius-sm); overflow: hidden; font-size: 12px; }
    .cohort-cell { background: var(--surface); padding: 8px 10px; text-align: center; }
    .cohort-cell.header { background: #fafafa; font-weight: 650; color: var(--text-hint); font-size: 11px; text-transform: uppercase; letter-spacing: .04em; }
    .cohort-cell.label  { text-align: left; font-weight: 500; color: var(--text-primary); }
    .cohort-cell.heat-5  { background: #e3f1ec; color: var(--green); font-weight: 700; }
    .cohort-cell.heat-4  { background: #edf6f2; color: var(--green); font-weight: 600; }
    .cohort-cell.heat-3  { background: #f5fbf8; color: var(--text-secondary); }
    .cohort-cell.heat-2  { background: var(--surface); color: var(--text-hint); }
    .cohort-cell.heat-1  { background: var(--bg);      color: var(--text-hint); font-size: 11px; }

    /* ── Location row ──────────────────────────────────────── */
    .loc-row { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .loc-row:first-child { padding-top: 0; }
    .loc-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .loc-flag { font-size: 18px; flex-shrink: 0; }
    .loc-name { flex: 1; font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .loc-bar-wrap { width: 80px; }
    .loc-bar { height: 5px; border-radius: 10px; background: var(--bg); overflow: hidden; }
    .loc-fill { height: 100%; border-radius: 10px; background: var(--accent); }
    .loc-count { font-size: 13px; font-weight: 700; color: var(--text-primary); width: 40px; text-align: right; flex-shrink: 0; }
    .loc-pct   { font-size: 11.5px; color: var(--text-hint); width: 36px; text-align: right; flex-shrink: 0; }

    /* ── Device row ────────────────────────────────────────── */
    .device-row { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .device-row:first-child { padding-top: 0; }
    .device-row:last-child  { border-bottom: none; }
    .device-icon-wrap { width: 34px; height: 34px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; }

    @media(max-width:768px) { .creport-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="creport-page">

            <!-- Page header -->
            <div class="page-header">
                <div>
                    <h1>Customer Report</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        Customer Report
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <a href="#" class="btn-secondary-dash"><i class="fa fa-print"></i> Print</a>
                    <a href="#" class="btn-secondary-dash"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <a href="#" class="btn-primary-dash"><i class="fa fa-download"></i> Export PDF</a>
                </div>
            </div>

            <!-- Date bar -->
            <div class="date-bar">
                <div class="date-bar-left">
                    <span style="font-size:12.5px;font-weight:600;color:var(--text-secondary);margin-right:4px">Period:</span>
                    <span class="date-preset">Today</span>
                    <span class="date-preset">This Week</span>
                    <span class="date-preset active">This Month</span>
                    <span class="date-preset">Last Month</span>
                    <span class="date-preset">This Year</span>
                    <span class="date-preset">Custom</span>
                </div>
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
                    <input type="date" class="date-input" value="2026-06-01">
                    <span style="color:var(--text-hint)">→</span>
                    <input type="date" class="date-input" value="2026-06-15">
                    <button class="btn-apply"><i class="fa fa-check"></i> Apply</button>
                </div>
            </div>

            <!-- KPI strip -->
            <div class="kpi-strip">

                <div class="kpi-tile">
                    <div class="kpi-top">
                        <span class="kpi-label">Total Customers</span>
                        <div class="kpi-icon blue"><i class="fa fa-users"></i></div>
                    </div>
                    <div class="kpi-value">14,560</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 8.3% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-top">
                        <span class="kpi-label">New Customers</span>
                        <div class="kpi-icon green"><i class="fa fa-user-plus"></i></div>
                    </div>
                    <div class="kpi-value">1,248</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 12.1% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-top">
                        <span class="kpi-label">Returning Rate</span>
                        <div class="kpi-icon purple"><i class="fa fa-repeat"></i></div>
                    </div>
                    <div class="kpi-value">38.4%</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 2.6% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-top">
                        <span class="kpi-label">Avg. LTV</span>
                        <div class="kpi-icon amber"><i class="fa fa-dollar"></i></div>
                    </div>
                    <div class="kpi-value">₹4,820</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 5.4% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-top">
                        <span class="kpi-label">Churn Rate</span>
                        <div class="kpi-icon red"><i class="fa fa-user-times"></i></div>
                    </div>
                    <div class="kpi-value">3.2%</div>
                    <div class="kpi-badge down"><i class="fa fa-arrow-down"></i> 0.4% improved</div>
                </div>

            </div>

            <!-- Row 1: Acquisition trend + New vs Returning donut -->
            <div class="grid-3-1">

                <!-- Customer acquisition line chart -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Customer Acquisition Over Time</h5>
                        <div style="display:flex;gap:6px">
                            <span class="date-preset active" style="font-size:11.5px;padding:4px 10px">Daily</span>
                            <span class="date-preset" style="font-size:11.5px;padding:4px 10px">Weekly</span>
                            <span class="date-preset" style="font-size:11.5px;padding:4px 10px">Monthly</span>
                        </div>
                    </div>
                    <div class="sc-body">
                        <div class="chart-lg">
                            <canvas id="acquisitionChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- New vs Returning donut -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>New vs Returning</h5>
                        <span class="sc-sub">This month</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-sm">
                            <canvas id="newVsReturningChart"></canvas>
                        </div>
                        <div style="margin-top:16px">
                            <div class="info-row">
                                <span style="display:flex;align-items:center;gap:6px;font-size:13px;font-weight:500">
                                    <span style="width:10px;height:10px;border-radius:50%;background:var(--accent);display:inline-block"></span>
                                    New Customers
                                </span>
                                <span style="font-weight:700;color:var(--accent)">62% · 9,027</span>
                            </div>
                            <div class="info-row">
                                <span style="display:flex;align-items:center;gap:6px;font-size:13px;font-weight:500">
                                    <span style="width:10px;height:10px;border-radius:50%;background:var(--green);display:inline-block"></span>
                                    Returning
                                </span>
                                <span style="font-weight:700;color:var(--green)">38% · 5,533</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Row 2: Segments + Funnel + Device -->
            <div class="grid-3">

                <!-- Customer Segments -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Customer Segments</h5>
                        <span class="sc-sub">RFM-based</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-md">
                            <canvas id="segmentChart"></canvas>
                        </div>
                        <div style="margin-top:14px;display:flex;flex-direction:column;gap:8px">
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:12.5px">
                                <span style="display:flex;align-items:center;gap:6px"><span style="width:10px;height:10px;border-radius:2px;background:#b8860b;display:inline-block"></span> VIP</span>
                                <span style="font-weight:700;color:var(--text-primary)">820 &nbsp;<span style="color:var(--text-hint);font-weight:400">(5.6%)</span></span>
                            </div>
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:12.5px">
                                <span style="display:flex;align-items:center;gap:6px"><span style="width:10px;height:10px;border-radius:2px;background:var(--green);display:inline-block"></span> Loyal</span>
                                <span style="font-weight:700">2,184 &nbsp;<span style="color:var(--text-hint);font-weight:400">(15%)</span></span>
                            </div>
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:12.5px">
                                <span style="display:flex;align-items:center;gap:6px"><span style="width:10px;height:10px;border-radius:2px;background:var(--blue);display:inline-block"></span> New</span>
                                <span style="font-weight:700">4,368 &nbsp;<span style="color:var(--text-hint);font-weight:400">(30%)</span></span>
                            </div>
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:12.5px">
                                <span style="display:flex;align-items:center;gap:6px"><span style="width:10px;height:10px;border-radius:2px;background:var(--purple);display:inline-block"></span> Promising</span>
                                <span style="font-weight:700">2,912 &nbsp;<span style="color:var(--text-hint);font-weight:400">(20%)</span></span>
                            </div>
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:12.5px">
                                <span style="display:flex;align-items:center;gap:6px"><span style="width:10px;height:10px;border-radius:2px;background:var(--red);display:inline-block"></span> At Risk</span>
                                <span style="font-weight:700">2,184 &nbsp;<span style="color:var(--text-hint);font-weight:400">(15%)</span></span>
                            </div>
                            <div style="display:flex;align-items:center;justify-content:space-between;font-size:12.5px">
                                <span style="display:flex;align-items:center;gap:6px"><span style="width:10px;height:10px;border-radius:2px;background:var(--text-hint);display:inline-block"></span> Dormant</span>
                                <span style="font-weight:700">2,092 &nbsp;<span style="color:var(--text-hint);font-weight:400">(14.4%)</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acquisition Funnel -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Acquisition Funnel</h5>
                        <span class="sc-sub">This month</span>
                    </div>
                    <div class="sc-body">
                        <div class="funnel-row">
                            <span class="funnel-label">Store Visitors</span>
                            <div class="funnel-bar-wrap">
                                <div class="funnel-bar" style="width:100%;background:var(--accent)">100%</div>
                            </div>
                            <span class="funnel-count">42,810</span>
                        </div>
                        <div class="funnel-row">
                            <span class="funnel-label">Signed Up</span>
                            <div class="funnel-bar-wrap">
                                <div class="funnel-bar" style="width:72%;background:#4a5bbf">72%</div>
                            </div>
                            <span class="funnel-count">30,823</span>
                        </div>
                        <div class="funnel-row">
                            <span class="funnel-label">Added to Cart</span>
                            <div class="funnel-bar-wrap">
                                <div class="funnel-bar" style="width:54%;background:var(--purple)">54%</div>
                            </div>
                            <span class="funnel-count">23,117</span>
                        </div>
                        <div class="funnel-row">
                            <span class="funnel-label">Reached Checkout</span>
                            <div class="funnel-bar-wrap">
                                <div class="funnel-bar" style="width:38%;background:var(--amber)">38%</div>
                            </div>
                            <span class="funnel-count">16,268</span>
                        </div>
                        <div class="funnel-row">
                            <span class="funnel-label">Purchased</span>
                            <div class="funnel-bar-wrap">
                                <div class="funnel-bar" style="width:29%;background:var(--green)">29%</div>
                            </div>
                            <span class="funnel-count">12,415</span>
                        </div>
                        <div class="funnel-row" style="margin-bottom:0">
                            <span class="funnel-label">Repeat Purchase</span>
                            <div class="funnel-bar-wrap">
                                <div class="funnel-bar" style="width:11%;background:var(--green);opacity:.7">11%</div>
                            </div>
                            <span class="funnel-count">4,709</span>
                        </div>
                    </div>
                </div>

                <!-- Device & Platform -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Device & Platform</h5>
                        <span class="sc-sub">Sessions this month</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-sm" style="height:150px">
                            <canvas id="deviceChart"></canvas>
                        </div>
                        <div style="margin-top:16px">
                            <div class="device-row">
                                <div class="device-icon-wrap" style="background:var(--blue-bg);color:var(--blue)"><i class="fa fa-desktop"></i></div>
                                <div style="flex:1">
                                    <div style="display:flex;justify-content:space-between;font-size:13px;font-weight:500">
                                        <span>Desktop</span><span style="font-weight:700">52%</span>
                                    </div>
                                    <div class="prog-bar"><div class="prog-fill" style="width:52%;background:var(--blue)"></div></div>
                                </div>
                            </div>
                            <div class="device-row">
                                <div class="device-icon-wrap" style="background:var(--green-bg);color:var(--green)"><i class="fa fa-mobile"></i></div>
                                <div style="flex:1">
                                    <div style="display:flex;justify-content:space-between;font-size:13px;font-weight:500">
                                        <span>Mobile</span><span style="font-weight:700">38%</span>
                                    </div>
                                    <div class="prog-bar"><div class="prog-fill" style="width:38%;background:var(--green)"></div></div>
                                </div>
                            </div>
                            <div class="device-row">
                                <div class="device-icon-wrap" style="background:var(--purple-bg);color:var(--purple)"><i class="fa fa-tablet"></i></div>
                                <div style="flex:1">
                                    <div style="display:flex;justify-content:space-between;font-size:13px;font-weight:500">
                                        <span>Tablet</span><span style="font-weight:700">10%</span>
                                    </div>
                                    <div class="prog-bar"><div class="prog-fill" style="width:10%;background:var(--purple)"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Row 3: Retention Cohort -->
            <div class="sc" style="margin-bottom:20px">
                <div class="sc-head">
                    <h5>Retention Cohort Analysis</h5>
                    <span class="sc-sub">% of customers who returned each month after first purchase</span>
                </div>
                <div class="sc-body" style="overflow-x:auto;padding:0">
                    <div style="min-width:640px;padding:16px 20px">
                        <div class="cohort-grid">
                            <div class="cohort-cell header label">Cohort</div>
                            <div class="cohort-cell header">M+0</div>
                            <div class="cohort-cell header">M+1</div>
                            <div class="cohort-cell header">M+2</div>
                            <div class="cohort-cell header">M+3</div>
                            <div class="cohort-cell header">M+4</div>
                            <div class="cohort-cell header">M+5</div>

                            <div class="cohort-cell label">Jan 2026</div>
                            <div class="cohort-cell heat-5">100%</div>
                            <div class="cohort-cell heat-4">42%</div>
                            <div class="cohort-cell heat-4">36%</div>
                            <div class="cohort-cell heat-3">29%</div>
                            <div class="cohort-cell heat-3">24%</div>
                            <div class="cohort-cell heat-2">19%</div>

                            <div class="cohort-cell label">Feb 2026</div>
                            <div class="cohort-cell heat-5">100%</div>
                            <div class="cohort-cell heat-4">44%</div>
                            <div class="cohort-cell heat-4">38%</div>
                            <div class="cohort-cell heat-3">31%</div>
                            <div class="cohort-cell heat-3">26%</div>
                            <div class="cohort-cell heat-1">—</div>

                            <div class="cohort-cell label">Mar 2026</div>
                            <div class="cohort-cell heat-5">100%</div>
                            <div class="cohort-cell heat-5">47%</div>
                            <div class="cohort-cell heat-4">40%</div>
                            <div class="cohort-cell heat-4">33%</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>

                            <div class="cohort-cell label">Apr 2026</div>
                            <div class="cohort-cell heat-5">100%</div>
                            <div class="cohort-cell heat-4">45%</div>
                            <div class="cohort-cell heat-4">37%</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>

                            <div class="cohort-cell label">May 2026</div>
                            <div class="cohort-cell heat-5">100%</div>
                            <div class="cohort-cell heat-5">49%</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>

                            <div class="cohort-cell label">Jun 2026</div>
                            <div class="cohort-cell heat-5">100%</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>
                            <div class="cohort-cell heat-1">—</div>
                        </div>
                        <div style="margin-top:14px;display:flex;gap:12px;align-items:center;font-size:12px;color:var(--text-hint)">
                            <span>Retention intensity:</span>
                            <span style="display:flex;align-items:center;gap:4px"><span style="width:14px;height:14px;background:#e3f1ec;border-radius:3px;display:inline-block"></span> High (40%+)</span>
                            <span style="display:flex;align-items:center;gap:4px"><span style="width:14px;height:14px;background:#f5fbf8;border-radius:3px;display:inline-block"></span> Mid (25–40%)</span>
                            <span style="display:flex;align-items:center;gap:4px"><span style="width:14px;height:14px;background:var(--surface);border:1px solid var(--border);border-radius:3px;display:inline-block"></span> Low (&lt;25%)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 4: Top Customers + Location -->
            <div class="grid-3-1">

                <!-- Top customers by spend -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Top Customers by Lifetime Value</h5>
                        <a href="#" style="font-size:12px;color:var(--accent);text-decoration:none;font-weight:500">View All →</a>
                    </div>
                    <div style="overflow-x:auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Segment</th>
                                    <th>Orders</th>
                                    <th>Total Spent</th>
                                    <th>Avg. Order</th>
                                    <th>Last Order</th>
                                    <th>Growth</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="rank gold">1</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:9px">
                                            <div class="cust-av" style="background:#fff8e1;color:#b8860b">RS</div>
                                            <div>
                                                <div class="cust-name">Rahul Sharma</div>
                                                <div class="cust-email">rahul.s@gmail.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="seg-pill seg-vip">⭐ VIP</span></td>
                                    <td style="font-weight:600">48</td>
                                    <td style="font-weight:700;color:var(--text-primary)">₹72,400</td>
                                    <td style="color:var(--text-secondary)">₹1,508</td>
                                    <td style="color:var(--text-hint);font-size:12px">14 Jun 2026</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 28%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="rank silver">2</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:9px">
                                            <div class="cust-av" style="background:var(--blue-bg);color:var(--blue)">PK</div>
                                            <div>
                                                <div class="cust-name">Priya Kapoor</div>
                                                <div class="cust-email">priya.k@yahoo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="seg-pill seg-vip">⭐ VIP</span></td>
                                    <td style="font-weight:600">41</td>
                                    <td style="font-weight:700;color:var(--text-primary)">₹68,150</td>
                                    <td style="color:var(--text-secondary)">₹1,662</td>
                                    <td style="color:var(--text-hint);font-size:12px">13 Jun 2026</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 19%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="rank bronze">3</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:9px">
                                            <div class="cust-av" style="background:var(--green-bg);color:var(--green)">AM</div>
                                            <div>
                                                <div class="cust-name">Amit Mehta</div>
                                                <div class="cust-email">amit.m@hotmail.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="seg-pill seg-loyal">Loyal</span></td>
                                    <td style="font-weight:600">36</td>
                                    <td style="font-weight:700;color:var(--text-primary)">₹54,900</td>
                                    <td style="color:var(--text-secondary)">₹1,525</td>
                                    <td style="color:var(--text-hint);font-size:12px">12 Jun 2026</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 11%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="rank">4</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:9px">
                                            <div class="cust-av" style="background:var(--purple-bg);color:var(--purple)">SK</div>
                                            <div>
                                                <div class="cust-name">Sunita Kumar</div>
                                                <div class="cust-email">sunita.k@gmail.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="seg-pill seg-loyal">Loyal</span></td>
                                    <td style="font-weight:600">29</td>
                                    <td style="font-weight:700;color:var(--text-primary)">₹46,200</td>
                                    <td style="color:var(--text-secondary)">₹1,593</td>
                                    <td style="color:var(--text-hint);font-size:12px">10 Jun 2026</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 7%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="rank">5</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:9px">
                                            <div class="cust-av" style="background:var(--amber-bg);color:var(--amber)">VR</div>
                                            <div>
                                                <div class="cust-name">Vijay Rao</div>
                                                <div class="cust-email">vijay.r@rediffmail.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="seg-pill seg-promising">Promising</span></td>
                                    <td style="font-weight:600">22</td>
                                    <td style="font-weight:700;color:var(--text-primary)">₹39,600</td>
                                    <td style="color:var(--text-secondary)">₹1,800</td>
                                    <td style="color:var(--text-hint);font-size:12px">09 Jun 2026</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 32%</span></td>
                                </tr>
                                <tr>
                                    <td><span class="rank">6</span></td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:9px">
                                            <div class="cust-av" style="background:var(--red-bg);color:var(--red)">NP</div>
                                            <div>
                                                <div class="cust-name">Neha Patel</div>
                                                <div class="cust-email">neha.p@gmail.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="seg-pill seg-at-risk">At Risk</span></td>
                                    <td style="font-weight:600">18</td>
                                    <td style="font-weight:700;color:var(--text-primary)">₹32,400</td>
                                    <td style="color:var(--text-secondary)">₹1,800</td>
                                    <td style="color:var(--text-hint);font-size:12px">22 Apr 2026</td>
                                    <td><span class="growth down"><i class="fa fa-arrow-down"></i> 14%</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">Top 6 Total</td>
                                    <td style="color:var(--text-secondary)">194 orders</td>
                                    <td style="color:var(--accent)">₹3,13,650</td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Location breakdown -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Customers by Location</h5>
                        <span class="sc-sub">Top cities</span>
                    </div>
                    <div class="sc-body">
                        <div class="loc-row">
                            <span class="loc-flag">🏙️</span>
                            <span class="loc-name">Mumbai</span>
                            <div class="loc-bar-wrap"><div class="loc-bar"><div class="loc-fill" style="width:82%"></div></div></div>
                            <span class="loc-count">3,284</span>
                            <span class="loc-pct">22.5%</span>
                        </div>
                        <div class="loc-row">
                            <span class="loc-flag">🏙️</span>
                            <span class="loc-name">Delhi</span>
                            <div class="loc-bar-wrap"><div class="loc-bar"><div class="loc-fill" style="width:70%"></div></div></div>
                            <span class="loc-count">2,766</span>
                            <span class="loc-pct">19.0%</span>
                        </div>
                        <div class="loc-row">
                            <span class="loc-flag">🏙️</span>
                            <span class="loc-name">Bangalore</span>
                            <div class="loc-bar-wrap"><div class="loc-bar"><div class="loc-fill" style="width:58%"></div></div></div>
                            <span class="loc-count">2,330</span>
                            <span class="loc-pct">16.0%</span>
                        </div>
                        <div class="loc-row">
                            <span class="loc-flag">🏙️</span>
                            <span class="loc-name">Hyderabad</span>
                            <div class="loc-bar-wrap"><div class="loc-bar"><div class="loc-fill" style="width:42%"></div></div></div>
                            <span class="loc-count">1,748</span>
                            <span class="loc-pct">12.0%</span>
                        </div>
                        <div class="loc-row">
                            <span class="loc-flag">🏙️</span>
                            <span class="loc-name">Chennai</span>
                            <div class="loc-bar-wrap"><div class="loc-bar"><div class="loc-fill" style="width:30%"></div></div></div>
                            <span class="loc-count">1,311</span>
                            <span class="loc-pct">9.0%</span>
                        </div>
                        <div class="loc-row">
                            <span class="loc-flag">🏙️</span>
                            <span class="loc-name">Pune</span>
                            <div class="loc-bar-wrap"><div class="loc-bar"><div class="loc-fill" style="width:22%"></div></div></div>
                            <span class="loc-count">1,019</span>
                            <span class="loc-pct">7.0%</span>
                        </div>
                        <div class="loc-row">
                            <span class="loc-flag">🗺️</span>
                            <span class="loc-name">Others</span>
                            <div class="loc-bar-wrap"><div class="loc-bar"><div class="loc-fill" style="width:15%;background:var(--text-hint)"></div></div></div>
                            <span class="loc-count">2,102</span>
                            <span class="loc-pct">14.5%</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Row 5: Summary metrics -->
            <div class="grid-2">

                <!-- Customer health metrics -->
                <div class="sc">
                    <div class="sc-head"><h5>Customer Health Metrics</h5><span class="sc-sub">Jun 2026</span></div>
                    <div class="sc-body">
                        <div class="info-row">
                            <span class="info-label">Total Registered</span>
                            <span class="info-value">14,560</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Active This Month</span>
                            <span class="info-value">8,734 <span style="font-size:11.5px;color:var(--text-hint)">(59.9%)</span></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">New This Month</span>
                            <span class="info-value" style="color:var(--green)">+ 1,248</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Churned This Month</span>
                            <span class="info-value" style="color:var(--red)">− 466 (3.2%)</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Avg. Orders / Customer</span>
                            <span class="info-value">3.8</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Avg. Lifetime Value</span>
                            <span class="info-value">₹4,820</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Avg. Days Between Orders</span>
                            <span class="info-value">18 days</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Net Promoter Score</span>
                            <span class="info-value" style="color:var(--green)">+42 <span style="font-size:11.5px;color:var(--text-hint)">(Good)</span></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Avg. Session Duration</span>
                            <span class="info-value">4m 38s</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Cart Abandonment Rate</span>
                            <span class="info-value" style="color:var(--amber)">28.4%</span>
                        </div>
                    </div>
                </div>

                <!-- Churn & retention trend -->
                <div class="sc">
                    <div class="sc-head"><h5>Churn vs Retention Trend</h5><span class="sc-sub">Last 6 months</span></div>
                    <div class="sc-body">
                        <div class="chart-lg" style="height:220px">
                            <canvas id="churnChart"></canvas>
                        </div>
                        <div style="display:flex;justify-content:center;gap:20px;margin-top:12px;font-size:12px">
                            <span style="display:flex;align-items:center;gap:5px;color:var(--text-secondary)"><span style="width:10px;height:10px;border-radius:50%;background:var(--green);display:inline-block"></span> Retained</span>
                            <span style="display:flex;align-items:center;gap:5px;color:var(--text-secondary)"><span style="width:10px;height:10px;border-radius:50%;background:var(--red);display:inline-block"></span> Churned</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
/* ── Acquisition line chart ────────────────────────────────── */
(function(){
    const ctx = document.getElementById('acquisitionChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'],
            datasets: [
                {
                    label: 'New Customers',
                    data: [72,88,65,95,82,110,78,104,91,98,86,115,102,108,120],
                    fill: true, tension: 0.45,
                    borderColor: '#303d89', borderWidth: 2.5,
                    pointRadius: 3, pointHoverRadius: 6,
                    pointBackgroundColor: '#303d89',
                    backgroundColor: (ctx) => {
                        const chart = ctx.chart;
                        const { ctx: c, chartArea } = chart;
                        if (!chartArea) return 'transparent';
                        const g = c.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                        g.addColorStop(0, 'rgba(48,61,137,.18)');
                        g.addColorStop(1, 'rgba(48,61,137,0)');
                        return g;
                    }
                },
                {
                    label: 'Returning',
                    data: [44,52,40,61,55,72,50,68,58,63,55,74,66,70,78],
                    fill: false, tension: 0.45,
                    borderColor: '#007a5e', borderWidth: 2,
                    pointRadius: 2, pointHoverRadius: 5,
                    borderDash: [5,3]
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { font: { size: 11 }, boxWidth: 10, padding: 14 } },
                tooltip: { backgroundColor: '#202223', cornerRadius: 8, padding: 10 }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#8c9196', font: { size: 11 } }, border: { display: false } },
                y: { grid: { color: '#f1f2f4' }, border: { display: false }, ticks: { color: '#8c9196', font: { size: 11 } } }
            }
        }
    });
})();

/* ── New vs Returning donut ────────────────────────────────── */
(function(){
    const ctx = document.getElementById('newVsReturningChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['New','Returning'],
            datasets: [{ data: [62,38], backgroundColor: ['#303d89','#007a5e'], borderWidth: 2, borderColor: '#fff', hoverOffset: 6 }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '70%', plugins: { legend: { display: false } } }
    });
})();

/* ── Segment doughnut ──────────────────────────────────────── */
(function(){
    const ctx = document.getElementById('segmentChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['VIP','Loyal','New','Promising','At Risk','Dormant'],
            datasets: [{ data: [5.6,15,30,20,15,14.4], backgroundColor: ['#b8860b','#007a5e','#0069d9','#6d28d9','#b22222','#8c9196'], borderWidth: 2, borderColor: '#fff', hoverOffset: 5 }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { display: false } } }
    });
})();

/* ── Device doughnut ───────────────────────────────────────── */
(function(){
    const ctx = document.getElementById('deviceChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Desktop','Mobile','Tablet'],
            datasets: [{ data: [52,38,10], backgroundColor: ['#0069d9','#007a5e','#6d28d9'], borderWidth: 2, borderColor: '#fff', hoverOffset: 5 }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '68%', plugins: { legend: { display: false } } }
    });
})();

/* ── Churn vs Retention bar ────────────────────────────────── */
(function(){
    const ctx = document.getElementById('churnChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun'],
            datasets: [
                { label: 'Retained', data: [11200,11650,12100,12580,13240,14094], backgroundColor: '#007a5e', borderRadius: 5, borderSkipped: false },
                { label: 'Churned',  data: [520,490,430,510,480,466],            backgroundColor: '#fce8e8', borderRadius: 5, borderSkipped: false }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { backgroundColor: '#202223', cornerRadius: 8 }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#8c9196', font: { size: 11 } }, border: { display: false } },
                y: { grid: { color: '#f1f2f4' }, border: { display: false }, ticks: { color: '#8c9196', font: { size: 11 }, callback: v => (v/1000).toFixed(0)+'k' } }
            }
        }
    });
})();

/* ── Date preset interaction ───────────────────────────────── */
document.querySelectorAll('.date-bar .date-preset').forEach(el => {
    el.addEventListener('click', function(){
        this.closest('.date-bar-left').querySelectorAll('.date-preset').forEach(e => e.classList.remove('active'));
        this.classList.add('active');
    });
});
document.querySelectorAll('.sc-head .date-preset').forEach(el => {
    el.addEventListener('click', function(){
        this.closest('.sc-head').querySelectorAll('.date-preset').forEach(e => e.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>