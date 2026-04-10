@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Activity Logs';
    @endphp

    <div class="card">
        <div style="margin-bottom: 18px;">
            <h3 style="margin: 0;">Activity Logs</h3>
            <p class="small-text" style="margin: 6px 0 0 0;">Track important actions performed in the system.</p>
        </div>

        <form method="GET" action="{{ route('admin.activity-logs.index') }}" style="margin-bottom: 20px;">
            <div class="grid-3">
                <div class="form-group">
                    <label class="form-label">Search</label>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Search description, module, action..."
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Module</label>
                    <select name="module" class="form-control">
                        <option value="">All Modules</option>
                        @foreach($modules as $module)
                            <option value="{{ $module }}" {{ request('module') === $module ? 'selected' : '' }}>
                                {{ $module }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Action</label>
                    <select name="action" class="form-control">
                        <option value="">All Actions</option>
                        @foreach($actions as $action)
                            <option value="{{ $action }}" {{ request('action') === $action ? 'selected' : '' }}>
                                {{ $action }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Module</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at?->format('d M Y H:i') }}</td>
                            <td>{{ $log->user?->name ?? 'Guest/System' }}</td>
                            <td>{{ $log->module }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->ip_address }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No activity logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $logs->links() }}
        </div>
    </div>
@endsection