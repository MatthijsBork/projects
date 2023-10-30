<!DOCTYPE html>
<html>

<head>
    <title>Order PDF</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include Tailwind CSS stylesheet -->
</head>

<body class="p-6 font-sans">
    <div class="container max-w-2xl mx-auto">
        <h1 class="mb-4 text-3xl font-semibold">Bestelling details</h1>

        <div class="p-4 bg-white rounded-lg shadow-md">
            <p><strong>Bestelling ID:</strong> {{ $order->id }}</p>
            <p><strong>Besteld op:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
        </div>
        <div class="p-4 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-bold">Bezorgadres</h2>
            <p><strong>Naam:</strong> {{ $order->shipping()->name }}</p>
            <p><strong>Adres:</strong> {{ $order->shipping()->address }}</p>
            <p><strong>Plaats:</strong> {{ $order->shipping()->place }}</p>
            <p><strong>Postcode:</strong> {{ $order->shipping()->zipcode }}</p>
        </div>
        @if ($order->invoice() !== null)
            <div class="p-4 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold">Factuuradres</h2>
                <p><strong>Naam:</strong> {{ $order->invoice()->name }}</p>
                <p><strong>Adres:</strong> {{ $order->invoice()->address }}</p>
                <p><strong>Plaats:</strong> {{ $order->invoice()->place }}</p>
                <p><strong>Postcode:</strong> {{ $order->invoice()->zipcode }}</p>
            </div>
        @endif

        <!-- Display order products -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold">Bestelde producten</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left bg-gray-100">Product naam</th>
                        <th class="px-4 py-2 text-left bg-gray-100">Hoeveelheid</th>
                        <th class="px-4 py-2 text-left bg-gray-100">Prijs</th>
                        <th class="px-4 py-2 text-left bg-gray-100">BTW</th>
                        <th class="px-4 py-2 text-left bg-gray-100">Totaal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $product)
                        <tr>
                            <td class="px-4 py-2 border">{{ $product->product->title }}</td>
                            <td class="px-4 py-2 border">{{ $product->amount }}</td>
                            <td class="px-4 py-2 border">€{{ $product->price }}</td>
                            <td class="px-4 py-2 border">€{{ $product->price * ($product->vat / 100) }}
                            </td>
                            <td class="px-4 py-2 border">€{{ $product->price * ($product->vat / 100) + $product->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <p class="text-xl font-semibold">Subtotaal: €{{ $order->netTotal() }}</p>
        </div>
    </div>
</body>

</html>
