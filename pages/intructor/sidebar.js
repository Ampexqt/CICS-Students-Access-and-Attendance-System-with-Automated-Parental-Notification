/**
 * Enhanced Responsive Sidebar Manager for CICS Instructor Pages
 * Provides consistent sidebar behavior across all instructor pages
 */

class ResponsiveSidebarManager {
    constructor() {
        this.sidebar = document.getElementById('sidebar');
        this.sidebarOverlay = document.getElementById('sidebarOverlay');
        this.mobileMenuBtn = document.getElementById('mobileMenuBtn');
        this.isOpen = false;
        this.breakpoint = 1024;
        this.touchStartX = 0;
        this.touchEndX = 0;
        
        this.init();
    }

    init() {
        if (!this.sidebar || !this.mobileMenuBtn) {
            console.warn('Sidebar elements not found. Skipping sidebar initialization.');
            return;
        }

        this.bindEvents();
        this.handleResize();
        this.setupKeyboardNavigation();
        this.setupTouchGestures();
        this.setupAccessibility();
    }

    bindEvents() {
        // Mobile menu button click
        this.mobileMenuBtn?.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggle();
        });

        // Overlay click to close
        this.sidebarOverlay?.addEventListener('click', () => {
            this.close();
        });

        // Window resize handler
        window.addEventListener('resize', this.debounce(() => {
            this.handleResize();
        }, 250));

        // Escape key to close sidebar
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.close();
            }
        });
    }

    setupTouchGestures() {
        // Swipe to open/close sidebar on mobile
        document.addEventListener('touchstart', (e) => {
            this.touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', (e) => {
            this.touchEndX = e.changedTouches[0].screenX;
            this.handleSwipe();
        });
    }

    handleSwipe() {
        const swipeThreshold = 100;
        const swipeDistance = this.touchEndX - this.touchStartX;

        if (window.innerWidth <= this.breakpoint) {
            // Swipe right to open (from left edge)
            if (swipeDistance > swipeThreshold && this.touchStartX < 50 && !this.isOpen) {
                this.open();
            }
            // Swipe left to close
            else if (swipeDistance < -swipeThreshold && this.isOpen) {
                this.close();
            }
        }
    }

    setupAccessibility() {
        // Set initial ARIA attributes
        this.sidebar?.setAttribute('aria-hidden', 'true');
        this.mobileMenuBtn?.setAttribute('aria-expanded', 'false');
        
        // Add focus trap for sidebar
        this.setupFocusTrap();
    }

    setupFocusTrap() {
        const focusableElements = this.sidebar?.querySelectorAll(
            'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
        );
        
        if (!focusableElements || focusableElements.length === 0) return;

        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

        this.sidebar?.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        e.preventDefault();
                        lastFocusable.focus();
                    }
                } else {
                    if (document.activeElement === lastFocusable) {
                        e.preventDefault();
                        firstFocusable.focus();
                    }
                }
            }
        });
    }

    toggle() {
        this.isOpen ? this.close() : this.open();
    }

    open() {
        this.sidebar?.classList.add('open');
        this.sidebarOverlay?.classList.add('active');
        this.isOpen = true;
        
        // Prevent body scroll when sidebar is open on mobile
        if (window.innerWidth <= this.breakpoint) {
            document.body.style.overflow = 'hidden';
        }
        
        // Update ARIA attributes for accessibility
        this.sidebar?.setAttribute('aria-hidden', 'false');
        this.mobileMenuBtn?.setAttribute('aria-expanded', 'true');
        
        // Focus management
        this.focusFirstNavItem();
        
        // Dispatch custom event
        this.dispatchEvent('sidebarOpen');
    }

    close() {
        this.sidebar?.classList.remove('open');
        this.sidebarOverlay?.classList.remove('active');
        this.isOpen = false;
        
        // Restore body scroll
        document.body.style.overflow = '';
        
        // Update ARIA attributes for accessibility
        this.sidebar?.setAttribute('aria-hidden', 'true');
        this.mobileMenuBtn?.setAttribute('aria-expanded', 'false');
        
        // Return focus to menu button
        this.mobileMenuBtn?.focus();
        
        // Dispatch custom event
        this.dispatchEvent('sidebarClose');
    }

    handleResize() {
        if (window.innerWidth > this.breakpoint) {
            this.close();
            document.body.style.overflow = '';
        }
    }

    focusFirstNavItem() {
        const firstNavLink = this.sidebar?.querySelector('.nav-link');
        if (firstNavLink && window.innerWidth <= this.breakpoint) {
            setTimeout(() => firstNavLink.focus(), 100);
        }
    }

    setupKeyboardNavigation() {
        // Enhanced keyboard navigation within sidebar
        const navLinks = this.sidebar?.querySelectorAll('.nav-link');
        navLinks?.forEach((link, index) => {
            link.addEventListener('keydown', (e) => {
                switch (e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        const nextIndex = (index + 1) % navLinks.length;
                        navLinks[nextIndex].focus();
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        const prevIndex = (index - 1 + navLinks.length) % navLinks.length;
                        navLinks[prevIndex].focus();
                        break;
                    case 'Home':
                        e.preventDefault();
                        navLinks[0].focus();
                        break;
                    case 'End':
                        e.preventDefault();
                        navLinks[navLinks.length - 1].focus();
                        break;
                }
            });
        });
    }

    dispatchEvent(eventName) {
        const event = new CustomEvent(eventName, {
            detail: { isOpen: this.isOpen }
        });
        document.dispatchEvent(event);
    }

    // Utility function for debouncing
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

