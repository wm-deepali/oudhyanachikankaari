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
                        Deal Banners
                    </li>

                </ol>

            </div>

            <div class="ml-auto mr-2">

                <a href="{{ route('admin.home-deal-banners.create') }}"
                    class="btn btn-primary">

                    <i class="fa fa-plus"></i>
                    Add Deal Banner

                </a>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">

                                <tr>

                                    <th width="80">#</th>

                                    <th width="120">Image</th>

                                    <th>Offer Text</th>

                                    <th>Title</th>

                                    <th>Highlight Text</th>

                                    <th>Button Text</th>

                                    <th width="100">Sort</th>

                                    <th width="100">Status</th>

                                    <th width="120">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($items as $item)

                                    <tr id="row{{ $item->id }}">

                                        <td>
                                            {{ $item->id }}
                                        </td>

                                        <td>

                                            @if($item->image)

                                                <img src="{{ asset('storage/'.$item->image) }}"
                                                    alt=""
                                                    width="80"
                                                    class="img-thumbnail">

                                            @endif

                                        </td>

                                        <td>
                                            {{ $item->offer_text }}
                                        </td>

                                        <td>
                                            {{ $item->title }}
                                        </td>

                                        <td>
                                            {{ $item->highlight_text }}
                                        </td>

                                        <td>
                                            {{ $item->button_text }}
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

                                            <a href="{{ route('admin.home-deal-banners.edit',$item->id) }}"
                                                class="btn btn-sm btn-outline-dark">

                                                <i class="fa fa-pencil"></i>

                                            </a>

                                            <button type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteItem({{ $item->id }})">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="9"
                                            class="text-center text-muted">

                                            No Records Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">

                        {{ $items->links('pagination::bootstrap-4') }}

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
            title: 'Delete Banner?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        })
        .then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    url: "{{ url('admin/home-deal-banners/delete') }}/" + id,

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

                        $('#row' + id).remove();

                    },

                    error: function() {

                        Swal.fire(
                            'Error',
                            'Something went wrong.',
                            'error'
                        );

                    }

                });

            }

        });
    }

</script>