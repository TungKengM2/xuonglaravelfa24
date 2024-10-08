@extends('posts.layouts.master')

@section('content')
    <div class="container" style="margin-top: 100px">

        <div class="row justify-content-center">
            <div class=" col-lg-9  mb-5 mb-lg-0">

                    <article>
                        <div class="post-slider mb-4">
                            @if ($post->image)
                                <img src="{{ Storage::url($post->image) }}" width="100px" class="card-img-top"
                                    alt="post-thumb">
                            @endif
                        </div>

                        <h1 class="h2">{{ $post->name }}</h1>
                        <ul class="card-meta my-3 list-inline">
                            <li class="list-inline-item">
                                <a href="author-single.html" class="card-meta-author">
                                    <span>Charls Xaviar</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-eye"></i>{{ $post->views }}
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-calendar"></i>{{ $post->created_at }}
                            </li>
                        </ul>
                        <div class="content">
                            <p>{{ $post->description }}</p>
                        </div>
                    </article>


            </div>

            @include('posts.components.comment')
        </div>


    </div>
@endsection
