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

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home-page.index') }}">
                            Home Page
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home-hero-banners.index') }}">
                            Hero Side Banners
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Hero Banner
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Hero Banner</strong>
                </div>

                <div class="card-body">

                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form method="POST"
                        action="{{ route('admin.home-hero-banners.store') }}"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-sm-6 form-group">

                                <label>Image *</label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                    required>

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Small Text</label>

                                <input
                                    type="text"
                                    name="small_text"
                                    value="{{ old('small_text') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-12 form-group">

                                <label>Title</label>

                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Button Text</label>

                                <input
                                    type="text"
                                    name="button_text"
                                    value="{{ old('button_text') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Button Link</label>

                                <input
                                    type="text"
                                    name="button_link"
                                    value="{{ old('button_link') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Sort Order</label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    value="{{ old('sort_order',0) }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Status</label>

                                <select
                                    name="status"
                                    class="form-control">

                                    <option value="1">
                                        Active
                                    </option>

                                    <option value="0">
                                        Inactive
                                    </option>

                                </select>

                            </div>

                        </div>

                        <div class="mt-4">

                            <button
                                type="submit"
                                class="btn btn-success">

                                <i class="fa fa-save"></i>

                                Save Hero Banner

                            </button>

                            <a href="{{ route('admin.home-hero-banners.index') }}"
                                class="btn btn-secondary">

                                Cancel

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')