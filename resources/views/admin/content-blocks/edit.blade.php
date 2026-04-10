@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Edit Content Block';
    @endphp

    <div class="card">
        <h3 style="margin-top: 0;">Edit Content Block</h3>

        <form action="{{ route('admin.content-blocks.update', $contentBlock) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.content-blocks._form')
        </form>
    </div>
@endsection