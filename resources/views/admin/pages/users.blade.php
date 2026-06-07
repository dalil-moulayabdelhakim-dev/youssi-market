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
            @include('admin.layout.sidebar')
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

                            <div class="col-12 ">
                                <!-- Striped Rows -->
                                <div class="card sticky-top mb-3 shadow-sm">
                                    <!-- 🔎 Search bar (sticky) -->
                                    <div class="d-flex align-items-center p-3 ">
                                        <span class="w-px-22 h-px-22"><i
                                                class="icon-base bx bx-search icon-md"></i></span>
                                        <input type="text" id="userSearch" class="form-control border-0"
                                            placeholder="{{ __('messages.search_by_name_or_id') }}...">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addUserModal">
                                            {{ __('messages.add_user') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="d-flex justify-content-center mb-4">
                                        {{ $users->links() }}
                                    </div>
                                    <h5 class="card-header">{{ __('messages.users') }}</h5>
                                    <div class="table-responsive text-nowrap">
                                        <table id="usersTable" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('messages.name') }}</th>
                                                    <th>{{ __('messages.email') }}</th>
                                                    <th>{{ __('messages.phone') }}</th>
                                                    <th>{{ __('messages.wilaya') }}</th>
                                                    <th>{{ __('messages.commune') }}</th>
                                                    <th>{{ __('messages.role') }}</th>
                                                    <th>{{ __('messages.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td><b>#{{ $user->id }}</b></td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>
                                                            @if($user->wilaya)
                                                                {{ app()->getLocale() === 'ar' ? ($user->wilaya->ar_name ?? $user->wilaya->name) : ($user->wilaya->name ?? $user->wilaya->ar_name) }}
                                                            @else
                                                                —
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($user->commune)
                                                                {{ app()->getLocale() === 'ar' ? ($user->commune->ar_name ?? $user->commune->name) : ($user->commune->name ?? $user->commune->ar_name) }}
                                                            @else
                                                                —
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @switch($user->user_type_id)
                                                                @case(1)
                                                                    {{ __('messages.admin') }}
                                                                @break

                                                                @case(2)
                                                                    {{ __('messages.seller') }}
                                                                @break

                                                                @case(3)
                                                                    {{ __('messages.customer') }}
                                                                @break

                                                                @default
                                                                    {{ __('messages.role_unknown') }}
                                                            @endswitch
                                                        </td>

                                                        <td>
                                                            <form action="{{ route('admin-users.status', $user->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                 @if ($user->status == 'active')
                                                                 <button class="btn btn-secondary btn-sm">
                                                                     {{ __('messages.suspend') }}
                                                                     </button>
                                                                 @else
                                                                 <button class="btn btn-success btn-sm">
                                                                     {{ __('messages.activate') }}
                                                                     </button>
                                                                  @endif
                                                            
                                                            </form>
                                                            @if ($user->user_type_id == 2)
                                                                <button type="button"
                                                                    class="btn btn-sm btn-info view-store"
                                                                    data-id="{{ $user->store->id }}">
                                                                    {{ __('messages.preview') }}
                                                                </button>
                                                            @else
                                                                <span class="text-muted">—</span>
                                                            @endif


                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="d-flex justify-content-center mt-4">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                                <!--/ Striped Rows -->
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
                    <div class="modal fade" id="storeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('messages.store_info') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="{{ __('messages.close') }}"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>{{ __('messages.name') }}:</strong> <span id="store_name"></span></p>
                                    <p><strong>{{ __('messages.category') }}:</strong> <span
                                            id="store_category"></span></p>
                                    <p><strong>{{ __('messages.address') }}:</strong> <span id="store_address"></span>
                                    </p>
                                    <p><strong>{{ __('messages.contact') }}:</strong> <span id="store_contact"></span>
                                    </p>
                                    <p><strong>{{ __('messages.subscription_status') }}:</strong> <span
                                            id="store_subscription_status"></span></p>
                                    <p><strong>{{ __('messages.expiry_date') }}:</strong> <span
                                            id="store_expiry_date"></span></p>

                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>{{ __('messages.manual_activation') }}</h5>
                                        
                                        <form action="{{ route('admin-store.deactivate') }}" method="POST" id="deactivateForm">
                                            @csrf
                                            <input type="hidden" name="store_id" id="deactivate_store_id">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bx bx-power-off me-1"></i> {{ __('messages.deactivate') }}
                                            </button>
                                        </form>
                                    </div>
                                    <form action="{{ route('admin-store.activate') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="store_id" id="activation_store_id">
                                        <div class="d-flex gap-2">
                                            <button type="submit" name="plan" value="monthly" class="btn btn-primary">
                                                <i class="bx bx-calendar me-1"></i> {{ __('messages.activate_monthly') }}
                                            </button>
                                            <button type="submit" name="plan" value="lifetime" class="btn btn-success">
                                                <i class="bx bx-infinite me-1"></i> {{ __('messages.activate_lifetime') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('messages.add_user') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="{{ __('messages.close') }}"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('admin-user.add') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="user-details">

                                            <!-- 🟢 بيانات شخصية -->
                                            <h4 class="mb-3">{{ __('messages.personal_details') }}</h4>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="role"
                                                        class="form-label">{{ __('messages.reason_for_joining') }}</label>
                                                    <select id="role" name="user_type" class="form-select"
                                                        onchange="toggleFields()">
                                                        <option value="3">{{ __('messages.customer') }}</option>
                                                        <option value="2">{{ __('messages.seller') }}</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="name"
                                                        class="form-label">{{ __('messages.full_name') }}</label>
                                                    <input id="name" type="text" name="name"
                                                        class="form-control"
                                                        placeholder="{{ __('messages.enter_your_name') }}" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="phone"
                                                        class="form-label">{{ __('messages.phone_number') }}</label>
                                                    <input id="phone" type="tel" pattern="[0-9]{10}"
                                                        name="phone" class="form-control"
                                                        placeholder="{{ __('messages.enter_your_phone_number') }}"
                                                        required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="email"
                                                        class="form-label">{{ __('messages.email') }}</label>
                                                    <input id="email" type="email" name="email"
                                                        class="form-control"
                                                        placeholder="{{ __('messages.enter_your_email') }}" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="wilaya"
                                                        class="form-label">{{ __('messages.wilaya') }}</label>
                                                    <select id="wilaya" name="wilaya_id" class="form-select"
                                                        required>
                                                        <option value="">{{ __('messages.select_wilaya') }}
                                                        </option>
                                                        @foreach ($wilayas as $wilaya)
                                                            @switch(config('app.locale'))
                                                                @case('ar')
                                                                    <option value="{{ $wilaya->id }}">
                                                                        {{ $wilaya->ar_name }}</option>
                                                                @break

                                                                @case('en')
                                                                    <option value="{{ $wilaya->id }}">
                                                                        {{ $wilaya->name }}</option>
                                                                @break

                                                                @default
                                                            @endswitch
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="commune"
                                                        class="form-label">{{ __('messages.commune') }}</label>
                                                    <select id="commune" name="commune_id" class="form-select"
                                                        required data-loading="{{ __('messages.loading') }}"
                                                        data-select="{{ __('messages.select_commune') }}">
                                                        <option value="">{{ __('messages.select_commune') }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label for="address"
                                                        class="form-label">{{ __('messages.address') }}</label>
                                                    <input id="address" type="text" name="address"
                                                        class="form-control"
                                                        placeholder="{{ __('messages.enter_your_address') }}">
                                                </div>

                                                <div class="col-md-6 mb-3" style="position: relative">
                                                    <label for="password"
                                                        class="form-label">{{ __('messages.password') }}</label>
                                                    <input id="password" type="password" name="password"
                                                        class="form-control"
                                                        placeholder="{{ __('messages.enter_your_password') }}"
                                                        required>
                                                </div>
                                                <div class="tooltip2 d-none" id="passwordTooltip">
                                                    {{ __('messages.password_uppercase') }}<br>
                                                    {{ __('messages.password_lowercase') }}<br>
                                                    {{ __('messages.password_digit') }}<br>
                                                    {{ __('messages.password_special') }}<br>
                                                    {{ __('messages.password_min_length') }}
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="password_confirmation"
                                                        class="form-label">{{ __('messages.confirm_password') }}</label>
                                                    <input id="password_confirmation" type="password"
                                                        name="password_confirmation" class="form-control"
                                                        placeholder="{{ __('messages.confirm_your_password') }}"
                                                        required>
                                                </div>
                                            </div>
                                            {{-- ========= store ========== --}}
                                            <div id="storeSection" class="mt-4 hidden">
                                                <h4 class="mb-3">{{ __('messages.store_details') }}</h4>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="store_name"
                                                            class="form-label">{{ __('messages.store_name') }}</label>
                                                        <input id="store_name" type="text" name="store_name"
                                                            class="form-control"
                                                            placeholder="{{ __('messages.enter_your_store_name') }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="store_category"
                                                            class="form-label">{{ __('messages.store_category') }}</label>
                                                        <input id="store_category" type="text"
                                                            name="store_category" class="form-control"
                                                            placeholder="{{ __('messages.enter_your_store_category') }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="store_address"
                                                            class="form-label">{{ __('messages.store_address') }}</label>
                                                        <input id="store_address" type="text" name="store_address"
                                                            class="form-control"
                                                            placeholder="{{ __('messages.enter_your_store_address') }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="store_contact"
                                                            class="form-label">{{ __('messages.store_contact') }}</label>
                                                        <input id="store_contact" type="text" name="store_contact"
                                                            class="form-control"
                                                            placeholder="{{ __('messages.enter_your_store_contact') }}">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label for="store_contact"
                                                            class="form-label">{{ __('messages.commission_rate') }}</label>
                                                        <input id="commission_rate" type="text" name="commission_rate"
                                                            class="form-control"
                                                            placeholder="{{ __('messages.enter_your_commission_rate') }}">
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label for="store_proof"
                                                            class="form-label">{{ __('messages.proof') }}</label>
                                                        <input id="store_proof" type="file" name="store_proof"
                                                            class="form-control" accept=".pdf,image/*,.doc,.docx"
                                                            placeholder="{{ __('messages.proof_of_ownership_or_commercial_activity') }}">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                            <button type="submit"
                                                class="btn btn-primary">{{ __('messages.register') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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

    <script src="{{ asset('js/auth/valider.js') }}"></script>
    @include('owner.layout.scripts')
    <script>
        document
            .getElementById("userSearch")
            .addEventListener("keyup", function() {
                let value = this.value.toLowerCase();
                let rows = document.querySelectorAll("#usersTable tbody tr");

                rows.forEach((row) => {
                    let id = row.cells[0].textContent.toLowerCase();
                    let name = row.cells[1].textContent.toLowerCase();
                    let email = row.cells[2].textContent.toLowerCase();
                    let phone = row.cells[3].textContent.toLowerCase();
                    let wilaya = row.cells[4].textContent.toLowerCase();
                    let commune = row.cells[5].textContent.toLowerCase();
                    let role = row.cells[6].textContent.toLowerCase();

                    if (
                        id.includes(value) ||
                        name.includes(value) ||
                        email.includes(value) ||
                        phone.includes(value) ||
                        wilaya.includes(value) ||
                        commune.includes(value) ||
                        role.includes(value)
                    ) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
    </script>


</body>

</html>
