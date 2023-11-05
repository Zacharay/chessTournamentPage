const skillsObserver = new IntersectionObserver(entries=>{
    entries.forEach(entry =>{
        if(entry.isIntersecting)
        {
            const leftElement = entry.target.querySelector('.skills__left__fade');
            const rightElement = entry.target.querySelector('.skills__right__fade');
            leftElement.classList.remove("skills__left__fade");
            rightElement.classList.remove("skills__right__fade");

            skillsObserver.unobserve(entry.target);
        }
        
        
    })
},{
    threshold:0.2
})

const skillsElements = document.querySelectorAll('.skills__element');

skillsElements.forEach(element=>{
    skillsObserver.observe(element);
});

const previousObserver = new IntersectionObserver(entries=>{
    entries.forEach(entry =>{
        if(entry.isIntersecting)
        {
            const elements = entry.target.querySelectorAll('.previous__element');
            let delay=0;
            elements.forEach(element=>{
                setTimeout(() => {
                    element.classList.remove('previous__element__hide');
                }, delay);
                delay+=200;
            })
            previousObserver.unobserve(entry.target);
        }
        
        
    })
},{
    threshold:0.2
})

const previousContainer = document.querySelector(".previous__container");
previousObserver.observe(previousContainer);