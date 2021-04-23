@extends('layouts.backend.app')

@section('title', "Catagory Edit")
@section('BackendContent')


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Create Tags</h2>
        </div>

        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add to Tag
                            <small>Awesome tag add here</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form action="{{url('admin/category/update').'/'.$category['id']}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="name" id="email_address" class="form-control" value="{{$category['name']}}">
                                    <label class="form-label">Category Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                   <img style="width: 300px;" src="{{ asset('storage/category') }}/{{$category['image']}}" />
                                    <input type="file" name="image" id="email_address" class="form-control">
                                    <label class="form-label">Image</label>
                                </div>
                            </div>

                            <br>
                            <button type="reset" class="btn btn-primary m-t-15 waves-effect">Reset</button>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>
</section>

@endsection
