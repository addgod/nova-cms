<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">NovaCMS</a>
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @foreach(\Addgod\NovaCms\Models\Page::all() as $menu)
                <li class="nav-item {{ Str::startsWith($page->slug, $menu->slug) ? 'active' : '' }}">
                    <a
                        class="nav-link"
                        href="{!! route('page.show', ['slug' => $menu->slug]) !!}">{{ $menu->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
