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
                        <a href="{{ route('admin.fabrics.index') }}">
                            Manage Fabrics
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Fabric
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Fabric</strong>
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
                          action="{{ route('admin.fabrics.update', $fabric->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="card p-3">

                            <h5 class="mb-3">
                                <b>Fabric Information</b>
                            </h5>

                            <label>
                                Name
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control"
                                   value="{{ old('name', $fabric->name) }}"
                                   required>

                            <label class="mt-3">
                                Slug
                            </label>

                            <input type="text"
                                   name="slug"
                                   id="slug"
                                   class="form-control"
                                   value="{{ old('slug', $fabric->slug) }}">

                            <label class="mt-3">
                                Sort Order
                            </label>

                            <input type="number"
                                   name="sort_order"
                                   class="form-control"
                                   value="{{ old('sort_order', $fabric->sort_order) }}">

                            <label class="mt-3">
                                Status
                            </label>

                            <select name="status"
                                    class="form-control">

                                <option value="1"
                                    {{ old('status', $fabric->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status', $fabric->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="mt-3">

                            <button type="submit"
                                    class="btn btn-success">
                                <i class="fa fa-save"></i>
                                Update Fabric
                            </button>

                            <a href="{{ route('admin.fabrics.index') }}"
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

<style>
    .card {
        border-radius: 10px;
    }
</style>

<script>

    let manualSlug = false;

    $('#slug').on('keyup', function () {
        manualSlug = true;
    });

    $('#name').on('keyup', function () {

        if (!manualSlug) {

            let slug = $(this).val()
                .toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');

            $('#slug').val(slug);
        }

    });

</script>