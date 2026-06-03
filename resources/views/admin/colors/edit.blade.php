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
                        <a href="{{ route('admin.colors.index') }}">Manage Colors</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Color
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Color</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.colors.update',$color->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="card p-3">

                            <label>Name <span class="text-danger">*</span></label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control"
                                   value="{{ old('name',$color->name) }}"
                                   required>

                            <label class="mt-3">Slug</label>

                            <input type="text"
                                   name="slug"
                                   id="slug"
                                   class="form-control"
                                   value="{{ old('slug',$color->slug) }}">

                            <label class="mt-3">Color</label>

                            <input type="color"
                                   name="hex_code"
                                   class="form-control"
                                   value="{{ old('hex_code',$color->hex_code ?: '#000000') }}">

                            <label class="mt-3">Sort Order</label>

                            <input type="number"
                                   name="sort_order"
                                   class="form-control"
                                   value="{{ old('sort_order',$color->sort_order) }}">

                            <label class="mt-3">Status</label>

                            <select name="status"
                                    class="form-control">

                                <option value="1"
                                    {{ old('status',$color->status)==1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status',$color->status)==0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="mt-3">

                            <button type="submit"
                                    class="btn btn-success">
                                <i class="fa fa-save"></i>
                                Update Color
                            </button>

                            <a href="{{ route('admin.colors.index') }}"
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

$('#slug').keyup(function(){
    manualSlug = true;
});

$('#name').keyup(function(){

    if(!manualSlug){

        let slug = $(this).val()
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'');

        $('#slug').val(slug);
    }

});

</script>