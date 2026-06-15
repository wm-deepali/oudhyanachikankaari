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

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home-feature-cards.index') }}">
                            Feature Cards
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Card
                    </li>

                </ol>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Feature Card</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                        action="{{ route('admin.home-feature-cards.update',$card->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 form-group">

                                <label>Icon *</label>

                                <input type="text"
                                    name="icon"
                                    value="{{ $card->icon }}"
                                    class="form-control">

                            

                            </div>

                            <div class="col-md-6 form-group">

                                <label>Title *</label>

                                <input type="text"
                                    name="title"
                                    value="{{ $card->title }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-12 form-group">

                                <label>Description</label>

                                <textarea name="content"
                                    rows="4"
                                    class="form-control">{{ $card->content }}</textarea>

                            </div>

                            <div class="col-md-4 form-group">

                                <label>Card Class</label>

                                <select name="card_class"
                                    class="form-control">

                                    <option value="aqf-pastel-peach"
                                        {{ $card->card_class == 'aqf-pastel-peach' ? 'selected' : '' }}>
                                        Peach
                                    </option>

                                    <option value="aqf-pastel-sage"
                                        {{ $card->card_class == 'aqf-pastel-sage' ? 'selected' : '' }}>
                                        Sage
                                    </option>

                                    <option value="aqf-pastel-champagne"
                                        {{ $card->card_class == 'aqf-pastel-champagne' ? 'selected' : '' }}>
                                        Champagne
                                    </option>

                                </select>

                            </div>

                            <div class="col-md-4 form-group">

                                <label>Sort Order</label>

                                <input type="number"
                                    name="sort_order"
                                    value="{{ $card->sort_order }}"
                                    class="form-control">

                            </div>

                            <div class="col-md-4 form-group">

                                <label>Status</label>

                                <select name="status"
                                    class="form-control">

                                    <option value="1"
                                        {{ $card->status ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ !$card->status ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                            </div>

                        </div>

                        <button type="submit"
                            class="btn btn-success">

                            <i class="fa fa-save"></i>
                            Update Card

                        </button>

                        <a href="{{ route('admin.home-feature-cards.index') }}"
                            class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')