/**
 * Navigation Manager for handling active states and smooth transitions
 */
class NavigationManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupNavigation();
        this.setupHoverEffects();
    }

    setupNavigation() {
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                // Update active states
                document.querySelectorAll('.sidebar-nav .nav-link').forEach(l => {
                    l.classList.remove('active');
                    l.removeAttribute('aria-current');
                });
                
                e.currentTarget.classList.add('active');
                e.currentTarget.setAttribute('aria-current', 'page');
                
                // Close sidebar on mobile after navigation
                if (window.innerWidth <= 1024 && window.sidebarManager) {
                    setTimeout(() => {
                        window.sidebarManager.close();
                    }, 150);
                }
            });
        });
    }

    setupHoverEffects() {
        document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
            link.addEventListener('mouseenter', () => {
                if (!link.classList.contains('active')) {
                    link.classList.add('nav-hover');
                }
            });

            link.addEventListener('mouseleave', () => {
                link.classList.remove('nav-hover');
            });
        });
    }
}

/**
 * Scroll to Top Button Manager
 */
class ScrollToTopManager {
    constructor() {
        this.button = null;
        this.init();
    }

    init() {
        this.createButton();
        this.bindEvents();
    }

    createButton() {
        this.button = document.createElement('button');
        this.button.innerHTML = '<i data-lucide="arrow-up" aria-hidden="true"></i>';
        this.button.className = 'scroll-to-top';
        this.button.setAttribute('aria-label', 'Scroll to top');
        this.button.style.cssText = `
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 3rem;
            height: 3rem;
            background: var(--primary-navy);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
            box-shadow: 0 4px 12px rgba(26, 62, 108, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        `;

        document.body.appendChild(this.button);
        
        // Initialize Lucide icons for the new button
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    bindEvents() {
        // Show/hide scroll button based on scroll position
        window.addEventListener('scroll', this.debounce(() => {
            if (window.scrollY > 300) {
                this.show();
            } else {
                this.hide();
            }
        }, 100));

        // Scroll to top functionality
        this.button?.addEventListener('click', () => {
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        });
    }

    show() {
        if (this.button) {
            this.button.style.opacity = '1';
            this.button.style.visibility = 'visible';
        }
    }

    hide() {
        if (this.button) {
            this.button.style.opacity = '0';
            this.button.style.visibility = 'hidden';
        }
    }

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

/**
 * Initialize all managers when DOM is loaded
 */
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Initialize managers
    window.sidebarManager = new ResponsiveSidebarManager();
    window.navigationManager = new NavigationManager();
    window.scrollToTopManager = new ScrollToTopManager();
    
    // Add loading completion class
    document.body.classList.add('loaded');
    
    // Log initialization
    console.log('CICS Sidebar Manager initialized successfully');
});

// Export for use in other scripts if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        ResponsiveSidebarManager,
        NavigationManager,
        ScrollToTopManager
    };
}
