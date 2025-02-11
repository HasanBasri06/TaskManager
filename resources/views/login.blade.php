@extends('layouts.main')
@section('title', 'Giriş Yap')

@section('content')
    <form action="{{route('login.store')}}" method="POST" class="loginForm">
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>
        @endif
        @csrf
        <div class="form-row headTitle">
            <h1 class="primaryTextColor">Giriş Yap</h1>
        </div>
        <div class="form-row">
            <labe class="primaryTextColor"l>Email</labe>
            <input type="text" name="email" placeholder="Email giriniz..." required />
        <div>
        <div class="form-row">
            <label class="primaryTextColor">Şifre</label>
            <input type="password" name="password" placeholder="Şifre giriniz..." required />
        <div>
        <div class="form-row regsiterNowTitle">
            <span>Henüz üye değil misin? <a href="{{route('registe.landing')}}">Hemen üye ol!</a></span>
        <div>
        <div class="form-row">
            <button class="primaryTextColor">Giriş Yap</button>
        <div>
    </form>
@endsection