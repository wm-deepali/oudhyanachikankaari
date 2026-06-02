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
<a href="{{ route('admin.home-brand-section-images.index') }}">
Slider Images
</a>
</li>

<li class="breadcrumb-item active">
Add Slider Image
</li>

</ol>

</div>

</div>

<div class="content-wrapper pb-4">

<div class="card shadow-sm">

<div class="card-header">
<strong>Add Slider Image</strong>
</div>

<div class="card-body">

<form method="POST"
      action="{{ route('admin.home-brand-section-images.store') }}"
      enctype="multipart/form-data">

@csrf

<div class="row">

<div class="col-sm-6 form-group">

<label>Image *</label>

<input type="file"
       name="image"
       class="form-control"
       required>

</div>

<div class="col-sm-6 form-group">

<label>Sort Order</label>

<input type="number"
       name="sort_order"
       value="0"
       class="form-control">

</div>

<div class="col-sm-6 form-group">

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

</div>

<div class="mt-4">

<button type="submit"
        class="btn btn-success">

<i class="fa fa-save"></i>
Save Slider Image

</button>

<a href="{{ route('admin.home-brand-section-images.index') }}"
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