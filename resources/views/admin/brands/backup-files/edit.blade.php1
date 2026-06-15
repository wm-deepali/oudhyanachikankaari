@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.brands.index') }}">Brands</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Brand
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Brand</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                        action="{{ route('admin.brands.update', $brand->id) }}"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-body">

                            <div class="row">

                                <div class="col-sm-12 form-group">
                                    <label>Brand Name *</label>
                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name', $brand->name) }}">
                                </div>

                                <div class="col-sm-12 form-group">

                                    <label class="d-block mb-2">
                                        Categories *
                                    </label>

                                    <div class="border rounded p-3"
                                        style="max-height:220px;overflow-y:auto;">

                                        @foreach($categories as $category)

                                            <div class="form-check mb-3"
                                                style="display:flex;align-items:center;">

                                                <input type="checkbox"
                                                    class="form-check-input"
                                                    id="category_{{ $category->id }}"
                                                    name="categories[]"
                                                    value="{{ $category->id }}"
                                                    {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>

                                                <label class="form-check-label"
                                                    for="category_{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                                <div class="col-sm-12 form-group">

                                    <label>Status</label>

                                    <select name="status" class="form-control">

                                        <option value="1"
                                            {{ $brand->status == 1 ? 'selected' : '' }}>
                                            Active
                                        </option>

                                        <option value="0"
                                            {{ $brand->status == 0 ? 'selected' : '' }}>
                                            Inactive
                                        </option>

                                    </select>

                                </div>

                                <div class="col-sm-12 form-group">

                                    <label>Brand Logo</label>

                                    <input type="file"
                                        name="logo"
                                        class="form-control">

                                    @if($brand->logo)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $brand->logo) }}"
                                                width="100"
                                                alt="Brand Logo">
                                        </div>
                                    @endif

                                </div>

                            </div>

                            <div class="mt-4">

                                <button type="submit"
                                    class="btn btn-success">

                                    <i class="fa-solid fa-save"></i>
                                    Update Brand

                                </button>

                                <a href="{{ route('admin.brands.index') }}"
                                    class="btn btn-secondary">

                                    Cancel

                                </a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')