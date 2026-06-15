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
    .detail-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .detail-page * { box-sizing: border-box; }
    /* ── Page header ── */
    .detail-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .detail-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
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
    .btn-danger-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--red-bg); color: var(--red) !important; border: 1px solid #f5c0c0;
        border-radius: var(--radius-sm); padding: 8px 16px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font);
        transition: background .15s;
    }
    .btn-danger-dash:hover { background: #f8d0d0; }
    /* ── Layout ── */
    .detail-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }
    @media(max-width:960px) { .detail-layout { grid-template-columns: 1fr; } }
    /* ── Section card ── */
    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; letter-spacing: .01em; }
    .section-card-body { padding: 20px; }
    /* ── Profile hero ── */
    .profile-hero {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius-md); box-shadow: var(--shadow-card);
        padding: 24px; margin-bottom: 20px;
        display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
    }
    .profile-avatar-lg {
        width: 72px; height: 72px; border-radius: 50%; flex-shrink: 0;
        background: var(--accent-light); border: 2px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: 26px; font-weight: 700; color: var(--accent); text-transform: uppercase;
    }
    .profile-avatar-lg img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover; display: block; }
    .profile-hero-info { flex: 1; min-width: 200px; }
    .profile-hero-name { font-size: 18px; font-weight: 700; color: var(--text-primary); margin: 0 0 4px; }
    .profile-hero-meta { font-size: 13px; color: var(--text-hint); display: flex; flex-wrap: wrap; gap: 14px; }
    .profile-hero-meta span { display: flex; align-items: center; gap: 5px; }
    .profile-hero-actions { display: flex; gap: 10px; flex-wrap: wrap; }
    /* ── Stats row ── */
    .cust-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:700px) { .cust-stats { grid-template-columns: repeat(2,1fr); } }
    .cust-stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px 18px; box-shadow: var(--shadow-card); }
    .cust-stat-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: var(--text-hint); margin-bottom: 6px; }
    .cust-stat-value { font-size: 20px; font-weight: 700; color: var(--text-primary); line-height: 1; }
    .cust-stat-sub { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }
    /* ── Detail rows ── */
    .detail-row { display: flex; align-items: flex-start; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .detail-row:last-child { border-bottom: none; padding-bottom: 0; }
    .detail-row:first-child { padding-top: 0; }
    .detail-key { font-size: 12px; font-weight: 600; color: var(--text-secondary); text-transform: uppercase; letter-spacing: .03em; width: 140px; flex-shrink: 0; padding-top: 1px; }
    .detail-val { font-size: 13.5px; color: var(--text-primary); flex: 1; }
    /* ── Pills ── */
    .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
    .pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .pill-active { background: var(--green-bg); color: var(--green); }
    .pill-active::before { background: var(--green); }
    .pill-inactive { background: var(--red-bg); color: var(--red); }
    .pill-inactive::before { background: var(--red); }
    .pill-verified { background: var(--blue-bg); color: var(--blue); }
    .pill-verified::before { background: var(--blue); }
    .pill-unverified { background: var(--amber-bg); color: var(--amber); }
    .pill-unverified::before { background: var(--amber); }
    /* ── Address cards ── */
    .address-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    @media(max-width:600px) { .address-grid { grid-template-columns: 1fr; } }
    .address-card {
        border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 14px 16px; position: relative; transition: border-color .15s;
    }
    .address-card.default-addr { border-color: var(--accent); background: var(--accent-light); }
    .address-default-badge {
        display: inline-flex; align-items: center; gap: 4px;
        background: var(--accent); color: #fff;
        font-size: 10px; font-weight: 700; padding: 2px 8px;
        border-radius: 10px; letter-spacing: .03em;
        margin-bottom: 8px;
    }
    .address-name { font-size: 13.5px; font-weight: 600; color: var(--text-primary); margin-bottom: 4px; }
    .address-lines { font-size: 13px; color: var(--text-secondary); line-height: 1.6; }
    .address-phone { font-size: 12.5px; color: var(--text-hint); margin-top: 6px; }
    /* ── Orders table ── */
    .orders-table { width: 100%; border-collapse: collapse; }
    .orders-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .orders-table thead th { padding: 9px 14px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); text-align: left; white-space: nowrap; }
    .orders-table tbody tr { border-bottom: 1px solid var(--border); transition: background .1s; }
    .orders-table tbody tr:last-child { border-bottom: none; }
    .orders-table tbody tr:hover { background: #fafbfc; }
    .orders-table td { padding: 11px 14px; font-size: 13px; vertical-align: middle; }
    .order-id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }
    .pill-paid { background: var(--green-bg); color: var(--green); }
    .pill-paid::before { background: var(--green); }
    .pill-pending { background: var(--amber-bg); color: var(--amber); }
    .pill-pending::before { background: var(--amber); }
    .pill-cancelled { background: var(--red-bg); color: var(--red); }
    .pill-cancelled::before { background: var(--red); }
    .pill-delivered { background: var(--blue-bg); color: var(--blue); }
    .pill-delivered::before { background: var(--blue); }
    .view-btn { display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: var(--radius-sm); border: 1px solid var(--border); background: var(--surface); color: var(--text-secondary); text-decoration: none; font-size: 12px; transition: all .15s; }
    .view-btn:hover { background: var(--accent-light); color: var(--accent); border-color: rgba(48,61,137,.25); }
    /* ── Empty mini ── */
    .empty-mini { text-align: center; padding: 32px 16px; color: var(--text-hint); font-size: 13px; }
    .empty-mini i { font-size: 24px; margin-bottom: 8px; display: block; }
    /* ── Right sidebar info rows ── */
    .sidebar-row { display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--bg); }
    .sidebar-row:last-child { border-bottom: none; padding-bottom: 0; }
    .sidebar-row:first-child { padding-top: 0; }
    .sidebar-row-label { font-size: 12.5px; color: var(--text-hint); }
    .sidebar-row-value { font-size: 13px; font-weight: 600; color: var(--text-primary); text-align: right; }
    @media(max-width:768px) { .detail-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="detail-page">
            <!-- Page header -->
            <div class="detail-page-header">
                <div>
                    <h1>Customer Profile</h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        <a href="#">Customers</a>
                        <span>›</span>
                        Sarah Johnson
                    </div>
                </div>
                <a href="#" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back to Customers
                </a>
            </div>

            <!-- Profile hero -->
            <div class="profile-hero">
                <div class="profile-avatar-lg">SJ</div>
                <div class="profile-hero-info">
                    <div class="profile-hero-name">Sarah Johnson</div>
                    <div class="profile-hero-meta">
                        <span><i class="fa fa-envelope"></i> sarah.j@email.com</span>
                        <span><i class="fa fa-phone"></i> +91 98765 43210</span>
                        <span><i class="fa fa-calendar"></i> Joined 12 Jun 2025</span>
                    </div>
                    <div style="margin-top:10px;display:flex;gap:8px;flex-wrap:wrap">
                        <span class="pill pill-active">Active</span>
                        <span class="pill pill-verified"><i class="fa fa-check-circle" style="font-size:10px"></i> Email Verified</span>
                    </div>
                </div>
                <div class="profile-hero-actions">
                    <button class="btn-danger-dash">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </div>
            </div>

            <!-- Stats row -->
            <div class="cust-stats">
                <div class="cust-stat-card">
                    <div class="cust-stat-label">Total Orders</div>
                    <div class="cust-stat-value">12</div>
                    <div class="cust-stat-sub">All time</div>
                </div>
                <div class="cust-stat-card">
                    <div class="cust-stat-label">Total Spent</div>
                    <div class="cust-stat-value">₹84,720</div>
                    <div class="cust-stat-sub">Across all orders</div>
                </div>
                <div class="cust-stat-card">
                    <div class="cust-stat-label">Avg Order Value</div>
                    <div class="cust-stat-value">₹7,060</div>
                    <div class="cust-stat-sub">Per order</div>
                </div>
                <div class="cust-stat-card">
                    <div class="cust-stat-label">Saved Addresses</div>
                    <div class="cust-stat-value">3</div>
                    <div class="cust-stat-sub">Address book</div>
                </div>
            </div>

            <!-- Two-column layout -->
            <div class="detail-layout">
                <!-- LEFT COLUMN -->
                <div>
                    <!-- Personal Details -->
                    <div class="section-card">
                        <div class="section-card-header"><h5>Personal Details</h5></div>
                        <div class="section-card-body">
                            <div class="detail-row">
                                <div class="detail-key">Full Name</div>
                                <div class="detail-val">Sarah Johnson</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-key">Email</div>
                                <div class="detail-val">
                                    sarah.j@email.com
                                    <span class="pill pill-verified" style="margin-left:6px;font-size:10.5px">Verified</span>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-key">Phone</div>
                                <div class="detail-val">+91 98765 43210</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-key">Date of Birth</div>
                                <div class="detail-val">15 Mar 1998</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-key">Gender</div>
                                <div class="detail-val" style="text-transform:capitalize">Female</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-key">Status</div>
                                <div class="detail-val">
                                    <span class="pill pill-active">Active</span>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-key">Registered</div>
                                <div class="detail-val">12 Jun 2025, 10:45 AM</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-key">Last Login</div>
                                <div class="detail-val">11 Jun 2026, 03:20 PM</div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Book -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <h5>Address Book</h5>
                            <span style="font-size:12px;color:var(--text-hint)">3 saved</span>
                        </div>
                        <div class="section-card-body">
                            <div class="address-grid">
                                <div class="address-card default-addr">
                                    <div class="address-default-badge"><i class="fa fa-check"></i> Default</div>
                                    <div class="address-name">Sarah Johnson</div>
                                    <div class="address-lines">
                                        123, Green Park Apartment<br>
                                        Near Metro Station, Gomti Nagar<br>
                                        Lucknow, Uttar Pradesh – 226010<br>
                                        India
                                    </div>
                                    <div class="address-phone"><i class="fa fa-phone" style="font-size:11px"></i> +91 98765 43210</div>
                                </div>
                                <div class="address-card">
                                    <div class="address-name">Sarah Johnson</div>
                                    <div class="address-lines">
                                        Office Address, 45 MG Road<br>
                                        Hazratganj<br>
                                        Lucknow, Uttar Pradesh – 226001<br>
                                        India
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <h5>Order History</h5>
                            <a href="#" style="font-size:12.5px;color:var(--accent);text-decoration:none">
                                View all <i class="fa fa-arrow-right" style="font-size:11px"></i>
                            </a>
                        </div>
                        <div style="overflow-x:auto">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th style="width:50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="order-id-chip">#ORD-78492</span></td>
                                        <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">12 Jun 2026</td>
                                        <td style="color:var(--text-secondary)">3 item(s)</td>
                                        <td style="font-weight:600">₹3,597</td>
                                        <td><span class="pill pill-paid">Paid</span></td>
                                        <td><span class="pill pill-delivered">Delivered</span></td>
                                        <td><a href="#" class="view-btn"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td><span class="order-id-chip">#ORD-78215</span></td>
                                        <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">05 Jun 2026</td>
                                        <td style="color:var(--text-secondary)">1 item(s)</td>
                                        <td style="font-weight:600">₹1,299</td>
                                        <td><span class="pill pill-paid">Paid</span></td>
                                        <td><span class="pill pill-delivered">Delivered</span></td>
                                        <td><a href="#" class="view-btn"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDEBAR -->
                <div>
                    <!-- Account Summary -->
                    <div class="section-card">
                        <div class="section-card-header"><h5>Account Summary</h5></div>
                        <div class="section-card-body" style="padding:16px 20px">
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Customer ID</span>
                                <span class="sidebar-row-value" style="font-family:monospace;font-size:12px">#1423</span>
                            </div>
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Account Status</span>
                                <span class="sidebar-row-value"><span class="pill pill-active">Active</span></span>
                            </div>
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Email</span>
                                <span class="sidebar-row-value"><span class="pill pill-verified">Verified</span></span>
                            </div>
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Total Orders</span>
                                <span class="sidebar-row-value">12</span>
                            </div>
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Total Spent</span>
                                <span class="sidebar-row-value">₹84,720</span>
                            </div>
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Addresses</span>
                                <span class="sidebar-row-value">3</span>
                            </div>
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Joined</span>
                                <span class="sidebar-row-value">12 Jun 2025</span>
                            </div>
                            <div class="sidebar-row">
                                <span class="sidebar-row-label">Last Login</span>
                                <span class="sidebar-row-value">Yesterday</span>
                            </div>
                        </div>
                    </div>

                    <!-- Danger zone -->
                    <div class="section-card">
                        <div class="section-card-header"><h5 style="color:var(--red)">Danger Zone</h5></div>
                        <div class="section-card-body" style="padding:16px 20px">
                            <p style="font-size:12.5px;color:var(--text-hint);margin:0 0 12px">
                                Permanently delete this customer and all associated data. This action cannot be undone.
                            </p>
                            <button class="btn-danger-dash" style="width:100%;justify-content:center">
                                <i class="fa fa-trash"></i> Delete Customer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')