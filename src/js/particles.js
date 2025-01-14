document.addEventListener('DOMContentLoaded', () => {
    const magicCards = document.querySelectorAll('.magic-card');

    // Palette di colori
    const colorPalette = [
        'rgb(155, 109, 198)',
        'rgb(185, 158, 225)',
        'rgb(234, 234, 234)',
        'rgb(203, 195, 227)'
    ];

    magicCards.forEach((magicCard) => {
        const particleContainer = magicCard.querySelector('.magic-particles');

        // Funzione per generare una particella
        function createParticle(x, y, directionX, directionY) {
            const particle = document.createElement('div');
            particle.className = 'particle';

            // Colore casuale dalla palette
            const randomColor = colorPalette[Math.floor(Math.random() * colorPalette.length)];
            particle.style.setProperty('--particle-color', randomColor);

            // Posizione iniziale della particella
            particle.style.left = `${x}px`;
            particle.style.top = `${y}px`;

            // Direzione dell'animazione
            particle.style.setProperty('--x', `${directionX}px`);
            particle.style.setProperty('--y', `${directionY}px`);

            // Aggiungi particella al contenitore
            particleContainer.appendChild(particle);

            // Rimuovi particella al termine dell'animazione
            particle.addEventListener('animationend', () => {
                particle.remove();
            });
        }

        // Funzione per generare particelle randomicamente dentro la card
        function generateParticles() {
            const rect = magicCard.getBoundingClientRect();
            const numParticles = 15; // Numero di particelle generate
            const distance = 250; // Distanza verso cui si espandono le particelle

            for (let i = 0; i < numParticles; i++) {
                // Posizione casuale all'interno della card
                const startX = Math.random() * rect.width;
                const startY = Math.random() * rect.height;

                // Direzione casuale
                const angle = Math.random() * Math.PI * 2; // Angolo casuale
                const directionX = Math.cos(angle) * distance;
                const directionY = Math.sin(angle) * distance;

                createParticle(startX, startY, directionX, directionY);
            }
        }

        // Genera particelle al passaggio del cursore sopra la card
        magicCard.addEventListener('mouseenter', generateParticles);
    });
});