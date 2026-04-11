<script src="{{ asset('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof tinymce === 'undefined') {
            console.error('TinyMCE failed to load. Check the script path.');
            return;
        }

        tinymce.remove('{{ $selector ?? ".rich-editor" }}');

        tinymce.init({
            selector: '{{ $selector ?? ".rich-editor" }}',
            height: {{ $height ?? 420 }},
            license_key: 'gpl',
            menubar: true,
            plugins: 'lists link image table code wordcount',
            toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image table | alignleft aligncenter alignright | code',
            branding: false,
            promotion: false
        });
    });
</script>