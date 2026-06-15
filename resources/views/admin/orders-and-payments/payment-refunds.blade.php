@include('admin.top-header')
<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg: #f1f2f4;
        --surface: #ffffff;
        --border: #e3e5e8;
        --text-primary: #202223;
        --text-secondary:#6d7175;
        --text-hint: #8c9196;
        --accent: #303d89;
        --accent-light: #f0f1fc;
        --green: #007a5e;
        --green-bg: #e3f1ec;
        --red: #b22222;
        --red-bg: #fce8e8;
        --amber: #916a00;
        --amber-bg: #fff5cc;
        --purple: #6d28d9;
        --purple-bg: #ede9fe;
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .list-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .list-page * { box-sizing: border-box; }

    /* Page header */
    .list-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .list-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    /* Stats strip */
    .stat-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:800px) { .stat-strip { grid-template-columns: repeat(2,1fr); } }
    .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px 18px; box-shadow: var(--shadow-card); }
    .stat-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: var(--text-hint); margin-bottom: 6px; }
    .stat-value { font-size: 22px; font-weight: 700; color: var(--text-primary); line-height: 1; }
    .stat-sub { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    /* Buttons */
    .btn-primary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--accent); color: #fff !important; border: none;
        border-radius: var(--radius-sm); padding: 8px 16px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s; box-shadow: 0 1px 3px rgba(48,61,137,.25);
    }
    .btn-primary-dash:hover { background: #252f70; }
    .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--surface); color: var(--text-primary) !important;
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 8px 16px; font-size: 13px; font-weight: 500; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s;
    }
    .btn-secondary-dash:hover { background: var(--bg); }

    /* Main card */
    .list-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }

    /* Filter bar */
    .filter-bar { padding: 16px 20px; border-bottom: 1px solid var(--border); }
    .filter-row { display: flex; flex-wrap: wrap; gap: 12px; align-items: flex-end; }
    .filter-group { display: flex; flex-direction: column; gap: 5px; }
    .filter-group label { font-size: 12px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; }
    .filter-control {
        height: 36px; border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 0 11px; font-size: 13px; color: var(--text-primary);
        background: var(--surface); outline: none;
        transition: border-color .15s, box-shadow .15s; font-family: var(--font); min-width: 140px;
    }
    .filter-control:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .filter-control-wide { min-width: 220px; }
    .filter-actions { display: flex; gap: 8px; }
    .search-wrap { position: relative; }
    .search-wrap .filter-control { padding-left: 32px; }
    .search-wrap .search-ico { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-hint); font-size: 12px; pointer-events: none; }

    /* Table */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .data-table thead th { padding: 10px 16px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); white-space: nowrap; text-align: left; }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 13px 16px; font-size: 13px; color: var(--text-primary); vertical-align: middle; }

    .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }
    .order-id { color: var(--accent); font-weight: 700; font-family: 'SF Mono','Fira Mono',monospace; }

    /* Pills */
    .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; white-space: nowrap; }
    .pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .pill-refunded { background: var(--green-bg); color: var(--green); }
    .pill-refunded::before { background: var(--green); }
    .pill-failed { background: var(--red-bg); color: var(--red); }
    .pill-failed::before { background: var(--red); }
    .pill-processing { background: var(--amber-bg); color: var(--amber); }
    .pill-processing::before { background: var(--amber); }

    /* Action buttons */
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: var(--radius-sm);
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-secondary); cursor: pointer; text-decoration: none;
        transition: all .15s; font-size: 12px;
    }
    .action-btn:hover { background: var(--bg); color: var(--text-primary); }
    .action-btn.view:hover { background: var(--accent-light); color: var(--accent); }

    /* Empty state */
    .empty-state { text-align: center; padding: 56px 24px; }
    .empty-icon-wrap { width: 56px; height: 56px; border-radius: 50%; background: var(--accent-light); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 22px; }

    /* Pagination */
    .pagination-bar { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .pagination-info { font-size: 12.5px; color: var(--text-hint); }

    @media(max-width:768px) { .list-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="list-page">
            <!-- Page header -->
            <div class="list-page-header">
                <div>
                    <h1>Refunds</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        Refunds
                    </div>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap">
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-download"></i> Export CSV
                    </a>
                </div>
            </div>

            <!-- Stats strip -->
            <div class="stat-strip">
                <div class="stat-card">
                    <div class="stat-label">Total Refunds</div>
                    <div class="stat-value">142</div>
                    <div class="stat-sub">All processed refunds</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Refunded</div>
                    <div class="stat-value" style="color:var(--green)">₹12,84,750</div>
                    <div class="stat-sub">Amount returned</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">This Month</div>
                    <div class="stat-value" style="color:var(--accent)">38</div>
                    <div class="stat-sub">Refunds in June</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Failed</div>
                    <div class="stat-value" style="color:var(--red)">7</div>
                    <div class="stat-sub">Refund attempts failed</div>
                </div>
            </div>

            <!-- Main card -->
            <div class="list-card">
                <!-- Filter bar -->
                <div class="filter-bar">
                    <form method="GET">
                        <div class="filter-row">
                            <div class="filter-group" style="flex:1;min-width:200px">
                                <label>Search</label>
                                <div class="search-wrap">
                                    <i class="fa fa-search search-ico"></i>
                                    <input type="text" class="filter-control filter-control-wide"
                                           placeholder="Refund ID, Order ID, Customer...">
                                </div>
                            </div>
                            <div class="filter-group">
                                <label>Status</label>
                                <select class="filter-control">
                                    <option value="">All Status</option>
                                    <option value="refunded" selected>Refunded</option>
                                    <option value="processing">Processing</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>From Date</label>
                                <input type="date" class="filter-control" style="min-width:140px">
                            </div>
                            <div class="filter-actions">
                                <button type="button" class="btn-primary-dash">
                                    <i class="fa fa-search"></i> Search
                                </button>
                                <a href="#" class="btn-secondary-dash">
                                    <i class="fa fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div style="overflow-x:auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:100px">Refund ID</th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Refund Amount</th>
                                <th>Payment Method</th>
                                <th>Reason</th>
                                <th>Refunded On</th>
                                <th>Status</th>
                                <th style="width:80px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="id-chip">REF-3928</span></td>
                                <td><span class="order-id">#ORD-78492</span></td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">SJ</div>
                                        <div>
                                            <div class="cust-name">Sarah Johnson</div>
                                            <div class="cust-email">sarah.j@email.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight:700;color:var(--green)">₹2,499</td>
                                <td style="color:var(--text-secondary);font-size:13px">UPI</td>
                                <td style="color:var(--text-secondary);font-size:12.5px">Defective Product</td>
                                <td style="color:var(--text-secondary);font-size:12.5px">12 Jun 2026</td>
                                <td><span class="pill pill-refunded">Refunded</span></td>
                                <td>
                                    <a href="#" class="action-btn view" title="View Details"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="id-chip">REF-3927</span></td>
                                <td><span class="order-id">#ORD-78215</span></td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">RK</div>
                                        <div>
                                            <div class="cust-name">Rahul Kumar</div>
                                            <div class="cust-email">rahul.k@email.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-weight:700;color:var(--green)">₹1,299</td>
                                <td style="color:var(--text-secondary);font-size:13px">Credit Card</td>
                                <td style="color:var(--text-secondary);font-size:12.5px">Wrong Size</td>
                                <td style="color:var(--text-secondary);font-size:12.5px">11 Jun 2026</td>
                                <td><span class="pill pill-refunded">Refunded</span></td>
                                <td>
                                    <a href="#" class="action-btn view" title="View Details"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-bar">
                    <div class="pagination-info">
                        Showing 1–25 of 142 refunds
                    </div>
                    <div>
                        <a href="#" class="btn-secondary-dash">← Previous</a>
                        <a href="#" class="btn-secondary-dash">Next →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')