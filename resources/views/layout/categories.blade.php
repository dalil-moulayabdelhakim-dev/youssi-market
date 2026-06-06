<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @isset($categories)
                    @foreach ($categories as $category)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{$category->path}}">
                                <h5><a href="#">{{ __('messages.' . $category->name) }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->
