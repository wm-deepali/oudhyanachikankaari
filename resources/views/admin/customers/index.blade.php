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
        --blue: #0069d9;
        --blue-bg: #e8f2ff;
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .list-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .list-page * { box-sizing: border-box; }
    /* ── Page header ── */
    .list-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .list-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }
    /* ── Summary stats ── */
    .stat-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:800px) { .stat-strip { grid-template-columns: repeat(2,1fr); } }
    .stat-card {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); padding: 16px 18px;
        box-shadow: var(--shadow-card);
    }
    .stat-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: var(--text-hint); margin-bottom: 6px; }
    .stat-value { font-size: 22px; font-weight: 700; color: var(--text-primary); line-height: 1; }
    .stat-sub { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }
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
    /* ── Main card ── */
    .list-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; }
    /* ── Filter bar ── */
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
    .filter-control-wide { min-width: 240px; }
    .filter-actions { display: flex; gap: 8px; }
    /* search with icon */
    .search-wrap { position: relative; }
    .search-wrap .filter-control { padding-left: 32px; }
    .search-wrap .search-ico { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-hint); font-size: 12px; pointer-events: none; }
    /* ── Table ── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .data-table thead th { padding: 10px 16px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); white-space: nowrap; text-align: left; }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 12px 16px; font-size: 13px; color: var(--text-primary); vertical-align: middle; }
    /* ── Customer cell ── */
    .cust-cell { display: flex; align-items: center; gap: 10px; }
    .cust-avatar {
        width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
        background: var(--accent-light); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700; color: var(--accent); text-transform: uppercase;
    }
    .cust-avatar img { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; display: block; }
    .cust-name { font-size: 13.5px; font-weight: 600; color: var(--text-primary); }
    .cust-email { font-size: 12px; color: var(--text-hint); margin-top: 1px; }
    /* ── ID chip ── */
    .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }
    /* ── Pills ── */
    .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; white-space: nowrap; }
    .pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .pill-active { background: var(--green-bg); color: var(--green); }
    .pill-active::before { background: var(--green); }
    .pill-inactive { background: var(--red-bg); color: var(--red); }
    .pill-inactive::before { background: var(--red); }
    .pill-verified { background: var(--blue-bg); color: var(--blue); }
    .pill-verified::before { background: var(--blue); }
    .pill-unverified { background: var(--amber-bg); color: var(--amber); }
    .pill-unverified::before { background: var(--amber); }
    /* ── Action buttons ── */
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: var(--radius-sm);
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-secondary); cursor: pointer; text-decoration: none;
        transition: all .15s; font-size: 12px;
    }
    .action-btn:hover { background: var(--bg); color: var(--text-primary); border-color: #c9cccf; }
    .action-btn.danger:hover { background: var(--red-bg); color: var(--red); border-color: #f5c0c0; }
    .action-btn.view:hover { background: var(--accent-light); color: var(--accent); border-color: rgba(48,61,137,.25); }
    /* ── Order count badge ── */
    .order-badge {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 24px; height: 24px; padding: 0 7px;
        background: var(--accent-light); color: var(--accent);
        border-radius: 12px; font-size: 12px; font-weight: 700;
    }
    /* ── Empty state ── */
    .empty-state { text-align: center; padding: 56px 24px; }
    .empty-icon-wrap { width: 56px; height: 56px; border-radius: 50%; background: var(--accent-light); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 22px; }
    .empty-state h6 { font-size: 14px; font-weight: 650; color: var(--text-primary); margin: 0 0 6px; }
    .empty-state p { font-size: 13px; color: var(--text-hint); margin: 0; }
    /* ── Pagination ── */
    .pagination-bar { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .pagination-info { font-size: 12.5px; color: var(--text-hint); }
    @media(max-width:768px) { .list-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="list-page">
            <!-- Page header -->
            <div class="list-page-header">
                <div>
                    <h1>Customers</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        Customers
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
                    <div class="stat-label">Total Customers</div>
                    <div class="stat-value">2,847</div>
                    <div class="stat-sub">All registered</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Active</div>
                    <div class="stat-value" style="color:var(--green)">2,615</div>
                    <div class="stat-sub">Enabled accounts</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">New This Month</div>
                    <div class="stat-value" style="color:var(--accent)">184</div>
                    <div class="stat-sub">Joined in June 2026</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Verified Email</div>
                    <div class="stat-value" style="color:var(--blue)">2,312</div>
                    <div class="stat-sub">Email confirmed</div>
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
                                           placeholder="Name, email, phone…">
                                </div>
                            </div>
                            <div class="filter-group">
                                <label>Status</label>
                                <select class="filter-control">
                                    <option value="">All Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>Email Verified</label>
                                <select class="filter-control">
                                    <option value="">All</option>
                                    <option value="1" selected>Verified</option>
                                    <option value="0">Unverified</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>Joined</label>
                                <select class="filter-control">
                                    <option value="">All Time</option>
                                    <option value="this_month" selected>This Month</option>
                                    <option value="last_3_months">Last 3 Months</option>
                                </select>
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
                                <th style="width:60px">ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th style="width:110px">Orders</th>
                                <th>Email</th>
                                <th>Verified</th>
                                <th style="width:110px">Joined</th>
                                <th style="width:100px">Status</th>
                                <th style="width:90px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="id-chip">1423</span></td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">SJ</div>
                                        <div>
                                            <div class="cust-name">Sarah Johnson</div>
                                            <div class="cust-email">sarah.j@email.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:var(--text-secondary);font-size:13px">+91 98765 43210</td>
                                <td><span class="order-badge">12</span></td>
                                <td><span class="pill pill-verified">Verified</span></td>
                                <td style="color:var(--text-secondary);font-size:12.5px">sarah.j@email.com</td>
                                <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">12 Jun 2025</td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px">
                                        <a href="#" class="action-btn view" title="View Profile">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button class="action-btn danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="id-chip">1422</span></td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">RK</div>
                                        <div>
                                            <div class="cust-name">Rahul Kumar</div>
                                            <div class="cust-email">rahul.k@email.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="color:var(--text-secondary);font-size:13px">+91 87654 32109</td>
                                <td><span class="order-badge">5</span></td>
                                <td><span class="pill pill-unverified">Unverified</span></td>
                                <td style="color:var(--text-secondary);font-size:12.5px">rahul.k@email.com</td>
                                <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">05 Jun 2026</td>
                                <td><span class="pill pill-active">Active</span></td>
                                <td>
                                    <div style="display:flex;gap:6px">
                                        <a href="#" class="action-btn view" title="View Profile">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button class="action-btn danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-bar">
                    <div class="pagination-info">
                        Showing 1–25 of 2,847 customers
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