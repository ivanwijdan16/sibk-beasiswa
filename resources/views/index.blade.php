@extends('layouts.index')

@section('title', 'SIBK - Home')

@section('content')
@include('guest.landingPage._heroGuest')
@include('guest.landingPage._deskripsiGuest')
@include('guest.landingPage._pilihanGuest')
@include('guest.landingPage._syaratGuest')
@endsection