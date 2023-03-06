const loginButton = document.querySelector('#login'),
    registerButton = document.querySelector('#register'),
    formContainer = document.querySelector('#form-container');

const login = function() {
    fetch('login.php')
        .then(response => response.text())
        .then(text => {
            console.log(text);
            formContainer.innerHTML = text;
        });
}

loginButton.addEventListener('click', login);

const register = function() {
    fetch('register.php')
        .then(response => response.text())
        .then(text => {
            console.log(text);
            formContainer.innerHTML = text;
        });
}

registerButton.addEventListener('click', register);