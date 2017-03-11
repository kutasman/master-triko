<ul class="nav nav-sidebar">
    <li class="{{ Request::segment(2) == 'products' ? 'active' : '' }}"><a href="{{route('products.index')}}">Products<span class="sr-only">(current)</span></a></li>
    <li class="{{ Request::segment(2) == 'attributes' ? 'active' : '' }}"><a href="{{ route('attributes.index') }}">Attributes</a> </li>

</ul>