@props(['products'])

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($products as $product)
        <div class="border rounded-lg shadow-md p-4 bg-white ">
            <h2 class="text-xl font-bold">{{ $product['name'] }}</h2>
            <p class="text-gray-600">{{ Str::limit($product['description'], 100) }}</p>

            <div class="mt-4">
                <p><strong>Preço:</strong> R$ {{ number_format($product['price'], 2, ',', '.') }}</p>
                <p><strong>Disponível:</strong> {{ $product['quantity_available'] }}</p>
                <p><strong>Ativo:</strong> {{ $product['is_active'] ? 'Sim' : 'Não' }}</p>
            </div>

        </div>
    @endforeach
</div>
