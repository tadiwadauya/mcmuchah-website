@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Content Blocks';
    @endphp

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; gap: 12px; flex-wrap: wrap;">
            <div>
                <h3 style="margin: 0;">All Content Blocks</h3>
                <p class="small-text" style="margin: 6px 0 0 0;">Manage editable text sections for Home and About pages.</p>
            </div>

            <a href="{{ route('admin.content-blocks.create') }}" class="btn btn-success">Add Content Block</a>
        </div>

        <form method="GET" action="{{ route('admin.content-blocks.index') }}" style="margin-bottom: 20px;">
            <div class="grid-3">
                <div class="form-group">
                    <label class="form-label">Search</label>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Search label, key, title, body..."
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Page</label>
                    <select name="page" class="form-control">
                        <option value="">All Pages</option>
                        <option value="home" {{ request('page') === 'home' ? 'selected' : '' }}>Home</option>
                        <option value="about" {{ request('page') === 'about' ? 'selected' : '' }}>About</option>
                    </select>
                </div>

                <div class="form-group" style="display: flex; align-items: end; gap: 10px;">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.content-blocks.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.content-blocks.bulk-action') }}">
            @csrf

            <div style="display:flex; gap:10px; align-items:end; flex-wrap:wrap; margin-bottom:20px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Bulk Action</label>
                    <select name="bulk_action" class="form-control" required>
                        <option value="">Select Action</option>
                        <option value="activate">Activate Selected</option>
                        <option value="deactivate">Deactivate Selected</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" onclick="return confirm('Apply this bulk action to selected items?');">Apply</button>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="select-all-content-blocks">
                            </th>
                            <th>Image</th>
                            <th>Page</th>
                            <th>Section Key</th>
                            <th>Label</th>
                            <th>Title</th>
                            <th>Sort</th>
                            <th>Status</th>
                            <th style="width: 320px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blocks as $block)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_items[]" value="{{ $block->id }}" class="content-block-checkbox">
                                </td>
                                <td>
                                    @if($block->image_url)
                                        <img src="{{ $block->image_url }}" alt="{{ $block->label }}" style="width:60px; height:60px; object-fit:cover; border-radius:8px; border:1px solid #ddd;">
                                    @else
                                        <span class="small-text">No image</span>
                                    @endif
                                </td>
                                <td>{{ $block->page }}</td>
                                <td>{{ $block->section_key }}</td>
                                <td>{{ $block->label }}</td>
                                <td>{{ $block->title }}</td>
                                <td>{{ $block->sort_order }}</td>
                                <td>
                                    @if($block->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-inline">
                                        <form action="{{ route('admin.content-blocks.move-up', $block) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-secondary">↑ Up</button>
                                        </form>

                                        <form action="{{ route('admin.content-blocks.move-down', $block) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-secondary">↓ Down</button>
                                        </form>

                                        <form action="{{ route('admin.content-blocks.toggle-active', $block) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn {{ $block->is_active ? 'btn-secondary' : 'btn-success' }}">
                                                {{ $block->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.content-blocks.duplicate', $block) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Duplicate</button>
                                        </form>

                                        <a href="{{ route('admin.content-blocks.edit', $block) }}" class="btn btn-warning">Edit</a>

                                        <form action="{{ route('admin.content-blocks.destroy', $block) }}" method="POST" onsubmit="return confirm('Delete this content block?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">No content blocks found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        <div style="margin-top: 20px;">
            {{ $blocks->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('select-all-content-blocks')?.addEventListener('change', function () {
                document.querySelectorAll('.content-block-checkbox').forEach(function (checkbox) {
                    checkbox.checked = event.target.checked;
                });
            });
        </script>
    @endpush
@endsection