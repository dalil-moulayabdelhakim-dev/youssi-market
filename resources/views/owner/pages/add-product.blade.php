<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">


@include('owner.layout.head')

<link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
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

@include('popup')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('owner.layout.sidebar')
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

                                    <div class="col-xxl">
                                        <div class="card">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">{{ __('messages.add_product') }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('products.add') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row mb-6">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">{{ __('messages.title') }}</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="title" class="form-control"
                                                                id="basic-default-name" required />
                                                        </div>
                                                    </div>

                                                    <div class="row mb-6">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-name">{{ __('messages.type') }}</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-select" name="type"
                                                                id="exampleFormControlSelect1"
                                                                aria-label="Default select example" required>
                                                                <option value="product" selected="">{{ __('messages.product') }}
                                                                </option>
                                                                <option value="service" >{{ __('messages.service') }}
                                                                </option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-6">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-email">{{ __('messages.category') }}</label>
                                                        <div class=" col-sm-10">
                                                            <select class="form-select" name="category_id"
                                                                id="exampleFormControlSelect1"
                                                                aria-label="Default select example" required>
                                                                <option selected="">
                                                                    {{ __('messages.select_menu') }}
                                                                </option>
                                                                @isset($categories)
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ __('messages.' . $category->name) == 'messages.' . $category->name ? str_replace('_', ' ', $category->name) : __('messages.' . $category->name) }}
                                                                        </option>
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
                                                                <input type="text" name="discount_price"
                                                                    id="discount" class="form-control" readonly
                                                                    required />
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row mb-6">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-phone">{{ __('messages.quantity') }}</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" name="quantity"
                                                                id="basic-default-phone" required
                                                                class="form-control phone-mask" value="0" />
                                                        </div>
                                                    </div>

                                                    <div class="row mb-6">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="basic-default-message">{{ __('messages.description') }}</label>
                                                        <div class="col-sm-10">
                                                            <textarea id="basic-default-message" name="description" class="form-control" required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-6">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="image">{{ __('messages.image') }}</label>
                                                        <div class=" col-sm-10">
                                                            <input id="imageInput" type="file" name="image"
                                                                class="form-control" required>
                                                        </div>
                                                        <div id="image-preview2" class="preview-container">
                                                        </div>
                                                    </DIV>

                                                    <div class="row mb-6">
                                                        <label class="col-sm-2 col-form-label"
                                                            for="images">{{ __('messages.product_images') }}</label>
                                                        <div class=" col-sm-10">
                                                            <input type="file" name="images[]" id="images"
                                                                required class="form-control" multiple
                                                                accept="image/*">
                                                        </div>

                                                        <!-- معاينة الصور -->
                                                        <div id="image-preview" class="preview-container">
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-end">
                                                        <div class="col-sm-10">
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __('messages.send') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

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
        const input = document.getElementById('images');
        const input2 = document.getElementById('imageInput');
        const preview = document.getElementById('image-preview');
        const preview2 = document.getElementById('image-preview2');

        input.addEventListener('change', function() {
            preview.innerHTML = '';

            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const box = document.createElement('div');
                    box.classList.add('image-box');

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('remove-btn');
                    removeBtn.textContent = '×';

                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        box.remove();

                        // إزالة الصورة من input.files
                        const dt = new DataTransfer();
                        Array.from(input.files).forEach((f, i) => {
                            if (i !== index) dt.items.add(f);
                        });
                        input.files = dt.files;
                    });

                    box.appendChild(img);
                    box.appendChild(removeBtn);
                    preview.appendChild(box);
                };

                reader.readAsDataURL(file);
            });
        });

        input2.addEventListener('change', function() {
            preview2.innerHTML = '';

            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const box = document.createElement('div');
                    box.classList.add('image-box');

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('remove-btn');
                    removeBtn.textContent = '×';

                    removeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        box.remove();

                        // إزالة الصورة من input.files
                        const dt = new DataTransfer();
                        Array.from(input.files).forEach((f, i) => {
                            if (i !== index) dt.items.add(f);
                        });
                        input.files = dt.files;
                    });

                    box.appendChild(img);
                    box.appendChild(removeBtn);
                    preview2.appendChild(box);
                };

                reader.readAsDataURL(file);
            });
        });

        const priceInput = document.getElementById("price");
        const oldPriceInput = document.getElementById("old_price");
        const discountInput = document.getElementById("discount");

        function calculateDiscount() {
            const price = parseFloat(priceInput.value);
            const oldPrice = parseFloat(oldPriceInput.value);

            if (!isNaN(price) && !isNaN(oldPrice) && oldPrice > 0 && price <= oldPrice) {
                const discount = ((oldPrice - price) / oldPrice) * 100;
                discountInput.value = discount.toFixed(2);
            } else {
                discountInput.value = "";
            }
        }

        priceInput.addEventListener("input", calculateDiscount);
        oldPriceInput.addEventListener("input", calculateDiscount);
    </script>

</body>

</html>
