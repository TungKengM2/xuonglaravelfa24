@extends('master1')

@section('title')
    Danh sách nhân viên
@endsection

@section('content')
    <h1>Danh sách nhân viên
        <a class="btn btn-primary" href="{{ route('employees.create') }}">Thêm Mới</a>
    </h1>

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

    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">FIRST_NAME</th>
                    <th scope="col">LAST_NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">DATE_OF_BIRTH</th>
                    <th scope="col">HIRE_DATE</th>
                    <th scope="col">SALARY</th>
                    <th scope="col">IS ACTIVE</th>
                    <th scope="col">DEPARTMENT_ID</th>
                    <th scope="col">MANAGER_ID</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">PROFILE_PICTURE</th>
                    <th scope="col">CREATED_AT</th>
                    <th scope="col">UPDATED_AT</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $employee)
                    <tr class="">
                        <td scope="row">{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->hire_date }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            @if ($employee->is_active)
                                <span class="badge bg-primary">YES</span>
                            @else
                                <span class="badge bg-danger">NO</span>
                            @endif
                        </td>
                        <td>{{ $employee->department_id }}</td>
                        <td>{{ $employee->manager_id }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="{{ Storage::url($employee->profile_picture) }}" width="100px">
                            @endif
                        </td>
                        <td>{{ $employee->created_at }}</td>
                        <td>{{ $employee->updated_at }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('employees.show', $employee) }}">Show</a>
                            <a class="btn btn-warning" href="{{ route('employees.edit', $employee) }}">Edit</a>

                            <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Có chắc chắn xoá không?')"
                                    class="btn btn-danger">XM</button>
                            </form>

                            <form action="{{ route('employees.forceDestroy', $employee) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button type="submit" onclick="return confirm('Có chắc chắn xoá không?')"
                                    class="btn btn-dark">XC</button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{ $data->Links() }}
    </div>
@endsection
