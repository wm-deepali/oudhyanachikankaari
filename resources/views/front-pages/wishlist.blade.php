@extends('layouts.user-app')
@section('content')

 <div class="aq-modern-content aq-wishlist-page">
                    <div class="aq-page-header">
                        <h2>My Wishlist</h2>
                        <p>View and manage the luxury pieces you've saved for later.</p>
                    </div>
                    
                    <!-- Wishlist Grid -->
                    <div class="aq-wishlist-grid">
                        <!-- Item 1 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/meher_silk_dupatta.png')}}" alt="Dupatta">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Silk Collection</span>
                                <h4>Meher Pure Silk Dupatta</h4>
                                <div class="aq-wishlist-price">₹ 5,500</div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/gallery_unstitched_suit.png')}}" alt="Suit">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Premium Craft</span>
                                <h4>Premium Unstitched Chikankari Suit</h4>
                                <div class="aq-wishlist-price">₹ 8,990</div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/roohani_organza_saree.png')}}" alt="Saree">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Organza</span>
                                <h4>Roohani Organza Saree</h4>
                                <div class="aq-wishlist-price">₹ 9,000</div>
                            </div>
                        </div>
                        <!-- Item 4 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/gallery_cotton_anarkali.png')}}" alt="Anarkali">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Anarkali Collection</span>
                                <h4>Floral Hand-Embroidered Anarkali</h4>
                                <div class="aq-wishlist-price">₹ 12,500</div>
                            </div>
                        </div>

                        <!-- Item 5 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/nafasat_warm_peach_chikankari.png')}}" alt="Chikankari">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Pastel Range</span>
                                <h4>Mint Green Kurta Set</h4>
                                <div class="aq-wishlist-price">₹ 6,500</div>
                            </div>
                        </div>

                        <!-- Item 6 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png')}}" alt="Lehenga">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Bridal Couture</span>
                                <h4>Bridal Chikankari Lehenga</h4>
                                <div class="aq-wishlist-price">₹ 85,000</div>
                            </div>
                        </div>

                        <!-- Item 7 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/gallery_palazzo_set.png')}}" alt="Palazzo">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Palazzo Sets</span>
                                <h4>Luxury Chikankari Palazzo Set</h4>
                                <div class="aq-wishlist-price">₹ 15,000</div>
                            </div>
                        </div>

                        <!-- Item 8 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/gallery_chikan_kurta.png')}}" alt="Kurta">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Essentials</span>
                                <h4>Classic Silk Kurta Set</h4>
                                <div class="aq-wishlist-price">₹ 5,200</div>
                            </div>
                        </div>

                        <!-- Item 9 -->
                        <div class="aq-wishlist-card">
                            <button class="aq-wishlist-remove"><i class="fa-solid fa-xmark"></i></button>
                            <div class="aq-wishlist-img-wrapper">
                                <img src="{{ asset('assets/img/corporate/gallery_unstitched_suit.png')}}" alt="Gown">
                                <div class="aq-wishlist-overlay">
                                    <button class="aq-btn-cart-overlay">Move to Cart</button>
                                </div>
                            </div>
                            <div class="aq-wishlist-info">
                                <span class="aq-wishlist-cat">Evening Wear</span>
                                <h4>Midnight Blue Evening Gown</h4>
                                <div class="aq-wishlist-price">₹ 21,000</div>
                            </div>
                        </div>
                    </div>

                </div>

@endsection