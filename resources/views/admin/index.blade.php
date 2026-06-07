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
                        <!-- Top KPI Cards Row -->
                        <div class="row mb-4">
                            <!-- Card 1: Users -->
                            <div class="col-sm-6 col-lg-3 mb-4">
                                <div class="card card-border-shadow-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="avatar me-3">
                                                <span class="avatar-initial rounded bg-label-primary p-2 d-flex align-items-center justify-content-center"><i class="bx bx-user bx-sm text-primary"></i></span>
                                            </div>
                                            <h4 class="mb-0">{{$all_users_number ?? 0}}</h4>
                                        </div>
                                        <p class="mb-1 text-muted">{{ __('messages.all_users') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 2: Owners -->
                            <div class="col-sm-6 col-lg-3 mb-4">
                                <div class="card card-border-shadow-info h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="avatar me-3">
                                                <span class="avatar-initial rounded bg-label-info p-2 d-flex align-items-center justify-content-center"><i class="bx bx-store bx-sm text-info"></i></span>
                                            </div>
                                            <h4 class="mb-0">{{$owners_number ?? 0}}</h4>
                                        </div>
                                        <p class="mb-1 text-muted">{{ __('messages.owners') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 3: Subscription Requests -->
                            <div class="col-sm-6 col-lg-3 mb-4">
                                <div class="card card-border-shadow-warning h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="avatar me-3">
                                                <span class="avatar-initial rounded bg-label-warning p-2 d-flex align-items-center justify-content-center"><i class="bx bx-credit-card bx-sm text-warning"></i></span>
                                            </div>
                                            <h4 class="mb-0">{{$payment_requests_number ?? 0}}</h4>
                                        </div>
                                        <p class="mb-1 text-muted">{{ __('messages.subscription_requests') }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Card 4: Total Revenue -->
                            <div class="col-sm-6 col-lg-3 mb-4">
                                <div class="card card-border-shadow-success h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="avatar me-3">
                                                <span class="avatar-initial rounded bg-label-success p-2 d-flex align-items-center justify-content-center"><i class="bx bx-dollar-circle bx-sm text-success"></i></span>
                                            </div>
                                            <h4 class="mb-0">{{$total_commissions ?? 0}} {{ __('messages.da') }}</h4>
                                        </div>
                                        <p class="mb-1 text-muted">{{ __('messages.total_commissions') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Expiry Alerts -->
                        <div class="card mb-4 border border-warning shadow-none">
                            <div class="card-header bg-label-warning py-3 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-warning fw-semibold">
                                    <i class="bx bx-error me-2"></i> {{ __('messages.subscription_expiry_alerts') }}
                                </h5>
                                <span class="badge bg-warning text-dark">{{ isset($expiring_stores) ? $expiring_stores->count() : 0 }}</span>
                            </div>
                            <div class="card-body pt-3">
                                @if(isset($expiring_stores) && $expiring_stores->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.store_name') }}</th>
                                                    <th>{{ __('messages.store_contact') }}</th>
                                                    <th>{{ __('messages.status') }}</th>
                                                    <th>{{ __('messages.expiry_date') }}</th>
                                                    <th>{{ __('messages.days_left') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($expiring_stores as $store)
                                                    @php
                                                        $endDate = $store->subscription_status == 'trial' ? $store->trial_ends_at : $store->subscription_ends_at;
                                                        $endDateCarbon = \Illuminate\Support\Carbon::parse($endDate);
                                                        $daysLeft = now()->diffInDays($endDateCarbon, false);
                                                        $daysLeft = ceil($daysLeft);
                                                    @endphp
                                                    <tr>
                                                        <td class="fw-bold">{{ $store->name }}</td>
                                                        <td>{{ $store->contact }}</td>
                                                        <td>
                                                            @if($store->subscription_status == 'trial')
                                                                <span class="badge bg-info text-white">{{ __('messages.trial') }}</span>
                                                            @else
                                                                <span class="badge bg-success text-white">{{ __('messages.active') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $endDateCarbon->format('Y-m-d') }}</td>
                                                        <td>
                                                            @if($daysLeft <= 1)
                                                                <span class="badge bg-danger text-white">{{ __('messages.expiring_soon') }} ({{ $daysLeft }}d)</span>
                                                            @else
                                                                <span class="badge bg-warning text-dark">{{ $daysLeft }} {{ __('messages.days_left') }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <p class="text-muted mb-0"><i class="bx bx-check-circle me-1 text-success"></i> {{ __('messages.no_expiring_subscriptions') }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Charts Section -->
                        <div class="row">
                            <!-- Trend Line Chart -->
                            <div class="col-12 col-lg-8 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0">{{ __('messages.commission_revenue_trends') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="commissionTrendChart"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Category Doughnut Chart -->
                            <div class="col-12 col-lg-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0">{{ __('messages.category_popularity') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="categoryPopularityChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Top Sellers Bar Chart -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0">{{ __('messages.top_5_sellers') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="topSellersChart"></div>
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

    <!-- Charts Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check direction
            const isRtl = document.documentElement.dir === 'rtl';

            // Theme colors
            const primaryColor = '#03c8e2';
            const successColor = '#71dd37';
            const infoColor = '#03c3ec';
            const warningColor = '#ffab00';
            const borderColor = '#f0f2f4';
            const labelColor = '#a1b0cb';
            const headingColor = '#566a7f';

            // Data passed from controller
            const trendData = @json($commissions_trend);
            const topStores = @json($top_stores);
            const catSales = @json($category_sales);

            // 1. Commission & Revenue Trend Line Chart
            const trendDates = trendData.map(item => item.date);
            const trendTotals = trendData.map(item => item.total);

            const trendOptions = {
                chart: {
                    height: 350,
                    type: 'area',
                    parentHeightOffset: 0,
                    toolbar: { show: false }
                },
                dataLabels: { enabled: false },
                stroke: { show: true, curve: 'smooth', width: 3, colors: [primaryColor] },
                legend: { show: false },
                markers: { size: 4, colors: [primaryColor], strokeColors: '#fff', strokeWidth: 2 },
                grid: {
                    borderColor: borderColor,
                    xaxis: { lines: { show: true } },
                    padding: { top: 0, bottom: 0, left: 10, right: 10 }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.15,
                        stops: [0, 90, 100]
                    }
                },
                series: [{
                    name: "{{ __('messages.total_commissions') }}",
                    data: trendTotals
                }],
                xaxis: {
                    categories: trendDates,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: labelColor, fontSize: '12px' }
                    }
                },
                yaxis: {
                    labels: {
                        style: { colors: labelColor, fontSize: '12px' },
                        formatter: function(value) { return value + " DA"; }
                    }
                },
                colors: [primaryColor],
                tooltip: {
                    theme: 'light',
                    x: { show: true }
                }
            };

            const trendChart = new ApexCharts(document.querySelector("#commissionTrendChart"), trendOptions);
            trendChart.render();

            // 2. Category Popularity Doughnut Chart
            const catLabels = catSales.map(item => item.name);
            const catTotals = catSales.map(item => item.total_sales);

            const catColors = ['#03c8e2', '#71dd37', '#ff3e1d', '#696cff', '#ffab00', '#233446', '#8592a3'];

            const catOptions = {
                chart: {
                    height: 350,
                    type: 'donut'
                },
                labels: catLabels.length ? catLabels : ["{{ __('messages.empty') }}"],
                series: catTotals.length ? catTotals : [0],
                colors: catColors,
                stroke: { width: 5, colors: ['#fff'] },
                dataLabels: { enabled: false },
                legend: {
                    show: true,
                    position: 'bottom',
                    labels: { colors: labelColor }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                value: {
                                    fontSize: '18px',
                                    fontWeight: 600,
                                    color: headingColor,
                                    formatter: function(val) { return parseInt(val) + " DA"; }
                                },
                                total: {
                                    show: true,
                                    label: "{{ __('messages.total') }}",
                                    color: labelColor,
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + " DA";
                                    }
                                }
                            }
                        }
                    }
                }
            };

            const catChart = new ApexCharts(document.querySelector("#categoryPopularityChart"), catOptions);
            catChart.render();

            // 3. Top 5 Sellers Bar Chart
            const sellerLabels = topStores.map(item => item.name);
            const sellerTotals = topStores.map(item => item.total_commission);

            const barOptions = {
                chart: {
                    height: 280,
                    type: 'bar',
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        barHeight: '50%',
                        distributed: true,
                        horizontal: true,
                        borderRadius: 4
                    }
                },
                grid: {
                    borderColor: borderColor,
                    xaxis: { lines: { show: true } },
                    padding: { top: -10, bottom: -10, left: 10, right: 10 }
                },
                colors: ['#71dd37', '#03c8e2', '#696cff', '#ffab00', '#ff3e1d'],
                dataLabels: { enabled: false },
                series: [{
                    name: "{{ __('messages.total_commissions') }}",
                    data: sellerTotals
                }],
                xaxis: {
                    categories: sellerLabels.length ? sellerLabels : ["{{ __('messages.no_store') }}"],
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: { colors: labelColor, fontSize: '12px' },
                        formatter: function(val) { return val + " DA"; }
                    }
                },
                yaxis: {
                    labels: {
                        style: { colors: labelColor, fontSize: '12px' }
                    }
                },
                legend: { show: false }
            };

            const barChart = new ApexCharts(document.querySelector("#topSellersChart"), barOptions);
            barChart.render();
        });
    </script>
</body>
</html>
