<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">

@include('owner.layout.head')

<link rel="stylesheet" href="{{ asset('css/register/myCstm.css') }}" />
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
                            <!-- Form إضافة category -->
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('messages.add_category') }}</h5>
                                    <form action="{{ route('category.add') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-5">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="{{ __('messages.name') }}" required>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="file" name="image" class="form-control"
                                                    accept="image/*" required>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit"
                                                    class="btn btn-primary w-100">{{ __('messages.save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- جدول عرض categories -->
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('messages.categories_list') }}</h5>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.name') }}</th>
                                                <th>{{ __('messages.image') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ __('messages.' . $category->name) == 'messages.' . $category->name ? str_replace('_', ' ', $category->name) : __('messages.' . $category->name) }}</td>
                                                    <td>
                                                        <img src="{{ asset($category->path) }}" alt="Image"
                                                            width="60" height="60" class="rounded" loading="lazy">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
</body>

</html>
