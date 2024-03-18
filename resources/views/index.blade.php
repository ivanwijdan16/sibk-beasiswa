@extends('layouts.index')

@section('title', 'SIBK - Home')

@section('content')
    @include('guest.landingPage._heroGuest')
    @include('guest.landingPage._deskripsiGuest')
    {{-- @include('guest.landingPage._rekomendasiGuest')
    @include('guest.landingPage._pemetaanGuest')
    @include('guest.landingPage._pemesananGuest') --}}
@endsection
