
<aside class="menu">
    <p class="menu-label">
        General
    </p>
    <ul class="menu-list">
        <li ><a {{ Request::segment(2) == 'products' ? 'class=is-active' : '' }} href="{{route('products.index')}}">Products</a></li>
        <li ><a {{ Request::segment(2) == 'factories' ? 'class=is-active' : '' }} href="{{ route('factories.index') }}">Factories</a> </li>
        <li ><a {{ Request::segment(2) == 'categories' ? 'class=is-active' : '' }} href="{{ route('categories.index') }}">Categories</a> </li>
        <li ><a {{ Request::segment(2) == 'modificators' ? 'class=is-active' : '' }} href="{{ route('modificators.index') }}">Modificators</a> </li>
        <li ><a {{ Request::segment(2) == 'shipping-types' ? 'class=is-active' : '' }} href="{{ route('shipping-types.index') }}">Shipping types</a> </li>
        <li ><a {{ Request::segment(2) == 'payment-types' ? 'class=is-active' : '' }} href="{{ route('payment-types.index') }}">Payment types</a> </li>
        <li ><a {{ Request::segment(2) == 'order-statuses' ? 'class=is-active' : '' }} href="{{ route('order-statuses.index') }}">Order statuses</a> </li>
        <li ><a {{ Request::segment(2) == 'orders' ? 'class=is-active' : '' }} href="{{ route('orders.index') }}">Orders</a> </li>
    </ul>
</aside>