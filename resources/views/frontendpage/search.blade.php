@extends('layouts.frontend.app')
@section('title')
    {{ $query }}
@endsection


@push('extracss')

<link href="{{asset('assets/frontend')}}/category/css/styles.css" rel="stylesheet">

<link href="{{asset('assets/frontend')}}/category/css/responsive.css" rel="stylesheet">

@endpush

@section('MainContent')

<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{$posts->count()}} Results {{$query}}</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @if ($posts->count() > 0)
                
            @foreach ($posts as $post)
                
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{asset('storage/post'). '/'. $post->image}}" alt="Blog Image"></div>

                        <a class="avatar" href="{{ route('post.details', $post->slug) }}"><img src="{{asset('storage/post'). '/'. $post->image}}" alt="Profile Image"></a>

                        <div class="blog-info">

                            <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

                            <ul class="post-footer">
                               
                            <li>
                                @guest
                                    <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                            closeButton: true,
                                            progressBar: true,
                                        })"><i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>
                                @else
                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-form-{{ $post->id }}').submit();"
                                            class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"><i class="ion-heart"></i>{{ $post->favorite_to_user->count() }}</a>

                                    <form id="favorite-form-{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display: none;">
                                            @csrf
                                        </form>
                                @endguest
                            </li>
                            <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{ $post['view_count'] }}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->
            @endforeach
            @else
                <div class="col col-md-12"> 
                    <h3 style="text-align: center">No Posts Found in this '{{$query}}' word</h3>
                </div>
            @endif


        </div><!-- row -->

        {{-- {{ $posts->links() }} --}}
        {{-- <a class="load-more-btn" href="#"><b>LOAD MORE</b></a> --}}

    </div><!-- container -->
</section><!-- section -->


@endsection


@push('extrajs')
@endpush
