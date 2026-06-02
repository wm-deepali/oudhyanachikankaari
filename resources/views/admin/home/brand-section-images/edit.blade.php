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
Edit Slider Image
</li>

</ol>

</div>

</div>

<div class="content-wrapper pb-4">

<div class="card shadow-sm">

<div class="card-header">
<strong>Edit Slider Image</strong>
</div>

<div class="card-body">

<form method="POST"
      action="{{ route('admin.home-brand-section-images.update',$item->id) }}"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="row">

<div class="col-sm-12 mb-3">

<img src="{{ asset('storage/'.$item->image) }}"
     width="150"
     class="img-thumbnail">

</div>

<div class="col-sm-6 form-group">

<label>Replace Image</label>

<input type="file"
       name="image"
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

<div class="mt-4">

<button type="submit"
        class="btn btn-success">

<i class="fa fa-save"></i>
Update Slider Image

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