@extends('layouts.page')

@section('title', $title)

@section('content')
    <p class="eyebrow">Error {{ $code }}</p>
    <h1>{{ $title }}</h1>
    <p>{{ $message }}</p>
    <a class="button" href="{{ url('/') }}">Back to home</a>
@endsection
