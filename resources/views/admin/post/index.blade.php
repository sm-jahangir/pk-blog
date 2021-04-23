@extends('layouts.backend.app')

@section('title', "Posts List")
@push('extracss')
    
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush
@section('BackendContent')


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Posts List
                <small>Total Post <a>{{ $posts->count() }}</a></small>
            </h2>
        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Export Posts
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th width="2%">SL</th>
                                        <th width="15%">Title</th>
                                        <th width="24%">Body</th>
                                        <th width="15%">Image</th>
                                        <th width="8%">Author</th>
                                        <th width="5%">View</th>
                                        <th width="5%">Is Approved</th>
                                        <th width="6%">Status</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th width="1%">SL</th>
                                        <th width="15%">Title</th>
                                        <th width="24%">Body</th>
                                        <th width="15%">Image</th>
                                        <th width="8%">Author</th>
                                        <th width="5%">View</th>
                                        <th width="5%">Is Approved</th>
                                        <th width="5%">Status</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($posts as $item)
                                    <tr>
                                        <td>{{$item['id']}}</td>
                                        <td>{{ Str::limit($item['title'], 10) }}</td>
                                        <td>{{ Str::limit($item['body'], 100) }}</td>
                                        <td>
                                            <img style="width: 100px" src="{{asset('storage/post').'/'.$item['image']}}" />
                                        </td>
                                        <td>{{$item['user']['name']}}</td>
                                        <td>{{$item['view_count']}}</td>
                                        <td>
                                            @if ($item['is_approved'] == true)
                                                <a href="{{url('admin/post').'/'.$item['id'].'/'.'approve'}}"><span class="badge bg-blue">Approved</span></a>
                                            @else
                                                <a href="{{url('admin/post').'/'.$item['id'].'/'.'approve'}}"><span class="badge bg-pink">Pending</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item['status'] == true)
                                                <span class="badge bg-blue">Published</span>
                                            @else
                                                <span class="badge bg-pink">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('admin/post').'/'.$item['id']}}"><button  type="button" class="btn btn-danger waves-effect"><i class="material-icons">visibility</i></button></a>
                                            <a href="{{url('admin/post/delete').'/'.$item['id']}}"><button  type="button" class="btn btn-danger waves-effect"><i class="material-icons">delete_forever</i></button></a>
                                        <a href="{{url('admin/post/edit').'/'.$item['id']}}"><button type="button" class="btn btn-primary waves-effect"><i class="material-icons">mode_edit</i></button></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>

@endsection
@push('extrajs')
    
<script src="{{ asset('assets/backend') }}/js/pages/tables/jquery-datatable.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="{{ asset('assets/backend') }}/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>



@endpush
