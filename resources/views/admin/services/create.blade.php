@extends('layouts.admin')

@section('content')
    @php
        $pageTitle = 'Create Service';
    @endphp

    <div class="card">
        <h3 style="margin-top: 0;">Create Service</h3>

        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.services._form')
        </form>
    </div>
@endsection