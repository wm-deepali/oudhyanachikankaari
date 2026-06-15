@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        /*
 ═══════════════════════════════════════════════════════════════
  SIDEBAR LAYOUT PROTECTION
  Paste this at the very TOP of your <style> block on any page
  where the sidebar (#cssmenu) gets squeezed or wraps.

  Root cause: the page's content area doesn't have min-width:0,
  so it pushes the sidebar out. This fix locks the sidebar at
  280px and tells the content to absorb remaining space only.
 ═══════════════════════════════════════════════════════════════
*/

/* 1. Force outer shell into a proper side-by-side flex row */
.main-section {
    display: flex !important;
    flex-direction: row !important;
    align-items: stretch !important;
    min-height: 100vh !important;
    overflow: hidden !important;
}

/* 2. Sidebar: hard lock — never shrinks, never grows, sticky scroll */
.main-section #cssmenu {
    flex-shrink: 0 !important;
    flex-grow: 0 !important;
    width: 280px !important;
    min-width: 280px !important;
    max-width: 280px !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    position: sticky !important;
    top: 0 !important;
    height: 100vh !important;
    align-self: flex-start !important;
}

/* 3. Content area: fills remaining space
   min-width: 0 is the KEY fix — without it, flex children
   can overflow their container and squeeze siblings */
