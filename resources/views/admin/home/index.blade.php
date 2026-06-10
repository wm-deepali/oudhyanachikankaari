@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        {{-- Breadcrumb --}}
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Manage Home Page
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th width="80">#</th>
                                    <th>Section Name</th>
                                    <th width="150">Type</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>


                                <tr>
                                    <td>1</td>
                                    <td><strong>Home Sliders</strong></td>
                                    <td>
                                        <span class="badge badge-info">Multiple</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.home.sliders.index') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Manage
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td><strong>Text Slider Section</strong></td>
                                    <td>
                                        <span class="badge badge-info">Multiple</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.home.text-sliders.index') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Manage
                                        </a>
                                    </td>
                                </tr>

                              <tr>
    <td>3</td>
    <td><strong>Feature Cards</strong></td>
    <td>
        <span class="badge badge-info">Multiple</span>
    </td>
    <td>
        <a href="{{ route('admin.home-feature-cards.index') }}"
            class="btn btn-sm btn-outline-dark">
            <i class="fa fa-pencil"></i> Manage
        </a>
    </td>
</tr>



                                <tr>
                                    <td>4</td>
                                    <td><strong>Deal Banners</strong></td>
                                    <td>
                                        <span class="badge badge-info">Multiple</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.home-deal-banners.index') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Manage
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td><strong>Hero Slides</strong></td>
                                    <td>
                                        <span class="badge badge-info">Multiple</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.home-hero-slides.index') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Manage
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td><strong>Hero Side Banners</strong></td>
                                    <td>
                                        <span class="badge badge-info">Multiple</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.home-hero-banners.index') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Manage
                                        </a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>7</td>
                                    <td><strong>Brand Promotion Section</strong></td>
                                    <td>
                                        <span class="badge badge-primary">Fixed + Slider</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.home.brand-section.edit') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>

                                        <a href="{{ route('admin.home-brand-section-images.index') }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-images"></i> Slider Images
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>8</td>
                                    <td><strong>Premium Gifting Gallery</strong></td>
                                    <td>
                                        <span class="badge badge-info">Multiple</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.gallery-images.index') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Manage
                                        </a>
                                    </td>
                                </tr>


                                {{-- WHY --}}
                                <tr>
                                    <td>9</td>
                                    <td><strong>Why Choose Us</strong></td>
                                    <td>
                                        <span class="badge badge-info">Multiple</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.home.why.index') }}"
                                            class="btn btn-sm btn-outline-dark">
                                            <i class="fa fa-pencil"></i> Manage
                                        </a>
                                    </td>
                                </tr>


                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')