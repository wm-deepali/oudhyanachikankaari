@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-galleryImages-center bg-light mb-3">

            <div class="breadcrumb-wrapper">

                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-galleryImage">
                        <a href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-galleryImage">
                        <a href="{{ route('admin.home-page.index') }}">
                            Home Page
                        </a>
                    </li>

                    <li class="breadcrumb-galleryImage">
                        <a href="{{ route('admin.gallery-images.index') }}">
                            Gallery Images
                        </a>
                    </li>

                    <li class="breadcrumb-galleryImage active">
                        Edit Gallery Image
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Gallery Image</strong>
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
                          action="{{ route('admin.gallery-images.update',$galleryImage->id) }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-sm-12 form-group">

                                <label>Current Image</label>

                                <br>

                                <img src="{{ asset('storage/'.$galleryImage->image) }}"
                                     width="150"
                                     class="img-thumbnail">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Title</label>

                                <input
                                    type="text"
                                    name="title"
                                    value="{{ old('title',$galleryImage->title) }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Replace Image</label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control">

                            </div>

                            <div class="col-sm-4 form-group">

                                <label>Column *</label>

                                <select
                                    name="column_no"
                                    class="form-control">

                                    <option value="1" {{ $galleryImage->column_no == 1 ? 'selected' : '' }}>
                                        Column 1
                                    </option>

                                    <option value="2" {{ $galleryImage->column_no == 2 ? 'selected' : '' }}>
                                        Column 2
                                    </option>

                                    <option value="3" {{ $galleryImage->column_no == 3 ? 'selected' : '' }}>
                                        Column 3
                                    </option>

                                </select>

                            </div>

                            <div class="col-sm-4 form-group">

                                <label>Height Class *</label>

                                <select
                                    name="height_class"
                                    class="form-control">

                                    <option value="h-sm" {{ $galleryImage->height_class == 'h-sm' ? 'selected' : '' }}>
                                        Small
                                    </option>

                                    <option value="h-md" {{ $galleryImage->height_class == 'h-md' ? 'selected' : '' }}>
                                        Medium
                                    </option>

                                    <option value="h-lg" {{ $galleryImage->height_class == 'h-lg' ? 'selected' : '' }}>
                                        Large
                                    </option>

                                    <option value="h-xl" {{ $galleryImage->height_class == 'h-xl' ? 'selected' : '' }}>
                                        Extra Large
                                    </option>

                                </select>

                            </div>

                            <div class="col-sm-4 form-group">

                                <label>Sort Order</label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    value="{{ old('sort_order',$galleryImage->sort_order) }}"
                                    class="form-control">

                            </div>

                            <div class="col-sm-6 form-group">

                                <label>Status</label>

                                <select
                                    name="status"
                                    class="form-control">

                                    <option value="1" {{ $galleryImage->status ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0" {{ !$galleryImage->status ? 'selected' : '' }}>
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

                                Update Gallery Image

                            </button>

                            <a href="{{ route('admin.gallery-images.index') }}"
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