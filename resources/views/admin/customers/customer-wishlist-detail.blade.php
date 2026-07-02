@include('admin.top-header')
<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg:#f1f2f4; --surface:#fff; --border:#e3e5e8; --border-hover:#c9cccf;
        --text-primary:#202223; --text-secondary:#6d7175; --text-hint:#8c9196; --text-disabled:#babec3;
        --navy:#303d89; --navy-hover:#252f70; --navy-light:#eef0fc; --navy-border:#c5c9ef;
        --green:#007a5e; --green-bg:#e3f1ec; --green-border:#9fcfc3;
        --red:#c0392b; --red-bg:#fce8e8; --red-border:#f5b8b8;
        --amber:#916a00; --amber-bg:#fff5cc; --amber-border:#e8d080;
        --blue:#0069d9; --blue-bg:#e8f2ff; --blue-border:#a8cdf5;
        --purple:#6d28d9; --purple-bg:#ede9fe; --purple-border:#c4b5fd;
        --radius-sm:6px; --radius-md:8px; --radius-lg:12px;
        --shadow:0 1px 0 rgba(0,0,0,.05),0 0 0 1px rgba(0,0,0,.07);
        --font:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
    }
    .sp-page { background:var(--bg); padding:24px 28px; min-height:100vh; font-family:var(--font); color:var(--text-primary); font-size:14px; }
    .sp-page * { box-sizing:border-box; }

    /* ── Page header ── */
    .sp-ph { display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:20px; }
    .sp-title { font-size:20px; font-weight:660; margin:0 0 4px; letter-spacing:-.2px; }
    .sp-crumb { font-size:12.5px; color:var(--text-hint); display:flex; align-items:center; gap:4px; flex-wrap:wrap; }
    .sp-crumb a { color:var(--navy); text-decoration:none; font-weight:500; }
    .sp-crumb a:hover { text-decoration:underline; }
    .sp-crumb-sep { color:var(--border-hover); }

    /* ── Customer identity bar ── */
    .sp-identity { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-lg); box-shadow:var(--shadow); padding:16px 20px; margin-bottom:20px; display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap; }
    .sp-identity-left { display:flex; align-items:center; gap:14px; }
    .sp-av { width:52px; height:52px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700; color:#fff; flex-shrink:0; border:3px solid #fff; box-shadow:0 2px 8px rgba(0,0,0,.15); }
    .sp-identity-name  { font-size:16px; font-weight:660; color:var(--text-primary); margin-bottom:3px; }
    .sp-identity-email { font-size:12.5px; color:var(--text-hint); }
    .sp-identity-meta  { display:flex; align-items:center; gap:10px; margin-top:6px; flex-wrap:wrap; }
    .sp-meta-chip { display:inline-flex; align-items:center; gap:5px; font-size:12px; font-weight:600; padding:3px 10px; border-radius:20px; }
    .sp-meta-chip.navy   { background:var(--navy-light); color:var(--navy); border:1px solid var(--navy-border); }
    .sp-meta-chip.green  { background:var(--green-bg); color:var(--green); border:1px solid var(--green-border); }
    .sp-meta-chip.amber  { background:var(--amber-bg); color:var(--amber); border:1px solid var(--amber-border); }
    .sp-meta-chip.red    { background:var(--red-bg); color:var(--red); border:1px solid var(--red-border); }
    .sp-identity-right { display:flex; gap:8px; flex-wrap:wrap; align-items:center; }

    /* ── KPI strip ── */
    .sp-kpi-strip { display:grid; grid-template-columns:repeat(5,1fr); gap:14px; margin-bottom:20px; }
    @media(max-width:1100px){.sp-kpi-strip{grid-template-columns:repeat(3,1fr);}}
    @media(max-width:640px){.sp-kpi-strip{grid-template-columns:repeat(2,1fr);}}
    .sp-kpi { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-lg); padding:14px 16px 12px; box-shadow:var(--shadow); }
    .sp-kpi-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
    .sp-kpi-label { font-size:10.5px; font-weight:700; color:var(--text-hint); text-transform:uppercase; letter-spacing:.06em; }
    .sp-kpi-icon { width:30px; height:30px; border-radius:var(--radius-sm); display:flex; align-items:center; justify-content:center; font-size:13px; }
    .ic-navy{background:var(--navy-light);color:var(--navy);}
    .ic-green{background:var(--green-bg);color:var(--green);}
    .ic-red{background:var(--red-bg);color:var(--red);}
    .ic-amber{background:var(--amber-bg);color:var(--amber);}
    .ic-purple{background:var(--purple-bg);color:var(--purple);}
    .sp-kpi-value { font-size:22px; font-weight:760; color:var(--text-primary); line-height:1; margin-bottom:3px; }
    .sp-kpi-sub { font-size:11px; color:var(--text-hint); }

    /* ── Toolbar ── */
    .sp-toolbar { padding:12px 16px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; background:#fafafa; border-radius:var(--radius-lg) var(--radius-lg) 0 0; }
    .sp-toolbar-left  { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .sp-toolbar-right { display:flex; align-items:center; gap:8px; }
    .sp-search-wrap { position:relative; }
    .sp-search { height:34px; border:1px solid var(--border); border-radius:var(--radius-md); padding:0 12px 0 32px; font-size:12.5px; color:var(--text-primary); background:var(--surface); outline:none; font-family:var(--font); width:200px; transition:border-color .15s,box-shadow .15s; }
    .sp-search:focus { border-color:var(--navy); box-shadow:0 0 0 3px rgba(48,61,137,.1); }
    .sp-search-ico { position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--text-hint); font-size:12px; pointer-events:none; }
    .sp-filter-sel { height:34px; border:1px solid var(--border); border-radius:var(--radius-md); padding:0 28px 0 10px; font-size:12.5px; color:var(--text-secondary); background:var(--surface); outline:none; font-family:var(--font); appearance:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
        background-repeat:no-repeat; background-position:right 9px center; cursor:pointer; transition:border-color .15s; }
    .sp-filter-sel:focus { border-color:var(--navy); outline:none; }

    /* ── View toggle ── */
    .sp-view-toggle { display:flex; gap:2px; background:var(--bg); border:1px solid var(--border); border-radius:var(--radius-md); padding:3px; }
    .sp-view-btn { width:30px; height:26px; display:flex; align-items:center; justify-content:center; border-radius:var(--radius-sm); border:none; background:transparent; color:var(--text-hint); cursor:pointer; font-size:12px; transition:all .12s; }
    .sp-view-btn.active { background:var(--surface); color:var(--navy); box-shadow:0 1px 2px rgba(0,0,0,.08); }

    /* ── Buttons ── */
    .sp-btn { display:inline-flex; align-items:center; gap:6px; border-radius:var(--radius-md); padding:7px 14px; font-size:13px; font-weight:600; font-family:var(--font); cursor:pointer; border:1px solid; transition:all .15s; white-space:nowrap; text-decoration:none; }
    .sp-btn-secondary { background:var(--surface); color:var(--text-primary); border-color:var(--border); }
    .sp-btn-secondary:hover { background:var(--bg); border-color:var(--border-hover); color:var(--text-primary); }
    .sp-btn-navy { background:var(--navy); color:#fff; border-color:var(--navy-hover); box-shadow:0 1px 3px rgba(48,61,137,.2); }
    .sp-btn-navy:hover { background:var(--navy-hover); color:#fff; }
    .sp-btn-red { background:var(--red-bg); color:var(--red); border-color:var(--red-border); }
    .sp-btn-red:hover { background:#fad5d5; }

    /* ── Main card ── */
    .sp-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-lg); box-shadow:var(--shadow); overflow:hidden; }

    /* ── GRID VIEW ── */
    .sp-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:16px; padding:20px; }

    .sp-product-card {
        background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-lg);
        overflow:hidden; transition:box-shadow .15s, border-color .15s;
        display:flex; flex-direction:column; position:relative;
    }
    .sp-product-card:hover { box-shadow:0 4px 16px rgba(0,0,0,.1); border-color:var(--border-hover); }

    /* heart remove btn */
    .sp-card-remove {
        position:absolute; top:10px; right:10px; width:28px; height:28px;
        border-radius:50%; background:rgba(255,255,255,.92); border:1px solid var(--border);
        display:flex; align-items:center; justify-content:center; cursor:pointer;
        font-size:12px; color:var(--red); transition:all .12s; z-index:2;
        box-shadow:0 1px 4px rgba(0,0,0,.1);
    }
    .sp-card-remove:hover { background:var(--red-bg); border-color:var(--red-border); transform:scale(1.1); }

    /* stock badge */
    .sp-stock-badge {
        position:absolute; top:10px; left:10px; font-size:10px; font-weight:700;
        padding:2px 8px; border-radius:20px; z-index:2;
    }
    .sp-stock-badge.in   { background:var(--green-bg); color:var(--green); border:1px solid var(--green-border); }
    .sp-stock-badge.low  { background:var(--amber-bg); color:var(--amber); border:1px solid var(--amber-border); }
    .sp-stock-badge.out  { background:var(--red-bg);   color:var(--red);   border:1px solid var(--red-border); }

    /* product image */
    .sp-card-img-wrap { width:100%; aspect-ratio:3/2; background:var(--bg); overflow:hidden; position:relative; }
    .sp-card-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .3s; }
    .sp-product-card:hover .sp-card-img-wrap img { transform:scale(1.04); }

    /* card body */
    .sp-card-body { padding:14px; flex:1; display:flex; flex-direction:column; }
    .sp-card-category { font-size:10.5px; font-weight:700; text-transform:uppercase; letter-spacing:.06em; color:var(--text-hint); margin-bottom:5px; }
    .sp-card-name { font-size:13.5px; font-weight:650; color:var(--text-primary); line-height:1.35; margin-bottom:6px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    .sp-card-sku  { font-size:11px; color:var(--text-hint); font-family:'SF Mono','Fira Code',monospace; margin-bottom:10px; }

    /* price row */
    .sp-card-price-row { display:flex; align-items:center; gap:8px; margin-bottom:10px; }
    .sp-price-current  { font-size:16px; font-weight:760; color:var(--text-primary); }
    .sp-price-original { font-size:12.5px; color:var(--text-hint); text-decoration:line-through; }
    .sp-price-discount { font-size:11px; font-weight:700; color:var(--green); background:var(--green-bg); border-radius:4px; padding:1px 5px; }

    /* variants */
    .sp-card-variants { display:flex; align-items:center; gap:5px; margin-bottom:10px; flex-wrap:wrap; }
    .sp-variant-dot { width:16px; height:16px; border-radius:50%; border:2px solid #fff; box-shadow:0 0 0 1px var(--border); cursor:pointer; flex-shrink:0; }
    .sp-variant-dot.selected { box-shadow:0 0 0 2px var(--navy); }
    .sp-variant-more { font-size:10.5px; color:var(--text-hint); }

    /* added info */
    .sp-card-added { display:flex; align-items:center; gap:5px; font-size:11.5px; color:var(--text-hint); padding-top:10px; border-top:1px solid var(--border); margin-top:auto; }
    .sp-card-added i { font-size:11px; color:var(--text-disabled); }

    /* card footer actions */
    .sp-card-footer { padding:10px 14px 14px; display:flex; gap:8px; }
    .sp-card-action-btn { flex:1; display:inline-flex; align-items:center; justify-content:center; gap:6px; height:34px; border-radius:var(--radius-md); font-size:12.5px; font-weight:600; font-family:var(--font); cursor:pointer; border:1px solid; transition:all .12s; }
    .sp-card-action-btn.view-btn  { background:var(--navy-light); color:var(--navy); border-color:var(--navy-border); }
    .sp-card-action-btn.view-btn:hover  { background:var(--navy); color:#fff; }
    .sp-card-action-btn.order-btn { background:var(--green-bg); color:var(--green); border-color:var(--green-border); }
    .sp-card-action-btn.order-btn:hover { background:var(--green); color:#fff; }

    /* ── LIST VIEW ── */
    .sp-list-view { display:none; }
    .sp-list-view.active { display:block; }
    .sp-grid-view.hidden { display:none; }

    .sp-list-table { width:100%; border-collapse:collapse; font-size:13px; }
    .sp-list-table thead th { font-size:11px; font-weight:650; letter-spacing:.055em; text-transform:uppercase; color:var(--text-hint); padding:10px 16px; border-bottom:1px solid var(--border); background:#fafafa; text-align:left; white-space:nowrap; }
    .sp-list-table tbody tr { border-bottom:1px solid var(--border); transition:background .1s; }
    .sp-list-table tbody tr:last-child { border-bottom:none; }
    .sp-list-table tbody tr:hover { background:#f7f8fb; }
    .sp-list-table td { padding:12px 16px; vertical-align:middle; }

    .sp-list-thumb { width:52px; height:40px; border-radius:var(--radius-sm); object-fit:cover; border:1px solid var(--border); display:block; background:var(--bg); flex-shrink:0; }
    .sp-list-product { display:flex; align-items:center; gap:10px; }
    .sp-list-product-info .name { font-size:13.5px; font-weight:600; color:var(--text-primary); }
    .sp-list-product-info .sku  { font-size:11px; color:var(--text-hint); font-family:'SF Mono','Fira Code',monospace; margin-top:2px; }

    .sp-pill { display:inline-flex; align-items:center; gap:4px; font-size:11px; font-weight:650; padding:2px 8px; border-radius:20px; white-space:nowrap; }
    .sp-pill.in-stock  { background:var(--green-bg); color:var(--green); border:1px solid var(--green-border); }
    .sp-pill.low-stock { background:var(--amber-bg); color:var(--amber); border:1px solid var(--amber-border); }
    .sp-pill.out-stock { background:var(--red-bg);   color:var(--red);   border:1px solid var(--red-border); }

    .sp-list-acts { display:flex; align-items:center; gap:5px; }
    .sp-act-btn { display:inline-flex; align-items:center; justify-content:center; width:30px; height:30px; border-radius:var(--radius-sm); border:1px solid var(--border); background:var(--surface); color:var(--text-secondary); cursor:pointer; text-decoration:none; transition:all .12s; font-size:12px; }
    .sp-act-btn:hover { background:var(--bg); border-color:var(--border-hover); color:var(--text-primary); text-decoration:none; }
    .sp-act-btn.view:hover  { background:var(--navy-light); border-color:var(--navy-border); color:var(--navy); }
    .sp-act-btn.del:hover   { background:var(--red-bg);    border-color:var(--red-border);   color:var(--red); }
    .sp-act-btn.order:hover { background:var(--green-bg);  border-color:var(--green-border); color:var(--green); }

    /* ── Pagination ── */
    .sp-pag { padding:13px 20px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; background:var(--surface); }
    .sp-pag-info { font-size:12.5px; color:var(--text-hint); }
    .sp-pag-btns { display:flex; gap:4px; }
    .sp-pag-btn { display:inline-flex; align-items:center; justify-content:center; min-width:32px; height:32px; padding:0 6px; border:1px solid var(--border); border-radius:var(--radius-md); background:var(--surface); color:var(--text-secondary); font-size:12.5px; font-weight:500; cursor:pointer; font-family:var(--font); transition:all .12s; }
    .sp-pag-btn:hover:not(:disabled) { background:var(--bg); border-color:var(--border-hover); }
    .sp-pag-btn.active { background:var(--navy); border-color:var(--navy); color:#fff; }
    .sp-pag-btn:disabled { opacity:.35; cursor:not-allowed; }

    /* ── Empty state ── */
    .sp-empty { padding:56px 24px; text-align:center; }
    .sp-empty-icon { width:56px; height:56px; background:var(--bg); border:1px solid var(--border); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 14px; font-size:22px; color:var(--text-disabled); }
    .sp-empty-title { font-size:14px; font-weight:650; margin:0 0 4px; }
    .sp-empty-sub   { font-size:13px; color:var(--text-secondary); margin:0; }

    @media(max-width:768px){.sp-page{padding:16px;}.sp-search{width:150px;}}
    </style>

    <div class="app-content content container-fluid">
        <div class="sp-page">

            <!-- Page header -->
            <div class="sp-ph">
                <div>
                    <h1 class="sp-title">Wishlist Detail</h1>
                    <div class="sp-crumb">
                        <a href="#">Dashboard</a><span class="sp-crumb-sep">›</span>
                        <a href="#">Customers</a><span class="sp-crumb-sep">›</span>
                        <a href="#">Wishlists</a><span class="sp-crumb-sep">›</span>
                        <span>Priya Sharma</span>
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
                    <button class="sp-btn sp-btn-secondary"><i class="fa fa-download"></i> Export</button>
                    <button class="sp-btn sp-btn-red" onclick="clearAll()"><i class="fa fa-trash"></i> Clear Wishlist</button>
                </div>
            </div>

            <!-- Customer identity bar -->
            <div class="sp-identity">
                <div class="sp-identity-left">
                    <div class="sp-av" style="background:#303d89">PS</div>
                    <div>
                        <div class="sp-identity-name">Priya Sharma</div>
                        <div class="sp-identity-email">priya.sharma@gmail.com &nbsp;·&nbsp; +91 98765 43210</div>
                        <div class="sp-identity-meta">
                            <span class="sp-meta-chip navy"><i class="fa fa-heart" style="font-size:10px"></i> 14 Wishlist Items</span>
                            <span class="sp-meta-chip green"><i class="fa fa-rupee-sign" style="font-size:10px"></i> ₹38,400 Total Value</span>
                            <span class="sp-meta-chip amber"><i class="fa fa-fire" style="font-size:10px"></i> Hot Customer</span>
                            <span class="sp-meta-chip red"><i class="fa fa-exclamation-circle" style="font-size:10px"></i> 3 Out of Stock</span>
                        </div>
                    </div>
                </div>
                <div class="sp-identity-right">
                    <a href="#" class="sp-btn sp-btn-secondary"><i class="fa fa-user"></i> View Profile</a>
                    <a href="#" class="sp-btn sp-btn-navy"><i class="fa fa-shopping-bag"></i> View Orders</a>
                </div>
            </div>

            <!-- KPI strip -->
            <div class="sp-kpi-strip">
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Total Items</span><div class="sp-kpi-icon ic-navy"><i class="fa fa-heart"></i></div></div>
                    <div class="sp-kpi-value">14</div>
                    <div class="sp-kpi-sub">In wishlist</div>
                </div>
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Total Value</span><div class="sp-kpi-icon ic-green"><i class="fa fa-rupee-sign"></i></div></div>
                    <div class="sp-kpi-value">₹38,400</div>
                    <div class="sp-kpi-sub">Combined MRP</div>
                </div>
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">In Stock</span><div class="sp-kpi-icon ic-green"><i class="fa fa-check-circle"></i></div></div>
                    <div class="sp-kpi-value">11</div>
                    <div class="sp-kpi-sub">Available now</div>
                </div>
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Out of Stock</span><div class="sp-kpi-icon ic-red"><i class="fa fa-times-circle"></i></div></div>
                    <div class="sp-kpi-value">3</div>
                    <div class="sp-kpi-sub">Unavailable</div>
                </div>
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Oldest Added</span><div class="sp-kpi-icon ic-amber"><i class="fa fa-clock"></i></div></div>
                    <div class="sp-kpi-value" style="font-size:16px">42 days</div>
                    <div class="sp-kpi-sub">ago</div>
                </div>
            </div>

            <!-- Main card -->
            <div class="sp-card">

                <!-- Toolbar -->
                <div class="sp-toolbar">
                    <div class="sp-toolbar-left">
                        <div class="sp-search-wrap">
                            <i class="fa fa-search sp-search-ico"></i>
                            <input type="text" class="sp-search" placeholder="Search products…" oninput="filterCards(this.value)">
                        </div>
                        <select class="sp-filter-sel" onchange="filterStock(this.value)">
                            <option value="">All Stock Status</option>
                            <option value="in">In Stock</option>
                            <option value="low">Low Stock</option>
                            <option value="out">Out of Stock</option>
                        </select>
                        <select class="sp-filter-sel" onchange="sortCards(this.value)">
                            <option value="newest">Sort: Newest First</option>
                            <option value="oldest">Sort: Oldest First</option>
                            <option value="price-high">Sort: Price High–Low</option>
                            <option value="price-low">Sort: Price Low–High</option>
                            <option value="name">Sort: Name A–Z</option>
                        </select>
                    </div>
                    <div class="sp-toolbar-right">
                        <span style="font-size:12.5px;color:var(--text-hint);margin-right:4px"><span id="itemCount">14</span> items</span>
                        <div class="sp-view-toggle">
                            <button class="sp-view-btn active" id="gridViewBtn" onclick="setView('grid')" title="Grid view"><i class="fa fa-th-large"></i></button>
                            <button class="sp-view-btn" id="listViewBtn" onclick="setView('list')" title="List view"><i class="fa fa-list"></i></button>
                        </div>
                    </div>
                </div>

                <!-- ══ GRID VIEW ══ -->
                <div class="sp-grid-view" id="gridView">
                    <div class="sp-grid" id="productGrid">

                        <!-- Card 1 -->
                        <div class="sp-product-card" data-name="chikankari anarkali set" data-stock="in" data-price="3200" data-added="2 hours ago">
                            <span class="sp-stock-badge in">In Stock</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap">
                                <img src="https://via.placeholder.com/300x200/f0e6d3/888888?text=Chikankari+Anarkali" alt="Chikankari Anarkali Set">
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Anarkali Sets</div>
                                <div class="sp-card-name">Chikankari Anarkali Set — Ivory White with Thread Work</div>
                                <div class="sp-card-sku">SKU: CHK-ANK-001</div>
                                <div class="sp-card-price-row">
                                    <span class="sp-price-current">₹3,200</span>
                                    <span class="sp-price-original">₹4,000</span>
                                    <span class="sp-price-discount">20% off</span>
                                </div>
                                <div class="sp-card-variants">
                                    <span style="font-size:11px;color:var(--text-hint);margin-right:2px">Colors:</span>
                                    <span class="sp-variant-dot selected" style="background:#f5f0e8" title="Ivory"></span>
                                    <span class="sp-variant-dot" style="background:#c4b5e8" title="Lavender"></span>
                                    <span class="sp-variant-dot" style="background:#f8d4d4" title="Pink"></span>
                                    <span class="sp-variant-more">+2 more</span>
                                </div>
                                <div class="sp-card-added"><i class="fa fa-clock"></i> Added 2 hours ago · Today, 10:42 AM</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn order-btn" onclick="createOrder()"><i class="fa fa-shopping-bag"></i> Order</button>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="sp-product-card" data-name="lucknowi kurta set" data-stock="in" data-price="2800" data-added="1 day ago">
                            <span class="sp-stock-badge in">In Stock</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap">
                                <img src="https://via.placeholder.com/300x200/e8d5c4/888888?text=Lucknowi+Kurta" alt="Lucknowi Kurta Set">
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Kurta Sets</div>
                                <div class="sp-card-name">Lucknowi Kurta Set with Palazzo — Pastel Blue</div>
                                <div class="sp-card-sku">SKU: LKW-KRT-014</div>
                                <div class="sp-card-price-row">
                                    <span class="sp-price-current">₹2,800</span>
                                    <span class="sp-price-original">₹3,200</span>
                                    <span class="sp-price-discount">12% off</span>
                                </div>
                                <div class="sp-card-variants">
                                    <span style="font-size:11px;color:var(--text-hint);margin-right:2px">Colors:</span>
                                    <span class="sp-variant-dot selected" style="background:#b8d4e8" title="Pastel Blue"></span>
                                    <span class="sp-variant-dot" style="background:#e8d4b8" title="Peach"></span>
                                    <span class="sp-variant-more">+1 more</span>
                                </div>
                                <div class="sp-card-added"><i class="fa fa-clock"></i> Added 1 day ago · Yesterday, 3:15 PM</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn order-btn" onclick="createOrder()"><i class="fa fa-shopping-bag"></i> Order</button>
                            </div>
                        </div>

                        <!-- Card 3 — Low Stock -->
                        <div class="sp-product-card" data-name="bakhiya shadow work dupatta" data-stock="low" data-price="1200" data-added="3 days ago">
                            <span class="sp-stock-badge low">Low Stock · 2 left</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap">
                                <img src="https://via.placeholder.com/300x200/d4ecd4/888888?text=Bakhiya+Dupatta" alt="Bakhiya Dupatta">
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Dupattas</div>
                                <div class="sp-card-name">Bakhiya Shadow Work Dupatta — Forest Green</div>
                                <div class="sp-card-sku">SKU: BKH-DPT-007</div>
                                <div class="sp-card-price-row">
                                    <span class="sp-price-current">₹1,200</span>
                                </div>
                                <div class="sp-card-variants">
                                    <span style="font-size:11px;color:var(--text-hint);margin-right:2px">Colors:</span>
                                    <span class="sp-variant-dot selected" style="background:#4a8c5a" title="Forest Green"></span>
                                    <span class="sp-variant-dot" style="background:#8c4a4a" title="Maroon"></span>
                                    <span class="sp-variant-dot" style="background:#4a5a8c" title="Navy"></span>
                                </div>
                                <div class="sp-card-added" style="color:var(--amber)"><i class="fa fa-exclamation-triangle"></i> Only 2 left! Added 3 days ago</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn order-btn" onclick="createOrder()"><i class="fa fa-shopping-bag"></i> Order</button>
                            </div>
                        </div>

                        <!-- Card 4 — Out of Stock -->
                        <div class="sp-product-card" data-name="zardozi embroidered saree" data-stock="out" data-price="5800" data-added="5 days ago">
                            <span class="sp-stock-badge out">Out of Stock</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap" style="position:relative">
                                <img src="https://via.placeholder.com/300x200/e8d4f8/888888?text=Zardozi+Saree" alt="Zardozi Saree" style="filter:grayscale(30%)opacity(.8)">
                                <div style="position:absolute;inset:0;background:rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center">
                                    <span style="background:rgba(192,57,43,.9);color:#fff;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px">Out of Stock</span>
                                </div>
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Sarees</div>
                                <div class="sp-card-name">Zardozi Embroidered Saree — Royal Maroon</div>
                                <div class="sp-card-sku">SKU: ZRD-SAR-022</div>
                                <div class="sp-card-price-row">
                                    <span class="sp-price-current" style="color:var(--text-hint)">₹5,800</span>
                                </div>
                                <div class="sp-card-added" style="color:var(--red)"><i class="fa fa-times-circle"></i> Out of stock · Added 5 days ago</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn" style="flex:1;background:var(--bg);color:var(--text-hint);border-color:var(--border);cursor:not-allowed" disabled>Unavailable</button>
                            </div>
                        </div>

                        <!-- Card 5 -->
                        <div class="sp-product-card" data-name="georgette anarkali suit" data-stock="in" data-price="3600" data-added="6 days ago">
                            <span class="sp-stock-badge in">In Stock</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap">
                                <img src="https://via.placeholder.com/300x200/f8d4d4/888888?text=Georgette+Suit" alt="Georgette Anarkali">
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Anarkali Sets</div>
                                <div class="sp-card-name">Georgette Anarkali Suit — Navy Blue with Embroidery</div>
                                <div class="sp-card-sku">SKU: GEO-ANK-031</div>
                                <div class="sp-card-price-row">
                                    <span class="sp-price-current">₹3,600</span>
                                    <span class="sp-price-original">₹4,500</span>
                                    <span class="sp-price-discount">20% off</span>
                                </div>
                                <div class="sp-card-variants">
                                    <span style="font-size:11px;color:var(--text-hint);margin-right:2px">Colors:</span>
                                    <span class="sp-variant-dot selected" style="background:#2c3e6b" title="Navy"></span>
                                    <span class="sp-variant-dot" style="background:#6b2c2c" title="Wine"></span>
                                </div>
                                <div class="sp-card-added"><i class="fa fa-clock"></i> Added 6 days ago · 18 Jun, 11:20 AM</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn order-btn" onclick="createOrder()"><i class="fa fa-shopping-bag"></i> Order</button>
                            </div>
                        </div>

                        <!-- Card 6 — Out of Stock -->
                        <div class="sp-product-card" data-name="mukaish work kurta" data-stock="out" data-price="2400" data-added="8 days ago">
                            <span class="sp-stock-badge out">Out of Stock</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap" style="position:relative">
                                <img src="https://via.placeholder.com/300x200/e8e0d4/888888?text=Mukaish+Kurta" alt="Mukaish Kurta" style="filter:grayscale(30%)opacity(.8)">
                                <div style="position:absolute;inset:0;background:rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center"><span style="background:rgba(192,57,43,.9);color:#fff;font-size:12px;font-weight:700;padding:5px 14px;border-radius:20px">Out of Stock</span></div>
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Kurtas</div>
                                <div class="sp-card-name">Mukaish Work Straight Kurta — Off White</div>
                                <div class="sp-card-sku">SKU: MKS-KRT-018</div>
                                <div class="sp-card-price-row"><span class="sp-price-current" style="color:var(--text-hint)">₹2,400</span></div>
                                <div class="sp-card-added" style="color:var(--red)"><i class="fa fa-times-circle"></i> Out of stock · Added 8 days ago</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn" style="flex:1;background:var(--bg);color:var(--text-hint);border-color:var(--border);cursor:not-allowed" disabled>Unavailable</button>
                            </div>
                        </div>

                        <!-- Card 7 -->
                        <div class="sp-product-card" data-name="organza saree" data-stock="in" data-price="4200" data-added="10 days ago">
                            <span class="sp-stock-badge in">In Stock</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap">
                                <img src="https://via.placeholder.com/300x200/fce4d4/888888?text=Organza+Saree" alt="Organza Saree">
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Sarees</div>
                                <div class="sp-card-name">Organza Saree with Chikankari Border — Blush Pink</div>
                                <div class="sp-card-sku">SKU: ORG-SAR-009</div>
                                <div class="sp-card-price-row">
                                    <span class="sp-price-current">₹4,200</span>
                                    <span class="sp-price-original">₹5,000</span>
                                    <span class="sp-price-discount">16% off</span>
                                </div>
                                <div class="sp-card-variants">
                                    <span style="font-size:11px;color:var(--text-hint);margin-right:2px">Colors:</span>
                                    <span class="sp-variant-dot selected" style="background:#f4b8c0" title="Blush Pink"></span>
                                    <span class="sp-variant-dot" style="background:#f0e8b8" title="Ivory"></span>
                                    <span class="sp-variant-dot" style="background:#b8c8f4" title="Lilac"></span>
                                </div>
                                <div class="sp-card-added"><i class="fa fa-clock"></i> Added 10 days ago · 14 Jun, 9:05 AM</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn order-btn" onclick="createOrder()"><i class="fa fa-shopping-bag"></i> Order</button>
                            </div>
                        </div>

                        <!-- Card 8 — Low Stock -->
                        <div class="sp-product-card" data-name="banarasi silk dupatta" data-stock="low" data-price="1800" data-added="14 days ago">
                            <span class="sp-stock-badge low">Low Stock · 3 left</span>
                            <button class="sp-card-remove" onclick="removeItem(this)" title="Remove from wishlist"><i class="fa fa-times"></i></button>
                            <div class="sp-card-img-wrap">
                                <img src="https://via.placeholder.com/300x200/f8ecd4/888888?text=Banarasi+Dupatta" alt="Banarasi Dupatta">
                            </div>
                            <div class="sp-card-body">
                                <div class="sp-card-category">Dupattas</div>
                                <div class="sp-card-name">Banarasi Silk Dupatta with Zari Work — Golden</div>
                                <div class="sp-card-sku">SKU: BNR-DPT-041</div>
                                <div class="sp-card-price-row">
                                    <span class="sp-price-current">₹1,800</span>
                                    <span class="sp-price-original">₹2,200</span>
                                    <span class="sp-price-discount">18% off</span>
                                </div>
                                <div class="sp-card-added" style="color:var(--amber)"><i class="fa fa-exclamation-triangle"></i> Only 3 left! Added 14 days ago</div>
                            </div>
                            <div class="sp-card-footer">
                                <button class="sp-card-action-btn view-btn" onclick="viewProduct()"><i class="fa fa-eye"></i> View</button>
                                <button class="sp-card-action-btn order-btn" onclick="createOrder()"><i class="fa fa-shopping-bag"></i> Order</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ══ LIST VIEW ══ -->
                <div class="sp-list-view" id="listView">
                    <table class="sp-list-table">
                        <thead>
                            <tr>
                                <th style="width:52px">#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Stock</th>
                                <th>Variants</th>
                                <th>Date Added</th>
                                <th style="text-align:center;width:110px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">01</span></td>
                                <td><div class="sp-list-product"><img class="sp-list-thumb" src="https://via.placeholder.com/52x40/f0e6d3/888?text=K" alt=""><div class="sp-list-product-info"><div class="name">Chikankari Anarkali Set — Ivory White</div><div class="sku">SKU: CHK-ANK-001</div></div></div></td>
                                <td style="font-size:12.5px;color:var(--text-secondary)">Anarkali Sets</td>
                                <td><strong>₹3,200</strong><br><span style="font-size:11.5px;color:var(--text-hint);text-decoration:line-through">₹4,000</span></td>
                                <td><span style="font-size:12px;font-weight:700;color:var(--green)">20% off</span></td>
                                <td><span class="sp-pill in-stock"><i class="fa fa-circle" style="font-size:7px"></i>In Stock</span></td>
                                <td><span style="font-size:12px;color:var(--text-secondary)">5 colors · 4 sizes</span></td>
                                <td><div style="font-size:12.5px;color:var(--text-secondary)">Today, 10:42 AM<br><span style="font-size:11px;color:var(--text-hint)">2 hours ago</span></div></td>
                                <td><div class="sp-list-acts" style="justify-content:center"><a href="#" class="sp-act-btn view" title="View Product"><i class="fa fa-eye"></i></a><button class="sp-act-btn order" title="Create Order"><i class="fa fa-shopping-bag"></i></button><button class="sp-act-btn del" title="Remove from wishlist" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></div></td>
                            </tr>
                            <tr>
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">02</span></td>
                                <td><div class="sp-list-product"><img class="sp-list-thumb" src="https://via.placeholder.com/52x40/e8d5c4/888?text=L" alt=""><div class="sp-list-product-info"><div class="name">Lucknowi Kurta Set with Palazzo</div><div class="sku">SKU: LKW-KRT-014</div></div></div></td>
                                <td style="font-size:12.5px;color:var(--text-secondary)">Kurta Sets</td>
                                <td><strong>₹2,800</strong><br><span style="font-size:11.5px;color:var(--text-hint);text-decoration:line-through">₹3,200</span></td>
                                <td><span style="font-size:12px;font-weight:700;color:var(--green)">12% off</span></td>
                                <td><span class="sp-pill in-stock"><i class="fa fa-circle" style="font-size:7px"></i>In Stock</span></td>
                                <td><span style="font-size:12px;color:var(--text-secondary)">3 colors · 5 sizes</span></td>
                                <td><div style="font-size:12.5px;color:var(--text-secondary)">Yesterday, 3:15 PM<br><span style="font-size:11px;color:var(--text-hint)">1 day ago</span></div></td>
                                <td><div class="sp-list-acts" style="justify-content:center"><a href="#" class="sp-act-btn view"><i class="fa fa-eye"></i></a><button class="sp-act-btn order"><i class="fa fa-shopping-bag"></i></button><button class="sp-act-btn del" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></div></td>
                            </tr>
                            <tr>
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">03</span></td>
                                <td><div class="sp-list-product"><img class="sp-list-thumb" src="https://via.placeholder.com/52x40/d4ecd4/888?text=B" alt=""><div class="sp-list-product-info"><div class="name">Bakhiya Shadow Work Dupatta</div><div class="sku">SKU: BKH-DPT-007</div></div></div></td>
                                <td style="font-size:12.5px;color:var(--text-secondary)">Dupattas</td>
                                <td><strong>₹1,200</strong></td>
                                <td><span style="font-size:12px;color:var(--text-hint)">—</span></td>
                                <td><span class="sp-pill low-stock"><i class="fa fa-circle" style="font-size:7px"></i>Low Stock · 2 left</span></td>
                                <td><span style="font-size:12px;color:var(--text-secondary)">3 colors · 1 size</span></td>
                                <td><div style="font-size:12.5px;color:var(--text-secondary)">21 Jun, 4:30 PM<br><span style="font-size:11px;color:var(--text-hint)">3 days ago</span></div></td>
                                <td><div class="sp-list-acts" style="justify-content:center"><a href="#" class="sp-act-btn view"><i class="fa fa-eye"></i></a><button class="sp-act-btn order"><i class="fa fa-shopping-bag"></i></button><button class="sp-act-btn del" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></div></td>
                            </tr>
                            <tr>
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">04</span></td>
                                <td><div class="sp-list-product"><img class="sp-list-thumb" src="https://via.placeholder.com/52x40/e8d4f8/888?text=Z" alt="" style="filter:grayscale(40%)opacity(.7)"><div class="sp-list-product-info"><div class="name">Zardozi Embroidered Saree — Maroon</div><div class="sku">SKU: ZRD-SAR-022</div></div></div></td>
                                <td style="font-size:12.5px;color:var(--text-secondary)">Sarees</td>
                                <td><strong style="color:var(--text-hint)">₹5,800</strong></td>
                                <td><span style="font-size:12px;color:var(--text-hint)">—</span></td>
                                <td><span class="sp-pill out-stock"><i class="fa fa-circle" style="font-size:7px"></i>Out of Stock</span></td>
                                <td><span style="font-size:12px;color:var(--text-secondary)">2 colors</span></td>
                                <td><div style="font-size:12.5px;color:var(--text-secondary)">19 Jun, 2:10 PM<br><span style="font-size:11px;color:var(--text-hint)">5 days ago</span></div></td>
                                <td><div class="sp-list-acts" style="justify-content:center"><a href="#" class="sp-act-btn view"><i class="fa fa-eye"></i></a><button class="sp-act-btn" style="cursor:not-allowed;opacity:.4" disabled title="Out of stock"><i class="fa fa-shopping-bag"></i></button><button class="sp-act-btn del" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></div></td>
                            </tr>
                            <tr>
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">05</span></td>
                                <td><div class="sp-list-product"><img class="sp-list-thumb" src="https://via.placeholder.com/52x40/fce4d4/888?text=O" alt=""><div class="sp-list-product-info"><div class="name">Organza Saree with Chikankari Border</div><div class="sku">SKU: ORG-SAR-009</div></div></div></td>
                                <td style="font-size:12.5px;color:var(--text-secondary)">Sarees</td>
                                <td><strong>₹4,200</strong><br><span style="font-size:11.5px;color:var(--text-hint);text-decoration:line-through">₹5,000</span></td>
                                <td><span style="font-size:12px;font-weight:700;color:var(--green)">16% off</span></td>
                                <td><span class="sp-pill in-stock"><i class="fa fa-circle" style="font-size:7px"></i>In Stock</span></td>
                                <td><span style="font-size:12px;color:var(--text-secondary)">3 colors</span></td>
                                <td><div style="font-size:12.5px;color:var(--text-secondary)">14 Jun, 9:05 AM<br><span style="font-size:11px;color:var(--text-hint)">10 days ago</span></div></td>
                                <td><div class="sp-list-acts" style="justify-content:center"><a href="#" class="sp-act-btn view"><i class="fa fa-eye"></i></a><button class="sp-act-btn order"><i class="fa fa-shopping-bag"></i></button><button class="sp-act-btn del" onclick="this.closest('tr').remove()"><i class="fa fa-times"></i></button></div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="sp-pag">
                    <span class="sp-pag-info">Showing 8 of 14 items</span>
                    <div class="sp-pag-btns">
                        <button class="sp-pag-btn" disabled><i class="fa fa-chevron-left"></i></button>
                        <button class="sp-pag-btn active">1</button>
                        <button class="sp-pag-btn">2</button>
                        <button class="sp-pag-btn"><i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
/* ── View toggle ── */
function setView(v) {
    const grid = document.getElementById('gridView');
    const list = document.getElementById('listView');
    const gb   = document.getElementById('gridViewBtn');
    const lb   = document.getElementById('listViewBtn');
    if (v === 'grid') {
        grid.classList.remove('hidden'); list.classList.remove('active');
        gb.classList.add('active'); lb.classList.remove('active');
    } else {
        grid.classList.add('hidden'); list.classList.add('active');
        gb.classList.remove('active'); lb.classList.add('active');
    }
}

/* ── Filter cards (grid) ── */
function filterCards(val) {
    val = val.toLowerCase();
    let c = 0;
    document.querySelectorAll('#productGrid .sp-product-card').forEach(card => {
        const show = card.dataset.name.includes(val);
        card.style.display = show ? '' : 'none';
        if (show) c++;
    });
    document.getElementById('itemCount').textContent = c;
}

/* ── Filter by stock ── */
function filterStock(val) {
    let c = 0;
    document.querySelectorAll('#productGrid .sp-product-card').forEach(card => {
        const show = !val || card.dataset.stock === val;
        card.style.display = show ? '' : 'none';
        if (show) c++;
    });
    document.getElementById('itemCount').textContent = c;
}

/* ── Sort ── */
function sortCards(val) {
    const grid = document.getElementById('productGrid');
    const cards = [...grid.querySelectorAll('.sp-product-card')];
    cards.sort((a, b) => {
        if (val === 'price-high') return parseInt(b.dataset.price) - parseInt(a.dataset.price);
        if (val === 'price-low')  return parseInt(a.dataset.price) - parseInt(b.dataset.price);
        if (val === 'name') return a.dataset.name.localeCompare(b.dataset.name);
        return 0;
    });
    cards.forEach(c => grid.appendChild(c));
}

/* ── Remove card ── */
function removeItem(btn) {
    const card = btn.closest('.sp-product-card');
    card.style.transition = 'opacity .2s, transform .2s';
    card.style.opacity = '0'; card.style.transform = 'scale(.95)';
    setTimeout(() => card.remove(), 200);
}

/* ── Clear all ── */
function clearAll() {
    Swal.fire({ title:'Clear entire wishlist?', text:"All 14 items saved by Priya Sharma will be removed permanently.", icon:'warning', showCancelButton:true, confirmButtonColor:'#c0392b', cancelButtonColor:'#6d7175', confirmButtonText:'Yes, Clear All' })
    .then(r => { if (r.isConfirmed) {
        document.querySelectorAll('#productGrid .sp-product-card').forEach(c => c.remove());
        Swal.fire({ icon:'success', title:'Wishlist Cleared!', timer:1600, showConfirmButton:false });
    }});
}

/* ── Placeholders ── */
function viewProduct()  { Swal.fire({ icon:'info',  title:'View Product', text:'Navigate to product detail page.', timer:1400, showConfirmButton:false }); }
function createOrder()  { Swal.fire({ icon:'success', title:'Create Order', text:'Redirect to create order for this customer.', timer:1400, showConfirmButton:false }); }
</script>