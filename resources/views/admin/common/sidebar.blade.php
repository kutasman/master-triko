<ul class="nav nav-sidebar">
    <li class="{{ Request::segment(2) == 'products' ? 'active' : '' }}"><a href="{{route('products.index')}}">Products<span class="sr-only">(current)</span></a></li>
    <li class="{{ Request::segment(2) == 'categories' ? 'active' : '' }}"><a href="{{ route('categories.index') }}">Categories</a> </li>

</ul>