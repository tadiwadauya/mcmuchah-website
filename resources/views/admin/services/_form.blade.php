@csrf

<div class="grid-2">
    <div class="form-group">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
    </div>

    <div class="form-group">
        <label class="form-label">Category</label>
        <select name="category" class="form-control">
            <option value="">Select category</option>
            <option value="printing" {{ old('category', $service->category ?? '') === 'printing' ? 'selected' : '' }}>Printing</option>
            <option value="promo" {{ old('category', $service->category ?? '') === 'promo' ? 'selected' : '' }}>Promotional Materials</option>
            <option value="digital" {{ old('category', $service->category ?? '') === 'digital' ? 'selected' : '' }}>Digital Marketing</option>
            <option value="other" {{ old('category', $service->category ?? '') === 'other' ? 'selected' : '' }}>Other Services</option>
            <option value="trade_reference" {{ old('category', $service->category ?? '') === 'trade_reference' ? 'selected' : '' }}>Trade Reference</option>
        </select>
    </div>
</div>

<div class="grid-2">
    <div class="form-group">
        <label class="form-label">Group Name</label>
        <input type="text" name="group_name" class="form-control" value="{{ old('group_name', $service->group_name ?? '') }}">
        <div class="small-text">Use for category "other". Example: Graphic Design</div>
    </div>

    <div class="form-group">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
    </div>
</div>

<div class="form-group">
    <label class="form-label">Short Excerpt</label>
    <textarea name="excerpt" class="form-control" rows="4">{{ old('excerpt', $service->excerpt ?? '') }}</textarea>
</div>

<div class="form-group">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control rich-editor">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="grid-2">
    <div class="form-group">
        <label class="form-label">Manual Image Path</label>
        <input type="text" name="image" class="form-control" value="{{ old('image', $service->image ?? '') }}">
        <div class="small-text">Optional if you are not uploading an image.</div>
    </div>

    <div class="form-group">
        <label class="form-label">Upload Image</label>
        <input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp,.gif">
    </div>
</div>

@if(!empty($service?->image_url))
    <div class="form-group">
        <label class="form-label">Current Image</label>
        <div style="margin-bottom: 10px;">
            <img src="{{ $service->image_url }}" alt="Current image" style="max-width: 220px; border-radius: 12px; border: 1px solid #ddd;">
        </div>

        <label class="checkbox-wrap">
            <input type="checkbox" name="remove_image" value="1">
            <span>Remove current image</span>
        </label>
    </div>
@endif

<div class="grid-3">
    <div class="form-group">
        <label class="form-label">Icon</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? '') }}">
    </div>

    <div class="form-group">
        <label class="form-label">Button Text</label>
        <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $service->button_text ?? '') }}">
    </div>

    <div class="form-group">
        <label class="form-label">Button Link</label>
        <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $service->button_link ?? '') }}">
    </div>
</div>

<div class="form-group">
    <label class="form-label">Client Link</label>
    <input type="text" name="client_link" class="form-control" value="{{ old('client_link', $service->client_link ?? '') }}">
</div>

<div class="grid-3">
    <div class="form-group">
        <label class="checkbox-wrap">
            <input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home', $service->show_on_home ?? true) ? 'checked' : '' }}>
            <span>Show on Home</span>
        </label>
    </div>

    <div class="form-group">
        <label class="checkbox-wrap">
            <input type="checkbox" name="show_in_navbar" value="1" {{ old('show_in_navbar', $service->show_in_navbar ?? true) ? 'checked' : '' }}>
            <span>Show in Navbar</span>
        </label>
    </div>

    <div class="form-group">
        <label class="checkbox-wrap">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}>
            <span>Active</span>
        </label>
    </div>
</div>

<div style="display: flex; gap: 10px; flex-wrap: wrap;">
    <button type="submit" class="btn btn-success">Save Service</button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
</div>

@include('admin.partials.editor', ['selector' => '.rich-editor', 'height' => 420])