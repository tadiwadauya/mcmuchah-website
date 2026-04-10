<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '{{ $selector ?? ".rich-editor" }}',
        height: {{ $height ?? 420 }},
        menubar: true,
        plugins: 'anchor autolink charmap codesample emoticons link lists media searchreplace table visualblocks wordcount code',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link table | bullist numlist | align | outdent indent | code removeformat'
    });
</script>