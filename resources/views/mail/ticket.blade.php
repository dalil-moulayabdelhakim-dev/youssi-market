<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.ticket_reply') }}</title>
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

        .ticket-header {
            background-color: #0b89ff;
        }

        h2 {
            color: #1e3a8a;
        }

        p {
            line-height: 1.6;
        }

        .ticket-info {
            background-color: #f0f0f0;
            padding: 10px;
            border-left: 4px solid #1e3a8a;
            margin-bottom: 15px;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
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
    </style>
</head>

<body >
    <div style="width: 100%; display: flex; align-items: center; gap: 10px;">
        <img class="logo" src="cid:img/logo.jpg" alt="logo" style="height:50px; object-fit:contain;">
        <div style="display:flex; flex-direction: column; justify-content: center; line-height:1;">
            <h1 style="margin:0; font-size: 24px; color: #0b89ff;">Youssi</h1>
            <h2 style="margin:0; font-size: 18px; color: black;">Market</h2>
        </div>
    </div>
    <div class="container">

        <h2>{{ __('messages.ticket_reply')}}</h2>
        <div class="ticket-info">
            <strong>{{ __('messages.subject') }}:</strong> {{ $ticket->subject }}<br>
            <strong>{{ __('messages.from') }}:</strong>
            {{ $type == '0' ? $ticket->user->name : __('messages.system') }}
            {{ $type == '0' ? '('. $ticket->user->email . ')': '' }}<br>
            <strong>{{ __('messages.date') }}:</strong> {{ $ticket->updated_at->format('Y-m-d H:i') }}
        </div>

        <p>{{ __('messages.reply_message_intro')  . ' #' . $ticket->id }}</p>

        <p>{{ __('messages.thank_you') }},<br>{{ config('app.name') }}</p>
        
        <a href="{{ $type == '1' ? route('contact.view') : route('admin-tickets.view') }}" class="btn">{{ __('messages.visit_website') }}</a>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.all_rights_reserved') }}.
        </div>
    </div>
</body>

</html>
