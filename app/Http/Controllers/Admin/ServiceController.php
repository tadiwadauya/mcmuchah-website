<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Service::query();

        if ($request->filled('category')) {
            $query->where('category', $request->string('category')->toString());
        }

        if ($request->filled('group_name')) {
            $query->where('group_name', $request->string('group_name')->toString());
        }

        if ($request->filled('search')) {
            $search = trim($request->string('search')->toString());

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%')
                    ->orWhere('excerpt', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('group_name', 'like', '%' . $search . '%');
            });
        }

        $services = $query->orderBy('category')
            ->orderBy('group_name')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        $groups = Service::query()
            ->whereNotNull('group_name')
            ->where('group_name', '!=', '')
            ->distinct()
            ->orderBy('group_name')
            ->pluck('group_name');

        return view('admin.services.index', compact('services', 'groups'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'icon' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'group_name' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'client_link' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'show_on_home' => ['nullable', 'boolean'],
            'show_in_navbar' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/services', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['show_on_home'] = $request->boolean('show_on_home');
        $validated['show_in_navbar'] = $request->boolean('show_in_navbar');
        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image_file']);

        $service = Service::create($validated);

        ActivityLogger::log(
            module: 'services',
            action: 'create',
            description: 'Created service: ' . $service->title,
            subject: $service,
            properties: [
                'category' => $service->category,
                'group_name' => $service->group_name,
            ],
            request: $request
        );

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'icon' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'group_name' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'client_link' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'show_on_home' => ['nullable', 'boolean'],
            'show_in_navbar' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_image')) {
            if ($service->image && str_starts_with($service->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $service->image);
                Storage::disk('public')->delete($oldPath);
            }

            $validated['image'] = null;
        }

        if ($request->hasFile('image_file')) {
            if ($service->image && str_starts_with($service->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $service->image);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image_file')->store('uploads/services', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['slug'] = Str::slug($validated['title']);
        $validated['show_on_home'] = $request->boolean('show_on_home');
        $validated['show_in_navbar'] = $request->boolean('show_in_navbar');
        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image_file'], $validated['remove_image']);

        $service->update($validated);

        ActivityLogger::log(
            module: 'services',
            action: 'update',
            description: 'Updated service: ' . $service->title,
            subject: $service,
            properties: [
                'category' => $service->category,
                'group_name' => $service->group_name,
            ],
            request: $request
        );

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        ActivityLogger::log(
            module: 'services',
            action: 'delete',
            description: 'Deleted service: ' . $service->title,
            subject: $service,
            properties: [
                'category' => $service->category,
                'group_name' => $service->group_name,
            ],
            request: request()
        );

        if ($service->image && str_starts_with($service->image, 'storage/')) {
            $oldPath = str_replace('storage/', '', $service->image);
            Storage::disk('public')->delete($oldPath);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function toggleActive(Service $service): RedirectResponse
    {
        $service->update([
            'is_active' => !$service->is_active,
        ]);

        ActivityLogger::log(
            module: 'services',
            action: 'toggle_active',
            description: 'Toggled service active status: ' . $service->title,
            subject: $service,
            properties: [
                'is_active' => $service->is_active,
            ],
            request: request()
        );

        return back()->with('success', 'Service status updated successfully.');
    }

    public function toggleHome(Service $service): RedirectResponse
    {
        $service->update([
            'show_on_home' => !$service->show_on_home,
        ]);

        ActivityLogger::log(
            module: 'services',
            action: 'toggle_home',
            description: 'Toggled service home visibility: ' . $service->title,
            subject: $service,
            properties: [
                'show_on_home' => $service->show_on_home,
            ],
            request: request()
        );

        return back()->with('success', 'Service home visibility updated successfully.');
    }

    public function toggleNavbar(Service $service): RedirectResponse
    {
        $service->update([
            'show_in_navbar' => !$service->show_in_navbar,
        ]);

        ActivityLogger::log(
            module: 'services',
            action: 'toggle_navbar',
            description: 'Toggled service navbar visibility: ' . $service->title,
            subject: $service,
            properties: [
                'show_in_navbar' => $service->show_in_navbar,
            ],
            request: request()
        );

        return back()->with('success', 'Service navbar visibility updated successfully.');
    }

    public function moveUp(Service $service): RedirectResponse
    {
        $previous = Service::where('category', $service->category)
            ->where(function ($query) use ($service) {
                $query->where('group_name', $service->group_name)
                    ->orWhere(function ($subQuery) use ($service) {
                        if (is_null($service->group_name)) {
                            $subQuery->whereNull('group_name');
                        }
                    });
            })
            ->where(function ($query) use ($service) {
                $query->where('sort_order', '<', $service->sort_order)
                    ->orWhere(function ($subQuery) use ($service) {
                        $subQuery->where('sort_order', $service->sort_order)
                            ->where('id', '<', $service->id);
                    });
            })
            ->orderByDesc('sort_order')
            ->orderByDesc('id')
            ->first();

        if ($previous) {
            $currentSort = $service->sort_order;
            $service->sort_order = $previous->sort_order;
            $previous->sort_order = $currentSort;

            $service->save();
            $previous->save();
        }

        return back()->with('success', 'Service moved up successfully.');
    }

    public function moveDown(Service $service): RedirectResponse
    {
        $next = Service::where('category', $service->category)
            ->where(function ($query) use ($service) {
                $query->where('group_name', $service->group_name)
                    ->orWhere(function ($subQuery) use ($service) {
                        if (is_null($service->group_name)) {
                            $subQuery->whereNull('group_name');
                        }
                    });
            })
            ->where(function ($query) use ($service) {
                $query->where('sort_order', '>', $service->sort_order)
                    ->orWhere(function ($subQuery) use ($service) {
                        $subQuery->where('sort_order', $service->sort_order)
                            ->where('id', '>', $service->id);
                    });
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        if ($next) {
            $currentSort = $service->sort_order;
            $service->sort_order = $next->sort_order;
            $next->sort_order = $currentSort;

            $service->save();
            $next->save();
        }

        return back()->with('success', 'Service moved down successfully.');
    }

    public function duplicate(Service $service): RedirectResponse
    {
        $new = $service->replicate();
        $new->slug = $service->slug . '-copy-' . now()->timestamp;
        $new->title = $service->title . ' Copy';
        $new->sort_order = $service->sort_order + 1;
        $new->is_active = false;
        $new->show_on_home = false;
        $new->show_in_navbar = false;
        $new->save();

        ActivityLogger::log(
            module: 'services',
            action: 'duplicate',
            description: 'Duplicated service: ' . $service->title,
            subject: $new,
            properties: [
                'original_id' => $service->id,
                'new_id' => $new->id,
            ],
            request: request()
        );

        return back()->with('success', 'Service duplicated successfully.');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'selected_items' => ['required', 'array'],
            'selected_items.*' => ['integer', 'exists:services,id'],
            'bulk_action' => ['required', 'string'],
        ]);

        $items = Service::whereIn('id', $validated['selected_items'])->get();

        switch ($validated['bulk_action']) {
            case 'activate':
                Service::whereIn('id', $validated['selected_items'])->update(['is_active' => true]);

                ActivityLogger::log(
                    module: 'services',
                    action: 'bulk_activate',
                    description: 'Bulk activated services.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected services activated successfully.');

            case 'deactivate':
                Service::whereIn('id', $validated['selected_items'])->update(['is_active' => false]);

                ActivityLogger::log(
                    module: 'services',
                    action: 'bulk_deactivate',
                    description: 'Bulk deactivated services.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected services deactivated successfully.');

            case 'show_home':
                Service::whereIn('id', $validated['selected_items'])->update(['show_on_home' => true]);

                ActivityLogger::log(
                    module: 'services',
                    action: 'bulk_show_home',
                    description: 'Bulk showed services on home.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected services are now shown on home.');

            case 'hide_home':
                Service::whereIn('id', $validated['selected_items'])->update(['show_on_home' => false]);

                ActivityLogger::log(
                    module: 'services',
                    action: 'bulk_hide_home',
                    description: 'Bulk hid services from home.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected services are now hidden from home.');

            case 'show_navbar':
                Service::whereIn('id', $validated['selected_items'])->update(['show_in_navbar' => true]);

                ActivityLogger::log(
                    module: 'services',
                    action: 'bulk_show_navbar',
                    description: 'Bulk showed services in navbar.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected services are now shown in navbar.');

            case 'hide_navbar':
                Service::whereIn('id', $validated['selected_items'])->update(['show_in_navbar' => false]);

                ActivityLogger::log(
                    module: 'services',
                    action: 'bulk_hide_navbar',
                    description: 'Bulk hid services from navbar.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected services are now hidden from navbar.');

            case 'delete':
                ActivityLogger::log(
                    module: 'services',
                    action: 'bulk_delete',
                    description: 'Bulk deleted services.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                foreach ($items as $item) {
                    if ($item->image && str_starts_with($item->image, 'storage/')) {
                        $oldPath = str_replace('storage/', '', $item->image);
                        Storage::disk('public')->delete($oldPath);
                    }

                    $item->delete();
                }

                return back()->with('success', 'Selected services deleted successfully.');

            default:
                return back()->with('success', 'No valid bulk action selected.');
        }
    }
}