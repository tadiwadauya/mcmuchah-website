@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Create Content Block';
    @endphp

    <div class="card">
        <h3 style="margin-top: 0;">Create Content Block</h3>

        <form action="{{ route('admin.content-blocks.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.content-blocks._form')
        </form>
    </div>
@endsection