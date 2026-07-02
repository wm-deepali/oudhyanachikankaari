@include('admin.top-header')
<div class="main-section">
    @include('admin.header')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
    :root {
        --bg:#f1f2f4;--surface:#ffffff;--border:#e3e5e8;
        --text-primary:#202223;--text-secondary:#6d7175;--text-hint:#8c9196;
        --accent:#303d89;--accent-light:#f0f1fc;
        --green:#007a5e;--green-bg:#e3f1ec;
        --red:#b22222;--red-bg:#fce8e8;
        --amber:#916a00;--amber-bg:#fff5cc;
        --blue:#0069d9;--blue-bg:#e8f2ff;
        --purple:#6d28d9;--purple-bg:#ede9fe;
        --radius-sm:8px;--radius-md:12px;
        --shadow-card:0 1px 3px rgba(0,0,0,.08),0 0 0 1px var(--border);
        --font:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
    }
    .report-page{background:var(--bg);padding:24px 28px;min-height:100vh;font-family:var(--font);color:var(--text-primary);}
    .report-page *{box-sizing:border-box;}
    .page-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:20px;}
    .page-header h1{font-size:20px;font-weight:650;margin:0;}
    .crumb{font-size:12.5px;color:var(--text-hint);margin-top:3px;}
    .crumb a{color:var(--accent);text-decoration:none;}
    .crumb a:hover{text-decoration:underline;}
    .crumb span{margin:0 5px;}
    .btn-primary-dash{display:inline-flex;align-items:center;gap:6px;background:var(--accent);color:#fff;border:none;border-radius:var(--radius-sm);padding:8px 16px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;font-family:var(--font);transition:background .15s;box-shadow:0 1px 3px rgba(48,61,137,.25);}
    .btn-primary-dash:hover{background:#252f70;color:#fff;}
    .btn-secondary-dash{display:inline-flex;align-items:center;gap:6px;background:var(--surface);color:var(--text-primary);border:1px solid var(--border);border-radius:var(--radius-sm);padding:8px 16px;font-size:13px;font-weight:500;cursor:pointer;text-decoration:none;font-family:var(--font);transition:background .15s;}
    .btn-secondary-dash:hover{background:var(--bg);color:var(--text-primary);}

    /* date bar */
    .date-bar{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-md);padding:14px 20px;margin-bottom:20px;box-shadow:var(--shadow-card);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;}
    .date-bar-left{display:flex;align-items:center;gap:8px;flex-wrap:wrap;}
    .date-preset{display:inline-flex;align-items:center;padding:6px 14px;border:1px solid var(--border);border-radius:20px;font-size:12.5px;font-weight:500;color:var(--text-secondary);cursor:pointer;transition:all .15s;background:var(--surface);text-decoration:none;user-select:none;}
    .date-preset:hover{border-color:var(--accent);color:var(--accent);background:var(--accent-light);}
    .date-preset.active{border-color:var(--accent);color:var(--accent);background:var(--accent-light);font-weight:600;}
    .date-input{height:34px;border:1px solid var(--border);border-radius:var(--radius-sm);padding:0 10px;font-size:13px;color:var(--text-primary);background:var(--surface);outline:none;font-family:var(--font);}
    .date-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(48,61,137,.12);}
    .btn-apply{height:34px;display:inline-flex;align-items:center;gap:5px;background:var(--accent);color:#fff;border:none;border-radius:var(--radius-sm);padding:0 14px;font-size:13px;font-weight:600;cursor:pointer;}
    .btn-apply:hover{background:#252f70;}

    /* kpi */
    .kpi-strip{display:grid;grid-template-columns:repeat(5,1fr);gap:14px;margin-bottom:20px;}
    @media(max-width:1100px){.kpi-strip{grid-template-columns:repeat(3,1fr);}}
    @media(max-width:700px){.kpi-strip{grid-template-columns:repeat(2,1fr);}}
    .kpi-tile{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-md);padding:18px 18px 14px;box-shadow:var(--shadow-card);}
    .kpi-tile-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;}
    .kpi-tile-label{font-size:11.5px;font-weight:600;color:var(--text-hint);text-transform:uppercase;letter-spacing:.04em;}
    .kpi-tile-icon{width:34px;height:34px;border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;}
    .kpi-tile-icon.green{background:var(--green-bg);color:var(--green);}
    .kpi-tile-icon.blue{background:var(--blue-bg);color:var(--blue);}
    .kpi-tile-icon.amber{background:var(--amber-bg);color:var(--amber);}
    .kpi-tile-icon.purple{background:var(--purple-bg);color:var(--purple);}
    .kpi-tile-icon.red{background:var(--red-bg);color:var(--red);}
    .kpi-value{font-size:22px;font-weight:750;color:var(--text-primary);line-height:1;}
    .kpi-badge{display:inline-flex;align-items:center;gap:3px;font-size:11px;font-weight:600;padding:2px 7px;border-radius:20px;margin-top:7px;}
    .kpi-badge.up{background:var(--green-bg);color:var(--green);}
    .kpi-badge.down{background:var(--red-bg);color:var(--red);}
    .kpi-badge.neutral{background:var(--bg);color:var(--text-hint);}

    /* layout */
    .charts-2col{display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:20px;}
    .charts-equal{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;}
    @media(max-width:900px){.charts-2col,.charts-equal{grid-template-columns:1fr;}}

    /* section card */
    .sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-md);box-shadow:var(--shadow-card);overflow:hidden;}
    .sc-head{padding:14px 20px;border-bottom:1px solid var(--border);background:#fafafa;display:flex;align-items:center;justify-content:space-between;}
    .sc-head h5{font-size:13px;font-weight:650;color:var(--text-primary);margin:0;}
    .sc-body{padding:20px;}
    .sc-head-sub{font-size:12px;color:var(--text-hint);}
    .chart-wrap-lg{position:relative;height:260px;}
    .chart-wrap-md{position:relative;height:220px;}
    .chart-wrap-sm{position:relative;height:180px;}

    /* tables */
    .sum-table{width:100%;border-collapse:collapse;font-size:13px;}
    .sum-table thead th{font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--text-hint);padding:9px 14px;border-bottom:1px solid var(--border);background:#fafafa;text-align:left;white-space:nowrap;}
    .sum-table tbody tr{border-bottom:1px solid var(--border);transition:background .1s;}
    .sum-table tbody tr:last-child{border-bottom:none;}
    .sum-table tbody tr:hover{background:#fafbfc;}
    .sum-table tbody td{padding:12px 14px;vertical-align:middle;}
    .sum-table tfoot td{padding:12px 14px;border-top:2px solid var(--border);font-weight:700;font-size:13px;background:#fafafa;}
    .rev-cell{font-size:13.5px;font-weight:700;color:var(--text-primary);}
    .units-cell{font-size:13px;color:var(--text-secondary);font-weight:600;}

    /* pills & badges */
    .growth{display:inline-flex;align-items:center;gap:3px;font-size:11.5px;font-weight:600;padding:2px 7px;border-radius:20px;}
    .growth.up{background:var(--green-bg);color:var(--green);}
    .growth.down{background:var(--red-bg);color:var(--red);}
    .growth.neutral{background:var(--bg);color:var(--text-hint);}
    .status-pill{display:inline-flex;align-items:center;gap:4px;font-size:11.5px;font-weight:600;padding:3px 9px;border-radius:20px;white-space:nowrap;}
    .status-pill::before{content:'';width:5px;height:5px;border-radius:50%;display:inline-block;flex-shrink:0;}
    .sp-delivered{background:var(--green-bg);color:var(--green);}
    .sp-delivered::before{background:var(--green);}
    .sp-processing{background:var(--blue-bg);color:var(--blue);}
    .sp-processing::before{background:var(--blue);}
    .sp-pending{background:var(--amber-bg);color:var(--amber);}
    .sp-pending::before{background:var(--amber);}
    .sp-cancelled{background:var(--red-bg);color:var(--red);}
    .sp-cancelled::before{background:var(--red);}
    .sp-returned{background:var(--purple-bg);color:var(--purple);}
    .sp-returned::before{background:var(--purple);}

    /* misc */
    .info-row{display:flex;justify-content:space-between;align-items:center;padding:9px 0;border-bottom:1px solid var(--bg);font-size:13px;}
    .info-row:first-child{padding-top:0;}
    .info-row:last-child{border-bottom:none;padding-bottom:0;}
    .info-label{color:var(--text-hint);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.03em;}
    .info-value{font-weight:600;color:var(--text-primary);}
    .compare-strip{display:grid;grid-template-columns:1fr 1fr;gap:1px;background:var(--border);border-radius:var(--radius-sm);overflow:hidden;margin-bottom:14px;}
    .compare-cell{background:var(--surface);padding:12px 16px;}
    .compare-cell-label{font-size:11px;font-weight:600;color:var(--text-hint);text-transform:uppercase;letter-spacing:.04em;}
    .compare-cell-value{font-size:20px;font-weight:750;color:var(--text-primary);margin-top:3px;}
    .compare-cell-sub{font-size:11.5px;color:var(--text-hint);margin-top:2px;}
    .cat-row{display:flex;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--bg);}
    .cat-row:first-child{padding-top:0;}
    .cat-row:last-child{border-bottom:none;padding-bottom:0;}
    .cat-color-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0;}
    .cat-row-name{flex:1;font-size:13px;font-weight:500;}
    .cat-row-count{font-size:13px;font-weight:700;}
    .cat-row-pct{font-size:11.5px;color:var(--text-hint);}
    .prog-bar{height:5px;border-radius:10px;background:var(--bg);overflow:hidden;width:100px;}
    .prog-fill{height:100%;border-radius:10px;}
    @media(max-width:768px){.report-page{padding:16px;}}
    </style>

    <div class="app-content content container-fluid">
        <div class="report-page">

            <!-- Page header -->
            <div class="page-header">
                <div>
                    <h1>Order Report</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        Order Report
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <button class="btn-secondary-dash" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                    <button class="btn-secondary-dash"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                    <button class="btn-primary-dash"><i class="fa fa-download"></i> Export PDF</button>
                </div>
            </div>

            <!-- Date range bar -->
            <div class="date-bar">
                <div class="date-bar-left">
                    <span style="font-size:12.5px;font-weight:600;color:var(--text-secondary);margin-right:4px">Period:</span>
                    <span class="date-preset" onclick="setPreset(this,'01 Jun 2026','25 Jun 2026')">Today</span>
                    <span class="date-preset" onclick="setPreset(this,'01 Jun 2026','25 Jun 2026')">Yesterday</span>
                    <span class="date-preset active" onclick="setPreset(this,'01 Jun 2026','25 Jun 2026')">This Month</span>
                    <span class="date-preset" onclick="setPreset(this,'01 May 2026','31 May 2026')">Last Month</span>
                    <span class="date-preset" onclick="setPreset(this,'01 Jan 2026','25 Jun 2026')">This Year</span>
                    <span class="date-preset" id="customToggle" onclick="toggleCustom()">Custom</span>
                </div>
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap" id="customInputs">
                    <input type="date" class="date-input" value="2026-06-01" id="startDate">
                    <span style="color:var(--text-hint);font-size:13px">→</span>
                    <input type="date" class="date-input" value="2026-06-25" id="endDate">
                    <button class="btn-apply"><i class="fa fa-check"></i> Apply</button>
                </div>
            </div>

            <!-- KPI Strip -->
            <div class="kpi-strip">
                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Total Orders</span>
                        <div class="kpi-tile-icon blue"><i class="fa fa-shopping-bag"></i></div>
                    </div>
                    <div class="kpi-value">1,284</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-up"></i> 12% vs prev</div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Delivered</span>
                        <div class="kpi-tile-icon green"><i class="fa fa-check-circle"></i></div>
                    </div>
                    <div class="kpi-value">1,041</div>
                    <div class="kpi-badge up">81% delivery rate</div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Cancelled</span>
                        <div class="kpi-tile-icon red"><i class="fa fa-times-circle"></i></div>
                    </div>
                    <div class="kpi-value">128</div>
                    <div class="kpi-badge down"><i class="fa fa-arrow-up"></i> 5% vs prev</div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Avg. Fulfilment</span>
                        <div class="kpi-tile-icon amber"><i class="fa fa-clock-o"></i></div>
                    </div>
                    <div class="kpi-value">4.2d</div>
                    <div class="kpi-badge neutral">Order → Delivered</div>
                </div>
                <div class="kpi-tile">
                    <div class="kpi-tile-top">
                        <span class="kpi-tile-label">Return Rate</span>
                        <div class="kpi-tile-icon purple"><i class="fa fa-reply"></i></div>
                    </div>
                    <div class="kpi-value">3.8%</div>
                    <div class="kpi-badge up"><i class="fa fa-arrow-down"></i> 0.4pp improved</div>
                </div>
            </div>

            <!-- Order Trend + Status Donut -->
            <div class="charts-2col">
                <div class="sc">
                    <div class="sc-head">
                        <h5>Order Volume Over Time</h5>
                        <span class="sc-head-sub">Daily · 01 Jun – 25 Jun 2026</span>
                    </div>
                    <div class="sc-body">
                        <div style="font-size:12px;color:var(--text-hint);margin-bottom:10px">
                            📦 Busiest day: <strong style="color:var(--text-primary)">15 Jun 2026</strong> — 89 orders
                        </div>
                        <div class="chart-wrap-lg">
                            <canvas id="orderTrendChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="sc">
                    <div class="sc-head">
                        <h5>Orders by Status</h5>
                        <span class="sc-head-sub">01 Jun – 25 Jun 2026</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-wrap-md" style="height:180px">
                            <canvas id="statusDonut"></canvas>
                        </div>
                        <div style="margin-top:14px">
                            <div class="cat-row"><div class="cat-color-dot" style="background:#007a5e"></div><span class="cat-row-name">Delivered</span><span class="cat-row-pct">81%</span><span class="cat-row-count">1,041</span></div>
                            <div class="cat-row"><div class="cat-color-dot" style="background:#0069d9"></div><span class="cat-row-name">Processing</span><span class="cat-row-pct">8%</span><span class="cat-row-count">103</span></div>
                            <div class="cat-row"><div class="cat-color-dot" style="background:#916a00"></div><span class="cat-row-name">Pending</span><span class="cat-row-pct">4%</span><span class="cat-row-count">51</span></div>
                            <div class="cat-row"><div class="cat-color-dot" style="background:#b22222"></div><span class="cat-row-name">Cancelled</span><span class="cat-row-pct">5%</span><span class="cat-row-count">64</span></div>
                            <div class="cat-row"><div class="cat-color-dot" style="background:#6d28d9"></div><span class="cat-row-name">Returned</span><span class="cat-row-pct">2%</span><span class="cat-row-count">25</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- City + Fulfilment -->
            <div class="charts-2col">
                <div class="sc">
                    <div class="sc-head">
                        <h5>Orders by Delivery City</h5>
                        <span class="sc-head-sub">Top 7 cities</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-wrap-sm"><canvas id="cityChart"></canvas></div>
                    </div>
                </div>
                <div class="sc">
                    <div class="sc-head">
                        <h5>Fulfilment Time Distribution</h5>
                        <span class="sc-head-sub">Days from order to delivery</span>
                    </div>
                    <div class="sc-body">
                        <div class="chart-wrap-sm"><canvas id="fulfilmentChart"></canvas></div>
                    </div>
                </div>
            </div>

            <!-- Period Comparison + Daily Breakdown -->
            <div class="charts-equal">
                <div class="sc">
                    <div class="sc-head">
                        <h5>Period Comparison</h5>
                        <span class="sc-head-sub">Jun 2026 vs May 2026</span>
                    </div>
                    <div class="sc-body">
                        <div class="compare-strip">
                            <div class="compare-cell">
                                <div class="compare-cell-label">This Period</div>
                                <div class="compare-cell-value">1,284</div>
                                <div class="compare-cell-sub">01 Jun – 25 Jun 2026</div>
                            </div>
                            <div class="compare-cell" style="background:#fafafa">
                                <div class="compare-cell-label">Last Period</div>
                                <div class="compare-cell-value" style="color:var(--text-secondary)">1,146</div>
                                <div class="compare-cell-sub">01 May – 25 May 2026</div>
                            </div>
                        </div>
                        <div class="chart-wrap-sm"><canvas id="compareChart"></canvas></div>
                    </div>
                </div>
                <div class="sc">
                    <div class="sc-head">
                        <h5>Daily Order Breakdown</h5>
                        <span class="sc-head-sub">Last 7 days</span>
                    </div>
                    <div style="overflow-x:auto">
                        <table class="sum-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Orders</th>
                                    <th>Delivered</th>
                                    <th>Cancelled</th>
                                    <th>vs Yesterday</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td style="font-weight:500">25 Jun, Wed</td><td class="units-cell">52</td><td style="color:var(--green);font-weight:600">44</td><td style="color:var(--red);font-weight:600">4</td><td><span class="growth up"><i class="fa fa-arrow-up"></i> 8%</span></td></tr>
                                <tr><td style="font-weight:500">24 Jun, Tue</td><td class="units-cell">48</td><td style="color:var(--green);font-weight:600">40</td><td style="color:var(--red);font-weight:600">5</td><td><span class="growth down"><i class="fa fa-arrow-down"></i> 6%</span></td></tr>
                                <tr><td style="font-weight:500">23 Jun, Mon</td><td class="units-cell">51</td><td style="color:var(--green);font-weight:600">43</td><td style="color:var(--red);font-weight:600">3</td><td><span class="growth up"><i class="fa fa-arrow-up"></i> 13%</span></td></tr>
                                <tr><td style="font-weight:500">22 Jun, Sun</td><td class="units-cell">45</td><td style="color:var(--green);font-weight:600">36</td><td style="color:var(--red);font-weight:600">6</td><td><span class="growth down"><i class="fa fa-arrow-down"></i> 4%</span></td></tr>
                                <tr><td style="font-weight:500">21 Jun, Sat</td><td class="units-cell">47</td><td style="color:var(--green);font-weight:600">39</td><td style="color:var(--red);font-weight:600">4</td><td><span class="growth up"><i class="fa fa-arrow-up"></i> 2%</span></td></tr>
                                <tr><td style="font-weight:500">20 Jun, Fri</td><td class="units-cell">46</td><td style="color:var(--green);font-weight:600">38</td><td style="color:var(--red);font-weight:600">5</td><td><span class="growth up"><i class="fa fa-arrow-up"></i> 9%</span></td></tr>
                                <tr><td style="font-weight:500">19 Jun, Thu</td><td class="units-cell">42</td><td style="color:var(--green);font-weight:600">34</td><td style="color:var(--red);font-weight:600">4</td><td><span class="growth neutral"><i class="fa fa-minus"></i> 0%</span></td></tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>7-Day Total</td>
                                    <td style="color:var(--text-secondary)">331</td>
                                    <td style="color:var(--green)">274</td>
                                    <td style="color:var(--red)">31</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order List Table -->
            <div class="sc" style="margin-bottom:20px">
                <div class="sc-head">
                    <h5>Order Details</h5>
                    <div style="display:flex;gap:8px;align-items:center">
                        <span class="sc-head-sub">01 Jun – 25 Jun 2026</span>
                        <a href="#" style="font-size:12px;color:var(--accent);text-decoration:none;font-weight:500">View All →</a>
                    </div>
                </div>
                <div style="overflow-x:auto">
                    <table class="sum-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Courier</th>
                                <th>Status</th>
                                <th>Fulfilment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1089</a></td>
                                <td><div style="font-weight:560;font-size:13px">Rahul Sharma</div><div style="font-size:11.5px;color:var(--text-hint)">Lucknow</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">25 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">10:42 AM</span></td>
                                <td class="units-cell">3</td>
                                <td class="rev-cell">₹3,450</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">UPI</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Delhivery</span><div style="font-size:11px;font-family:'SF Mono',monospace;color:var(--text-hint)">DL8842019</div></td>
                                <td><span class="status-pill sp-delivered">Delivered</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--green)">3d</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1088</a></td>
                                <td><div style="font-weight:560;font-size:13px">Priya Verma</div><div style="font-size:11.5px;color:var(--text-hint)">Delhi</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">24 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">3:15 PM</span></td>
                                <td class="units-cell">2</td>
                                <td class="rev-cell">₹5,100</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Card</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Blue Dart</span><div style="font-size:11px;font-family:'SF Mono',monospace;color:var(--text-hint)">BD9941234</div></td>
                                <td><span class="status-pill sp-processing">Processing</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--amber)">—</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1087</a></td>
                                <td><div style="font-weight:560;font-size:13px">Anjali Mehta</div><div style="font-size:11.5px;color:var(--text-hint)">Mumbai</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">24 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">11:05 AM</span></td>
                                <td class="units-cell">1</td>
                                <td class="rev-cell">₹2,200</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">COD</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Delhivery</span></td>
                                <td><span class="status-pill sp-delivered">Delivered</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--green)">4d</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1086</a></td>
                                <td><div style="font-weight:560;font-size:13px">Deepak Gupta</div><div style="font-size:11.5px;color:var(--text-hint)">Bangalore</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">23 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">4:30 PM</span></td>
                                <td class="units-cell">4</td>
                                <td class="rev-cell">₹8,400</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Net Banking</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Shiprocket</span></td>
                                <td><span class="status-pill sp-delivered">Delivered</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--green)">3d</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1085</a></td>
                                <td><div style="font-weight:560;font-size:13px">Sneha Patel</div><div style="font-size:11.5px;color:var(--text-hint)">Ahmedabad</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">23 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">9:20 AM</span></td>
                                <td class="units-cell">2</td>
                                <td class="rev-cell">₹3,800</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">UPI</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">DTDC</span></td>
                                <td><span class="status-pill sp-cancelled">Cancelled</span></td>
                                <td><span style="font-size:13px;color:var(--text-hint)">—</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1084</a></td>
                                <td><div style="font-weight:560;font-size:13px">Meera Agarwal</div><div style="font-size:11.5px;color:var(--text-hint)">Pune</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">22 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">2:50 PM</span></td>
                                <td class="units-cell">3</td>
                                <td class="rev-cell">₹6,200</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Card</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Blue Dart</span><div style="font-size:11px;font-family:'SF Mono',monospace;color:var(--text-hint)">BD8810023</div></td>
                                <td><span class="status-pill sp-delivered">Delivered</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--green)">2d</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1083</a></td>
                                <td><div style="font-weight:560;font-size:13px">Vikram Singh</div><div style="font-size:11.5px;color:var(--text-hint)">Jaipur</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">22 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">11:40 AM</span></td>
                                <td class="units-cell">1</td>
                                <td class="rev-cell">₹2,950</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">COD</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Ekart</span></td>
                                <td><span class="status-pill sp-returned">Returned</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--red)">7d</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1082</a></td>
                                <td><div style="font-weight:560;font-size:13px">Kiran Malhotra</div><div style="font-size:11.5px;color:var(--text-hint)">Hyderabad</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">21 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">8:30 AM</span></td>
                                <td class="units-cell">5</td>
                                <td class="rev-cell">₹11,200</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">UPI</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Delhivery</span><div style="font-size:11px;font-family:'SF Mono',monospace;color:var(--text-hint)">DL9912345</div></td>
                                <td><span class="status-pill sp-delivered">Delivered</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--green)">3d</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1081</a></td>
                                <td><div style="font-weight:560;font-size:13px">Nisha Joshi</div><div style="font-size:11.5px;color:var(--text-hint)">Chennai</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">21 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">6:15 PM</span></td>
                                <td class="units-cell">2</td>
                                <td class="rev-cell">₹4,500</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Net Banking</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">XpressBees</span></td>
                                <td><span class="status-pill sp-pending">Pending</span></td>
                                <td><span style="font-size:13px;color:var(--text-hint)">—</span></td>
                            </tr>
                            <tr>
                                <td><a href="#" style="font-size:12.5px;font-family:'SF Mono','Fira Code',monospace;color:var(--accent);text-decoration:none;font-weight:600">#ORD-1080</a></td>
                                <td><div style="font-weight:560;font-size:13px">Arjun Kapoor</div><div style="font-size:11.5px;color:var(--text-hint)">Kolkata</div></td>
                                <td style="font-size:13px;color:var(--text-secondary)">20 Jun 2026<br><span style="font-size:11.5px;color:var(--text-hint)">12:00 PM</span></td>
                                <td class="units-cell">3</td>
                                <td class="rev-cell">₹7,100</td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Card</span></td>
                                <td><span style="font-size:12.5px;color:var(--text-secondary)">Blue Dart</span></td>
                                <td><span class="status-pill sp-delivered">Delivered</span></td>
                                <td><span style="font-size:13px;font-weight:600;color:var(--amber)">5d</span></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Period Total (10 shown)</td>
                                <td style="color:var(--text-secondary)">26 items</td>
                                <td style="color:var(--accent)">₹54,900</td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- Pagination -->
                <div style="padding:14px 20px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between">
                    <span style="font-size:12.5px;color:var(--text-hint)">Showing 10 of 1,284 orders</span>
                    <div style="display:flex;gap:4px">
                        <button style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid var(--border);border-radius:var(--radius-sm);background:var(--surface);color:var(--text-secondary);font-size:12px;cursor:pointer" disabled><i class="fa fa-chevron-left"></i></button>
                        <button style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid var(--accent);border-radius:var(--radius-sm);background:var(--accent);color:#fff;font-size:12.5px;cursor:pointer;font-weight:600">1</button>
                        <button style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid var(--border);border-radius:var(--radius-sm);background:var(--surface);color:var(--text-secondary);font-size:12.5px;cursor:pointer">2</button>
                        <button style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid var(--border);border-radius:var(--radius-sm);background:var(--surface);color:var(--text-secondary);font-size:12.5px;cursor:pointer">3</button>
                        <button style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border:1px solid var(--border);border-radius:var(--radius-sm);background:var(--surface);color:var(--text-secondary);font-size:12px;cursor:pointer"><i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

            <!-- Cancellation Reasons + Key Metrics -->
            <div class="charts-equal">
                <div class="sc">
                    <div class="sc-head">
                        <h5>Top Cancellation Reasons</h5>
                        <span class="sc-head-sub">01 Jun – 25 Jun 2026</span>
                    </div>
                    <div style="overflow-x:auto">
                        <table class="sum-table">
                            <thead>
                                <tr><th>Reason</th><th>Orders</th><th>Share</th><th>Trend</th></tr>
                            </thead>
                            <tbody>
                                <tr><td style="font-size:13px;font-weight:500">Customer Request</td><td class="units-cell">42</td><td><div style="display:flex;align-items:center;gap:8px"><div class="prog-bar"><div class="prog-fill" style="width:64%;background:var(--red)"></div></div><span style="font-size:12px;color:var(--text-hint)">64%</span></div></td><td><span class="growth down"><i class="fa fa-arrow-up"></i> 8%</span></td></tr>
                                <tr><td style="font-size:13px;font-weight:500">Payment Failure</td><td class="units-cell">24</td><td><div style="display:flex;align-items:center;gap:8px"><div class="prog-bar"><div class="prog-fill" style="width:37%;background:var(--red)"></div></div><span style="font-size:12px;color:var(--text-hint)">37%</span></div></td><td><span class="growth down"><i class="fa fa-arrow-up"></i> 3%</span></td></tr>
                                <tr><td style="font-size:13px;font-weight:500">Out of Stock</td><td class="units-cell">18</td><td><div style="display:flex;align-items:center;gap:8px"><div class="prog-bar"><div class="prog-fill" style="width:28%;background:var(--red)"></div></div><span style="font-size:12px;color:var(--text-hint)">28%</span></div></td><td><span class="growth up"><i class="fa fa-arrow-down"></i> 5%</span></td></tr>
                                <tr><td style="font-size:13px;font-weight:500">Address Issue</td><td class="units-cell">9</td><td><div style="display:flex;align-items:center;gap:8px"><div class="prog-bar"><div class="prog-fill" style="width:14%;background:var(--red)"></div></div><span style="font-size:12px;color:var(--text-hint)">14%</span></div></td><td><span class="growth neutral">—</span></td></tr>
                                <tr><td style="font-size:13px;font-weight:500">Duplicate Order</td><td class="units-cell">6</td><td><div style="display:flex;align-items:center;gap:8px"><div class="prog-bar"><div class="prog-fill" style="width:9%;background:var(--red)"></div></div><span style="font-size:12px;color:var(--text-hint)">9%</span></div></td><td><span class="growth up"><i class="fa fa-arrow-down"></i> 2%</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="sc">
                    <div class="sc-head">
                        <h5>Key Order Metrics</h5>
                        <span class="sc-head-sub">01 Jun – 25 Jun 2026</span>
                    </div>
                    <div class="sc-body">
                        <div class="info-row"><span class="info-label">Total Orders</span><span class="info-value">1,284</span></div>
                        <div class="info-row"><span class="info-label">Delivered</span><span class="info-value" style="color:var(--green)">1,041 (81%)</span></div>
                        <div class="info-row"><span class="info-label">Processing / Shipped</span><span class="info-value" style="color:var(--blue)">103</span></div>
                        <div class="info-row"><span class="info-label">Pending</span><span class="info-value" style="color:var(--amber)">51</span></div>
                        <div class="info-row"><span class="info-label">Cancelled</span><span class="info-value" style="color:var(--red)">64 (5%)</span></div>
                        <div class="info-row"><span class="info-label">Returned</span><span class="info-value" style="color:var(--purple)">25 (1.9%)</span></div>
                        <div class="info-row"><span class="info-label">Avg. Fulfilment Time</span><span class="info-value">4.2 days</span></div>
                        <div class="info-row"><span class="info-label">Peak Order Hour</span><span class="info-value">10 AM – 11 AM</span></div>
                        <div class="info-row"><span class="info-label">Orders via COD</span><span class="info-value">386 (30%)</span></div>
                        <div class="info-row" style="border-top:2px solid var(--border);margin-top:4px;padding-top:12px">
                            <span style="font-size:14px;font-weight:650;color:var(--text-primary)">Avg. Order Value</span>
                            <span style="font-size:18px;font-weight:750;color:var(--accent)">₹3,840</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')

