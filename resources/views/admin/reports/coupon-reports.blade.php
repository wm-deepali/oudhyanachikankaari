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
            --green: #007a5e;
            --green-bg: #e3f1ec;
            --amber: #916a00;
            --amber-bg: #fff5cc;
            --blue: #0069d9;
            --blue-bg: #e8f2ff;
            --red: #b22222;
            --red-bg: #fce8e8;
            --radius-sm: 8px;
            --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .report-page {
            background: var(--bg);
            padding: 24px 28px;
            min-height: 100vh;
            font-family: var(--font);
            color: var(--text-primary);
            box-sizing: border-box;
        }

        .report-page * { box-sizing: border-box; }

        /* ── Page header ── */
        .rp-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .rp-header h1 {
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

        .crumb a { color: var(--accent); text-decoration: none; }
        .crumb a:hover { text-decoration: underline; }
        .crumb span { margin: 0 5px; }

        /* ── Buttons ── */
        .btn-primary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent);
            color: #fff !important;
            border: none;
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s;
            box-shadow: 0 1px 3px rgba(48,61,137,.25);
        }

        .btn-primary-dash:hover { background: #252f70; }

        .btn-secondary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--surface);
            color: var(--text-primary) !important;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: background .15s;
        }

        .btn-secondary-dash:hover { background: var(--bg); }

        .btn-outline-green {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--green-bg);
            color: var(--green) !important;
            border: 1px solid #b0ddd0;
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none !important;
            font-family: var(--font);
            transition: all .15s;
        }

        .btn-outline-green:hover { background: var(--green); color: #fff !important; }

        /* ── Summary stat cards ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        @media(max-width:960px) { .stat-grid { grid-template-columns: repeat(2,1fr); } }
        @media(max-width:540px) { .stat-grid { grid-template-columns: 1fr; } }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            padding: 18px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .stat-icon.purple { background: var(--accent-light); color: var(--accent); }
        .stat-icon.green  { background: var(--green-bg);     color: var(--green); }
        .stat-icon.amber  { background: var(--amber-bg);     color: var(--amber); }
        .stat-icon.blue   { background: var(--blue-bg);      color: var(--blue); }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--text-hint);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.1;
        }

        .stat-sub {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 3px;
        }

        /* ── Surface card ── */
        .cat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            margin-bottom: 20px;
        }

        /* ── Filter bar ── */
        .filter-bar {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            background: var(--surface);
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .filter-control {
            height: 36px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 11px;
            font-size: 13px;
            color: var(--text-primary);
            background: var(--surface);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            font-family: var(--font);
            min-width: 140px;
        }

        .filter-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48,61,137,.12);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* ── Table ── */
        .cat-table-wrap { overflow-x: auto; }

        .cat-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            font-family: var(--font);
        }

        .cat-table thead th {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--text-hint);
            padding: 10px 16px;
            border-bottom: 1px solid var(--border);
            background: #fafafa;
            text-align: left;
            white-space: nowrap;
        }

        .cat-table tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background .1s;
        }

        .cat-table tbody tr:last-child { border-bottom: none; }
        .cat-table tbody tr:hover { background: #fafbfc; }

        .cat-table tbody td {
            padding: 12px 16px;
            color: var(--text-primary);
            vertical-align: middle;
        }

        /* ── Pills ── */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11.5px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .pill::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            display: inline-block;
        }

        .pill-active   { background: var(--green-bg); color: var(--green); }
        .pill-active::before { background: var(--green); }
        .pill-inactive { background: var(--red-bg);   color: var(--red); }
        .pill-inactive::before { background: var(--red); }
        .pill-expired  { background: var(--amber-bg); color: var(--amber); }
        .pill-expired::before { background: var(--amber); }
        .pill-pct      { background: var(--accent-light); color: var(--accent); }
        .pill-pct::before { background: var(--accent); }
        .pill-fixed    { background: var(--blue-bg);  color: var(--blue); }
        .pill-fixed::before { background: var(--blue); }

        /* ── ID chip ── */
        .id-chip {
            display: inline-block;
            background: var(--bg);
            color: var(--text-secondary);
            font-size: 11px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 6px;
            font-family: 'SF Mono','Fira Code',monospace;
        }

        /* ── Code badge ── */
        .code-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: var(--accent-light);
            color: var(--accent);
            border: 1px solid rgba(48,61,137,.15);
            border-radius: var(--radius-sm);
            padding: 3px 9px;
            font-size: 12.5px;
            font-weight: 700;
            letter-spacing: .04em;
            font-family: 'SF Mono','Fira Code',monospace;
        }

        /* ── Progress bar (usage) ── */
        .usage-wrap {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 110px;
        }

        .usage-bar-bg {
            height: 5px;
            background: var(--border);
            border-radius: 99px;
            overflow: hidden;
        }

        .usage-bar-fill {
            height: 100%;
            border-radius: 99px;
            background: var(--accent);
            transition: width .3s;
        }

        .usage-bar-fill.full { background: var(--green); }
        .usage-bar-fill.high { background: var(--amber); }

        .usage-label {
            font-size: 11.5px;
            color: var(--text-hint);
        }

        /* ── Savings highlight ── */
        .savings-cell {
            font-weight: 700;
            color: var(--green);
        }

        /* ── Pagination ── */
        .cat-pagination {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--surface);
            flex-wrap: wrap;
            gap: 8px;
        }

        .pagination-info {
            font-size: 12.5px;
            color: var(--text-hint);
        }

        /* ── Top coupon leaderboard ── */
        .leaderboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        @media(max-width:860px) { .leaderboard-grid { grid-template-columns: 1fr; } }

        .lb-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .lb-card-header {
            padding: 13px 18px;
            border-bottom: 1px solid var(--border);
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .lb-card-header h5 {
            font-size: 13px;
            font-weight: 650;
            color: var(--text-primary);
            margin: 0;
        }

        .lb-card-header span {
            font-size: 12px;
            color: var(--text-hint);
        }

        .lb-row {
            display: flex;
            align-items: center;
            padding: 11px 18px;
            border-bottom: 1px solid var(--border);
            gap: 12px;
            transition: background .1s;
        }

        .lb-row:last-child { border-bottom: none; }
        .lb-row:hover { background: #fafbfc; }

        .lb-rank {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .lb-rank.r1 { background: #fff3cd; color: #856404; }
        .lb-rank.r2 { background: #f0f0f0; color: #555; }
        .lb-rank.r3 { background: #fde8d8; color: #9a4a1e; }
        .lb-rank.rn { background: var(--bg); color: var(--text-hint); }

        .lb-code { font-size: 12.5px; font-weight: 700; color: var(--accent); font-family: 'SF Mono','Fira Code',monospace; }
        .lb-meta { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }
        .lb-val  { margin-left: auto; font-size: 13px; font-weight: 700; color: var(--text-primary); white-space: nowrap; }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 64px 20px;
        }

        .empty-state .empty-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--bg);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--text-hint);
            margin-bottom: 14px;
        }

        @media(max-width:768px) {
            .report-page { padding: 16px; }
            .filter-row { flex-direction: column; }
            .filter-control { min-width: 100%; }
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="report-page">

            <!-- Page header -->
            <div class="rp-header">
                <div>
                    <h1>Coupon Report</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.coupons.index') }}">Coupons</a>
                        <span>›</span>
                        Report
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <button class="btn-outline-green" onclick="window.print()">
                        <i class="fa fa-print"></i> Print Report
                    </button>
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-download"></i> Export CSV
                    </a>
                </div>
            </div>

            <!-- ── Summary Stat Cards ── -->
            <div class="stat-grid">

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <i class="fa fa-ticket"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Coupons</div>
                        <div class="stat-value">24</div>
                        <div class="stat-sub">18 active &nbsp;·&nbsp; 6 inactive</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">
                        <i class="fa fa-circle-check"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Redemptions</div>
                        <div class="stat-value">1,382</div>
                        <div class="stat-sub">This month: 214</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon amber">
                        <i class="fa fa-indian-rupee-sign"></i>
                    </div>
                    <div>
                        <div class="stat-label">Total Discount Given</div>
                        <div class="stat-value">₹1,24,560</div>
                        <div class="stat-sub">This month: ₹18,340</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon blue">
                        <i class="fa fa-chart-line"></i>
                    </div>
                    <div>
                        <div class="stat-label">Avg. Discount / Use</div>
                        <div class="stat-value">₹90.13</div>
                        <div class="stat-sub">Across all coupons</div>
                    </div>
                </div>

            </div>

            <!-- ── Top Coupon Leaderboards ── -->
            <div class="leaderboard-grid">

                <!-- Most Used -->
                <div class="lb-card">
                    <div class="lb-card-header">
                        <h5><i class="fa fa-fire" style="color:var(--amber);margin-right:6px"></i>Most Used Coupons</h5>
                        <span>By redemption count</span>
                    </div>

                    <div class="lb-row">
                        <div class="lb-rank r1">1</div>
                        <div>
                            <div class="lb-code">WELCOME10</div>
                            <div class="lb-meta">10% off · Percentage</div>
                        </div>
                        <div class="lb-val">312 uses</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank r2">2</div>
                        <div>
                            <div class="lb-code">FLAT200</div>
                            <div class="lb-meta">₹200 off · Fixed</div>
                        </div>
                        <div class="lb-val">274 uses</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank r3">3</div>
                        <div>
                            <div class="lb-code">SUMMER15</div>
                            <div class="lb-meta">15% off · Percentage</div>
                        </div>
                        <div class="lb-val">198 uses</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank rn">4</div>
                        <div>
                            <div class="lb-code">FIRST50</div>
                            <div class="lb-meta">₹50 off · Fixed</div>
                        </div>
                        <div class="lb-val">155 uses</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank rn">5</div>
                        <div>
                            <div class="lb-code">DIWALI20</div>
                            <div class="lb-meta">20% off · Percentage</div>
                        </div>
                        <div class="lb-val">122 uses</div>
                    </div>
                </div>

                <!-- Most Savings -->
                <div class="lb-card">
                    <div class="lb-card-header">
                        <h5><i class="fa fa-indian-rupee-sign" style="color:var(--green);margin-right:6px"></i>Highest Discount Given</h5>
                        <span>By total savings amount</span>
                    </div>

                    <div class="lb-row">
                        <div class="lb-rank r1">1</div>
                        <div>
                            <div class="lb-code">FLAT200</div>
                            <div class="lb-meta">₹200 off · 274 uses</div>
                        </div>
                        <div class="lb-val" style="color:var(--green)">₹54,800</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank r2">2</div>
                        <div>
                            <div class="lb-code">DIWALI20</div>
                            <div class="lb-meta">20% off · 122 uses</div>
                        </div>
                        <div class="lb-val" style="color:var(--green)">₹28,460</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank r3">3</div>
                        <div>
                            <div class="lb-code">SUMMER15</div>
                            <div class="lb-meta">15% off · 198 uses</div>
                        </div>
                        <div class="lb-val" style="color:var(--green)">₹21,780</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank rn">4</div>
                        <div>
                            <div class="lb-code">WELCOME10</div>
                            <div class="lb-meta">10% off · 312 uses</div>
                        </div>
                        <div class="lb-val" style="color:var(--green)">₹14,040</div>
                    </div>
                    <div class="lb-row">
                        <div class="lb-rank rn">5</div>
                        <div>
                            <div class="lb-code">FIRST50</div>
                            <div class="lb-meta">₹50 off · 155 uses</div>
                        </div>
                        <div class="lb-val" style="color:var(--green)">₹7,750</div>
                    </div>
                </div>

            </div>

            <!-- ── Detail Report Table ── -->
            <div class="cat-card">

                <!-- Filter bar -->
                <div class="filter-bar">
                    <form method="GET">
                        <div class="filter-row">

                            <div class="filter-group">
                                <label>Date From</label>
                                <input type="date" name="date_from" class="filter-control" value="">
                            </div>

                            <div class="filter-group">
                                <label>Date To</label>
                                <input type="date" name="date_to" class="filter-control" value="">
                            </div>

                            <div class="filter-group">
                                <label>Discount Type</label>
                                <select name="discount_type" class="filter-control">
                                    <option value="">All Types</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Status</label>
                                <select name="status" class="filter-control">
                                    <option value="">All</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>

                            <div class="filter-group" style="flex:1">
                                <label>Search Code</label>
                                <input type="text" name="search" class="filter-control" placeholder="Enter coupon code" style="min-width:180px">
                            </div>

                            <div class="filter-actions">
                                <button type="submit" class="btn-primary-dash">
                                    <i class="fa fa-search"></i> Filter
                                </button>
                                <a href="#" class="btn-secondary-dash">Reset</a>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="cat-table-wrap">
                    <table class="cat-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Coupon Code</th>
                                <th>Type</th>
                                <th>Discount Value</th>
                                <th>Min. Order</th>
                                <th>Max. Discount</th>
                                <th>Redemptions</th>
                                <th>Usage Limit</th>
                                <th>Total Savings</th>
                                <th>Validity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Row 1 -->
                            <tr>
                                <td><span class="id-chip">1</span></td>
                                <td><span class="code-badge"><i class="fa fa-tag" style="font-size:10px"></i> WELCOME10</span></td>
                                <td><span class="pill pill-pct">Percentage</span></td>
                                <td>10%</td>
                                <td>₹500.00</td>
                                <td>₹200.00</td>
                                <td>
                                    <div class="usage-wrap">
                                        <div style="font-size:13px;font-weight:600">312 uses</div>
                                        <div class="usage-bar-bg">
                                            <div class="usage-bar-fill high" style="width:78%"></div>
                                        </div>
                                        <div class="usage-label">312 / 400</div>
                                    </div>
                                </td>
                                <td>400</td>
                                <td class="savings-cell">₹14,040</td>
                                <td>
                                    01 Jan 2025<br>
                                    <small style="color:var(--text-hint)">to 31 Dec 2025</small>
                                </td>
                                <td><span class="pill pill-active">Active</span></td>
                            </tr>

                            <!-- Row 2 -->
                            <tr>
                                <td><span class="id-chip">2</span></td>
                                <td><span class="code-badge"><i class="fa fa-tag" style="font-size:10px"></i> FLAT200</span></td>
                                <td><span class="pill pill-fixed">Fixed</span></td>
                                <td>₹200.00</td>
                                <td>₹1,000.00</td>
                                <td>—</td>
                                <td>
                                    <div class="usage-wrap">
                                        <div style="font-size:13px;font-weight:600">274 uses</div>
                                        <div class="usage-bar-bg">
                                            <div class="usage-bar-fill full" style="width:100%"></div>
                                        </div>
                                        <div class="usage-label">274 / 274 (Exhausted)</div>
                                    </div>
                                </td>
                                <td>300</td>
                                <td class="savings-cell">₹54,800</td>
                                <td>
                                    15 Mar 2025<br>
                                    <small style="color:var(--text-hint)">to 15 Jun 2025</small>
                                </td>
                                <td><span class="pill pill-expired">Expired</span></td>
                            </tr>

                            <!-- Row 3 -->
                            <tr>
                                <td><span class="id-chip">3</span></td>
                                <td><span class="code-badge"><i class="fa fa-tag" style="font-size:10px"></i> SUMMER15</span></td>
                                <td><span class="pill pill-pct">Percentage</span></td>
                                <td>15%</td>
                                <td>₹800.00</td>
                                <td>₹350.00</td>
                                <td>
                                    <div class="usage-wrap">
                                        <div style="font-size:13px;font-weight:600">198 uses</div>
                                        <div class="usage-bar-bg">
                                            <div class="usage-bar-fill" style="width:40%"></div>
                                        </div>
                                        <div class="usage-label">198 / 500</div>
                                    </div>
                                </td>
                                <td>500</td>
                                <td class="savings-cell">₹21,780</td>
                                <td>
                                    01 Jun 2025<br>
                                    <small style="color:var(--text-hint)">to 31 Aug 2025</small>
                                </td>
                                <td><span class="pill pill-active">Active</span></td>
                            </tr>

                            <!-- Row 4 -->
                            <tr>
                                <td><span class="id-chip">4</span></td>
                                <td><span class="code-badge"><i class="fa fa-tag" style="font-size:10px"></i> FIRST50</span></td>
                                <td><span class="pill pill-fixed">Fixed</span></td>
                                <td>₹50.00</td>
                                <td>₹300.00</td>
                                <td>—</td>
                                <td>
                                    <div class="usage-wrap">
                                        <div style="font-size:13px;font-weight:600">155 uses</div>
                                        <div class="usage-bar-bg">
                                            <div class="usage-bar-fill" style="width:31%"></div>
                                        </div>
                                        <div class="usage-label">155 / 500</div>
                                    </div>
                                </td>
                                <td>500</td>
                                <td class="savings-cell">₹7,750</td>
                                <td>
                                    01 Jan 2025<br>
                                    <small style="color:var(--text-hint)">to 31 Dec 2025</small>
                                </td>
                                <td><span class="pill pill-active">Active</span></td>
                            </tr>

                            <!-- Row 5 -->
                            <tr>
                                <td><span class="id-chip">5</span></td>
                                <td><span class="code-badge"><i class="fa fa-tag" style="font-size:10px"></i> DIWALI20</span></td>
                                <td><span class="pill pill-pct">Percentage</span></td>
                                <td>20%</td>
                                <td>₹1,200.00</td>
                                <td>₹500.00</td>
                                <td>
                                    <div class="usage-wrap">
                                        <div style="font-size:13px;font-weight:600">122 uses</div>
                                        <div class="usage-bar-bg">
                                            <div class="usage-bar-fill" style="width:61%"></div>
                                        </div>
                                        <div class="usage-label">122 / 200</div>
                                    </div>
                                </td>
                                <td>200</td>
                                <td class="savings-cell">₹28,460</td>
                                <td>
                                    15 Oct 2025<br>
                                    <small style="color:var(--text-hint)">to 15 Nov 2025</small>
                                </td>
                                <td><span class="pill pill-inactive">Inactive</span></td>
                            </tr>

                            <!-- Row 6 -->
                            <tr>
                                <td><span class="id-chip">6</span></td>
                                <td><span class="code-badge"><i class="fa fa-tag" style="font-size:10px"></i> NEWYEAR25</span></td>
                                <td><span class="pill pill-pct">Percentage</span></td>
                                <td>25%</td>
                                <td>₹2,000.00</td>
                                <td>₹600.00</td>
                                <td>
                                    <div class="usage-wrap">
                                        <div style="font-size:13px;font-weight:600">89 uses</div>
                                        <div class="usage-bar-bg">
                                            <div class="usage-bar-fill" style="width:18%"></div>
                                        </div>
                                        <div class="usage-label">89 / 500</div>
                                    </div>
                                </td>
                                <td>500</td>
                                <td class="savings-cell">₹10,230</td>
                                <td>
                                    01 Jan 2026<br>
                                    <small style="color:var(--text-hint)">to 31 Jan 2026</small>
                                </td>
                                <td><span class="pill pill-expired">Expired</span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="cat-pagination">
                    <span class="pagination-info">Showing 1–6 of 24 coupons</span>
                    <div>
                        <!-- pagination rendered here -->
                    </div>
                </div>

            </div><!-- /cat-card -->

        </div><!-- /report-page -->
    </div>
</div>

@include('admin.footer')