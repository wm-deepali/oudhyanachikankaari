@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        {{-- Breadcrumb --}}
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home-page.index') }}">Manage Home Page</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Hero Section
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    {{-- SUCCESS --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ERRORS --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.home.hero.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            {{-- Trusted Text --}}
                            <div class="col-md-6 mb-3">
                                <label>Trusted Text</label>
                                <input type="text" name="trusted_text"
                                    value="{{ old('trusted_text', $hero->trusted_text ?? '') }}"
                                    class="form-control">
                            </div>

                            {{-- Title Line 1 --}}
                            <div class="col-md-6 mb-3">
                                <label>Title Line 1 (Black)</label>
                                <input type="text" name="title_black_1"
                                    value="{{ old('title_black_1', $hero->title_black_1 ?? '') }}"
                                    class="form-control" required>
                            </div>

                            {{-- Gradient Text --}}
                            <div class="col-md-6 mb-3">
                                <label>Gradient Text</label>
                                <input type="text" name="title_gradient"
                                    value="{{ old('title_gradient', $hero->title_gradient ?? '') }}"
                                    class="form-control" required>
                            </div>

                            {{-- Title Line 2 --}}
                            <div class="col-md-6 mb-3">
                                <label>Title Line 2 (Black)</label>
                                <input type="text" name="title_black_2"
                                    value="{{ old('title_black_2', $hero->title_black_2 ?? '') }}"
                                    class="form-control" required>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12 mb-3">
                                <label>Description</label>
                                <textarea name="description" rows="4"
                                    class="form-control"
                                    required>{{ old('description', $hero->description ?? '') }}</textarea>
                            </div>

                            {{-- Image --}}
                            <div class="col-md-6 mb-3">
                                <label>Hero Image</label>
                                <input type="file" name="image" class="form-control">

                                @if(!empty($hero->image))
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$hero->image) }}"
                                            width="120" class="border rounded">
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Save Changes
                            </button>

                            <a href="{{ route('admin.home-page.index') }}"
                                class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')