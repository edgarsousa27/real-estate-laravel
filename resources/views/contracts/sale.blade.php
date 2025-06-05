<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contrato Promessa de Compra e Venda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
        <!-- Cabeçalho -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Contrato-Promessa de Compra e Venda de Imóvel</h1>
            <p class="text-gray-600 mt-2">Entre {{$sales_contract->owner->name}} (Promitente Vendedor/a) e {{$sales_contract->buyer->name}} (Promitente Comprador/a), referente ao imóvel situado em {{$sales_contract->property->address}}, {{$sales_contract->property->city}}.</p>
        </div>

        <!-- Identificação das Partes -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">1. Identificação das Partes</h2>
        <div class="space-y-4">
            <div>
                <p class="font-medium text-gray-700">Promitente Vendedor(a):</p>
                <p class="text-gray-800">{{ $sales_contract->owner->name }}, portador do CC nº {{ $sales_contract->owner->identification_number }}, NIF nº {{ $sales_contract->owner->tax_number}}, residente em Portugal</p>
            </div>
            <div>
                <p class="font-medium text-gray-700">Promitente Comprador(a):</p>
                <p class="text-gray-800">{{ $sales_contract->buyer->name }}, portador do CC nº {{ $sales_contract->buyer->identification_number }}, NIF nº {{ $sales_contract->buyer->tax_number}}, residente em Portugal</p>
            </div>
        </div>

        <!-- Imóvel e Preço -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">2. Objeto e Valor da Transação</h2>
        <p class="text-gray-800">O presente contrato tem como objeto a promessa de compra e venda do imóvel localizado em <strong>{{ $sales_contract->property->address }}, {{ $sales_contract->property->city }}</strong>, com o título: <strong>{{ $sales_contract->property->title }}</strong>.</p>
        <p class="mt-2 text-gray-800">O preço acordado para a venda é de <strong>{{ $sales_contract->final_price }} €</strong>, a ser pago pelo(a) Promitente Comprador(a) da seguinte forma: <strong>{{ $sales_contract->payment_method }}</strong>.</p>

        <!-- Cláusulas Legais -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">3. Condições e Obrigações</h2>
        <ul class="list-disc ml-6 text-gray-800 space-y-2">
            <li>O Promitente Vendedor declara que o imóvel se encontra livre de quaisquer ónus ou encargos.</li>
            <li>O Promitente Comprador compromete-se a pagar o valor acordado nas condições estipuladas.</li>
            <li>A escritura pública será celebrada até ao dia <strong>{{ $sales_contract->closing_date ?? '___/___/____' }}</strong>.</li>
            <li>Em caso de incumprimento, a parte responsável incorrerá em penalizações legais previstas no Código Civil.</li>
            <li>A comissão é de <strong>{{ $sales_contract->commission }}%</strong>, sendo o valor final a receber pelo vendedor: <strong>{{ $sales_contract->final_price_for_seller }} €</strong>.</li>
        </ul>

        <!-- Assinaturas -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">4. Assinaturas</h2>
        <p class="text-gray-800 mb-6">Feito e assinado por ambas as partes, em duplicado, ficando cada uma com um exemplar, para os devidos efeitos legais.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-center mt-8">
            <div>
                <p class="font-medium text-gray-700">Promitente Vendedor</p>
                <div class="border-t mt-12 pt-2 text-gray-600">Assinatura</div>
            </div>
            <div>
                <p class="font-medium text-gray-700">Promitente Comprador</p>
                <div class="border-t mt-12 pt-2 text-gray-600">Assinatura</div>
            </div>
        </div>

        <!-- Rodapé -->
        <div class="pt-5 mt-5 border-t text-center text-gray-500 text-sm">
            <p>Contrato gerado automaticamente em {{$sales_contract->created_at}}. Para validade legal, deverá ser assinado e reconhecido por notário.</p>
        </div>
    </div>
</body>

</html>