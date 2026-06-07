<nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)" id="menuToggleBtn">
            <i class="icon-base bx bx-menu icon-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">


        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
            <!-- Place this tag where you want the button to render. -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <div class="d-flex align-items-center gap-4 dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{ asset('owner/assets/img/avatars/profile.jpg') }}" alt
                                class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('owner/assets/img/avatars/profile.jpg') }}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                        <small class="text-body-secondary">
                                            @if(Auth::user()->user_type_id == 1)
                                                {{ __('messages.admin') }}
                                            @elseif(Auth::user()->user_type_id == 2)
                                                {{ __('messages.seller') }}
                                            @else
                                                {{ __('messages.customer') }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider my-1"></div>
                        </li>
                        <li>
                            <form id="logout-form-navbar" method="POST" action="{{ route('logout') }}" class="d-none">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="document.getElementById('logout-form-navbar').submit();">
                                <i class="icon-base bx bx-power-off icon-md me-3"></i><span>{{ __('messages.logout') }}</span>
                            </a>
                        </li>
                    </ul>

                    <a href="{{ route('/') }}"
                        class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                        <i class="tf-icons bx bx-home"></i>
                    </a>
                </div>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
