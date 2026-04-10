@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Inquiry Details';
    @endphp

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: start; gap: 20px; flex-wrap: wrap;">
            <div>
                <h3 style="margin-top: 0;">{{ $inquiry->name }}</h3>
                <p><strong>Email:</strong> {{ $inquiry->email ?: 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $inquiry->phone ?: 'N/A' }}</p>
                <p><strong>Subject:</strong> {{ $inquiry->subject ?: 'N/A' }}</p>
                <p><strong>Status:</strong>
                    @if($inquiry->is_read)
                        <span class="badge badge-success">Read</span>
                    @else
                        <span class="badge badge-danger">Unread</span>
                    @endif
                </p>
                <p><strong>Received:</strong> {{ $inquiry->created_at?->format('d M Y H:i') }}</p>
            </div>

            <div class="actions-inline">
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">Back</a>

                <form action="{{ route('admin.inquiries.toggle-read', $inquiry) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-primary">
                        {{ $inquiry->is_read ? 'Mark Unread' : 'Mark Read' }}
                    </button>
                </form>

                <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>

        <hr style="margin: 24px 0; border: none; border-top: 1px solid #eee;">

        <h4>Message</h4>
        <div style="white-space: pre-wrap; line-height: 1.7;">
            {{ $inquiry->message }}
        </div>
    </div>
@endsection