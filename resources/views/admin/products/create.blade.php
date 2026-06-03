@include('admin.top-header')

<style>
    /* GLOBAL */
    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .card h5 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #111827;
    }

    /* HEADER */
    .card-header {
        background: #fff;
        font-size: 20px;
        font-weight: 600;
        border-bottom: 1px solid #eee;
    }

    /* FORM */
    label {
        font-weight: 500;
        margin-bottom: 3px;
        font-size: 14px;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 12px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
    }

    .form-control:focus {
        background: #fff;
        border-color: #003108;
        box-shadow: none;
    }

    /* CHECKBOX */
    input[type="checkbox"] {
        margin-right: 6px;
    }

    /* SECTION SPACING */
    .card.p-3 {
        padding: 20px !important;
    }

    /* CATEGORY SCROLL */
   .category-scroll {
    max-height: 300px;
    overflow-y: auto;
    padding-right: 10px;

    /* Firefox */
    scrollbar-width: thin;
    scrollbar-color: #999 transparent;
}

/* Chrome, Edge, Safari */
.category-scroll::-webkit-scrollbar {
    width: 5px;
}

.category-scroll::-webkit-scrollbar-track {
    background: transparent;
}

.category-scroll::-webkit-scrollbar-thumb {
    background: #999;
    border-radius: 10px;
}

