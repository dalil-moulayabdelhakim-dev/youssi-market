<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.new_order') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            padding: 20px;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            max-width: 650px;
            margin: auto;
        }

        h2 {
            color: #1e3a8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #0b89ff;
            color: #fff;
        }

        .btn {
            display: inline-block;
            padding: 8px 15px;
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
        <h2>{{ __('messages.order') }} #{{ $order->id }}</h2>
        <p><strong>{{ __('messages.status') }}:</strong> {{ __('messages.pending') }}</p>
        <p><strong>{{ __('messages.delivery_place') }}:</strong>
            {{ $order->delivery_place == '1' ? __('messages.delivery_places.home') : __('messages.delivery_places.office') }}
        </p>
        <p><strong>{{ __('messages.date') }}:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>

        <h4>{{ __('messages.products') }}:</h4>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.image') }}</th>
                    <th>{{ __('messages.product_name') }}</th>
                    <th>{{ __('messages.type') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.price') }}</th>
                    <th>{{ __('messages.total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td><img src="cid:{{ $item->product->title }}.jpg" alt="{{ $item->product->title }}"
                                style="max-width:60px;">
                        </td>
                        <td>{{ $item->product->id }}</td>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ __('messages.' . $item->product->type) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }} {{ __('messages.da') }}</td>
                        <td>{{ $item->quantity * $item->price }} {{ __('messages.da') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h1>{{ __('messages.total') }}: {{ $order->total_price }} {{ __('messages.da') }}</h1>

        <a href="{{ url('/') }}" class="btn">{{ __('messages.visit_website') }}</a>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.all_rights_reserved') }}.
        </div>
    </div>
</body>

</html>
