const loginButton = document.querySelector('#login'),
    registerButton = document.querySelector('#register'),
    formContainer = document.querySelector('#form-container');


// const register = async function(data) {
//     const request = await fetch('register.php',{

// })    
    // const registerForm = document.querySelector('#register-form');

    
// }

// const login = async function() {
//     const request = await fetch('login.php');

//     const loginForm = document.querySelector('#login-form');

//     let formData = new FormData(loginForm);

//     loginForm.addEventListener('submit', (event) => {
//         event.preventDefault();
//     });
// }

const register = async function() {
    const request = await fetch('register.php');
    
    const response = await request.text();
    
    formContainer.innerHTML = response;
    
    const registerForm = document.querySelector('#register-form');

    console.log(registerForm);

    registerForm.addEventListener("submit", async ev => {
        ev.preventDefault();

        let formData = new FormData(registerForm);

        registerForm.addEventListener('submit', (event) => {
            event.preventDefault();
        });

        let request = await fetch('register.php', {
            method: 'post',
            body: formData
        });

        let response = await request.text();

        if (response.length > 0) {
            const messageContainer = document.querySelector('#register-msg');

            messageContainer.innerHTML = response;
        }
    });
}

const login = async function() {
    const request = await fetch('login.php');
    
    const response = await request.text();
    
    formContainer.innerHTML = response;
    
    const loginForm = document.querySelector('#login-form');

    console.log(loginForm);

    loginForm.addEventListener("submit", async function(ev) {
        ev.preventDefault();

        let formData = new FormData(loginForm);

        let request = await fetch('login.php', {
            method: 'post',
            body: formData
        });

        let response = await request.text();

        if (response.length > 0) {
            const messageContainer = document.querySelector('#login-msg');

            messageContainer.innerHTML = response;
        }
    });
}

registerButton.addEventListener('click', register);
loginButton.addEventListener('click', login);