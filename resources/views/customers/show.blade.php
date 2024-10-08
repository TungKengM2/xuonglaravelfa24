@extends('master1')

@section('title')
    Xem chi tiết khách hàng: {{ $customer->name }}
@endsection

@section('content')
    <h1>Xem chi tiết khách hàng: {{ $customer->name }}</h1>

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">Tên Trường</th>
                    <th scope="col">Giá trị</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($customer->toArray() as $key => $value)
                    <tr class="">
                        <td scope="row">{{ strtoupper($key) }}</td>
                        <td>
                            @php
                                switch ($key) {
                                    case 'avatar':
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
