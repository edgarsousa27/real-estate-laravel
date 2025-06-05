<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contrato de Arrendamento {{ $rental_contract->landlord->name}} e {{ $rental_contract->tenant->name}} </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg">
        <!-- Cabeçalho -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Contrato de Arrendamento de Imóvel</h1>
            <p class="text-gray-600 mt-2">Entre {{ $rental_contract->landlord->name }} (Senhorio) e {{ $rental_contract->tenant->name  }} (Inquilino), referente ao imóvel situado em {{ $rental_contract->property->address }}, {{ $rental_contract->property->city }}.</p>
        </div>

        <!-- Identificação das Partes -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mb-4">1. Identificação das Partes</h2>
        <div class="space-y-4">
            <div>
                <p class="font-medium text-gray-700">Senhorio:</p>
                <p class="text-gray-800">
                    {{ $rental_contract->landlord->name }}, portador do CC nº {{ $rental_contract->landlord->identification_number }}, NIF nº {{ $rental_contract->landlord->tax_number }}, residente em Portugal
                </p>
            </div>
            <div>
                <p class="font-medium text-gray-700">Inquilino:</p>
                <p class="text-gray-800">
                    {{ $rental_contract->tenant->name  }}, portador do CC nº {{ $rental_contract->tenant->identification_number  }}, NIF nº {{ $rental_contract->tenant->tax_number  }}, residente em Portugal
                </p>
            </div>
        </div>

        <!-- Objeto do Contrato -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">2. Objeto do Contrato</h2>
        <p class="text-gray-800">
            O presente contrato tem como objeto o arrendamento do imóvel localizado em <strong>{{ $rental_contract->property->addres }}, {{ $rental_contract->property->city  }}</strong>, com o título: <strong>{{ $rental_contract->property->title }}</strong>.
        </p>

        <!-- Prazo e Valor -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">3. Prazo e Valor do Arrendamento</h2>
        <p class="text-gray-800">
            O contrato tem início em <strong>{{$rental_contract->start_contract}}</strong> e término em <strong>{{$rental_contract->end_contract}}</strong>, com duração total de <strong>{{ $rental_contract->months_contract }}</strong> meses.
        </p>
        <p class="mt-2 text-gray-800">
            O valor mensal do arrendamento é de <strong>{{$rental_contract->price}} €</strong>, a ser pago pelo inquilino por meio de <strong>{{ $rental_contract->payment_method }}</strong>.
        </p>
        <p class="mt-2 text-gray-800">
            O valor total do contrato corresponde a <strong>{{ $rental_contract->total_price_contract}} €</strong>.
        </p>

        <!-- Condições e Obrigações -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">4. Condições e Obrigações</h2>
        <ul class="list-disc ml-6 text-gray-800 space-y-2">
            <li>O senhorio declara que o imóvel está em condições habitáveis e se compromete a garantir a sua manutenção estrutural durante a vigência do contrato.</li>
            <li>O inquilino compromete-se a cumprir o pagamento pontual do valor mensal acordado e a conservar o imóvel.</li>
            <li>O não cumprimento das condições deste contrato poderá resultar na rescisão antecipada e aplicação das penalidades previstas na lei.</li>
            <li>A comissão referente ao contrato é de <strong>{{ $rental_contract->commission}} %</strong>.</li>
        </ul>

        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-8 mb-4">4. Assinaturas</h2>
        <p class="text-gray-800 mb-6">Feito e assinado por ambas as partes, em duplicado, ficando cada uma com um exemplar, para os devidos efeitos legais.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-center mt-8">
            <div>
                <p class="font-medium text-gray-700">Senhorio</p>
                <div class="border-t mt-12 pt-2 text-gray-600">Assinatura</div>
            </div>
            <div>
                <p class="font-medium text-gray-700">Inquilino</p>
                <div class="border-t mt-12 pt-2 text-gray-600">Assinatura</div>
            </div>
        </div>

        <!-- Rodapé -->
        <div class="pt-5 mt-5 border-t text-center text-gray-500 text-sm">
            <p>Contrato gerado automaticamente em {{ ($rental_contract->created_at) }}. Para validade legal, deverá ser assinado e reconhecido por notário.</p>
        </div>
    </div>
</body>

</html>