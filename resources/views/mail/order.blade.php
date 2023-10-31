<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js">
        window.addEventListener('load', () => {
            for (const name of ['content', 'intro']) {
                ClassicEditor.create(document.getElementById(name))
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    </script>
</head>

<body class="p-4 bg-gray-100">
    <div class="py-4 text-left">
        <h1 class="text-3xl font-bold">Webshop.</h1>
    </div>
    <div class="flex-row">
        <div class="xl:flex-row">
            <div class="container p-6 mx-auto mt-4 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-2xl font-semibold">Bedankt voor uw bestelling!</h2>
                <p class="mb-4">Uw bestelling is geplaatst. Hieronder staat wat u heeft besteld</p>

                <table class="mt-4 border border-collapse border-gray-200">
                    <thead class="text-center bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Product naam</th>
                            <th class="px-4 py-2">Aantal</th>
                            <th class="px-4 py-2">Prijs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->products as $product)
                            <tr>
                                <td class="px-4 py-2">{{ $product->product->title }}</td>
                                <td class="px-4 py-2">{{ $product->amount }}</td>
                                <td class="px-4 py-2">
                                    €{{ $product->price + $product->price * ($product->vat / 100) * $product->amount }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="mt-4">Totale prijs: €{{ $order->net_total }}</p>

                <div class="flex flex-row mt-5">
                    <div class="my-1 mr-2">
                        <h1 class="text-lg font-bold">Adres</h1>
                        <p><b>Naam: </b>{{ $order->shipping()->name }}</p>
                        <p><b>Adres: </b>{{ $order->shipping()->address }}</p>
                        <p><b>Plaats: </b>{{ $order->shipping()->place }}</p>
                        <p><b>Postcode: </b>{{ $order->shipping()->zipcode }}</p>
                    </div>
                    <div class="my-1 mr-2">
                        @if ($order->invoice() != null)
                            <h1 class="my-1 mr-2 text-lg font-bold">Factuuradres</h1>
                            <p><b>Naam: </b>{{ $order->invoice()->name }}</p>
                            <p><b>Adres: </b>{{ $order->invoice()->address }}</p>
                            <p><b>Plaats: </b>{{ $order->invoice()->place }}</p>
                            <p><b>Postcode: </b>{{ $order->invoice()->zipcode }}</p>
                        @endif
                    </div>
                    <div class="my-1 mr-2">
                        <h1 class="my-1 text-lg font-bold">Contactgegevens</h1>
                        <p><b>E-mail: </b>{{ $order->email }}</p>
                        <p><b>Telefoon: </b>{{ $order->telephone }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
