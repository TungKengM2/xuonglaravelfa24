@extends('Admin.layouts.master')

@section('title')
    Danh sách tin tức
@endsection

@section('content')
    <div style="margin-top: 80px">
        <h1>Danh sách tin tức</h1>

        @if (session()->has('success') && !session()->get('success'))
            <div class="alert alert-info">
                {{ session()->get('error') }}
            </div>
        @endif

        @if (session()->has('success') && session()->get('success'))
            <div class="alert alert-info">
                Thao tác thành công
            </div>
        @endif
        {{-- <a href="{{ route('posts.create') }}" class="btn btn-primary">Thêm mới</a> --}}


        <table class="table mt-2 mb-2">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Views</th>
                <th>CREATE_AT</th>
                <th>UPDATE_AT</th>
                <th>ACTION</th>
            </tr>

            @foreach ($data as $adminpost)
                <tr>
                    <td>{{ $adminpost->id }}</td>
                    <td>{{ $adminpost->name }}</td>
                    <td>{{ $adminpost->category_id }}</td>
                    <td>{{ $adminpost->title }}</td>
                    <td>{{ $adminpost->description }}</td>
                    <td>
                        <img src="{{ \Storage::url($adminpost->image) }}" width="50px" alt="">
                    </td>
                    <td>{{ $adminpost->views }}</td>
                    <td>{{ $adminpost->created_at }}</td>
                    <td>{{ $adminpost->updated_at }}</td>
                    <td>
                        <a href="{{ route('adminposts.show', $adminpost) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('adminposts.edit', $adminpost) }}" class="btn btn-warning mt-2 mb-2">Cập nhập</a>

                        <form action="{{ route('adminposts.destroy', $adminpost) }}" method="post">

                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xoá không?')"
                                class="btn btn-danger">Xoá Mềm</button>
                        </form>

                        {{-- <form action="{{ route('adminposts.forceDestroy', $adminpost) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Có chắc chắn xoá không?')"
                                class="btn btn-dark">Xoá Cứng</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    {{ $data->Links() }}
@endsection
