@extends('admin.layouts.master')

@section('title')
    Cập nhập tin tức: {{ $adminpost->name }}
@endsection

@section('content')
    <h1>Cập nhập tin tức: {{ $adminpost->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-success">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-primary">
            Cập nhập thành công
        </div>
    @endif

    <form class="container" style="margin-top: 100px" action="{{ route('adminposts.update', $adminpost) }}" method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="name" class="col-4 col-form-label">Name</label>
            <div class="col-8">
                <input type="text" class="form-control" name="name" id="name" value="{{ $adminpost->name }}" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="category_id" class="col-4 col-form-label">Chọn Danh Mục</label>
            <div class="col-8">
                <select id="category_id" name="category_id" class="form-select">

                    <option value="">Chọn danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $adminpost->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="title" class="col-4 col-form-label">Title</label>
            <div class="col-8">
                <input type="tel" class="form-control" name="title" id="title" value="{{ $adminpost->title }}" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="description" class="col-4 col-form-label">Description</label>
            <div class="col-8">
                <input type="text" class="form-control" name="description" id="description"
                    value="{{ $adminpost->description }}" />
            </div>
        </div>


        <div class="mb-3 row">
            <label for="image" class="col-4 col-form-label">Image</label>
            <div class="col-8">
                <input type="file" class="form-control" name="image" id="image" />
                <img src="{{ \Storage::url($adminpost->image) }}" width="50px" alt="">

            </div>
        </div>

        <div class="mb-3 row">
            <label for="views" class="col-4 col-form-label">Views</label>
            <div class="col-8">
                <input type="text" class="form-control" name="views" id="views" value="{{ $adminpost->views }}" />
            </div>
        </div>

        <div class="mb-3 row">
            <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-primary">
                    Cập nhập
                </button>
            </div>
        </div>
        <a href="{{ route('adminposts.index') }}" class="btn btn-danger">Quay lại trang danh sách</a>
    </form>
@endsection
