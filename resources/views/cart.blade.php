<!DOCTYPE html>
<html lang="zxx">

@include('layout.head')

<body>


    <link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
    @include('popup')

    @include('layout.header')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>{{ __('messages.all_departments') }}</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    {{ __('messages.all_categories') }}
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="{{ __('messages.search_placeholder') }}">
                                <button type="submit" class="site-btn">{{ __('search') }}</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{ optional($admin_info)->phone }}</h5>
                                <span>{{ __('messages.support') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('messages.shopping_cart') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">{{ __('messages.home') }}</a>
                            <span>{{ __('messages.shopping_cart') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">{{ __('messages.product') }}</th>
                                    <th>{{ __('messages.price') }}</th>
                                    <th>{{ __('messages.quantity') }}</th>
                                    <th>{{ __('messages.total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($cart)
                                    @if ($cart->count() > 0)
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td class="shoping__cart__item">
                                                    <img style="width: 100px; height: 100px;;"
                                                        src="{{ $item->product->image }}" alt="">
                                                    <h5>{{ $item->product->title }}</h5>
                                                </td>
                                                <td class="shoping__cart__price">
                                                    {{ $item->product->price }} {{ __('messages.da') }}

                                                </td>
                                                <td class="shoping__cart__quantity">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="{{ $item->quantity }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="shoping__cart__total">
                                                    {{ $item->total }} {{ __('messages.da') }}
                                                </td>
                                                <td class="shoping__cart__item__close">
                                                    <span class="icon_close"></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="bg-light">
                                            <td></td>
                                            <td></td>
                                            <td>{{ __('messages.empty') }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif

                                @endisset


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">{{ __('messages.continue_shopping') }}</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            {{ __('messages.update_cart') }}</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>{{ __('messages.discount_codes') }}</h5>
                            <form action="#">
                                <input type="text" placeholder="{{ __('messages.coupon_code_placeholder') }}">
                                <button type="submit" class="site-btn">{{ __('messages.apply_coupon') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>{{ __('messages.cart_total') }}</h5>

                        <form action="{{ route('cart-checkout') }}" method="POST">
                            @csrf
                            <ul>
                                @php
                                    $total = 0;
                                    foreach ($cart as $cart_item) {
                                        $total += $cart_item->total;
                                    }
                                @endphp
                                <li>
                                    {{ __('messages.subtotal') }}
                                    <span id="subtotal">{{ $total }} {{ __('messages.da') }}</span>
                                </li>
                                {{--
                            <li>
                                {{ __('messages.wilaya') }}
                                <select id="wilayaSelect" class="form-select">
                                    <option value="" data-home="0" data-office="0" selected disabled>
                                        {{ __('messages.choose_wilaya') }}
                                    </option>
                                    @foreach ($storeWilayas as $wilaya)
                                        <option value="{{ $wilaya->id }}"
                                            data-home="{{ $wilaya->pivot->home_price }}"
                                            data-office="{{ $wilaya->pivot->office_price }}">
                                            {{ $wilaya->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </li> --}}

                                <li>
                                    {{ __('messages.delivery_place') }}
                                    <div class="mt-2">
                                        <label>
                                            <input type="radio" name="delivery_place" value="1" checked>
                                            {{ __('messages.delivery_places.home') }}
                                        </label><br>
                                        <label>
                                            <input type="radio" name="delivery_place" value="0">
                                            {{ __('messages.delivery_places.office') }}
                                        </label>
                                    </div>
                                </li>

                                <li>
                                    {{ __('messages.total') }}
                                    <span id="total">{{ $total }} {{ __('messages.da') }}</span>
                                </li>

                                {{-- <li>
                                {{ __('messages.checkout') }}
                                <span>{{ __('messages.upon_receipt') }}</span>
                            </li> --}}
                            </ul>
                            <input type="hidden" name="grand_total" id="grand_total" value="{{ $total }}">

                            <button type="submit" class="btn primary-btn">{{ __('messages.checkout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    @include('layout.footer')

    @include('layout.scripts')

    {{-- <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const subtotal = parseFloat("{{ $cart->sum('total') }}");
        //     const wilayaSelect = document.getElementById('wilayaSelect');
        //     const radios = document.querySelectorAll('input[name="delivery"]');

        //     const deliveryPriceSpan = document.getElementById('deliveryPrice');
        //     const grandTotalSpan = document.getElementById('grandTotal');

        //     const deliveryTypeInput = document.getElementById('delivery_type');
        //     const deliveryPriceInput = document.getElementById('delivery_price');
        //     const grandTotalInput = document.getElementById('grand_total');
        //     const wilayaIdInput = document.getElementById('wilaya_id');

        //     function updateTotal() {
        //         const selected = wilayaSelect.options[wilayaSelect.selectedIndex];
        //         if (!selected) return;

        //         const deliveryType = document.querySelector('input[name="delivery"]:checked').value;
        //         const deliveryPrice = parseFloat(selected.dataset[deliveryType]) || 0;
        //         const total = subtotal + deliveryPrice;

        //         deliveryPriceSpan.textContent = deliveryPrice + " {{ __('messages.da') }}";
        //         grandTotalSpan.textContent = total + " {{ __('messages.da') }}";

        //         deliveryTypeInput.value = deliveryType;
        //         deliveryPriceInput.value = deliveryPrice;
        //         grandTotalInput.value = total;
        //         wilayaIdInput.value = selected.value;
        //     }

        //     wilayaSelect.addEventListener('change', updateTotal);
        //     radios.forEach(radio => radio.addEventListener('change', updateTotal));
        // });
    </script> --}}


</body>

</html>
