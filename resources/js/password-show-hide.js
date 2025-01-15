let inputPass = document.getElementById('password');
let btnPass = document.querySelector('.passbtn');
let btnPassHidden = document.querySelector('.passbtnhidde');

btnPass.addEventListener('click', () => {
    inputPass.type="text";
    btnPass.classList.add('hidden');
    btnPassHidden.classList.remove('hidden');
});
btnPassHidden.addEventListener('click', () => {
    inputPass.type="password";
    btnPass.classList.remove('hidden');
    btnPassHidden.classList.add('hidden');
});
