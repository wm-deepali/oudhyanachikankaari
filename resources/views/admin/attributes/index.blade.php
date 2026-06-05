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
                        Manage Attributes
                    </li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Attribute
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
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Type</th>
                                    <th>Has Values</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($attributes as $attribute)

                                                            <tr id="row{{ $attribute->id }}">

                                                                <td>{{ $attribute->id }}</td>

                                                                <td>{{ $attribute->name }}</td>

                                                                <td>
                                                                    <code>{{ $attribute->slug }}</code>
                                                                </td>

                                                                <td>
                                                                    {{ ucfirst($attribute->type) }}
                                                                </td>

                                                                <td>
                                                                    {!! $attribute->has_values
                                    ? '<span class="badge badge-success">Yes</span>'
                                    : '<span class="badge badge-danger">No</span>' !!}
                                                                </td>

                                                                <td>
                                                                    {!! $attribute->status
                                    ? '<span class="badge badge-success">Active</span>'
                                    : '<span class="badge badge-danger">Inactive</span>' !!}
                                                                </td>

                                                                <td>

                                                                    <a href="{{ route('admin.attributes.edit', $attribute->id) }}"
                                                                        class="btn btn-sm btn-outline-dark">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>

                                                                    <button class="btn btn-sm btn-outline-danger"
                                                                        onclick="deleteAttribute({{ $attribute->id }})">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>

                                                                </td>

                                                            </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No Attributes Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">
                        {{ $attributes->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

    function deleteAttribute(id) {
        Swal.fire({
            title: 'Delete Attribute?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/attributes') }}/" + id,
                    type: 'DELETE',

                    data: {
                        _token: "{{ csrf_token() }}"
                    },

                    success: function (res) {

                        Swal.fire('Deleted!', res.message, 'success');

                        $('#row' + id).remove();
                    }

                });

            }

        });
    }

</script>