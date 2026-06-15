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

                    <li class="breadcrumb-item active">
                        Category Attributes
                    </li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.category-attributes.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Mapping
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Attribute</th>
                                    <th>Required</th>
                                    <th>Variant</th>
                                    <th>Filter</th>
                                    <th>Listing</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($categoryAttributes as $item)

                                                            <tr id="row{{ $item->id }}">

                                                                <td>{{ $item->id }}</td>

                                                                <td>
                                                                    {{ $item->category->name ?? '-' }}
                                                                </td>

                                                                <td>
                                                                    {{ $item->attribute->name ?? '-' }}
                                                                </td>

                                                                <td>
                                                                    {!! $item->is_required
                                    ? '<span class="badge badge-success">Yes</span>'
                                    : '<span class="badge badge-secondary">No</span>' !!}
                                                                </td>

                                                                <td>
                                                                    {!! $item->used_for_variant
                                    ? '<span class="badge badge-info">Yes</span>'
                                    : '<span class="badge badge-secondary">No</span>' !!}
                                                                </td>

                                                                <td>
                                                                    {!! $item->show_in_filter
                                    ? '<span class="badge badge-warning">Yes</span>'
                                    : '<span class="badge badge-secondary">No</span>' !!}
                                                                </td>

                                                                <td>
                                                                    {!! $item->show_on_listing
                                    ? '<span class="badge badge-success">Yes</span>'
                                    : '<span class="badge badge-secondary">No</span>' !!}
                                                                </td>

                                                                <td>
                                                                    {{ $item->sort_order }}
                                                                </td>

                                                                <td>
                                                                    {!! $item->status
                                    ? '<span class="badge badge-primary">Active</span>'
                                    : '<span class="badge badge-danger">Inactive</span>' !!}
                                                                </td>

                                                                <td>

                                                                    <a href="{{ route('admin.category-attributes.edit', $item->id) }}"
                                                                        class="btn btn-sm btn-outline-dark">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>

                                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                                        onclick="deleteMapping({{ $item->id }})">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>

                                                                </td>

                                                            </tr>

                                @empty

                                    <tr>
                                        <td colspan="10" class="text-center">
                                            No Records Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">
                        {{ $categoryAttributes->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

    function deleteMapping(id) {
        Swal.fire({
            title: 'Delete Mapping?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/category-attributes') }}/" + id,

                    type: 'DELETE',

                    data: {
                        _token: "{{ csrf_token() }}"
                    },

                    success: function (res) {

                        Swal.fire(
                            'Deleted!',
                            res.message,
                            'success'
                        );

                        $('#row' + id).remove();

                    }

                });

            }

        });
    }

</script>