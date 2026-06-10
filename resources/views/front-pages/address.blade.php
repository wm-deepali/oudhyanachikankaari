@extends('layouts.user-app')
@section('content')

    <div class="aq-modern-content aq-address-page">
        <div class="aq-page-header">
            <h2>My Addresses</h2>
            <p>Manage your delivery and billing addresses.</p>
        </div>

        <!-- Address Grid -->
        <div class="aq-address-grid">

            <!-- Add New Address Button Card -->
            <div class="aq-address-card aq-address-add-card" data-bs-toggle="modal" data-bs-target="#addressModal">
                <div class="aq-add-icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <h5>Add New Address</h5>
            </div>

            <!-- Address 1 (Default) -->
            <div class="aq-address-card default-address">
                <div class="aq-address-header">
                    <span class="aq-address-type"><i class="fa-solid fa-house"></i> Home</span>
                    <span class="aq-address-badge">Default</span>
                </div>
                <h4 class="aq-address-name">Rahul Sharma</h4>
                <p class="aq-address-details">
                    A-102, Green Valley Apartments,<br>
                    Sector 45, DLF Phase 4,<br>
                    Gurgaon, Haryana - 122002
                </p>
                <p class="aq-address-phone"><i class="fa-solid fa-phone"></i> +91 98765 43210</p>

                <div class="aq-address-actions">
                    <button class="aq-btn-action"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                    <button class="aq-btn-action text-danger"><i class="fa-solid fa-trash-can"></i> Delete</button>
                </div>
            </div>

            <!-- Address 2 (Office) -->
            <div class="aq-address-card">
                <div class="aq-address-header">
                    <span class="aq-address-type"><i class="fa-solid fa-building"></i> Office</span>
                </div>
                <h4 class="aq-address-name">Rahul Sharma</h4>
                <p class="aq-address-details">
                    WeWork Cyber Hub,<br>
                    Tower B, 10th Floor, DLF Cyber City,<br>
                    Gurgaon, Haryana - 122002
                </p>
                <p class="aq-address-phone"><i class="fa-solid fa-phone"></i> +91 91234 56789</p>

                <div class="aq-address-actions">
                    <button class="aq-btn-action"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                    <button class="aq-btn-action text-danger"><i class="fa-solid fa-trash-can"></i> Delete</button>
                    <button class="aq-btn-action aq-set-default">Set as Default</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Add/Edit Address Modal -->
    <div class="modal fade aq-premium-modal address-modal" id="addressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
            <div class="modal-content">
                <button type="button" class="btn-close position-absolute" style="top: 20px; right: 20px; z-index: 10;"
                    data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="p-4">
                    <h3 class="font-family-heading mb-4">Add New Address</h3>

                    <form
                        onsubmit="event.preventDefault(); alert('Address Saved Successfully!'); $('#addressModal').modal('hide');">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="aq-form-label">Full Name *</label>
                                <input type="text" class="form-control" required placeholder="John Doe">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="aq-form-label">Mobile Number *</label>
                                <input type="tel" class="form-control" required placeholder="+91 00000 00000">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="aq-form-label">Address Line 1 *</label>
                            <input type="text" class="form-control" required placeholder="House/Flat No., Building Name">
                        </div>
                        <div class="mb-3">
                            <label class="aq-form-label">Address Line 2 (Optional)</label>
                            <input type="text" class="form-control" placeholder="Street, Sector, Area">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="aq-form-label">Pincode *</label>
                                <input type="text" class="form-control" required placeholder="122002">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="aq-form-label">City *</label>
                                <input type="text" class="form-control" required placeholder="Gurgaon">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="aq-form-label">State *</label>
                                <select class="form-select" required>
                                    <option value="" disabled selected>Select State</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="aq-form-label">Address Type *</label>
                                <div class="d-flex gap-4 mt-2">
                                    <label class="d-flex align-items-center gap-2"
                                        style="cursor: pointer; font-size: 14px; color: #555;">
                                        <input type="radio" name="addressType" checked
                                            style="width: 16px; height: 16px; margin: 0; appearance: auto !important;"> Home
                                    </label>
                                    <label class="d-flex align-items-center gap-2"
                                        style="cursor: pointer; font-size: 14px; color: #555;">
                                        <input type="radio" name="addressType"
                                            style="width: 16px; height: 16px; margin: 0; appearance: auto !important;">
                                        Office
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="aq-btn-submit w-100"
                            style="background: var(--aq-color-maroon); color: #fff; padding: 12px; border: none; border-radius: 8px;">Save
                            Address</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection