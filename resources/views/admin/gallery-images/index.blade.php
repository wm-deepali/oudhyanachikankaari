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
                        <a href="{{ route('admin.home-page.index') }}">
                            Home Page
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Gallery Images
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">

                <a href="{{ route('admin.gallery-images.create') }}"
                    class="btn btn-primary">

                    <i class="fa fa-plus"></i>
                    Add Gallery Image

                </a>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead>

                                <tr>

                                    <th>ID</th>

                                    <th>Image</th>

                                    <th>Title</th>

                                    <th>Column</th>

                                    <th>Height</th>

                                    <th>Sort Order</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($galleryImages as $item)

                                    <tr id="row{{ $item->id }}">

                                        <td>
                                            {{ $item->id }}
                                        </td>

                                        <td>

                                            @if($item->image)

                                                <img src="{{ asset('storage/' . $item->image) }}"
                                                    alt="{{ $item->title }}"
                                                    width="80"
                                                    class="img-thumbnail">

                                            @else

                                                <span class="text-muted">
                                                    No Image
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            {{ $item->title }}
                                        </td>

                                        <td>
                                            Column {{ $item->column_no }}
                                        </td>

                                        <td>
                                            {{ $item->height_class }}
                                        </td>

                                        <td>
                                            {{ $item->sort_order }}
                                        </td>

                                        <td>

                                            @if($item->status)

                                                <span class="badge badge-success">
                                                    Active
                                                </span>

                                            @else

                                                <span class="badge badge-danger">
                                                    Inactive
                                                </span>

                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('admin.gallery-images.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-dark">

                                                <i class="fa fa-pencil"></i>

                                            </a>

                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteItem({{ $item->id }})">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="8"
                                            class="text-center text-muted">

                                            No Records Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                        <div class="mt-3">

                            {{ $galleryImages->links('pagination::bootstrap-4') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

    function deleteItem(id)
    {
        Swal.fire({
            title: 'Delete Gallery Image?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        })
        .then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/gallery-images/delete') }}/" + id,

                    type: 'DELETE',

                    data: {
                        _token: "{{ csrf_token() }}"
                    },

                    success: function(res) {

                        Swal.fire(
                            'Deleted!',
                            res.message,
                            'success'
                        );

                        $("#row" + id).remove();

                    }

                });

            }

        });
    }

</script>