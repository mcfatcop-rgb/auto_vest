@extends('layouts.app')

@section('styles')
<style>
    .referrals-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .referrals-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .referrals-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .referral-link-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .referral-link-card h5 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .referral-input-group {
        position: relative;
        margin-bottom: 2rem;
    }

    .referral-input {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        font-size: 1rem;
        font-weight: 500;
        color: #2c3e50;
        transition: all 0.3s ease;
    }

    .referral-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: rgba(255, 255, 255, 0.95);
    }

    .copy-btn {
        position: absolute;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .copy-btn:hover {
        transform: translateY(-50%) translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .share-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }

    .share-btn {
        padding: 1rem 1.5rem;
        border: none;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
    }

    .share-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .share-btn:hover::before {
        left: 100%;
    }

    .share-btn:hover {
        transform: translateY(-3px);
        text-decoration: none;
    }

    .btn-whatsapp {
        background: linear-gradient(135deg, #25d366, #128c7e);
        color: white;
        box-shadow: 0 10px 20px rgba(37, 211, 102, 0.3);
    }

    .btn-whatsapp:hover {
        box-shadow: 0 15px 30px rgba(37, 211, 102, 0.4);
        color: white;
    }

    .btn-sms {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-sms:hover {
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-facebook {
        background: linear-gradient(135deg, #1877f2, #42a5f5);
        color: white;
        box-shadow: 0 10px 20px rgba(24, 119, 242, 0.3);
    }

    .btn-facebook:hover {
        box-shadow: 0 15px 30px rgba(24, 119, 242, 0.4);
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .stat-card.referrals .stat-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .stat-card.bonus .stat-icon {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .stat-card.pending .stat-icon {
        background: linear-gradient(135deg, #ffa726, #ff7043);
    }

    .stat-card h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-value {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        color: #2c3e50;
    }

    .referrals-table-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .referrals-table-card .card-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 1.5rem;
        border: none;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .referrals-table {
        margin: 0;
    }

    .referrals-table th {
        background: rgba(102, 126, 234, 0.1);
        border: none;
        padding: 1.5rem 1rem;
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .referrals-table td {
        padding: 1.5rem 1rem;
        border: none;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        vertical-align: middle;
        font-weight: 500;
    }

    .referrals-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    .referral-name {
        font-weight: 700;
        color: #2c3e50;
    }

    .referral-email {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .referral-date {
        font-weight: 600;
        color: #2c3e50;
    }

    .referral-bonus {
        font-size: 1.1rem;
        font-weight: 800;
        color: #28a745;
    }

    .how-it-works {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .how-it-works h5 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .steps-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .steps-list li {
        display: flex;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .steps-list li:last-child {
        border-bottom: none;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .step-text {
        color: #2c3e50;
        font-weight: 500;
        line-height: 1.6;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: #2c3e50;
    }

    @media (max-width: 768px) {
        .referrals-container {
            padding: 1rem 0;
        }

        .referrals-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .referrals-header h1 {
            font-size: 2rem;
        }

        .share-buttons {
            flex-direction: column;
            align-items: center;
        }

        .share-btn {
            width: 100%;
            max-width: 250px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .referrals-table th,
        .referrals-table td {
            padding: 1rem 0.5rem;
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('content')
<div class="referrals-container">
    <div class="container">
        <!-- Referrals Header -->
        <div class="referrals-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-users me-3"></i>Referral Program</h1>
                    <p class="mb-0 text-muted">Invite friends and earn bonuses together</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Total Referrals</div>
                            <div class="fw-bold">{{ $referralsCount }}</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-handshake fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Referral Link Card -->
        <div class="referral-link-card">
            <h5><i class="fas fa-link me-2"></i>Your Unique Referral Link</h5>
            
            <div class="referral-input-group">
                <input type="text" value="{{ $referralLink }}" readonly class="referral-input" onclick="this.select()">
                <button class="copy-btn" onclick="copyReferralLink()">
                    <i class="fas fa-copy me-1"></i>Copy
                </button>
            </div>

            <div class="share-buttons">
                <a href="https://wa.me/?text={{ urlencode($referralLink) }}" class="share-btn btn-whatsapp" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    <span>Share via WhatsApp</span>
                </a>
                <a href="sms:?&body={{ urlencode($referralLink) }}" class="share-btn btn-sms">
                    <i class="fas fa-sms"></i>
                    <span>Share via SMS</span>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($referralLink) }}" class="share-btn btn-facebook" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                    <span>Share on Facebook</span>
                </a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card referrals">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h6>Total Referrals</h6>
                <div class="stat-value">{{ $referralsCount }}</div>
            </div>
            <div class="stat-card bonus">
                <div class="stat-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <h6>Total Bonus Earned</h6>
                <div class="stat-value">KSh {{ number_format($referralBonus, 2) }}</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h6>Pending Bonus</h6>
                <div class="stat-value">KSh {{ number_format($pendingBonus ?? 0, 2) }}</div>
            </div>
        </div>

        <!-- Referrals Table -->
        @if($referrals->count())
            <div class="referrals-table-card">
                <div class="card-header">
                    <i class="fas fa-list me-2"></i>Your Referrals
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table referrals-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-user me-1"></i>Name</th>
                                    <th><i class="fas fa-envelope me-1"></i>Email</th>
                                    <th><i class="fas fa-calendar me-1"></i>Joined On</th>
                                    <th><i class="fas fa-coins me-1"></i>Bonus Earned</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($referrals as $ref)
                                <tr>
                                    <td>
                                        <div class="referral-name">{{ $ref->name }}</div>
                                        <div class="referral-email">{{ $ref->email }}</div>
                                    </td>
                                    <td>
                                        <span class="referral-email">{{ $ref->email }}</span>
                                    </td>
                                    <td>
                                        <span class="referral-date">{{ \Carbon\Carbon::parse($ref->created_at)->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="referral-bonus">KSh {{ number_format($ref->referral_bonus ?? 0, 2) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="referrals-table-card">
                <div class="empty-state">
                    <i class="fas fa-user-plus"></i>
                    <h3>No Referrals Yet</h3>
                    <p>Start sharing your referral link to earn bonuses when your friends join and invest!</p>
                </div>
            </div>
        @endif

        <!-- How It Works -->
        <div class="how-it-works">
            <h5><i class="fas fa-question-circle me-2"></i>How It Works</h5>
            <ul class="steps-list">
                <li>
                    <div class="step-number">1</div>
                    <div class="step-text">Share your unique referral link with friends and family</div>
                </li>
                <li>
                    <div class="step-number">2</div>
                    <div class="step-text">They sign up using your link and create their account</div>
                </li>
                <li>
                    <div class="step-number">3</div>
                    <div class="step-text">They make their first investment on the platform</div>
                </li>
                <li>
                    <div class="step-number">4</div>
                    <div class="step-text">You earn a bonus automatically added to your account</div>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    function copyReferralLink() {
        const referralInput = document.querySelector('.referral-input');
        referralInput.select();
        referralInput.setSelectionRange(0, 99999);
        
        try {
            document.execCommand('copy');
            
            // Show success feedback
            const copyBtn = document.querySelector('.copy-btn');
            const originalText = copyBtn.innerHTML;
            copyBtn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            copyBtn.style.background = 'linear-gradient(135deg, #28a745, #20c997)';
            
            setTimeout(() => {
                copyBtn.innerHTML = originalText;
                copyBtn.style.background = 'linear-gradient(135deg, #667eea, #764ba2)';
            }, 2000);
        } catch (err) {
            console.error('Failed to copy: ', err);
        }
    }
</script>
@endsection
