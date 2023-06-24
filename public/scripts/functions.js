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
        max: 15000,
        values: [ 0, 15000 ],
        slide: function( event, ui ) {
            $( "#price-amount" ).val( ui.values[ 0 ] + "€ - " + ui.values[ 1 ] + "€");
        }
        });
        $( "#price-amount" ).val($( "#price-slider-range" ).slider( "values", 0 ) +
        "€ - " + $( "#price-slider-range" ).slider( "values", 1 ) + "€");
    } );

// Kilométrage
$( function() {
    $( "#km-slider-range" ).slider({
        range: true,
        min: 0,
        max: 15000,
        values: [ 0, 15000 ],
        slide: function( event, ui ) {
            $( "#km-amount" ).val( ui.values[ 0 ] + "km - " + ui.values[ 1 ] + "km");
        }
        });
        $( "#km-amount" ).val($( "#km-slider-range" ).slider( "values", 0 ) +
        "km - " + $( "#km-slider-range" ).slider( "values", 1 ) + "km");
    } );

// Année
$( function() {
    $( "#year-slider-range" ).slider({
        range: true,
        min: 1990,
        max: 2023,
        values: [ 0, 15000 ],
        slide: function( event, ui ) {
            $( "#year-amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        }
        });
        $( "#year-amount" ).val($( "#year-slider-range" ).slider( "values", 0 ) +
        " - " + $( "#year-slider-range" ).slider( "values", 1 ));
    } );