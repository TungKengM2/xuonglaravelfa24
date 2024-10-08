@extends('posts.layouts.master')

@section('content')
    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8  mb-5 mb-lg-0">
                    <h2 class="h5 section-title mt-5">Recent Post</h2>

                    @foreach ($data as $post)
                        <article class="card mb-4">
                            <div class="post-slider">
                                @if ($post->image)
                                    <img src="{{ Storage::url($post->image) }}" width="100px" class="card-img-top"
                                        alt="post-thumb">
                                @endif
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title" href="post-elements.html">{{ $post->name }}</a>
                                </h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="author-single.html" class="card-meta-author">
                                            <img src="/clients/images/john-doe.jpg" alt="John Doe">
                                            <span>John Doe</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-eye"></i>Views: {{ $post->views }}
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-calendar"></i>{{ $post->created_at }}
                                    </li>
                                    <li class="list-inline-item">
                                        {{-- <ul class="card-meta-tag list-inline">
                                            <li class="list-inline-item"><a href="tags.html">Demo</a></li>
                                            <li class="list-inline-item"><a href="tags.html">Elements</a></li>
                                        </ul> --}}
                                    </li>
                                </ul>
                                <p>{{ $post->title }}</p>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary">Read More</a>
                            </div>
                        </article>
                    @endforeach



                    <ul class="pagination justify-content-center">
                        {{ $data->Links() }}
                    </ul>
                </div>

            </div>
        </div>

    </section>
@endsection