.category-scroll::-webkit-scrollbar-thumb:hover {
    background: #666;
}
    /* SUBCATEGORY */
    .subcategory-box {
        padding-left: 20px;
        margin-top: 5px;
    }

    /* GRID SPACING */
    .row>div {
        margin-bottom: 12px;
    }

    /* RIGHT SIDEBAR */
    .right-sticky {
        position: sticky;
        top: 20px;
    }

    /* BUTTON */
    .btn-success {
        background: linear-gradient(90deg, #f97316, #fb923c);
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 500;
    }

    .btn-success:hover {
        opacity: 0.9;
    }

    /* SMALL BUTTON */
    .btn-sm {
        border-radius: 8px;
    }

    /* CHECKBOX GRID */
    .checkbox-grid label {
        display: block;
        margin-bottom: 6px;
    }

    /* CUSTOMIZATION BOX */
    .custom-box {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 10px;
        transition: 0.2s;
    }

    .custom-box:hover {
        border-color: #003108;
        background: linear-gradient(180deg, rgba(0, 49, 8, 0) 40%, rgba(0, 49, 8, 0.03) 100%);
    }

    /* TEXTAREA */
    textarea.form-control {
        min-height: 90px;
    }

    .flag-group {
        background: #f9fafb;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 10px 12px;
        /* reduced from 15px */
    }

    .flag-title {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 6px;
        /* reduced */
        text-transform: uppercase;
    }

    .flag-item {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 4px 6px;
        /* reduced */
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
        font-size: 13px;
        margin-bottom: 2px;
        /* reduce vertical gap */
    }

    .flag-item:hover {
        background: linear-gradient(180deg, rgba(0, 49, 8, 0) 40%, rgba(0, 49, 8, 0.03) 100%);
    }

    .flag-item input[type="checkbox"] {
        accent-color: #003108;
        transform: scale(1);
    }

  .occasion-box {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 12px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #ffffff;
    cursor: pointer;
    transition: 0.2s;
    font-size: 14px;
}

    .occasion-box:hover {
            background: linear-gradient(180deg, rgba(0, 49, 8, 0) 40%, rgba(0, 49, 8, 0.03) 100%);
        border-color: #003108;
    }

    .occasion-box input[type="checkbox"] {
        accent-color: #003108;
        transform: scale(1.1);
        cursor: pointer;
    }

    /* Optional: active feel when checked */
    .occasion-box input[type="checkbox"]:checked+span {
        font-weight: 500;
        color: #003108;
    }

    /* tumhara existing CSS */

    select.form-control {
        /*height: 45px;*/
        /*padding: 10px 12px;*/
        padding: 0px 8px;
    }

    .flag-item input[type="checkbox"] {
        accent-color: #003108;
        cursor: pointer;
    }

    /* TITLE SPACING */
    h5 b {
        font-weight: 600;
    }

    /* CATEGORY CARD */
    .category-card {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 10px;
        background: #fff;
        transition: 0.2s;
    }

    .category-card:hover {
        border-color: #003108;
        background: linear-gradient(180deg, rgba(0, 49, 8, 0) 40%, rgba(0, 49, 8, 0.03) 100%);
    }

    /* CATEGORY ITEM */
    .category-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        cursor: pointer;
    }

    /* CATEGORY NAME */
    .cat-name {
        font-size: 14px;
    }

    /* SUBCATEGORY BOX */
    .subcategory-box {
        margin-top: 8px;
        padding-left: 20px;
        display: none;
    }

    /* SUBCATEGORY ITEM */
    /*.subcategory-item {*/
    /*    display: flex;*/
    /*    align-items: center;*/
    /*    gap: 6px;*/
    /*    font-size: 13px;*/
    /*    margin-bottom: 4px;*/
    /*    cursor: pointer;*/
    /*}*/
    
    .subcategory-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    margin-bottom: 5px;
    cursor: pointer;
    border: 1px solid #80808038;
    /*padding-bottom: 5px;*/
    background: #ffffff38;
    padding: 10px 15px;
    border-radius: 10px;
}

    /* CHECKBOX COLOR */
    .category-item input,
    .subcategory-item input {
        accent-color: #003108;
    }

    .thumb-box {
        position: relative;
        margin: 5px;
    }

    .thumb-box img {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #eee;
    }

    .thumb-actions {
        position: absolute;
        top: -5px;
        right: -5px;
    }

    .remove-btn {
        background: red;
        color: #fff;
        border: none;
        border-radius: 50%;
        font-size: 12px;
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    
       .category-checkbox {
    width: 12px;
    height: 12px;
    cursor: pointer;
}



.category-checkbox {
    transform: scale(1.4);
    cursor: pointer;
    margin-right: 6px;
}
</style>

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="card shadow-sm">
            <div class="card-header"><b>Add Product</b></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- LEFT -->
                        <div class="col-md-8">

                            {{-- CATEGORY --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Category & Sub Category</b></h5>

                                <div class="category-scroll">

                                    @foreach($categories as $cat)
                                        <div class="category-card">

                                            <!-- CATEGORY -->
                                            <label class="category-item">
                                                <input type="checkbox" class="category-checkbox" data-id="{{ $cat->id }}"
                                                    name="categories[]" value="{{ $cat->id }}">

                                                <span class="cat-name">{{ $cat->name }}</span>
                                            </label>

                                            <!-- SUBCATEGORY -->
                                            <div class="subcategory-box" id="subcat_{{ $cat->id }}">
                                                @foreach($cat->children as $sub)
                                                    <label class="subcategory-item">
                                                        <input type="checkbox" name="sub_categories[]" value="{{ $sub->id }}">

                                                        <span>{{ $sub->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>


                            {{-- BASIC --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Basic Info</b></h5>

                                <label>Name *</label>
                                <input type="text" name="name" id="name" class="form-control" required>

                                <label class="mt-2">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control">


                                <label class="mt-2">Sub Title</label>
                                <textarea name="sub_title" class="form-control"></textarea>
                            </div>

                             {{-- INCLUSIONS --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Summary</b></h5>

                                <div id="incWrap">
                                    <input type="text" name="summary[]" class="form-control mb-2">
                                </div>

                                <button type="button" onclick="addInc()" class="btn btn-sm btn-primary">Add
                                    More</button>
                            </div>

                            <div class="card p-3 mb-3">
                                <h5><b>Media</b></h5>
                                <label class="mt-2">Upload Images (Max 6)</label>
                                <input type="file" id="images" name="images[]" multiple accept="image/*"
                                    class="form-control">

                                <small class="text-muted">Max 6 images allowed</small>

                                <!-- Thumbnails Preview -->
                                <div id="previewContainer" class="d-flex flex-wrap mt-2"></div>
                                <label class="mt-3">Video URL (YouTube / MP4)</label>

                                <input type="text" name="video_url" class="form-control"
                                    placeholder="Enter full YouTube URL (https://youtube.com/watch?v=xxxx) OR direct MP4 link">

                                <small class="text-muted">
                                    👉 Enter full YouTube URL. Example:
                                    https://www.youtube.com/watch?v=abc123XYZ
                                </small>
                            </div>

                            {{-- SKU --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Inventory</b></h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>SKU</label>
                                        <input type="text" name="sku" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Min Qty</label>
                                        <input type="number" name="min_qty" class="form-control" required>
                                    </div>

                                     <div class="col-md-6">
                                        <label>Stock</label>
                                        <input type="number" name="stock" class="form-control" required>
                                    </div>


                                    <div class="col-md-6">
                                        <label>Product Code</label>
                                        <input type="text" name="product_code" class="form-control">
                                    </div>

                                

                                </div>

                                <label class="mt-2">Delivery Time</label>
                                <input type="text" name="delivery_time" class="form-control">

                                <div class="mt-3">
                                    <div class="row">

                                        <div class="col-md-6 mb-2">
                                            <label class="occasion-box">
                                                <input type="checkbox" name="quality">
                                                <span>Quality Assurance</span>
                                            </label>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <label class="occasion-box">
                                                <input type="checkbox" name="pan_india">
                                                <span>PAN India Delivery</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- PRICING --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Pricing</b></h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>MRP</label>
                                        <input type="number" name="mrp" id="mrp" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Discount Type</label>
                                        <select name="discount_type" id="discount_type" class="form-control">
                                            <option value="amount">Amount</option>
                                            <option value="percentage">%</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Discount</label>
                                        <input type="number" name="discount" id="discount" class="form-control">
                                    </div>
                                </div>

                                <label class="mt-2">Final Price</label>
                                <input type="text" name="price" id="price" readonly class="form-control">
                            </div>


                            {{-- CUSTOMIZATION --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Customization</b></h5>

                                <div class="row">
                                    @foreach($customizations as $c)
                                        <div class="col-md-6 mb-2">
                                            <label class="custom-box w-100">
                                                <input type="checkbox" name="customizations[]" value="{{ $c->id }}">
                                                {{ $c->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                           

                            {{-- DETAILS --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Content</b></h5>

                                <label>Details</label>
                                <textarea name="details" id="details" class="form-control"></textarea>

                                <label class="mt-2">Delivery & Returns</label>
                                <textarea name="delivery_returns" id="delivery_returns" class="form-control"></textarea>
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-4 right-sticky">

                            {{-- OCCASIONS --}}
                            <div class="card p-3 mb-3">
                                <h5 class="mb-3"><b>Occasions (Suitable for)</b></h5>

                                <div class="row">
                                    @foreach($occasions as $o)
                                        <div class="col-12 mb-2">
                                            <label class="occasion-box">
                                                <input type="checkbox" name="occasions[]" value="{{ $o->id }}">
                                                <span>{{ $o->title }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                    
                            {{-- SEO --}}
                            <div class="card p-3 mb-3">
                                <h5><b>SEO</b></h5>

                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control">

                                <label class="mt-2">Meta Description</label>
                                <textarea name="meta_description" class="form-control"></textarea>
                            </div>

                            {{-- BUTTONS --}}
                            <div class="card p-3 mb-3">
                                <h5 class="mb-3"><b>Marketing Options</b></h5>

                                <div class="row">

                                    <div class="col-12 mb-2">
                                        <label class="occasion-box">
                                            <input type="checkbox" name="cart" checked>
                                            <span>Add to Cart</span>
                                        </label>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <label class="occasion-box">
                                            <input type="checkbox" name="whatsapp">
                                            <span>WhatsApp</span>
                                        </label>
                                    </div>

                                   <!-- <div class="col-12 mb-2">
                                        <label class="occasion-box">
                                            <input type="checkbox" name="call">
                                            <span>Call</span>
                                        </label>
                                    </div> -->
                                </div>
                            </div>

                            <div class="card p-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <button class="btn btn-success mt-3">Save Product</button>

                </form>
            </div>
        </div>

    </div>
</div>

@include('admin.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.config.versionCheck = false;
    CKEDITOR.replace('details');
    CKEDITOR.replace('delivery_returns');

    $('#name').keyup(function () {
        $('#slug').val($(this).val().toLowerCase().replace(/ /g, '-'));
    });

    $('#mrp,#discount,#discount_type').on('keyup change', function () {
        let m = +$('#mrp').val() || 0;
        let d = +$('#discount').val() || 0;
        let t = $('#discount_type').val();

        let p = t == 'percentage' ? m - (m * d / 100) : m - d;
        if (p < 0) p = 0;

        $('#price').val(p.toFixed(2));
    });

    function addInc() {
        $('#incWrap').append('<input type="text" name="inclusions[]" class="form-control mb-2">');
    }

    $('.category-checkbox').on('change', function () {
        let id = $(this).data('id');

        if ($(this).is(':checked')) {
            $('#subcat_' + id).slideDown();
        } else {
            $('#subcat_' + id).slideUp();
            $('#subcat_' + id).find('input').prop('checked', false);
        }
    });

    let selectedFiles = [];

    $('#images').on('change', function (e) {
        let files = Array.from(e.target.files);

        if ((selectedFiles.length + files.length) > 6) {
            alert('Maximum 6 images allowed');
            return;
        }

        files.forEach(file => {
            selectedFiles.push(file);
        });

        renderPreview();
    });

    function renderPreview() {
        $('#previewContainer').html('');

        selectedFiles.forEach((file, index) => {
            let reader = new FileReader();

            reader.onload = function (e) {
                let html = `
                <div class="thumb-box">
                    <img src="${e.target.result}">

                    <div class="thumb-actions">
                        <button type="button" class="remove-btn" onclick="removeImage(${index})">×</button>
                    </div>

                    <div class="text-center mt-1">
                        <input type="radio" name="default_image" value="${index}" ${index === 0 ? 'checked' : ''}>
                        <small>Default</small>
                    </div>
                </div>
            `;
                $('#previewContainer').append(html);
            };

            reader.readAsDataURL(file);
        });
    }

    function removeImage(index) {
        selectedFiles.splice(index, 1);
        renderPreview();
    }

    $('form').on('submit', function () {
        let dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        document.getElementById('images').files = dataTransfer.files;
    });
</script>