document.addEventListener('DOMContentLoaded', () => {
    const magicCards = document.querySelectorAll('.magic-card');

    // Colors
    const colorPalette = [
        'rgb(155, 109, 198)',
        'rgb(185, 158, 225)',
        'rgb(234, 234, 234)',
        'rgb(203, 195, 227)'
    ];

    magicCards.forEach((magicCard) => {
        const particleContainer = magicCard.querySelector('.magic-particles');

        // Generate a new particle
        function createParticle(x, y, directionX, directionY) {
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
            particleContainer.appendChild(particle);

            // Remove the particle after the animation ends
            particle.addEventListener('animationend', () => {
                particle.remove();
            });
        }

        // Generate particles
        function generateParticles() {
            const rect = magicCard.getBoundingClientRect();
            const numParticles = 15; // Number of particles to generate
            const distance = 250; // Travel distance

            for (let i = 0; i < numParticles; i++) {
                // Random start position
                const startX = Math.random() * rect.width;
                const startY = Math.random() * rect.height;

                // Random direction
                const angle = Math.random() * Math.PI * 2; // Angolo casuale
                const directionX = Math.cos(angle) * distance;
                const directionY = Math.sin(angle) * distance;

                createParticle(startX, startY, directionX, directionY);
            }
        }

        // Generate particles on mouse enter
        magicCard.addEventListener('mouseenter', generateParticles);
    });
});