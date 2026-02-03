function initAdSliderForAll() {
    const adBoxes = document.querySelectorAll('.ad-box');

    adBoxes.forEach(adBox => {
        const images = adBox.querySelectorAll('img');
        let index = 0;
        images[index].classList.add('active');

        setInterval(() => {
            images[index].classList.remove('active');
            index = (index + 1) % images.length;
            images[index].classList.add('active');
        }, 3000); // ogni 3 secondi
    });
}

// Inizializza tutti gli slider
initAdSliderForAll();
