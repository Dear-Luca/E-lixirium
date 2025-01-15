document.addEventListener('DOMContentLoaded', () => {
    document.querySelector("nav a.dropdown-toggle").addEventListener('click', function (event) {
        const dropdownMenu = document.querySelector("nav ul.dropdown-menu");
        // Check if dropdown is expanded
        if (!dropdownMenu.classList.contains('show')) {
            // Redirect to all products page
            window.location.href = "./?page=products";
        }
    });

    const magicCards = document.querySelectorAll('.magic-card');
    const particlesSwitch = document.querySelector("input[type='checkbox'][role='switch']");

    // Colors
    const colorPalette = [
        'rgb(155, 109, 198)',
        'rgb(185, 158, 225)',
        'rgb(234, 234, 234)',
        'rgb(203, 195, 227)'
    ];

    function createParticle(container, x, y, directionX, directionY) {
        const particle = document.createElement('div');
        particle.className = 'particle';

        // Random color
        const randomColor = colorPalette[Math.floor(Math.random() * colorPalette.length)];
        particle.style.setProperty('--particle-color', randomColor);

        // Initial position
        particle.style.left = `${x}px`;
        particle.style.top = `${y}px`;

        // Direction
        particle.style.setProperty('--x', `${directionX}px`);
        particle.style.setProperty('--y', `${directionY}px`);

        // Append to container
        container.appendChild(particle);

        // Remove the particle after the animation ends
        particle.addEventListener('animationend', () => {
            particle.remove();
        });
    }

    function generateParticles(magicCard) {
        const rect = magicCard.getBoundingClientRect();
        const particleContainer = magicCard.querySelector('.magic-particles');
        const numParticles = 15; // Number of particles to generate
        const distance = 250; // Travel distance

        if (particlesSwitch.checked) {
            for (let i = 0; i < numParticles; i++) {
                // Random start position
                const startX = Math.random() * rect.width;
                const startY = Math.random() * rect.height;

                // Random direction
                const angle = Math.random() * Math.PI * 2; // Random angle
                const directionX = Math.cos(angle) * distance;
                const directionY = Math.sin(angle) * distance;

                createParticle(particleContainer, startX, startY, directionX, directionY);
            }
        }
    }

    magicCards.forEach((magicCard) => {
        // Generate particles on mouse enter
        magicCard.addEventListener('mouseenter', () => generateParticles(magicCard));
    });
});