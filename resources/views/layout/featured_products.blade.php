<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>{{ __('messages.products') }}</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <li data-filter=".product-item">{{__('messages.products')}}</li>
                        <li data-filter=".service-item">{{__('messages.services')}}</li>
                @isset($categories)
                            @foreach ($categories as $category)
                                <li data-filter=".{{ $category->name }}">{{ __('messages.' . $category->name) }}</li>
                            @endforeach

                        @endisset
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter" id="products">
            @isset($products)
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->category->name }}  {{ $product->type . '-item'}}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ $product->image }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="{{ route('products.details', $product->id) }}"><i
                                                class="fa fa-inbox"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="{{ route('products.details', $product->id) }}"
                                        class="title-link">{{ $product->title }}</a></h6>
                                @if ((float)$product->discount_price > 0)
                                    <span
                                        style="background-color: #ffc107; color: black; font-size: 12px; padding: 2px 6px; border-radius: 4px; font-weight: bold;">
                                        -{{ round($product->discount_price) }}%
                                    </span>
                                @endif
                                <div
                                    style="display: flex; align-items: center; justify-content: center; gap: 10px; margin: 5px;">
                                    <h5 class ="price_text"style="margin: 0;">{{ $product->price }} {{ __('messages.da') }}
                                    </h5>
                                    @if ($product->old_price)
                                        <small style="text-decoration: line-through; color: gray;">
                                            {{ $product->old_price }} {{ __('messages.da') }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endisset
        </div>
        <div class="row">
            <div class="pagination-wrapper">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
<!-- Featured Section End -->
