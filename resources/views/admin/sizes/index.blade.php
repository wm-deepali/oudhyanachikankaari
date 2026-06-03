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
                        Manage Sizes
                    </li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.sizes.create') }}"
                   class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Size
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
                                       placeholder="Search Size">
                            </div>

                            <div class="col-md-3">
                                <label>Size Group</label>

                                <select name="size_group_id" class="form-control">
                                    <option value="">All Groups</option>

                                    @foreach($sizeGroups ?? [] as $group)
                                        <option value="{{ $group->id }}"
                                            {{ request('size_group_id') == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5 d-flex align-items-end">

                                <button type="submit"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Search
                                </button>

                                <a href="{{ route('admin.sizes.index') }}"
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
                                    <th>Size Group</th>
                                    <th>Size</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($sizes as $size)

                                    <tr id="row{{ $size->id }}">

                                        <td>{{ $size->id }}</td>

                                        <td>
                                            {{ $size->sizeGroup->name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $size->name }}
                                        </td>

                                        <td>
                                            {{ $size->sort_order }}
                                        </td>

                                        <td>
                                            @if($size->status)
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

                                            <a href="{{ route('admin.sizes.edit',$size->id) }}"
                                               class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteSize({{ $size->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No Sizes Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">
                        {{ $sizes->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

function deleteSize(id)
{
    Swal.fire({
        title: 'Delete Size?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then((result) => {

        if(result.isConfirmed){

            $.ajax({
                url: "{{ url('admin/sizes') }}/"+id,
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