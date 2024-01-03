const che = document.querySelector('.busignup');
const cre = document.querySelector('.crecu');

const che2 = document.querySelector('.swit');

che.addEventListener('click', ()=>{
    cre.classList.replace('crecu', 'creacu'); 
});

che2.addEventListener('click', ()=>{
    cre.classList.replace('creacu', 'crecu');
})
