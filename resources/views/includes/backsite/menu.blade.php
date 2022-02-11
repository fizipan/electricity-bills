<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li
                class="{{ request()->is('backsite/dashboard') || request()->is('backsite/dashboard/*') ? 'active' : '' }}">
                <a href="{{ route('backsite.dashboard.index') }}">
                    <i
                        class="{{ request()->is('backsite/dashboard') || request()->is('backsite/dashboard/*') ? 'bx bx-category-alt bx-flashing' : 'bx bx-category-alt' }}"></i><span
                        class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>

            <li class=" navigation-header"><span data-i18n="Application">Application</span><i class="la la-ellipsis-h"
                    data-toggle="tooltip" data-placement="right" data-original-title="Application"></i>
            </li>

            @can('management_access')
                <li class=" nav-item"><a href="#"><i
                            class="{{ request()->is('backsite/permissions') || request()->is('backsite/permissions/*') || request()->is('backsite/*/permissions') || request()->is('backsite/*/permissions/*') || request()->is('backsite/roles') || request()->is('backsite/roles/*') || request()->is('backsite/*/roles') || request()->is('backsite/*/roles/*') || request()->is('backsite/users') || request()->is('backsite/users/*') || request()->is('backsite/*/users') || request()->is('backsite/*/users/*') ? 'bx bx-group bx-flashing' : 'bx bx-group' }}"></i><span
                            class="menu-title" data-i18n="Management Access">Management Access</span></a>
                    <ul class="menu-content">
                        @can('permission_access')
                            <li
                                class="{{ request()->is('backsite/permissions') || request()->is('backsite/permissions/*') || request()->is('backsite/*/permissions') || request()->is('backsite/*/permissions/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.permissions.index') }}">
                                    <i></i><span>Permission</span>
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li
                                class="{{ request()->is('backsite/roles') || request()->is('backsite/roles/*') || request()->is('backsite/*/roles') || request()->is('backsite/*/roles/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.roles.index') }}">
                                    <i></i><span>Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li
                                class="{{ request()->is('backsite/users') || request()->is('backsite/users/*') || request()->is('backsite/*/users') || request()->is('backsite/*/users/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.users.index') }}">
                                    <i></i><span>Users</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('master_data_access')
                <li class=" nav-item"><a href="#"><i class=" {{ request()->is('backsite/rate') || request()->is('backsite/rate/*') || request()->is('backsite/*/rate') || request()->is('backsite/*/rate/*') || request()->is('backsite/group_rate') || request()->is('backsite/group_rate/*') || request()->is('backsite/*/group_rate') || request()->is('backsite/*/group_rate/*') ? 'bx bx-purchase-tag bx-flashing' : 'bx bx-purchase-tag' }} "></i><span class="menu-title" data-i18n="Master Data">Master Data</span></a>
                    <ul class="menu-content">

                        @can('group_rate_access')
                            <li class="{{ request()->is('backsite/group_rate') || request()->is('backsite/group_rate/*') || request()->is('backsite/*/group_rate') || request()->is('backsite/*/group_rate/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.group_rate.index') }}">
                                    <i></i><span>Group Rate</span>
                                </a>
                            </li>
                        @endcan

                        @can('rate_access')
                            <li class="{{ request()->is('backsite/rate') || request()->is('backsite/rate/*') || request()->is('backsite/*/rate') || request()->is('backsite/*/rate/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.rate.index') }}">
                                    <i></i><span>Rate</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('operational_access')
                <li class=" nav-item"><a href="#"><i class="{{ request()->is('backsite/customer') || request()->is('backsite/customer/*') || request()->is('backsite/*/customer') || request()->is('backsite/*/customer/*') || request()->is('backsite/customer_usage') || request()->is('backsite/customer_usage/*') || request()->is('backsite/*/customer_usage') || request()->is('backsite/*/customer_usage/*') ? 'bx bx-layer-plus bx-flashing' : 'bx bx-layer-plus' }}"></i><span class="menu-title" data-i18n="Operational">Operational</span></a>
                    <ul class="menu-content">

                        @can('customer_access')
                            <li class="{{ request()->is('backsite/customer') || request()->is('backsite/customer/*') || request()->is('backsite/*/customer') || request()->is('backsite/*/customer/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.customer.index') }}">
                                    <i></i><span>Customer</span>
                                </a>
                            </li>
                        @endcan

                        @can('customer_usage_access')
                            <li class="{{ request()->is('backsite/customer_usage') || request()->is('backsite/customer_usage/*') || request()->is('backsite/*/customer_usage') || request()->is('backsite/*/customer_usage/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.customer_usage.index') }}">
                                    <i></i><span>Customer Usage</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

             @can('transaction_access')
                <li class=" nav-item"><a href="#"><i class="{{ request()->is('backsite/bill') || request()->is('backsite/bill/*') || request()->is('backsite/*/bill') || request()->is('backsite/*/bill/*') || request()->is('backsite/transaction') || request()->is('backsite/transaction/*') || request()->is('backsite/*/transaction') || request()->is('backsite/*/transaction/*') ? 'bx bx-money bx-flashing' : 'bx bx-money' }}"></i><span class="menu-title" data-i18n="Transaction">Transaction</span></a>
                    <ul class="menu-content">

                        @can('bill_access')
                            <li class="{{ request()->is('backsite/bill') || request()->is('backsite/bill/*') || request()->is('backsite/*/bill') || request()->is('backsite/*/bill/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.bill.index') }}">
                                    <i></i><span>Bill</span>
                                </a>
                            </li>
                        @endcan

                        @can('transaction_access')
                            <li class="{{ request()->is('backsite/transaction') || request()->is('backsite/transaction/*') || request()->is('backsite/*/transaction') || request()->is('backsite/*/transaction/*') ? 'active' : '' }} ">
                                <a class="menu-item" href="{{ route('backsite.transaction.index') }}">
                                    <i></i><span>Transaction</span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

        </ul>
    </div>
</div>

<!-- END: Main Menu-->
