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
                        Feature Cards
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">

                <a href="{{ route('admin.home-feature-cards.create') }}"
                    class="btn btn-primary">

                    <i class="fa fa-plus"></i>
                    Add Card

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

                                    <th>Icon</th>

                                    <th>Title</th>

                                    <th>Card Class</th>

                                    <th>Sort Order</th>

                                    <th>Status</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($cards as $card)

                                    <tr id="row{{ $card->id }}">

                                        <td>{{ $card->id }}</td>

                                        <td>
                                           {{ $card->icon }}"
                                               
                                        </td>

                                        <td>
                                            {{ $card->title }}
                                        </td>

                                        <td>
                                            {{ $card->card_class }}
                                        </td>

                                        <td>
                                            {{ $card->sort_order }}
                                        </td>

                                        <td>

                                            @if($card->status)

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

                                            <a href="{{ route('admin.home-feature-cards.edit',$card->id) }}"
                                                class="btn btn-sm btn-outline-dark">

                                                <i class="fa fa-pencil"></i>

                                            </a>

                                            <button
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="deleteCard({{ $card->id }})">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="7"
                                            class="text-center text-muted">

                                            No Feature Cards Found

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                        <div class="mt-3">

                            {{ $cards->links('pagination::bootstrap-4') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

function deleteCard(id)
{
    Swal.fire({
        title: 'Delete Card?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete'
    })
    .then((result)=>{

        if(result.isConfirmed){

            $.ajax({

                url: "{{ url('admin/home-feature-cards') }}/"+id,

                type:'DELETE',

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