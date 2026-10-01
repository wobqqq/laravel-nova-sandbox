@extends('layouts.page')

@section('title', 'Home')

@section('content')
    <p class="eyebrow">Sandbox</p>
    <h1>{{ config('app.name') }}</h1>
    <p>A clean Laravel Nova application for installing and trying out Nova packages.</p>

    <dl>
        @foreach ($versions as $name => $version)
            <dt>{{ $name }}</dt>
            <dd>{{ $version }}</dd>
        @endforeach
    </dl>

    <a class="button" href="{{ $novaUrl }}">Open Nova</a>

    <h2>Local packages</h2>
    @if ($packages === [])
        <p class="empty">None installed. Run <code>make package.require PACKAGE=vendor/name</code>.</p>
    @else
        <ul>
            @foreach ($packages as $package)
                <li>{{ $package['name'] }}</li>
            @endforeach
        </ul>
    @endif
@endsection
