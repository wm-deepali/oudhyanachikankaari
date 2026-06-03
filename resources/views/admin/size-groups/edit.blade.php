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
                        <a href="{{ route('admin.size-groups.index') }}">
                            Manage Size Groups
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Size Group
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Size Group</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                        action="{{ route('admin.size-groups.update',$sizeGroup->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="card p-3">

                            <label>Name <span class="text-danger">*</span></label>

                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$sizeGroup->name) }}"
                                required>

                            <label class="mt-3">Sort Order</label>

                            <input type="number"
                                name="sort_order"
                                class="form-control"
                                value="{{ old('sort_order',$sizeGroup->sort_order) }}">

                            <label class="mt-3">Status</label>

                            <select name="status"
                                class="form-control">

                                <option value="1"
                                    {{ old('status',$sizeGroup->status)==1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status',$sizeGroup->status)==0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                        <div class="mt-3">

                            <button type="submit"
                                class="btn btn-success">
                                <i class="fa fa-save"></i>
                                Update Size Group
                            </button>

                            <a href="{{ route('admin.size-groups.index') }}"
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