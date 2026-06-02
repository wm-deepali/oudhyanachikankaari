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

                    <li class="breadcrumb-item active">
                        Brand Promotion Section
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Brand Promotion Section</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                        action="{{ route('admin.home.brand-section.update') }}"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-sm-6 form-group">

                                <label>Subtitle</label>

                                <input
                                    type="text"
                                    name="subtitle"
                                    value="{{ old('subtitle',$item->subtitle ?? '') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Main Image</label>

                                <input
                                    type="file"
                                    name="main_image"
                                    class="form-control">

                            </div>

                            @if(!empty($item?->main_image))

                                <div class="col-sm-12 mb-3">

                                    <img
                                        src="{{ asset('storage/'.$item->main_image) }}"
                                        width="150">

                                </div>

                            @endif

                            <div class="col-sm-12 form-group">

                                <label>Title</label>

                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title',$item->title ?? '') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-12 form-group">

                                <label>Description</label>

                                <textarea
                                    name="description"
                                    rows="5"
                                    class="form-control">{{ old('description',$item->description ?? '') }}</textarea>

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Button Text</label>

                                <input
                                    type="text"
                                    name="button_text"
                                    value="{{ old('button_text',$item->button_text ?? '') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Button Link</label>

                                <input
                                    type="text"
                                    name="button_link"
                                    value="{{ old('button_link',$item->button_link ?? '') }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Status</label>

                                <select
                                    name="status"
                                    class="form-control">

                                    <option value="1"
                                        {{ ($item->status ?? 1) == 1 ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ ($item->status ?? 1) == 0 ? 'selected' : '' }}>
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

                                Save Section

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')