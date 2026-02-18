/**
 * PROJECT: GADO_IT15_ENROLLMENT_SYSTEM
 * SCHOOL: University of Mindanao (Tagum Campus)
 * * This file contains the primary client-side logic for the UM Student Portal,
 * including authentication UI helpers, navigation state management, 
 * and enrollment business rule pre-validation.
 */

const UMPortal = {
    /**
     * Initialize all portal UI components
     */
    init() {
        this.setupPasswordToggle();
        this.handleNavigationState();
        this.setupAlertDismissal();
        this.initEnrollmentListeners();
        this.setupLogoutConfirmation();
    },

    /**
     * 1. Password Visibility Toggle (Login Page)
     * Mirrors the behavior seen in the Tagum Campus login card.
     */
    setupPasswordToggle() {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('input[name="password"]');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                // Toggle icon classes for FontAwesome 6 (common in Laravel kits)
                const icon = this.querySelector('i') || this;
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }
    },

    /**
     * 2. Sidebar Navigation Active States
     * Ensures the gray sidebar correctly highlights the current module (SPR, Evaluation, etc.)
     */
    handleNavigationState() {
        const navLinks = document.querySelectorAll('.nav-link');
        const currentPath = window.location.pathname;

        navLinks.forEach(link => {
            link.classList.remove('active');
            
            // Exact match or sub-route match for modules
            const linkPath = new URL(link.href, window.location.origin).pathname;
            if (currentPath === linkPath || (currentPath.startsWith(linkPath) && linkPath !== '/')) {
                link.classList.add('active');
            }
        });
    },

    /**
     * 3. Alert Management
     * Auto-dismisses Laravel session flash messages (Success/Error)
     */
    setupAlertDismissal() {
        const alerts = document.querySelectorAll('.alert-dismissible, .portal-toast');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    },

    /**
     * 4. Enrollment Interactions
     * Centralized listener for enrollment buttons to ensure UI consistency
     */
    initEnrollmentListeners() {
        // Uses event delegation for dynamically loaded course lists
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-enroll-trigger');
            if (!btn) return;

            const capacity = parseInt(btn.dataset.capacity);
            const current = parseInt(btn.dataset.enrolled);
            
            if (!this.validateEnrollment(capacity, current)) {
                e.preventDefault();
                this.showPortalNotification('Enrollment Failed: This course has reached its maximum capacity.', 'error');
            }
        });
    },

    /**
     * Business Rule: Capacity Check
     * Validates against the blueprint rule: students_count < capacity
     */
    validateEnrollment(capacity, current) {
        if (isNaN(capacity) || isNaN(current)) return true; // Fallback to server validation
        return current < capacity;
    },

    /**
     * 5. Logout Confirmation
     * Prevents accidental logouts from the sidebar
     */
    setupLogoutConfirmation() {
        const logoutBtn = document.querySelector('.btn-logout');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', (e) => {
                if (!confirm('Are you sure you want to sign out from the Student Portal?')) {
                    e.preventDefault();
                }
            });
        }
    },

    /**
     * Custom UI Notification
     * Replaces standard browser alerts for a more integrated UM Portal feel
     */
    showPortalNotification(message, type = 'info') {
        const notifyBox = document.createElement('div');
        notifyBox.className = `portal-toast toast-${type}`;
        
        // Safety: textContent avoids XSS
        notifyBox.textContent = message;
        document.body.appendChild(notifyBox);
        
        // Trigger reflow for animation
        void notifyBox.offsetWidth;
        notifyBox.classList.add('show');
        
        setTimeout(() => {
            notifyBox.classList.remove('show');
            setTimeout(() => notifyBox.remove(), 300);
        }, 3000);
    }
};

// Start application on DOM Ready
document.addEventListener('DOMContentLoaded', () => {
    UMPortal.init();
});

/**
 * Global Export for inline HTML calls (backwards compatibility for legacy views)
 */
window.validateEnrollment = (capacity, current) => UMPortal.validateEnrollment(capacity, current);
