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
        --radius-sm:6px; --radius-md:8px; --radius-lg:12px;
        --shadow:0 1px 0 rgba(0,0,0,.05),0 0 0 1px rgba(0,0,0,.07);
        --font:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;
    }
    .sp-page { background:var(--bg); padding:24px 28px; min-height:100vh; font-family:var(--font); color:var(--text-primary); font-size:14px; }
    .sp-page * { box-sizing:border-box; }

    /* header */
    .sp-ph { display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:20px; }
    .sp-title { font-size:20px; font-weight:660; margin:0 0 4px; letter-spacing:-.2px; }
    .sp-crumb { font-size:12.5px; color:var(--text-hint); display:flex; align-items:center; gap:4px; flex-wrap:wrap; }
    .sp-crumb a { color:var(--navy); text-decoration:none; font-weight:500; }
    .sp-crumb a:hover { text-decoration:underline; }
    .sp-crumb-sep { color:var(--border-hover); }

    /* kpi */
    .sp-kpi-strip { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; margin-bottom:20px; }
    @media(max-width:900px){.sp-kpi-strip{grid-template-columns:repeat(2,1fr);}}
    .sp-kpi { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-lg); padding:16px 18px 14px; box-shadow:var(--shadow); }
    .sp-kpi-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
    .sp-kpi-label { font-size:11px; font-weight:700; color:var(--text-hint); text-transform:uppercase; letter-spacing:.06em; }
    .sp-kpi-icon { width:34px; height:34px; border-radius:var(--radius-md); display:flex; align-items:center; justify-content:center; font-size:14px; }
    .ic-red{background:var(--red-bg);color:var(--red);}
    .ic-navy{background:var(--navy-light);color:var(--navy);}
    .ic-green{background:var(--green-bg);color:var(--green);}
    .ic-amber{background:var(--amber-bg);color:var(--amber);}
    .sp-kpi-value { font-size:26px; font-weight:760; color:var(--text-primary); line-height:1; margin-bottom:4px; }
    .sp-kpi-sub { font-size:11.5px; color:var(--text-hint); }

    /* main card */
    .sp-card { background:var(--surface); border:1px solid var(--border); border-radius:var(--radius-lg); box-shadow:var(--shadow); overflow:hidden; }

    /* toolbar */
    .sp-toolbar { padding:12px 16px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; background:#fafafa; }
    .sp-toolbar-left { display:flex; align-items:center; gap:8px; flex-wrap:wrap; }
    .sp-toolbar-right { display:flex; align-items:center; gap:8px; }
    .sp-search-wrap { position:relative; }
    .sp-search { height:34px; border:1px solid var(--border); border-radius:var(--radius-md); padding:0 12px 0 32px; font-size:12.5px; color:var(--text-primary); background:var(--surface); outline:none; font-family:var(--font); width:220px; transition:border-color .15s,box-shadow .15s; }
    .sp-search:focus { border-color:var(--navy); box-shadow:0 0 0 3px rgba(48,61,137,.1); }
    .sp-search-ico { position:absolute; left:10px; top:50%; transform:translateY(-50%); color:var(--text-hint); font-size:12px; pointer-events:none; }
    .sp-filter-sel { height:34px; border:1px solid var(--border); border-radius:var(--radius-md); padding:0 28px 0 10px; font-size:12.5px; color:var(--text-secondary); background:var(--surface); outline:none; font-family:var(--font); appearance:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
        background-repeat:no-repeat; background-position:right 9px center; cursor:pointer; transition:border-color .15s; }
    .sp-filter-sel:focus { border-color:var(--navy); outline:none; }

    /* export btn */
    .sp-btn { display:inline-flex; align-items:center; gap:6px; border-radius:var(--radius-md); padding:7px 14px; font-size:13px; font-weight:600; font-family:var(--font); cursor:pointer; border:1px solid; transition:all .15s; white-space:nowrap; text-decoration:none; }
    .sp-btn-secondary { background:var(--surface); color:var(--text-primary); border-color:var(--border); }
    .sp-btn-secondary:hover { background:var(--bg); border-color:var(--border-hover); color:var(--text-primary); }
    .sp-btn-navy { background:var(--navy); color:#fff; border-color:var(--navy-hover); box-shadow:0 1px 3px rgba(48,61,137,.2); }
    .sp-btn-navy:hover { background:var(--navy-hover); color:#fff; }

    /* table */
    .sp-table { width:100%; border-collapse:collapse; font-size:13.5px; }
    .sp-table thead th { font-size:11px; font-weight:650; letter-spacing:.055em; text-transform:uppercase; color:var(--text-hint); padding:10px 16px; border-bottom:1px solid var(--border); background:#fafafa; text-align:left; white-space:nowrap; }
    .sp-table thead th.center { text-align:center; }
    .sp-table tbody tr { border-bottom:1px solid var(--border); transition:background .1s; }
    .sp-table tbody tr:last-child { border-bottom:none; }
    .sp-table tbody tr:hover { background:#f7f8fb; }
    .sp-table td { padding:13px 16px; vertical-align:middle; }

    /* avatar */
    .sp-av-wrap { display:flex; align-items:center; gap:10px; }
    .sp-av { width:38px; height:38px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:700; color:#fff; flex-shrink:0; }
    .sp-av-name  { font-size:13.5px; font-weight:600; color:var(--text-primary); }
    .sp-av-email { font-size:11.5px; color:var(--text-hint); margin-top:2px; }

    /* product thumbs strip */
    .sp-thumb-strip { display:flex; align-items:center; gap:4px; }
    .sp-thumb { width:36px; height:36px; border-radius:var(--radius-sm); object-fit:cover; border:1px solid var(--border); flex-shrink:0; background:var(--bg); display:flex; align-items:center; justify-content:center; font-size:10px; color:var(--text-disabled); overflow:hidden; }
    .sp-thumb img { width:100%; height:100%; object-fit:cover; border-radius:var(--radius-sm); }
    .sp-thumb-more { width:36px; height:36px; border-radius:var(--radius-sm); background:var(--navy-light); border:1px solid var(--navy-border); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:var(--navy); flex-shrink:0; }

    /* count badge */
    .sp-count-badge { display:inline-flex; align-items:center; justify-content:center; min-width:28px; height:22px; padding:0 8px; background:var(--navy-light); border:1px solid var(--navy-border); border-radius:var(--radius-sm); font-size:12px; font-weight:700; color:var(--navy); }

    /* value badge */
    .sp-value { font-size:13px; font-weight:650; color:var(--text-primary); }
    .sp-value-sub { font-size:11.5px; color:var(--text-hint); margin-top:1px; }

    /* wishlist heat */
    .sp-heat { display:inline-flex; align-items:center; gap:5px; font-size:11.5px; font-weight:650; padding:3px 9px; border-radius:20px; white-space:nowrap; }
    .sp-heat-hot  { background:var(--red-bg);   color:var(--red);   border:1px solid var(--red-border); }
    .sp-heat-warm { background:var(--amber-bg);  color:var(--amber); border:1px solid var(--amber-border); }
    .sp-heat-cool { background:var(--bg);        color:var(--text-hint); border:1px solid var(--border); }

    /* last added */
    .sp-last-added { font-size:12.5px; color:var(--text-secondary); }
    .sp-last-added span { display:block; font-size:11px; color:var(--text-hint); margin-top:1px; }

    /* actions */
    .sp-actions { display:flex; align-items:center; gap:5px; justify-content:center; }
    .sp-act-btn { display:inline-flex; align-items:center; justify-content:center; width:30px; height:30px; border-radius:var(--radius-sm); border:1px solid var(--border); background:var(--surface); color:var(--text-secondary); cursor:pointer; text-decoration:none; transition:all .12s; font-size:12.5px; }
    .sp-act-btn:hover { background:var(--bg); border-color:var(--border-hover); color:var(--text-primary); text-decoration:none; }
    .sp-act-btn.view:hover { background:var(--navy-light); border-color:var(--navy-border); color:var(--navy); }
    .sp-act-btn.del:hover  { background:var(--red-bg);    border-color:var(--red-border);   color:var(--red); }

    /* pagination */
    .sp-pag { padding:13px 20px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; background:var(--surface); }
    .sp-pag-info { font-size:12.5px; color:var(--text-hint); }
    .sp-pag-btns { display:flex; gap:4px; }
    .sp-pag-btn { display:inline-flex; align-items:center; justify-content:center; min-width:32px; height:32px; padding:0 6px; border:1px solid var(--border); border-radius:var(--radius-md); background:var(--surface); color:var(--text-secondary); font-size:12.5px; font-weight:500; cursor:pointer; font-family:var(--font); transition:all .12s; }
    .sp-pag-btn:hover:not(:disabled) { background:var(--bg); border-color:var(--border-hover); color:var(--text-primary); }
    .sp-pag-btn.active { background:var(--navy); border-color:var(--navy); color:#fff; }
    .sp-pag-btn:disabled { opacity:.35; cursor:not-allowed; }

    @media(max-width:768px){.sp-page{padding:16px;}.sp-search{width:160px;}}
    </style>

    <div class="app-content content container-fluid">
        <div class="sp-page">

            <!-- header -->
            <div class="sp-ph">
                <div>
                    <h1 class="sp-title">Customer Wishlists</h1>
                    <div class="sp-crumb">
                        <a href="#">Dashboard</a><span class="sp-crumb-sep">›</span>
                        <a href="#">Customers</a><span class="sp-crumb-sep">›</span>
                        <span>Wishlists</span>
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <button class="sp-btn sp-btn-secondary"><i class="fa fa-download"></i> Export CSV</button>
                </div>
            </div>

            <!-- kpi -->
            <div class="sp-kpi-strip">
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Customers with Wishlist</span><div class="sp-kpi-icon ic-navy"><i class="fa fa-heart"></i></div></div>
                    <div class="sp-kpi-value">1,284</div>
                    <div class="sp-kpi-sub">Of 4,210 total customers</div>
                </div>
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Total Wishlist Items</span><div class="sp-kpi-icon ic-red"><i class="fa fa-list"></i></div></div>
                    <div class="sp-kpi-value">9,741</div>
                    <div class="sp-kpi-sub">Across all wishlists</div>
                </div>
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Avg. Items / Customer</span><div class="sp-kpi-icon ic-amber"><i class="fa fa-chart-bar"></i></div></div>
                    <div class="sp-kpi-value">7.6</div>
                    <div class="sp-kpi-sub">Items per wishlist</div>
                </div>
                <div class="sp-kpi">
                    <div class="sp-kpi-top"><span class="sp-kpi-label">Total Wishlist Value</span><div class="sp-kpi-icon ic-green"><i class="fa fa-rupee-sign"></i></div></div>
                    <div class="sp-kpi-value">₹48.2L</div>
                    <div class="sp-kpi-sub">Combined product value</div>
                </div>
            </div>

            <!-- main card -->
            <div class="sp-card">
                <div class="sp-toolbar">
                    <div class="sp-toolbar-left">
                        <div class="sp-search-wrap">
                            <i class="fa fa-search sp-search-ico"></i>
                            <input type="text" class="sp-search" placeholder="Search customer…" oninput="filterTable(this.value)">
                        </div>
                        <select class="sp-filter-sel" onchange="filterHeat(this.value)">
                            <option value="">All Activity</option>
                            <option value="hot">Hot (10+ items)</option>
                            <option value="warm">Warm (4–9 items)</option>
                            <option value="cool">Cool (1–3 items)</option>
                        </select>
                        <select class="sp-filter-sel">
                            <option>Sort: Last Added</option>
                            <option>Sort: Most Items</option>
                            <option>Sort: Highest Value</option>
                            <option>Sort: Name A–Z</option>
                        </select>
                    </div>
                    <div class="sp-toolbar-right">
                        <span style="font-size:12.5px;color:var(--text-hint)"><span id="rowCount">12</span> customers</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="sp-table" id="wishlistTable">
                        <thead>
                            <tr>
                                <th style="width:52px">#</th>
                                <th>Customer</th>
                                <th>Recent Items</th>
                                <th class="center">Items</th>
                                <th>Wishlist Value</th>
                                <th>Activity</th>
                                <th>Last Added</th>
                                <th class="center" style="width:100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="wlTbody">

                            <tr data-name="priya sharma" data-heat="hot">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#01</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#303d89">PS</div><div><div class="sp-av-name">Priya Sharma</div><div class="sp-av-email">priya.sharma@gmail.com</div></div></div></td>
                                <td>
                                    <div class="sp-thumb-strip">
                                        <div class="sp-thumb"><img src="https://via.placeholder.com/36x36/f0e6d3/888?text=K" alt=""></div>
                                        <div class="sp-thumb"><img src="https://via.placeholder.com/36x36/e8d5c4/888?text=S" alt=""></div>
                                        <div class="sp-thumb"><img src="https://via.placeholder.com/36x36/d4b8a0/888?text=D" alt=""></div>
                                        <div class="sp-thumb-more">+11</div>
                                    </div>
                                </td>
                                <td class="center"><span class="sp-count-badge">14</span></td>
                                <td><div class="sp-value">₹38,400</div><div class="sp-value-sub">avg ₹2,743</div></td>
                                <td><span class="sp-heat sp-heat-hot"><i class="fa fa-fire" style="font-size:10px"></i> Hot</span></td>
                                <td><div class="sp-last-added">2 hours ago<span>Chikankari Anarkali Set</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Priya Sharma','PS','#303d89',14,'₹38,400')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Priya Sharma')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="rahul verma" data-heat="hot">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#02</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#0069d9">RV</div><div><div class="sp-av-name">Rahul Verma</div><div class="sp-av-email">rahul.verma@yahoo.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/c8d4e8/888?text=K" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/b0c4d8/888?text=S" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/98b4c8/888?text=C" alt=""></div><div class="sp-thumb-more">+9</div></div></td>
                                <td class="center"><span class="sp-count-badge">12</span></td>
                                <td><div class="sp-value">₹29,850</div><div class="sp-value-sub">avg ₹2,488</div></td>
                                <td><span class="sp-heat sp-heat-hot"><i class="fa fa-fire" style="font-size:10px"></i> Hot</span></td>
                                <td><div class="sp-last-added">Yesterday<span>Lucknowi Kurta Set (XL)</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Rahul Verma','RV','#0069d9',12,'₹29,850')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Rahul Verma')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="anjali mehta" data-heat="warm">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#03</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#6d28d9">AM</div><div><div class="sp-av-name">Anjali Mehta</div><div class="sp-av-email">anjali.mehta@gmail.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/e4d4f0/888?text=S" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/d4c4e0/888?text=D" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/c4b4d0/888?text=K" alt=""></div><div class="sp-thumb-more">+5</div></div></td>
                                <td class="center"><span class="sp-count-badge">8</span></td>
                                <td><div class="sp-value">₹21,200</div><div class="sp-value-sub">avg ₹2,650</div></td>
                                <td><span class="sp-heat sp-heat-warm"><i class="fa fa-circle" style="font-size:8px"></i> Warm</span></td>
                                <td><div class="sp-last-added">2 days ago<span>Bakhiya Shadow Work Dupatta</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Anjali Mehta','AM','#6d28d9',8,'₹21,200')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Anjali Mehta')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="sneha patel" data-heat="warm">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#04</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#c0392b">SP</div><div><div class="sp-av-name">Sneha Patel</div><div class="sp-av-email">sneha.patel@hotmail.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/f8d4d4/888?text=A" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/f0c4c4/888?text=K" alt=""></div><div class="sp-thumb-more">+5</div></div></td>
                                <td class="center"><span class="sp-count-badge">7</span></td>
                                <td><div class="sp-value">₹17,500</div><div class="sp-value-sub">avg ₹2,500</div></td>
                                <td><span class="sp-heat sp-heat-warm"><i class="fa fa-circle" style="font-size:8px"></i> Warm</span></td>
                                <td><div class="sp-last-added">3 days ago<span>Georgette Anarkali Suit</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Sneha Patel','SP','#c0392b',7,'₹17,500')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Sneha Patel')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="deepak gupta" data-heat="warm">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#05</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#007a5e">DG</div><div><div class="sp-av-name">Deepak Gupta</div><div class="sp-av-email">deepak.g@outlook.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/d4ecd4/888?text=K" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/c4dcc4/888?text=S" alt=""></div><div class="sp-thumb-more">+4</div></div></td>
                                <td class="center"><span class="sp-count-badge">6</span></td>
                                <td><div class="sp-value">₹15,900</div><div class="sp-value-sub">avg ₹2,650</div></td>
                                <td><span class="sp-heat sp-heat-warm"><i class="fa fa-circle" style="font-size:8px"></i> Warm</span></td>
                                <td><div class="sp-last-added">4 days ago<span>Zardozi Embroidered Saree</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Deepak Gupta','DG','#007a5e',6,'₹15,900')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Deepak Gupta')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="meera agarwal" data-heat="warm">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#06</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#2980b9">MA</div><div><div class="sp-av-name">Meera Agarwal</div><div class="sp-av-email">meera.a@gmail.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/d4e8f8/888?text=D" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/c4d8e8/888?text=K" alt=""></div><div class="sp-thumb-more">+2</div></div></td>
                                <td class="center"><span class="sp-count-badge">4</span></td>
                                <td><div class="sp-value">₹9,800</div><div class="sp-value-sub">avg ₹2,450</div></td>
                                <td><span class="sp-heat sp-heat-warm"><i class="fa fa-circle" style="font-size:8px"></i> Warm</span></td>
                                <td><div class="sp-last-added">5 days ago<span>Lucknowi Kurti (Blue, M)</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Meera Agarwal','MA','#2980b9',4,'₹9,800')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Meera Agarwal')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="kiran malhotra" data-heat="cool">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#07</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#916a00">KM</div><div><div class="sp-av-name">Kiran Malhotra</div><div class="sp-av-email">kiran.m@gmail.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/f8ecd4/888?text=S" alt=""></div><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/f0dcc4/888?text=K" alt=""></div><div class="sp-thumb-more">+1</div></div></td>
                                <td class="center"><span class="sp-count-badge">3</span></td>
                                <td><div class="sp-value">₹7,200</div><div class="sp-value-sub">avg ₹2,400</div></td>
                                <td><span class="sp-heat sp-heat-cool"><i class="fa fa-snowflake" style="font-size:9px"></i> Cool</span></td>
                                <td><div class="sp-last-added">1 week ago<span>Mukaish Work Kurta</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Kiran Malhotra','KM','#916a00',3,'₹7,200')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Kiran Malhotra')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="vikram singh" data-heat="cool">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#08</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#7f8c8d">VS</div><div><div class="sp-av-name">Vikram Singh</div><div class="sp-av-email">vikram.s@rediffmail.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/e8e8e8/888?text=K" alt=""></div><div class="sp-thumb-more">+1</div></div></td>
                                <td class="center"><span class="sp-count-badge">2</span></td>
                                <td><div class="sp-value">₹4,800</div><div class="sp-value-sub">avg ₹2,400</div></td>
                                <td><span class="sp-heat sp-heat-cool"><i class="fa fa-snowflake" style="font-size:9px"></i> Cool</span></td>
                                <td><div class="sp-last-added">10 days ago<span>Chikankari Kurta (White)</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Vikram Singh','VS','#7f8c8d',2,'₹4,800')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Vikram Singh')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                            <tr data-name="nisha joshi" data-heat="cool">
                                <td><span style="font-size:11.5px;font-weight:600;color:var(--text-hint);font-family:'SF Mono',monospace">#09</span></td>
                                <td><div class="sp-av-wrap"><div class="sp-av" style="background:#e67e22">NJ</div><div><div class="sp-av-name">Nisha Joshi</div><div class="sp-av-email">nisha.j@gmail.com</div></div></div></td>
                                <td><div class="sp-thumb-strip"><div class="sp-thumb"><img src="https://via.placeholder.com/36x36/fce4d4/888?text=S" alt=""></div></div></td>
                                <td class="center"><span class="sp-count-badge">1</span></td>
                                <td><div class="sp-value">₹2,950</div><div class="sp-value-sub">avg ₹2,950</div></td>
                                <td><span class="sp-heat sp-heat-cool"><i class="fa fa-snowflake" style="font-size:9px"></i> Cool</span></td>
                                <td><div class="sp-last-added">2 weeks ago<span>Organza Saree (Pink)</span></div></td>
                                <td><div class="sp-actions"><a href="#" class="sp-act-btn view" title="View Wishlist" onclick="goToDetail('Nisha Joshi','NJ','#e67e22',1,'₹2,950')"><i class="fa fa-eye"></i></a><button class="sp-act-btn del" title="Clear Wishlist" onclick="clearWishlist('Nisha Joshi')"><i class="fa fa-trash"></i></button></div></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="sp-pag">
                    <span class="sp-pag-info">Showing 9 of 1,284 customers</span>
                    <div class="sp-pag-btns">
                        <button class="sp-pag-btn" disabled><i class="fa fa-chevron-left"></i></button>
                        <button class="sp-pag-btn active">1</button>
                        <button class="sp-pag-btn">2</button>
                        <button class="sp-pag-btn">3</button>
                        <button class="sp-pag-btn">…</button>
                        <button class="sp-pag-btn">143</button>
                        <button class="sp-pag-btn"><i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@include('admin.footer')
<script>
function filterTable(v) {
    v = v.toLowerCase();
    let c = 0;
    document.querySelectorAll('#wlTbody tr').forEach(r => {
        const show = r.dataset.name.includes(v);
        r.style.display = show ? '' : 'none';
        if (show) c++;
    });
    document.getElementById('rowCount').textContent = c;
}
function filterHeat(v) {
    let c = 0;
    document.querySelectorAll('#wlTbody tr').forEach(r => {
        const show = !v || r.dataset.heat === v;
        r.style.display = show ? '' : 'none';
        if (show) c++;
    });
    document.getElementById('rowCount').textContent = c;
}
function clearWishlist(name) {
    Swal.fire({ title:'Clear wishlist for '+name+'?', text:'All '+name+"'s saved items will be removed.", icon:'warning', showCancelButton:true, confirmButtonColor:'#c0392b', cancelButtonColor:'#6d7175', confirmButtonText:'Yes, Clear' })
    .then(r => { if(r.isConfirmed) Swal.fire({icon:'success',title:'Cleared!',timer:1500,showConfirmButton:false}); });
}
function goToDetail(name,ini,color,count,value) {
    sessionStorage.setItem('wl_name',name);
    sessionStorage.setItem('wl_ini',ini);
    sessionStorage.setItem('wl_color',color);
    sessionStorage.setItem('wl_count',count);
    sessionStorage.setItem('wl_value',value);
    alert('Navigate to: wishlist/detail.blade.php\nCustomer: '+name+' — '+count+' items, '+value);
}
</script>