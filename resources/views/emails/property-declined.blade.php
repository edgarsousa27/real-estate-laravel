<h1>Olá {{ $property->user->name }},</h1>

<p>O teu imóvel "<strong>{{ $property->title }}</strong>" foi recusado!.</p>

<p><strong>Motivo:</strong> {{ $property->reason_for_refusal }}</p>

<p>Por favor, verifica os detalhes do imóvel e tenta novamente.</p>

<p>Se tiveres alguma dúvida, não hesites em contactar-nos.</p>

<h2>Com os melhores comprimentos,</h2>
<p><strong>Equipa da {{ config('app.name') }}</strong></p>