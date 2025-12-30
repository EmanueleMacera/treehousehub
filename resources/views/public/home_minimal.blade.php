@extends('layouts.minimal')

@section('title', 'TreeHouse Italia - Hub')

@section('content')
<h1>TreeHouse Italia Hub</h1>
<p>Benvenuto nell'hub unico per affitti, vendite e partnership con proprietari.</p>

<a class="btn" href="{{ route('rentals.index', ['locale' => app()->getLocale()]) }}">Affitti</a>
<a class="btn" href="{{ route('sales.index', ['locale' => app()->getLocale()]) }}">Vendite</a>
<a class="btn" href="{{ route('owners', ['locale' => app()->getLocale()]) }}">Proprietari</a>
<a class="btn" href="{{ route('about', ['locale' => app()->getLocale()]) }}">Chi siamo</a>
<a class="btn" href="{{ route('contact', ['locale' => app()->getLocale()]) }}">Contatti</a>

<p style="margin-top:40px;font-size:14px;color:#888;">&copy; {{ date('Y') }} TreeHouse Italia</p>
@endsection
