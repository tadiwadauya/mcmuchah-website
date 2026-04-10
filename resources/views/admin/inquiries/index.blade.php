@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Inquiries';
    @endphp

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; gap: 12px; flex-wrap: wrap;">
            <div>
                <h3 style="margin: 0;">Contact Inquiries</h3>
                <p class="small-text" style="margin: 6px 0 0 0;">Messages submitted from the website.</p>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.inquiries.index') }}" style="margin-bottom: 20px;">
            <div class="grid-3">
                <div class="form-group">
                    <label class="form-label">Search</label>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Search name, email, phone, subject..."
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">All</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                        <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                    </select>
                </div>

                <div class="form-group" style="display: flex; align-items: end; gap: 10px;">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th style="width: 260px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->name }}</td>
                            <td>
                                <div>{{ $inquiry->email }}</div>
                                <div class="small-text">{{ $inquiry->phone }}</div>
                            </td>
                            <td>{{ $inquiry->subject }}</td>
                            <td>
                                @if($inquiry->is_read)
                                    <span class="badge badge-success">Read</span>
                                @else
                                    <span class="badge badge-danger">Unread</span>
                                @endif
                            </td>
                            <td>{{ $inquiry->created_at?->format('d M Y H:i') }}</td>
                            <td>
                                <div class="actions-inline">
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-primary">Open</a>

                                    <form action="{{ route('admin.inquiries.toggle-read', $inquiry) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-secondary">
                                            {{ $inquiry->is_read ? 'Mark Unread' : 'Mark Read' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No inquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $inquiries->links() }}
        </div>
    </div>
@endsection