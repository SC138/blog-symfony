const body= document.querySelector(".js-body")

//le localStorage vérifie si le mode sombre est activé avec true
if(localStorage.getItem('dark') === 'true') {
    body.classList.add('night-activated');
}
const nightBtn = document.querySelector(".js-night");

nightBtn.addEventListener('click', function (){
    if (body.classList.contains("night-activated")){
        body.classList.remove("night-activated")

    } else {
        body.classList.add("night-activated");
        //Si le mode sombre n'est pas activé, la function s'active
        localStorage.setItem('dark', 'true');

    }

});


