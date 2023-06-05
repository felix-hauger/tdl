const loginButton = document.querySelector('#login'),
    registerButton = document.querySelector('#register'),
    formContainer = document.querySelector('#form-container');

const register = async function() {
    // Register page request
    const request = await fetch('register.php');
    
    // Awaiting response to get html
    const response = await request.text();
    
    // Insert form in HTML container
    formContainer.innerHTML = response;
    
    const registerForm = document.querySelector('#register-form');

    // Autofocus
    document.querySelector('#register-form input:first-child').focus();


    registerForm.addEventListener("submit", async ev => {
        // Prevent form submission
        ev.preventDefault();

        let formData = new FormData(registerForm);

        // Send request with form data
        let request = await fetch('register.php', {
            method: 'post',
            body: formData
        });

        // Get reponse to test
        let response = await request.text();

        // Display response message in form
        if (response.length > 0) {
            const messageContainer = document.querySelector('#register-msg');

            messageContainer.innerHTML = response;            
        }

        // If registered successfully & status is 201 (resource created), redirect
        if (request.status === 201) {
            setTimeout(() => {
                login();
            }, 2000);
        }
    });
}

const login = async function() {
    // Login page request
    const request = await fetch('login.php');
    
    // Awaiting response to get html
    const response = await request.text();
    
    // Insert form in HTML container
    formContainer.innerHTML = response;
    
    const loginForm = document.querySelector('#login-form');

    // Autofocus
    document.querySelector('#login-form input:first-child').focus();

    loginForm.addEventListener("submit", async function(ev) {
        // Prevent form submission
        ev.preventDefault();

        let formData = new FormData(loginForm);

        // Send request with form data
        let request = await fetch('login.php', {
            method: 'post',
            body: formData
        });

        // Get reponse to test
        let response = await request.text();

        // Display response message in form
        if (response.length > 0) {
            const messageContainer = document.querySelector('#login-msg');

            messageContainer.innerHTML = response;
        }

        // If logged successfully & status is 302, redirect
        if (request.status === 302) {
            setTimeout(() => {
                window.location = 'todolist.php';
            }, 1500);
        }
    });
}

registerButton.addEventListener('click', register);
loginButton.addEventListener('click', login);