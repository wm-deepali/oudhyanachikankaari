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

    /* ── Page header ── */
    .page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    /* ── Buttons ── */
    .btn-primary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent); color: #fff !important; border: none;
        border-radius: var(--radius-sm); padding: 8px 16px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s; box-shadow: 0 1px 3px rgba(48,61,137,.25);
        white-space: nowrap;
    }
    .btn-primary-dash:hover { background: #252f70; }

    .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--surface); color: var(--text-primary) !important;
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 8px 16px; font-size: 13px; font-weight: 500; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s; white-space: nowrap;
    }
    .btn-secondary-dash:hover { background: var(--bg); }

    /* ── KPI strip ── */
    .kpi-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:900px) { .kpi-strip { grid-template-columns: repeat(2,1fr); } }
    @media(max-width:500px) { .kpi-strip { grid-template-columns: 1fr; } }

    .kpi-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 18px 20px; box-shadow: var(--shadow-card); }
    .kpi-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; color: var(--text-hint); margin-bottom: 8px; }
    .kpi-value { font-size: 26px; font-weight: 750; color: var(--text-primary); line-height: 1; }
    .kpi-trend { display: inline-flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 600; margin-top: 8px; padding: 3px 8px; border-radius: 20px; }
    .kpi-trend.up   { background: var(--green-bg); color: var(--green); }
    .kpi-trend.down { background: var(--red-bg);   color: var(--red); }
    .kpi-sub { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    /* ── Filter bar ── */
    .filter-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 16px 20px; margin-bottom: 20px; }
    .filter-row { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; gap: 5px; }
    .filter-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: var(--text-secondary); }
    .filter-control {
        height: 36px; border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 0 11px; font-size: 13px; color: var(--text-primary);
        background: var(--surface); outline: none; font-family: var(--font); min-width: 140px;
        transition: border-color .15s, box-shadow .15s;
    }
    .filter-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }

    /* ── Two-column main layout ── */
    .report-layout { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }
    @media(max-width:1080px) { .report-layout { grid-template-columns: 1fr; } }

    /* ── Section card ── */
    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .section-card-body { padding: 20px; }

    /* ── Chart placeholder ── */
    .chart-area { width: 100%; height: 240px; position: relative; display: flex; align-items: flex-end; gap: 6px; padding: 0 0 28px; border-bottom: 2px solid var(--border); }
    .chart-bar-wrap { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 5px; height: 100%; justify-content: flex-end; }
    .chart-bar { width: 100%; border-radius: 4px 4px 0 0; transition: opacity .15s; cursor: pointer; min-height: 4px; }
    .chart-bar:hover { opacity: .8; }
    .chart-label { font-size: 10px; color: var(--text-hint); white-space: nowrap; text-align: center; }
    .chart-value { font-size: 10px; font-weight: 700; color: var(--text-secondary); }
    .chart-y-axis { position: absolute; left: 0; top: 0; bottom: 28px; width: 36px; display: flex; flex-direction: column; justify-content: space-between; }
    .chart-y-label { font-size: 10px; color: var(--text-hint); text-align: right; }

    /* ── Donut chart (CSS) ── */
    .donut-wrap { display: flex; align-items: center; gap: 24px; }
    .donut-svg { flex-shrink: 0; }
    .donut-legend { display: flex; flex-direction: column; gap: 10px; }
    .legend-item { display: flex; align-items: center; gap: 8px; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .legend-name  { font-size: 12.5px; color: var(--text-secondary); }
    .legend-value { font-size: 12.5px; font-weight: 700; color: var(--text-primary); margin-left: auto; padding-left: 12px; }

    /* ── Product table ── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .data-table thead th { padding: 10px 14px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); text-align: left; white-space: nowrap; }
    .data-table thead th.right { text-align: right; }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 12px 14px; font-size: 13px; color: var(--text-primary); vertical-align: middle; }
    .data-table td.right { text-align: right; }
    .data-table td.muted { color: var(--text-secondary); }

    /* ── Product cell ── */
    .prod-cell { display: flex; align-items: center; gap: 10px; }
    .prod-thumb { width: 40px; height: 40px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; background: var(--bg); display: flex; align-items: center; justify-content: center; color: var(--text-hint); font-size: 14px; }
    .prod-name { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .prod-sku  { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }

    /* ── ID chip ── */
    .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 7px; font-size: 11px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }

    /* ── Rank badge ── */
    .rank-badge { width: 24px; height: 24px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 750; flex-shrink: 0; }
    .rank-1 { background: #ffd700; color: #7a5c00; }
    .rank-2 { background: #c0c0c0; color: #4a4a4a; }
    .rank-3 { background: #cd7f32; color: #fff; }
    .rank-n { background: var(--bg); color: var(--text-hint); border: 1px solid var(--border); }

    /* ── Pills ── */
    .pill { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: 11.5px; font-weight: 600; white-space: nowrap; }
    .pill::before { content:''; width:5px; height:5px; border-radius:50%; flex-shrink:0; }
    .pill-active   { background: var(--green-bg); color: var(--green); }
    .pill-active::before { background: var(--green); }
    .pill-inactive { background: var(--red-bg);   color: var(--red); }
    .pill-inactive::before { background: var(--red); }
    .pill-low      { background: var(--amber-bg); color: var(--amber); }
    .pill-low::before { background: var(--amber); }

    /* ── Mini bar (in table) ── */
    .mini-bar-wrap { display: flex; align-items: center; gap: 8px; }
    .mini-bar-bg   { flex: 1; height: 6px; background: var(--bg); border-radius: 10px; overflow: hidden; min-width: 60px; }
    .mini-bar-fill { height: 100%; border-radius: 10px; }

    /* ── Growth indicator ── */
    .growth { font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 3px; }
    .growth.up   { color: var(--green); }
    .growth.down { color: var(--red); }

    /* ── Right sidebar ── */
    .sidebar-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .sidebar-card:last-child { margin-bottom: 0; }
    .sidebar-header { padding: 13px 18px; border-bottom: 1px solid var(--border); background: #fafafa; }
    .sidebar-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .sidebar-body { padding: 16px 18px; }

    /* ── Sidebar metric row ── */
    .metric-row { display: flex; align-items: center; justify-content: space-between; padding: 9px 0; border-bottom: 1px solid var(--bg); }
    .metric-row:first-child { padding-top: 0; }
    .metric-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .metric-label { font-size: 12.5px; color: var(--text-secondary); }
    .metric-value { font-size: 13px; font-weight: 700; color: var(--text-primary); }

    /* ── Category list in sidebar ── */
    .cat-row { display: flex; align-items: center; justify-content: space-between; padding: 9px 0; border-bottom: 1px solid var(--bg); }
    .cat-row:first-child { padding-top: 0; }
    .cat-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .cat-name  { font-size: 12.5px; color: var(--text-primary); font-weight: 500; }
    .cat-count { font-size: 12.5px; font-weight: 700; color: var(--text-primary); }
    .cat-bar { height: 4px; border-radius: 10px; margin-top: 5px; }

    /* ── Pagination ── */
    .pagination-bar { padding: 13px 20px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .pagination-info { font-size: 12.5px; color: var(--text-hint); }
    .pagination-bar .pagination { margin: 0; }
    .pagination-bar .page-link { border-color: var(--border); color: var(--accent); font-size: 13px; border-radius: var(--radius-sm) !important; margin: 0 2px; }
    .pagination-bar .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
    .pagination-bar .page-item.disabled .page-link { color: var(--text-hint); }

    /* ── Empty ── */
    .empty-state { text-align: center; padding: 40px 20px; }
    .empty-icon-wrap { width: 52px; height: 52px; border-radius: 50%; background: var(--accent-light); margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 20px; }

    @media(max-width:768px) { .report-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="report-page">

            <!-- Page header -->
            <div class="page-header">
                <div>
                    <h1>Product Report</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Reports
                        <span>›</span>
                        Product Report
                    </div>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap">
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-download"></i> Export CSV
                    </a>
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </a>
                    <a href="#" class="btn-primary-dash">
                        <i class="fa fa-refresh"></i> Refresh
                    </a>
                </div>
            </div>

            <!-- KPI strip -->
            <div class="kpi-strip">
                <div class="kpi-card">
                    <div class="kpi-label">Total Products</div>
                    <div class="kpi-value">1,428</div>
                    <div style="display:flex;align-items:center;gap:8px;margin-top:8px">
                        <span class="kpi-trend up"><i class="fa fa-arrow-up" style="font-size:10px"></i> 8.4%</span>
                        <span class="kpi-sub">vs last month</span>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Total Units Sold</div>
                    <div class="kpi-value" style="color:var(--accent)">34,812</div>
                    <div style="display:flex;align-items:center;gap:8px;margin-top:8px">
                        <span class="kpi-trend up"><i class="fa fa-arrow-up" style="font-size:10px"></i> 12.1%</span>
                        <span class="kpi-sub">vs last month</span>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Total Revenue</div>
                    <div class="kpi-value" style="color:var(--green)">₹28.4L</div>
                    <div style="display:flex;align-items:center;gap:8px;margin-top:8px">
                        <span class="kpi-trend up"><i class="fa fa-arrow-up" style="font-size:10px"></i> 15.6%</span>
                        <span class="kpi-sub">vs last month</span>
                    </div>
                </div>
                <div class="kpi-card">
                    <div class="kpi-label">Out of Stock</div>
                    <div class="kpi-value" style="color:var(--red)">12</div>
                    <div style="display:flex;align-items:center;gap:8px;margin-top:8px">
                        <span class="kpi-trend down"><i class="fa fa-arrow-down" style="font-size:10px"></i> 3</span>
                        <span class="kpi-sub">from last month</span>
                    </div>
                </div>
            </div>

            <!-- Filter bar -->
            <div class="filter-card">
                <div class="filter-row">
                    <div class="filter-group" style="flex:1;min-width:180px">
                        <span class="filter-label">Search Product</span>
                        <div style="position:relative">
                            <i class="fa fa-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--text-hint);font-size:12px;pointer-events:none"></i>
                            <input type="text" class="filter-control" style="padding-left:30px;min-width:200px" placeholder="Product name, SKU…">
                        </div>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Category</span>
                        <select class="filter-control">
                            <option>All Categories</option>
                            <option>Kurtis</option>
                            <option>Sarees</option>
                            <option>Dupatta</option>
                            <option>Salwar Suits</option>
                            <option>Kurtas (Men)</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Status</span>
                        <select class="filter-control">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Inactive</option>
                            <option>Out of Stock</option>
                            <option>Low Stock</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Sort By</span>
                        <select class="filter-control">
                            <option>Revenue: High to Low</option>
                            <option>Units Sold: High to Low</option>
                            <option>Orders: High to Low</option>
                            <option>Stock: Low to High</option>
                            <option>Avg Rating: High to Low</option>
                            <option>Recently Added</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <span class="filter-label">Date Range</span>
                        <select class="filter-control" id="dateRange" onchange="updateCharts()">
                            <option>Last 7 Days</option>
                            <option selected>Last 30 Days</option>
                            <option>Last 3 Months</option>
                            <option>Last 6 Months</option>
                            <option>This Year</option>
                            <option>Custom</option>
                        </select>
                    </div>
                    <div style="display:flex;gap:8px;align-items:flex-end;padding-top:2px">
                        <button class="btn-primary-dash"><i class="fa fa-search"></i> Apply</button>
                        <button class="btn-secondary-dash"><i class="fa fa-refresh"></i> Reset</button>
                    </div>
                </div>
            </div>

            <!-- Main two-column layout -->
            <div class="report-layout">

                <!-- ══ LEFT COLUMN ══ -->
                <div>

                    <!-- Sales by Product (bar chart) -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <h5><i class="fa-solid fa-chart-bar" style="color:var(--accent);margin-right:6px"></i> Units Sold — Top Products (Last 30 Days)</h5>
                            <span style="font-size:12px;color:var(--text-hint)">By units sold</span>
                        </div>
                        <div class="section-card-body">
                            <div style="position:relative;padding-left:40px">
                                <!-- Y axis labels -->
                                <div style="position:absolute;left:0;top:0;bottom:28px;width:36px;display:flex;flex-direction:column;justify-content:space-between">
                                    <span style="font-size:10px;color:var(--text-hint);text-align:right">1.2k</span>
                                    <span style="font-size:10px;color:var(--text-hint);text-align:right">900</span>
                                    <span style="font-size:10px;color:var(--text-hint);text-align:right">600</span>
                                    <span style="font-size:10px;color:var(--text-hint);text-align:right">300</span>
                                    <span style="font-size:10px;color:var(--text-hint);text-align:right">0</span>
                                </div>
                                <!-- Grid lines -->
                                <div style="position:relative">
                                    <div style="position:absolute;inset:0 0 28px 0;display:flex;flex-direction:column;justify-content:space-between;pointer-events:none">
                                        <div style="border-top:1px dashed var(--border)"></div>
                                        <div style="border-top:1px dashed var(--border)"></div>
                                        <div style="border-top:1px dashed var(--border)"></div>
                                        <div style="border-top:1px dashed var(--border)"></div>
                                        <div style="border-top:2px solid var(--border)"></div>
                                    </div>
                                    <div class="chart-area" style="padding-left:0">
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">1,180</span>
                                            <div class="chart-bar" style="height:98%;background:var(--accent)"></div>
                                            <span class="chart-label">Ivory Kurti</span>
                                        </div>
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">960</span>
                                            <div class="chart-bar" style="height:80%;background:var(--accent)"></div>
                                            <span class="chart-label">Blue Saree</span>
                                        </div>
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">820</span>
                                            <div class="chart-bar" style="height:68%;background:var(--accent)"></div>
                                            <span class="chart-label">Dupatta</span>
                                        </div>
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">740</span>
                                            <div class="chart-bar" style="height:61%;background:var(--blue)"></div>
                                            <span class="chart-label">Pink Suit</span>
                                        </div>
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">680</span>
                                            <div class="chart-bar" style="height:56%;background:var(--blue)"></div>
                                            <span class="chart-label">Beige Kurta</span>
                                        </div>
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">540</span>
                                            <div class="chart-bar" style="height:45%;background:var(--blue)"></div>
                                            <span class="chart-label">Green Suit</span>
                                        </div>
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">420</span>
                                            <div class="chart-bar" style="height:35%;background:var(--text-hint)"></div>
                                            <span class="chart-label">Peach Saree</span>
                                        </div>
                                        <div class="chart-bar-wrap">
                                            <span class="chart-value">310</span>
                                            <div class="chart-bar" style="height:26%;background:var(--text-hint)"></div>
                                            <span class="chart-label">White Kurti</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Legend -->
                            <div style="display:flex;gap:16px;margin-top:12px;flex-wrap:wrap">
                                <span style="display:flex;align-items:center;gap:5px;font-size:12px;color:var(--text-secondary)"><span style="width:10px;height:10px;border-radius:2px;background:var(--accent);display:inline-block"></span> Top performers</span>
                                <span style="display:flex;align-items:center;gap:5px;font-size:12px;color:var(--text-secondary)"><span style="width:10px;height:10px;border-radius:2px;background:var(--blue);display:inline-block"></span> Mid tier</span>
                                <span style="display:flex;align-items:center;gap:5px;font-size:12px;color:var(--text-secondary)"><span style="width:10px;height:10px;border-radius:2px;background:var(--text-hint);display:inline-block"></span> Lower tier</span>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue Trend (simple line-style chart) -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <h5><i class="fa-solid fa-chart-line" style="color:var(--green);margin-right:6px"></i> Product Revenue Trend</h5>
                            <span style="font-size:12px;color:var(--text-hint)">Monthly revenue from products</span>
                        </div>
                        <div class="section-card-body">
                            <div style="display:flex;align-items:flex-end;gap:0;height:160px;border-bottom:2px solid var(--border);padding-bottom:0;position:relative">
                                <!-- Simple SVG line chart -->
                                <svg viewBox="0 0 700 140" style="width:100%;height:140px;overflow:visible" preserveAspectRatio="none">
                                    <!-- Grid lines -->
                                    <line x1="0" y1="0"   x2="700" y2="0"   stroke="var(--border)" stroke-dasharray="4,4"/>
                                    <line x1="0" y1="35"  x2="700" y2="35"  stroke="var(--border)" stroke-dasharray="4,4"/>
                                    <line x1="0" y1="70"  x2="700" y2="70"  stroke="var(--border)" stroke-dasharray="4,4"/>
                                    <line x1="0" y1="105" x2="700" y2="105" stroke="var(--border)" stroke-dasharray="4,4"/>

                                    <!-- Gradient fill -->
                                    <defs>
                                        <linearGradient id="revGrad" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%"   stop-color="#303d89" stop-opacity=".18"/>
                                            <stop offset="100%" stop-color="#303d89" stop-opacity="0"/>
                                        </linearGradient>
                                    </defs>

                                    <!-- Area fill -->
                                    <polygon points="0,110 58,95 116,80 175,68 233,72 291,55 350,42 408,38 466,30 525,20 583,15 641,8 700,12 700,140 0,140"
                                             fill="url(#revGrad)"/>

                                    <!-- Line -->
                                    <polyline points="0,110 58,95 116,80 175,68 233,72 291,55 350,42 408,38 466,30 525,20 583,15 641,8 700,12"
                                              fill="none" stroke="#303d89" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"/>

                                    <!-- Data points -->
                                    <circle cx="0"   cy="110" r="4" fill="#fff" stroke="#303d89" stroke-width="2"/>
                                    <circle cx="116" cy="80"  r="4" fill="#fff" stroke="#303d89" stroke-width="2"/>
                                    <circle cx="233" cy="72"  r="4" fill="#fff" stroke="#303d89" stroke-width="2"/>
                                    <circle cx="350" cy="42"  r="4" fill="#fff" stroke="#303d89" stroke-width="2"/>
                                    <circle cx="466" cy="30"  r="4" fill="#fff" stroke="#303d89" stroke-width="2"/>
                                    <circle cx="583" cy="15"  r="4" fill="#fff" stroke="#303d89" stroke-width="2"/>
                                    <circle cx="700" cy="12"  r="4" fill="#303d89" stroke="#303d89" stroke-width="2"/>
                                </svg>
                            </div>
                            <!-- Month labels -->
                            <div style="display:flex;justify-content:space-between;margin-top:8px;padding:0 2px">
                                <span style="font-size:11px;color:var(--text-hint)">Jul</span>
                                <span style="font-size:11px;color:var(--text-hint)">Aug</span>
                                <span style="font-size:11px;color:var(--text-hint)">Sep</span>
                                <span style="font-size:11px;color:var(--text-hint)">Oct</span>
                                <span style="font-size:11px;color:var(--text-hint)">Nov</span>
                                <span style="font-size:11px;color:var(--text-hint)">Dec</span>
                                <span style="font-size:11px;color:var(--text-hint)">Jan</span>
                                <span style="font-size:11px;color:var(--text-hint)">Feb</span>
                                <span style="font-size:11px;color:var(--text-hint)">Mar</span>
                                <span style="font-size:11px;color:var(--text-hint)">Apr</span>
                                <span style="font-size:11px;color:var(--text-hint)">May</span>
                                <span style="font-size:11px;color:var(--text-hint)">Jun</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Performance Table -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <h5><i class="fa-solid fa-table" style="color:var(--accent);margin-right:6px"></i> Product Performance</h5>
                            <span style="font-size:12px;color:var(--text-hint)">All products ranked by revenue</span>
                        </div>

                        <div style="overflow-x:auto">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th style="width:44px">#</th>
                                        <th>Product</th>
                                        <th class="right">Units Sold</th>
                                        <th class="right">Revenue</th>
                                        <th class="right">Avg Price</th>
                                        <th class="right">Orders</th>
                                        <th style="min-width:120px">Stock</th>
                                        <th class="right">Rating</th>
                                        <th class="right">Growth</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- Row 1 -->
                                    <tr>
                                        <td><span class="rank-badge rank-1">1</span></td>
                                        <td>
                                            <div class="prod-cell">
                                                <div class="prod-thumb"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="prod-name">Chikankari Kurti — Ivory White</div>
                                                    <div class="prod-sku">SKU: CHK-IW-M</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="right" style="font-weight:700">1,180</td>
                                        <td class="right" style="font-weight:700;color:var(--green)">₹4,72,000</td>
                                        <td class="right muted">₹400</td>
                                        <td class="right muted">834</td>
                                        <td>
                                            <div class="mini-bar-wrap">
                                                <div class="mini-bar-bg"><div class="mini-bar-fill" style="width:82%;background:var(--green)"></div></div>
                                                <span style="font-size:12px;font-weight:700;color:var(--text-primary);min-width:28px">246</span>
                                            </div>
                                        </td>
                                        <td class="right">
                                            <span style="color:#f59e0b;font-size:12px">★</span>
                                            <span style="font-size:12.5px;font-weight:700">4.8</span>
                                        </td>
                                        <td class="right"><span class="growth up"><i class="fa fa-arrow-up" style="font-size:9px"></i> 18%</span></td>
                                        <td><span class="pill pill-active">Active</span></td>
                                    </tr>

                                    <!-- Row 2 -->
                                    <tr>
                                        <td><span class="rank-badge rank-2">2</span></td>
                                        <td>
                                            <div class="prod-cell">
                                                <div class="prod-thumb"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="prod-name">Lucknowi Chikankari Saree — Pastel Blue</div>
                                                    <div class="prod-sku">SKU: LCS-PB-6M</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="right" style="font-weight:700">960</td>
                                        <td class="right" style="font-weight:700;color:var(--green)">₹3,84,000</td>
                                        <td class="right muted">₹400</td>
                                        <td class="right muted">621</td>
                                        <td>
                                            <div class="mini-bar-wrap">
                                                <div class="mini-bar-bg"><div class="mini-bar-fill" style="width:64%;background:var(--green)"></div></div>
                                                <span style="font-size:12px;font-weight:700;color:var(--text-primary);min-width:28px">192</span>
                                            </div>
                                        </td>
                                        <td class="right">
                                            <span style="color:#f59e0b;font-size:12px">★</span>
                                            <span style="font-size:12.5px;font-weight:700">4.6</span>
                                        </td>
                                        <td class="right"><span class="growth up"><i class="fa fa-arrow-up" style="font-size:9px"></i> 11%</span></td>
                                        <td><span class="pill pill-active">Active</span></td>
                                    </tr>

                                    <!-- Row 3 -->
                                    <tr>
                                        <td><span class="rank-badge rank-3">3</span></td>
                                        <td>
                                            <div class="prod-cell">
                                                <div class="prod-thumb"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="prod-name">Embroidered Dupatta — Multi Colour</div>
                                                    <div class="prod-sku">SKU: EDP-MC-FREE</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="right" style="font-weight:700">820</td>
                                        <td class="right" style="font-weight:700;color:var(--green)">₹2,46,000</td>
                                        <td class="right muted">₹300</td>
                                        <td class="right muted">540</td>
                                        <td>
                                            <div class="mini-bar-wrap">
                                                <div class="mini-bar-bg"><div class="mini-bar-fill" style="width:46%;background:var(--amber)"></div></div>
                                                <span style="font-size:12px;font-weight:700;color:var(--amber);min-width:28px">46</span>
                                            </div>
                                        </td>
                                        <td class="right">
                                            <span style="color:#f59e0b;font-size:12px">★</span>
                                            <span style="font-size:12.5px;font-weight:700">4.5</span>
                                        </td>
                                        <td class="right"><span class="growth up"><i class="fa fa-arrow-up" style="font-size:9px"></i> 9%</span></td>
                                        <td><span class="pill pill-low">Low Stock</span></td>
                                    </tr>

                                    <!-- Row 4 -->
                                    <tr>
                                        <td><span class="rank-badge rank-n">4</span></td>
                                        <td>
                                            <div class="prod-cell">
                                                <div class="prod-thumb"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="prod-name">Salwar Suit — Pink Embroidery</div>
                                                    <div class="prod-sku">SKU: SSP-PK-L</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="right" style="font-weight:700">740</td>
                                        <td class="right" style="font-weight:700;color:var(--green)">₹2,96,000</td>
                                        <td class="right muted">₹400</td>
                                        <td class="right muted">498</td>
                                        <td>
                                            <div class="mini-bar-wrap">
                                                <div class="mini-bar-bg"><div class="mini-bar-fill" style="width:72%;background:var(--green)"></div></div>
                                                <span style="font-size:12px;font-weight:700;color:var(--text-primary);min-width:28px">180</span>
                                            </div>
                                        </td>
                                        <td class="right">
                                            <span style="color:#f59e0b;font-size:12px">★</span>
                                            <span style="font-size:12.5px;font-weight:700">4.3</span>
                                        </td>
                                        <td class="right"><span class="growth down"><i class="fa fa-arrow-down" style="font-size:9px"></i> 3%</span></td>
                                        <td><span class="pill pill-active">Active</span></td>
                                    </tr>

                                    <!-- Row 5 -->
                                    <tr>
                                        <td><span class="rank-badge rank-n">5</span></td>
                                        <td>
                                            <div class="prod-cell">
                                                <div class="prod-thumb"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="prod-name">Hand-embroidered Kurta — Beige</div>
                                                    <div class="prod-sku">SKU: HEK-BG-XL</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="right" style="font-weight:700">680</td>
                                        <td class="right" style="font-weight:700;color:var(--green)">₹3,40,000</td>
                                        <td class="right muted">₹500</td>
                                        <td class="right muted">412</td>
                                        <td>
                                            <div class="mini-bar-wrap">
                                                <div class="mini-bar-bg"><div class="mini-bar-fill" style="width:88%;background:var(--green)"></div></div>
                                                <span style="font-size:12px;font-weight:700;color:var(--text-primary);min-width:28px">264</span>
                                            </div>
                                        </td>
                                        <td class="right">
                                            <span style="color:#f59e0b;font-size:12px">★</span>
                                            <span style="font-size:12.5px;font-weight:700">4.7</span>
                                        </td>
                                        <td class="right"><span class="growth up"><i class="fa fa-arrow-up" style="font-size:9px"></i> 22%</span></td>
                                        <td><span class="pill pill-active">Active</span></td>
                                    </tr>

                                    <!-- Row 6 -->
                                    <tr>
                                        <td><span class="rank-badge rank-n">6</span></td>
                                        <td>
                                            <div class="prod-cell">
                                                <div class="prod-thumb"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="prod-name">Chikankari Kurta — Green Floral</div>
                                                    <div class="prod-sku">SKU: CKG-FL-M</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="right" style="font-weight:700">540</td>
                                        <td class="right" style="font-weight:700;color:var(--green)">₹2,16,000</td>
                                        <td class="right muted">₹400</td>
                                        <td class="right muted">310</td>
                                        <td>
                                            <div class="mini-bar-wrap">
                                                <div class="mini-bar-bg"><div class="mini-bar-fill" style="width:30%;background:var(--amber)"></div></div>
                                                <span style="font-size:12px;font-weight:700;color:var(--amber);min-width:28px">30</span>
                                            </div>
                                        </td>
                                        <td class="right">
                                            <span style="color:#f59e0b;font-size:12px">★</span>
                                            <span style="font-size:12.5px;font-weight:700">4.2</span>
                                        </td>
                                        <td class="right"><span class="growth down"><i class="fa fa-arrow-down" style="font-size:9px"></i> 7%</span></td>
                                        <td><span class="pill pill-low">Low Stock</span></td>
                                    </tr>

                                    <!-- Row 7 -->
                                    <tr>
                                        <td><span class="rank-badge rank-n">7</span></td>
                                        <td>
                                            <div class="prod-cell">
                                                <div class="prod-thumb"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="prod-name">Peach Georgette Saree</div>
                                                    <div class="prod-sku">SKU: PGS-OR-6M</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="right" style="font-weight:700">420</td>
                                        <td class="right" style="font-weight:700;color:var(--green)">₹1,68,000</td>
                                        <td class="right muted">₹400</td>
                                        <td class="right muted">280</td>
                                        <td>
                                            <div class="mini-bar-wrap">
                                                <div class="mini-bar-bg"><div class="mini-bar-fill" style="width:0%;background:var(--red)"></div></div>
                                                <span style="font-size:12px;font-weight:700;color:var(--red);min-width:28px">0</span>
                                            </div>
                                        </td>
                                        <td class="right">
                                            <span style="color:#f59e0b;font-size:12px">★</span>
                                            <span style="font-size:12.5px;font-weight:700">4.0</span>
                                        </td>
                                        <td class="right"><span class="growth up"><i class="fa fa-arrow-up" style="font-size:9px"></i> 5%</span></td>
                                        <td><span class="pill pill-inactive">Out of Stock</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="pagination-bar">
                            <div class="pagination-info">Showing 1–7 of 1,428 products</div>
                            <nav>
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="#">‹</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">…</a></li>
                                    <li class="page-item"><a class="page-link" href="#">204</a></li>
                                    <li class="page-item"><a class="page-link" href="#">›</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div><!-- /left -->

                <!-- ══ RIGHT SIDEBAR ══ -->
                <div>

                    <!-- Revenue by Category (donut) -->
                    <div class="sidebar-card">
                        <div class="sidebar-header"><h5>Revenue by Category</h5></div>
                        <div class="sidebar-body">
                            <div class="donut-wrap">
                                <svg width="110" height="110" viewBox="0 0 110 110" class="donut-svg">
                                    <!-- Donut segments drawn manually as strokes on a circle -->
                                    <circle cx="55" cy="55" r="40" fill="none" stroke="#e3e5e8" stroke-width="18"/>
                                    <!-- Kurtis 38% -->
                                    <circle cx="55" cy="55" r="40" fill="none" stroke="#303d89" stroke-width="18"
                                            stroke-dasharray="95.5 155.7" stroke-dashoffset="0"
                                            transform="rotate(-90 55 55)"/>
                                    <!-- Sarees 26% -->
                                    <circle cx="55" cy="55" r="40" fill="none" stroke="#0069d9" stroke-width="18"
                                            stroke-dasharray="65.3 186" stroke-dashoffset="-95.5"
                                            transform="rotate(-90 55 55)"/>
                                    <!-- Suits 18% -->
                                    <circle cx="55" cy="55" r="40" fill="none" stroke="#007a5e" stroke-width="18"
                                            stroke-dasharray="45.2 206" stroke-dashoffset="-160.8"
                                            transform="rotate(-90 55 55)"/>
                                    <!-- Dupatta 11% -->
                                    <circle cx="55" cy="55" r="40" fill="none" stroke="#f59e0b" stroke-width="18"
                                            stroke-dasharray="27.6 223.6" stroke-dashoffset="-206"
                                            transform="rotate(-90 55 55)"/>
                                    <!-- Others 7% -->
                                    <circle cx="55" cy="55" r="40" fill="none" stroke="#e3e5e8" stroke-width="18"
                                            stroke-dasharray="17.6 233.6" stroke-dashoffset="-233.6"
                                            transform="rotate(-90 55 55)"/>
                                    <text x="55" y="50" text-anchor="middle" font-size="12" font-weight="700" fill="#202223">₹28.4L</text>
                                    <text x="55" y="64" text-anchor="middle" font-size="9" fill="#8c9196">Total</text>
                                </svg>
                                <div class="donut-legend">
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#303d89"></span>
                                        <span class="legend-name">Kurtis</span>
                                        <span class="legend-value">38%</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#0069d9"></span>
                                        <span class="legend-name">Sarees</span>
                                        <span class="legend-value">26%</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#007a5e"></span>
                                        <span class="legend-name">Suits</span>
                                        <span class="legend-value">18%</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#f59e0b"></span>
                                        <span class="legend-name">Dupatta</span>
                                        <span class="legend-value">11%</span>
                                    </div>
                                    <div class="legend-item">
                                        <span class="legend-dot" style="background:#e3e5e8"></span>
                                        <span class="legend-name">Others</span>
                                        <span class="legend-value">7%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Key metrics -->
                    <div class="sidebar-card">
                        <div class="sidebar-header"><h5>Key Metrics</h5></div>
                        <div class="sidebar-body">
                            <div class="metric-row">
                                <span class="metric-label">Avg Revenue / Product</span>
                                <span class="metric-value">₹19,888</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">Avg Units / Product</span>
                                <span class="metric-value">24.4</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">Avg Rating (all)</span>
                                <span class="metric-value" style="color:#f59e0b">★ 4.4</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">Return Rate</span>
                                <span class="metric-value" style="color:var(--red)">3.2%</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">Products with Reviews</span>
                                <span class="metric-value">68%</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">New Products (30d)</span>
                                <span class="metric-value" style="color:var(--accent)">42</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-label">Conversion Rate</span>
                                <span class="metric-value" style="color:var(--green)">3.8%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Category breakdown -->
                    <div class="sidebar-card">
                        <div class="sidebar-header"><h5>Products by Category</h5></div>
                        <div class="sidebar-body">
                            <div class="cat-row">
                                <div style="flex:1">
                                    <div class="cat-name">Kurtis</div>
                                    <div class="cat-bar" style="width:80%;background:var(--accent)"></div>
                                </div>
                                <span class="cat-count">542</span>
                            </div>
                            <div class="cat-row">
                                <div style="flex:1">
                                    <div class="cat-name">Sarees</div>
                                    <div class="cat-bar" style="width:55%;background:var(--blue)"></div>
                                </div>
                                <span class="cat-count">371</span>
                            </div>
                            <div class="cat-row">
                                <div style="flex:1">
                                    <div class="cat-name">Salwar Suits</div>
                                    <div class="cat-bar" style="width:38%;background:var(--green)"></div>
                                </div>
                                <span class="cat-count">258</span>
                            </div>
                            <div class="cat-row">
                                <div style="flex:1">
                                    <div class="cat-name">Dupatta</div>
                                    <div class="cat-bar" style="width:22%;background:var(--amber)"></div>
                                </div>
                                <span class="cat-count">148</span>
                            </div>
                            <div class="cat-row">
                                <div style="flex:1">
                                    <div class="cat-name">Kurtas (Men)</div>
                                    <div class="cat-bar" style="width:16%;background:var(--purple)"></div>
                                </div>
                                <span class="cat-count">109</span>
                            </div>
                        </div>
                    </div>

                    <!-- Top rated -->
                    <div class="sidebar-card">
                        <div class="sidebar-header"><h5>⭐ Highest Rated</h5></div>
                        <div class="sidebar-body">
                            <div class="metric-row">
                                <div>
                                    <div style="font-size:13px;font-weight:600;color:var(--text-primary)">Ivory Kurti</div>
                                    <div style="font-size:11.5px;color:var(--text-hint)">1,284 reviews</div>
                                </div>
                                <span class="metric-value" style="color:#f59e0b">★ 4.8</span>
                            </div>
                            <div class="metric-row">
                                <div>
                                    <div style="font-size:13px;font-weight:600;color:var(--text-primary)">Beige Kurta</div>
                                    <div style="font-size:11.5px;color:var(--text-hint)">980 reviews</div>
                                </div>
                                <span class="metric-value" style="color:#f59e0b">★ 4.7</span>
                            </div>
                            <div class="metric-row">
                                <div>
                                    <div style="font-size:13px;font-weight:600;color:var(--text-primary)">Pastel Blue Saree</div>
                                    <div style="font-size:11.5px;color:var(--text-hint)">741 reviews</div>
                                </div>
                                <span class="metric-value" style="color:#f59e0b">★ 4.6</span>
                            </div>
                            <div class="metric-row">
                                <div>
                                    <div style="font-size:13px;font-weight:600;color:var(--text-primary)">Multi Dupatta</div>
                                    <div style="font-size:11.5px;color:var(--text-hint)">620 reviews</div>
                                </div>
                                <span class="metric-value" style="color:#f59e0b">★ 4.5</span>
                            </div>
                        </div>
                    </div>

                </div><!-- /right sidebar -->

            </div><!-- /report-layout -->

        </div>
    </div>
</div>

@include('admin.footer')

<script>
// Tab switches (kept for date range label update)
function updateCharts() {
    // In production: fire an AJAX call with the selected range
    // and re-render the chart data
    const range = document.getElementById('dateRange').value;
    console.log('Date range changed to:', range);
}

// Animate bars on load
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.chart-bar').forEach(bar => {
        const target = bar.style.height;
        bar.style.height = '0';
        setTimeout(() => { bar.style.transition = 'height .6s ease'; bar.style.height = target; }, 100);
    });
    document.querySelectorAll('.mini-bar-fill').forEach(fill => {
        const target = fill.style.width;
        fill.style.width = '0';
        setTimeout(() => { fill.style.transition = 'width .8s ease'; fill.style.width = target; }, 200);
    });
    document.querySelectorAll('.cat-bar').forEach(bar => {
        const target = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => { bar.style.transition = 'width .7s ease'; bar.style.width = target; }, 300);
    });
});
</script>