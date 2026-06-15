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
        --orange: #c84b00;
        --orange-bg: #fff0e6;
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
    .page-title-row { display: flex; align-items: center; gap: 10px; }
    .page-title-badge {
        display: inline-flex; align-items: center; gap: 5px;
        background: var(--orange-bg); color: var(--orange);
        border: 1px solid rgba(200,75,0,.2); border-radius: 20px;
        font-size: 11.5px; font-weight: 700; padding: 3px 10px;
        letter-spacing: .02em;
    }
    .page-title-badge::before { content:''; width:7px; height:7px; border-radius:50%; background:var(--orange); animation: blink 1.6s ease-in-out infinite; }
    @keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }
    /* ── Stats strip ── */
    .stat-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:800px) { .stat-strip { grid-template-columns: repeat(2,1fr); } }
    .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px 18px; box-shadow: var(--shadow-card); }
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
    .search-wrap { position: relative; }
    .search-wrap .filter-control { padding-left: 32px; }
    .search-wrap .search-ico { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-hint); font-size: 12px; pointer-events: none; }
    /* ── Table ── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .data-table thead th {
        padding: 10px 16px; font-size: 11px; font-weight: 650;
        text-transform: uppercase; letter-spacing: .05em;
        color: var(--text-secondary); white-space: nowrap; text-align: left;
    }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 13px 16px; font-size: 13px; color: var(--text-primary); vertical-align: middle; }
    /* ── ID chip ── */
    .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }
    /* ── Customer cell ── */
    .cust-cell { display: flex; align-items: center; gap: 10px; }
    .cust-avatar {
        width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
        background: var(--accent-light); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 700; color: var(--accent); text-transform: uppercase;
    }
    .cust-name { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .cust-email { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }
    /* ── Cart items preview ── */
    .cart-items-preview { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .cart-thumb {
        width: 36px; height: 36px; border-radius: var(--radius-sm);
        object-fit: cover; border: 1px solid var(--border); flex-shrink: 0;
    }
    .cart-thumb-placeholder {
        width: 36px; height: 36px; border-radius: var(--radius-sm);
        background: var(--bg); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        color: var(--text-hint); font-size: 13px; flex-shrink: 0;
    }
    .cart-more-badge {
        width: 36px; height: 36px; border-radius: var(--radius-sm);
        background: var(--accent-light); border: 1px solid rgba(48,61,137,.2);
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700; color: var(--accent); flex-shrink: 0;
    }
    .cart-item-names { font-size: 12px; color: var(--text-secondary); margin-top: 4px; line-height: 1.5; }
    /* ── Cart value ── */
    .cart-value { font-size: 14px; font-weight: 700; color: var(--text-primary); }
    .cart-value-sub { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }
    /* ── Age pill ── */
    .age-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600;
    }
    .age-fresh { background: var(--green-bg); color: var(--green); }
    .age-warm { background: var(--amber-bg); color: var(--amber); }
    .age-cold { background: var(--orange-bg); color: var(--orange); }
    .age-dead { background: var(--red-bg); color: var(--red); }
    /* ── Action buttons ── */
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: var(--radius-sm);
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-secondary); cursor: pointer; text-decoration: none;
        transition: all .15s; font-size: 12px;
    }
    .action-btn:hover { background: var(--bg); color: var(--text-primary); }
    .action-btn.view:hover { background: var(--accent-light); color: var(--accent); border-color: rgba(48,61,137,.25); }
    .action-btn.danger:hover { background: var(--red-bg); color: var(--red); border-color: #f5c0c0; }
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
                    <div class="page-title-row">
                        <h1>Stored Carts</h1>
                        <span class="page-title-badge">Abandoned</span>
                    </div>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        Stored Carts
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
                    <div class="stat-label">Total Stored Carts</div>
                    <div class="stat-value">387</div>
                    <div class="stat-sub">Customers with items saved</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Total Cart Value</div>
                    <div class="stat-value" style="color:var(--orange)">₹18,47,290</div>
                    <div class="stat-sub">Potential revenue</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Avg Cart Value</div>
                    <div class="stat-value" style="color:var(--accent)">₹4,772</div>
                    <div class="stat-sub">Per stored cart</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Abandoned Today</div>
                    <div class="stat-value" style="color:var(--red)">24</div>
                    <div class="stat-sub">New today</div>
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
                                           placeholder="Customer name or email…">
                                </div>
                            </div>
                            <div class="filter-group">
                                <label>Cart Age</label>
                                <select class="filter-control">
                                    <option value="">All Time</option>
                                    <option value="today" selected>Today</option>
                                    <option value="2days">Last 2 Days</option>
                                    <option value="week">Last 7 Days</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>Min Cart Value</label>
                                <input type="number" class="filter-control" placeholder="e.g. 500" style="min-width:120px">
                            </div>
                            <div class="filter-group">
                                <label>Sort By</label>
                                <select class="filter-control">
                                    <option value="updated_at" selected>Last Updated</option>
                                    <option value="total_value">Cart Value ↓</option>
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
                                <th style="width:50px"></th>
                                <th style="width:60px">ID</th>
                                <th style="min-width:180px">Customer</th>
                                <th style="min-width:200px">Items in Cart</th>
                                <th style="width:80px">Qty</th>
                                <th style="width:130px">Cart Value</th>
                                <th style="width:120px">Last Updated</th>
                                <th style="width:120px">Cart Age</th>
                                <th style="width:80px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center">
                                    <button class="action-btn"><i class="fa fa-chevron-right" style="font-size:11px"></i></button>
                                </td>
                                <td><span class="id-chip">7849</span></td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">SJ</div>
                                        <div>
                                            <div class="cust-name">Sarah Johnson</div>
                                            <div class="cust-email">sarah.j@email.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cart-items-preview">
                                        <div class="cart-thumb-placeholder"><i class="fa fa-image"></i></div>
                                        <div class="cart-more-badge">+2</div>
                                    </div>
                                    <div class="cart-item-names">Wireless Headphones, T-Shirt...</div>
                                </td>
                                <td><span style="font-weight:700;color:var(--text-primary)">4</span></td>
                                <td>
                                    <div class="cart-value">₹8,497</div>
                                    <div class="cart-value-sub">incl. taxes</div>
                                </td>
                                <td style="color:var(--text-secondary);font-size:12.5px">10 Jun 2026<br><span style="font-size:11px">02:45 PM</span></td>
                                <td><span class="age-pill age-warm"><i class="fa fa-clock-o"></i> 2d ago</span></td>
                                <td>
                                    <div style="display:flex;gap:6px">
                                        <a href="#" class="action-btn view"><i class="fa fa-user"></i></a>
                                        <button class="action-btn danger"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <!-- You can add more static rows if needed -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-bar">
                    <div class="pagination-info">
                        Showing 1–25 of 387 stored carts
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