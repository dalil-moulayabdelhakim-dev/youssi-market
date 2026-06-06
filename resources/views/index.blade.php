<!DOCTYPE html>
<html lang="zxx">
@include('layout.head')

<body>

    <link rel="stylesheet" href="{{asset('css/register/myCstm.css')}}" />
@include('popup')
    @include('layout.header')

    @include('layout.banner')

    @include('layout.featured_products')

    @include('layout.categories')

    {{-- <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End --> --}}

    {{-- @include('layout.last_product') --}}


    @include('layout.footer')

    @include('layout.scripts')
</body>

</html>
