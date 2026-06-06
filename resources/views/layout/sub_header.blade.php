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
                    <ul class="categories-scroll">
                        @isset($categories)
                            @foreach ($categories as $category)
                                <li><a href="#">{{ __('messages.' . $category->name) }}</a></li>
                            @endforeach
                        @endisset


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
                            <button type="submit" class="site-btn">{{ __('messages.search') }}</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5> @isset($admin_info)
                                    {{$admin_info->phone}}
                                @endisset</h5>
                            <span>{{ __('messages.support') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
