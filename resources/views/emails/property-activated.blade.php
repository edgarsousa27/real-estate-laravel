<h1>Olá {{ $property->user->name }},</h1>

<p>O teu imóvel "<strong>{{ $property->title }}</strong>" está ativo!.</p>


<p><a href="{{ route('properties.show', $property->slug) }}">Visualizar imóvel</a></p>

<h2>Com os melhores comprimentos,</h2>
<p><strong>Equipa da {{ config('app.name') }}</strong></p>