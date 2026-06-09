@extends('layouts.master')

@section("title", "Visiting Card")

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- Download Button -->
            <div class="row mb-4">
                <div class="col-12 text-end">
                    <button onclick="downloadCard()" class="btn btn-success me-2">
                        <i class="las la-download me-2"></i>Download
                    </button>
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="las la-print me-2"></i>Print
                    </button>
                </div>
            </div>

            <!-- Visiting Card -->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="visiting-card-container" id="visitingCard">
                        
                        <!-- Card Design -->
                        <div class="visiting-card">
                            <div class="card-left">
                                <!-- Logo -->
                                <div class="logo-section">
                                    <img src="{{ asset('assets/images/logo.webp') }}" alt="VSR MLM NETWORK Wellness" class="company-logo">
                                    <div class="company-name">
                                        <h3>VSR MLM NETWORK</h3>
                                        <p class="wellness-text">WELLNESS</p>
                                        <p class="tagline">Heaven of Wellness</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-right">
                                <!-- User Name -->
                                <div class="user-name-section">
                                    <h2>{{ strtoupper($user->first_name . ' ' . $user->last_name) }}</h2>
                                </div>

                                <!-- Contact Info -->
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <i class="las la-phone"></i>
                                        <span>+91-{{ $user->phone }}</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="las la-envelope"></i>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </div>

                                <!-- Position -->
                                <div class="position-section">
                                    <p>Independent Nutritionist And Dietician Consultant Of VSR MLM NETWORK Wellness Pvt.Ltd.</p>
                                </div>

                                <!-- Website -->
                                <div class="website-section">
                                    <i class="las la-globe"></i>
                                    <span>www.VSR MLM NETWORKwellness.com</span>
                                </div>
                            </div>

                            <!-- Decorative Elements -->
                            <div class="decoration decoration-top-right"></div>
                            <div class="decoration decoration-bottom-left"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Styles -->
<style>
.visiting-card-container {
    padding: 20px;
    background: #f5f5f5;
    border-radius: 10px;
}

.visiting-card {
    width: 100%;
    max-width: 700px;
    height: 400px;
    background: white;
    margin: 0 auto;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    display: flex;
    overflow: hidden;
    position: relative;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.card-left {
    width: 35%;
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
    padding: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.logo-section {
    text-align: center;
    color: white;
}

.company-logo {
    width: 120px;
    height: auto;
    margin-bottom: 15px;
    filter: brightness(0) invert(1);
}

.company-name h3 {
    color: white;
    font-size: 28px;
    font-weight: bold;
    margin: 0;
    letter-spacing: 1px;
}

.wellness-text {
    color: white;
    font-size: 14px;
    letter-spacing: 3px;
    margin: 5px 0;
    text-transform: uppercase;
}

.tagline {
    color: rgba(255,255,255,0.9);
    font-size: 12px;
    font-style: italic;
    margin: 10px 0 0 0;
}

.card-right {
    width: 65%;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
}

.user-name-section h2 {
    color: #1e3a8a;
    font-size: 32px;
    font-weight: 700;
    margin: 0 0 30px 0;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.contact-info {
    margin-bottom: 25px;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    color: #333;
    font-size: 14px;
}

.contact-item i {
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-size: 14px;
}

.contact-item span {
    color: #555;
}

.position-section {
    margin: 25px 0;
}

.position-section p {
    color: #666;
    font-size: 12px;
    line-height: 1.6;
    margin: 0;
    text-align: justify;
}

.website-section {
    display: flex;
    align-items: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #e0e0e0;
}

.website-section i {
    width: 25px;
    height: 25px;
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-size: 12px;
}

.website-section span {
    color: #1e3a8a;
    font-size: 13px;
    font-weight: 500;
}

/* Decorative Elements */
.decoration {
    position: absolute;
    opacity: 0.1;
}

.decoration-top-right {
    top: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, #3b82f6 0%, transparent 70%);
    border-radius: 50%;
}

.decoration-bottom-left {
    bottom: -50px;
    left: -50px;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, #1e3a8a 0%, transparent 70%);
    border-radius: 50%;
}

/* Print Styles */
@media print {
    body * {
        visibility: hidden;
    }
    
    #visitingCard, #visitingCard * {
        visibility: visible;
    }
    
    #visitingCard {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        max-width: 700px;
    }
    
    .no-print {
        display: none !important;
    }
    
    @page {
        size: landscape;
        margin: 10mm;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .visiting-card {
        flex-direction: column;
        height: auto;
    }
    
    .card-left, .card-right {
        width: 100%;
    }
    
    .card-left {
        padding: 20px;
    }
    
    .card-right {
        padding: 30px;
    }
    
    .user-name-section h2 {
        font-size: 24px;
    }
}
</style>

<script>
function downloadCard() {
    // HTML2Canvas library use karo agar installed hai
    // Ya fir print dialog khol do
    window.print();
}
</script>
@endsection