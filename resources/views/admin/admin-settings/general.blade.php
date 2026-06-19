<form action="{{ route('admin.settings.general.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="settings-layout">

        <!-- Section nav -->
        <div class="settings-sidenav">
            <span class="settings-sidenav-label">Sections</span>
            <a href="#gs-site" class="active"><i class="fa-solid fa-globe"></i> Site Identity</a>
            <a href="#gs-contact"><i class="fa-solid fa-phone"></i> Contact Info</a>
            <a href="#gs-footer">
                <i class="fa-solid fa-share-nodes"></i>
                Footer & Social
            </a>
            <a href="#gs-regional"><i class="fa-solid fa-map-pin"></i> Regional</a>
            <a href="#gs-security"><i class="fa-solid fa-shield"></i> Security</a>
            <a href="#gs-misc"><i class="fa-solid fa-toggle-on"></i> Features</a>
        </div>

        <!-- Content -->
        <div class="settings-content">

            <!-- Site Identity -->
            <div class="settings-section" id="gs-site">
                <div class="settings-section-title"><i class="fa-solid fa-globe"></i> Site Identity</div>
                <p class="settings-section-desc">Basic information about your store shown to customers and used across
                    the
                    admin panel.</p>

                <div class="form-grid">
                    <div class="field-group col-full">
                        <label class="field-label">Site / Store Name <span class="req">*</span></label>
                        <input type="text" name="site_name" class="field-input"
                            value="{{ old('site_name', $general?->site_name) }}" placeholder="Your store name">
                    </div>
                    <div class="field-group col-full">
                        <label class="field-label">Tagline</label>
                        <input type="text" name="tagline" class="field-input"
                            value="{{ old('tagline', $general?->tagline) }}"
                            placeholder="e.g. Authentic Lucknowi Chikankari">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Site Logo</label>
                        <div class="upload-area">
                            <input type="file" id="logo" name="logo" accept="image/*">
                            <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                            <div class="upload-label">Upload Logo</div>
                            <div class="upload-sub">PNG, SVG · recommended 200×60px</div>
                        </div>
                        @if(!empty($general->logo))

                            <div style="margin-top:15px;text-align:center">

                                <img src="{{ asset('storage/' . $general->logo) }}" alt="Logo" style="
                                                                            max-width:100%;
                                                                            max-height:120px;
                                                                            border-radius:8px;
                                                                            border:1px solid #ddd;
                                                                            padding:5px;
                                                                        ">

                            </div>

                        @endif

                        {{-- Preview --}}
                        <div id="logoPreview" style="display:none;margin-top:15px;text-align:center">

                            <img id="previewlogo" src="" alt="Preview" style="
                        width:120px;
                        border-radius:8px;
                        border:1px solid #ddd;
                    ">

                            <div style="margin-top:8px">

                                <button type="button" onclick="clearImage()" style="
                            font-size:12px;
                            color:#b22222;
                            background:none;
                            border:none;
                            cursor:pointer;
                            padding:0;
                        ">

                                    <i class="fa fa-times"></i>
                                    Remove

                                </button>

                            </div>

                        </div>

                    </div>
                    <div class="field-group">
                        <label class="field-label">Favicon</label>
                        <div class="upload-area">
                            <input type="file" id="favicon" name="favicon" accept="image/*">
                            <div class="upload-icon"><i class="fa fa-image"></i></div>
                            <div class="upload-label">Upload Favicon</div>
                            <div class="upload-sub">ICO, PNG · 32×32px</div>
                        </div>
                        @if(!empty($general->favicon))

                            <div style="margin-top:15px;text-align:center">

                                <img src="{{ asset('storage/' . $general->favicon) }}" alt="Favicon" style="
                                                                            max-width:100%;
                                                                            max-height:120px;
                                                                            border-radius:8px;
                                                                            border:1px solid #ddd;
                                                                            padding:5px;
                                                                        ">

                            </div>

                        @endif

                        {{-- Preview --}}
                        <div id="faviconPreview" style="display:none;margin-top:15px;text-align:center">

                            <img id="previewFavicon" src="" alt="Preview" style="
                        width:120px;
                        border-radius:8px;
                        border:1px solid #ddd;
                    ">

                            <div style="margin-top:8px">

                                <button type="button" onclick="clearImage()" style="
                            font-size:12px;
                            color:#b22222;
                            background:none;
                            border:none;
                            cursor:pointer;
                            padding:0;
                        ">

                                    <i class="fa fa-times"></i>
                                    Remove

                                </button>

                            </div>

                        </div>

                    </div>
                    <div class="field-group col-full">
                        <label class="field-label">Admin Email</label>
                        <input type="email" name="admin_email" class="field-input"
                            value="{{ old('admin_email', $general?->admin_email) }}">
                        <span class="field-hint">Used for system notifications and order alerts.</span>
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Contact Info -->
            <div class="settings-section" id="gs-contact">
                <div class="settings-section-title"><i class="fa-solid fa-phone"></i> Contact Info</div>
                <p class="settings-section-desc">Displayed on invoices, emails, and the storefront footer.</p>

                <div class="form-grid">
                    <div class="field-group">
                        <label class="field-label">Phone Number</label>
                        <input type="text" name="phone" class="field-input" value="{{ old('phone', $general?->phone) }}"
                            placeholder="+91 98765 43210">
                    </div>
                    <div class="field-group">
                        <label class="field-label">WhatsApp Number</label>
                        <input type="text" name="whatsapp" class="field-input"
                            value="{{ old('whatsapp', $general?->whatsapp) }}" placeholder="+91 98765 43210">
                    </div>
                    <div class="field-group col-full">
                        <label class="field-label">Support Email</label>
                        <input type="email" name="support_email" class="field-input"
                            value="{{ old('support_email', $general?->support_email) }}">

                    </div>
                    <div class="field-group col-full">
                        <label class="field-label">Business Address</label>
                        <textarea name="business_address" class="field-textarea"
                            rows="3">{{ old('business_address', $general?->business_address) }}</textarea>
                    </div>
                </div>
            </div>


            <hr class="section-divider">

            <div class="settings-section" id="gs-footer">
                <div class="settings-section-title">
                    <i class="fa-solid fa-share-nodes"></i>
                    Footer & Social Media
                </div>

                <p class="settings-section-desc">
                    Footer description and social media links displayed across the website.
                </p>

                <div class="form-grid">

                    <div class="field-group col-full">
                        <label class="field-label">Footer Description</label>
                        <textarea name="footer_description" class="field-textarea"
                            rows="4">{{ old('footer_description', $general?->footer_description) }}</textarea>
                        <span class="field-hint">
                            Displayed in the website footer.
                        </span>
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            <i class="fab fa-facebook"></i> Facebook URL
                        </label>
                        <input type="url" name="facebook" class="field-input"
                            value="{{ old('facebook', $general?->facebook) }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            <i class="fab fa-instagram"></i> Instagram URL
                        </label>
                        <input type="url" name="instagram" class="field-input"
                            value="{{ old('instagram', $general?->instagram) }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            <i class="fab fa-twitter"></i> Twitter / X URL
                        </label>
                        <input type="url" name="twitter" class="field-input"
                            value="{{ old('twitter', $general?->twitter) }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            <i class="fab fa-linkedin"></i> LinkedIn URL
                        </label>
                        <input type="url" name="linkedin" class="field-input"
                            value="{{ old('linkedin', $general?->linkedin) }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            <i class="fab fa-youtube"></i> YouTube URL
                        </label>
                        <input type="url" name="youtube" class="field-input"
                            value="{{ old('youtube', $general?->youtube) }}">
                    </div>

                    <div class="field-group">
                        <label class="field-label">
                            <i class="fab fa-pinterest"></i> Pinterest URL
                        </label>
                        <input type="url" name="pinterest" class="field-input"
                            value="{{ old('pinterest', $general?->pinterest) }}">
                    </div>

                </div>
            </div>

            <hr class="section-divider">


            <!-- Regional -->
            <div class="settings-section" id="gs-regional">
                <div class="settings-section-title"><i class="fa-solid fa-map-pin"></i> Regional Settings</div>
                <p class="settings-section-desc">Currency, timezone and date format used across the panel and
                    storefront.
                </p>

                <div class="form-grid">
                    <div class="field-group">
                        <label class="field-label">Currency</label>
                        <input type="text" name="currency" class="field-input"
                            value="{{ old('currency', $general?->currency ?? 'INR') }}" readonly>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Currency Symbol</label>
                        <input type="text" name="currency_symbol" class="field-input"
                            value="{{ old('currency_symbol', $general?->currency_symbol ?? '₹') }}" readonly>

                    </div>
                    <div class="field-group">
                        <label class="field-label">Timezone</label>
                        <input type="text" name="timezone" class="field-input"
                            value="{{ old('timezone', $general?->timezone ?? 'Asia/Kolkata') }}" readonly>
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Security -->
            <div class="settings-section" id="gs-security">
                <div class="settings-section-title"><i class="fa-solid fa-shield"></i> Security</div>
                <p class="settings-section-desc">Control admin panel access and session behaviour.</p>

                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Maintenance Mode</div>
                        <div class="toggle-info-sub">Take the storefront offline for visitors while you work.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="maintenance_mode" {{ old('maintenance_mode', $general?->maintenance_mode) ? 'checked' : '' }}><span
                            class="toggle-track"></span></label>
                </div>
                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Admin Session Timeout</div>
                        <div class="toggle-info-sub">Auto-logout after inactivity (minutes).</div>
                    </div>
                    <div style="display:flex;align-items:center;gap:8px">
                        <input type="number" class="field-input" name="admin_session_timeout"
                            value="{{ old('admin_session_timeout', $general?->admin_session_timeout ?? 60) }}"
                            style="width:80px;height:32px;font-size:13px">
                        <span style="font-size:12.5px;color:var(--text-hint)">min</span>
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Feature Toggles -->
            <div class="settings-section" id="gs-misc">
                <div class="settings-section-title"><i class="fa-solid fa-toggle-on"></i> Store Features</div>
                <p class="settings-section-desc">Enable or disable core storefront features.</p>


                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Product Reviews</div>
                        <div class="toggle-info-sub">Show customer reviews on product pages.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="product_reviews" {{ old('product_reviews', $general?->product_reviews) ? 'checked' : '' }}><span class="toggle-track"></span></label>
                </div>
                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Wishlist</div>
                        <div class="toggle-info-sub">Allow customers to save products to a wishlist.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="wishlist" {{ old('wishlist', $general?->wishlist) ? 'checked' : '' }}><span class="toggle-track"></span></label>
                </div>
                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Stock Alerts to Customers</div>
                        <div class="toggle-info-sub">Email customers when out-of-stock items are restocked.</div>
                    </div>
                    <label class="toggle-switch"><input type="checkbox" name="stock_alerts" {{ old('stock_alerts', $general?->stock_alerts) ? 'checked' : '' }}><span class="toggle-track"></span></label>
                </div>
            </div>

        </div><!-- /settings-content -->
    </div><!-- /settings-layout -->

    <div class="action-bar">
        <button class="btn-secondary-dash">Discard Changes</button>
        <button type="submit" class="btn-primary-dash">
            <i class="fa fa-save"></i>
            Save General Settings
        </button>
    </div>

</form>