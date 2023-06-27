// Affichage des mots de passe

const togglePassword = () => {
    //affichage password
    const passwordInput = document.querySelector('#user_password')
    passwordInput.type = passwordInput.type === 'text' ? "password" : "text"

    //changement icon
    const eyeIcon = document.querySelector('#eye')
    eyeIcon.classList.contains('d-none') ? eyeIcon.classList.remove('d-none') : eyeIcon.classList.add('d-none')
    const eyeIconSlash = document.querySelector('#eye-slash')
    eyeIconSlash.classList.contains('d-none') ? eyeIconSlash.classList.remove('d-none') : eyeIconSlash.classList.add('d-none')
}

const toggleConfirmPassword = () => {
    //affichage password
    const confirmPasswordInput = document.querySelector('#user_confirm')
    confirmPasswordInput.type = confirmPasswordInput.type === 'text' ? "password" : "text"

    //changement icon
    const eyeIcon = document.querySelector('#confirm_eye')
    eyeIcon.classList.contains('d-none') ? eyeIcon.classList.remove('d-none') : eyeIcon.classList.add('d-none')
    const eyeIconSlash = document.querySelector('#confirm_eye-slash')
    eyeIconSlash.classList.contains('d-none') ? eyeIconSlash.classList.remove('d-none') : eyeIconSlash.classList.add('d-none')
}

// Double range sliders

// Prix
$( function() {
    $( "#price-slider-range" ).slider({
        range: true,
        min: 0,
        max: 35000,
        values: [ 0, 35000 ],
        slide: function( event, ui ) {
            $( "#price-amount" ).val( ui.values[ 0 ] + "€ - " + ui.values[ 1 ] + "€");
        }
        });
        $( "#price-amount" ).val($( "#price-slider-range" ).slider( "values", 0 ) +
        "€ - " + $( "#price-slider-range" ).slider( "values", 1 ) + "€");
    } );

$(function () {
    $("#price-slider-range").slider();
    $("#price-slider-range").on('slidechange', function () {
        filterCars();
    })
});

// Kilométrage
$( function() {
    $( "#km-slider-range" ).slider({
        range: true,
        min: 0,
        max: 350000,
        values: [ 0, 350000 ],
        slide: function( event, ui ) {
            $( "#km-amount" ).val( ui.values[ 0 ] + "km - " + ui.values[ 1 ] + "km");
        }
        });
        $( "#km-amount" ).val($( "#km-slider-range" ).slider( "values", 0 ) +
        "km - " + $( "#km-slider-range" ).slider( "values", 1 ) + "km");
    } );

$(function () {
    $("#km-slider-range").slider();
    $("#km-slider-range").on('slidechange', function () {
        filterCars();
    })
});

// Année
$( function() {
    $( "#year-slider-range" ).slider({
        range: true,
        min: 1990,
        max: 2023,
        values: [ 1990, 2023 ],
        slide: function( event, ui ) {
            $( "#year-amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        }
        });
        $( "#year-amount" ).val($( "#year-slider-range" ).slider( "values", 0 ) +
        " - " + $( "#year-slider-range" ).slider( "values", 1 ));
    } );

$(function () {
    $("#year-slider-range").slider();
    $("#year-slider-range").on('slidechange', function () {
        filterCars();
    })
});

// Filtre des voitures

function filterCars() {
    fetch('/cars', { method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                'minPrice': $( "#price-slider-range" ).slider( "values", 0 ),
                'maxPrice': $( "#price-slider-range" ).slider( "values", 1 ),
                'minKm': $( "#km-slider-range" ).slider( "values", 0 ),
                'maxKm': $( "#km-slider-range" ).slider( "values", 1 ),
                'minYear': $( "#year-slider-range" ).slider( "values", 0 ),
                'maxYear': $( "#year-slider-range" ).slider( "values", 1 )
            })
        })
        .then((response) => {
                    if(response.ok){
                        return response.json();
                    } else {
                        console.error("Erreur réponse : " + response.status);
                    }
                })
                .then((data) => {
                    console.log(data);
                })
                .catch((error) => console.error(error));
}