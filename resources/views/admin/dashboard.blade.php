@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Dashboard';
    @endphp

    <div class="grid-2">
        <div class="card">
            <h3 style="margin-top: 0;">Content Blocks</h3>
            <p style="font-size: 28px; font-weight: bold;">{{ $contentBlocksCount }}</p>
            <a href="{{ route('admin.content-blocks.index') }}" class="btn btn-primary">Manage Content Blocks</a>
        </div>

        <div class="card">
            <h3 style="margin-top: 0;">Services</h3>
            <p style="font-size: 28px; font-weight: bold;">{{ $servicesCount }}</p>
            <a href="{{ route('admin.services.index') }}" class="btn btn-primary">Manage Services</a>
        </div>

        <div class="card">
            <h3 style="margin-top: 0;">All Inquiries</h3>
            <p style="font-size: 28px; font-weight: bold;">{{ $inquiriesCount }}</p>
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-primary">View Inquiries</a>
        </div>

        <div class="card">
            <h3 style="margin-top: 0;">Unread Inquiries</h3>
            <p style="font-size: 28px; font-weight: bold;">{{ $unreadInquiriesCount }}</p>
            <a href="{{ route('admin.inquiries.index', ['status' => 'unread']) }}" class="btn btn-primary">View Unread</a>
        </div>
    </div>

    <div class="grid-2" style="margin-top: 24px;">
        <div class="card">
            <h3 style="margin-top: 0;">Latest Inquiries</h3>

            @forelse($latestInquiries as $inquiry)
                <div style="padding: 12px 0; border-bottom: 1px solid #eee;">
                    <strong>{{ $inquiry->name }}</strong>
                    <div class="small-text">{{ $inquiry->email }} {{ $inquiry->phone ? ' | ' . $inquiry->phone : '' }}</div>
                    <div style="margin-top: 6px;">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}">Open</a>
                    </div>
                </div>
            @empty
                <p>No inquiries yet.</p>
            @endforelse
        </div>

        <div class="card">
            <h3 style="margin-top: 0;">Latest Updated Content Blocks</h3>

            @forelse($latestContentBlocks as $block)
                <div style="padding: 12px 0; border-bottom: 1px solid #eee;">
                    <strong>{{ $block->label }}</strong>
                    <div class="small-text">{{ $block->page }} | {{ $block->section_key }}</div>
                    <div style="margin-top: 6px;">
                        <a href="{{ route('admin.content-blocks.edit', $block) }}">Edit</a>
                    </div>
                </div>
            @empty
                <p>No content blocks found.</p>
            @endforelse
        </div>
    </div>
@endsection