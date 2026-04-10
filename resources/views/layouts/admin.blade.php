<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #222;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 260px;
            background: #111827;
            color: #fff;
            padding: 24px 18px;
        }

        .admin-sidebar h2 {
            margin-top: 0;
            margin-bottom: 24px;
            font-size: 20px;
        }

        .admin-sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 8px;
        }

        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background: #1f2937;
            color: #fff;
        }

        .admin-main {
            flex: 1;
            padding: 30px;
        }

        .admin-topbar {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.05);
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.05);
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #111827;
            color: #fff;
        }

        .btn-success {
            background: #166534;
            color: #fff;
        }

        .btn-danger {
            background: #b91c1c;
            color: #fff;
        }

        .btn-warning {
            background: #92400e;
            color: #fff;
        }

        .btn-secondary {
            background: #4b5563;
            color: #fff;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th {
            text-align: left;
            background: #f3f4f6;
            padding: 14px;
            font-size: 14px;
        }

        table tbody td {
            padding: 14px;
            border-top: 1px solid #e5e7eb;
            vertical-align: top;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            box-sizing: border-box;
        }

        textarea.form-control {
            min-height: 120px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-info {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

       .actions-inline {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
}

.actions-inline form {
    margin: 0;
}
        }

        .checkbox-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .small-text {
            color: #6b7280;
            font-size: 12px;
        }

        @media (max-width: 900px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .admin-sidebar {
                width: 100%;
            }

            .grid-2,
            .grid-3 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <h2>McMupah Admin</h2>

<a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
<a href="{{ route('admin.content-blocks.index') }}" class="{{ request()->routeIs('admin.content-blocks.*') ? 'active' : '' }}">Content Blocks</a>
<a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">Services</a>
<a href="{{ route('admin.inquiries.index') }}" class="{{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">Inquiries</a>
<a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">Settings</a>
<a href="{{ route('admin.activity-logs.index') }}" class="{{ request()->routeIs('admin.activity-logs.*') ? 'active' : '' }}">Activity Logs</a>
<a href="{{ route('home') }}" target="_blank">View Website</a>

            <form action="{{ route('logout') }}" method="POST" style="margin-top: 24px;">
                @csrf
                <button type="submit" class="btn btn-danger" style="width: 100%;">Logout</button>
            </form>
        </aside>

        <main class="admin-main">
            <div class="admin-topbar">
                <div>
                    <strong>{{ $pageTitle ?? 'Admin Panel' }}</strong>
                </div>
                <div>
                    {{ auth()->user()->name }}
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Please fix the following errors:</strong>
                    <ul style="margin: 10px 0 0 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>