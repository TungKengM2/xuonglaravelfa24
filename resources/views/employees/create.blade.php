@extends('master1')

@section('title')
    Thêm mới nhân viên
@endsection

@section('content')
    <h1>Thêm mới nhân viên</h1>

    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
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

    <div class="container">
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">

            @csrf

            <div class="mb-3 row">
                <label for="first_name" class="col-4 col-form-label">First name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="last_name" class="col-4 col-form-label">Last Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{old('phone')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="date_of_birth" class="col-4 col-form-label">Date_Of_Birth</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{old('date_of_birth')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="hire_date" class="col-4 col-form-label">Hire_Date</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="hire_date" id="hire_date" value="{{old('hire_date')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="salary" class="col-4 col-form-label">Salary</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="salary" id="salary" value="{{old('salary')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Is Active?</label>
                <div class="col-8">
                    <input type="checkbox" class="form-checkbox" value="1" name="is_active" id="is_active" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="department_id" class="col-4 col-form-label">Department_Id</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="department_id" id="department_id" value="{{old('department_id')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="manager_id" class="col-4 col-form-label">Manager_Id</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="manager_id" id="manager_id" value="{{old('manager_id')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}" />
                </div>
            </div>

            <div class="mb-3 row">
                <label for="profile_picture" class="col-4 col-form-label">Profile_Picture</label>
                <div class="col-8">
                    <input type="file" class="form-control" value="1" name="profile_picture" id="profile_picture" />
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
