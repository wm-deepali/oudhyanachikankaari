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
        --purple: #6d28d9;
        --purple-bg: #ede9fe;
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .order-detail-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .order-detail-page * { box-sizing: border-box; }
    /* ── Page header ────────────────────────────────────────── */
    .page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 14px; margin-bottom: 20px; }
    .page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; display: flex; align-items: center; gap: 10px; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }
    /* ── Buttons ────────────────────────────────────────────── */
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
        text-decoration: none !important; font-family: var(--font); transition: background .15s;
        box-shadow: 0 1px 2px rgba(0,0,0,.04);
    }
    .btn-secondary-dash:hover { background: var(--bg); }
    .btn-danger-dash {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--red-bg); color: var(--red) !important; border: 1px solid #f5c6c6;
        border-radius: var(--radius-sm); padding: 8px 16px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        text-decoration: none !important; font-family: var(--font); transition: all .15s;
    }
    .btn-danger-dash:hover { background: var(--red); color: #fff !important; border-color: var(--red); }
    /* ── Layout ─────────────────────────────────────────────── */
    .detail-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }
    @media(max-width:960px) { .detail-layout { grid-template-columns: 1fr; } }
    /* ── Section card ───────────────────────────────────────── */
    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: center; justify-content: space-between; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .section-card-body { padding: 20px; }
    /* ── Order status pills ─────────────────────────────────── */
    .order-pill { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
    .order-pill i { font-size: 10px; }
    .order-new { background: var(--blue-bg); color: var(--blue); }
    .order-processing { background: var(--amber-bg); color: var(--amber); }
    .order-shipped { background: var(--purple-bg); color: var(--purple); }
    .order-delivered { background: var(--green-bg); color: var(--green); }
    .order-cancelled { background: var(--red-bg); color: var(--red); }
    .pay-pill { display: inline-flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 20px; }
    .pay-paid { background: var(--green-bg); color: var(--green); }
    .pay-pending { background: var(--amber-bg); color: var(--amber); }
    .pay-failed { background: var(--red-bg); color: var(--red); }
    .pay-refunded { background: var(--purple-bg); color: var(--purple); }
    /* ── Order items table ──────────────────────────────────── */
    .items-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .items-table thead th { font-size: 11px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; color: var(--text-hint); padding: 10px 16px; border-bottom: 1px solid var(--border); background: #fafafa; text-align: left; }
    .items-table tbody tr { border-bottom: 1px solid var(--border); }
    .items-table tbody tr:last-child { border-bottom: none; }
    .items-table tbody tr:hover { background: #fafbfc; }
    .items-table tbody td { padding: 14px 16px; vertical-align: middle; }
    .items-table tfoot td { padding: 10px 16px; border-top: 1px solid var(--border); font-size: 13px; }
    .product-thumb { width: 52px; height: 52px; border-radius: var(--radius-sm); object-fit: cover; border: 1px solid var(--border); flex-shrink: 0; }
    .product-thumb-placeholder { width: 52px; height: 52px; border-radius: var(--radius-sm); background: var(--bg); border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; color: var(--text-hint); font-size: 18px; flex-shrink: 0; }
    .product-name-cell { font-weight: 600; color: var(--text-primary); font-size: 13px; }
    .product-variant { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }
    .product-sku { font-size: 11px; color: var(--text-hint); font-family: 'SF Mono','Fira Code',monospace; margin-top: 2px; }
    .qty-chip { display: inline-flex; align-items: center; justify-content: center; background: var(--bg); color: var(--text-secondary); font-size: 12px; font-weight: 700; padding: 2px 10px; border-radius: 6px; }
    .price-cell { font-size: 13.5px; font-weight: 600; color: var(--text-primary); }
    .subtotal-cell { font-size: 13.5px; font-weight: 700; color: var(--text-primary); }
    /* ── Price summary ──────────────────────────────────────── */
    .price-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid var(--bg); font-size: 13px; }
    .price-row:last-child { border-bottom: none; }
    .price-row .label { color: var(--text-secondary); }
    .price-row .value { font-weight: 600; color: var(--text-primary); }
    .price-row.total { padding-top: 12px; border-top: 2px solid var(--border); border-bottom: none; margin-top: 4px; }
    .price-row.total .label { font-size: 14px; font-weight: 650; color: var(--text-primary); }
    .price-row.total .value { font-size: 18px; font-weight: 700; color: var(--text-primary); }
    .price-row.discount .value { color: var(--green); }
    /* ── Info rows ──────────────────────────────────────────── */
    .info-row { display: flex; justify-content: space-between; align-items: flex-start; padding: 9px 0; border-bottom: 1px solid var(--bg); font-size: 13px; gap: 12px; }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .info-row:first-child { padding-top: 0; }
    .info-row .info-label { color: var(--text-hint); font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .03em; flex-shrink: 0; }
    .info-row .info-value { font-weight: 500; color: var(--text-primary); text-align: right; }
    /* ── Customer card ──────────────────────────────────────── */
    .customer-block { display: flex; align-items: center; gap: 14px; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid var(--border); }
    .customer-avatar-lg { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700; flex-shrink: 0; }
    .customer-name-lg { font-size: 14px; font-weight: 650; color: var(--text-primary); }
    .customer-email-sm { font-size: 12px; color: var(--text-hint); margin-top: 2px; }
    .customer-phone-sm { font-size: 12px; color: var(--text-hint); margin-top: 1px; }
    /* ── Address block ──────────────────────────────────────── */
    .address-block { font-size: 13px; color: var(--text-secondary); line-height: 1.7; }
    .address-block strong { color: var(--text-primary); font-weight: 600; display: block; margin-bottom: 3px; }
    /* ── Timeline ───────────────────────────────────────────── */
    .timeline { position: relative; padding-left: 24px; }
    .timeline::before { content:''; position: absolute; left: 7px; top: 6px; bottom: 6px; width: 2px; background: var(--border); border-radius: 2px; }
    .timeline-item { position: relative; margin-bottom: 18px; }
    .timeline-item:last-child { margin-bottom: 0; }
    .timeline-dot { position: absolute; left: -21px; top: 3px; width: 12px; height: 12px; border-radius: 50%; border: 2px solid var(--surface); flex-shrink: 0; }
    .timeline-dot.active { background: var(--accent); box-shadow: 0 0 0 3px var(--accent-light); }
    .timeline-dot.done { background: var(--green); }
    .timeline-dot.pending { background: var(--border); }
    .timeline-title { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .timeline-time { font-size: 11.5px; color: var(--text-hint); margin-top: 2px; }
    .timeline-desc { font-size: 12px; color: var(--text-secondary); margin-top: 3px; }
    /* ── Status update select ───────────────────────────────── */
    .field-select-full {
        flex: 1; height: 38px; border: 1px solid var(--border); border-radius: var(--radius-sm);
        padding: 0 12px; font-size: 13px; color: var(--text-primary); background: var(--surface);
        outline: none; font-family: var(--font); transition: border-color .15s, box-shadow .15s;
    }
    .field-select-full:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    /* ── Notes textarea ─────────────────────────────────────── */
    .field-textarea { width: 100%; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 10px 12px; font-size: 13px; color: var(--text-primary); background: var(--surface); outline: none; resize: vertical; min-height: 80px; font-family: var(--font); transition: border-color .15s, box-shadow .15s; }
    .field-textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    @media print { .no-print { display: none !important; } }
    @media(max-width:768px) { .order-detail-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="order-detail-page">
            <!-- Page header -->
            <div class="page-header no-print">
                <div>
                    <h1>
                        Order
                        <span style="font-family:'SF Mono','Fira Code',monospace;color:var(--accent);font-size:18px">#ORD-78492</span>
                    </h1>
                    <div class="crumb">
                        <a href="#">Dashboard</a>
                        <span>›</span>
                        <a href="#">Orders</a>
                        <span>›</span>
                        Order Detail
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center">
                    <span class="pay-pill pay-paid">Paid</span>
                    <span class="order-pill order-delivered">Delivered</span>
                    <a href="#" target="_blank" class="btn-secondary-dash">
                        <i class="fa fa-file-pdf-o"></i> Invoice
                    </a>
                    <a href="#" class="btn-secondary-dash">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <div class="detail-layout">
                <!-- LEFT COLUMN -->
                <div>
                    <!-- Order Items -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <h5>Order Items</h5>
                            <span style="font-size:12px;color:var(--text-hint)">3 item(s)</span>
                        </div>
                        <div style="overflow-x:auto">
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:12px">
                                                <img src="https://via.placeholder.com/52" class="product-thumb" alt="Product">
                                                <div>
                                                    <div class="product-name-cell">Wireless Headphones Pro</div>
                                                    <div class="product-variant">Color: Black • 256GB</div>
                                                    <div class="product-sku">SKU: WH-PRO-BLK</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="qty-chip">× 1</span></td>
                                        <td><span class="price-cell">₹2,499.00</span></td>
                                        <td><span class="subtotal-cell">₹2,499.00</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex;align-items:center;gap:12px">
                                                <div class="product-thumb-placeholder"><i class="fa fa-image"></i></div>
                                                <div>
                                                    <div class="product-name-cell">Cotton T-Shirt</div>
                                                    <div class="product-variant">Size: L • Color: Navy</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="qty-chip">× 2</span></td>
                                        <td><span class="price-cell">₹699.00</span></td>
                                        <td><span class="subtotal-cell">₹1,398.00</span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="text-align:right;color:var(--text-hint);font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.04em">Subtotal</td>
                                        <td><span class="subtotal-cell">₹3,897.00</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Price breakdown -->
                        <div style="padding:16px 20px;border-top:1px solid var(--border);background:#fafafa">
                            <div class="price-row">
                                <span class="label">Subtotal</span>
                                <span class="value">₹3,897.00</span>
                            </div>
                            <div class="price-row discount">
                                <span class="label">Discount (SUMMER15)</span>
                                <span class="value">− ₹300.00</span>
                            </div>
                            <div class="price-row">
                                <span class="label">Shipping</span>
                                <span class="value"><span style="color:var(--green);font-weight:600">Free</span></span>
                            </div>
                            <div class="price-row total">
                                <span class="label">Total</span>
                                <span class="value">₹3,597.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="section-card">
                        <div class="section-card-header"><h5>Payment Information</h5></div>
                        <div class="section-card-body" style="padding:16px 20px">
                            <div class="info-row">
                                <span class="info-label">Method</span>
                                <span class="info-value">UPI</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Status</span>
                                <span class="info-value"><span class="pay-pill pay-paid">Paid</span></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Transaction ID</span>
                                <span class="info-value" style="font-family:'SF Mono','Fira Code',monospace;font-size:12px">TXN-7849201</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Paid At</span>
                                <span class="info-value">10 Jun 2026, 02:45 PM</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Timeline -->
                    <div class="section-card">
                        <div class="section-card-header"><h5>Order Timeline</h5></div>
                        <div class="section-card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-dot done"></div>
                                    <div class="timeline-title">Order Placed</div>
                                    <div class="timeline-time">10 Jun 2026, 02:30 PM</div>
                                    <div class="timeline-desc">Customer placed the order successfully.</div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot done"></div>
                                    <div class="timeline-title">Order Confirmed &amp; Processing</div>
                                    <div class="timeline-time">10 Jun 2026, 03:15 PM</div>
                                    <div class="timeline-desc">Payment confirmed, order is being prepared.</div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot done"></div>
                                    <div class="timeline-title">Shipped</div>
                                    <div class="timeline-time">11 Jun 2026, 10:00 AM</div>
                                    <div class="timeline-desc">Package dispatched. Tracking: <strong>DTDC123456789</strong></div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-dot active"></div>
                                    <div class="timeline-title">Delivered</div>
                                    <div class="timeline-time">12 Jun 2026, 11:45 AM</div>
                                    <div class="timeline-desc">Order delivered to customer.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div>
                    <!-- Update Status -->
                    <div class="section-card no-print">
                        <div class="section-card-header"><h5>Update Status</h5></div>
                        <div class="section-card-body">
                            <div style="margin-bottom:12px">
                                <label style="font-size:12px;font-weight:600;color:var(--text-secondary);text-transform:uppercase;letter-spacing:.03em;display:block;margin-bottom:6px">Order Status</label>
                                <select class="field-select-full">
                                    <option value="new">New</option>
                                    <option value="processing">Processing</option>
                                    <option value="shipped" selected>Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div style="margin-bottom:14px">
                                <label style="font-size:12px;font-weight:600;color:var(--text-secondary);text-transform:uppercase;letter-spacing:.03em;display:block;margin-bottom:6px">Tracking Number</label>
                                <input type="text" class="field-select-full" value="DTDC123456789" placeholder="e.g. DTDC123456789">
                            </div>
                            <div style="margin-bottom:14px">
                                <label style="font-size:12px;font-weight:600;color:var(--text-secondary);text-transform:uppercase;letter-spacing:.03em;display:block;margin-bottom:6px">Note (optional)</label>
                                <textarea class="field-textarea" placeholder="Add a note for this status update…">Package delivered successfully.</textarea>
                            </div>
                            <button type="button" class="btn-primary-dash" style="width:100%;justify-content:center">
                                <i class="fa fa-refresh"></i> Update Status
                            </button>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="section-card">
                        <div class="section-card-header">
                            <h5>Customer</h5>
                            <a href="#" style="font-size:12px;color:var(--accent);text-decoration:none;font-weight:500">View Profile →</a>
                        </div>
                        <div class="section-card-body">
                            <div class="customer-block">
                                <div class="customer-avatar-lg" style="background:var(--accent-light);color:var(--accent)">SJ</div>
                                <div>
                                    <div class="customer-name-lg">Sarah Johnson</div>
                                    <div class="customer-email-sm">sarah.j@email.com</div>
                                    <div class="customer-phone-sm">+91 98765 43210</div>
                                </div>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Total Orders</span>
                                <span class="info-value">12</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Member Since</span>
                                <span class="info-value">Mar 2025</span>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="section-card">
                        <div class="section-card-header"><h5>Shipping Address</h5></div>
                        <div class="section-card-body">
                            <div class="address-block">
                                <strong>Sarah Johnson</strong>
                                123, Green Park Apartment<br>
                                Near Metro Station<br>
                                Lucknow, Uttar Pradesh<br>
                                226010<br>
                                India<br>
                                <span style="color:var(--text-hint);font-size:12px">📞 +91 98765 43210</span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Info -->
                    <div class="section-card">
                        <div class="section-card-header"><h5>Order Info</h5></div>
                        <div class="section-card-body" style="padding:14px 20px">
                            <div class="info-row">
                                <span class="info-label">Order ID</span>
                                <span class="info-value" style="font-family:'SF Mono','Fira Code',monospace;color:var(--accent);font-size:12px">#ORD-78492</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Placed On</span>
                                <span class="info-value">10 Jun 2026, 02:30 PM</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Channel</span>
                                <span class="info-value">Online Store</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Coupon</span>
                                <span class="info-value" style="font-family:'SF Mono','Fira Code',monospace;color:var(--green);font-size:12px">SUMMER15</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')