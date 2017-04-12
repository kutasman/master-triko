<ul class="nav nav-sidebar">
    <li class="{{ Request::segment(2) == 'products' ? 'active' : '' }}"><a href="{{route('products.index')}}">Products</a></li>
    <li class="{{ Request::segment(2) == 'factories' ? 'active' : '' }}"><a href="{{ route('factories.index') }}">Factories</a> </li>
    <li class="{{ Request::segment(2) == 'categories' ? 'active' : '' }}"><a href="{{ route('categories.index') }}">Categories</a> </li>
    <li class="{{ Request::segment(2) == 'modificators' ? 'active' : '' }}"><a href="{{ route('modificators.index') }}">Modificators</a> </li>
    <li class="{{ Request::segment(2) == 'shipping-types' ? 'active' : '' }}"><a href="{{ route('shipping-types.index') }}">Shipping types</a> </li>
    <li class="{{ Request::segment(2) == 'payment-types' ? 'active' : '' }}"><a href="{{ route('payment-types.index') }}">Payment types</a> </li>

</ul>