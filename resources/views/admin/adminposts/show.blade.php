@extends('admin.layouts.master')

@section('title')
    Danh sách tin tức
@endsection

@section('content')
    <div class="container" style="margin-top: 80px">
        <h1>Thông tin chi tiết tin tức</h1>

        <table class="table">
            <tr>
                <th>TRƯỜNG</th>
                <th>VALUE</th>
            </tr>

            @foreach ($adminpost->toArray() as $field => $value)
                <tr>
                    <td>{{ $field }}</td>
                    <td>
                        @php
                            switch ($field) {
                                case 'image':
                                    $url = \Storage::url($adminpost->image);
                                    echo "<img src=\"$url\" width=\"50px\" alt=\"\">";
                                    break;
                                default:
                                    echo $value;
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach
        </table>

        <a href="{{ route('adminposts.index') }}" class="btn btn-danger">Back to list</a>
    </div>
@endsection
