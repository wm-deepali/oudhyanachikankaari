@extends('layouts.user-app')
@section('content')

    <!-- Dashboard Content -->
    <div class="aq-modern-content aq-account-page">
        <div class="aq-page-header">
            <h2>Account Details</h2>
            <p>Update your personal information and secure your account.</p>
        </div>

        <div class="row">
            <!-- Profile Form -->
            <div class="col-xl-8 col-lg-7">
                <div class="aq-account-card mb-30">
                    <h3 class="aq-account-card-title">Personal Information</h3>

                    <div class="aq-avatar-upload">
                        <div class="aq-avatar-preview">
                            <img src="{{ asset('assets/img/corporate/gallery_bridal_lehenga.png') }}" alt="Profile" id="mainAvatarPreview">
                            <label for="avatarUpload" class="aq-avatar-edit-btn">
                                <i class="fa-solid fa-camera"></i>
                            </label>
                            <input type="file" id="avatarUpload" hidden accept="image/*">
                        </div>
                        <div class="aq-avatar-text">
                            <h5>Profile Photo</h5>
                            <p>Acceptable formats: JPG, PNG, SVG only.<br>Max file size is 2MB.</p>
                        </div>
                    </div>

                    <form class="aq-account-form"
                        onsubmit="event.preventDefault(); alert('Profile Updated Successfully!');">
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                <label class="aq-form-label">First Name</label>
                                <input type="text" class="form-control" value="Rahul" required>
                            </div>
                            <div class="col-md-6 mb-20">
                                <label class="aq-form-label">Last Name</label>
                                <input type="text" class="form-control" value="Sharma" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                <label class="aq-form-label">Email Address</label>
                                <input type="email" class="form-control" value="rahul.sharma@example.com" required>
                            </div>
                            <div class="col-md-6 mb-20">
                                <label class="aq-form-label">Phone Number</label>
                                <input type="tel" class="form-control" value="+91 98765 43210" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                <label class="aq-form-label">Date of Birth</label>
                                <input type="date" class="form-control" value="1990-05-15">
                            </div>
                            <div class="col-md-6 mb-20">
                                <label class="aq-form-label">Gender</label>
                                <select class="form-select">
                                    <option value="male" selected>Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                    <option value="prefer_not">Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="aq-btn-submit aq-btn-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Form -->
            <div class="col-xl-4 col-lg-5">
                <div class="aq-account-card">
                    <h3 class="aq-account-card-title">Security Settings</h3>
                    <p class="text-muted mb-30 aq-security-subtitle">Ensure your account is using a long, random password to
                        stay secure.</p>

                    <form class="aq-account-form"
                        onsubmit="event.preventDefault(); alert('Password Changed Successfully!');">
                        <div class="mb-20">
                            <label class="aq-form-label">Current Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="mb-20">
                            <label class="aq-form-label">New Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="mb-25">
                            <label class="aq-form-label">Confirm New Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="aq-btn-submit w-100 outline-btn">Update Password</button>
                        </div>
                    </form>
                </div>

                <div class="aq-account-card mt-30 delete-account-card">
                    <h3 class="aq-account-card-title text-danger mb-10"><i class="fa-solid fa-triangle-exclamation"></i>
                        Danger Zone</h3>
                    <p class="text-muted mb-20 aq-danger-subtitle">Once you delete your account, there is no going back.
                        Please be certain.</p>
                    <button class="aq-btn-delete-account"
                        onclick="if(confirm('Are you sure you want to permanently delete your account?')) alert('Account deletion requested.');">Delete
                        Account</button>
                </div>
            </div>
        </div>

    </div>

@endsection