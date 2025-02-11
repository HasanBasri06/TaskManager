<header>
    <a href="{{route('task.landing')}}">Tüm Yapılacaklar</a>
    <a href="{{route('login.landing')}}">Giriş</a>
    @if (auth()->check()) 
        <a href="{{route('task.create')}}">Görev Ekle</a>
        <a href="{{route('user.logout')}}">Çıkış Yap</a>
    @endif
</header>