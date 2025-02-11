@extends('layouts.main')
@section('title', 'Tüm yapılacaklar')

@section('content')
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
    <div class="allTasksList">
        @if($tasks->isNotEmpty())
            @foreach ($tasks as $task)
                <div class="taskRow {{$task->progress == 'complate' ? 'complateTask' : ''}}">
                    <div class="profileBox">
                        <img src="{{ asset('storage/uploads/' . $task->user->image) }}" width="50" alt="">
                        <div>
                            <h3>#{{$task->id}} {{Str::limit($task->title, '20')}}</h3>
                            <p>{{Str::limit($task->title, '50')}}</p>
                        </div>
                    </div>
                    @if(auth()->check())
                        <div class="buttonsArea">
                            <a class="{{$task->progress == 'complate' ? 'pointer-events-none' : ''}}" href="{{route('task.complate', ['id' => $task->id])}}">
                                <img src="{{asset('assets/image/check.png')}}" title="Tamamla" width="25px" alt="">
                            </a>
                            <a href="{{route('task.edit.landing', ['id' => $task->id])}}">
                                <img src="{{asset('assets/image/edit.png')}}" title="Düzenle" width="25px" alt="">
                            </a>
                            <a href="{{route('task.delete', ['id' => $task->id])}}">
                                <img src="{{asset('assets/image/delete.png')}}" title="Sil" width="25px" alt="">
                            </a>
                        </div>                      
                    @endif
                </div>
            @endforeach
        @else
            <div class="alert alert-danger">Henüz bir görev eklenmemiş</div>
        @endif
    </div>
@endsection