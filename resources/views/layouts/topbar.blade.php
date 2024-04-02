<header class="main-header navbar">
    <div class="col-search">

    </div>
    <style>
        .nav-item .pos{
            width: 80px;
            height: 40px;
            line-height: 36px;
            border: 2px solid #b3b3b3;
            border-radius: 28px;
            margin-left: 15px;
            margin-right: 15px;
        }
    </style>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="material-icons md-apps"></i> </button>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn-icon pos" href="{{url('/cache_clear')}}">
                   Cache
                </a>
            </li>
            @php
                $user = Auth::user();
                $orderNotify = $user->unreadNotifications;
                $notifyCount = $orderNotify->count();

                $stockNotify = DB::table('notifications')->where('type', 'App\Notifications\LowStockNotification')->whereNull('read_at')->get();
                $stockNotifyCount = $stockNotify->count();

            @endphp
            <li class="nav-item notify-tab">
                <a class="nav-link btn-icon notify-counter" id="notify-counter" href="#">
                    <i class="material-icons md-notifications animation-shake"></i>
                    <span class="badge rounded-pill">{{$stockNotifyCount + $notifyCount}}</span>
                </a>

                @if ($notifyCount > 0 || $stockNotifyCount > 0)
                    <div class="notify-nav" style="display: none">
                        <h5>You have {{$notifyCount + $stockNotifyCount}} new notifications.</h5>
                        <ul>
                            @if ($notifyCount > 0)
                                @foreach($orderNotify as $notification)
                                    <li class="notification-item" data-notification-id="{{ $notification->id }}">
                                        <a href="{{route('order.details', ['id' => $notification->data['order_id'] ])}}">
                                            <span class="font-700">{{ $notification->data['message'] }}</span><br>
                                            <span>Order No: #{{ $notification->data['order_id'] }} </span><br>
                                            <span>{{ $notification->data['order_details']['customer_name'] }} </span>
                                            <span class="pull-right"> {{ $notification->data['order_details']['total_amount'] }}</span><br>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                            @if ($stockNotifyCount > 0)
                                @foreach($stockNotify as $notification)
                                    @php
                                        $notificationData = json_decode($notification->data);
                                    @endphp
                                        <li class="notification-item" data-notification-id="{{ $notification->id }}">
                                            <a href="#">
                                                <span>{{ $notificationData->message }}</span><br>
                                                <span>{{ $notificationData->product_id }}</span>
                                                <span>{{ $notificationData->product_name }}</span>
                                            </a>
                                        </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                @endif

            </li>
            @if(auth()->user()->hasRole(['Super Admin','Admin','User']))
            <li class="nav-item">
                <a class="nav-link btn-icon pos" href="{{route('pos')}}">
                    POS
                </a>
            </li>
            @endif

            <li class="dropdown nav-item">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ asset('/') }}admin/assets/imgs/customer_avatar.png" alt="User">
                    <span class="text-center">{{auth()->user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                    <a class="dropdown-item" href="{{route('profile.edit')}}"><i class="material-icons md-perm_identity"></i>Edit Profile</a>
                    <a class="dropdown-item" href="#"><i class="material-icons md-settings"></i>Account Settings</a>
                    {{-- <a class="dropdown-item" href="#"><i class="material-icons md-account_balance_wallet"></i>Wallet</a> --}}
                    {{-- <a class="dropdown-item" href="#"><i class="material-icons md-receipt"></i>Billing</a> --}}
                    {{-- <a class="dropdown-item" href="#"><i class="material-icons md-help_outline"></i>Help center</a> --}}
                    <div class="dropdown-divider"></div>
                    {{-- <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <a class="dropdown-item text-danger" href="{{route('logout')}} " onclick="event.preventDefault();
                    this.closest('form').submit();"><i class="material-icons md-exit_to_app"></i>Logout</a>
                    </form> --}}
                    <a class="dropdown-item text-danger"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="material-icons md-exit_to_app"></i>Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             {{ csrf_field() }}
                     </form>
                </div>
            </li>
        </ul>
    </div>
</header>
