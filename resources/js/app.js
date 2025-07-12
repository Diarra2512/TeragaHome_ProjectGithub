import './bootstrap';                      // axios, configurations diverses
import 'bootstrap/dist/js/bootstrap.bundle';  // Bootstrap JS (carrousel, dropdown, etc)
import '../css/app.css';                   // CSS (Tailwind ou autres)


AOS.init();

// Démarrer le compteur quand la page est prête
window.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('client-counter');
    if (el) {
        const counter = new CountUp('client-counter', 50, {
            duration: 2,
            prefix: '+',
        });
        if (!counter.error) {
            counter.start();
        } else {
            console.error(counter.error);
        }
    }
});

