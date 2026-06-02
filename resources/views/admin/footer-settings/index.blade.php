@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Footer Settings
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">

                <div class="card-header">
                    <h4 class="mb-0">
                        Manage Footer Settings
                    </h4>
                </div>

                <form action="{{ route('admin.footer-settings.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Footer Logo
                                    </label>

                                    <input type="file"
                                        name="logo"
                                        class="form-control">

                                    @if(!empty($footer?->logo))

                                        <div class="mt-2">

                                            <img src="{{ asset($footer->logo) }}"
                                                width="180"
                                                class="img-thumbnail">

                                        </div>

                                    @endif

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Phone Number
                                    </label>

                                    <input type="text"
                                        name="phone"
                                        class="form-control"
                                        value="{{ old('phone', $footer?->phone) }}">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        WhatsApp Number
                                    </label>

                                    <input type="text"
                                        name="whatsapp"
                                        class="form-control"
                                        value="{{ old('whatsapp', $footer?->whatsapp) }}">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Email
                                    </label>

                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email', $footer?->email) }}">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Secondary Email
                                    </label>

                                    <input type="email"
                                        name="email2"
                                        class="form-control"
                                        value="{{ old('email2', $footer?->email2) }}">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Address
                                    </label>

                                    <textarea name="address"
                                        rows="3"
                                        class="form-control">{{ old('address', $footer?->address) }}</textarea>

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>
                                        Footer Description
                                    </label>

                                    <textarea name="about_text"
                                        rows="5"
                                        class="form-control">{{ old('about_text', $footer?->about_text) }}</textarea>

                                </div>

                            </div>

                        </div>

                        <hr>

                        <h5 class="mb-3">
                            Social Media Links
                        </h5>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Facebook URL
                                    </label>

                                    <input type="url"
                                        name="facebook"
                                        class="form-control"
                                        value="{{ old('facebook', $footer?->facebook) }}">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Twitter URL
                                    </label>

                                    <input type="url"
                                        name="twitter"
                                        class="form-control"
                                        value="{{ old('twitter', $footer?->twitter) }}">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        LinkedIn URL
                                    </label>

                                    <input type="url"
                                        name="linkedin"
                                        class="form-control"
                                        value="{{ old('linkedin', $footer?->linkedin) }}">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Instagram URL
                                    </label>

                                    <input type="url"
                                        name="instagram"
                                        class="form-control"
                                        value="{{ old('instagram', $footer?->instagram) }}">

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit"
                            class="btn btn-primary">

                            <i class="fa fa-save"></i>
                            Save Footer Settings

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')