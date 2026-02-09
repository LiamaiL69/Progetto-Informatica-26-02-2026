window.addEventListener("load", () => {
    const cards = document.querySelectorAll(".card.flip");

    // quando la partita finisce, gira la carta del banco
    if (document.querySelector(".result")) {
        cards.forEach(card => card.classList.add("flipped"));
    }
});
