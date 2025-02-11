@extends('layouts.main')
@section('title', 'Kayıt Ol')

@section('content')
    <form action="{{route('registe.store')}}" method="POST" class="loginForm" enctype="multipart/form-data">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @endif

        @csrf
        <div class="form-row headTitle">
            <h1 class="primaryTextColor">Kayıt Ol</h1>
        </div>
        <div class="form-row">
            <labe class="primaryTextColor">Resim</labe>
            <input type="file" accept="image/png, image/gif, image/jpeg" name="image" required>
        <div>
        <div class="form-row">
            <labe class="primaryTextColor">İsim ve Soyisim</labe>
            <input type="text" name="name" placeholder="İsim ve Soyisim giriniz..." value="{{old('name')}}" required />
        <div>
        <div class="form-row">
            <labe class="primaryTextColor">Email</labe>
            <input type="text" name="email" placeholder="Email giriniz..." value="{{old('email')}}" required />
        <div>
        <div class="form-row">
            <label class="primaryTextColor">Şifre</label>
            <input type="password" name="password" placeholder="Şifre giriniz..." value="{{old('password')}}" required />
        <div>
        <div class="form-row">
            <label class="primaryTextColor">Şifre Onay</label>
            <input type="password" name="passwordConfirm" placeholder="Şifre onay giriniz..." value="{{old('passwordConfirm')}}" required />
        <div>
        <div class="form-row">
            <button class="primaryTextColor">Kayıt Ol</button>
        <div>
        <div class="form-row">
            <a href="{{route('login.landing')}}">Giriş Yap</a>
        </div>
    </form>
@endsection