<nav class="navbar" aria-label="Primary navigation">
    <div class="navbar-inner">
        <a href="{{ route('home') }}" class="brand">Training Institute</a>
        <div class="nav-links">
            <a href="{{ route('students.index') }}"
               class="{{ request()->routeIs('students.*') ? 'active' : '' }}"
               @if(request()->routeIs('students.*')) aria-current="page" @endif>
                Students
            </a>
            <a href="{{ route('courses.index') }}"
               class="{{ request()->routeIs('courses.*') ? 'active' : '' }}"
               @if(request()->routeIs('courses.*')) aria-current="page" @endif>
                Courses
            </a>
        </div>
    </div>
</nav>
