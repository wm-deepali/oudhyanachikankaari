@forelse($categories as $category)
    <div class="col">
        <div class="aqf-categories-item text-center">
            <a href="{{ route('category.products', $category->slug) }}">

                <div class="aqf-categories-img">
                    <img src="{{ $category->image
            ? asset('storage/' . $category->image)
            : asset('assets/img/no-image.png') }}" alt="{{ $category->name }}" loading="lazy"
                        decoding="async">
                </div>

                <span>{{ $category->name }}</span>

                <small class="d-block text-muted mt-1">
                    {{ $category->products_count }} Products
                </small>

            </a>
        </div>
    </div>
@empty
    <div class="col-12 text-center">
        <p>No categories found.</p>
    </div>
@endforelse