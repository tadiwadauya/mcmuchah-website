<nav style="padding: 20px; border-bottom: 1px solid #ddd;">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('about') }}" style="margin-left: 15px;">About</a>

    <div style="display: inline-block; margin-left: 15px; position: relative;">
        <span>Services</span>
        <div style="margin-top: 10px;">
            @isset($navbarServices)
                @foreach($navbarServices as $service)
                    <div>
                        <a href="#">{{ $service->title }}</a>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>

    @auth
        <a href="{{ route('admin.dashboard') }}" style="margin-left: 15px;">Dashboard</a>
    @endauth
</nav>