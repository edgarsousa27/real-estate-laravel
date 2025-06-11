<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contrato de Arrendamento</title>
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
    <!-- Main container with proper A4 dimensions -->
    <div class="w-a4-w min-h-a4-h mx-auto p-4 flex flex-col">
        <!-- Contract Header -->
        <header class="text-center mb-4 border-b border-gray-300 pb-2">
            <h1 class="text-xl font-bold uppercase">Contrato de Arrendamento</h1>
            <p class="text-xs text-gray-600 mt-1">Documento válido para efeitos legais</p>
        </header>

        <!-- Contract Info -->
        <div class="flex justify-between mb-4 text-xs">
            <div><span class="font-semibold">Nº:</span> {{ $rental_contract->id }}</div>
            <div><span class="font-semibold">Data:</span> {{ \Carbon\Carbon::parse($rental_contract->created_at)->format('d/m/Y') }}</div>
        </div>

        <!-- Parties Section - More compact -->
        <section class="mb-3">
            <h2 class="text-base font-semibold border-b border-gray-200 pb-1 mb-2">1. Identificação das Partes</h2>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <p class="font-medium text-xs">SENHORIO:</p>
                    <p class="text-xs">
                        {{ $rental_contract->landlord->name }}<br>
                        CC: {{ $rental_contract->landlord->identification_number }}<br>
                        NIF: {{ $rental_contract->landlord->tax_number }}
                    </p>
                </div>
                <div>
                    <p class="font-medium text-xs">INQUILINO:</p>
                    <p class="text-xs">
                        {{ $rental_contract->tenant->name }}<br>
                        CC: {{ $rental_contract->tenant->identification_number }}<br>
                        NIF: {{ $rental_contract->tenant->tax_number }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Property Section - More compact -->
        <section class="mb-3">
            <h2 class="text-base font-semibold border-b border-gray-200 pb-1 mb-2">2. Objeto do Contrato</h2>
            <p class="text-xs">
                <span class="font-medium">Imóvel:</span> {{ $rental_contract->property->id }}<br>
                <span class="font-medium">Localização:</span> {{ $rental_contract->property->address }}, {{ $rental_contract->property->city }}
            </p>
        </section>

        <!-- Terms Section - More compact -->
        <section class="mb-3">
            <h2 class="text-base font-semibold border-b border-gray-200 pb-1 mb-2">3. Termos do Contrato</h2>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <div>
                    <p><span class="font-medium">Início:</span> {{ \Carbon\Carbon::parse($rental_contract->start_contract)->format('d/m/Y') }}</p>
                    <p><span class="font-medium">Término:</span> {{ \Carbon\Carbon::parse($rental_contract->end_contract)->format('d/m/Y') }}</p>
                    <p><span class="font-medium">Duração:</span> {{ $rental_contract->months_contract }} meses</p>
                </div>
                <div>
                    <p><span class="font-medium">Renda:</span> {{ number_format($rental_contract->price, 2, ',', '.') }} €/mês</p>
                    <p><span class="font-medium">Total:</span> {{ number_format($rental_contract->total_price_contract, 2, ',', '.') }} €</p>
                    <p><span class="font-medium">Pagamento:</span> {{ $rental_contract->payment_method }}</p>
                </div>
            </div>
        </section>

        <!-- Conditions Section - More compact -->
        <section class="mb-3">
            <h2 class="text-base font-semibold border-b border-gray-200 pb-1 mb-2">4. Condições</h2>
            <ul class="list-disc list-inside text-xs space-y-1">
                <li>O imóvel encontra-se em condições habitáveis</li>
                <li>Pagamento pontual da renda mensal</li>
                <li>Conservação do imóvel pelo inquilino</li>
                <li>Comissão: {{ $rental_contract->commission}}%</li>
                <li>Rescisão antecipada sujeita a penalidades legais</li>
            </ul>
        </section>

        <!-- Signatures Section - Adjusted to fit better -->
        <div class="mt-auto pt-4">
            <p class="text-center text-xs mb-4">Feito e assinado por ambas as partes em {{ \Carbon\Carbon::parse($rental_contract->created_at)->format('d/m/Y') }}</p>

            <div class="grid grid-cols-2 gap-8">
                <div class="text-center">
                    <p class="font-medium text-xs mb-6">SENHORIO</p>
                    <div class="border-t border-gray-400 pt-1">
                        <p class="text-2xs text-gray-500">Assinatura</p>
                    </div>
                </div>
                <div class="text-center">
                    <p class="font-medium text-xs mb-6">INQUILINO</p>
                    <div class="border-t border-gray-400 pt-1">
                        <p class="text-2xs text-gray-500">Assinatura</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center text-2xs text-gray-500 mt-4 pt-2 border-t border-gray-200">
            <p>Documento gerado eletronicamente em {{ \Carbon\Carbon::parse($rental_contract->created_at)->format('d/m/Y H:i') }}</p>
        </footer>
    </div>
</body>

</html>