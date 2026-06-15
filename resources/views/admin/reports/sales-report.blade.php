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

    .report-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .report-page * { box-sizing: border-box; }

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

    /* ── Date range bar ────────────────────────────────────── */
    .date-bar {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); padding: 14px 20px;
        margin-bottom: 20px; box-shadow: var(--shadow-card);
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 12px;
    }
    .date-bar-left { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .date-preset { display: inline-flex; align-items: center; padding: 6px 14px; border: 1px solid var(--border); border-radius: 20px; font-size: 12.5px; font-weight: 500; color: var(--text-secondary); cursor: pointer; transition: all .15s; background: var(--surface); }
    .date-preset:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-light); }
    .date-preset.active { border-color: var(--accent); color: var(--accent); background: var(--accent-light); font-weight: 600; }
    .date-separator { color: var(--text-hint); font-size: 13px; }
    .date-input { height: 34px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 10px; font-size: 13px; color: var(--text-primary); background: var(--surface); outline: none; font-family: var(--font); }
    .date-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .btn-apply { height: 34px; display: inline-flex; align-items: center; gap: 5px; background: var(--accent); color: #fff; border: none; border-radius: var(--radius-sm); padding: 0 14px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font); }
    .btn-apply:hover { background: #252f70; }

    /* ── KPI strip ─────────────────────────────────────────── */
    .kpi-strip { display: grid; grid-template-columns: repeat(5,1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:1100px) { .kpi-strip { grid-template-columns: repeat(3,1fr); } }
    @media(max-width:700px)  { .kpi-strip { grid-template-columns: repeat(2,1fr); } }

    .kpi-tile { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 18px 18px 14px; box-shadow: var(--shadow-card); }
    .kpi-tile-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; }
    .kpi-tile-label { font-size: 11.5px; font-weight: 600; color: var(--text-hint); text-transform: uppercase; letter-spacing: .04em; }
    .kpi-tile-icon { width: 34px; height: 34px; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0; }
    .kpi-tile-icon.green  { background: var(--green-bg);  color: var(--green); }
    .kpi-tile-icon.blue   { background: var(--blue-bg);   color: var(--blue); }
    .kpi-tile-icon.amber  { background: var(--amber-bg);  color: var(--amber); }
    .kpi-tile-icon.purple { background: var(--purple-bg); color: var(--purple); }
    .kpi-tile-icon.red    { background: var(--red-bg);    color: var(--red); }
    .kpi-value { font-size: 22px; font-weight: 750; color: var(--text-primary); line-height: 1; }
    .kpi-badge { display: inline-flex; align-items: center; gap: 3px; font-size: 11px; font-weight: 600; padding: 2px 7px; border-radius: 20px; margin-top: 7px; }
    .kpi-badge.up   { background: var(--green-bg); color: var(--green); }
    .kpi-badge.down { background: var(--red-bg);   color: var(--red); }
    .kpi-badge.neutral { background: var(--bg); color: var(--text-hint); }

    /* ── Two-col charts ────────────────────────────────────── */
    .charts-2col { display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 20px; }
    @media(max-width:900px) { .charts-2col { grid-template-columns: 1fr; } }

    .charts-3col { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px; }
    @media(max-width:900px) { .charts-3col { grid-template-columns: 1fr; } }

    /* ── Section card ──────────────────────────────────────── */
    .sc { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
    .sc-head { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .sc-head h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .sc-body { padding: 20px; }
    .sc-head-sub { font-size: 12px; color: var(--text-hint); }

    /* ── Chart wrap ────────────────────────────────────────── */
    .chart-wrap-lg { position: relative; height: 260px; }
    .chart-wrap-md { position: relative; height: 220px; }
    .chart-wrap-sm { position: relative; height: 180px; }

    /* ── Summary table ─────────────────────────────────────── */
    .sum-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .sum-table thead th { font-size: 11px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--text-hint); padding: 9px 14px; border-bottom: 1px solid var(--border); background: #fafafa; text-align: left; white-space: nowrap; }
    .sum-table tbody tr { border-bottom: 1px solid var(--border); transition: background .1s; }
    .sum-table tbody tr:last-child { border-bottom: none; }
    .sum-table tbody tr:hover { background: #fafbfc; }
    .sum-table tbody td { padding: 12px 14px; vertical-align: middle; color: var(--text-primary); }
    .sum-table tfoot td { padding: 12px 14px; border-top: 2px solid var(--border); font-weight: 700; font-size: 13px; background: #fafafa; }

    /* ── ID chip ───────────────────────────────────────────── */
    .rank-num { display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; border-radius: 50%; font-size: 11px; font-weight: 700; background: var(--bg); color: var(--text-secondary); flex-shrink: 0; }
    .rank-num.gold   { background: #fff8e1; color: #b8860b; }
    .rank-num.silver { background: #f5f5f5; color: #707070; }
    .rank-num.bronze { background: #fdf0e8; color: #9c5400; }

    /* ── Product cell ──────────────────────────────────────── */
    .prod-thumb { width: 40px; height: 40px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; }
    .prod-name-sm { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .prod-cat-sm  { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }

    /* ── Progress bar ──────────────────────────────────────── */
    .prog-bar { height: 5px; border-radius: 10px; background: var(--bg); overflow: hidden; margin-top: 5px; width: 100px; }
    .prog-fill { height: 100%; border-radius: 10px; }

    /* ── Revenue figure ────────────────────────────────────── */
    .rev-cell { font-size: 13.5px; font-weight: 700; color: var(--text-primary); }
    .units-cell { font-size: 13px; color: var(--text-secondary); font-weight: 600; }

    /* ── Growth badge ──────────────────────────────────────── */
    .growth { display: inline-flex; align-items: center; gap: 3px; font-size: 11.5px; font-weight: 600; padding: 2px 7px; border-radius: 20px; }
    .growth.up   { background: var(--green-bg); color: var(--green); }
    .growth.down { background: var(--red-bg);   color: var(--red); }

    /* ── Category row ──────────────────────────────────────── */
    .cat-row { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .cat-row:first-child { padding-top: 0; }
    .cat-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .cat-color-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .cat-row-name  { flex: 1; font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .cat-row-rev   { font-size: 13px; font-weight: 700; color: var(--text-primary); }
    .cat-row-pct   { font-size: 11.5px; color: var(--text-hint); }

    /* ── Info rows ─────────────────────────────────────────── */
    .info-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid var(--bg); font-size: 13px; }
    .info-row:first-child { padding-top: 0; }
    .info-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .info-label { color: var(--text-hint); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .03em; }
    .info-value { font-weight: 600; color: var(--text-primary); }

    /* ── Channel pills ─────────────────────────────────────── */
    .channel-pill { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
    .ch-online  { background: var(--accent-light); color: var(--accent); }
    .ch-mobile  { background: var(--purple-bg);    color: var(--purple); }
    .ch-offline { background: var(--amber-bg);     color: var(--amber); }

    /* ── Order trend table ─────────────────────────────────── */
    .trend-dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 4px; }

    /* ── Period comparison ─────────────────────────────────── */
    .compare-strip { display: grid; grid-template-columns: 1fr 1fr; gap: 1px; background: var(--border); border-radius: var(--radius-sm); overflow: hidden; margin-bottom: 14px; }
    .compare-cell { background: var(--surface); padding: 12px 16px; }
    .compare-cell-label { font-size: 11px; font-weight: 600; color: var(--text-hint); text-transform: uppercase; letter-spacing: .04em; }
    .compare-cell-value { font-size: 20px; font-weight: 750; color: var(--text-primary); margin-top: 3px; }
    .compare-cell-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }

    @media(max-width:768px) { .report-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="report-page">

            <!-- ── Page Header ── -->
            <div class="page-header">
                <div>
                    <h1>Sales Report</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        Sales Report
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <a href="#" class="btn-secondary-dash"><i class="fa fa-print"></i> Print</a>
                    <a href="#" class="btn-secondary-dash"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                    <a href="#" class="btn-primary-dash"><i class="fa fa-download"></i> Export PDF</a>
                </div>
            </div>

            <!-- ── Date Range Bar ── -->
            <div class="date-bar">
                <div class="date-bar-left">
                    <span style="font-size:12.5px;font-weight:600;color:var(--text-secondary);margin-right:4px">Period:</span>
                    <span class="date-preset">Today</span>
                    <span class="date-preset">Yesterday</span>
                    <span class="date-preset active">This Month</span>
                    <span class="date-preset">Last Month</span>
                    <span class="date-preset">This Year</span>
                    <span class="date-preset">Custom</span>
                </div>
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap">
                    <input type="date" class="date-input" value="2026-06-01">
                    <span style="color:var(--text-hint);font-size:13px">→</span>
                    <input type="date" class="date-input" value="2026-06-15">
                    <button class="btn-apply"><i class="fa fa-check"></i> Apply</button>
                </div>
            </div>

            <!-- ── KPI Strip ── -->
            <div class="kpi-strip">

                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Total Revenue</span>
                        <div class="kpi-tile-icon green"><i class="fa fa-inr"></i></div>
                    </div>
                    <div class="kpi-value">₹12,54,890</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 14.2% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Total Orders</span>
                        <div class="kpi-tile-icon blue"><i class="fa fa-shopping-bag"></i></div>
                    </div>
                    <div class="kpi-value">8,245</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 18% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Avg. Order Value</span>
                        <div class="kpi-tile-icon purple"><i class="fa fa-bar-chart"></i></div>
                    </div>
                    <div class="kpi-value">₹1,522</div>
                    <div class="kpi-badge down"><i class="fa fa-arrow-down"></i> 3.1% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Units Sold</span>
                        <div class="kpi-tile-icon amber"><i class="fa fa-cube"></i></div>
                    </div>
                    <div class="kpi-value">21,340</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 9.5% vs last month</div>
                </div>

                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Return Rate</span>
                        <div class="kpi-tile-icon red"><i class="fa fa-reply"></i></div>
                    </div>
                    <div class="kpi-value">2.4%</div>
                    <div class="kpi-badge neutral"><i class="fa fa-minus"></i> No change</div>
                </div>

            </div>

            <!-- ── Revenue Trend + Donut ── -->
            <div class="charts-2col">

                <!-- Revenue over time -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Revenue Over Time</h5>
                        <div style="display:flex;gap:6px">
                            <span class="date-preset active" style="font-size:11.5px;padding:4px 10px">Daily</span>
                            <span class="date-preset" style="font-size:11.5px;padding:4px 10px">Weekly</span>
                            <span class="date-preset" style="font-size:11.5px;padding:4px 10px">Monthly</span>
                        </div>
                    </div>
                    <div class="sc-body">
                        <div class="chart-wrap-lg">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Revenue by category donut -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Revenue by Category</h5>
                        <span class="sc-head-sub">This month</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-wrap-md" style="height:180px">
                            <canvas id="categoryDonut"></canvas>
                        </div>
                        <div style="margin-top:14px">
                            <div class="cat-row">
                                <div class="cat-color-dot" style="background:#303d89"></div>
                                <span class="cat-row-name">Electronics</span>
                                <span class="cat-row-pct">42%</span>
                                <span class="cat-row-rev">₹5,27,054</span>
                            </div>
                            <div class="cat-row">
                                <div class="cat-color-dot" style="background:#007a5e"></div>
                                <span class="cat-row-name">Clothing</span>
                                <span class="cat-row-pct">22%</span>
                                <span class="cat-row-rev">₹2,76,076</span>
                            </div>
                            <div class="cat-row">
                                <div class="cat-color-dot" style="background:#6d28d9"></div>
                                <span class="cat-row-name">Footwear</span>
                                <span class="cat-row-pct">16%</span>
                                <span class="cat-row-rev">₹2,00,782</span>
                            </div>
                            <div class="cat-row">
                                <div class="cat-color-dot" style="background:#916a00"></div>
                                <span class="cat-row-name">Home &amp; Kitchen</span>
                                <span class="cat-row-pct">12%</span>
                                <span class="cat-row-rev">₹1,50,587</span>
                            </div>
                            <div class="cat-row">
                                <div class="cat-color-dot" style="background:#8c9196"></div>
                                <span class="cat-row-name">Others</span>
                                <span class="cat-row-pct">8%</span>
                                <span class="cat-row-rev">₹1,00,391</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ── Orders / Customers / Channel ── -->
            <div class="charts-3col">

                <!-- Orders vs Returns -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Orders vs Returns</h5>
                        <span class="sc-head-sub">Last 7 days</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-wrap-sm">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- New vs Returning Customers -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Customer Breakdown</h5>
                        <span class="sc-head-sub">This month</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-wrap-sm">
                            <canvas id="customerChart"></canvas>
                        </div>
                        <div style="display:flex;justify-content:center;gap:20px;margin-top:12px;font-size:12px">
                            <span style="display:flex;align-items:center;gap:5px;color:var(--text-secondary)"><span style="width:10px;height:10px;border-radius:50%;background:var(--accent);display:inline-block"></span>New (62%)</span>
                            <span style="display:flex;align-items:center;gap:5px;color:var(--text-secondary)"><span style="width:10px;height:10px;border-radius:50%;background:var(--green);display:inline-block"></span>Returning (38%)</span>
                        </div>
                    </div>
                </div>

                <!-- Sales by Channel -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Sales by Channel</h5>
                        <span class="sc-head-sub">This month</span>
                    </div>
                    <div class="sc-body">
                        <div class="info-row" style="padding:11px 0">
                            <div style="display:flex;align-items:center;gap:8px">
                                <span class="channel-pill ch-online"><i class="fa fa-desktop"></i> Website</span>
                            </div>
                            <div style="text-align:right">
                                <div style="font-size:14px;font-weight:700;color:var(--text-primary)">₹8,14,178</div>
                                <div style="font-size:11.5px;color:var(--text-hint)">64.9% · 5,351 orders</div>
                            </div>
                        </div>
                        <div class="info-row" style="padding:11px 0">
                            <div>
                                <span class="channel-pill ch-mobile"><i class="fa fa-mobile"></i> Mobile App</span>
                            </div>
                            <div style="text-align:right">
                                <div style="font-size:14px;font-weight:700;color:var(--text-primary)">₹3,13,722</div>
                                <div style="font-size:11.5px;color:var(--text-hint)">25.0% · 2,061 orders</div>
                            </div>
                        </div>
                        <div class="info-row" style="padding:11px 0;border-bottom:none">
                            <div>
                                <span class="channel-pill ch-offline"><i class="fa fa-store"></i> Offline / POS</span>
                            </div>
                            <div style="text-align:right">
                                <div style="font-size:14px;font-weight:700;color:var(--text-primary)">₹1,26,990</div>
                                <div style="font-size:11.5px;color:var(--text-hint)">10.1% · 833 orders</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ── Period Comparison + Top Products ── -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px">

                <!-- Period comparison -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Period Comparison</h5>
                        <span class="sc-head-sub">Jun 2026 vs May 2026</span>
                    </div>
                    <div class="sc-body">
                        <div class="compare-strip">
                            <div class="compare-cell">
                                <div class="compare-cell-label">This Period</div>
                                <div class="compare-cell-value">₹12,54,890</div>
                                <div class="compare-cell-sub">Jun 1 – Jun 15</div>
                            </div>
                            <div class="compare-cell" style="background:#fafafa">
                                <div class="compare-cell-label">Last Period</div>
                                <div class="compare-cell-value" style="color:var(--text-secondary)">₹10,97,980</div>
                                <div class="compare-cell-sub">May 1 – May 15</div>
                            </div>
                        </div>
                        <div class="chart-wrap-sm">
                            <canvas id="compareChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Daily breakdown summary -->
                <div class="sc">
                    <div class="sc-head">
                        <h5>Daily Revenue Breakdown</h5>
                        <span class="sc-head-sub">Last 7 days</span>
                    </div>
                    <div class="sc-body" style="padding:0">
                        <table class="sum-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Orders</th>
                                    <th>Revenue</th>
                                    <th>vs Yesterday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight:500">15 Jun, Mon</td>
                                    <td class="units-cell">642</td>
                                    <td class="rev-cell">₹97,820</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 8.4%</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:500">14 Jun, Sun</td>
                                    <td class="units-cell">590</td>
                                    <td class="rev-cell">₹90,230</td>
                                    <td><span class="growth down"><i class="fa fa-arrow-down"></i> 2.1%</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:500">13 Jun, Sat</td>
                                    <td class="units-cell">614</td>
                                    <td class="rev-cell">₹92,140</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 11.2%</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:500">12 Jun, Fri</td>
                                    <td class="units-cell">552</td>
                                    <td class="rev-cell">₹82,890</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 5.7%</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:500">11 Jun, Thu</td>
                                    <td class="units-cell">522</td>
                                    <td class="rev-cell">₹78,430</td>
                                    <td><span class="growth down"><i class="fa fa-arrow-down"></i> 1.8%</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:500">10 Jun, Wed</td>
                                    <td class="units-cell">536</td>
                                    <td class="rev-cell">₹79,870</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 3.3%</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:500">09 Jun, Tue</td>
                                    <td class="units-cell">519</td>
                                    <td class="rev-cell">₹77,310</td>
                                    <td><span class="growth up"><i class="fa fa-arrow-up"></i> 6.0%</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>7-Day Total</td>
                                    <td style="color:var(--text-secondary)">3,975</td>
                                    <td style="color:var(--accent)">₹5,98,690</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>

            <!-- ── Top Selling Products ── -->
            <div class="sc" style="margin-bottom:20px">
                <div class="sc-head">
                    <h5>Top Selling Products</h5>
                    <div style="display:flex;gap:8px;align-items:center">
                        <span class="sc-head-sub">By revenue this month</span>
                        <a href="#" style="font-size:12px;color:var(--accent);text-decoration:none;font-weight:500">View All →</a>
                    </div>
                </div>
                <div style="overflow-x:auto">
                    <table class="sum-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Units Sold</th>
                                <th>Revenue</th>
                                <th>Avg. Price</th>
                                <th>Share of Sales</th>
                                <th>Growth</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="rank-num gold">1</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/40x40/e8f2ff/0069d9?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name-sm">iPhone 16 Pro Max</div>
                                            <div class="prod-cat-sm">SKU-00142</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Electronics</span></td>
                                <td><span class="units-cell">450</span></td>
                                <td><span class="rev-cell">₹5,62,500</span></td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">₹1,250</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <div class="prog-bar" style="width:120px"><div class="prog-fill" style="width:85%;background:var(--accent)"></div></div>
                                        <span style="font-size:12px;color:var(--text-hint)">85%</span>
                                    </div>
                                </td>
                                <td><span class="growth up"><i class="fa fa-arrow-up"></i> 22%</span></td>
                            </tr>
                            <tr>
                                <td><span class="rank-num silver">2</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/40x40/e3f1ec/007a5e?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name-sm">Samsung Galaxy S26 Ultra</div>
                                            <div class="prod-cat-sm">SKU-00198</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Electronics</span></td>
                                <td><span class="units-cell">390</span></td>
                                <td><span class="rev-cell">₹4,48,500</span></td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">₹1,150</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <div class="prog-bar" style="width:120px"><div class="prog-fill" style="width:72%;background:var(--green)"></div></div>
                                        <span style="font-size:12px;color:var(--text-hint)">72%</span>
                                    </div>
                                </td>
                                <td><span class="growth up"><i class="fa fa-arrow-up"></i> 15%</span></td>
                            </tr>
                            <tr>
                                <td><span class="rank-num bronze">3</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/40x40/ede9fe/6d28d9?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name-sm">AirPods Pro (3rd Gen)</div>
                                            <div class="prod-cat-sm">SKU-00305</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Electronics</span></td>
                                <td><span class="units-cell">280</span></td>
                                <td><span class="rev-cell">₹1,96,000</span></td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">₹700</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <div class="prog-bar" style="width:120px"><div class="prog-fill" style="width:54%;background:var(--purple)"></div></div>
                                        <span style="font-size:12px;color:var(--text-hint)">54%</span>
                                    </div>
                                </td>
                                <td><span class="growth up"><i class="fa fa-arrow-up"></i> 8%</span></td>
                            </tr>
                            <tr>
                                <td><span class="rank-num">4</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/40x40/fff5cc/916a00?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name-sm">Nike Air Max 270</div>
                                            <div class="prod-cat-sm">SKU-00419</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Footwear</span></td>
                                <td><span class="units-cell">245</span></td>
                                <td><span class="rev-cell">₹1,47,000</span></td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">₹600</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <div class="prog-bar" style="width:120px"><div class="prog-fill" style="width:40%;background:var(--amber)"></div></div>
                                        <span style="font-size:12px;color:var(--text-hint)">40%</span>
                                    </div>
                                </td>
                                <td><span class="growth down"><i class="fa fa-arrow-down"></i> 4%</span></td>
                            </tr>
                            <tr>
                                <td><span class="rank-num">5</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <img src="https://placehold.co/40x40/fce8e8/b22222?text=P" class="prod-thumb" alt="">
                                        <div>
                                            <div class="prod-name-sm">Levi's 511 Slim Jeans</div>
                                            <div class="prod-cat-sm">SKU-00532</div>
                                        </div>
                                    </div>
                                </td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Clothing</span></td>
                                <td><span class="units-cell">210</span></td>
                                <td><span class="rev-cell">₹1,05,000</span></td>
                                <td><span style="font-size:13px;color:var(--text-secondary)">₹500</span></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <div class="prog-bar" style="width:120px"><div class="prog-fill" style="width:28%;background:var(--red)"></div></div>
                                        <span style="font-size:12px;color:var(--text-hint)">28%</span>
                                    </div>
                                </td>
                                <td><span class="growth up"><i class="fa fa-arrow-up"></i> 6%</span></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Top 5 Total</td>
                                <td style="color:var(--text-secondary)">1,575 units</td>
                                <td style="color:var(--accent)">₹13,59,000</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- ── Payment Method Summary ── -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px">

                <div class="sc">
                    <div class="sc-head">
                        <h5>Revenue by Payment Method</h5>
                        <span class="sc-head-sub">This month</span>
                    </div>
                    <div class="sc-body" style="padding:0">
                        <table class="sum-table">
                            <thead>
                                <tr>
                                    <th>Method</th>
                                    <th>Transactions</th>
                                    <th>Revenue</th>
                                    <th>Share</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span style="font-size:13px;font-weight:500;color:#c2185b">📱 UPI</span></td>
                                    <td class="units-cell">3,462</td>
                                    <td class="rev-cell">₹5,27,054</td>
                                    <td><span class="growth up" style="background:none;padding:0;color:var(--text-primary);font-weight:600">42%</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size:13px;font-weight:500;color:var(--blue)">💳 Card</span></td>
                                    <td class="units-cell">2,309</td>
                                    <td class="rev-cell">₹3,51,369</td>
                                    <td><span style="font-size:12px;font-weight:600;color:var(--text-primary)">28%</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size:13px;font-weight:500;color:var(--purple)">🏦 Net Banking</span></td>
                                    <td class="units-cell">1,484</td>
                                    <td class="rev-cell">₹2,25,880</td>
                                    <td><span style="font-size:12px;font-weight:600;color:var(--text-primary)">18%</span></td>
                                </tr>
                                <tr>
                                    <td><span style="font-size:13px;font-weight:500;color:var(--amber)">💵 COD</span></td>
                                    <td class="units-cell">990</td>
                                    <td class="rev-cell">₹1,50,587</td>
                                    <td><span style="font-size:12px;font-weight:600;color:var(--text-primary)">12%</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td style="color:var(--text-secondary)">8,245</td>
                                    <td style="color:var(--accent)">₹12,54,890</td>
                                    <td style="color:var(--text-secondary)">100%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="sc">
                    <div class="sc-head">
                        <h5>Key Metrics Summary</h5>
                        <span class="sc-head-sub">Jun 2026</span>
                    </div>
                    <div class="sc-body">
                        <div class="info-row">
                            <span class="info-label">Gross Revenue</span>
                            <span class="info-value">₹13,12,440</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Discounts Given</span>
                            <span class="info-value" style="color:var(--red)">− ₹37,540</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Returns / Refunds</span>
                            <span class="info-value" style="color:var(--red)">− ₐ₹20,010</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Shipping Revenue</span>
                            <span class="info-value" style="color:var(--green)">+ ₹8,420</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tax Collected (GST)</span>
                            <span class="info-value">₹1,12,940</span>
                        </div>
                        <div class="info-row" style="border-top:2px solid var(--border);margin-top:4px;padding-top:12px">
                            <span style="font-size:14px;font-weight:650;color:var(--text-primary)">Net Revenue</span>
                            <span style="font-size:18px;font-weight:750;color:var(--accent)">₹12,54,890</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Best Sales Day</span>
                            <span class="info-value">Mon 15 Jun — ₹97,820</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Peak Order Hour</span>
                            <span class="info-value">8 PM – 10 PM</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Repeat Purchase Rate</span>
                            <span class="info-value">38%</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
/* ── Revenue over time ─────────────────────────────────────── */
(function(){
    const ctx = document.getElementById('revenueChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'],
            datasets: [
                {
                    label: 'Revenue (₹)',
                    data: [62000,71000,58000,80000,74000,82000,69000,91000,78000,85000,77000,93000,88000,90000,97000],
                    fill: true,
                    tension: 0.45,
                    borderColor: '#303d89',
                    borderWidth: 2.5,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#303d89',
                    backgroundColor: (ctx) => {
                        const chart = ctx.chart;
                        const { ctx: c, chartArea } = chart;
                        if (!chartArea) return 'transparent';
                        const g = c.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                        g.addColorStop(0,   'rgba(48,61,137,.18)');
                        g.addColorStop(1,   'rgba(48,61,137,0)');
                        return g;
                    }
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { backgroundColor: '#202223', cornerRadius: 8, padding: 10,
                    callbacks: { label: v => ' ₹' + v.parsed.y.toLocaleString('en-IN') } }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#8c9196', font: { size: 11 } }, border: { display: false } },
                y: { grid: { color: '#f1f2f4' }, border: { display: false },
                    ticks: { color: '#8c9196', font: { size: 11 }, callback: v => '₹' + (v/1000).toFixed(0)+'k' } }
            }
        }
    });
})();

/* ── Category donut ────────────────────────────────────────── */
(function(){
    const ctx = document.getElementById('categoryDonut');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Electronics','Clothing','Footwear','Home & Kitchen','Others'],
            datasets: [{ data: [42,22,16,12,8], backgroundColor: ['#303d89','#007a5e','#6d28d9','#916a00','#8c9196'], borderWidth: 2, borderColor: '#fff', hoverOffset: 6 }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, cutout: '70%',
            plugins: { legend: { display: false },
                tooltip: { callbacks: { label: v => v.label + ': ' + v.parsed + '%' } } }
        }
    });
})();

/* ── Orders vs Returns bar ─────────────────────────────────── */
(function(){
    const ctx = document.getElementById('ordersChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
            datasets: [
                { label: 'Orders',  data: [1180,1050,1210,980,1350,1420,1055], backgroundColor: '#303d89', borderRadius: 5, borderSkipped: false },
                { label: 'Returns', data: [28,22,31,18,35,30,25],              backgroundColor: '#fce8e8', borderRadius: 5, borderSkipped: false }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { font: { size: 11 }, boxWidth: 10, padding: 12 } },
                tooltip: { backgroundColor: '#202223', cornerRadius: 8 } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#8c9196' }, border: { display: false } },
                y: { grid: { color: '#f1f2f4' }, ticks: { font: { size: 11 }, color: '#8c9196' }, border: { display: false } }
            }
        }
    });
})();

/* ── Customer doughnut ─────────────────────────────────────── */
(function(){
    const ctx = document.getElementById('customerChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['New Customers','Returning Customers'],
            datasets: [{ data: [62,38], backgroundColor: ['#303d89','#007a5e'], borderWidth: 2, borderColor: '#fff', hoverOffset: 6 }]
        },
        options: {
            responsive: true, maintainAspectRatio: false, cutout: '68%',
            plugins: { legend: { display: false }, tooltip: { callbacks: { label: v => v.label + ': ' + v.parsed + '%' } } }
        }
    });
})();

/* ── Period comparison bar ─────────────────────────────────── */
(function(){
    const ctx = document.getElementById('compareChart');
    if(!ctx) return;
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Week 1','Week 2'],
            datasets: [
                { label: 'Jun 2026', data: [628000,626890], backgroundColor: '#303d89', borderRadius: 6, borderSkipped: false },
                { label: 'May 2026', data: [551000,546980], backgroundColor: '#e3e5e8', borderRadius: 6, borderSkipped: false }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { font: { size: 11 }, boxWidth: 10, padding: 10 } },
                tooltip: { backgroundColor: '#202223', cornerRadius: 8, callbacks: { label: v => ' ₹' + v.parsed.y.toLocaleString('en-IN') } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#8c9196' }, border: { display: false } },
                y: { grid: { color: '#f1f2f4' }, border: { display: false },
                    ticks: { font: { size: 11 }, color: '#8c9196', callback: v => '₹' + (v/1000).toFixed(0)+'k' } }
            }
        }
    });
})();

/* ── Date preset tabs ──────────────────────────────────────── */
document.querySelectorAll('.date-preset').forEach(el => {
    el.addEventListener('click', function() {
        this.closest('.date-bar-left')?.querySelectorAll('.date-preset')
            .forEach(e => e.classList.remove('active'));
        this.classList.add('active');
    });
});

/* ── Chart period tabs ─────────────────────────────────────── */
document.querySelectorAll('.sc-head .date-preset').forEach(el => {
    el.addEventListener('click', function() {
        this.closest('.sc-head')?.querySelectorAll('.date-preset')
            .forEach(e => e.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>