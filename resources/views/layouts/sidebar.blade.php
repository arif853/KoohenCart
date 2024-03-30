<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{url('/dashboard')}}" class="brand-wrap">
            <img src="{{asset('admin/assets/imgs/Kohen_Logo_Main.png')}}" class="logo" alt="Koohen">
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
        </div>
    </div>
    <nav>
        @if(auth()->user()->hasRole(['Super Admin','Admin']))
        <ul class="menu-aside">
            <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="menu-link" href="{{('/dashboard')}}"> <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item has-submenu {{ request()->is('dashboard/products/*') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Products</span>
                </a>
                <div class="submenu">
                    <a href="{{route('products.create')}}">Add Product</a>
                    <a href="{{route('products.index')}}">Product List</a>
                    <a href="{{route('brands.index')}}">Brands</a>
                    <a href="{{route('category.index')}}">Categories</a>
                    {{-- <a href="{{route('subcategory.index')}}">Subcategories</a> --}}
                    <a href="{{route('varient.index')}}">Varient</a>
                </div>
            </li>

            <li class="menu-item has-submenu {{ request()->is('dashboard/orders/*') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_cart"></i>
                    <span class="text">Orders</span>
                </a>
                <div class="submenu">
                    <a href="{{route('order.index')}}">All Order list</a>
                    <a href="{{route('order.pending')}}">Pending Order list</a>
                    <a href="{{route('order.completed')}}">Completed Order</a>
                    <a href="{{route('order.return')}}">Order return</a>
                </div>
            </li>
            <li class="menu-item has-submenu {{ request()->is('dashboard/customers') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-supervisor_account"></i>
                    <span class="text">Customers</span>
                </a>
                <div class="submenu">
                    <a href="{{route('customer.index')}}">Customers list</a>
                    {{-- <a href="{{route('customer.profile')}}">Customer profile</a> --}}
                </div>
            </li>

            <li class="menu-item has-submenu {{ request()->is('dashboard/suppliers') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-supervised_user_circle"></i>
                    <span class="text">Suppliers</span>
                </a>
                <div class="submenu">
                    <a href="{{route('supplier.index')}}">Supplier list</a>
                    {{-- <a href="{{route('customer.profile')}}">Customer profile</a> --}}
                </div>
            </li>
            <li class="menu-item has-submenu {{ request()->is('dashboard/transaction') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-monetization_on"></i>
                    <span class="text">Transactions</span>
                </a>
                <div class="submenu">
                    <a href="{{route('transaction.index')}}">Transactions list</a>
                    {{-- <a href="{{route('customer.profile')}}">Customer profile</a> --}}
                </div>
            </li>
            <li class="menu-item has-submenu {{ request()->is('dashboard/promotion/*') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-trending_up"></i>
                    <span class="text">Promotions</span>
                </a>
                <div class="submenu">
                    <a href="{{route('offers.index')}}">Offers</a>
                    <a href="{{route('coupon.index')}}">Coupons</a>
                </div>
            </li>
            <li class="menu-item has-submenu {{ request()->is('dashboard/feature/*') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-card_membership"></i>
                    <span class="text">Feature item</span>
                </a>
               <div class="submenu">
                    <a href="{{route('category_feature')}}">Category</a>
                    <a href="{{ route('product_feature') }}">Products</a>
                </div>
            </li>

            <li class="menu-item has-submenu {{ request()->is('dashboard/inventory/*') ? 'active' : '' }}">
                <a class="menu-link" href="#">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Inventory</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('inventory.item') }}">Item Wise</a>

                    <a href="{{route('inventory.size')}}">
                        <span class="text">Size Wise</span>
                    </a>
                </div>
            </li>
            <li class="menu-item {{ request()->is('dashboard/campaign') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('campaign')}}"> <i class="icon material-icons md-campaign"></i>
                    <span class="text">Campaign</span> </a>
            </li>

            <li class="menu-item {{ request()->is('dashboard/zone') ? 'active' : '' }}">
                <a class="menu-link"  href="{{route('zone.index')}}"> <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Zone</span>
                </a>
            </li>
        </ul>
        <hr>
        <ul class="menu-aside">
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-assessment"></i>
                    <span class="text">Reports</span>
                </a>
                <div class="submenu">
                    <a href="{{route('sale.report')}}">Sales Report</a>

                </div>
            </li>
            <li class="menu-item">
                <a class="menu-link" href="{{url('/dashboard/users/index')}}">
                    <i class="icon material-icons md-people"></i><span class="text">Manage Users</span>
                </a>
            </li>

            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-settings"></i>
                    <span class="text">Web Settings</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('settings.index') }}">WebInfo</a>

                    <a href="{{route('slider')}}">
                        <span class="text">Manage Slider</span>
                    </a>

                    <a href="{{route('ads')}}">
                        <span class="text">Manage Ads</span>
                    </a>
                    <a href="{{url('/dashboard/aboutus')}}">
                        <span class="text">Manage About us</span>
                    </a>
                </div>
            </li>

        </ul>
        @elseif(auth()->user()->hasRole(['Manager']))
        <ul class="menu-aside">
            <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="menu-link" href="{{('/dashboard')}}"> <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item has-submenu {{ request()->is('dashboard/products/*') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Products</span>
                </a>
                <div class="submenu">
                    <a href="{{route('products.create')}}">Add Product</a>
                    <a href="{{route('products.index')}}">Product List</a>
                    <a href="{{route('brands.index')}}">Brands</a>
                    <a href="{{route('category.index')}}">Categories</a>
                    {{-- <a href="{{route('subcategory.index')}}">Subcategories</a> --}}
                    <a href="{{route('varient.index')}}">Varient</a>
                </div>
            </li>

            <li class="menu-item {{ request()->is('dashboard/inventory') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('inventory')}}">
                    <i class="icon material-icons md-store"></i>
                    <span class="text">Inventory</span> </a>
            </li>
        </ul>
        <hr>
        <ul class="menu-aside">
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-settings"></i>
                    <span class="text">Web Settings</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('settings.index') }}">WebInfo</a>

                    <a href="{{route('slider')}}">
                        <span class="text">Manage Slider</span>
                    </a>

                    <a href="{{route('ads')}}">
                        <span class="text">Manage Ads</span>
                    </a>
                    <a href="{{url('/dashboard/aboutus')}}">
                        <span class="text">Manage About us</span>
                    </a>
                </div>
            </li>

        </ul>
        @elseif(auth()->user()->hasRole(['User']))
        <ul class="menu-aside">
            <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="menu-link" href="{{('/dashboard')}}"> <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item has-submenu {{ request()->is('dashboard/orders/*') ? 'active' : '' }}">
                <a class="menu-link" href="#"> <i class="icon material-icons md-shopping_cart"></i>
                    <span class="text">Orders</span>
                </a>
                <div class="submenu">
                    <a href="{{route('order.index')}}">All Order list</a>
                    <a href="{{route('order.pending')}}">Pending Order list</a>
                    <a href="{{route('order.completed')}}">Completed Order</a>
                    <a href="{{route('order.return')}}">Order return</a>
                </div>
            </li>
        </ul>
        @endif
        <br>
         {{-- <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-person"></i>
                    <span class="text">Account</span>
                </a> --}}
                {{-- <div class="submenu">
                    <a href="page-account-login.html">User login</a>
                    <a href="page-account-register.html">User registration</a>
                    <a href="page-error-404.html">Error 404</a>
                </div> --}}
            {{-- </li> --}}
            {{-- <li class="menu-item">
                <a class="menu-link" href="{{('reviews')}}"> <i class="icon material-icons md-comment"></i>
                    <span class="text">Reviews</span>
                </a>
            </li> --}}

            {{-- <li class="menu-item">
                <a class="menu-link" href="{{route('media.index')}}"> <i class="icon material-icons md-stars"></i>
                    <span class="text">Media</span> </a>
            </li> --}}
    </nav>

</aside>
