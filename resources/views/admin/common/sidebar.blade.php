<ul class="nav nav-sidebar">
    <li class="{{ Request::segment(2) == 'products' ? 'active' : '' }}"><a href="{{route('products.index')}}">Products</a></li>
    <li class="{{ Request::segment(2) == 'factories' ? 'active' : '' }}"><a href="{{ route('factories.index') }}">Factories</a> </li>
    <li class="{{ Request::segment(2) == 'categories' ? 'active' : '' }}"><a href="{{ route('categories.index') }}">Categories</a> </li>

</ul>