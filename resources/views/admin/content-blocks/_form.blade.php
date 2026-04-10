@csrf

<div class="grid-2">
    <div class="form-group">
        <label class="form-label">Page</label>
        <select name="page" class="form-control" required>
            <option value="">Select page</option>
            <option value="home" {{ old('page', $contentBlock->page ?? '') === 'home' ? 'selected' : '' }}>Home</option>
            <option value="about" {{ old('page', $contentBlock->page ?? '') === 'about' ? 'selected' : '' }}>About</option>
        </select>
    </div>

    <div class="form-group">
        <label class="form-label">Label</label>
        <input type="text" name="label" class="form-control" value="{{ old('label', $contentBlock->label ?? '') }}" required>
    </div>
</div>

<div class="grid-2">
    <div class="form-group">
        <label class="form-label">Section Key</label>
        <input type="text" name="section_key" class="form-control" value="{{ old('section_key', $contentBlock->section_key ?? '') }}" required>
        <div class="small-text">Example: home_hero_heading</div>
    </div>

    <div class="form-group">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $contentBlock->title ?? '') }}">
    </div>
</div>

<div class="form-group">
    <label class="form-label">Body</label>
    <textarea name="body" class="form-control rich-editor">{{ old('body', $contentBlock->body ?? '') }}</textarea>
</div>

<div class="grid-2">
    <div class="form-group">
        <label class="form-label">Manual Image Path</label>
        <input type="text" name="image" class="form-control" value="{{ old('image', $contentBlock->image ?? '') }}">
        <div class="small-text">Optional if you are not uploading an image.</div>
    </div>

    <div class="form-group">
        <label class="form-label">Upload Image</label>
        <input type="file" name="image_file" class="form-control" accept=".jpg,.jpeg,.png,.webp,.gif">
    </div>
</div>

@if(!empty($contentBlock?->image_url))
    <div class="form-group">
        <label class="form-label">Current Image</label>
        <div style="margin-bottom: 10px;">
            <img src="{{ $contentBlock->image_url }}" alt="Current image" style="max-width: 220px; border-radius: 12px; border: 1px solid #ddd;">
        </div>

        <label class="checkbox-wrap">
            <input type="checkbox" name="remove_image" value="1">
            <span>Remove current image</span>
        </label>
    </div>
@endif

<div class="grid-2">
    <div class="form-group">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $contentBlock->sort_order ?? 0) }}">
    </div>

    <div class="form-group" style="display: flex; align-items: end;">
        <label class="checkbox-wrap">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $contentBlock->is_active ?? true) ? 'checked' : '' }}>
            <span>Active</span>
        </label>
    </div>
</div>

<div style="display: flex; gap: 10px; flex-wrap: wrap;">
    <button type="submit" class="btn btn-success">Save Content Block</button>
    <a href="{{ route('admin.content-blocks.index') }}" class="btn btn-secondary">Cancel</a>
</div>

@include('admin.partials.editor', ['selector' => '.rich-editor', 'height' => 420])