<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.order_status_updated') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 650px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #ddd;
        }

        h2 {
            color: #1e3a8a;
        }

        p {
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
        }

        table th {
            background-color: #1e3a8a;
            color: #fff;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            color: #fff;
            border-radius: 4px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .status.pending {
            background-color: #ffc107;
        }

        .status.accepted {
            background-color: #0d6efd;
        }

        .status.rejected {
            background-color: #dc3545;
        }

        .status.shipped {
            background-color: #17a2b8;
        }

        .status.delivered {
            background-color: #28a745;
        }

        .status.received {
            background-color: #6c757d;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #1e3a8a;
            color: #fff !important;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div style="width: 100%; display: flex; align-items: center; gap: 10px;">
        <img class="logo" src="cid:img/logo.jpg" alt="logo" style="height:50px; object-fit:contain;">
        <div style="display:flex; flex-direction: column; justify-content: center; line-height:1;">
            <h1 style="margin:0; font-size: 24px; color: #0b89ff;">Youssi</h1>
            <h2 style="margin:0; font-size: 18px; color: black;">Market</h2>
        </div>
    </div>
    <div class="container">
        <h2>{{ __('messages.order_status_updated') }} - #{{ $order->id }}</h2>

        <p>
            {{ __('messages.hello') }} {{ $order->user->name }},
        </p>

        <p>
            {{ __('messages.order_status_intro') }}:
            <span class="status {{ $status }}">{{ __('messages.' . $status) }}</span>
        </p>

        <h3>{{ __('messages.products') }}:</h3>
        <table>
            <thead>
                <tr>
                    <th>{{ __('messages.image') }}</th>
                    <th>{{ __('messages.product_name') }}</th>
                    <th>{{ __('messages.type') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><img src="cid:{{ $item->product->title }}.jpg" alt="{{ $item->product->title }}"
                                style="max-width:60px;"></td>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ __('messages.'. $item->product->type ) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }} DA</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} DA</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p>
            {{ __('messages.total_price') }}:
            <strong>{{ number_format($items->sum(fn($i) => $i->price * $i->quantity), 2) }} DA</strong>
        </p>

        <p>{{ __('messages.thank_you') }},<br>{{ config('app.name') }}</p>

        <a href="{{ url('/') }}" class="btn">{{ __('messages.visit_website') }}</a>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.all_rights_reserved') }}.
        </div>
    </div>
</body>

</html>
