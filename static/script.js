function scrollToDiv(divId) {
            var targetDiv = document.getElementById(divId);
            targetDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

function goto(url) {
    window.location.href = url;
}


function showMenu() {
    var topnav = document.getElementById("myTopnav");
    var hamburger = document.getElementById("hamburger");

    if (topnav.className === "topnav") {
        topnav.className = "responsive_topnav";
        hamburger.className = "fa fa-times";
    } else {
        topnav.className = "topnav";
        hamburger.className = "fa fa-bars"
    }

}


function moveItem(direction) {
    var items = document.querySelectorAll('.home_container_item');
    var currentItem = document.querySelector('.home_container_item.visible');
    var currentIndex = Array.from(items).indexOf(currentItem);

    // Ukryj aktualnie widoczny element
    currentItem.classList.remove('visible');

    // Przesuń się w lewo
    if (direction === 'left') {
        currentIndex = (currentIndex - 1 + items.length) % items.length;
    }
    // Przesuń się w prawo
    else if (direction === 'right') {
        currentIndex = (currentIndex + 1) % items.length;
    }

    // Pokaż następny element
    items[currentIndex].classList.add('visible');
}

function submitForm(event) {
        var label = document.getElementById("error_label");
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("repas").value;
        var isFormValid = password === confirmPassword;




        if (isFormValid) {


        } else {
            document.getElementById("password").value = "";
            document.getElementById("repas").value = "";
            label.style.fontSize = "18px";
            event.preventDefault();
        }
        return isFormValid;
      }

window.addEventListener('resize', function() {
var szerokoscEkranu = window.innerWidth;
var obiekt = document.getElementById('myTopnav');
var hamburger = document.getElementById('hamburger');

if (szerokoscEkranu > 1227) {
    obiekt.className = 'topnav';
    hamburger.className = "fa fa-bars"
}
});

