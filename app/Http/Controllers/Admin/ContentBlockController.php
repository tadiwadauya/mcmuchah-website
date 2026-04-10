<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentBlock;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContentBlockController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContentBlock::query();

        if ($request->filled('page')) {
            $query->where('page', $request->string('page')->toString());
        }

        if ($request->filled('search')) {
            $search = trim($request->string('search')->toString());

            $query->where(function ($q) use ($search) {
                $q->where('label', 'like', '%' . $search . '%')
                    ->orWhere('section_key', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        }

        $blocks = $query->orderBy('page')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.content-blocks.index', compact('blocks'));
    }

    public function create(): View
    {
        return view('admin.content-blocks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page' => ['required', 'string', 'max:255'],
            'section_key' => ['required', 'string', 'max:255', 'unique:content_blocks,section_key'],
            'label' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/content-blocks', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image_file']);

        $contentBlock = ContentBlock::create($validated);

        ActivityLogger::log(
            module: 'content_blocks',
            action: 'create',
            description: 'Created content block: ' . $contentBlock->label,
            subject: $contentBlock,
            properties: [
                'page' => $contentBlock->page,
                'section_key' => $contentBlock->section_key,
            ],
            request: $request
        );

        return redirect()
            ->route('admin.content-blocks.index')
            ->with('success', 'Content block created successfully.');
    }

    public function edit(ContentBlock $contentBlock): View
    {
        return view('admin.content-blocks.edit', compact('contentBlock'));
    }

    public function update(Request $request, ContentBlock $contentBlock): RedirectResponse
    {
        $validated = $request->validate([
            'page' => ['required', 'string', 'max:255'],
            'section_key' => ['required', 'string', 'max:255', 'unique:content_blocks,section_key,' . $contentBlock->id],
            'label' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('remove_image')) {
            if ($contentBlock->image && str_starts_with($contentBlock->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $contentBlock->image);
                Storage::disk('public')->delete($oldPath);
            }

            $validated['image'] = null;
        }

        if ($request->hasFile('image_file')) {
            if ($contentBlock->image && str_starts_with($contentBlock->image, 'storage/')) {
                $oldPath = str_replace('storage/', '', $contentBlock->image);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('image_file')->store('uploads/content-blocks', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image_file'], $validated['remove_image']);

        $contentBlock->update($validated);

        ActivityLogger::log(
            module: 'content_blocks',
            action: 'update',
            description: 'Updated content block: ' . $contentBlock->label,
            subject: $contentBlock,
            properties: [
                'page' => $contentBlock->page,
                'section_key' => $contentBlock->section_key,
            ],
            request: $request
        );

        return redirect()
            ->route('admin.content-blocks.index')
            ->with('success', 'Content block updated successfully.');
    }

    public function destroy(ContentBlock $contentBlock): RedirectResponse
    {
        ActivityLogger::log(
            module: 'content_blocks',
            action: 'delete',
            description: 'Deleted content block: ' . $contentBlock->label,
            subject: $contentBlock,
            properties: [
                'page' => $contentBlock->page,
                'section_key' => $contentBlock->section_key,
            ],
            request: request()
        );

        if ($contentBlock->image && str_starts_with($contentBlock->image, 'storage/')) {
            $oldPath = str_replace('storage/', '', $contentBlock->image);
            Storage::disk('public')->delete($oldPath);
        }

        $contentBlock->delete();

        return redirect()
            ->route('admin.content-blocks.index')
            ->with('success', 'Content block deleted successfully.');
    }

    public function toggleActive(ContentBlock $contentBlock): RedirectResponse
    {
        $contentBlock->update([
            'is_active' => !$contentBlock->is_active,
        ]);

        ActivityLogger::log(
            module: 'content_blocks',
            action: 'toggle_active',
            description: 'Toggled content block status: ' . $contentBlock->label,
            subject: $contentBlock,
            properties: [
                'is_active' => $contentBlock->is_active,
            ],
            request: request()
        );

        return back()->with('success', 'Content block status updated successfully.');
    }

    public function moveUp(ContentBlock $contentBlock): RedirectResponse
    {
        $previous = ContentBlock::where('page', $contentBlock->page)
            ->where(function ($query) use ($contentBlock) {
                $query->where('sort_order', '<', $contentBlock->sort_order)
                    ->orWhere(function ($subQuery) use ($contentBlock) {
                        $subQuery->where('sort_order', $contentBlock->sort_order)
                            ->where('id', '<', $contentBlock->id);
                    });
            })
            ->orderByDesc('sort_order')
            ->orderByDesc('id')
            ->first();

        if ($previous) {
            $currentSort = $contentBlock->sort_order;
            $contentBlock->sort_order = $previous->sort_order;
            $previous->sort_order = $currentSort;

            $contentBlock->save();
            $previous->save();
        }

        return back()->with('success', 'Content block moved up successfully.');
    }

    public function moveDown(ContentBlock $contentBlock): RedirectResponse
    {
        $next = ContentBlock::where('page', $contentBlock->page)
            ->where(function ($query) use ($contentBlock) {
                $query->where('sort_order', '>', $contentBlock->sort_order)
                    ->orWhere(function ($subQuery) use ($contentBlock) {
                        $subQuery->where('sort_order', $contentBlock->sort_order)
                            ->where('id', '>', $contentBlock->id);
                    });
            })
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        if ($next) {
            $currentSort = $contentBlock->sort_order;
            $contentBlock->sort_order = $next->sort_order;
            $next->sort_order = $currentSort;

            $contentBlock->save();
            $next->save();
        }

        return back()->with('success', 'Content block moved down successfully.');
    }

    public function duplicate(ContentBlock $contentBlock): RedirectResponse
    {
        $new = $contentBlock->replicate();
        $new->section_key = $contentBlock->section_key . '_copy_' . now()->timestamp;
        $new->label = $contentBlock->label . ' Copy';
        $new->sort_order = $contentBlock->sort_order + 1;
        $new->is_active = false;
        $new->save();

        ActivityLogger::log(
            module: 'content_blocks',
            action: 'duplicate',
            description: 'Duplicated content block: ' . $contentBlock->label,
            subject: $new,
            properties: [
                'original_id' => $contentBlock->id,
                'new_id' => $new->id,
            ],
            request: request()
        );

        return back()->with('success', 'Content block duplicated successfully.');
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'selected_items' => ['required', 'array'],
            'selected_items.*' => ['integer', 'exists:content_blocks,id'],
            'bulk_action' => ['required', 'string'],
        ]);

        $items = ContentBlock::whereIn('id', $validated['selected_items'])->get();

        switch ($validated['bulk_action']) {
            case 'activate':
                ContentBlock::whereIn('id', $validated['selected_items'])->update(['is_active' => true]);

                ActivityLogger::log(
                    module: 'content_blocks',
                    action: 'bulk_activate',
                    description: 'Bulk activated content blocks.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected content blocks activated successfully.');

            case 'deactivate':
                ContentBlock::whereIn('id', $validated['selected_items'])->update(['is_active' => false]);

                ActivityLogger::log(
                    module: 'content_blocks',
                    action: 'bulk_deactivate',
                    description: 'Bulk deactivated content blocks.',
                    properties: [
                        'selected_items' => $validated['selected_items'],
                    ],
                    request: $request
                );

                return back()->with('success', 'Selected content blocks deactivated successfully.');

            case 'delete':
                ActivityLogger::log(
                    module: 'content_blocks',
                    action: 'bulk_delete',
                    description: 'Bulk deleted content blocks.',
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

                return back()->with('success', 'Selected content blocks deleted successfully.');

            default:
                return back()->with('success', 'No valid bulk action selected.');
        }
    }
}