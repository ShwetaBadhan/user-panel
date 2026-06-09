@extends('layouts.master')
@section('title','VSR | Dashboard')
@section('content')
<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">VSR</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Welcome Message -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">Welcome Back, {{ $user->first_name }} {{ $user->last_name }}!</h4>
                                            <p class="mb-0">Track ID: <strong>{{ $user->track_id }}</strong> | Membership: <strong>{{ $user->membership_type }}</strong></p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <i class="las la-user-circle" style="font-size: 60px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards Row 1 -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">HIGHEST RANK</p>
                                            <h4 class="mb-2">{{ $userRank }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3 fs-2">
                                                    <i class="las la-trophy"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">CURRENT INCOME</p>
                                            <h4 class="mb-2">₹{{ number_format($totalIncome, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3 fs-2">
                                                    <i class="las la-wallet"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">SELF CC</p>
                                            <h4 class="mb-2">{{ number_format($selfCC, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-info rounded-3 fs-2">
                                                    <i class="las la-shopping-bag"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards Row 2 -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">DUAL MATCHING INCOME</p>
                                            <h4 class="mb-2">16%</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-warning rounded-3 fs-2">
                                                    <i class="las la-percentage"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">DIRECT INCOME</p>
                                            <h4 class="mb-2">₹{{ number_format($directIncome, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3 fs-2">
                                                    <i class="las la-hand-holding-usd"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">FUND WALL</p>
                                            <h4 class="mb-2">₹{{ number_format($fundWallet, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-danger rounded-3 fs-2">
                                                    <i class="las la-coins"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards Row 3 -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">MATCHING INCOME</p>
                                            <h4 class="mb-2">₹{{ number_format($matchingIncome, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3 fs-2">
                                                    <i class="las la-exchange-alt"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">Current Left CC/Right Count CC</p>
                                            <h4 class="mb-2">{{ number_format($currentLeftCC, 0) }} | {{ number_format($currentRightCC, 0) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-info rounded-3 fs-2">
                                                    <i class="las la-balance-scale"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">Total Directs</p>
                                            <h4 class="mb-2">{{ $directBusiness }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3 fs-2">
                                                    <i class="las la-users"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards Row 4 -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">Active Downline Left | Right</p>
                                            <h4 class="mb-2">{{ $leftTeam }} | {{ $rightTeam }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-warning rounded-3 fs-2">
                                                    <i class="las la-sitemap"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">Total Downline Left | Right</p>
                                            <h4 class="mb-2">{{ $totalDownlineLeft }} | {{ $totalDownlineRight }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-danger rounded-3 fs-2">
                                                    <i class="las la-network-wired"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">Total Direct Business</p>
                                            <h4 class="mb-2">₹{{ number_format($totalDirectBusiness, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-success rounded-3 fs-2">
                                                    <i class="las la-chart-line"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards Row 5 -->
                    <div class="row">
                        <div class="col-xl-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">Total Generation Income</p>
                                            <h4 class="mb-2">₹{{ number_format($generationIncome, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-info rounded-3 fs-2">
                                                    <i class="las la-layer-group"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-truncate font-size-14 mb-2">Total Income</p>
                                            <h4 class="mb-2">₹{{ number_format($totalIncome, 2) }}</h4>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span class="avatar-title bg-light text-primary rounded-3 fs-2">
                                                    <i class="las la-wallet"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order History -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Order History</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-nowrap align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order ID</th>
                                                    <th>Customer</th>
                                                    <th>Order Date</th>
                                                    <th>Delivery Type</th>
                                                    <th>Payment Status</th>
                                                    <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($orderHistory as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $order->order_id ?? 'N/A' }}</td>
                                                    <td>{{ $user->user_name }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                    <td>{{ $order->delivery_type ?? 'By Courier' }}</td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success">
                                                            {{ $order->payment_status ?? 'Approve' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-primary">Invoice</button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">No orders found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © VSR MLM.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                All Rights Reserved
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
        @endsection