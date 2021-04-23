@extends('layouts.backend.app')

@section('title', "Post Add")

@push('extracss')
<link href="{{ asset('assets/backend') }}/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush


@section('BackendContent')


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Create Post</h2>
        </div>

        <form action="{{url('author/post').'/'. $post['id']}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>Add to Post</h2>
                        </div>
                        <div class="body">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="title" value="{{ $post['title'] }}" id="title" class="form-control">
                                    <label class="form-label" for="title">Post Title</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="image">Featured Image</label>
                                <img style="width: 150px;" src="{{asset('storage/post').'/'. $post['image']}}" alt="">
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="status" id="status" class="filled-in" value="1" {{ $post['status'] == true ? 'checked' : '' }}>
                                <label for="status">Published</label>
                            </div>


                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header">
                            <h2>Category and Tag</h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('categories')? 'focused error' : '' }}">
                                    <label for="categories">Select Category</label>
                                    <select name="categories[]" id="categories" class="form-control show-tick"
                                        data-live-search="true" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id']}}"
                                                @foreach ($post['categories'] as $postcategory)
                                                    {{ $postcategory['id'] == $category['id'] ? 'selected' : ''}}
                                                @endforeach
                                            >{{ $category['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line {{ $errors->has('tags')? 'focused error' : '' }}">

                                    <label for="tags">Select Tag</label>
                                    <select name="tags[]" id="tags" class="form-control show-tick"
                                        data-live-search="true" multiple>
                                        @foreach ($tags as $tag)
                                            <option
                                            @foreach ($post['tags'] as $posttag)
                                                {{ $posttag['id'] == $tag['id'] ? 'selected' : ''}}
                                            @endforeach
                                            
                                            value="{{ $tag['id']}}">{{ $tag['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Add to Post</h2>
                        </div>
                        <div class="body">
                            
                            <textarea name="body" id="tinymce">{{$post['body']}}</textarea>

                            <br>
                            <button type="reset" class="btn btn-primary m-t-15 waves-effect">Reset</button>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
        </form>
    </div>
</section>

@endsection
@push('extrajs')
<script src="{{ asset('assets/backend') }}/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend') }}/plugins/tinymce/tinymce.js"></script>
    <script>
        $(function () {
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{ asset("assets/backend") }}/plugins/tinymce';
});
    </script>
@endpush
