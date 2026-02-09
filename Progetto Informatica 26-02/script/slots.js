const reels = document.querySelectorAll(".reel");
const spinButton = document.getElementById("spin");
const resultEl = document.querySelector(".result");

const symbols = ["🍒","🍋","🍊","🍉","⭐","💎"];
const BONUS_SYMBOL = "📖";
const BONUS_CHANCE = 0.1; // 10% di probabilità

const SYMBOL_HEIGHT = 60;
const VISIBLE_SYMBOLS = 3;
const TOTAL_SYMBOLS = 30;

// Genera simboli per ogni rullo
function createReelSymbols3x3(reel, finalSymbol){
    reel.innerHTML = "";
    const list = [];

    for(let i=0;i<TOTAL_SYMBOLS;i++){
        list.push(Math.random()<BONUS_CHANCE ? BONUS_SYMBOL : symbols[Math.floor(Math.random()*symbols.length)]);
    }

    // scegli casualmente l’indice del simbolo finale e salvalo
    const finalIndex = Math.floor(Math.random() * list.length);
    list[finalIndex] = finalSymbol;
    reel.dataset.finalIndex = finalIndex;

    list.forEach(sym=>{
        const div = document.createElement("div");
        div.classList.add("symbol");
        div.textContent = sym;
        reel.appendChild(div);
    });

    reel.style.transform = "translateY(0)";
    reel.style.transition = "";
}

// Restituisce i simboli visibili centrali del rullo
function getVisibleSymbols(reel){
    const symbolsArray = Array.from(reel.children);
    const centerIndex = parseInt(reel.dataset.finalIndex);
    const start = Math.max(0, centerIndex - 1); // prende il simbolo centrale e i vicini
    return symbolsArray.slice(start, start + VISIBLE_SYMBOLS).map(s => s.textContent);
}

// Animazione dei rulli con stop definitivo
function spinReel(reel, finalSymbol, delay){
    const symbolsArray = Array.from(reel.children);
    const finalIndex = parseInt(reel.dataset.finalIndex);

    // aggiungi copie per animazione fluida
    symbolsArray.forEach(s => reel.appendChild(s.cloneNode(true)));

    setTimeout(()=>{
        reel.style.transition = "transform 2s cubic-bezier(0.25,1,0.5,1)";
        reel.style.transform = `translateY(-${(finalIndex + symbolsArray.length)*SYMBOL_HEIGHT}px)`;
    }, delay);

    // fermata definitiva e cleanup
    reel.addEventListener('transitionend', function handler(){
        reel.style.transition = "";
        reel.style.transform = `translateY(-${finalIndex*SYMBOL_HEIGHT}px)`;

        // rimuove simboli extra
        while(reel.children.length > symbolsArray.length) reel.removeChild(reel.lastChild);

        reel.removeEventListener('transitionend', handler);
    });
}

// Controllo vincite
function checkWinningLines(){
    const matrix=[];
    for(let row=0; row<VISIBLE_SYMBOLS; row++){
        matrix[row]=[];
        reels.forEach(r=>{
            const visible = getVisibleSymbols(r);
            matrix[row].push(visible[row]);
        });
    }

    const winLines=[];
    // righe
    for(let r=0;r<VISIBLE_SYMBOLS;r++){
        if(matrix[r][0]===matrix[r][1] && matrix[r][1]===matrix[r][2]) winLines.push(`Riga ${r+1}`);
    }

    // diagonali
    if(matrix[0][0]===matrix[1][1] && matrix[1][1]===matrix[2][2]) winLines.push("Diagonale principale");
    if(matrix[0][2]===matrix[1][1] && matrix[1][1]===matrix[2][0]) winLines.push("Diagonale inversa");

    // verticali
    for(let c=0;c<3;c++){
        if(matrix[0][c]===matrix[1][c] && matrix[1][c]===matrix[2][c]) winLines.push(`Verticale ${c+1}`);
    }

    return winLines;
}

// Controllo bonus Free Spins
function checkBonus(){
    let bonusCount = 0;
    reels.forEach(r=>{
        const middle = getVisibleSymbols(r)[1]; // simbolo centrale
        if(middle === BONUS_SYMBOL) bonusCount++;
    });
    if(bonusCount >= 3){
        triggerBonus();
    }
}

// Funzione Free Spins
function triggerBonus(){
    alert("BONUS ATTIVATO! 5 Free Spins!");
    let freeSpins=5;

    function freeSpinLoop(){
        if(freeSpins <=0){ alert("Fine bonus!"); return; }
        freeSpins--;
        reels.forEach((r,idx)=>{
            const randomFinal = symbols[Math.floor(Math.random()*symbols.length)];
            createReelSymbols3x3(r, randomFinal);
            spinReel(r, randomFinal, idx*200);
        });
        setTimeout(freeSpinLoop, 2500);
    }

    freeSpinLoop();
}

// Click su Gira
spinButton.addEventListener("click", ()=>{
    resultEl.textContent="";
    reels.forEach((r,idx)=> createReelSymbols3x3(r, finalSymbols[idx]));
    reels.forEach((r,idx)=> spinReel(r, finalSymbols[idx], idx*200));

    // controllo vincite e bonus dopo fine animazione
    setTimeout(()=>{
        const winLines = checkWinningLines();
        resultEl.textContent = winLines.length>0 ? "Hai vinto sulle linee: "+winLines.join(", ") : "Ritenta!";
        checkBonus();
    }, 2500);
});
