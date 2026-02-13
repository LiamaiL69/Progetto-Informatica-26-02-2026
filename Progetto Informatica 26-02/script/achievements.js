const cards = document.querySelectorAll('.achievement-card');
    const taskBar = document.getElementById('taskBar');
    const taskText = document.getElementById('taskText');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const task = card.getAttribute('data-task');
            taskText.textContent = task;

            // Animazione semplice per evidenziare la barra
            taskBar.style.opacity = '1';
            setTimeout(() => {
                taskBar.style.opacity = '0.9';
            }, 100);
        });
    });