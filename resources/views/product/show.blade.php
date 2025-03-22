<div class="border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold">{{ $products['name'] }}</h2>
    <p class="text-gray-600">{{ $products['description'] }}</p>

    <div class="mt-4">
        <p><strong>Preço:</strong> R$ {{ number_format($products['price'], 2, ',', '.') }}</p>
        <p><strong>Quantidade:</strong> {{ $products['quantity'] }}</p>
        <p><strong>Disponível:</strong> {{ $products['quantity_available'] }}</p>
        <p><strong>Ativo:</strong> {{ $products['is_active'] ? 'Sim' : 'Não' }}</p>
        <p><strong>Dono ID:</strong> {{ $products['owner_id'] }}</p>
    </div>

    @if(!empty($products['otherInfo']))
        <div class="mt-4">
            <p><strong>Data de Validade:</strong> {{ $products['otherInfo']['due_date'] ?? 'N/A' }}</p>
            <p><strong>Código de Barras:</strong> {{ $products['otherInfo']['code_barcode'] ?? 'N/A' }}</p>
        </div>
    @endif

    <div class="mt-4 text-gray-500 text-sm">
        <p><strong>Criado em:</strong> {{ date('d/m/Y H:i', strtotime($products['created_at'])) }}</p>
        <p><strong>Atualizado em:</strong> {{ date('d/m/Y H:i', strtotime($products['updated_at'])) }}</p>
    </div>
</div>
