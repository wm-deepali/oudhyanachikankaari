@extends('layouts.app')

@section('content')

    <main class="aq-blog-page">

        <!-- 1. Luxury Inner Banner / Hero Section -->
        <section class="aq-catpage-hero">
            <div class="aq-hero-glow"></div>
            <div class="aq-floating-gift-box aq-floating-shape-1">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="aq-floating-gift-box aq-floating-shape-2">
                <i class="fa-regular fa-pen-to-square"></i>
            </div>
            <div class="aq-catpage-hero-content">
                <h1 class="aq-catpage-title">Our Blog</h1>
                <div class="aq-catpage-breadcrumbs">
                    <a href="index.html">Home</a>
                    <span>/</span>
                    <span>Blog</span>
                </div>
            </div>
        </section>

        <!-- Blog Main Content Wrapper -->
        <div class="aq-blog-page-wrap">
            <section class="aq-blog-section">
                <div class="container">

                    <!-- Section Heading -->
                    <div class="row justify-content-center text-center mb-50">
                        <div class="col-lg-8">
                            <span class="aq-section-title-sm aq-blog-title-sm">Gifting Insights</span>
                            <h2 class="aq-section-title aq-blog-main-title">Stories, Tips & Trends</h2>
                            <p class="aq-section-desc aq-blog-desc">
                                Dive into the world of luxury corporate gifting. Discover the latest trends, employee
                                engagement strategies, and curated gift guides.
                            </p>
                        </div>
                    </div>

                    <div class="row g-5">

                        @forelse($blogs as $blog)

                            <div class="col-lg-4 col-md-6">

                                <div class="aq-blog-card">

                                    <div class="aq-blog-img-wrap">

                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                            class="blog-img-hover" />

                                        <div class="aq-blog-category">
                                            Blog
                                        </div>

                                    </div>

                                    <div class="aq-blog-content">

                                        <div class="aq-blog-meta">

                                            <span>
                                                <i class="fa-regular fa-calendar-days aq-blog-icon"></i>
                                                {{ $blog->created_at->format('M d, Y') }}
                                            </span>
                                            @php 
                                                $wordCount = str_word_count(strip_tags($blog->content));
                                                $readTime = max(1, ceil($wordCount / 200)); // 200 words per minute
                                            @endphp

                                            <span>
                                                <i class="fa-regular fa-clock aq-blog-icon"></i>
                                                {{ $readTime }} Min Read
                                            </span>

                                        </div>

                                        <h3 class="aq-blog-title">

                                            <a href="{{ route('blog.details', $blog->slug) }}">
                                                {{ $blog->title }}
                                            </a>

                                        </h3>

                                        <p class="aq-blog-excerpt">

                                            {{ Str::limit(strip_tags($blog->short_description), 120) }}

                                        </p>

                                        <a href="{{ route('blog.details', $blog->slug) }}" class="aq-blog-read-more">

                                            Read Article
                                            <i class="fa-solid fa-arrow-right-long"></i>

                                        </a>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="col-12 text-center">
                                <h4>No Blogs Found</h4>
                            </div>

                        @endforelse

                    </div>


                    <!-- Pagination (Optional Layout Element) -->
                    @if($blogs->hasPages())

                        <div class="row mt-50">
                            <div class="col-12 text-center">

                                <div class="aq-pagination">

                                    {{-- Left Arrow --}}
                                    @if($blogs->currentPage() > 1)
                                        <a href="{{ $blogs->previousPageUrl() }}">
                                            <i class="fa-solid fa-angle-left"></i>
                                        </a>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @foreach(range(1, $blogs->lastPage()) as $page)

                                        <a href="{{ $blogs->url($page) }}"
                                            class="{{ $page == $blogs->currentPage() ? 'active' : '' }}">
                                            {{ $page }}
                                        </a>

                                    @endforeach

                                    {{-- Right Arrow --}}
                                    @if($blogs->hasMorePages())
                                        <a href="{{ $blogs->nextPageUrl() }}">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                    @endif

                                </div>

                            </div>
                        </div>

                    @endif


                </div>
            </section>
        </div>

    </main>


@endsection