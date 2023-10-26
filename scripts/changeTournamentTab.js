const navigationTabs = document.querySelectorAll('.tournament__navigation__tab');
const tournamentTabs = document.querySelectorAll('.tournament__tab');


function setTournamentActive(idx)
{
    tournamentTabs.forEach(tab=>{
        tab.classList.add('tournament__content--hidden');
    })

    tournamentTabs[idx].classList.remove('tournament__content--hidden');
}

navigationTabs.forEach((tab,i)=>{
    tab.addEventListener('click',function(){
        setTournamentActive(i);
    })
})