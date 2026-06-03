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
                        <a href="{{ route('admin.attribute-values.index') }}">
                            Manage Attribute Values
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Attribute Value
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Attribute Value</strong>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.attribute-values.store') }}" class="save-form">

                        @csrf

                        <div class="form-group">

                            <label>Attribute</label>

                            <select name="attribute_id" class="form-control" required>

                                <option value="">
                                    Select Attribute
                                </option>

                                @foreach($attributes as $attribute)

                                    <option value="{{ $attribute->id }}">
                                        {{ $attribute->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <label>Value</label>

                            <input type="text" name="value" class="form-control" required>

                        </div>


                        <div class="form-group">

                            <label>Sort Order</label>

                            <input type="number" name="sort_order" class="form-control" value="0">

                        </div>

                        <div class="form-group">

                            <label>Status</label>

                            <select name="status" class="form-control">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <button type="submit" class="btn btn-success save-btn">

                            <i class="fa fa-save"></i>

                            Save

                        </button>

                        <a href="{{ route('admin.attribute-values.index') }}" class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).on('submit', '.save-form', function () {

        let btn = $(this).find('.save-btn');

        btn.prop('disabled', true);

        btn.html(
            '<i class="fa fa-spinner fa-spin"></i> Processing...'
        );

    });

</script>

@include('admin.footer')