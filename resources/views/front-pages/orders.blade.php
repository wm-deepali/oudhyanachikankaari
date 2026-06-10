@extends('layouts.user-app')
@section('content')

  <div class="aq-modern-content aq-orders-page">
                    <div class="aq-page-header">
                        <h2>My Orders & Payments</h2>
                        <p>View your order history, track deliveries, and download invoices.</p>
                    </div>

                    <div class="aq-order-tabs">
                        <button class="active" onclick="filterOrders('all', this)">All Orders</button>
                        <button onclick="filterOrders('processing', this)">Processing (1)</button>
                        <button onclick="filterOrders('delivered', this)">Completed (1)</button>
                        <button onclick="filterOrders('cancelled', this)">Cancelled (0)</button>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Order 1 -->
                            <div class="aq-order-card" data-status="processing">
                                <div class="aq-order-header">
                                    <div>
                                        <span class="aq-order-id">#ORD-8924</span>
                                        <span class="aq-order-date">Placed on May 22, 2026</span>
                                    </div>
                                    <span class="aq-order-status status-processing">Processing</span>
                                </div>

                                <!-- Creative Tracker -->
                                <div class="aq-order-tracker">
                                    <div class="aq-order-tracker-step completed">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-check"></i></div>
                                        <span class="aq-order-tracker-label">Order Placed</span>
                                    </div>
                                    <div class="aq-order-tracker-step active">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-box-open"></i></div>
                                        <span class="aq-order-tracker-label">Processing</span>
                                    </div>
                                    <div class="aq-order-tracker-step">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-truck-fast"></i></div>
                                        <span class="aq-order-tracker-label">Shipped</span>
                                    </div>
                                    <div class="aq-order-tracker-step">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-house"></i></div>
                                        <span class="aq-order-tracker-label">Delivered</span>
                                    </div>
                                </div>

                                <div class="aq-order-items">
                                    <div class="aq-order-item">
                                        <img src="{{ asset('assets/img/corporate/gallery_unstitched_suit.png')}}" alt="Suit">
                                        <div class="aq-order-item-details">
                                            <h4>Premium Unstitched Chikankari Suit</h4>
                                            <p>Color: Blush Pink | Qty: 1</p>
                                        </div>
                                        <div class="aq-order-item-price">₹ 8,990</div>
                                    </div>
                                </div>
                                <div class="aq-order-footer">
                                    <div class="aq-order-payment-info">
                                        <div class="aq-payment-method">
                                            <i class="fa-brands fa-cc-visa"></i> Visa ending in 4242
                                        </div>
                                        <span class="aq-order-total-price">Total: ₹ 8,990</span>
                                    </div>
                                    <div class="aq-order-actions">
                                        <a href="#" class="aq-btn-invoice"><i class="fa-solid fa-file-invoice"></i>
                                            Download Invoice</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#trackOrderModal"
                                            class="aq-btn-track"><i class="fa-solid fa-location-crosshairs"></i> Track
                                            Order</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 2 -->
                            <div class="aq-order-card" data-status="delivered">
                                <div class="aq-order-header">
                                    <div>
                                        <span class="aq-order-id">#ORD-8923</span>
                                        <span class="aq-order-date">Placed on May 15, 2026</span>
                                    </div>
                                    <span class="aq-order-status status-delivered">Delivered</span>
                                </div>

                                <!-- Creative Tracker -->
                                <div class="aq-order-tracker">
                                    <div class="aq-order-tracker-step completed">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-check"></i></div>
                                        <span class="aq-order-tracker-label">Order Placed</span>
                                    </div>
                                    <div class="aq-order-tracker-step completed">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-box-open"></i></div>
                                        <span class="aq-order-tracker-label">Processing</span>
                                    </div>
                                    <div class="aq-order-tracker-step completed">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-truck-fast"></i></div>
                                        <span class="aq-order-tracker-label">Shipped</span>
                                    </div>
                                    <div class="aq-order-tracker-step completed">
                                        <div class="aq-order-tracker-icon"><i class="fa-solid fa-house"></i></div>
                                        <span class="aq-order-tracker-label">Delivered</span>
                                    </div>
                                </div>

                                <div class="aq-order-items">
                                    <div class="aq-order-item">
                                        <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png')}}" alt="Dupatta">
                                        <div class="aq-order-item-details">
                                            <h4>Meher Pure Silk Dupatta</h4>
                                            <p>Color: Ivory White | Qty: 1</p>
                                        </div>
                                        <div class="aq-order-item-price">₹ 5,500</div>
                                    </div>
                                    <div class="aq-order-item">
                                        <img src="{{ asset('assets/img/corporate/roohani_organza_saree.png')}}" alt="Saree">
                                        <div class="aq-order-item-details">
                                            <h4>Roohani Organza Saree</h4>
                                            <p>Color: Mint Green | Qty: 1</p>
                                        </div>
                                        <div class="aq-order-item-price">₹ 9,000</div>
                                    </div>
                                </div>
                                <div class="aq-order-footer">
                                    <div class="aq-order-payment-info">
                                        <div class="aq-payment-method">
                                            <i class="fa-solid fa-building-columns"></i> UPI / NetBanking
                                        </div>
                                        <span class="aq-order-total-price">Total: ₹ 14,500</span>
                                    </div>
                                    <div class="aq-order-actions">
                                        <a href="#" class="aq-btn-invoice"><i class="fa-solid fa-file-invoice"></i>
                                            Download Invoice</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#returnModal"
                                            class="aq-btn-invoice"><i class="fa-solid fa-arrow-rotate-left"></i> Return
                                            / Exchange</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Order 3 (Cancelled) -->
                            <div class="aq-order-card" data-status="cancelled">
                                <div class="aq-order-header">
                                    <div>
                                        <span class="aq-order-id">#ORD-8922</span>
                                        <span class="aq-order-date">Placed on May 10, 2026</span>
                                    </div>
                                    <span class="aq-order-status status-cancelled"
                                        style="background: rgba(255, 71, 87, 0.1); color: #ff4757; padding: 5px 12px; border-radius: 20px; font-weight: 600; font-size: 13px;">Cancelled</span>
                                </div>

                                <div class="aq-order-items">
                                    <div class="aq-order-item">
                                        <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png')}}" alt="Anarkali">
                                        <div class="aq-order-item-details">
                                            <h4>Floral Hand-Embroidered Anarkali</h4>
                                            <p>Color: Pastel Green | Qty: 1</p>
                                        </div>
                                        <div class="aq-order-item-price">₹ 12,500</div>
                                    </div>
                                </div>

                                <div class="aq-order-footer">
                                    <div class="aq-order-payment-info">
                                        <div class="aq-payment-method text-danger" style="font-weight: 500;">
                                            <i class="fa-solid fa-money-bill-transfer"></i> Refund Initiated (3-5 days)
                                        </div>
                                        <span class="aq-order-total-price">Total: ₹ 12,500</span>
                                    </div>
                                    <div class="aq-order-actions">
                                        <a href="#" class="aq-btn-invoice"
                                            style="opacity: 0.6; cursor: not-allowed; pointer-events: none;"><i
                                                class="fa-solid fa-file-invoice"></i> No Invoice</a>
                                        <a href="#" class="aq-btn-invoice"><i class="fa-solid fa-cart-shopping"></i>
                                            Reorder</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                 <!-- Track Order Modal -->
    <div class="modal fade aq-premium-modal track-order-modal" id="trackOrderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute" style="top: 20px; right: 20px; z-index: 10;"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="p-4">
                    <h3 class="font-family-heading mb-2">Track Your Order</h3>
                    <p class="text-muted mb-4">Order #ORD-8924 • Handled by Bluedart</p>

                    <div class="aq-order-tracker"
                        style="flex-direction: column; align-items: flex-start; gap: 20px; padding-left: 20px; margin: 20px 0;">
                        <!-- Using inline styles to override the horizontal tracker for the modal -->
                        <div class="aq-order-tracker-step completed"
                            style="flex-direction: row; gap: 15px; padding: 0;">
                            <div class="aq-order-tracker-icon" style="width: 35px; height: 35px; min-width: 35px;"><i
                                    class="fa-solid fa-check"></i></div>
                            <div>
                                <span class="aq-order-tracker-label d-block text-dark">Order Placed</span>
                                <small class="text-muted">May 22, 2026, 10:30 AM</small>
                            </div>
                        </div>
                        <div class="aq-order-tracker-step completed"
                            style="flex-direction: row; gap: 15px; padding: 0;">
                            <div class="aq-order-tracker-icon" style="width: 35px; height: 35px; min-width: 35px;"><i
                                    class="fa-solid fa-box-open"></i></div>
                            <div>
                                <span class="aq-order-tracker-label d-block text-dark">Processing</span>
                                <small class="text-muted">May 23, 2026, 09:15 AM - Quality Check</small>
                            </div>
                        </div>
                        <div class="aq-order-tracker-step active" style="flex-direction: row; gap: 15px; padding: 0;">
                            <div class="aq-order-tracker-icon" style="width: 35px; height: 35px; min-width: 35px;"><i
                                    class="fa-solid fa-truck-fast"></i></div>
                            <div>
                                <span class="aq-order-tracker-label d-block text-dark">Out for Delivery</span>
                                <small class="text-muted">Expected Today by 7:00 PM</small>
                            </div>
                        </div>
                        <div class="aq-order-tracker-step" style="flex-direction: row; gap: 15px; padding: 0;">
                            <div class="aq-order-tracker-icon" style="width: 35px; height: 35px; min-width: 35px;"><i
                                    class="fa-solid fa-house"></i></div>
                            <div>
                                <span class="aq-order-tracker-label d-block text-muted">Delivered</span>
                                <small class="text-muted">Pending</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Return / Exchange Modal -->
    <div class="modal fade aq-premium-modal return-modal" id="returnModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute" style="top: 20px; right: 20px; z-index: 10;"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="p-4">
                    <h3 class="font-family-heading mb-2">Return or Exchange</h3>
                    <p class="text-muted mb-4">Request a return for Order #ORD-8923.</p>

                    <form
                        onsubmit="event.preventDefault(); alert('Return Request Submitted Successfully!'); $('#returnModal').modal('hide');">
                        <div class="mb-3">
                            <label class="aq-form-label">Select Item *</label>
                            <select class="form-select" required>
                                <option value="" disabled selected>Select an item to return</option>
                                <option value="1">Meher Pure Silk Dupatta</option>
                                <option value="2">Roohani Organza Saree</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="aq-form-label">Reason for Return *</label>
                            <select class="form-select" required>
                                <option value="" disabled selected>Select a reason</option>
                                <option value="size">Size didn't fit</option>
                                <option value="color">Color is different than expected</option>
                                <option value="defective">Item is defective/damaged</option>
                                <option value="other">Other reason</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="aq-form-label">Additional Details</label>
                            <textarea class="form-control" rows="3"
                                placeholder="Please provide any additional information..."></textarea>
                        </div>
                        <button type="submit" class="aq-btn-submit w-100"
                            style="margin-top: 10px; background: var(--aq-color-maroon); color: #fff; padding: 12px; border: none; border-radius: 8px;">Submit
                            Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection