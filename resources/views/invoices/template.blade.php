<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Faktura #{{ $order->id }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 14px; color: #333; margin: 0; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #f8f9fa; color: #555; font-size: 12px; text-transform: uppercase; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .header { margin-bottom: 40px; border-bottom: 2px solid #22c55e; padding-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #111; }
        .text-primary { color: #22c55e; }
        .flex-between { width: 100%; }
        .flex-between td { border: none; padding: 0; vertical-align: top; }
        .address-box { background: #f8f9fa; padding: 15px; border-radius: 5px; margin-top: 10px; }
        .total-row td { font-weight: bold; font-size: 18px; border-top: 2px solid #333; }
        .summary-box { float: right; width: 300px; margin-top: 20px; }
        .footer { position: fixed; bottom: -20px; left: 0px; right: 0px; height: 50px; text-align: center; font-size: 10px; color: #888; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <table class="flex-between">
            <tr>
                <td>
                    <div class="logo">OTO<span class="text-primary">VEND</span></div>
                    <p style="margin: 5px 0 0; color: #666;">Profesjonalna Giełda Automatów</p>
                </td>
                <td class="text-right">
                    <h2 style="margin: 0; font-size: 28px; color: #111;">FAKTURA</h2>
                    <p style="margin: 5px 0 0; font-size: 16px; color: #666;">Nr: <strong># INV-{{ date('Y') }}-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
                    <p style="margin: 5px 0 0; font-size: 12px; color: #888;">Data wystawienia: {{ $order->created_at->format('d.m.Y') }}</p>
                </td>
            </tr>
        </table>
    </div>

    <table class="flex-between" style="margin-bottom: 30px;">
        <tr>
            <td style="width: 48%;">
                <h4 style="margin: 0 0 5px; color: #555; font-size: 12px; text-transform: uppercase;">Sprzedawca</h4>
                <div class="address-box">
                    <strong>{{ $order->items->first()->product->vendor->shop_name ?? 'Sprzedawca Niezależny' }}</strong><br>
                    Platforma Otovend<br>
                    kontakt@otovend.pl
                </div>
            </td>
            <td style="width: 4%;"></td>
            <td style="width: 48%;">
                <h4 style="margin: 0 0 5px; color: #555; font-size: 12px; text-transform: uppercase;">Nabywca</h4>
                <div class="address-box">
                    <strong>{{ $order->user->name }}</strong><br>
                    Użytkownik Otovend<br>
                    {{ $order->user->email }}
                </div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Lp.</th>
                <th>Nazwa Towaru/Usługi</th>
                <th class="text-center">Ilość</th>
                <th class="text-right">Cena Jedn.</th>
                <th class="text-right">Wartość</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->product->name }}</strong><br>
                    <span style="font-size: 10px; color: #888;">Stan: {{ $item->product->condition == 'new' ? 'Nowy' : 'Używany' }}</span>
                </td>
                <td class="text-center">{{ $item->quantity }} szt.</td>
                <td class="text-right">{{ number_format($item->price, 2, '.', ' ') }} PLN</td>
                <td class="text-right">{{ number_format($item->price * $item->quantity, 2, '.', ' ') }} PLN</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" class="text-right">DO ZAPŁATY (PLN):</td>
                <td class="text-right text-primary">{{ number_format($order->total_price, 2, '.', ' ') }}</td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 50px;">
        <h4 style="font-size: 12px; color: #555; text-transform: uppercase; margin-bottom: 10px;">Informacje o wysyłce</h4>
        <p style="margin: 0; font-size: 14px;"><strong>Status:</strong> {{ $order->status === 'shipped' ? 'Wysłane' : ($order->status === 'delivered' ? 'Dostarczone' : 'Oczekujące') }}</p>
        @if($order->tracking_number)
            <p style="margin: 5px 0 0; font-size: 14px;"><strong>Numer paczki:</strong> {{ $order->tracking_number }}</p>
        @endif
    </div>

    <div class="footer">
        Niniejszy dokument został wygenerowany elektronicznie i jest ważny bez podpisu.<br>
        Generowane przez system sprzedaży Otovend.pl
    </div>

</body>
</html>
