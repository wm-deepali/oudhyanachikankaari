@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Deal Banner</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                        action="{{ route('admin.home-deal-banners.update',$item->id) }}"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-sm-12 mb-3">

                                <img src="{{ asset('storage/'.$item->image) }}"
                                    width="150">

                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Replace Image</label>
                                <input type="file"
                                    name="image"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Offer Text</label>
                                <input type="text"
                                    name="offer_text"
                                    value="{{ $item->offer_text }}"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text"
                                    name="title"
                                    value="{{ $item->title }}"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Highlight Text</label>
                                <input type="text"
                                    name="highlight_text"
                                    value="{{ $item->highlight_text }}"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Button Text</label>
                                <input type="text"
                                    name="button_text"
                                    value="{{ $item->button_text }}"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Button Link</label>
                                <input type="text"
                                    name="button_link"
                                    value="{{ $item->button_link }}"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Sort Order</label>
                                <input type="number"
                                    name="sort_order"
                                    value="{{ $item->sort_order }}"
                                    class="form-control">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Status</label>

                                <select name="status"
                                    class="form-control">

                                    <option value="1"
                                        {{ $item->status ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ !$item->status ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                            </div>

                        </div>

                        <button type="submit"
                            class="btn btn-success">

                            Update Banner

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')