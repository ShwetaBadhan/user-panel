@extends('layouts.master')

@section("title", "Sign Up Acknowledgement")

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            
            <!-- Action Buttons -->
            <div class="row mb-4 no-print">
                <div class="col-12 text-end">
                    <button onclick="window.print()" class="btn btn-primary me-2">
                        <i class="las la-print me-2"></i>Print
                    </button>
                    <button onclick="downloadPDF()" class="btn btn-success me-2">
                        <i class="las la-download me-2"></i>Download
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="las la-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Acknowledgement Document -->
            <div class="acknowledgement-container" id="acknowledgementDocument">
                
                <!-- Company Header -->
                <div class="company-header">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="company-name">VSR MLM NETWORK</h2>
                            <p class="company-address">
                                Chogawan adda , kala singha road,<br>
                                Distt - Jalandhar (144026), State- Punjab.<br>
                                Contact: +91 9876544273<br>
                                Email: info@vsrmlmnetwork.com
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Document Title -->
                <div class="document-title">
                    <h3>Sign Up Acknowledgement</h3>
                </div>

                <!-- Welcome Message -->
                <div class="welcome-message">
                    <p>
                        You have been successfully appointed as our <strong>Independent Distributor</strong> with us. 
                        We warmly welcome you to the <strong>VSR MLM NETWORK</strong>. 
                        We hope you cherish your experience with us.
                    </p>
                </div>

                <!-- Sponsor Details -->
                <div class="section-box">
                    <h4 class="section-title">Sponsor Details</h4>
                    <div class="details-grid">
                        <div class="detail-row">
                            <span class="label">Sponsor GW:</span>
                            <span class="value">{{ $user->sponsor->user_name ?? 'N/A' }}</span>
                            <span class="label">Sponsor Name:</span>
                            <span class="value">{{ $user->sponsor->first_name ?? '' }} {{ $user->sponsor->last_name ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Login Details -->
                <div class="section-box">
                    <h4 class="section-title">Login Details</h4>
                    <div class="details-grid">
                        <div class="detail-row">
                            <span class="label">Distributor GW:</span>
                            <span class="value">{{ $user->track_id ?? 'N/A' }}</span>
                            <span class="label">User Name:</span>
                            <span class="value">{{ $user->user_name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Password:</span>
                            <span class="value password-text">TOP1234</span>
                            <span class="label"></span>
                            <span class="value"></span>
                        </div>
                    </div>
                </div>

                <!-- Personal Details -->
                <div class="section-box">
                    <h4 class="section-title">Personal Details</h4>
                    <div class="details-grid">
                        <div class="detail-row">
                            <span class="label">Name:</span>
                            <span class="value">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</span>
                            <span class="label">Birth Date:</span>
                            <span class="value">{{ $user->dob ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Address Details -->
                <div class="section-box">
                    <h4 class="section-title">Address Details</h4>
                    <div class="details-grid">
                        <div class="detail-row">
                            <span class="label">Address:</span>
                            <span class="value">{{ $user->address ?? 'N/A' }}</span>
                            <span class="label"></span>
                            <span class="value"></span>
                        </div>
                        <div class="detail-row">
                            <span class="label">City:</span>
                            <span class="value">{{ $user->district ?? 'N/A' }}</span>
                            <span class="label">District:</span>
                            <span class="value">{{ $user->district ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">State:</span>
                            <span class="value">{{ $user->state ?? 'N/A' }}</span>
                            <span class="label">Pincode:</span>
                            <span class="value">{{ $user->pincode ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Mobile No:</span>
                            <span class="value">{{ $user->phone ?? 'N/A' }}</span>
                            <span class="label">Email:</span>
                            <span class="value">{{ $user->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Nominee Details -->
                <div class="section-box">
                    <h4 class="section-title">Nominee Details</h4>
                    <div class="details-grid">
                        <div class="detail-row">
                            <span class="label">Name:</span>
                            <span class="value">{{ $user->nominee_name ?? 'N/A' }}</span>
                            <span class="label">Relation:</span>
                            <span class="value">{{ $user->nominee_relation ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="label">Birth Date:</span>
                            <span class="value">N/A</span>
                            <span class="label">Family Member ID:</span>
                            <span class="value">N/A</span>
                        </div>
                    </div>
                </div>

                <!-- Note -->
                <div class="note-section">
                    <p>
                        This Data has been recorded with us, however, in case of any change in communication or address details 
                        or nominee details etc. you may write to the Administrator using the Support Ticket facility provided 
                        in your back office. Wish you good luck and the best of retailing.
                    </p>
                </div>

                <!-- Agreement Checkbox -->
                <div class="agreement-section">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="agreeTerms">
                        <label class="form-check-label" for="agreeTerms">
                            <strong>I Agree & Understand:</strong> 
                            <a href="#termsAndConditions" data-bs-toggle="collapse">Terms and Conditions</a>
                        </label>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="terms-section collapse" id="termsAndConditions">
                    <h4 class="section-title">Terms and Conditions</h4>
                    <div class="terms-content">
                        <p><strong>Welcome to VSR MLM NETWORK's website, www.vsrmlmnetwork.com,</strong> and its affiliated platforms collectively referred to as the "VSR Websites." Before delving into the immersive world of our wellness offerings, it's essential to familiarize yourself with the Terms and Conditions ("Agreement") governing your interaction with these digital spaces.</p>
                        
                        <p>VSR MLM NETWORK, herein referred to as "VSR," "we," "us," or "our," invites you to read and understand these terms thoroughly. Your utilization of the VSR Websites implies your acceptance of this Agreement. If, for any reason, you do not concur with the terms outlined herein, we kindly request that you refrain from using the VSR Websites.</p>
                        
                        <p>VSR, as the curator of this digital experience, reserves the right to adjust this Agreement, either in part or in its entirety, at our sole discretion. We commit to providing notice of such changes through various means, including posting the revised Agreement on the VSR Websites. We encourage you to periodically check for updates, as your continued use of the VSR Websites following any modifications to this Agreement indicates your acceptance of the revised terms.</p>
                        
                        <h5 class="mt-4 mb-3">Distributor Responsibilities:</h5>
                        <ul>
                            <li>Maintain ethical business practices at all times</li>
                            <li>Represent the company professionally</li>
                            <li>Comply with all applicable laws and regulations</li>
                            <li>Protect customer privacy and data</li>
                            <li>Accurately represent products and compensation plan</li>
                        </ul>
                        
                        <h5 class="mt-4 mb-3">Code of Conduct:</h5>
                        <ul>
                            <li>No misleading income claims</li>
                            <li>No false product representations</li>
                            <li>Respect for other distributors</li>
                            <li>Professional communication standards</li>
                            <li>Timely order fulfillment</li>
                        </ul>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="signature-section">
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="signature-box">
                                <div class="signature-line"></div>
                                <p><strong>{{ $user->first_name }} {{ $user->last_name }}</strong></p>
                                <p class="signature-role">Distributor Signature</p>
                                <p class="signature-date">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="signature-box text-end">
                                <div class="signature-line ms-auto"></div>
                                <p><strong>For VSR MLM NETWORK</strong></p>
                                <p class="signature-role">Authorized Signatory</p>
                                <p class="signature-date">Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="document-footer">
                    <p class="text-center mb-0">
                        <strong>VSR MLM NETWORK</strong> - Empowering Your Financial Future<br>
                        <small>www.vsrmlmnetwork.com | support@vsrmlmnetwork.com</small>
                    </p>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- Styles -->
<style>
.acknowledgement-container {
    background: white;
    padding: 40px;
    max-width: 900px;
    margin: 0 auto;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    border-radius: 8px;
}

.company-header {
    border-bottom: 3px solid #1e3a8a;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.company-name {
    color: #1e3a8a;
    font-weight: bold;
    font-size: 32px;
    margin: 0 0 10px 0;
}

.company-address {
    color: #666;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
}

.document-title {
    text-align: center;
    margin: 30px 0;
}

.document-title h3 {
    color: #1e3a8a;
    font-size: 24px;
    font-weight: bold;
    margin: 0;
    text-decoration: underline;
    text-transform: uppercase;
}

.welcome-message {
    background: #f8f9fa;
    padding: 20px;
    border-left: 4px solid #1e3a8a;
    margin-bottom: 30px;
    border-radius: 4px;
}

.welcome-message p {
    margin: 0;
    line-height: 1.8;
    color: #333;
}

.section-box {
    margin-bottom: 25px;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
    overflow: hidden;
}

.section-title {
    background: linear-gradient(135deg, #1e3a8a, #3b82f6);
    color: white;
    padding: 12px 20px;
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.details-grid {
    padding: 20px;
}

.detail-row {
    display: grid;
    grid-template-columns: 150px 1fr 150px 1fr;
    gap: 15px;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.detail-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.label {
    font-weight: 600;
    color: #555;
    font-size: 13px;
}

.value {
    color: #333;
    font-weight: 500;
    font-size: 13px;
}

.password-text {
    background: #fff3cd;
    padding: 2px 8px;
    border-radius: 3px;
    color: #856404;
}

.note-section {
    background: #e8f4f8;
    padding: 20px;
    border-radius: 6px;
    margin: 25px 0;
    font-style: italic;
    color: #555;
    line-height: 1.8;
}

.agreement-section {
    margin: 25px 0;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
}

.terms-section {
    margin: 20px 0;
    padding: 20px;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 6px;
}

.terms-content {
    text-align: justify;
    line-height: 1.8;
    color: #333;
}

.terms-content p {
    margin-bottom: 15px;
}

.terms-content ul {
    margin: 10px 0;
    padding-left: 20px;
}

.terms-content li {
    margin-bottom: 8px;
}

.signature-section {
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid #1e3a8a;
}

.signature-box {
    margin-top: 30px;
}

.signature-line {
    width: 250px;
    height: 1px;
    background: #333;
    margin-bottom: 10px;
}

.signature-role {
    color: #666;
    font-size: 12px;
    margin: 5px 0;
}

.signature-date {
    color: #999;
    font-size: 11px;
    margin: 0;
}

.document-footer {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #e0e0e0;
    text-align: center;
    color: #666;
    font-size: 12px;
}

/* Print Styles */
@media print {
    body * {
        visibility: hidden;
    }
    
    #acknowledgementDocument, #acknowledgementDocument * {
        visibility: visible;
    }
    
    #acknowledgementDocument {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 20px;
    }
    
    .no-print {
        display: none !important;
    }
    
    @page {
        margin: 10mm;
    }
}
</style>

<script>
function downloadPDF() {
  
    window.print();
    
  
}
</script>
@endsection