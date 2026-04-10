@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Services';
    @endphp

    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; gap: 12px; flex-wrap: wrap;">
            <div>
                <h3 style="margin: 0;">All Services</h3>
                <p class="small-text" style="margin: 6px 0 0 0;">
                    Manage landing page services, tabbed service groups, digital services, promotional services, and trade references.
                </p>
            </div>

            <a href="{{ route('admin.services.create') }}" class="btn btn-success">Add Service</a>
        </div>

        <form method="GET" action="{{ route('admin.services.index') }}" style="margin-bottom: 20px;">
            <div class="grid-3">
                <div class="form-group">
                    <label class="form-label">Search</label>
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        value="{{ request('search') }}"
                        placeholder="Search title, slug, excerpt, group..."
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-control">
                        <option value="">All Categories</option>
                        <option value="printing" {{ request('category') === 'printing' ? 'selected' : '' }}>Printing</option>
                        <option value="promo" {{ request('category') === 'promo' ? 'selected' : '' }}>Promotional Materials</option>
                        <option value="digital" {{ request('category') === 'digital' ? 'selected' : '' }}>Digital Marketing</option>
                        <option value="other" {{ request('category') === 'other' ? 'selected' : '' }}>Other Services</option>
                        <option value="trade_reference" {{ request('category') === 'trade_reference' ? 'selected' : '' }}>Trade Reference</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Group</label>
                    <select name="group_name" class="form-control">
                        <option value="">All Groups</option>
                        @foreach($groups as $group)
                            <option value="{{ $group }}" {{ request('group_name') === $group ? 'selected' : '' }}>
                                {{ $group }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <form method="POST" action="{{ route('admin.services.bulk-action') }}">
            @csrf

            <div style="display:flex; gap:10px; align-items:end; flex-wrap:wrap; margin-bottom:20px;">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Bulk Action</label>
                    <select name="bulk_action" class="form-control" required>
                        <option value="">Select Action</option>
                        <option value="activate">Activate Selected</option>
                        <option value="deactivate">Deactivate Selected</option>
                        <option value="show_home">Show Selected on Home</option>
                        <option value="hide_home">Hide Selected from Home</option>
                        <option value="show_navbar">Show Selected in Navbar</option>
                        <option value="hide_navbar">Hide Selected from Navbar</option>
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
                                <input type="checkbox" id="select-all-services">
                            </th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Group</th>
                            <th>Home</th>
                            <th>Navbar</th>
                            <th>Status</th>
                            <th>Sort</th>
                            <th style="width: 420px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_items[]" value="{{ $service->id }}" class="service-checkbox">
                                </td>
                                <td>
                                    @if($service->image_url)
                                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}" style="width:60px; height:60px; object-fit:cover; border-radius:8px; border:1px solid #ddd;">
                                    @else
                                        <span class="small-text">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $service->title }}</strong>
                                    <div class="small-text">{{ $service->slug }}</div>
                                </td>
                                <td>{{ $service->category }}</td>
                                <td>{{ $service->group_name }}</td>
                                <td>
                                    @if($service->show_on_home)
                                        <span class="badge badge-info">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->show_in_navbar)
                                        <span class="badge badge-info">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($service->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $service->sort_order }}</td>
                                <td>
                                    <div class="actions-inline">
                                        <form action="{{ route('admin.services.move-up', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-secondary">↑ Up</button>
                                        </form>

                                        <form action="{{ route('admin.services.move-down', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-secondary">↓ Down</button>
                                        </form>

                                        <form action="{{ route('admin.services.toggle-active', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn {{ $service->is_active ? 'btn-secondary' : 'btn-success' }}">
                                                {{ $service->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.services.toggle-home', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn {{ $service->show_on_home ? 'btn-secondary' : 'btn-success' }}">
                                                {{ $service->show_on_home ? 'Hide Home' : 'Show Home' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.services.toggle-navbar', $service) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn {{ $service->show_in_navbar ? 'btn-secondary' : 'btn-success' }}">
                                                {{ $service->show_in_navbar ? 'Hide Navbar' : 'Show Navbar' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.services.duplicate', $service) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Duplicate</button>
                                        </form>

                                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning">Edit</a>

                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        <div style="margin-top: 20px;">
            {{ $services->links() }}
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('select-all-services')?.addEventListener('change', function (event) {
                document.querySelectorAll('.service-checkbox').forEach(function (checkbox) {
                    checkbox.checked = event.target.checked;
                });
            });
        </script>
    @endpush
@endsection