const navslide = function () {
    //accessing 3-line div as well as ul of navbar .
    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav-links");
    const navlinks = document.querySelectorAll(".nav-links li");

    //adding and removing of nav-active class in ul(.nav-links) .
    burger.addEventListener('click', function () {
        nav.classList.toggle("nav-active");
        //animation links
        navlinks.forEach((link, index) => {
            if (link.style.animation) {
                link.style.animation = '';
            }
            else {
                link.style.animation = `navlinkFade 0.5s ease forwards ${index / 7 + 0}s`;
            }
        });

        burger.classList.toggle('toggle');

    });


}

//calling navslide function
navslide();


