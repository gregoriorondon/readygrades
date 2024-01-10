const che1 = document.querySelector('.logoa');

const che = document.querySelector('.busignup');

const cre = document.querySelector('.oculto');

const che2 = document.querySelector('.swit');

che.addEventListener('click', ()=>{
    cre.classList.replace('oculto', 'visible');
    che1.classList.replace('logoa', 'oculto');
});

che2.addEventListener('click', ()=>{
    cre.classList.replace('visible', 'oculto');
    che1.classList.replace('oculto', 'logoa');
});
