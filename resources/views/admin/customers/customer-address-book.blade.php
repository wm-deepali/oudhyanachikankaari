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
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .list-page { 
        background: var(--bg); 
        padding: 24px 28px; 
        min-height: 100vh; 
        font-family: var(--font); 
        color: var(--text-primary); 
    }
    .list-page * { box-sizing: border-box; }

    .list-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .list-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    .stat-strip { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:800px) { .stat-strip { grid-template-columns: repeat(2,1fr); } }

    .stat-card { 
        background: var(--surface); 
        border: 1px solid var(--border); 
        border-radius: var(--radius-md); 
        padding: 16px 18px; 
        box-shadow: var(--shadow-card); 
    }
    .stat-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: var(--text-hint); margin-bottom: 6px; }
    .stat-value { font-size: 22px; font-weight: 700; color: var(--text-primary); line-height: 1; }
    .stat-sub { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

    .btn-primary-dash, .btn-secondary-dash {
        display: inline-flex; align-items: center; gap: 6px;
        border-radius: var(--radius-sm); padding: 8px 16px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s;
    }
    .btn-primary-dash { background: var(--accent); color: #fff !important; }
    .btn-primary-dash:hover { background: #252f70; }
    .btn-secondary-dash { background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); }
    .btn-secondary-dash:hover { background: var(--bg); }

    .list-card { 
        background: var(--surface); 
        border: 1px solid var(--border); 
        border-radius: var(--radius-md); 
        box-shadow: var(--shadow-card); 
        overflow: hidden; 
    }

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

    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .data-table thead th { padding: 10px 16px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); white-space: nowrap; text-align: left; }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 13px 16px; font-size: 13px; color: var(--text-primary); vertical-align: middle; }

    .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }

    .cust-cell { display: flex; align-items: center; gap: 10px; }
    .cust-avatar {
        width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
        background: var(--accent-light); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 700; color: var(--accent);
    }
    .cust-name { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .cust-email { font-size: 11.5px; color: var(--text-hint); margin-top: 1px; }

    .addr-primary { font-size: 13px; font-weight: 500; color: var(--text-primary); line-height: 1.5; }
    .addr-secondary { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }

    .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
    .pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .pill-default { background: var(--accent-light); color: var(--accent); }
    .pill-default::before { background: var(--accent); }
    .pill-home { background: var(--green-bg); color: var(--green); }
    .pill-home::before { background: var(--green); }
    .pill-work { background: var(--amber-bg); color: var(--amber); }
    .pill-work::before { background: var(--amber); }

    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: var(--radius-sm);
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-secondary); cursor: pointer; text-decoration: none;
        transition: all .15s;
    }
    .action-btn:hover { background: var(--bg); color: var(--text-primary); }

    .empty-state { text-align: center; padding: 56px 24px; }
    .empty-icon-wrap { width: 56px; height: 56px; border-radius: 50%; background: var(--accent-light); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 22px; }

    .pagination-bar { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .pagination-info { font-size: 12.5px; color: var(--text-hint); }

    @media(max-width:768px) { .list-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="list-page">
            <!-- Page header -->
            <div class="list-page-header">
                <div>
                    <h1>Customer Address Book</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        <a href="#">Customers</a>
                        <span>›</span>
                        Address Book
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
                    <div class="stat-label">Total Addresses</div>
                    <div class="stat-value">4,128</div>
                    <div class="stat-sub">Across all customers</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Default Addresses</div>
                    <div class="stat-value" style="color:var(--accent)">2,847</div>
                    <div class="stat-sub">Primary per customer</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Unique Cities</div>
                    <div class="stat-value" style="color:var(--green)">142</div>
                    <div class="stat-sub">Delivery locations</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Unique States</div>
                    <div class="stat-value" style="color:var(--amber)">28</div>
                    <div class="stat-sub">Regions covered</div>
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
                                           placeholder="Customer name, city, pincode…">
                                </div>
                            </div>
                            <div class="filter-group">
                                <label>Address Type</label>
                                <select class="filter-control">
                                    <option value="">All Types</option>
                                    <option value="home" selected>Home</option>
                                    <option value="work">Work</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>Default Only</label>
                                <select class="filter-control">
                                    <option value="">All Addresses</option>
                                    <option value="1" selected>Default Only</option>
                                    <option value="0">Non-Default</option>
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>State</label>
                                <select class="filter-control">
                                    <option value="">All States</option>
                                    <option value="Uttar Pradesh" selected>Uttar Pradesh</option>
                                    <option value="Delhi">Delhi</option>
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
                                <th style="min-width:180px">Customer</th>
                                <th style="min-width:260px">Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th style="width:100px">Pincode</th>
                             
                                <th style="width:100px">Type</th>
                                <th style="width:100px">Default</th>
                                <th style="width:80px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="id-chip">8921</span></td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">SJ</div>
                                        <div>
                                            <div class="cust-name">Sarah Johnson</div>
                                            <div class="cust-email">sarah.j@email.com</div>
                                            <div class="cust-email">+91-099090000</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="addr-primary">123, Green Park Apartment, Gomti Nagar</div>
                                    <div class="addr-secondary">Near Metro Station</div>
                                </td>
                                <td style="color:var(--text-secondary);font-size:13px">Lucknow</td>
                                <td style="color:var(--text-secondary);font-size:13px">Uttar Pradesh</td>
                                <td><span class="id-chip" style="font-size:12px">226010</span></td>
                                
                                <td><span class="pill pill-home"><i class="fa fa-home" style="font-size:10px"></i> Home</span></td>
                                <td><span class="pill pill-default"><i class="fa fa-check" style="font-size:10px"></i> Default</span></td>
                                <td>
                                    <div style="display:flex;gap:6px">
                                        <a href="#" class="action-btn view" title="View Customer">
                                            <i class="fa fa-user"></i>
                                        </a>
                                        <button class="action-btn danger" title="Delete Address">
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
                        Showing 1–25 of 4,128 addresses
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