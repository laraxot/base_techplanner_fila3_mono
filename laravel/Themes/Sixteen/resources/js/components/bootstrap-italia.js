/**
 * Bootstrap Italia Components JavaScript
 * 
 * Performance-optimized JavaScript functionality for all Bootstrap Italia compliant components
 * Used by the Sixteen theme for Italian PA websites with lazy loading and intersection observers
 */

// Lazy import Bootstrap Italia core functionality
let BootstrapItalia;

// Performance monitoring
const performanceMetrics = {
    componentsInitialized: 0,
    initTime: 0,
    lazyLoadedComponents: 0
};

// Component initialization queue for performance optimization
const initQueue = new Set();
let isProcessingQueue = false;

// Intersection Observer for lazy loading
const intersectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const element = entry.target;
            const componentType = element.dataset.lazyComponent;
            
            if (componentType && !element.dataset.initialized) {
                initQueue.add({ element, componentType });
                processInitQueue();
                intersectionObserver.unobserve(element);
            }
        }
    });
}, {
    rootMargin: '50px',
    threshold: 0.1
});

// Optimized DOM ready handler with performance tracking
document.addEventListener('DOMContentLoaded', function() {
    const startTime = performance.now();
    
    // Load Bootstrap Italia dynamically
    loadBootstrapItalia().then(() => {
        // Initialize critical components immediately
        initCriticalComponents();
        
        // Set up lazy loading for non-critical components
        setupLazyLoading();
        
        // Initialize visible components
        initVisibleComponents();
        
        // Performance tracking
        performanceMetrics.initTime = performance.now() - startTime;
        console.log(`Bootstrap Italia components initialized in ${performanceMetrics.initTime.toFixed(2)}ms`);
        
        // Dispatch custom event for initialization complete
        window.dispatchEvent(new CustomEvent('bootstrapItaliaReady', {
            detail: performanceMetrics
        }));
    });
});

/**
 * Dynamically load Bootstrap Italia library
 */
async function loadBootstrapItalia() {
    if (BootstrapItalia) return BootstrapItalia;
    
    try {
        BootstrapItalia = await import('bootstrap-italia');
        return BootstrapItalia;
    } catch (error) {
        console.warn('Bootstrap Italia library not available, falling back to basic functionality');
        return null;
    }
}

/**
 * Initialize critical components that need to be available immediately
 */
function initCriticalComponents() {
    // Skiplinks for accessibility
    initSkiplinks();
    
    // Cookiebar (legal requirement)
    initCookiebar();
    
    // Tooltips (user feedback)
    initTooltips();
    
    performanceMetrics.componentsInitialized += 3;
}

/**
 * Set up lazy loading for non-critical components
 */
function setupLazyLoading() {
    // Find all components that can be lazy loaded
    const lazyComponents = document.querySelectorAll('[data-lazy-component]');
    
    lazyComponents.forEach(element => {
        intersectionObserver.observe(element);
    });
    
    // Also observe components that may be added dynamically
    const mutationObserver = new MutationObserver((mutations) => {
        mutations.forEach(mutation => {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === Node.ELEMENT_NODE) {
                    const lazyElements = node.querySelectorAll ? 
                        node.querySelectorAll('[data-lazy-component]') : [];
                    
                    lazyElements.forEach(element => {
                        intersectionObserver.observe(element);
                    });
                }
            });
        });
    });
    
    mutationObserver.observe(document.body, {
        childList: true,
        subtree: true
    });
}

/**
 * Initialize components that are currently visible
 */
function initVisibleComponents() {
    // Progress indicators for immediate feedback
    initProgressDonuts();
    
    // Notifications that are currently visible
    initNotifications();
    
    // Rating components for immediate interaction
    initRatingComponents();
    
    performanceMetrics.componentsInitialized += 3;
}

/**
 * Process the component initialization queue with throttling
 */
async function processInitQueue() {
    if (isProcessingQueue || initQueue.size === 0) return;
    
    isProcessingQueue = true;
    
    // Process queue in batches to avoid blocking the main thread
    const batchSize = 3;
    const batch = Array.from(initQueue).slice(0, batchSize);
    
    for (const { element, componentType } of batch) {
        await initComponentByType(element, componentType);
        initQueue.delete({ element, componentType });
        performanceMetrics.lazyLoadedComponents++;
    }
    
    isProcessingQueue = false;
    
    // Continue processing if there are more items
    if (initQueue.size > 0) {
        requestAnimationFrame(() => processInitQueue());
    }
}

/**
 * Initialize a component by its type with error handling
 */
async function initComponentByType(element, componentType) {
    try {
        element.dataset.initialized = 'true';
        
        switch (componentType) {
            case 'toggle':
                initToggleComponent(element);
                break;
            case 'megamenu':
                initMegamenuComponent(element);
                break;
            case 'sidebar':
                initSidebarComponent(element);
                break;
            case 'bottom-nav':
                initBottomNavComponent(element);
                break;
            case 'tab':
                initTabComponent(element);
                break;
            case 'accordion':
                initAccordionComponent(element);
                break;
            case 'carousel':
                initCarouselComponent(element);
                break;
            case 'timeline':
                initTimelineComponent(element);
                break;
            default:
                console.warn(`Unknown component type: ${componentType}`);
        }
        
        performanceMetrics.componentsInitialized++;
    } catch (error) {
        console.error(`Error initializing ${componentType} component:`, error);
    }
}

/**
 * Initialize Skiplinks for accessibility
 */
function initSkiplinks() {
    const skiplinks = document.querySelectorAll('.skiplinks');
    skiplinks.forEach(link => {
        link.addEventListener('focus', function() {
            this.style.top = '0';
        });
        
        link.addEventListener('blur', function() {
            this.style.top = '-40px';
        });
    });
}

/**
 * Initialize Tooltips
 */
function initTooltips() {
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

/**
 * Initialize Progress Donut components with performance optimization
 */
function initProgressDonuts() {
    const progressDonuts = document.querySelectorAll('.progress-donut:not([data-initialized])');
    
    if (progressDonuts.length === 0) return;
    
    // Use requestAnimationFrame for smooth animations
    requestAnimationFrame(() => {
        progressDonuts.forEach(donut => {
            const percentage = parseInt(donut.dataset.percentage) || 0;
            const label = donut.dataset.label || '';
            
            donut.setAttribute('data-initialized', 'true');
        
            // Initialize Bootstrap Italia ProgressDonut if available
            if (BootstrapItalia && BootstrapItalia.ProgressDonut) {
                new BootstrapItalia.ProgressDonut(donut, {
                    percentage: percentage,
                    label: label,
                    animate: true
                });
            }
        });
    });
}

/**
 * Initialize Notification components with auto-hide functionality
 */
function initNotifications() {
    const notifications = document.querySelectorAll('.notification[data-auto-hide]');
    
    notifications.forEach(notification => {
        const autoHideTime = parseInt(notification.dataset.autoHide) || 5000;
        
        // Auto-hide functionality
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-100%)';
            
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, autoHideTime);
    });
    
    // Dismissible notification functionality
    const dismissButtons = document.querySelectorAll('.notification [data-bs-dismiss="notification"]');
    
    dismissButtons.forEach(button => {
        button.addEventListener('click', function() {
            const notification = this.closest('.notification');
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-100%)';
            
            setTimeout(() => {
                notification.remove();
            }, 300);
        });
    });
}

/**
 * Initialize Cookiebar functionality
 */
function initCookiebar() {
    const cookiebar = document.querySelector('.cookiebar');
    if (!cookiebar) return;
    
    // Check if cookies have already been accepted
    if (localStorage.getItem('cookiesAccepted') === 'true') {
        cookiebar.style.display = 'none';
        return;
    }
    
    // Accept all cookies
    const acceptAllBtn = cookiebar.querySelector('[data-accept="all"]');
    if (acceptAllBtn) {
        acceptAllBtn.addEventListener('click', function() {
            localStorage.setItem('cookiesAccepted', 'true');
            localStorage.setItem('cookiePreferences', JSON.stringify({
                necessary: true,
                preferences: true,
                statistics: true,
                marketing: true
            }));
            hideCookiebar();
        });
    }
    
    // Accept only necessary cookies
    const acceptNecessaryBtn = cookiebar.querySelector('[data-accept="necessary"]');
    if (acceptNecessaryBtn) {
        acceptNecessaryBtn.addEventListener('click', function() {
            localStorage.setItem('cookiesAccepted', 'true');
            localStorage.setItem('cookiePreferences', JSON.stringify({
                necessary: true,
                preferences: false,
                statistics: false,
                marketing: false
            }));
            hideCookiebar();
        });
    }
    
    // Close button
    const closeBtn = cookiebar.querySelector('.btn-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            hideCookiebar();
        });
    }
    
    function hideCookiebar() {
        cookiebar.style.opacity = '0';
        cookiebar.style.transform = 'translateY(100%)';
        
        setTimeout(() => {
            cookiebar.style.display = 'none';
        }, 300);
    }
}

/**
 * Initialize Rating components
 */
function initRatingComponents() {
    const ratings = document.querySelectorAll('.rating:not(.rating-readonly)');
    
    ratings.forEach(rating => {
        const inputs = rating.querySelectorAll('input[type="radio"]');
        const labels = rating.querySelectorAll('label');
        
        // Handle hover effects
        labels.forEach((label, index) => {
            label.addEventListener('mouseenter', function() {
                highlightStars(labels, index);
            });
        });
        
        rating.addEventListener('mouseleave', function() {
            const checkedInput = rating.querySelector('input[type="radio"]:checked');
            if (checkedInput) {
                const checkedIndex = Array.from(inputs).indexOf(checkedInput);
                highlightStars(labels, checkedIndex);
            } else {
                clearStars(labels);
            }
        });
        
        // Handle selection
        inputs.forEach((input, index) => {
            input.addEventListener('change', function() {
                if (this.checked) {
                    highlightStars(labels, index);
                    
                    // Trigger custom event
                    rating.dispatchEvent(new CustomEvent('ratingChanged', {
                        detail: { rating: parseInt(this.value) }
                    }));
                }
            });
        });
    });
    
    function highlightStars(labels, upToIndex) {
        labels.forEach((label, index) => {
            if (index >= labels.length - upToIndex - 1) {
                label.style.color = '#ff6900';
            } else {
                label.style.color = '#d9dadb';
            }
        });
    }
    
    function clearStars(labels) {
        labels.forEach(label => {
            label.style.color = '#d9dadb';
        });
    }
}

/**
 * Initialize Toggle components
 */
function initToggleComponents() {
    const toggles = document.querySelectorAll('.toggle-element input[type="checkbox"]');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            // Trigger custom event
            this.closest('.toggle-element').dispatchEvent(new CustomEvent('toggleChanged', {
                detail: { 
                    checked: this.checked,
                    value: this.value 
                }
            }));
        });
    });
}

/**
 * Initialize Megamenu functionality
 */
function initMegamenu() {
    const megamenus = document.querySelectorAll('.megamenu');
    
    megamenus.forEach(megamenu => {
        const trigger = megamenu.querySelector('.megamenu-trigger');
        const dropdown = megamenu.querySelector('.megamenu-dropdown');
        
        if (!trigger || !dropdown) return;
        
        let timeoutId;
        
        // Show on hover
        megamenu.addEventListener('mouseenter', function() {
            clearTimeout(timeoutId);
            dropdown.classList.add('show');
            trigger.setAttribute('aria-expanded', 'true');
        });
        
        // Hide on leave
        megamenu.addEventListener('mouseleave', function() {
            timeoutId = setTimeout(() => {
                dropdown.classList.remove('show');
                trigger.setAttribute('aria-expanded', 'false');
            }, 100);
        });
        
        // Keyboard navigation
        trigger.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                dropdown.classList.toggle('show');
                trigger.setAttribute('aria-expanded', dropdown.classList.contains('show'));
            }
            
            if (e.key === 'Escape') {
                dropdown.classList.remove('show');
                trigger.setAttribute('aria-expanded', 'false');
                trigger.focus();
            }
        });
    });
}

/**
 * Initialize Sidebar functionality
 */
function initSidebar() {
    const sidebars = document.querySelectorAll('.sidebar');
    
    sidebars.forEach(sidebar => {
        const toggles = sidebar.querySelectorAll('[data-bs-toggle="collapse"]');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const target = document.querySelector(this.getAttribute('data-bs-target'));
                
                if (target) {
                    const isExpanded = target.classList.contains('show');
                    this.setAttribute('aria-expanded', !isExpanded);
                    
                    // Toggle icon rotation
                    const icon = this.querySelector('.icon');
                    if (icon) {
                        icon.style.transform = isExpanded ? 'rotate(0deg)' : 'rotate(90deg)';
                    }
                }
            });
        });
    });
}

/**
 * Initialize Bottom Navigation
 */
function initBottomNav() {
    const bottomNavs = document.querySelectorAll('.bottom-nav');
    
    bottomNavs.forEach(nav => {
        const links = nav.querySelectorAll('.nav-link');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                // Remove active class from all links
                links.forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Trigger custom event
                nav.dispatchEvent(new CustomEvent('bottomNavChanged', {
                    detail: { 
                        activeLink: this.getAttribute('href') || this.dataset.target
                    }
                }));
            });
        });
    });
}

/**
 * Initialize Tab components
 */
function initTabComponents() {
    const tabContainers = document.querySelectorAll('.nav-tabs');
    
    tabContainers.forEach(container => {
        const tabs = container.querySelectorAll('.nav-link');
        const tabPanes = document.querySelectorAll(container.dataset.target + ' .tab-pane');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetPane = document.querySelector(this.getAttribute('href'));
                
                // Remove active classes
                tabs.forEach(t => t.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('active', 'show'));
                
                // Add active classes
                this.classList.add('active');
                if (targetPane) {
                    targetPane.classList.add('active', 'show');
                }
                
                // Update ARIA attributes
                this.setAttribute('aria-selected', 'true');
                tabs.forEach(t => {
                    if (t !== this) {
                        t.setAttribute('aria-selected', 'false');
                    }
                });
            });
            
            // Keyboard navigation
            tab.addEventListener('keydown', function(e) {
                const currentIndex = Array.from(tabs).indexOf(this);
                let newIndex = currentIndex;
                
                if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    newIndex = currentIndex > 0 ? currentIndex - 1 : tabs.length - 1;
                } else if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
                    e.preventDefault();
                    newIndex = currentIndex < tabs.length - 1 ? currentIndex + 1 : 0;
                } else if (e.key === 'Home') {
                    e.preventDefault();
                    newIndex = 0;
                } else if (e.key === 'End') {
                    e.preventDefault();
                    newIndex = tabs.length - 1;
                }
                
                if (newIndex !== currentIndex) {
                    tabs[newIndex].click();
                    tabs[newIndex].focus();
                }
            });
        });
    });
}

/**
 * Initialize Accordion components
 */
function initAccordionComponents() {
    const accordions = document.querySelectorAll('.accordion');
    
    accordions.forEach(accordion => {
        const buttons = accordion.querySelectorAll('.accordion-button');
        
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const target = document.querySelector(this.getAttribute('data-bs-target'));
                const isExpanded = !this.classList.contains('collapsed');
                
                // Close all other accordion items if not allowing multiple
                if (!accordion.dataset.allowMultiple) {
                    buttons.forEach(btn => {
                        if (btn !== this) {
                            btn.classList.add('collapsed');
                            btn.setAttribute('aria-expanded', 'false');
                            const otherTarget = document.querySelector(btn.getAttribute('data-bs-target'));
                            if (otherTarget) {
                                otherTarget.classList.remove('show');
                            }
                        }
                    });
                }
                
                // Toggle current item
                this.classList.toggle('collapsed');
                this.setAttribute('aria-expanded', isExpanded);
                
                if (target) {
                    target.classList.toggle('show');
                }
            });
        });
    });
}

/**
 * Utility function to create toast notifications dynamically
 */
window.createNotification = function(message, type = 'info', options = {}) {
    const notification = document.createElement('div');
    notification.className = `notification ${type} ${options.position || 'top-fix'}`;
    
    if (options.icon) {
        notification.classList.add('with-icon');
    }
    
    const iconHtml = options.icon ? `<svg class="icon icon-sm"><use href="#${options.icon}"></use></svg>` : '';
    
    notification.innerHTML = `
        <h2>${iconHtml} ${options.title || 'Notification'}</h2>
        <p>${message}</p>
        ${options.dismissible !== false ? '<button type="button" class="btn-close" data-bs-dismiss="notification" aria-label="Close"></button>' : ''}
    `;
    
    document.body.appendChild(notification);
    
    // Auto-hide if specified
    if (options.autoHide !== false) {
        const autoHideTime = options.autoHide || 5000;
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-100%)';
            
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, autoHideTime);
    }
    
    // Add dismiss functionality
    const closeBtn = notification.querySelector('.btn-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-100%)';
            
            setTimeout(() => {
                notification.remove();
            }, 300);
        });
    }
    
    return notification;
};

/**
 * Accessibility improvements
 */
function improveAccessibility() {
    // Focus management for modals and dropdowns
    document.addEventListener('shown.bs.modal', function(e) {
        const modal = e.target;
        const firstFocusable = modal.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (firstFocusable) {
            firstFocusable.focus();
        }
    });
    
    // Escape key handling
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close open dropdowns
            const openDropdowns = document.querySelectorAll('.dropdown-menu.show, .megamenu-dropdown.show');
            openDropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
                const trigger = dropdown.closest('.dropdown, .megamenu').querySelector('[data-bs-toggle], .megamenu-trigger');
                if (trigger) {
                    trigger.setAttribute('aria-expanded', 'false');
                    trigger.focus();
                }
            });
        }
    });
}

// Initialize accessibility improvements
improveAccessibility();
