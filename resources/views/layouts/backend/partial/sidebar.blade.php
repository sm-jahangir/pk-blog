<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('assets/backend') }}/images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}
            </div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>{{ __('Sign Out') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a href="javascript:void(0);"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if (Request::is('admin*'))

                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{url('admin/dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/tags*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>Tags</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/tags/add')}}">
                                <span>Add Tag</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin/tags')}}">
                                <span>Tag List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>Category</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/category/add')}}">
                                <span>Add Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin/category')}}">
                                <span>Category List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>post</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/post/add')}}">
                                <span>Add post</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin/post/')}}">
                                <span>post List</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{url('/admin/subscriber')}}">
                        <i class="material-icons">trending_down</i>
                        <span>Subscribers</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>Multi Level Menu</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);">
                                <span>Menu Item</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/')}}">
                                <span>Menu Item - 2</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Level - 2</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="javascript:void(0);">
                                        <span>Menu Item</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                        <span>Level - 3</span>
                                    </a>
                                    <ul class="ml-menu">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <span>Level - 4</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                
                <li class="{{ Request::is('admin/favorite') ? 'active' : '' }}">
                    <a href="{{url('admin/favorite')}}">
                        <i class="material-icons">favorite</i>
                        <span>Favorite Post</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/comments') ? 'active' : '' }}">
                    <a href="{{url('admin/comments')}}">
                        <i class="material-icons">comment</i>
                        <span>Comments Post</span>
                    </a>
                </li>
                <li class="header">System</li>
                
                <li>
                    <a href="{{url('admin/settings')}}">
                        <i class="material-icons">trending_down</i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">


                        <i class="material-icons">home</i>
                        <span>{{ __('Sign Out') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                
            @elseif(Request::is('author*'))

                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{url('author/dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                        {{-- ------------------- --}}

                <li class="{{ Request::is('author/tags*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>Tags</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('author/tags/add')}}">
                                <span>Add Tag</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/author/tags')}}">
                                <span>Tag List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('author/category*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>Category</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('author/category/add')}}">
                                <span>Add Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/author/category')}}">
                                <span>Category List</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>post</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('author/post/create')}}">
                                <span>Add post</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/author/post/')}}">
                                <span>post List</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="{{url('author/favorite')}}">
                        <i class="material-icons">trending_down</i>
                        <span>Favorite Post</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/comments') ? 'active' : '' }}">
                    <a href="{{url('author/comments')}}">
                        <i class="material-icons">comment</i>
                        <span>Comments Post</span>
                    </a>
                </li>


                {{-- ------------------- --}}
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">trending_down</i>
                        <span>Multi Level Menu</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);">
                                <span>Menu Item</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/')}}">
                                <span>Menu Item - 2</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Level - 2</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="javascript:void(0);">
                                        <span>Menu Item</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                        <span>Level - 3</span>
                                    </a>
                                    <ul class="ml-menu">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <span>Level - 4</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                
                <li class="header">System</li>
                
                <li>
                    <a href="{{url('author/settings')}}">
                        <i class="material-icons">trending_down</i>
                        <span>Settings</span>
                    </a>
                </li>
            @endif




        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
