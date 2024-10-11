@extends('master1')

@section('content')
    <h1>Đăng ký</h1>
    <form action="/register" method="POST" class="container">
        @csrf
        <div>
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>
        <div>
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>
        <div>
            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
        </div>
        <button class="btn btn-primary" type="submit">Đăng ký</button>
    </form>
@endsection
