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
                        <a href="{{ route('admin.attributes.index') }}">
                            Manage Attributes
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Attribute
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Attribute</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.attributes.store') }}"
                          class="save-form">

                        @csrf

                        <div class="form-group">

                            <label>Name <span class="text-danger">*</span></label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="form-group mt-3">

                            <label>Type <span class="text-danger">*</span></label>

                            <select name="type"
                                    class="form-control"
                                    required>

                                @foreach($types as $type)

                                    <option value="{{ $type }}">
                                        {{ ucfirst(str_replace('_', ' ', $type)) }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="form-group mt-3">

                            <label>Has Values</label>

                            <select name="has_values"
                                    class="form-control">

                                <option value="1">
                                    Yes
                                </option>

                                <option value="0">
                                    No
                                </option>

                            </select>

                            <small class="text-muted">
                                Example:
                                Color, Size, Material = Yes
                                <br>
                                Length, Width, Weight = No
                            </small>

                        </div>

                        <div class="form-group mt-3">

                            <label>Status</label>

                            <select name="status"
                                    class="form-control">

                                <option value="1">
                                    Active
                                </option>

                                <option value="0">
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="mt-4">

                            <button type="submit"
                                    class="btn btn-success save-btn">

                                <i class="fa fa-save"></i>
                                Save Attribute

                            </button>

                            <a href="{{ route('admin.attributes.index') }}"
                               class="btn btn-secondary">

                                Cancel

                            </a>

                        </div>

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