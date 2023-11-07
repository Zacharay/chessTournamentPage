const openMobileBtn = document.querySelector(".open__mobile__nav");
const closeMobileBtn = document.querySelector('.close__mobile__btn');
const navList = document.querySelector('.nav__list');

openMobileBtn.addEventListener('click',()=>{
    navList.style = 'display:flex';
})

closeMobileBtn.addEventListener('click',()=>{
    navList.style = 'display:none';
})