@extends('layouts.app')

@section('styles')
<style>
    .help-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .help-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .help-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .contact-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .contact-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .contact-card::before {
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

    .contact-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .contact-card:hover::before {
        transform: scaleX(1);
    }

    .contact-card .contact-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin: 0 auto 1.5rem;
        color: white;
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .contact-card.email .contact-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .contact-card.phone .contact-icon {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .contact-card.whatsapp .contact-icon {
        background: linear-gradient(135deg, #25d366, #128c7e);
    }

    .contact-card h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .contact-card p {
        color: #6c757d;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .contact-card .contact-link {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        position: relative;
        overflow: hidden;
    }

    .contact-card .contact-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .contact-card .contact-link:hover::before {
        left: 100%;
    }

    .contact-card .contact-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .help-form-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .help-form-card h5 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-floating .form-control {
        height: 60px;
        padding: 1rem 1rem 0.5rem;
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 15px;
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-floating .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: rgba(255, 255, 255, 0.95);
    }

    .form-floating label {
        padding: 1rem;
        color: #6c757d;
        font-weight: 500;
    }

    .form-floating .form-control:focus ~ label,
    .form-floating .form-control:not(:placeholder-shown) ~ label {
        color: #667eea;
        transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
    }

    .form-floating textarea.form-control {
        height: auto;
        min-height: 120px;
        padding-top: 1.5rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(40, 167, 69, 0.4);
        color: white;
    }

    .faq-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .faq-section h5 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .faq-item {
        margin-bottom: 1.5rem;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .faq-question {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .faq-question:hover {
        background: linear-gradient(135deg, #5a6fd8, #6a4190);
    }

    .faq-question i {
        transition: transform 0.3s ease;
    }

    .faq-question.active i {
        transform: rotate(180deg);
    }

    .faq-answer {
        background: rgba(255, 255, 255, 0.95);
        padding: 1.5rem;
        color: #2c3e50;
        line-height: 1.6;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .support-hours {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-align: center;
    }

    .support-hours h5 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .support-hours p {
        color: #6c757d;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .help-container {
            padding: 1rem 0;
        }

        .help-header {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .help-header h1 {
            font-size: 2rem;
        }

        .contact-methods {
            grid-template-columns: 1fr;
        }

        .contact-card {
            padding: 1.5rem;
        }

        .contact-card .contact-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="help-container">
    <div class="container">
        <!-- Help Header -->
        <div class="help-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-question-circle me-3"></i>Help & Support</h1>
                    <p class="mb-0 text-muted">We're here to help you succeed with your investments</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="me-3">
                            <div class="text-muted small">Support Available</div>
                            <div class="fw-bold">24/7</div>
                        </div>
                        <div class="avatar-circle">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support Hours -->
        <div class="support-hours">
            <h5><i class="fas fa-clock me-2"></i>Support Hours</h5>
            <p><strong>Monday - Friday:</strong> 9:00 AM - 5:00 PM (EAT)<br>
            <strong>Weekend:</strong> 10:00 AM - 2:00 PM (EAT)<br>
            <strong>Emergency Support:</strong> Available 24/7 via WhatsApp</p>
        </div>

        <!-- Contact Methods -->
        <div class="contact-methods">
            <div class="contact-card email">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <h5>Email Support</h5>
                <p>Get detailed help via email. We respond within 2-4 hours during business hours.</p>
                <a href="mailto:support@autovest.co.ke" class="contact-link">
                    <i class="fas fa-paper-plane me-2"></i>Send Email
                </a>
            </div>

            <div class="contact-card phone">
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h5>Phone Support</h5>
                <p>Speak directly with our support team for immediate assistance.</p>
                <a href="tel:+254700000000" class="contact-link">
                    <i class="fas fa-phone me-2"></i>Call Now
                </a>
            </div>

            <div class="contact-card whatsapp">
                <div class="contact-icon">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h5>WhatsApp Chat</h5>
                <p>Quick support via WhatsApp. Perfect for urgent questions and issues.</p>
                <a href="https://wa.me/254700000000" target="_blank" class="contact-link">
                    <i class="fab fa-whatsapp me-2"></i>Chat Now
                </a>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="help-form-card">
            <h5><i class="fas fa-comments me-2"></i>Send us a Message</h5>
            <form method="POST" action="{{ route('regular_user.help.submit') }}" id="helpForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                            <label for="subject">
                                <i class="fas fa-tag me-2"></i>Subject
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="Account">Account Issue</option>
                                <option value="Investment">Investment Inquiry</option>
                                <option value="Payment">Payment or M-Pesa</option>
                                <option value="Technical">Technical Problem</option>
                                <option value="Other">Other</option>
                            </select>
                            <label for="category">
                                <i class="fas fa-folder me-2"></i>Category
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" id="message" name="message" placeholder="Your Message" style="min-height: 120px;" required></textarea>
                    <label for="message">
                        <i class="fas fa-comment me-2"></i>Your Message
                    </label>
                </div>
                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-paper-plane me-2"></i>Send Message
                </button>
            </form>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <h5><i class="fas fa-lightbulb me-2"></i>Frequently Asked Questions</h5>
            
            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>How do I invest in a car brand?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer" style="display: none;">
                    You can visit the Portfolio section and click "Invest" next to your preferred brand. Choose your investment amount and complete the payment process through M-Pesa.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>How are payouts made?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer" style="display: none;">
                    We send M-Pesa payouts twice a month based on your earnings. Payouts are automatically processed to your registered M-Pesa number on the 15th and 30th of each month.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Can I change my registered phone number?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer" style="display: none;">
                    Yes, you can update your phone number by going to Settings > Profile Information and editing your contact details. Please ensure the new number is active for M-Pesa transactions.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>What is the minimum investment amount?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer" style="display: none;">
                    The minimum investment amount is KSh 1,000. You can invest in increments of KSh 100 to diversify your portfolio across different car brands.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>How do I track my investment performance?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer" style="display: none;">
                    You can view your investment performance in the Dashboard and Portfolio sections. These show your current balance, total earnings, and detailed transaction history.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    <span>Is my investment secure?</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="faq-answer" style="display: none;">
                    Yes, AutoVest is licensed by the Capital Markets Authority and follows strict security protocols. Your investments are protected by industry-standard security measures and regulatory compliance.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const icon = element.querySelector('i');
        
        if (answer.style.display === 'none' || answer.style.display === '') {
            answer.style.display = 'block';
            element.classList.add('active');
        } else {
            answer.style.display = 'none';
            element.classList.remove('active');
        }
    }

    // Form submission with loading state
    document.getElementById('helpForm').addEventListener('submit', function() {
        const btn = this.querySelector('.btn-submit');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
        btn.disabled = true;
    });

    // Add focus effects to form inputs
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
</script>
@endsection
