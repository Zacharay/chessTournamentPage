const navigationTabs = document.querySelectorAll('.tournament__navigation__tab');
const tournamentTabs = document.querySelectorAll('.tournament__tab');


function setTournamentActive(idx)
{
    tournamentTabs.forEach(tab=>{
        tab.classList.add('hidden');
    })
    document.querySelector('.tournament__tab--active').classList.remove('tournament__tab--active');

    tournamentTabs[idx].classList.remove('hidden');
    navigationTabs[idx].classList.add('tournament__tab--active');
}

navigationTabs.forEach((tab,i)=>{
    tab.addEventListener('click',function(){
        setTournamentActive(i);
    })
})