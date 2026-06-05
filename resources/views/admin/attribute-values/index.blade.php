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
                        Manage Attribute Values
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.attribute-values.create') }}"
                   class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Attribute Value
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
                                    <th>Attribute</th>
                                    <th>Value</th>
                                    <th>Sort Order</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($attributeValues as $value)

                                    <tr id="row{{ $value->id }}">

                                        <td>{{ $value->id }}</td>

                                        <td>
                                            {{ $value->attribute->name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $value->value }}
                                        </td>
                                    
                                        <td>
                                            {{ $value->sort_order }}
                                        </td>

                                        <td>

                                            {!! $value->status
                                                ? '<span class="badge badge-success">Active</span>'
                                                : '<span class="badge badge-danger">Inactive</span>' !!}

                                        </td>

                                        <td>

                                            <a href="{{ route('admin.attribute-values.edit',$value->id) }}"
                                               class="btn btn-sm btn-outline-dark">

                                                <i class="fa fa-pencil"></i>

                                            </a>

                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteValue({{ $value->id }})">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No Records Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">
                        {{ $attributeValues->links('pagination::bootstrap-4') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

function deleteValue(id)
{
    Swal.fire({
        title:'Delete Value?',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Delete'
    }).then((result)=>{

        if(result.isConfirmed){

            $.ajax({

                url:"{{ url('admin/attribute-values') }}/"+id,

                type:'DELETE',

                data:{
                    _token:"{{ csrf_token() }}"
                },

                success:function(res){

                    Swal.fire('Deleted!',res.message,'success');

                    $('#row'+id).remove();

                }

            });

        }

    });
}

</script>