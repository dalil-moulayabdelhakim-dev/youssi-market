<!DOCTYPE html>
<html lang="zxx">


@include('layout.head')

<body>
     <link rel="stylesheet" href="{{asset('css/register/myCstm.css')}}" />
@include('popup')
    @include('layout.header')

    @include('layout.sub_header')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product->title }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('/') }}">{{ __('messages.home') }}</a>
                            <span>{{ $product->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" style="max-height: 400px"
                                src="{{ $product->image }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ $product->image }}" src="{{ $product->image }}" alt="">
                            @isset($images)
                                @foreach ($images as $image)
                                    <img data-imgbigurl="{{ $image->path }}" src="{{ $image->path }}" alt="">
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->title }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 {{ __('messages.reviews') }})</span>
                        </div>
                        <div class="product__details__price">
                            {{ $product->price }}{{ __('messages.da') }}
                            <span
                                style="text-decoration: line-through; color: gray; font-size: 0.7em; margin-left: 10px;">
                                {{ $product->old_price }}{{ __('messages.da') }}
                            </span>

                        </div>
                        <div
                            style="margin-bottom: 2px;   display: inline-block; background-color: rgb(255, 196, 0); color: black; padding: 3px 8px; border-radius: 4px; font-size: 0.85em;">
                            -{{ round($product->discount_price) }}%
                        </div>

                        <p>{{ $product->description }}</p>
                        @isset($is_owner)
                            @isset($user_type)
                                @if (!$is_owner && $user_type != 2)
                                    @if ($product->quantity > 0)
                                        <form action="{{ route('cart-add') }}" method="POST">
                                            @csrf
                                            <div class="product__details__quantity">
                                                <div class="quantity">
                                                    <div class="">
                                                        <input type="number" value="1" name="quantity"
                                                            max="{{ $product->quantity }}">

                                                    </div>
                                                </div>
                                            </div>

                                            <button href="#"
                                                class="btn primary-btn">{{ __('messages.add_to_cart') }}</button>
                                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        </form>
                                    @else
                                         <div class="alert alert-danger text-center fw-bold">
    Sold out
</div>

                                    @endif
                                @endif
                            @else
                                <div class="alert alert-warning text-center rounded-lg shadow-sm border-0 p-3" role="alert" style="margin-top: 15px;">
                                    <i class="fa fa-info-circle mr-1"></i>
                                    {{ __('messages.you_must_login') }}
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-warning font-weight-bold shadow-sm rounded-pill ml-2 px-3 py-1">{{ __('messages.login') }}</a>
                                </div>
                            @endisset

                        @endisset
                        <ul>
                            <li><b>{{ __('messages.availability') }}</b> <span>{{ __('messages.in_stock') }}
                                    ({{ $product->quantity }})</span></li>
                            <li><b>{{ __('messages.shipping') }}</b> <span>{{ __('messages.one_day_shipping') }}
                                    <samp>{{ __('messages.free_pickup') }}</samp></span></li>
                            <li><b>{{ __('messages.share_on') }}</b>
                                <div class="share">
                                    <a href="https://www.facebook.com/profile.php?id=61570952016140"><i
                                            class="fa fa-facebook"></i></a>
                                    <a href="https://www.instagram.com/youssi_market/"><i
                                            class="fa fa-instagram"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">{{ __('messages.description') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ __('messages.product_information') }}</h6>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>{{ __('messages.related_products') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($relatedProducts->isEmpty())
                    <div class="col-12 text-center text-muted">
                        <p>{{ __('messages.no_related_products') }}</p>
                    </div>
                @else
                    @foreach($relatedProducts as $related)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ $related->image }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="{{ route('products.details', $related->id) }}"><i class="fa fa-inbox"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('products.details', $related->id) }}">{{ $related->title }}</a></h6>
                                    <h5>{{ $related->price }} {{ __('messages.da') }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    @include('layout.footer')

    @include('layout.scripts')

</body>

</html>
