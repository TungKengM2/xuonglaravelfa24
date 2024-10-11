@extends('master1')

@section('content')
    <h1>Quên mật khẩu</h1>

    <form action="{{ route('password.email') }}" method="POST" class="container">
        @csrf
        <label class="form-label" for="email">Nhập địa chỉ email để khôi phục mật khẩu:</label>
        <input class="form-control" type="email" id="email" name="email" required>
        <button class="btn btn-primary" type="submit">Gửi link khôi phục mật khẩu</button>
    </form>
@endsection
