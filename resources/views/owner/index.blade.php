<!doctype html>
<html lang="{{ config('app.locale') }}" dir="{{ config('app.locale') === 'ar' ? 'rtl' : 'ltr' }}"
    class="layout-menu-fixed layout-compact">


@include('owner.layout.head')

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

                            <div class="col-xxl-12 col-lg-12 col-md-12 order-1">
                                <div class="row">
                                    <!-- Orders -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="{{ route('order.view') }}">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/chart-success.png') }}"
                                                                alt="Orders" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.orders') }}</p>
                                                    <h4 class="card-title mb-2">{{ $orders_number ?? 0 }}</h4>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Products -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="{{ route('products.view') }}">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/product.png') }}"
                                                                alt="Products" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.products') }}</p>
                                                    <h4 class="card-title mb-2">{{ $products_number ?? 0 }}</h4>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Customers -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="#">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/user.png') }}"
                                                                alt="Customers" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.customers') }}</p>
                                                    <h4 class="card-title mb-2">{{ $customers_number ?? 0 }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Revenue -->
                                    <div class="col-lg-3 col-md-6 col-12 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <a href="#">
                                                    <div
                                                        class="card-title d-flex align-items-start justify-content-between mb-3">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="{{ asset('owner/assets/img/icons/unicons/wallet-info.png') }}"
                                                                alt="Revenue" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <p class="mb-1">{{ __('messages.revenue') }}</p>
                                                    <h4 class="card-title mb-2 " style="direction: ltr">
                                                        {{ number_format($revenue ?? 0, 2, ',', ' ') }}
                                                        {{ __('messages.da') }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Section -->
<div class="row">
    <!-- Revenue Trend -->
    <div class="col-12 col-lg-8 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0">{{ __('messages.revenue_trend') }}</h5>
            </div>
            <div class="card-body">
                <div id="revenueTrendChart"></div>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="col-12 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0">{{ __('messages.top_5_products') }}</h5>
            </div>
            <div class="card-body">
                <div id="topProductsChart"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Orders Trend -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0">{{ __('messages.orders_trend') }}</h5>
            </div>
            <div class="card-body">
                <div id="ordersTrendChart"></div>
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

<!-- Charts Scripts -->
<script>
document.addEventListener("DOMContentLoaded", function() {
const primaryColor = '#03c8e2';
const successColor = '#71dd37';
const infoColor = '#03c3ec';
const warningColor = '#ffab00';
const borderColor = '#f0f2f4';
const labelColor = '#a1b0cb';
const headingColor = '#566a7f';

// Data from controller
const revenueTrend = @json($revenue_trend ?? []);
const ordersTrend = @json($orders_trend ?? []);
const topProducts = @json($top_products ?? []);

// 1. Revenue Trend Line Chart
const revOptions = {
chart: {
height: 350,
type: 'area',
toolbar: { show: false }
},
series: [{
name: "{{ __('messages.revenue') }}",
data: revenueTrend.map(item => item.total)
}],
xaxis: {
categories: revenueTrend.map(item => item.date),
labels: { style: { colors: labelColor } }
},
yaxis: {
labels: {
style: { colors: labelColor },
formatter: function(val) { return val + " DA"; }
}
},
colors: [successColor],
fill: {
type: 'gradient',
gradient: { opacityFrom: 0.5, opacityTo: 0.1 }
},
stroke: { curve: 'smooth', width: 3 },
dataLabels: { enabled: false }
};
new ApexCharts(document.querySelector("#revenueTrendChart"), revOptions).render();

// 2. Orders Trend Chart
const orderOptions = {
chart: {
height: 300,
type: 'bar',
toolbar: { show: false }
},
series: [{
name: "{{ __('messages.orders') }}",
data: ordersTrend.map(item => item.total)
}],
xaxis: {
categories: ordersTrend.map(item => item.date),
labels: { style: { colors: labelColor } }
},
colors: [primaryColor],
plotOptions: {
bar: { borderRadius: 4, columnWidth: '50%' }
},
dataLabels: { enabled: false }
};
new ApexCharts(document.querySelector("#ordersTrendChart"), orderOptions).render();

// 3. Top Products Doughnut Chart
const productOptions = {
chart: {
height: 350,
type: 'donut'
},
labels: topProducts.map(item => item.title),
series: topProducts.map(item => item.total_sold),
colors: ['#03c8e2', '#71dd37', '#ff3e1d', '#696cff', '#ffab00'],
legend: { position: 'bottom', labels: { colors: labelColor } },
dataLabels: { enabled: false },
plotOptions: {
pie: {
donut: {
size: '70%',
labels: {
show: true,
total: {
    show: true,
    label: "{{ __('messages.total') }}",
    formatter: function(w) {
        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
    }
}
}
}
}
}
};
new ApexCharts(document.querySelector("#topProductsChart"), productOptions).render();
});
</script>
</body>

</html>
