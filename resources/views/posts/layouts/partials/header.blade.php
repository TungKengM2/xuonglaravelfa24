<?php
$loaitin_arr = DB::table('category_posts')->select('id', 'name')->orderBY('id', 'asc')->limit(5)->get();
?>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="{{ url('/posts') }}">
            <img class="img-fluid" width="100px" src="/clients/images/logo.png" alt="Reader | Hugo Personal Blog Template">
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ url('posts') }}">Trang Chủ</a>

                </li>

                @foreach ($loaitin_arr as $lt)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.posts', $lt->id) }}">{{ $lt->name }}</a>
                    </li>
                @endforeach


                <a class="nav-link" href="{{ url('/adminHome') }}">Admin</a>
            </ul>
        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">
            <select class="m-2 border-0 bg-transparent" id="select-language">
                <option id="en" value="" selected>En</option>
                <option id="fr" value="">Fr</option>
            </select>


            <form class="search-bar">
                <input id="search-query" name="s" type="search" placeholder="Type &amp; Hit Enter...">
            </form>

            <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse"
                data-target="#navigation">
                <i class="ti-menu"></i>
            </button>
        </div>

    </nav>
</div>
