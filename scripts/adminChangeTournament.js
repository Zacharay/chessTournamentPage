const navigationTabs = document.querySelectorAll('.secondary__nav__tab');
const tournamentTabs = document.querySelectorAll('.secondary__nav__container');


function setContainerActive(idx)
{
    tournamentTabs.forEach(tab=>{
        tab.classList.add('hidden');
    })
    document.querySelector('.secondary__nav__tab--active').classList.remove('secondary__nav__tab--active');

    tournamentTabs[idx].classList.remove('hidden');
    navigationTabs[idx].classList.add('secondary__nav__tab--active');
}

navigationTabs.forEach((tab,i)=>{
    tab.addEventListener('click',function(){
        setContainerActive(i);
    })
})