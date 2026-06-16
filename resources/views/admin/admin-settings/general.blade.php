   <div class="settings-layout">

                        <!-- Section nav -->
                        <div class="settings-sidenav">
                            <span class="settings-sidenav-label">Sections</span>
                            <a href="#gs-site" class="active"><i class="fa-solid fa-globe"></i> Site Identity</a>
                            <a href="#gs-contact"><i class="fa-solid fa-phone"></i> Contact Info</a>
                            <a href="#gs-regional"><i class="fa-solid fa-map-pin"></i> Regional</a>
                            <a href="#gs-security"><i class="fa-solid fa-shield"></i> Security</a>
                            <a href="#gs-misc"><i class="fa-solid fa-toggle-on"></i> Features</a>
                        </div>

                        <!-- Content -->
                        <div class="settings-content">

                            <!-- Site Identity -->
                            <div class="settings-section" id="gs-site">
                                <div class="settings-section-title"><i class="fa-solid fa-globe"></i> Site Identity</div>
                                <p class="settings-section-desc">Basic information about your store shown to customers and used across the admin panel.</p>

                                <div class="form-grid">
                                    <div class="field-group col-full">
                                        <label class="field-label">Site / Store Name <span class="req">*</span></label>
                                        <input type="text" class="field-input" value="Oudhyana Chikankari" placeholder="Your store name">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Tagline</label>
                                        <input type="text" class="field-input" placeholder="e.g. Authentic Lucknowi Chikankari">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Site Logo</label>
                                        <div class="upload-area">
                                            <input type="file" accept="image/*">
                                            <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                            <div class="upload-label">Upload Logo</div>
                                            <div class="upload-sub">PNG, SVG · recommended 200×60px</div>
                                        </div>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Favicon</label>
                                        <div class="upload-area">
                                            <input type="file" accept="image/*">
                                            <div class="upload-icon"><i class="fa fa-image"></i></div>
                                            <div class="upload-label">Upload Favicon</div>
                                            <div class="upload-sub">ICO, PNG · 32×32px</div>
                                        </div>
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Site URL</label>
                                        <div class="input-wrap">
                                            <span class="input-prefix">https://</span>
                                            <input type="text" class="field-input" value="oudhyanachikankaari.com">
                                        </div>
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Admin Email</label>
                                        <input type="email" class="field-input" value="admin@oudhyanachikankaari.com">
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
                                        <input type="text" class="field-input" placeholder="+91 98765 43210">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">WhatsApp Number</label>
                                        <input type="text" class="field-input" placeholder="+91 98765 43210">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Support Email</label>
                                        <input type="email" class="field-input" placeholder="support@yourdomain.com">
                                    </div>
                                    <div class="field-group col-full">
                                        <label class="field-label">Business Address</label>
                                        <textarea class="field-textarea" rows="3" placeholder="Full registered address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr class="section-divider">

                            <!-- Regional -->
                            <div class="settings-section" id="gs-regional">
                                <div class="settings-section-title"><i class="fa-solid fa-map-pin"></i> Regional Settings</div>
                                <p class="settings-section-desc">Currency, timezone and date format used across the panel and storefront.</p>

                                <div class="form-grid">
                                    <div class="field-group">
                                        <label class="field-label">Currency</label>
                                        <select class="field-select">
                                            <option selected>INR — Indian Rupee (₹)</option>
                                            <option>USD — US Dollar ($)</option>
                                            <option>EUR — Euro (€)</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Currency Symbol</label>
                                        <input type="text" class="field-input" value="₹">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Timezone</label>
                                        <select class="field-select">
                                            <option selected>Asia/Kolkata (IST +5:30)</option>
                                            <option>UTC</option>
                                            <option>America/New_York</option>
                                        </select>
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Date Format</label>
                                        <select class="field-select">
                                            <option>DD/MM/YYYY</option>
                                            <option>MM/DD/YYYY</option>
                                            <option selected>D MMM YYYY</option>
                                        </select>
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
                                    <label class="toggle-switch"><input type="checkbox"><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Force HTTPS</div>
                                        <div class="toggle-info-sub">Redirect all HTTP traffic to HTTPS automatically.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Admin Session Timeout</div>
                                        <div class="toggle-info-sub">Auto-logout after inactivity (minutes).</div>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:8px">
                                        <input type="number" class="field-input" value="60" style="width:80px;height:32px;font-size:13px">
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
                                        <div class="toggle-info-label">Customer Registration</div>
                                        <div class="toggle-info-sub">Allow new customers to create accounts.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Guest Checkout</div>
                                        <div class="toggle-info-sub">Let customers order without registering.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Product Reviews</div>
                                        <div class="toggle-info-sub">Show customer reviews on product pages.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Wishlist</div>
                                        <div class="toggle-info-sub">Allow customers to save products to a wishlist.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-track"></span></label>
                                </div>
                                <div class="toggle-row">
                                    <div>
                                        <div class="toggle-info-label">Stock Alerts to Customers</div>
                                        <div class="toggle-info-sub">Email customers when out-of-stock items are restocked.</div>
                                    </div>
                                    <label class="toggle-switch"><input type="checkbox"><span class="toggle-track"></span></label>
                                </div>
                            </div>

                        </div><!-- /settings-content -->
                    </div><!-- /settings-layout -->

                    <div class="action-bar">
                        <button class="btn-secondary-dash">Discard Changes</button>
                        <button class="btn-primary-dash" onclick="saveSettings(this)">
                            <i class="fa fa-save"></i> Save General Settings
                        </button>
                    </div>