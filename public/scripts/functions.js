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