@extends('layouts.backend.app')

@section('title', "Post Add")



@section('BackendContent')


<section class="content">
    <div class="container-fluid">
        <a class="btn btn-danger waves-effect" href="{{ url('admin/post')}}">Back</a>

        @if ($post->is_approved == false)
            <button type="button" class="btn btn-success pull-right">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
        @else
            
        <button type="button" class="btn btn-danger pull-right" disabled>
            <i class="material-icons">done</i>
            <span>Approved</span>
        </button>
        @endif
        <br>
        <br>
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $post['title']}}
                                <small>Posted By <strong><a href="">{{ $post['user']['name'] }}</a></strong>On {{$post['created_at']}}</small>
                            </h2>
                        </div>
                        <div class="body">
                            


                            {!! $post['body'] !!}




                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">


                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Categories</h2>
                        </div>
                        <div class="body">
                            
                            @foreach ($post['categories'] as $category)
                                <span class="label bg-cyan">{{ $category['name'] }}</span>
                            @endforeach

                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-green">
                            <h2>Tags</h2>
                        </div>
                        <div class="body">
                            
                            @foreach ($post['tags'] as $tag)
                                <span class="label bg-green">{{ $tag['name'] }}</span>
                            @endforeach

                        </div>
                    </div>
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>Images</h2>
                        </div>
                        <div class="body">
                            
                           <img class="img-responsive thumbnail" src="{{ asset('storage/post').'/'. $post['image'] }}" alt="">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
            <!-- Vertical Layout | With Floating Label -->
           
    </div>
</section>

@endsection






