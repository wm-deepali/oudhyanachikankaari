  @forelse($occasions as $occasion)

                                <div class="aqf-collection-item p-relative" style="cursor: pointer;">
                                    <div class="aqf-collection-thumb">

                                        <img src="{{ $occasion->image ? asset('storage/' . $occasion->image) : asset('assets/img/no-image.png') }}"
                                            alt="{{ $occasion->title }}" loading="lazy" />

                                    </div>

                                    <div class="aqf-collection-content-wrap d-flex align-items-center justify-content-between">

                                        <div class="aqf-collection-content">

                                            <h4 class="aqf-collection-title">
                                                <a href="{{ route('products', ['occasion' => $occasion->slug]) }}">
                                                    {{ $occasion->title }}
                                                </a>
                                            </h4>

                                            <span>{{ $occasion->sub_title }}</span>

                                        </div>

                                        <div class="aqf-collection-link-wrap">
                                            <a class="aqf-collection-link" href="{{ route('products', ['occasion' => $occasion->slug]) }}">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        viewBox="0 0 12 12" fill="none">
                                                        <path d="M0.75 5.75H10.75M10.75 5.75L5.75 0.75M10.75 5.75L5.75 10.75"
                                                            stroke="currentcolor" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                        </path>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            @empty

                                <div class="col-12 text-center">
                                    <p>No occasions found.</p>
                                </div>

                            @endforelse