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
                        <a href="{{ route('admin.home-feature-cards.index') }}">
                            Feature Cards
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Card
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Feature Card</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                        action="{{ route('admin.home-feature-cards.store') }}">

                        @csrf

                        <div class="row">

                            <div class="col-md-6 form-group">

                                <label>Icon *</label>

                                <input type="text"
                                    name="icon"
                                    value="{{ old('icon') }}"
                                    class="form-control"
                                    placeholder="fal fa-truck">

                                <small class="text-muted">
                                    Example: fal fa-truck
                                </small>

                            </div>

                            <div class="col-md-6 form-group">

                                <label>Title *</label>

                                <input type="text"
                                    name="title"
                                    value="{{ old('title') }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-12 form-group">

                                <label>Description</label>

                                <textarea name="content"
                                    rows="4"
                                    class="form-control">{{ old('content') }}</textarea>

                            </div>

                            <div class="col-md-4 form-group">

                                <label>Card Class</label>

                                <select name="card_class"
                                    class="form-control">

                                    <option value="aqf-pastel-peach">
                                        Peach
                                    </option>

                                    <option value="aqf-pastel-sage">
                                        Sage
                                    </option>

                                    <option value="aqf-pastel-champagne">
                                        Champagne
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4 form-group">

                                <label>Sort Order</label>

                                <input type="number"
                                    name="sort_order"
                                    value="0"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 form-group">

                                <label>Status</label>

                                <select name="status"
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

                        <button type="submit"
                            class="btn btn-success">

                            <i class="fa fa-save"></i>
                            Save Card

                        </button>

                        <a href="{{ route('admin.home-feature-cards.index') }}"
                            class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')