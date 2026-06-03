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
                        Manage Fabrics
                    </li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.fabrics.create') }}"
                   class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Fabric
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="GET" class="mb-4">
                        <div class="row">

                            <div class="col-md-4">
                                <label>Search</label>
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       class="form-control"
                                       placeholder="Search Fabric">
                            </div>

                            <div class="col-md-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">All</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-5 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Search
                                </button>

                                <a href="{{ route('admin.fabrics.index') }}"
                                   class="btn btn-secondary ml-2">
                                    Reset
                                </a>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($fabrics as $fabric)

                                    <tr id="row{{ $fabric->id }}">

                                        <td>{{ $fabric->id }}</td>

                                        <td>{{ $fabric->name }}</td>

                                        <td>{{ $fabric->slug }}</td>

                                        <td>{{ $fabric->sort_order }}</td>

                                        <td>
                                            @if($fabric->status)
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

                                            <a href="{{ route('admin.fabrics.edit',$fabric->id) }}"
                                               class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteFabric({{ $fabric->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No Fabrics Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">
                        {{ $fabrics->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

function deleteFabric(id)
{
    Swal.fire({
        title: 'Delete Fabric?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then((result) => {

        if(result.isConfirmed){

            $.ajax({
                url: "{{ url('admin/fabrics') }}/"+id,
                type: "DELETE",
                data:{
                    _token:"{{ csrf_token() }}"
                },
                success:function(res){

                    Swal.fire(
                        'Deleted!',
                        res.message,
                        'success'
                    );

                    $("#row"+id).remove();
                }
            });

        }

    });
}

</script>