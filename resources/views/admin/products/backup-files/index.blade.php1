@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <style>
        .sorting-link {
            color: #212529;
            text-decoration: none !important;
            font-weight: 600;
        }

        .sorting-link:hover {
            color: #007bff;
        }

        .sorting-link i {
            margin-left: 4px;
        }
    </style>
    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Products
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">

                <a href="{{ route('admin.products.import') }}" class="btn btn-success">
                    <i class="fa fa-upload"></i> Bulk Import Products
                </a>

                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Product
                </a>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <!-- SEARCH (optional but useful) -->
                    <form method="GET" class="mb-4">

                        <div class="row align-items-end">

                            <div class="col-md-3">
                                <label>Category</label>

                                <select name="category_id" id="category_id" class="form-control">

                                    <option value="">All Categories</option>

                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Sub Category</label>

                                <select name="subcategory_id" class="form-control">

                                    <option value="">All Sub Categories</option>

                                    @foreach($subCategories as $sub)
                                        <option value="{{ $sub->id }}" {{ request('subcategory_id') == $sub->id ? 'selected' : '' }}>
                                            {{ $sub->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>Search</label>

                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search Product...">
                            </div>

                            <div class="col-md-3">

                                <button class="btn btn-primary">
                                    <i class="fa fa-search"></i> Search
                                </button>

                                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                    Reset
                                </a>

                            </div>

                        </div>

                    </form>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            @php
                                function sortUrl($column)
                                {
                                    $direction = request('sort_by') == $column &&
                                        request('sort_order') == 'asc'
                                        ? 'desc'
                                        : 'asc';

                                    return request()->fullUrlWithQuery([
                                        'sort_by' => $column,
                                        'sort_order' => $direction
                                    ]);
                                }
                                function sortIcon($column)
                                {
                                    if (request('sort_by') != $column) {
                                        return '<i class="fa fa-sort text-muted"></i>';
                                    }

                                    return request('sort_order') == 'asc'
                                        ? '<i class="fa fa-sort-up text-primary"></i>'
                                        : '<i class="fa fa-sort-down text-primary"></i>';
                                }
                            @endphp
                            <thead class="thead-light">
                                <tr>

                                    <th>
                                        <a href="{{ sortUrl('id') }}" class="sorting-link">
                                            ID {!! sortIcon('id') !!}
                                        </a>
                                    </th>

                                    <th>Image</th>

                                    <th>
                                        <a href="{{ sortUrl('name') }}" class="sorting-link">
                                            Name {!! sortIcon('name') !!}
                                        </a>
                                    </th>

                                    <th>Category</th>

                                    <th>
                                        <a href="{{ sortUrl('price') }}" class="sorting-link">
                                            Price {!! sortIcon('price') !!}
                                        </a>
                                    </th>

                                    <th>
                                        <a href="{{ sortUrl('status') }}" class="sorting-link">
                                            Status {!! sortIcon('status') !!}
                                        </a>
                                    </th>

                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                                @forelse($products as $item)

                                                                <tr id="row{{ $item->id }}">

                                                                    <td>{{ $item->id }}</td>

                                                                    <td>

                                                                        @if($item->display_image)
                                                                            <img src="{{  $item->display_image }}" width="60" height="60"
                                                                                style="object-fit:cover;">
                                                                        @else
                                                                            <span class="text-muted">No Image</span>
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        <strong>{{ $item->name }}</strong><br>
                                                                        <small class="text-muted">{{ $item->slug }}</small>
                                                                    </td>

                                                                    <td>
                                                                        <small>
                                                                            {{ $item->category->name ?? '-' }} <br>
                                                                            <span class="text-muted">
                                                                                {{ $item->subcategory->name ?? '' }}
                                                                            </span>
                                                                        </small>
                                                                    </td>

                                                                    <td>
                                                                        ₹ {{ number_format($item->price, 2) }}
                                                                    </td>

                                                                    <td>
                                                                        @if($item->status)
                                                                            <span class="badge badge-success">Active</span>
                                                                        @else
                                                                            <span class="badge badge-danger">Inactive</span>
                                                                        @endif
                                                                    </td>

                                                                    <td>

                                                                        <!-- EDIT -->
                                                                        <a href="{{ route('admin.products.edit', [
                                        'product' => $item->id,
                                        'redirect' => request()->fullUrl()
                                    ]) }}" class="btn btn-sm btn-outline-dark">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </a>
                                                                        <!-- DELETE -->
                                                                        <button class="btn btn-sm btn-outline-danger"
                                                                            onclick="deleteItem({{ $item->id }})">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>

                                                                    </td>

                                                                </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No Products Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>
    function deleteItem(id) {
        Swal.fire({
            title: 'Delete Product?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/products') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (res) {

                        Swal.fire('Deleted!', res.message, 'success');

                        $("#row" + id).fadeOut(400, function () {
                            $(this).remove();
                        });

                    }
                });

            }
        });
    }
</script>