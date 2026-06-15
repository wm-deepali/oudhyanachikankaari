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
                        <a href="{{ route('admin.collections.index') }}">
                            Manage Collections
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Collection
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Collection</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.collections.update',$collection->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="card p-3">

                            <label>Name <span class="text-danger">*</span></label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control"
                                   value="{{ old('name',$collection->name) }}"
                                   required>

                            <label class="mt-3">Slug</label>

                            <input type="text"
                                   name="slug"
                                   id="slug"
                                   class="form-control"
                                   value="{{ old('slug',$collection->slug) }}">

                            <label class="mt-3">Sort Order</label>

                            <input type="number"
                                   name="sort_order"
                                   class="form-control"
                                   value="{{ old('sort_order',$collection->sort_order) }}">

                            <label class="mt-3">Status</label>

                            <select name="status" class="form-control">

                                <option value="1"
                                    {{ old('status',$collection->status)==1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status',$collection->status)==0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="mt-3">

                            <button type="submit"
                                    class="btn btn-success">
                                <i class="fa fa-save"></i>
                                Update Collection
                            </button>

                            <a href="{{ route('admin.collections.index') }}"
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

    // Disable button on submit
    document.querySelector('form').addEventListener('submit', function () {
        let btn = document.getElementById('updateBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    });
</script>