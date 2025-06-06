<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contrato Promessa de Compra e Venda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    spacing: {
                        'a4-w': '210mm',
                        'a4-h': '297mm',
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            width: 210mm;
            min-height: 297mm;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-800 font-sans text-sm leading-snug">
    <div class="w-a4-w min-h-a4-h mx-auto p-4 flex flex-col">
        <!-- Cabeçalho -->
        <header class="text-center mb-4 border-b border-gray-300 pb-2">
            <h1 class="text-xl font-bold uppercase">Contrato-Promessa de Compra e Venda</h1>
            <p class="text-xs text-gray-600 mt-1">Documento válido para efeitos legais</p>
        </header>

        <!-- Informações principais -->
        <div class="flex justify-between mb-4 text-xs">
            <div><span class="font-semibold">Nº:</span> {{ $sales_contract->id }}</div>
            <div><span class="font-semibold">Data:</span> {{ \Carbon\Carbon::parse($sales_contract->created_at)->format('d/m/Y') }}</div>
        </div>

        <!-- Identificação das Partes -->
        <section class="mb-3">
            <h2 class="text-base font-semibold border-b border-gray-200 pb-1 mb-2">1. Identificação das Partes</h2>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <p class="font-medium text-xs">Promitente Vendedor(a):</p>
                    <p class="text-xs">
                        {{ $sales_contract->owner->name }}<br>
                        CC: {{ $sales_contract->owner->identification_number }}<br>
                        NIF: {{ $sales_contract->owner->tax_number }}
                    </p>
                </div>
                <div>
                    <p class="font-medium text-xs">Promitente Comprador(a):</p>
                    <p class="text-xs">
                        {{ $sales_contract->buyer->name }}<br>
                        CC: {{ $sales_contract->buyer->identification_number }}<br>
                        NIF: {{ $sales_contract->buyer->tax_number }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Imóvel e Valor -->
        <section class="mb-3">
            <h2 class="text-base font-semibold border-b border-gray-200 pb-1 mb-2">2. Objeto e Valor</h2>
            <p class="text-xs">
                <span class="font-medium">Imóvel:</span> {{ $sales_contract->property->title }}<br>
                <span class="font-medium">Localização:</span> {{ $sales_contract->property->address }}, {{ $sales_contract->property->city }}<br>
                <span class="font-medium">Valor de Venda:</span> {{ number_format($sales_contract->final_price, 2, ',', '.') }} €<br>
                <span class="font-medium">Forma de Pagamento:</span> {{ $sales_contract->payment_method }}
            </p>
        </section>

        <!-- Condições -->
        <section class="mb-3">
            <h2 class="text-base font-semibold border-b border-gray-200 pb-1 mb-2">3. Condições e Obrigações</h2>
            <ul class="list-disc list-inside text-xs space-y-1">
                <li>O imóvel está livre de quaisquer ónus ou encargos.</li>
                <li>O comprador compromete-se a pagar o valor acordado conforme estipulado.</li>
                <li>A escritura será realizada até <span class="font-medium">{{ $sales_contract->closing_date ?? '___/___/____' }}</span>.</li>
                <li>Em caso de incumprimento, serão aplicáveis penalizações legais.</li>
                <li>Comissão: {{ $sales_contract->commission }}%</li>
                <li>Valor final a receber pelo vendedor: {{ number_format($sales_contract->final_price_for_seller, 2, ',', '.') }} €</li>
            </ul>
        </section>

        <!-- Assinaturas -->
        <div class="mt-auto pt-4">
            <p class="text-center text-xs mb-4">Feito e assinado por ambas as partes em {{ \Carbon\Carbon::parse($sales_contract->created_at)->format('d/m/Y') }}</p>

            <div class="grid grid-cols-2 gap-8">
                <div class="text-center">
                    <p class="font-medium text-xs mb-6">Promitente Vendedor(a)</p>
                    <div class="border-t border-gray-400 pt-1">
                        <p class="text-2xs text-gray-500">Assinatura</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="font-medium text-xs mb-6">Promitente Comprador(a)</p>
                    <div class="border-t border-gray-400 pt-1">
                        <p class="text-2xs text-gray-500">Assinatura</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodapé -->
        <footer class="text-center text-2xs text-gray-500 mt-4 pt-2 border-t border-gray-200">
            <p>Documento gerado eletronicamente em {{ \Carbon\Carbon::parse($sales_contract->created_at)->format('d/m/Y H:i') }}. Para validade legal, deve ser assinado e, quando necessário, reconhecido por notário.</p>
        </footer>
    </div>
</body>

</html>