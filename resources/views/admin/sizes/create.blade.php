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
                        <a href="{{ route('admin.sizes.index') }}">
                            Manage Sizes
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Size
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Size</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.sizes.store') }}">

                        @csrf

                        <div class="card p-3">

                            <label>Size Group <span class="text-danger">*</span></label>

                            <select name="size_group_id"
                                    class="form-control"
                                    required>

                                <option value="">
                                    Select Size Group
                                </option>

                                @foreach($sizeGroups as $group)

                                    <option value="{{ $group->id }}">
                                        {{ $group->name }}
                                    </option>

                                @endforeach

                            </select>

                            <label class="mt-3">
                                Size Name
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="XS, S, M, XL, 28, 30"
                                   required>

                            <label class="mt-3">
                                Sort Order
                            </label>

                            <input type="number"
                                   name="sort_order"
                                   class="form-control"
                                   value="0">

                            <label class="mt-3">
                                Status
                            </label>

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

                        <div class="mt-3">

                            <button type="submit"
                                    class="btn btn-success">
                                <i class="fa fa-save"></i>
                                Save Size
                            </button>

                            <a href="{{ route('admin.sizes.index') }}"
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

@include('admin.footer')