<script>
/* ── Static data ── */
const days = ['1 Jun','2 Jun','3 Jun','4 Jun','5 Jun','6 Jun','7 Jun','8 Jun','9 Jun','10 Jun','11 Jun','12 Jun','13 Jun','14 Jun','15 Jun','16 Jun','17 Jun','18 Jun','19 Jun','20 Jun','21 Jun','22 Jun','23 Jun','24 Jun','25 Jun'];
const orders = [38,42,35,50,48,60,55,44,41,39,48,52,58,62,89,71,65,54,49,46,47,45,51,48,52];

/* Order trend */
(function(){
    const ctx = document.getElementById('orderTrendChart');
    if(!ctx) return;
    new Chart(ctx,{
        type:'line',
        data:{
            labels:days,
            datasets:[{
                label:'Orders',data:orders,fill:true,tension:0.45,
                borderColor:'#303d89',borderWidth:2.5,
                pointRadius:3,pointHoverRadius:6,pointBackgroundColor:'#303d89',
                backgroundColor:(c)=>{
                    const {ctx:ct,chartArea}=c.chart;
                    if(!chartArea) return 'transparent';
                    const g=ct.createLinearGradient(0,chartArea.top,0,chartArea.bottom);
                    g.addColorStop(0,'rgba(48,61,137,.18)');
                    g.addColorStop(1,'rgba(48,61,137,0)');
                    return g;
                }
            }]
        },
        options:{
            responsive:true,maintainAspectRatio:false,
            plugins:{legend:{display:false},tooltip:{backgroundColor:'#202223',cornerRadius:8,padding:10,callbacks:{label:v=>' '+v.parsed.y+' orders'}}},
            scales:{
                x:{grid:{display:false},ticks:{color:'#8c9196',font:{size:11},maxTicksLimit:12},border:{display:false}},
                y:{grid:{color:'#f1f2f4'},border:{display:false},ticks:{color:'#8c9196',font:{size:11}}}
            }
        }
    });
})();

