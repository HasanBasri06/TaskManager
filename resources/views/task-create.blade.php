@extends('layouts.main')
@section('title', 'Task Oluştur')

@section('content')
    <form action="{{route('task.create.store')}}" method="POST" class="loginForm">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @endif
        @csrf
        <div class="form-row headTitle">
            <h1 class="primaryTextColor">Görev Ekle</h1>
        </div>
        <div class="form-row">
            <labe class="primaryTextColor">Başlık</labe>
            <input type="text" name="title" placeholder="Başlık giriniz..." required />
        <div>
        <div class="form-row">
            <label class="primaryTextColor">Açıklama</label>
            <textarea placeholder="Açıklama giriniz..." name="description" required></textarea>
        <div>
        <div class="form-row regsiterNowTitle">
            <span>Henüz üye değil misin? <a href="{{route('registe.landing')}}">Hemen üye ol!</a></span>
        <div>
        <div class="form-row">
            <button class="primaryTextColor">Görev Ekle</button>
        <div>
    </form>
@endsection