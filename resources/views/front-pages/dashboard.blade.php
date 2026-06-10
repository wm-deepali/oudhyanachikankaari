@extends('layouts.user-app')
@section('content')

    <div class="aq-modern-content">
        <div class="aq-dashboard-header">
            <h2>Welcome back, {{ Auth::guard('customer')->user()->name }}</h2>
            <p>Here is what's happening with your luxury curations today.</p>
        </div>

        <!-- Stats -->
        <div class="aq-modern-stats">
            <div class="aq-stat-card">
                <div class="aq-stat-icon" style="background: rgba(201,143,157,0.15); color: #c98f9d;">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="aq-stat-details">
                    <p>Total Orders</p>
                    <h3>12</h3>
                </div>
            </div>
            <div class="aq-stat-card">
                <div class="aq-stat-icon" style="background: rgba(243, 156, 18, 0.15); color: #f39c12;">
                    <i class="fa-solid fa-star"></i>
                </div>
                <div class="aq-stat-details">
                    <p>Reward Points</p>
                    <h3>1,250</h3>
                </div>
            </div>
            <div class="aq-stat-card">
                <div class="aq-stat-icon" style="background: rgba(46, 204, 113, 0.15); color: #2ecc71;">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div class="aq-stat-details">
                    <p>Wallet Balance</p>
                    <h3>â‚¹ 4,500</h3>
                </div>
            </div>
            <div class="aq-stat-card">
                <div class="aq-stat-icon" style="background: rgba(155, 89, 182, 0.15); color: #9b59b6;">
                    <i class="fa-regular fa-heart"></i>
                </div>
                <div class="aq-stat-details">
                    <p>Wishlist</p>
                    <h3>8 Items</h3>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Recent Orders -->
            <div class="col-xl-12 col-lg-12">
                <div class="aq-modern-card">
                    <div class="aq-card-header">
                        <h3>Recent Orders</h3>
                        <a href="#" class="aq-btn-link">View All <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="aq-card-body p-0">
                        <div class="table-responsive">
                            <table class="aq-modern-table" style="min-width: 600px;">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>#ORD-8923</strong></td>
                                        <td>May 15, 2026</td>
                                        <td>
                                            <div class="aq-order-items-imgs">
                                                <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png') }}"
                                                    alt="">
                                                <img src="{{ asset('assets/img/corporate/roohani_organza_saree.png') }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td><strong>₹ 14,500</strong></td>
                                        <td><span class="aq-badge aq-badge-success">Delivered</span></td>
                                        <td><button class="aq-btn-icon-only"><i
                                                    class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td><strong>#ORD-8924</strong></td>
                                        <td>May 22, 2026</td>
                                        <td>
                                            <div class="aq-order-items-imgs">
                                                <img src="{{ asset('assets/img/corporate/gallery_unstitched_suit.png') }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td><strong>₹ 8,990</strong></td>
                                        <td><span class="aq-badge aq-badge-warning">Processing</span></td>
                                        <td><button class="aq-btn-icon-only"><i
                                                    class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                    </tr>
                                    <tr>
                                        <td><strong>#ORD-8925</strong></td>
                                        <td>May 28, 2026</td>
                                        <td>
                                            <div class="aq-order-items-imgs">
                                                <img src="{{ asset('assets/img/corporate/ziba_chanderi_gown.png') }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td><strong>₹ 22,400</strong></td>
                                        <td><span class="aq-badge aq-badge-info">Shipped</span></td>
                                        <td><button class="aq-btn-icon-only"><i
                                                    class="fa-solid fa-ellipsis-vertical"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection