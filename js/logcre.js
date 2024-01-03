const che1 = document.querySelector('.logop');

const che = document.querySelector('.busignup');

const cre = document.querySelector('.crecu');

const che2 = document.querySelector('.swit');

che.addEventListener('click', ()=>{
    cre.classList.replace('crecu', 'creacu');
    che1.classList.replace('logop', 'crecu');
});

che2.addEventListener('click', ()=>{
    cre.classList.replace('creacu', 'crecu');
    che1.classList.replace('crecu', 'logop');
})
