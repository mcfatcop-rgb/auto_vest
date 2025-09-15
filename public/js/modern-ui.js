/**
 * AutoVest Modern UI - Performance Optimized JavaScript
 * Handles animations, interactions, and performance optimizations
 */

(function() {
    'use strict';

    // Performance optimization: Debounce function
    function debounce(func, wait, immediate) {
        let timeout;
        return function executedFunction() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Performance optimization: Throttle function
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    // Intersection Observer for lazy loading animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const animationObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                animationObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Initialize animations when DOM is ready
    function initAnimations() {
        // Add animation classes to elements that should animate
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        animatedElements.forEach((el, index) => {
            el.classList.add(`animate-delay-${(index % 6) + 1}`);
            animationObserver.observe(el);
        });

        // Add staggered animation to cards
        const cards = document.querySelectorAll('.summary-card, .stat-card, .glass-card');
        cards.forEach((card, index) => {
            card.classList.add('animate-on-scroll');
            animationObserver.observe(card);
        });
    }

    // Enhanced form interactions
    function initFormEnhancements() {
        // Floating labels
        const floatingInputs = document.querySelectorAll('.form-floating .form-control');
        floatingInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });

            // Check if input has value on load
            if (input.value) {
                input.parentElement.classList.add('focused');
            }
        });

        // Password strength indicator
        const passwordInputs = document.querySelectorAll('input[type="password"]');
        passwordInputs.forEach(input => {
            if (input.id === 'password' && document.getElementById('passwordStrength')) {
                input.addEventListener('input', debounce(updatePasswordStrength, 300));
            }
        });

        // Password confirmation validation
        const passwordConfirm = document.getElementById('password_confirmation');
        const passwordField = document.getElementById('password');
        if (passwordConfirm && passwordField) {
            passwordConfirm.addEventListener('input', function() {
                const password = passwordField.value;
                const confirmation = this.value;
                
                if (confirmation.length > 0) {
                    if (password === confirmation) {
                        this.style.borderColor = '#28a745';
                        this.classList.add('is-valid');
                        this.classList.remove('is-invalid');
                    } else {
                        this.style.borderColor = '#dc3545';
                        this.classList.add('is-invalid');
                        this.classList.remove('is-valid');
                    }
                } else {
                    this.style.borderColor = 'rgba(102, 126, 234, 0.1)';
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
        }
    }

    // Password strength calculation
    function updatePasswordStrength() {
        const password = this.value;
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('passwordStrength');
        
        if (!strengthBar || !strengthText) return;

        let strength = 0;
        let strengthLabel = '';
        let strengthClass = '';
        
        if (password.length >= 6) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        switch(strength) {
            case 0:
            case 1:
                strengthLabel = 'Weak';
                strengthClass = 'strength-weak';
                break;
            case 2:
                strengthLabel = 'Fair';
                strengthClass = 'strength-fair';
                break;
            case 3:
            case 4:
                strengthLabel = 'Good';
                strengthClass = 'strength-good';
                break;
            case 5:
                strengthLabel = 'Strong';
                strengthClass = 'strength-strong';
                break;
        }
        
        strengthBar.className = 'strength-fill ' + strengthClass;
        strengthText.textContent = password.length > 0 ? 'Password strength: ' + strengthLabel : '';
    }

    // Enhanced button interactions
    function initButtonEnhancements() {
        // Loading states for forms
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"], input[type="submit"]');
                if (submitBtn) {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                    
                    // Add loading text
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                    
                    // Reset after 30 seconds (fallback)
                    setTimeout(() => {
                        submitBtn.classList.remove('loading');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                    }, 30000);
                }
            });
        });

        // Button hover effects
        const modernButtons = document.querySelectorAll('.btn-modern, .btn-login, .btn-register, .btn-save');
        modernButtons.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }

    // Tab switching functionality
    function initTabSwitching() {
        const tabLinks = document.querySelectorAll('[data-tab]');
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const tabId = this.getAttribute('data-tab') + '-tab';
                const targetTab = document.getElementById(tabId);
                
                if (targetTab) {
                    // Remove active class from all tabs and nav links
                    document.querySelectorAll('.settings-nav a').forEach(navLink => 
                        navLink.classList.remove('active'));
                    document.querySelectorAll('.settings-tab').forEach(tab => 
                        tab.classList.remove('active'));
                    
                    // Add active class to clicked nav link and target tab
                    this.classList.add('active');
                    targetTab.classList.add('active');
                }
            });
        });
    }

    // Smooth scrolling for anchor links
    function initSmoothScrolling() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Performance monitoring
    function initPerformanceMonitoring() {
        // Monitor page load performance
        window.addEventListener('load', function() {
            if ('performance' in window) {
                const perfData = performance.getEntriesByType('navigation')[0];
                console.log('Page load time:', perfData.loadEventEnd - perfData.loadEventStart, 'ms');
            }
        });

        // Monitor scroll performance
        let scrollTimeout;
        window.addEventListener('scroll', throttle(function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                // Debounced scroll handling
            }, 100);
        }, 16)); // ~60fps
    }

    // Initialize all enhancements when DOM is ready
    function init() {
        // Check if DOM is already loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            // DOM is already loaded
            initAnimations();
            initFormEnhancements();
            initButtonEnhancements();
            initTabSwitching();
            initSmoothScrolling();
            initPerformanceMonitoring();
        }
    }

    // Initialize the module
    init();

    // Export functions for external use
    window.AutoVestUI = {
        debounce,
        throttle,
        initAnimations,
        initFormEnhancements,
        initButtonEnhancements
    };

})();
