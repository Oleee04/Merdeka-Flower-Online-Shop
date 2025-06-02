<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to Order Houseplants</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto px-4 py-12 bg-white shadow-md mt-10 rounded-lg">
        <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">How to Order Houseplants</h1>
        
        <ol class="list-decimal list-inside space-y-4 text-lg text-gray-800">
            <li>
                <strong>Browse Products:</strong> Explore our houseplant collection on the 
                <a href="{{ url('/produk/all') }}" class="text-green-600 underline">Products</a> page.
            </li>
            <li>
                <strong>Select a Plant:</strong> Click on the houseplant you like to view its details.
            </li>
            <li>
                <strong>Click the Order Button:</strong> Press the <em>“Order”</em> button to add it to your cart.
            </li>
            <li>
                <strong>Open the Cart:</strong> Review your order on the cart page.
            </li>
            <li>
                <strong>Choose Payment Method:</strong> Proceed by selecting an available payment method.
            </li>
            <li>
                <strong>Order Shipped:</strong> The plant will be securely packaged and shipped to your address.
            </li>
        </ol>

        <div class="mt-10 flex justify-center space-x-4">
            <a href="{{ url('/') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded">
                ← Back
            </a>
        </div>
    </div>

</body>
</html>
