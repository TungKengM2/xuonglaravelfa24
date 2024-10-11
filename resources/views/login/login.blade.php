@extends('master1')

@section('content')
    <h1>Đăng nhập</h1>

    <form action="/login" method="POST" class="container">
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
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Nhớ tài khoản</label>
        </div>
        <button class="btn btn-primary" type="submit">Đăng nhập</button>
    </form>


@endsection
