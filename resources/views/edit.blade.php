@extends('layouts.main')
@section('title', 'Task Düzenle')

@section('content')
    <form action="{{route('task.edit.store')}}" method="POST" class="loginForm">
        <input type="hidden" name="taskId" value="{{$task->id}}" /> 
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
            <h1 class="primaryTextColor">Görev Düzenle</h1>
        </div>
        <div class="form-row">
            <labe class="primaryTextColor">Başlık</labe>
            <input type="text" name="title" value="{{$task->title}}" placeholder="Başlık giriniz..." />
        <div>
        <div class="form-row">
            <label class="primaryTextColor">Açıklama</label>
            <textarea placeholder="Açıklama giriniz..." name="description">{{$task->description}}</textarea>
        <div>
        <div class="form-row">
            <button class="primaryTextColor">Düzenle</button>
        <div>
    </form>
@endsection