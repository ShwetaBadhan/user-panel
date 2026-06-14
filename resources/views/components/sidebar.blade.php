<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ url('assets/images/logo.webp') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ url('assets/images/logo.webp') }}" alt="" height="21">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ url('assets/images/logo.webp') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ url('assets/images/logo.webp') }}" alt="" height="21">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <!-- Dashboard (Active Example) -->
                <li class="nav-item mm-active"> <!-- Added mm-active for parent -->
                    <a class="nav-link menu-link active" href="{{ route('dashboard') }}"> <!-- Added active class -->
                        <i class="las la-tachometer-alt"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('buy-now') }}">
                        <i class="las la-shopping-cart"></i> <span data-key="t-dashboard">Buy Now</span>
                    </a>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarInvoiceManagement" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarInvoiceManagement">
                        <i class="las la-user-circle"></i> <span data-key="t-invoices">Profile</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarInvoiceManagement">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('user.profile') }}" class="nav-link"><i
                                        class="las la-user-edit"></i> Update Profile </a></li>
                            <li class="nav-item"><a href="{{ route('user.profile.image') }}" class="nav-link"><i
                                        class="las la-image"></i> Edit Profile Image </a></li>
                            <li class="nav-item"><a href="{{ route('user.change-password') }}" class="nav-link"><i
                                        class="las la-key"></i> Change Password </a></li>
                            <li class="nav-item">
                                <a href="{{ route('user.change-transaction-password') }}" class="nav-link">
                                    <i class="las la-lock"></i> Change Tran. Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.forgot-transaction-password') }}" class="nav-link">
                                    <i class="las la-unlock-alt"></i> Forgot Tran. Password
                                </a>
                            </li>
                            <li class="nav-item"><a href="{{ route('user.welcome-letter') }}" class="nav-link"><i
                                        class="las la-envelope-open-text"></i> Welcome Letter </a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i class="las la-id-badge"></i> ID
                                    Card </a></li>
                            <li class="nav-item">
                                <a href="{{ route('user.visiting-card') }}" class="nav-link">
                                    <i class="las la-address-card"></i> Visiting Card
                                </a>
                            </li>
                            <li class="nav-item"><a href="{{ route('user.signup-acknowledgement') }}"
                                    class="nav-link"><i class="las la-file-signature"></i> Sign Up Acknowledgement </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- My Team Dropdown -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuthentication" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarAuthentication">
                        <i class="las la-users"></i> <span data-key="t-authentication">My Team</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuthentication">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user.direct-business') }}" class="nav-link">
                                    <i class="las la-user-tie"></i> My Direct Business
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.downline-business') }}" class="nav-link">
                                    <i class="las la-user-friends"></i> My Downline Business
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.genealogy') }}" class="nav-link">
                                    <i class="las la-sitemap"></i> Genealogy
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Funds Dropdown -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarFunds" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarFunds">
                        <i class="las la-coins"></i> <span data-key="t-authentication">Funds</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarFunds">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('user.admin-bank-detail') }}" class="nav-link"><i
                                        class="las la-university"></i> Admin Bank Detail</a></li>
                           <li class="nav-item">
    <a href="{{ route('user.fund-summary') }}" class="nav-link">
        <i class="las la-chart-pie"></i> Fund Summary
    </a>
</li>
                          <li class="nav-item">
    <a href="{{ route('user.fund-request') }}" class="nav-link">
        <i class="las la-hand-holding-usd"></i> Fund Request
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('user.fund-request-status') }}" class="nav-link">
        <i class="las la-clipboard-list"></i> Fund Request Status
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.fund-history') }}" class="nav-link">
        <i class="las la-history"></i> Fund History
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.fund-transfer') }}" class="nav-link">
        <i class="las la-exchange-alt"></i> Fund Transfer
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.fund-list') }}" class="nav-link">
        <i class="las la-list"></i> Fund List
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.fund-receive-list') }}" class="nav-link">
        <i class="las la-inbox"></i> Fund Receive List
    </a>
