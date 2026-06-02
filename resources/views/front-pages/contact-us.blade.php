@extends('layouts.app')

@section('content')
    <main class="aq-contact-page">
        <!-- Contact Hero Section -->
        <section class="aq-contact-hero p-relative pt-120 pb-80">
            <div class="container text-center">
                <span class="aq-section-title-sm mb-15 d-inline-block text-white">Reach Out</span>
                <h1 class="font-family-heading text-white mb-20">Let's Connect</h1>
                <p class="aq-contact-hero-desc text-white">
                    Need a custom solution or bulk order assistance? Reach out — we’re happy to help.
                </p>
            </div>
        </section>

        <!-- Contact Content Section -->
        <section class="aq-contact-content pt-100 pb-100">
            <div class="container">
                <div class="row g-5">
                    <!-- Left: Locations -->
                    <div class="col-lg-5">
                        <div class="aq-contact-info-wrapper pe-lg-4">
                            <h3 class="font-family-heading mb-40">Our Offices</h3>

                            @foreach($branches as $branch)
                                <div class="aq-office-card {{ $loop->first ? 'corporate-card' : '' }} mb-30 p-4">
                                    <div class="d-flex align-items-start">
                                        <div class="aq-office-icon me-3 mt-1">
                                            {!! $branch->icon ?: '<i class="fa-solid fa-location-dot"></i>' !!}
                                        </div>

                                        <div>
                                            <h4 class="font-family-heading mb-2">
                                                {{ $branch->title }}
                                            </h4>

                                            <p class="aq-office-address mb-2">
                                                {!! nl2br(e($branch->address)) !!}
                                            </p>

                                            <div class="aq-office-details">

                                                @if($branch->phone)
                                                    <strong>Phone:</strong> {{ $branch->phone }}<br>
                                                @endif

                                                @if($branch->email)
                                                    <strong>Email:</strong> {{ $branch->email }}<br>
                                                @endif

                                                @if($branch->working_hours)
                                                    <strong>Working Hours:</strong>
                                                    {{ $branch->working_hours }}
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Right: Form -->
                    <div class="col-lg-7">
                        <div class="aq-contact-form-wrapper p-5">
                            <h3 class="font-family-heading mb-4 aq-contact-form-title">Send us a Message</h3>
                            <form method="POST" action="{{ route('contact.submit') }}">
                                @csrf

                                @if(session('success'))
                                    <div class="alert alert-success mb-3">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger mb-3">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="aq-contact-label">Your Name *</label>
                                        <div class="position-relative">
                                            <i class="fa-regular fa-user position-absolute aq-contact-input-icon"></i>

                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control aq-contact-input" placeholder="E.g. Rajesh Kumar"
                                                required>
                                        </div>

                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="aq-contact-label">Email Address *</label>
                                        <div class="position-relative">
                                            <i class="fa-regular fa-envelope position-absolute aq-contact-input-icon"></i>

                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control aq-contact-input" placeholder="rajesh@company.com"
                                                required>
                                        </div>

                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="aq-contact-label">Mobile Number *</label>

                                        <div class="position-relative">
                                            <i class="fa-solid fa-phone position-absolute aq-contact-input-icon"></i>

                                            <input type="tel" name="mobile" value="{{ old('mobile') }}"
                                                pattern="[6-9]{1}[0-9]{9}" maxlength="10"
                                                class="form-control aq-contact-input" placeholder="+91 98765 43210"
                                                required>
                                        </div>

                                        @error('mobile')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="aq-contact-label">Company Name *</label>

                                        <div class="position-relative">
                                            <i class="fa-solid fa-building position-absolute aq-contact-input-icon"></i>

                                            <input type="text" name="company" value="{{ old('company') }}"
                                                class="form-control aq-contact-input" placeholder="E.g. XYZ Corp">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="aq-contact-label">Select Inquiry Type *</label>

                                    <select name="inquiry_type" class="form-select aq-contact-input" required>

                                        <option value="">What can we help you with?</option>

                                        @foreach($inquiryTypes as $type)
                                            <option value="{{ $type }}" {{ old('inquiry_type') == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('inquiry_type')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="aq-contact-label">Your Message...</label>

                                    <textarea name="message" class="form-control aq-contact-input" rows="4"
                                        placeholder="Tell us about your requirements..."
                                        required>{{ old('message') }}</textarea>

                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}">
                                    </div>

                                    @error('g-recaptcha-response')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="aq-contact-btn-submit w-100">
                                    <span>Send Message</span>
                                    <i class="fa-solid fa-paper-plane ml-10"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection