import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();


// Import delle dipendenze
import Alpine from 'alpinejs';
import Focus from '@alpinejs/focus';
import Persist from '@alpinejs/persist';
import Collapse from '@alpinejs/collapse';

// Configurazione di Alpine.js
window.Alpine = Alpine;
Alpine.plugin(Focus);
Alpine.plugin(Persist);
Alpine.plugin(Collapse);

// Componenti personalizzati
Alpine.data('navigation', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
    close() {
        this.open = false;
    }
}));

Alpine.data('dropdown', () => ({
    open: false,
    toggle() {
        this.open = !this.open;
    },
    close() {
        this.open = false;
    }
}));

Alpine.data('modal', () => ({
    open: false,
    show() {
        this.open = true;
        document.body.style.overflow = 'hidden';
    },
    hide() {
        this.open = false;
        document.body.style.overflow = '';
    }
}));

// Utility functions
const debounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        timeoutId = setTimeout(() => {
            fn.apply(null, args);
        }, delay);
    };
};

const throttle = (fn, delay) => {
    let lastCall = 0;
    return (...args) => {
        const now = Date.now();
        if (now - lastCall >= delay) {
            fn.apply(null, args);
            lastCall = now;
        }
    };
};

// Event handlers
const handleScroll = throttle(() => {
    const header = document.querySelector('.header');
    if (header) {
        if (window.scrollY > 0) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    }
}, 100);

// Event listeners
window.addEventListener('scroll', handleScroll);

// Inizializzazione di Alpine.js
Alpine.start();
