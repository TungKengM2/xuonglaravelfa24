@extends('admin.layouts.master')

@section('title')
    Thêm mới tin tức
@endsection

@section('content')

    <h1>Thêm mới tin tức</h1>

    @if (session()->has('success'))
        <div class="alert alert-primary">
            Thêm mới thành công
        </div>
    @endif



    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="container" style="margin-top: 100px">
        <form method="POST" action="{{ route('adminposts.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="category_id" class="col-4 col-form-label">Chọn Danh Mục</label>
                <div class="col-8">
                    <select id="category_id" name="category_id" class="form-select">

                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="title" class="col-4 col-form-label">Title</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="description" class="col-4 col-form-label">Description</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="description" id="description"
                        value="{{ old('description') }}" />
                </div>
            </div>


            <div class="mb-3 row">
                <label for="image" class="col-4 col-form-label">Image</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="image" id="image" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="views" class="col-4 col-form-label">Views</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="views" id="views" />
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection
