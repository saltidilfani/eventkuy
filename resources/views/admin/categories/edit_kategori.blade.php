@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Kategori: {{ $category->name }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Kategori</button>
        </form>
    </div>
</div>
@endsection 