<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">

@include('owner.layout.head')
<link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
@include('popup')

<style>
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .image-box {
        position: relative;
        width: 100px;
        height: 100px;
    }

    .image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 14px;
        line-height: 20px;
        text-align: center;
        cursor: pointer;
        z-index: 1;
    }
</style>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{route('/')}}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <span class="text-primary">
                                <img style="width: 80%" src="{{ asset('img/logo.jpg') }}">
                            </span>
                        </span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left d-block d-xl-none align-middle"></i>
                    </a>
                </div>

                <div class="menu-divider mt-0"></div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item ">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-smile"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.dashboard') }}</div>
                        </a>
                    </li>

                    <li class="menu-item open active">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-package"></i>
                            <div class="text-truncate" data-i18n="Dashboards">{{ __('messages.products') }}</div>
                            {{-- <span class="badge rounded-pill bg-danger ms-auto">5</span> --}}
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('products.add-view') }}" class="menu-link">
                                    <div class="text-truncate" data-i18n="Analytics">{{ __('messages.add_product') }}
                                    </div>
                                </a>
                            </li>

                            <li class="menu-item active">
                                <a href="" class="menu-link">
                                    <div class="text-truncate" data-i18n="Analytics">{{ __('messages.view_product') }}
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('category.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-category"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.categories') }}</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('order.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.orders') }}</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('wilaya.add-view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-mail-send"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.delivery') }}</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('owner-payouts.view') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-wallet"></i>
                            <div class="text-truncate" data-i18n="Basic">{{ __('messages.payout_requests') }}</div>
                        </a>
                    </li>


                </ul>
                <div class="mt-auto p-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 d-flex align-items-center">
                            <i class="bx bx-log-out me-2"></i>
                            <span>{{ __('messages.logout') }}</span>
                        </button>
                    </form>
                </div>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->


                @include('owner.layout.nav-bar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">

                            <div class="col-12 col-md-8 col-lg-12 col-xxl-4 order-3 order-md-2 profile-report">
                                <div class="row">
                                    <!-- Striped Rows -->
                                    <div class="card">
                                        <h5 class="card-header">{{ __('messages.products') }}</h5>
                                        <div class="table-responsive text-nowrap">
                                            <div class="mb-3">
                                                {{ $products->links('pagination::bootstrap-5') }}
                                            </div>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('messages.image') }}</th>
                                                        <th>{{ __('messages.title') }}</th>
                                                        <th>{{ __('messages.type') }}</th>
                                                        <th>{{ __('messages.category') }}</th>
                                                        <th>{{ __('messages.price') }}</th>
                                                        <th>{{ __('messages.discount') }}</th>
                                                        <th>{{ __('messages.old_price') }}</th>
                                                        <th>{{ __('messages.quantity') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    @isset($products)
                                                        @foreach ($products as $product)
                                                            <tr>
                                                                <td>
                                                                    <img class="icon-xxl me-4"
                                                                        src="{{ asset($product->image) }}" alt="product"
                                                                        loading="lazy">

                                                                </td>
                                                                <td>{{ $product->title }}</td>
                                                                <td>{{ __('messages.' . $product->type) }}</td>
                                                                <td>
                                                                    {{ optional($product->category)->name ? (__('messages.' . $product->category->name) == 'messages.' . $product->category->name ? str_replace('_', ' ', $product->category->name) : __('messages.' . $product->category->name)) : '—' }}
                                                                </td>
                                                                <td>
                                                                    {{ $product->price }} DA
                                                                </td>
                                                                <td>{{ $product->discount_price }} %</td>
                                                                <td>{{ $product->old_price }} DA</td>
                                                                <td>{{ $product->quantity }}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button"
                                                                            class="btn p-0 dropdown-toggle hide-arrow"
                                                                            data-bs-toggle="dropdown">
                                                                            <i
                                                                                class="icon-base bx bx-dots-vertical-rounded"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item"
                                                                                href="{{ route('products.details', $product->id) }}"
                                                                                target="_blank"><i
                                                                                    class="icon-base bx bx-box me-1"></i>
                                                                                {{ __('messages.preview') }}</a>
                                                                            <button type="button" class="dropdown-item"
                                                                                id="view-btn" data-bs-toggle="modal"
                                                                                data-bs-target="#modalTop"
                                                                                data-url="{{ config('app.url') }}"
                                                                                onclick="fetchUserData({{ $product->id }})">
                                                                                <i
                                                                                    class="icon-base bx bx-edit-alt me-1"></i>
                                                                                {{ __('messages.edit') }}
                                                                            </button>
                                                                            <a class="dropdown-item"
                                                                                href="javascript:void(0);"><i
                                                                                    class="icon-base bx bx-trash me-1"></i>
                                                                                {{ __('messages.remove') }}</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    @endisset
                                                </tbody>
                                            </table>
                                            <div class="mt-3">
                                                {{ $products->links('pagination::bootstrap-5') }}
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Striped Rows -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Modal -->
                    <div class="modal modal-top fade" id="modalTop" tabindex="-1">
                        <div class="modal-dialog modal-lg ">
                            <form style="padding: 20px" class="modal-content"
                                action="{{ route('products.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTopTitle">
                                        {{ __('messages.edit_product_information') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="name">{{ __('messages.title') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="title" class="form-control" id="title"
                                                required />
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="category">{{ __('messages.category') }}</label>
                                        <div class=" col-sm-10">
                                            <select class="form-select" name="category_id" id="category_id"
                                                aria-label="Default select example" required>
                                                <option selected="">{{ __('messages.select_menu') }}</option>
                                                @isset($categories)
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ __('messages.' . $category->name) == 'messages.' . $category->name ? str_replace('_', ' ', $category->name) : __('messages.' . $category->name) }} </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </DIV>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="old_price">{{ __('messages.old_price') }}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="old_price" id="old_price"
                                                    class="form-control" required />
                                                <span class="input-group-text">DA</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="price">{{ __('messages.price') }}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="price" id="price"
                                                    class="form-control" required />
                                                <span class="input-group-text">DA</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="discount">{{ __('messages.discount') }}</label>
                                        <div class="col-sm-10">
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="discount_price" id="discount"
                                                    class="form-control" readonly required />
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="basic-default-phone">{{ __('messages.quantity') }}</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="quantity" id="quantity" required
                                                class="form-control phone-mask" value="0" />
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="discription">{{ __('messages.description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea id="discription" name="description" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="image">{{ __('messages.image') }}</label>
                                        <div class=" col-sm-10">
                                            <input type="file" name="image" id="image"
                                                class="form-control">
                                        </div>
                                        <div id="image-preview2" class="preview-container">
                                        </div>
                                    </DIV>

                                    <div class="row mb-6">
                                        <label class="col-sm-2 col-form-label"
                                            for="images">{{ __('messages.gallery') }}</label>
                                        <div class=" col-sm-10">
                                            <input type="file" name="images[]" id="images"
                                                class="form-control" multiple accept="image/*">
                                        </div>

                                        <!-- معاينة الصور -->
                                        <div id="gallery-preview" class="preview-container">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                        {{ __('messages.close') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Footer -->
                    @include('owner.layout.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    @include('owner.layout.scripts')

    <script>
        function fetchUserData(id) {
            const url = $('#view-btn').data('url');
            fetch(`/api/product/edit/${id}`)
                .then(response => response.json())
                .then(data => {
                    // === Hidden input للـ ID ===
                    let form = document.querySelector('form');
                    let hiddenId = form.querySelector('input[name="id"]');
                    if (!hiddenId) {
                        hiddenId = document.createElement('input');
                        hiddenId.type = 'hidden';
                        hiddenId.name = 'id';
                        form.appendChild(hiddenId);
                    }
                    hiddenId.value = id; // نبعث الـ id للسيرفر

                    // === Fill inputs ===
                    $('#title').val(data.title);
                    $('#old_price').val(data.old_price);
                    $('#price').val(data.price);
                    $('#discount').val(data.discount);
                    $('#quantity').val(data.quantity);
                    $('#discription').val(data.description); // صححتها هنا
                    $('#category_id').val(data.category_id);

                    // === Banner Image Preview ===
                    const bannerPreview = document.getElementById("image-preview2");
                    bannerPreview.innerHTML = '';

                    const box = document.createElement('div');
                    box.classList.add('image-box');

                    const bannerImg = document.createElement("img");
                    bannerImg.src = url + '/' + data.image;
                    bannerImg.alt = "Banner Image";

                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('remove-btn');
                    removeBtn.textContent = '×';

                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        box.remove();

                        // Hidden input للبانر المحذوف
                        let hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'removed_banner';
                        hiddenInput.value = data.image;
                        form.appendChild(hiddenInput);
                    });

                    box.appendChild(bannerImg);
                    box.appendChild(removeBtn);
                    bannerPreview.appendChild(box);

                    // === Gallery Images Preview ===
                    const galleryPreview = document.getElementById("gallery-preview");
                    galleryPreview.innerHTML = '';

                    data.images.forEach((imgUrl) => {
                        const box2 = document.createElement('div');
                        box2.classList.add('image-box');

                        const img = document.createElement("img");
                        img.src = url + '/' + imgUrl;
                        img.alt = "Product Image";

                        const removeBtn2 = document.createElement('button');
                        removeBtn2.classList.add('remove-btn');
                        removeBtn2.textContent = '×';

                        removeBtn2.addEventListener('click', function(e) {
                            e.preventDefault();
                            box2.remove();

                            // Hidden input لكل صورة محذوفة
                            let hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'removed_images[]';
                            hiddenInput.value = imgUrl;
                            form.appendChild(hiddenInput);
                        });

                        box2.appendChild(img);
                        box2.appendChild(removeBtn2);
                        galleryPreview.appendChild(box2);
                    });
                })
                .catch(error => console.log('Error fetching user data:', error));
        }
    </script>
</body>

</html>
