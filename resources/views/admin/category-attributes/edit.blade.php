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
                        <a href="{{ route('admin.category-attributes.index') }}">
                            Category Attributes
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Mapping
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Category Attribute</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.category-attributes.update', $categoryAttribute->id) }}"
                          class="save-form">

                        @csrf
                        @method('PUT')

                        <div class="form-group">

                            <label>
                                Category
                                <span class="text-danger">*</span>
                            </label>

                            <select name="category_id"
                                    class="form-control"
                                    required>

                                @foreach($categories as $category)

                                    <option value="{{ $category->id }}"
                                        {{ $categoryAttribute->category_id == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label>
                                Attribute
                                <span class="text-danger">*</span>
                            </label>

                            <select name="attribute_id"
                                    class="form-control"
                                    required>

                                @foreach($attributes as $attribute)

                                    <option value="{{ $attribute->id }}"
                                        {{ $categoryAttribute->attribute_id == $attribute->id ? 'selected' : '' }}>

                                        {{ $attribute->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Required</label>

                            <select name="is_required"
                                    class="form-control">

                                <option value="1"
                                    {{ $categoryAttribute->is_required ? 'selected' : '' }}>
                                    Yes
                                </option>

                                <option value="0"
                                    {{ !$categoryAttribute->is_required ? 'selected' : '' }}>
                                    No
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Used For Variant</label>

                            <select name="used_for_variant"
                                    class="form-control">

                                <option value="1"
                                    {{ $categoryAttribute->used_for_variant ? 'selected' : '' }}>
                                    Yes
                                </option>

                                <option value="0"
                                    {{ !$categoryAttribute->used_for_variant ? 'selected' : '' }}>
                                    No
                                </option>

                            </select>

                            <small class="text-muted">
                                Example: Color, Size, Storage, RAM
                            </small>

                        </div>

                        <div class="form-group">

                            <label>Show In Filter</label>

                            <select name="show_in_filter"
                                    class="form-control">

                                <option value="1"
                                    {{ $categoryAttribute->show_in_filter ? 'selected' : '' }}>
                                    Yes
                                </option>

                                <option value="0"
                                    {{ !$categoryAttribute->show_in_filter ? 'selected' : '' }}>
                                    No
                                </option>

                            </select>

                            <small class="text-muted">
                                Customer can filter products using this attribute.
                            </small>

                        </div>

                        <div class="form-group">

                            <label>Show On Listing</label>

                            <select name="show_on_listing"
                                    class="form-control">

                                <option value="1"
                                    {{ $categoryAttribute->show_on_listing ? 'selected' : '' }}>
                                    Yes
                                </option>

                                <option value="0"
                                    {{ !$categoryAttribute->show_on_listing ? 'selected' : '' }}>
                                    No
                                </option>

                            </select>

                            <small class="text-muted">
                                Show attribute on product cards / category pages.
                            </small>

                        </div>

                        <div class="form-group">

                            <label>Sort Order</label>

                            <input type="number"
                                   name="sort_order"
                                   class="form-control"
                                   value="{{ old('sort_order', $categoryAttribute->sort_order) }}">

                        </div>

                        <div class="form-group">

                            <label>Status</label>

                            <select name="status"
                                    class="form-control">

                                <option value="1"
                                    {{ $categoryAttribute->status ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ !$categoryAttribute->status ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="mt-3">

                            <button type="submit"
                                    class="btn btn-success save-btn">

                                <i class="fa fa-save"></i>
                                Update Mapping

                            </button>

                            <a href="{{ route('admin.category-attributes.index') }}"
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

<script>

    $(document).on('submit', '.save-form', function () {

        let btn = $(this).find('.save-btn');

        btn.prop('disabled', true);

        btn.html(
            '<i class="fa fa-spinner fa-spin"></i> Processing...'
        );

    });

</script>

@include('admin.footer')