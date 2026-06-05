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
                        <a href="{{ route('admin.products.index') }}">
                            Products
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Product
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data"
                class="save-form">

                @csrf

                <div class="card shadow-sm mb-3">

                    <div class="card-header">
                        <strong>Basic Information</strong>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Category *</label>

                                    <select name="category_id" id="category_id" class="form-control" required>

                                        <option value="">
                                            Select Category
                                        </option>

                                        @foreach($categories as $category)

                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6" id="subcategory-wrapper" style="display:none;">

                                <div class="form-group">

                                    <label>Sub Category</label>

                                    <select name="subcategory_id" id="subcategory_id" class="form-control">

                                        <option value="">
                                            Select Sub Category
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <label>Product Name *</label>

                            <input type="text" name="name" id="product_name" class="form-control" required>

                        </div>

                        <div class="form-group">

                            <label>Slug</label>

                            <input type="text" name="slug" id="slug" class="form-control">

                        </div>

                        <div class="form-group">

                            <label>SKU</label>

                            <input type="text" name="sku" class="form-control">

                        </div>

                        <div class="form-group">

                            <label>Short Description</label>

                            <textarea name="short_description" class="form-control" rows="3"></textarea>

                        </div>

                        <div class="form-group">

                            <label>Description</label>

                            <textarea name="description" class="form-control" rows="6"></textarea>

                        </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Base Price</label>

                                    <input type="number" step="0.01" name="base_price" class="form-control" value="0">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Stock</label>

                                    <input type="number" name="stock" class="form-control" value="0">

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Sort Order</label>

                                    <input type="number" name="sort_order" class="form-control" value="0">

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <label>Featured Image</label>

                            <input type="file" name="featured_image" class="form-control">

                        </div>

                        <div class="form-group">

                            <label>Is Featured</label>

                            <select name="is_featured" class="form-control">

                                <option value="0">
                                    No
                                </option>

                                <option value="1">
                                    Yes
                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                {{-- Attributes will come here later --}}
                <div id="attribute-container"></div>

                <div class="mb-3" id="variant-btn-wrapper" style="display:none;">

                    <button type="button" id="generate-variants" class="btn btn-primary">

                        <i class="fa fa-cogs"></i>
                        Generate Variants

                    </button>

                </div>

                {{-- Variants will come here later --}}
                <div id="variant-container"></div>

                <button type="submit" class="btn btn-success save-btn">

                    <i class="fa fa-save"></i>
                    Save Product

                </button>

                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).on('keyup', '#product_name', function () {

        let slug = $(this)
            .val()
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-|-$/g, '');

        $('#slug').val(slug);

    });

    $(document).on('submit', '.save-form', function () {

        let btn = $(this).find('.save-btn');

        btn.prop('disabled', true);

        btn.html(
            '<i class="fa fa-spinner fa-spin"></i> Processing...'
        );

    });

    $('#category_id').on('change', function () {

        let categoryId = $(this).val();
        $('#variant-container').html('');
        $('#variant-btn-wrapper').hide();

        $('#subcategory_id').html(
            '<option value="">Loading...</option>'
        );

        if (!categoryId) {

            $('#subcategory-wrapper').hide();

            return;
        }
        loadAttributes(categoryId);
        $.get(
            '/admin/products/subcategories/' + categoryId,
            function (response) {

                if (response.length > 0) {

                    let html =
                        '<option value="">Select Sub Category</option>';

                    $.each(response, function (i, item) {

                        html += `
                        <option value="${item.id}">
                            ${item.name}
                        </option>
                    `;

                    });

                    $('#subcategory_id').html(html);

                    $('#subcategory-wrapper').show();

                } else {

                    $('#subcategory-wrapper').hide();

                }

            }
        );

    });

    function loadAttributes(categoryId) {
        $('#attribute-container').html('');

        $.get(
            '/admin/products/category-attributes/' + categoryId,
            function (response) {

                let html = '';

                if (response.length > 0) {

                    html += `
                    <div class="card shadow-sm mb-3">

                        <div class="card-header">
                            <strong>Attributes</strong>
                        </div>

                        <div class="card-body">
                `;

                    response.forEach(function (item) {

                        html += `
                        <div class="form-group">

                            <label>
                                ${item.attribute.name}
                            </label>
                    `;

                        if (item.attribute.has_values) {

                            item.attribute.values.forEach(function (value) {

                                html += `
                                <div>

                                    <label>

                                     <input
    type="checkbox"
    class="attribute-value"

    data-attribute-id="${item.attribute.id}"

    data-attribute-name="${item.attribute.name}"

    data-value-name="${value.value}"

    data-variant="${item.used_for_variant}"

    name="attribute_values[${item.attribute.id}][]"

    value="${value.id}"
>

                                        ${value.value}

                                    </label>

                                </div>
                            `;

                            });

                        }

                        html += `</div>`;

                    });

                    html += `
                        </div>
                    </div>
                `;

                    $('#attribute-container').html(html);
                    $('#variant-btn-wrapper').show();


                }
                else {

                    $('#attribute-container').html('');
                    $('#variant-btn-wrapper').hide();

                }
            }
        );
    }

    $(document).on('click', '#generate-variants', function () {

        let variantAttributes = {};

        $('.attribute-value:checked').each(function () {

            if ($(this).data('variant') != 1) {
                return;
            }

            let attributeId = $(this).data('attribute-id');

            if (!variantAttributes[attributeId]) {
                variantAttributes[attributeId] = [];
            }

            variantAttributes[attributeId].push({

                id: $(this).val(),

                name: $(this).data('value-name')

            });

        });

        let groups = Object.values(variantAttributes);

        if (groups.length === 0) {

            alert(
    'Please select at least one value from attributes marked as Variant.'
);

            return;
        }

        let combinations = cartesian(groups);

        renderVariants(combinations);

    });

    function cartesian(arr) {
        if (arr.length === 1) {
            return arr[0].map(item => [item]);
        }

        return arr.reduce(function (a, b) {

            return a.flatMap(function (d) {

                return b.map(function (e) {

                    return [].concat(d, e);

                });

            });

        });
    }


    function renderVariants(combinations) {
        let html = `

    <div class="card shadow-sm">

        <div class="card-header">

            <strong>Variants</strong>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                           <th>Variant</th>
<th>SKU</th>
<th>Price</th>
<th>Stock</th>
<th>Image</th>

                        </tr>

                    </thead>

                    <tbody>

    `;

        combinations.forEach(function (combo, index) {

            if (!Array.isArray(combo)) {
                combo = [combo];
            }

            let names = combo.map(x => x.name);

            html += `

            <tr>

                <td>

                    ${names.join(' / ')}

                </td>

                <td>

                    <input
                        type="text"
                        name="variants[${index}][sku]"
                        class="form-control">

                </td>

                <td>

                    <input
                        type="number"
                        step="0.01"
                        name="variants[${index}][price]"
                        class="form-control">

                </td>

                <td>

                    <input
                        type="number"
                        name="variants[${index}][stock]"
                        class="form-control">

                </td>

                <td>

    <input
        type="file"
        name="variants[${index}][image]"
        class="form-control">

</td>
            </tr>

        `;

            combo.forEach(function (item) {

                html += `

                <input
                    type="hidden"
                    name="variants[${index}][values][]"
                    value="${item.id}">

            `;

            });

        });

        html += `

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    `;

        $('#variant-container').html(html);
    }
</script>


@include('admin.footer')