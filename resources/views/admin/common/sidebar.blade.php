
<aside class="menu">
    <p class="menu-label">
        General
    </p>
    <ul class="menu-list">
        <li class="{{ Request::segment(2) == 'products' ? 'active' : '' }}"><a href="{{route('products.index')}}">Products</a></li>
        <li class="{{ Request::segment(2) == 'factories' ? 'active' : '' }}"><a href="{{ route('factories.index') }}">Factories</a> </li>
        <li class="{{ Request::segment(2) == 'categories' ? 'active' : '' }}"><a href="{{ route('categories.index') }}">Categories</a> </li>
        <li class="{{ Request::segment(2) == 'modificators' ? 'active' : '' }}"><a href="{{ route('modificators.index') }}">Modificators</a> </li>
        <li class="{{ Request::segment(2) == 'shipping-types' ? 'active' : '' }}"><a href="{{ route('shipping-types.index') }}">Shipping types</a> </li>
        <li class="{{ Request::segment(2) == 'payment-types' ? 'active' : '' }}"><a href="{{ route('payment-types.index') }}">Payment types</a> </li>
        <li class="{{ Request::segment(2) == 'order-statuses' ? 'active' : '' }}"><a href="{{ route('order-statuses.index') }}">Order statuses</a> </li>
        <li class="{{ Request::segment(2) == 'orders' ? 'active' : '' }}"><a href="{{ route('orders.index') }}">Orders</a> </li>
    </ul>
    <p class="menu-label">
        Administration
    </p>
    <ul class="menu-list">
        <li><a>Team Settings</a></li>
        <li>
            <a class="is-active">Manage Your Team</a>
            <ul>
                <li><a>Members</a></li>
                <li><a>Plugins</a></li>
                <li><a>Add a member</a></li>
            </ul>
        </li>
        <li><a>Invitations</a></li>
        <li><a>Cloud Storage Environment Settings</a></li>
        <li><a>Authentication</a></li>
    </ul>
    <p class="menu-label">
        Transactions
    </p>
    <ul class="menu-list">
        <li><a>Payments</a></li>
        <li><a>Transfers</a></li>
        <li><a>Balance</a></li>
    </ul>
</aside>