.main-section .app-content,
.main-section .app-content.content.container-fluid {
    flex: 1 1 0% !important;
    min-width: 0 !important;
    max-width: 100% !important;
    overflow-x: auto !important;
    box-sizing: border-box !important;
}
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
        --star:          #f59e0b;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
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

    /* ── Stats strip ── */
    .stat-strip { display: grid; grid-template-columns: repeat(5, 1fr); gap: 14px; margin-bottom: 20px; }
    @media(max-width:900px) { .stat-strip { grid-template-columns: repeat(3,1fr); } }
    @media(max-width:600px) { .stat-strip { grid-template-columns: repeat(2,1fr); } }
    .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px 18px; box-shadow: var(--shadow-card); }
    .stat-label { font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; color: var(--text-hint); margin-bottom: 6px; }
    .stat-value { font-size: 22px; font-weight: 700; color: var(--text-primary); line-height: 1; }
    .stat-sub   { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }

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
    .filter-actions { display: flex; gap: 8px; }
    .search-wrap { position: relative; }
    .search-wrap .filter-control { padding-left: 32px; min-width: 220px; }
    .search-wrap .search-ico { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-hint); font-size: 12px; pointer-events: none; }

    /* ── Table ── */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table thead tr { background: #fafafa; border-bottom: 1px solid var(--border); }
    .data-table thead th { padding: 10px 16px; font-size: 11px; font-weight: 650; text-transform: uppercase; letter-spacing: .05em; color: var(--text-secondary); white-space: nowrap; text-align: left; }
    .data-table tbody tr { border-bottom: 1px solid var(--border); transition: background .12s; }
    .data-table tbody tr:last-child { border-bottom: none; }
    .data-table tbody tr:hover { background: #fafbfc; }
    .data-table td { padding: 14px 16px; font-size: 13px; color: var(--text-primary); vertical-align: middle; }

    /* ── ID chip ── */
    .id-chip { display: inline-block; background: var(--bg); border: 1px solid var(--border); border-radius: 6px; padding: 2px 8px; font-size: 11.5px; font-family: 'SF Mono','Fira Mono',monospace; color: var(--text-secondary); }

    /* ── Product cell ── */
    .product-cell { display: flex; align-items: center; gap: 10px; }
    .product-thumb { width: 44px; height: 44px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; }
    .product-thumb-ph { width: 44px; height: 44px; border-radius: var(--radius-sm); background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--text-hint); font-size: 16px; flex-shrink: 0; }
    .product-name { font-size: 13px; font-weight: 600; color: var(--text-primary); line-height: 1.4; }
    .product-sku  { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }

    /* ── Customer cell ── */
    .cust-cell { display: flex; align-items: center; gap: 9px; }
    .cust-avatar { width: 30px; height: 30px; border-radius: 50%; background: var(--accent-light); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: var(--accent); flex-shrink: 0; text-transform: uppercase; }
    .cust-name  { font-size: 13px; font-weight: 500; color: var(--text-primary); }
    .cust-email { font-size: 11.5px; color: var(--text-hint); }

    /* ── Star rating ── */
    .star-row { display: flex; align-items: center; gap: 6px; }
    .stars { display: flex; gap: 2px; }
    .stars i { font-size: 13px; color: #e5e7eb; }
    .stars i.filled { color: var(--star); }
    .stars i.half   { color: var(--star); }
    .star-num { font-size: 12.5px; font-weight: 700; color: var(--text-primary); }

    /* ── Review text cell ── */
    .review-title { font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 3px; }
    .review-body  { font-size: 12.5px; color: var(--text-secondary); line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-width: 300px; }

    /* ── Review images ── */
    .review-imgs { display: flex; gap: 4px; margin-top: 6px; }
    .review-img-thumb { width: 32px; height: 32px; border-radius: 5px; object-fit: cover; border: 1px solid var(--border); cursor: pointer; transition: opacity .15s; }
    .review-img-thumb:hover { opacity: .8; }
    .review-img-more { width: 32px; height: 32px; border-radius: 5px; background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: var(--text-hint); }

    /* ── Pills ── */
    .pill { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; white-space: nowrap; }
    .pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .pill-approved  { background: var(--green-bg); color: var(--green); }
    .pill-approved::before  { background: var(--green); }
    .pill-pending   { background: var(--amber-bg); color: var(--amber); }
    .pill-pending::before   { background: var(--amber); }
    .pill-rejected  { background: var(--red-bg);   color: var(--red); }
    .pill-rejected::before  { background: var(--red); }
    .pill-featured  { background: var(--accent-light); color: var(--accent); border: 1px solid rgba(48,61,137,.2); }
    .pill-featured::before  { background: var(--accent); }

    /* ── Rating filter tabs ── */
    .rating-tabs { display: flex; gap: 6px; flex-wrap: wrap; padding: 12px 20px; border-bottom: 1px solid var(--border); background: #fafafa; }
    .rating-tab {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px; border-radius: 20px; font-size: 12.5px; font-weight: 500;
        border: 1px solid var(--border); background: var(--surface); color: var(--text-secondary);
        cursor: pointer; text-decoration: none; transition: all .15s;
    }
    .rating-tab:hover { border-color: var(--accent); color: var(--accent); background: var(--accent-light); }
    .rating-tab.active { background: var(--accent); border-color: var(--accent); color: #fff; }
    .rating-tab .tab-count { font-size: 11px; font-weight: 700; opacity: .8; }

    /* ── Action buttons ── */
    .action-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px; border-radius: var(--radius-sm);
        border: 1px solid var(--border); background: var(--surface);
        color: var(--text-secondary); cursor: pointer; text-decoration: none;
        transition: all .15s; font-size: 12px;
    }
    .action-btn:hover          { background: var(--bg); color: var(--text-primary); }
    .action-btn.approve:hover  { background: var(--green-bg); color: var(--green); border-color: #b0ddd0; }
    .action-btn.reject:hover   { background: var(--red-bg);   color: var(--red);   border-color: #f5c0c0; }
    .action-btn.danger:hover   { background: var(--red-bg);   color: var(--red);   border-color: #f5c0c0; }
    .action-btn.view:hover     { background: var(--accent-light); color: var(--accent); border-color: rgba(48,61,137,.25); }

    /* ── Verified badge ── */
    .verified-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 600; color: var(--green); background: var(--green-bg); border-radius: 10px; padding: 2px 7px; }

    /* ── Empty state ── */
    .empty-state { text-align: center; padding: 56px 24px; }
    .empty-icon-wrap { width: 56px; height: 56px; border-radius: 50%; background: var(--accent-light); margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 22px; }
    .empty-state h6 { font-size: 14px; font-weight: 650; color: var(--text-primary); margin: 0 0 6px; }
    .empty-state p  { font-size: 13px; color: var(--text-hint); margin: 0; }

    /* ── Pagination ── */
    .pagination-bar { padding: 14px 20px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
    .pagination-info { font-size: 12.5px; color: var(--text-hint); }
    .pagination-bar .pagination { margin: 0; }
    .pagination-bar .page-link { border-color: var(--border); color: var(--accent); font-size: 13px; border-radius: var(--radius-sm) !important; margin: 0 2px; }
    .pagination-bar .page-item.active .page-link { background: var(--accent); border-color: var(--accent); color: #fff; }
    .pagination-bar .page-item.disabled .page-link { color: var(--text-hint); }

    /* ── Review detail modal ── */
    .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 9999; display: none; align-items: center; justify-content: center; padding: 20px; }
    .modal-overlay.open { display: flex; }
    .modal-box { background: var(--surface); border-radius: var(--radius-md); box-shadow: 0 20px 60px rgba(0,0,0,.3); width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; }
    .modal-header { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .modal-header h4 { font-size: 15px; font-weight: 650; margin: 0; color: var(--text-primary); }
    .modal-close { width: 30px; height: 30px; border-radius: var(--radius-sm); border: 1px solid var(--border); background: var(--bg); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-secondary); font-size: 14px; transition: background .15s; }
    .modal-close:hover { background: var(--red-bg); color: var(--red); }
    .modal-body { padding: 24px; }
    .modal-section { margin-bottom: 20px; }
    .modal-section:last-child { margin-bottom: 0; }
    .modal-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--text-hint); margin-bottom: 6px; }
    .modal-value { font-size: 13.5px; color: var(--text-primary); line-height: 1.6; }
    .modal-product-row { display: flex; align-items: center; gap: 12px; padding: 12px; background: var(--bg); border-radius: var(--radius-sm); border: 1px solid var(--border); }
    .modal-actions { display: flex; gap: 10px; padding: 16px 24px; border-top: 1px solid var(--border); background: #fafafa; border-radius: 0 0 var(--radius-md) var(--radius-md); }
    .btn-approve { display: inline-flex; align-items: center; gap: 6px; background: var(--green-bg); color: var(--green) !important; border: 1px solid #b0ddd0; border-radius: var(--radius-sm); padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; font-family: var(--font); transition: background .15s; }
    .btn-approve:hover { background: #c8ede3; }
    .btn-reject  { display: inline-flex; align-items: center; gap: 6px; background: var(--red-bg);   color: var(--red) !important;   border: 1px solid #f5c0c0; border-radius: var(--radius-sm); padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; font-family: var(--font); transition: background .15s; }
    .btn-reject:hover  { background: #f8d0d0; }
    .btn-delete  { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--red) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 8px 16px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; font-family: var(--font); transition: background .15s; margin-left: auto; }
    .btn-delete:hover  { background: var(--red-bg); border-color: #f5c0c0; }

    @media(max-width:768px) { .list-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="list-page">

            <!-- Page header -->
            <div class="list-page-header">
                <div>
                    <h1>Product Reviews</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Product Reviews
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
                    <div class="stat-label">Total Reviews</div>
                    <div class="stat-value">1,284</div>
                    <div class="stat-sub">All time</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Avg Rating</div>
                    <div class="stat-value" style="color:var(--star);display:flex;align-items:center;gap:6px">
                        4.2
                        <i class="fa-solid fa-star" style="font-size:18px"></i>
                    </div>
                    <div class="stat-sub">Out of 5.0</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Pending</div>
                    <div class="stat-value" style="color:var(--amber)">38</div>
                    <div class="stat-sub">Awaiting approval</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Approved</div>
                    <div class="stat-value" style="color:var(--green)">1,196</div>
                    <div class="stat-sub">Published</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Rejected</div>
                    <div class="stat-value" style="color:var(--red)">50</div>
                    <div class="stat-sub">Hidden from store</div>
                </div>
            </div>

            <!-- Main card -->
            <div class="list-card">

                <!-- Filter bar -->
                <div class="filter-bar">
                    <form method="GET" action="#">
                        <div class="filter-row">

                            <div class="filter-group" style="flex:1;min-width:200px">
                                <label>Search</label>
                                <div class="search-wrap">
                                    <i class="fa fa-search search-ico"></i>
                                    <input type="text" name="search" class="filter-control"
                                           placeholder="Product, customer, keyword…">
                                </div>
                            </div>

                            <div class="filter-group">
                                <label>Status</label>
                                <select name="status" class="filter-control">
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Rating</label>
                                <select name="rating" class="filter-control">
                                    <option value="">All Ratings</option>
                                    <option value="5">★★★★★ 5 Star</option>
                                    <option value="4">★★★★☆ 4 Star</option>
                                    <option value="3">★★★☆☆ 3 Star</option>
                                    <option value="2">★★☆☆☆ 2 Star</option>
                                    <option value="1">★☆☆☆☆ 1 Star</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Verified</label>
                                <select name="verified" class="filter-control">
                                    <option value="">All</option>
                                    <option value="1">Verified Purchase</option>
                                    <option value="0">Unverified</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label>Date</label>
                                <select name="period" class="filter-control">
                                    <option value="">All Time</option>
                                    <option value="today">Today</option>
                                    <option value="week">This Week</option>
                                    <option value="month">This Month</option>
                                </select>
                            </div>

                            <div class="filter-actions">
                                <button type="submit" class="btn-primary-dash">
                                    <i class="fa fa-search"></i> Filter
                                </button>
                                <a href="#" class="btn-secondary-dash">
                                    <i class="fa fa-refresh"></i> Reset
                                </a>
                            </div>

                        </div>
                    </form>
                </div>

                <!-- Quick rating tabs -->
                <div class="rating-tabs">
                    <a href="#" class="rating-tab active">All <span class="tab-count">(1,284)</span></a>
                    <a href="#" class="rating-tab">
                        <i class="fa-solid fa-star" style="color:var(--star);font-size:11px"></i>
                        5 Star <span class="tab-count">(612)</span>
                    </a>
                    <a href="#" class="rating-tab">
                        <i class="fa-solid fa-star" style="color:var(--star);font-size:11px"></i>
                        4 Star <span class="tab-count">(380)</span>
                    </a>
                    <a href="#" class="rating-tab">
                        <i class="fa-solid fa-star" style="color:var(--star);font-size:11px"></i>
                        3 Star <span class="tab-count">(148)</span>
                    </a>
                    <a href="#" class="rating-tab">
                        <i class="fa-solid fa-star" style="color:var(--star);font-size:11px"></i>
                        2 Star <span class="tab-count">(82)</span>
                    </a>
                    <a href="#" class="rating-tab">
                        <i class="fa-solid fa-star" style="color:var(--star);font-size:11px"></i>
                        1 Star <span class="tab-count">(62)</span>
                    </a>
                </div>

                <!-- Table -->
                <div style="overflow-x:auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th style="width:60px">ID</th>
                                <th style="min-width:200px">Product</th>
                                <th style="min-width:160px">Customer</th>
                                <th style="width:120px">Rating</th>
                                <th style="min-width:280px">Review</th>
                                <th style="width:110px">Verified</th>
                                <th style="width:110px">Status</th>
                                <th style="width:120px">Date</th>
                                <th style="width:110px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- ── Row 1: Approved, 5 star ── -->
                            <tr id="review_row_1">
                                <td><span class="id-chip">001</span></td>
                                <td>
                                    <div class="product-cell">
                                        <div class="product-thumb-ph"><i class="fa fa-image"></i></div>
                                        <div>
                                            <div class="product-name">Chikankari Kurti — Ivory White</div>
                                            <div class="product-sku">SKU: CHK-IW-M</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">P</div>
                                        <div>
                                            <div class="cust-name">Priya Sharma</div>
                                            <div class="cust-email">priya@gmail.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="star-row">
                                        <div class="stars">
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                        </div>
                                        <span class="star-num">5.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="review-title">Absolutely stunning quality!</div>
                                    <div class="review-body">The embroidery work is so intricate and beautiful. I wore it to a wedding and received so many compliments. The fabric is soft and comfortable.</div>
                                    <div class="review-imgs">
                                        <div class="review-img-thumb" style="background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-hint)"><i class="fa fa-image" style="font-size:11px"></i></div>
                                        <div class="review-img-thumb" style="background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-hint)"><i class="fa fa-image" style="font-size:11px"></i></div>
                                    </div>
                                </td>
                                <td><span class="verified-badge"><i class="fa-solid fa-circle-check" style="font-size:10px"></i> Verified</span></td>
                                <td><span class="pill pill-approved">Approved</span></td>
                                <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">12 Jun 2025</td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <button class="action-btn view" title="View Review" onclick="openModal(1)"><i class="fa fa-eye"></i></button>
                                        <button class="action-btn reject" title="Reject"><i class="fa fa-ban"></i></button>
                                        <button class="action-btn danger" title="Delete" onclick="deleteReview(1)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- ── Row 2: Pending, 4 star ── -->
                            <tr id="review_row_2">
                                <td><span class="id-chip">002</span></td>
                                <td>
                                    <div class="product-cell">
                                        <div class="product-thumb-ph"><i class="fa fa-image"></i></div>
                                        <div>
                                            <div class="product-name">Lucknowi Chikankari Dupatta</div>
                                            <div class="product-sku">SKU: LCD-BL-FREE</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">R</div>
                                        <div>
                                            <div class="cust-name">Riya Verma</div>
                                            <div class="cust-email">riya.v@outlook.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="star-row">
                                        <div class="stars">
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="star-num">4.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="review-title">Good product, slightly delayed delivery</div>
                                    <div class="review-body">The dupatta is lovely with fine chikan work. Colour is exactly as shown. Only complaint is the delivery took a bit longer than expected.</div>
                                </td>
                                <td><span class="verified-badge"><i class="fa-solid fa-circle-check" style="font-size:10px"></i> Verified</span></td>
                                <td><span class="pill pill-pending">Pending</span></td>
                                <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">10 Jun 2025</td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <button class="action-btn view" title="View Review" onclick="openModal(2)"><i class="fa fa-eye"></i></button>
                                        <button class="action-btn approve" title="Approve"><i class="fa fa-check"></i></button>
                                        <button class="action-btn reject" title="Reject"><i class="fa fa-ban"></i></button>
                                        <button class="action-btn danger" title="Delete" onclick="deleteReview(2)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- ── Row 3: Rejected, 1 star ── -->
                            <tr id="review_row_3">
                                <td><span class="id-chip">003</span></td>
                                <td>
                                    <div class="product-cell">
                                        <div class="product-thumb-ph"><i class="fa fa-image"></i></div>
                                        <div>
                                            <div class="product-name">Embroidered Salwar Suit — Pink</div>
                                            <div class="product-sku">SKU: ESS-PK-L</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">A</div>
                                        <div>
                                            <div class="cust-name">Anita Gupta</div>
                                            <div class="cust-email">anita.g@yahoo.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="star-row">
                                        <div class="stars">
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="star-num">1.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="review-title">Very disappointing</div>
                                    <div class="review-body">The colour was completely different from what was shown online. The stitching quality was also very poor. Not recommended.</div>
                                </td>
                                <td style="color:var(--text-hint);font-size:12px">Unverified</td>
                                <td><span class="pill pill-rejected">Rejected</span></td>
                                <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">08 Jun 2025</td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <button class="action-btn view" title="View Review" onclick="openModal(3)"><i class="fa fa-eye"></i></button>
                                        <button class="action-btn approve" title="Approve"><i class="fa fa-check"></i></button>
                                        <button class="action-btn danger" title="Delete" onclick="deleteReview(3)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- ── Row 4: Approved, 3 star ── -->
                            <tr id="review_row_4">
                                <td><span class="id-chip">004</span></td>
                                <td>
                                    <div class="product-cell">
                                        <div class="product-thumb-ph"><i class="fa fa-image"></i></div>
                                        <div>
                                            <div class="product-name">Chikankari Saree — Pastel Blue</div>
                                            <div class="product-sku">SKU: CKS-PB-6M</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">M</div>
                                        <div>
                                            <div class="cust-name">Meena Patel</div>
                                            <div class="cust-email">meena.p@gmail.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="star-row">
                                        <div class="stars">
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                        <span class="star-num">3.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="review-title">Average experience</div>
                                    <div class="review-body">The saree looks decent but the chikan work is not as detailed as shown in the photos. Expected more for the price. Packaging was good though.</div>
                                </td>
                                <td><span class="verified-badge"><i class="fa-solid fa-circle-check" style="font-size:10px"></i> Verified</span></td>
                                <td><span class="pill pill-approved">Approved</span></td>
                                <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">05 Jun 2025</td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <button class="action-btn view" title="View Review" onclick="openModal(4)"><i class="fa fa-eye"></i></button>
                                        <button class="action-btn reject" title="Reject"><i class="fa fa-ban"></i></button>
                                        <button class="action-btn danger" title="Delete" onclick="deleteReview(4)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- ── Row 5: Pending, 5 star ── -->
                            <tr id="review_row_5">
                                <td><span class="id-chip">005</span></td>
                                <td>
                                    <div class="product-cell">
                                        <div class="product-thumb-ph"><i class="fa fa-image"></i></div>
                                        <div>
                                            <div class="product-name">Hand-embroidered Kurta — Beige</div>
                                            <div class="product-sku">SKU: HEK-BG-XL</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="cust-cell">
                                        <div class="cust-avatar">S</div>
                                        <div>
                                            <div class="cust-name">Sunita Rao</div>
                                            <div class="cust-email">sunita.rao@gmail.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="star-row">
                                        <div class="stars">
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                            <i class="fa-solid fa-star filled"></i>
                                        </div>
                                        <span class="star-num">5.0</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="review-title">Best kurta I've ever bought!</div>
                                    <div class="review-body">Incredible craftsmanship. The hand embroidery is flawless. Delivery was quick, packaging was premium. Will definitely order again.</div>
                                </td>
                                <td><span class="verified-badge"><i class="fa-solid fa-circle-check" style="font-size:10px"></i> Verified</span></td>
                                <td><span class="pill pill-pending">Pending</span></td>
                                <td style="color:var(--text-secondary);font-size:12.5px;white-space:nowrap">03 Jun 2025</td>
                                <td>
                                    <div style="display:flex;gap:5px">
                                        <button class="action-btn view" title="View Review" onclick="openModal(5)"><i class="fa fa-eye"></i></button>
                                        <button class="action-btn approve" title="Approve"><i class="fa fa-check"></i></button>
                                        <button class="action-btn reject" title="Reject"><i class="fa fa-ban"></i></button>
                                        <button class="action-btn danger" title="Delete" onclick="deleteReview(5)"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-bar">
                    <div class="pagination-info">Showing 1–5 of 1,284 reviews</div>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><span class="page-link" style="pointer-events:none">…</span></li>
                            <li class="page-item"><a class="page-link" href="#">257</a></li>
                            <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </nav>
                </div>

            </div><!-- /list-card -->

        </div>
    </div>
</div>

<!-- ── Review Detail Modal ── -->
<div class="modal-overlay" id="reviewModal">
    <div class="modal-box">
        <div class="modal-header">
            <h4><i class="fa-solid fa-star" style="color:var(--star);margin-right:6px"></i> Review Detail</h4>
            <div class="modal-close" onclick="closeModal()"><i class="fa fa-times"></i></div>
        </div>
        <div class="modal-body">

            <!-- Product -->
            <div class="modal-section">
                <div class="modal-label">Product</div>
                <div class="modal-product-row">
                    <div style="width:48px;height:48px;border-radius:8px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-hint);flex-shrink:0"><i class="fa fa-image"></i></div>
                    <div>
                        <div style="font-size:13.5px;font-weight:600;color:var(--text-primary)" id="modal-product-name">—</div>
                        <div style="font-size:12px;color:var(--text-hint)" id="modal-product-sku">—</div>
                    </div>
                </div>
            </div>

            <!-- Customer + Rating row -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px" class="modal-section">
                <div>
                    <div class="modal-label">Customer</div>
                    <div class="modal-value" id="modal-customer-name">—</div>
                    <div style="font-size:12px;color:var(--text-hint)" id="modal-customer-email">—</div>
                </div>
                <div>
                    <div class="modal-label">Rating</div>
                    <div class="star-row" id="modal-stars" style="margin-top:4px">—</div>
                </div>
            </div>

            <!-- Review content -->
            <div class="modal-section">
                <div class="modal-label">Review Title</div>
                <div class="modal-value" style="font-weight:600" id="modal-review-title">—</div>
            </div>
            <div class="modal-section">
                <div class="modal-label">Review Body</div>
                <div class="modal-value" id="modal-review-body">—</div>
            </div>

            <!-- Meta row -->
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px" class="modal-section">
                <div>
                    <div class="modal-label">Status</div>
                    <div id="modal-status">—</div>
                </div>
                <div>
                    <div class="modal-label">Verified</div>
                    <div id="modal-verified">—</div>
                </div>
                <div>
                    <div class="modal-label">Date</div>
                    <div class="modal-value" id="modal-date">—</div>
                </div>
            </div>

        </div>
        <div class="modal-actions">
            <button class="btn-approve"><i class="fa fa-check"></i> Approve</button>
            <button class="btn-reject"><i class="fa fa-ban"></i> Reject</button>
            <button class="btn-delete"><i class="fa fa-trash"></i> Delete</button>
        </div>
    </div>
</div>

@include('admin.footer')

<style>
/* Make filled stars yellow */
.fa-star.filled, .fa-solid.fa-star.filled { color: #f59e0b !important; }
</style>

<script>
// Static review data for modal demo
const reviews = {
    1: { product: 'Chikankari Kurti — Ivory White', sku: 'SKU: CHK-IW-M', customer: 'Priya Sharma', email: 'priya@gmail.com', rating: 5, title: 'Absolutely stunning quality!', body: 'The embroidery work is so intricate and beautiful. I wore it to a wedding and received so many compliments. The fabric is soft and comfortable.', status: 'approved', verified: true, date: '12 Jun 2025' },
    2: { product: 'Lucknowi Chikankari Dupatta', sku: 'SKU: LCD-BL-FREE', customer: 'Riya Verma', email: 'riya.v@outlook.com', rating: 4, title: 'Good product, slightly delayed delivery', body: 'The dupatta is lovely with fine chikan work. Colour is exactly as shown. Only complaint is the delivery took a bit longer than expected.', status: 'pending', verified: true, date: '10 Jun 2025' },
    3: { product: 'Embroidered Salwar Suit — Pink', sku: 'SKU: ESS-PK-L', customer: 'Anita Gupta', email: 'anita.g@yahoo.com', rating: 1, title: 'Very disappointing', body: 'The colour was completely different from what was shown online. The stitching quality was also very poor. Not recommended.', status: 'rejected', verified: false, date: '08 Jun 2025' },
    4: { product: 'Chikankari Saree — Pastel Blue', sku: 'SKU: CKS-PB-6M', customer: 'Meena Patel', email: 'meena.p@gmail.com', rating: 3, title: 'Average experience', body: 'The saree looks decent but the chikan work is not as detailed as shown in the photos. Expected more for the price. Packaging was good though.', status: 'approved', verified: true, date: '05 Jun 2025' },
    5: { product: 'Hand-embroidered Kurta — Beige', sku: 'SKU: HEK-BG-XL', customer: 'Sunita Rao', email: 'sunita.rao@gmail.com', rating: 5, title: "Best kurta I've ever bought!", body: "Incredible craftsmanship. The hand embroidery is flawless. Delivery was quick, packaging was premium. Will definitely order again.", status: 'pending', verified: true, date: '03 Jun 2025' }
};

function starsHTML(n) {
    let html = '<div class="stars">';
    for (let i = 1; i <= 5; i++) html += `<i class="fa-solid fa-star${i <= n ? ' filled' : ''}"></i>`;
    html += `</div><span class="star-num">${n}.0</span>`;
    return html;
}

function statusPill(s) {
    const map = { approved: 'pill-approved', pending: 'pill-pending', rejected: 'pill-rejected' };
    return `<span class="pill ${map[s]}">${s.charAt(0).toUpperCase()+s.slice(1)}</span>`;
}

function openModal(id) {
    const r = reviews[id];
    document.getElementById('modal-product-name').textContent = r.product;
    document.getElementById('modal-product-sku').textContent  = r.sku;
    document.getElementById('modal-customer-name').textContent = r.customer;
    document.getElementById('modal-customer-email').textContent = r.email;
    document.getElementById('modal-stars').innerHTML  = starsHTML(r.rating);
    document.getElementById('modal-review-title').textContent = r.title;
    document.getElementById('modal-review-body').textContent  = r.body;
    document.getElementById('modal-status').innerHTML   = statusPill(r.status);
    document.getElementById('modal-verified').innerHTML = r.verified
        ? '<span class="verified-badge"><i class="fa-solid fa-circle-check" style="font-size:10px"></i> Verified</span>'
        : '<span style="color:var(--text-hint);font-size:12.5px">Unverified</span>';
    document.getElementById('modal-date').textContent = r.date;
    document.getElementById('reviewModal').classList.add('open');
}

function closeModal() {
    document.getElementById('reviewModal').classList.remove('open');
}

// Close on overlay click
document.getElementById('reviewModal').addEventListener('click', function (e) {
    if (e.target === this) closeModal();
});

// Delete with SweetAlert
function deleteReview(id) {
    if (typeof Swal === 'undefined') {
        if (confirm('Delete this review permanently?')) {
            document.getElementById('review_row_' + id).remove();
        }
        return;
    }
    Swal.fire({
        title: 'Delete Review?',
        text: 'This review will be permanently removed.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#b22222',
        cancelButtonColor: '#6d7175',
        confirmButtonText: 'Yes, Delete'
    }).then(result => {
        if (result.isConfirmed) {
            const row = document.getElementById('review_row_' + id);
            if (row) row.style.transition = 'opacity .3s', row.style.opacity = 0, setTimeout(() => row.remove(), 300);
            Swal.fire('Deleted!', 'The review has been removed.', 'success');
        }
    });
}

// Rating tab switch
document.querySelectorAll('.rating-tab').forEach(tab => {
    tab.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelectorAll('.rating-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>