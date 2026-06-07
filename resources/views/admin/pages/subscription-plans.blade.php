<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">

@include('owner.layout.head')

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
                        <h4 class="py-3 mb-4">
                            <span class="text-muted fw-light">{{ __('messages.dashboard') }} /</span> {{ __('messages.subscription_plans') }}
                        </h4>

                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ __('messages.manage_plans') }}</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPlanModal">
                                    <i class="bx bx-plus me-1"></i> {{ __('messages.add_new_plan') }}
                                </button>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('messages.name') }}</th>
                                            <th>{{ __('messages.price') }}</th>
                                            <th>{{ __('messages.duration_days') }}</th>
                                            <th>{{ __('messages.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach($plans as $plan)
                                        <tr>
                                            <td><strong>{{ $plan->name }}</strong></td>
                                            <td>{{ $plan->price }} DA</td>
                                            <td>{{ $plan->duration_days }} {{ __('messages.days') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);" 
                                                           data-bs-toggle="modal" data-bs-target="#editPlanModal{{ $plan->id }}">
                                                            <i class="bx bx-edit-alt me-1"></i> {{ __('messages.edit') }}
                                                        </a>
                                                        <form action="{{ route('admin-subscription-plans.delete', $plan->id) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="bx bx-trash me-1"></i> {{ __('messages.delete') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <!-- Edit Plan Modal -->
                                                <div class="modal fade" id="editPlanModal{{ $plan->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form action="{{ route('admin-subscription-plans.update', $plan->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{ __('messages.edit_plan') }}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{ __('messages.name') }}</label>
                                                                        <input type="text" name="name" class="form-control" value="{{ $plan->name }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{ __('messages.price') }}</label>
                                                                        <input type="number" name="price" class="form-control" value="{{ $plan->price }}" required>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{ __('messages.duration_days') }}</label>
                                                                        <input type="number" name="duration_days" class="form-control" value="{{ $plan->duration_days }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                                                    <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Add Plan Modal -->
                    <div class="modal fade" id="addPlanModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin-subscription-plans.add') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('messages.add_new_plan') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.internal_name') }} (e.g. basic, premium)</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.price') }}</label>
                                            <input type="number" name="price" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.duration_days') }}</label>
                                            <input type="number" name="duration_days" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.display_name_en') }}</label>
                                            <input type="text" name="display_name_en" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.display_name_ar') }}</label>
                                            <input type="text" name="display_name_ar" class="form-control" dir="rtl">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('messages.add_plan') }}</button>
                                    </div>
                                </form>
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

    @include('owner.layout.scripts')
</body>

</html>
