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
                            <!-- Profits Card -->
                            <div class="col-md-12 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0">{{ __('messages.profits_summary') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="card bg-primary text-white text-center p-3">
                                                    <h6>{{ __('messages.total_profits') }}</h6>
                                                    <h3>{{ number_format($total_commissions, 2) }} DA</h3>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div id="profitsTrendChart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category Sales Distribution -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5 class="card-title m-0">{{ __('messages.category_distribution') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="categorySalesChart"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Top Stores by Commission -->
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-header">
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
            const labelColor = '#a1b0cb';
            
            // 1. Profits Trend Chart
            const commTrend = @json($commissions_trend);
            const lineOptions = {
                chart: { height: 300, type: 'line', toolbar: { show: false } },
                series: [{ name: "{{ __('messages.profits') }}", data: commTrend.map(i => i.total) }],
                xaxis: { categories: commTrend.map(i => i.date), labels: { style: { colors: labelColor } } },
                colors: ['#696cff'],
                stroke: { curve: 'smooth' }
            };
            new ApexCharts(document.querySelector("#profitsTrendChart"), lineOptions).render();

            // 2. Category Sales Chart (Donut)
            const catSales = @json($category_sales);
            const donutOptions = {
                chart: { height: 350, type: 'donut' },
                labels: catSales.map(i => i.name),
                series: catSales.map(i => i.total_sales),
                colors: ['#696cff', '#71dd37', '#03c3ec', '#ffab00', '#ff3e1d'],
                legend: { position: 'bottom', labels: { colors: labelColor } }
            };
            new ApexCharts(document.querySelector("#categorySalesChart"), donutOptions).render();

            // 3. Top Sellers Chart (Bar)
            const topStores = @json($top_stores);
            const barOptions = {
                chart: { height: 350, type: 'bar', toolbar: { show: false } },
                series: [{ name: "{{ __('messages.commission') }}", data: topStores.map(i => i.total_commission) }],
                plotOptions: { bar: { borderRadius: 4, horizontal: true } },
                xaxis: { categories: topStores.map(i => i.name), labels: { style: { colors: labelColor } } },
                colors: ['#71dd37']
            };
            new ApexCharts(document.querySelector("#topSellersChart"), barOptions).render();
        });
    </script>
</body>

</html>
