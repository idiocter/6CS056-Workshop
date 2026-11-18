<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Training Institute')</title>
    <style>
        :root { color-scheme: light; font-family: Inter, ui-sans-serif, system-ui, -apple-system, sans-serif; color: #172033; background: #f4f7fb; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        a { color: #155eef; }
        .site-header { background: #172033; color: white; }
        .nav { max-width: 1120px; margin: auto; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .brand { color: white; text-decoration: none; font-weight: 800; letter-spacing: .01em; }
        .nav-links { display: flex; gap: .5rem; }
        .nav-links a { color: #dce5f7; text-decoration: none; padding: .55rem .8rem; border-radius: .5rem; }
        .nav-links a:hover { background: #293652; color: white; }
        main { max-width: 1120px; margin: auto; padding: 2rem 1.25rem 4rem; }
        .page-header { display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 1.25rem; }
        h1 { margin: 0; font-size: clamp(1.7rem, 4vw, 2.35rem); }
        h2 { margin-top: 0; }
        .card { background: white; border: 1px solid #dce3ef; border-radius: .8rem; padding: 1.25rem; box-shadow: 0 8px 24px rgba(23, 32, 51, .06); }
        .button { display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: .55rem; padding: .7rem 1rem; background: #155eef; color: white; font: inherit; font-weight: 700; text-decoration: none; cursor: pointer; }
        .button.secondary { background: #e8eef9; color: #26344f; }
        .button.danger { background: #c9362b; }
        .button.small { padding: .45rem .7rem; font-size: .9rem; }
        .actions { display: flex; flex-wrap: wrap; gap: .5rem; }
        .actions form { margin: 0; }
        .alert { padding: .9rem 1rem; border-radius: .6rem; margin-bottom: 1rem; }
        .alert.success { background: #dcfce7; color: #166534; }
        .alert.error { background: #fee2e2; color: #991b1b; }
        .alert ul { margin-bottom: 0; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: .8rem; border-bottom: 1px solid #e3e8f1; text-align: left; vertical-align: middle; }
        th { color: #475467; font-size: .85rem; text-transform: uppercase; letter-spacing: .04em; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; }
        .field { display: grid; gap: .4rem; }
        .field.full { grid-column: 1 / -1; }
        label { font-weight: 700; }
        input, textarea, select { width: 100%; border: 1px solid #b8c3d6; border-radius: .5rem; padding: .75rem; background: white; color: #172033; font: inherit; }
        textarea { min-height: 7rem; resize: vertical; }
        input:focus, textarea:focus, select:focus { outline: 3px solid #c7d7fe; border-color: #155eef; }
        .checkbox { display: flex; align-items: center; gap: .6rem; }
        .checkbox input { width: auto; }
        .detail-grid { display: grid; grid-template-columns: 12rem 1fr; gap: .7rem 1rem; }
        .detail-grid dt { font-weight: 800; color: #475467; }
        .detail-grid dd { margin: 0; }
        .muted { color: #667085; }
        .badge { display: inline-block; padding: .25rem .55rem; border-radius: 999px; background: #e8eef9; font-size: .85rem; font-weight: 700; }
        @media (max-width: 700px) {
            .nav, .page-header { align-items: flex-start; flex-direction: column; }
            .form-grid { grid-template-columns: 1fr; }
            .detail-grid { grid-template-columns: 1fr; }
            .detail-grid dd { margin-bottom: .65rem; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <nav class="nav" aria-label="Main navigation">
            <a class="brand" href="{{ route('students.index') }}">Training Institute</a>
            <div class="nav-links">
                <a href="{{ route('students.index') }}">Students</a>
                <a href="{{ route('courses.index') }}">Courses</a>
            </div>
        </nav>
    </header>

    <main>
        @if (session('success'))
            <div class="alert success" role="status">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error" role="alert">
                <strong>Please fix the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
