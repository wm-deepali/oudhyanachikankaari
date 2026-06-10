@extends('layouts.user-app')
@section('content')

<div class="aq-modern-content aq-notification-page">
                    <div class="aq-page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h2>Notifications</h2>
                            <p>Stay updated with your orders and exclusive offers.</p>
                        </div>
                        <button class="aq-btn-read-all"><i class="fa-solid fa-check-double"></i> Mark all as read</button>
                    </div>
                    
                    <div class="aq-notification-list">
                        <!-- Unread Notification 1: Order -->
                        <div class="aq-notification-card unread">
                            <div class="aq-notification-icon order-icon">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                            <div class="aq-notification-content">
                                <h4>Order Out for Delivery</h4>
                                <p>Your order #ORD-8924 is out for delivery and will reach you by today evening. Ensure someone is available to receive it.</p>
                                <span class="aq-notification-time">2 hours ago</span>
                            </div>
                            <div class="aq-unread-dot"></div>
                        </div>

                        <!-- Unread Notification 2: Offer -->
                        <div class="aq-notification-card unread">
                            <div class="aq-notification-icon offer-icon">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                            <div class="aq-notification-content">
                                <h4>Exclusive Festive Offer! ðŸŒ™</h4>
                                <p>Get 20% off on our new Velvet Chikankari Collection. Use code <strong>FESTIVE20</strong> at checkout. Valid till Sunday!</p>
                                <span class="aq-notification-time">5 hours ago</span>
                            </div>
                            <div class="aq-unread-dot"></div>
                        </div>

                        <!-- Unread Notification 3: Security -->
                        <div class="aq-notification-card unread">
                            <div class="aq-notification-icon security-icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div class="aq-notification-content">
                                <h4>New Login Detected</h4>
                                <p>We noticed a new login to your account from Chrome on Windows (Gurgaon, India). If this was you, you can ignore this alert.</p>
                                <span class="aq-notification-time">Yesterday, 10:30 AM</span>
                            </div>
                            <div class="aq-unread-dot"></div>
                        </div>

                        <!-- Read Notification 4: System -->
                        <div class="aq-notification-card">
                            <div class="aq-notification-icon system-icon">
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="aq-notification-content">
                                <h4>Welcome to Premium Tier!</h4>
                                <p>Congratulations! You've been upgraded to our Premium Member tier. Enjoy faster shipping and exclusive early access to our collections.</p>
                                <span class="aq-notification-time">May 20, 2026</span>
                            </div>
                        </div>

                        <!-- Read Notification 5: Order Delivered -->
                        <div class="aq-notification-card">
                            <div class="aq-notification-icon success-icon">
                                <i class="fa-solid fa-box-check"></i>
                            </div>
                            <div class="aq-notification-content">
                                <h4>Order Delivered Successfully</h4>
                                <p>Your order #ORD-8923 has been delivered. We hope you love your Chikankari pieces! Feel free to leave a review.</p>
                                <span class="aq-notification-time">May 17, 2026</span>
                            </div>
                        </div>
                    </div>

                </div>

                <script>
        // Simple script to mark all as read
        document.querySelector('.aq-btn-read-all').addEventListener('click', function() {
            const unreadCards = document.querySelectorAll('.aq-notification-card.unread');
            unreadCards.forEach(card => {
                card.classList.remove('unread');
                const dot = card.querySelector('.aq-unread-dot');
                if (dot) dot.remove();
            });
            // Update badge
            const badge = document.querySelector('.aq-sidebar-nav .active .badge');
            if (badge) badge.style.display = 'none';
        });
    </script>

@endsection