/* Status donut */
(function(){
    const ctx=document.getElementById('statusDonut'); if(!ctx) return;
    new Chart(ctx,{
        type:'doughnut',
        data:{
            labels:['Delivered','Processing','Pending','Cancelled','Returned'],
            datasets:[{data:[81,8,4,5,2],backgroundColor:['#007a5e','#0069d9','#916a00','#b22222','#6d28d9'],borderWidth:2,borderColor:'#fff',hoverOffset:6}]
        },
        options:{responsive:true,maintainAspectRatio:false,cutout:'70%',plugins:{legend:{display:false}}}
    });
})();

/* City bar */
(function(){
    const ctx=document.getElementById('cityChart'); if(!ctx) return;
    new Chart(ctx,{
        type:'bar',
        data:{
            labels:['Lucknow','Delhi','Mumbai','Bangalore','Hyderabad','Pune','Jaipur'],
            datasets:[{label:'Orders',data:[248,196,172,158,132,118,96],backgroundColor:'#303d89',borderRadius:5,borderSkipped:false}]
        },
        options:{
            indexAxis:'y',responsive:true,maintainAspectRatio:false,
            plugins:{legend:{display:false},tooltip:{backgroundColor:'#202223',cornerRadius:8}},
            scales:{
                x:{grid:{color:'#f1f2f4'},border:{display:false},ticks:{color:'#8c9196',font:{size:11}}},
                y:{grid:{display:false},border:{display:false},ticks:{color:'#8c9196',font:{size:11}}}
            }
        }
    });
})();

/* Fulfilment distribution */
(function(){
    const ctx=document.getElementById('fulfilmentChart'); if(!ctx) return;
    const data=[{l:'1d',v:92},{l:'2d',v:218},{l:'3d',v:384},{l:'4d',v:226},{l:'5d',v:74},{l:'6d',v:31},{l:'7d+',v:16}];
    new Chart(ctx,{
        type:'bar',
        data:{
            labels:data.map(d=>d.l),
            datasets:[{
                label:'Orders',data:data.map(d=>d.v),
                backgroundColor:data.map(d=>d.v===Math.max(...data.map(x=>x.v))?'#303d89':'#c5c9ed'),
                borderRadius:5,borderSkipped:false
            }]
        },
        options:{
            responsive:true,maintainAspectRatio:false,
            plugins:{legend:{display:false},tooltip:{backgroundColor:'#202223',cornerRadius:8}},
            scales:{
                x:{grid:{display:false},border:{display:false},ticks:{color:'#8c9196',font:{size:11}}},
                y:{grid:{color:'#f1f2f4'},border:{display:false},ticks:{color:'#8c9196',font:{size:11}}}
            }
        }
    });
})();

/* Period comparison */
(function(){
    const ctx=document.getElementById('compareChart'); if(!ctx) return;
    new Chart(ctx,{
        type:'bar',
        data:{
            labels:['First Half','Second Half'],
            datasets:[
                {label:'This Month (Jun)',data:[612,672],backgroundColor:'#303d89',borderRadius:6,borderSkipped:false},
                {label:'Last Month (May)',data:[558,588],backgroundColor:'#e3e5e8',borderRadius:6,borderSkipped:false}
            ]
        },
        options:{
            responsive:true,maintainAspectRatio:false,
            plugins:{legend:{position:'bottom',labels:{font:{size:11},boxWidth:10,padding:10}},tooltip:{backgroundColor:'#202223',cornerRadius:8}},
            scales:{
                x:{grid:{display:false},ticks:{font:{size:11},color:'#8c9196'},border:{display:false}},
                y:{grid:{color:'#f1f2f4'},border:{display:false},ticks:{font:{size:11},color:'#8c9196'}}
            }
        }
    });
})();

/* Date preset toggle */
function setPreset(el) {
    document.querySelectorAll('.date-preset').forEach(e=>e.classList.remove('active'));
    el.classList.add('active');
}
function toggleCustom() {
    const inputs=document.getElementById('customInputs');
    inputs.style.display=inputs.style.display==='none'?'flex':'none';
    document.querySelectorAll('.date-preset').forEach(e=>e.classList.remove('active'));
    document.getElementById('customToggle').classList.add('active');
}
</script>