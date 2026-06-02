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
                        <a href="{{ route('admin.home.sliders.index') }}">
                            Home Sliders
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Slider
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Slider</strong>
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
                        action="{{ route('admin.home.sliders.store') }}"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-sm-12 form-group">

                                <label>Slider Image *</label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                    accept=".jpg,.jpeg,.png,.webp">

                                <small class="text-muted">

                                    Recommended Size:
                                    2048 × 730 px

                                    <br>

                                    Allowed:
                                    JPG, JPEG, PNG, WEBP

                                    <br>

                                    Maximum Size:
                                    5 MB

                                </small>

                                @error('image')

                                    <span class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                            <div class="col-sm-12 form-group">

                                <label>Redirect Link</label>

                                <input
                                    type="url"
                                    name="link"
                                    value="{{ old('link') }}"
                                    class="form-control"
                                    placeholder="https://example.com">

                                @error('link')

                                    <span class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Sort Order</label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    class="form-control">

                                @error('sort_order')

                                    <span class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Status</label>

                                <select
                                    name="status"
                                    class="form-control">

                                    <option value="1"
                                        {{ old('status',1) == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ old('status') == 0 ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                                @error('status')

                                    <span class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </span>

                                @enderror

                            </div>

                        </div>

                        <div class="mt-4">

                            <button
                                type="submit"
                                class="btn btn-success">

                                <i class="fa-solid fa-save"></i>

                                Save Slider

                            </button>

                            <a href="{{ route('admin.home.sliders.index') }}"
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