</li>
                        </ul>
                    </div>
                </li>

                <!-- Wallet Dropdown -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarWallet" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarWallet">
                        <i class="las la-wallet"></i> <span data-key="t-authentication">Wallet</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarWallet">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="{{ route('user.account.summary') }}" class="nav-link"><i
                                        class="las la-file-invoice-dollar"></i> Account Summary</a></li>
                            <li class="nav-item">
    <a href="{{ route('user.direct-income') }}" class="nav-link">
        <i class="las la-dollar-sign"></i> Direct Income
    </a>
</li>
                            <li class="nav-item"><a href="{{ route('user.matching-income') }}" class="nav-link"><i
                                        class="las la-euro-sign"></i> Matching Income</a></li>
                          <li class="nav-item">
    <a href="{{ route('user.cash-bonus-request') }}" class="nav-link">
        <i class="las la-gift"></i> Cash Bonus Request
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.claim-cash-request') }}" class="nav-link">
        <i class="las la-donate"></i> Claim Cash Request
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.cash-bonus-history') }}" class="nav-link">
        <i class="las la-history"></i> Cash Bonus History
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.generation-income') }}" class="nav-link">
        <i class="las la-chart-line"></i> Generation Income
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.awards-rewards') }}" class="nav-link">
        <i class="las la-trophy"></i> Awards and Rewards
    </a>
</li>
                          <li class="nav-item">
    <a href="{{ route('user.downline-rank') }}" class="nav-link">
        <i class="las la-medal"></i> Downline Rank
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.weekly-payout') }}" class="nav-link">
        <i class="las la-calendar-week"></i> Weekly Payout
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.retreat-tours') }}" class="nav-link">
        <i class="las la-plane"></i> Retreat, Asia, International Tours
    </a>
</li>
                        </ul>
                    </div>
                </li>

                <!-- Delivery Report Dropdown -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarDelivery" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarDelivery">
                        <i class="las la-shipping-fast"></i> <span data-key="t-authentication">Delivery Report</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDelivery">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
    <a href="{{ route('user.order-history') }}" class="nav-link">
        <i class="las la-file-alt"></i> Order History
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.by-hand-delivery') }}" class="nav-link">
        <i class="las la-hands-helping"></i> By Hand Delivery List
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.courier-delivery') }}" class="nav-link">
        <i class="las la-truck"></i> Courier Delivery List
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.by-hand-award') }}" class="nav-link">
        <i class="las la-gifts"></i> By Hand T.B.D Award/Reward List
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.by-courier-award') }}" class="nav-link">
        <i class="las la-box-open"></i> By Courier T.B.D Award/Reward List
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('user.other-products') }}" class="nav-link">
        <i class="las la-boxes"></i> Other Products
    </a>
</li>
                        </ul>
                    </div>
                </li>

                <!-- Withdrawal Dropdown -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarWithdrawal" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarWithdrawal">
                        <i class="las la-money-check-alt"></i> <span data-key="t-authentication">Withdrawal</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarWithdrawal">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="#" class="nav-link"><i
                                        class="las la-history"></i> Withdrawal History</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i
                                        class="las la-percentage"></i> Annual Commission T.D.S</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i
                                        class="las la-file-contract"></i> 194R</a></li>
                        </ul>
                    </div>
                </li>

                <!-- KYC Dropdown -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarKyc" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarKyc">
                        <i class="las la-id-card-alt"></i> <span data-key="t-authentication">KYC</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarKyc">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a href="#" class="nav-link"><i
                                        class="las la-user-check"></i> KYC</a></li>
                            <li class="nav-item"><a href="#" class="nav-link"><i
                                        class="las la-file-contract"></i> Admin Documents And Direct Seller
                                    Agreement</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Grievance Cell Dropdown -->
                <li class="nav-item">
                    <!-- Note: Fixed aria-controls to match id="sidebarGrievance" -->
                    <a class="nav-link menu-link" href="#sidebarGrievance" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarGrievance">
                        <i class="las la-headset"></i> <span data-key="t-authentication">Grievance Cell</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarGrievance">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('user.grievance.raise-ticket') }}" class="nav-link">
                                    <i class="las la-ticket-alt"></i> Raise Ticket
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.grievance.inbox') }}" class="nav-link">
                                    <i class="las la-inbox"></i> Inbox
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.grievance.outbox') }}" class="nav-link">
                                    <i class="las la-paper-plane"></i> Outbox
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
