<ul class="nav nav-sidebar">
    <li class="{{ Request::segment(2) == 'products' ? 'active' : '' }}"><a href="{{route('products.index')}}">Products</a></li>
    <li class="{{ Request::segment(2) == 'categories' ? 'active' : '' }}"><a href="{{ route('categories.index') }}">Categories</a> </li>
    <li class="{{ Request::segment(2) == 'models' ? 'active' : '' }}"><a href="{{route('models.index')}}">Models</a></li>
    <li class="{{ Request::segment(2) == 'product-types' ? 'active' : '' }}"><a href="{{route('product-types.index')}}">Product Types</a></li>

</ul>