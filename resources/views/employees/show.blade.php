@extends('master1')

@section('title')
    Xem chi tiết nhân viên: {{ $employee->last_name }}
@endsection

@section('content')
    <h1>Xem chi tiết nhân viên: {{ $employee->last_name }}</h1>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Tên Trường</th>
                    <th scope="col">Giá trị</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($employee->toArray() as $key => $value)
                    <tr class="">
                        <td scope="row">{{ strtoupper($key) }}</td>
                        <td>
                            @php
                                switch ($key) {
                                    case 'profile_picture':
                                        if ($value) {
                                            $url = Storage::url($value);
                                            echo "<img src='$url' width='100px'>";
                                        }

                                        break;

                                    case 'is_active':
                                        echo $value
                                            ? '<span class="badge bg-primary">YES</span>'
                                            : '<span class="badge bg-danger">NO</span>';
                                        break;

                                    default:
                                        echo $value;
                                        break;
                                }
                            @endphp
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
