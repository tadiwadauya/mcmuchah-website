@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Edit Service';
    @endphp

    <div class="card">
        <h3 style="margin-top: 0;">Edit Service</h3>

        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.services._form')
        </form>
    </div>
@endsection