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

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.supplier-enquiries.index') }}">Bulk Order Enquiries</a>
                    </li>

                    <li class="breadcrumb-item active">
                        View Enquiry
                    </li>

                </ol>
            </div>
        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <h2>Bulk Order Enquiry Details</h2>

                    <p><strong>Name:</strong> {{ $enquiry->name }}</p>
                    <p><strong>Email:</strong> {{ $enquiry->email }}</p>
                    <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
                    <p><strong>Company:</strong> {{ $enquiry->company }}</p>
                    <p><strong>Category:</strong> {{ $enquiry->category->name ?? '-' }}</p>
                    <p><strong>Quantity:</strong> {{ $enquiry->quantity }}</p>
                    <p><strong>Delivery Date:</strong> {{ $enquiry->delivery_date }}</p>
                    <p><strong>City:</strong> {{ $enquiry->city }}</p>
                    <p><strong>Description:</strong> {{ $enquiry->description }}</p>

                    @if($enquiry->catalogue)
                        <p>
                            <strong>Catalogue:</strong>
                            <a href="{{ asset('storage/' . $enquiry->catalogue) }}" target="_blank">
                                View File
                            </a>
                        </p>
                    @endif

                    <p><strong>Status:</strong> {{ $enquiry->status }}</p>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')