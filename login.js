document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', (event) => {
        const username = document.getElementById('username');
        const password = document.getElementById('password');

     // Array to store error messages
     let errors = [];

     // Validate email format
     if (username.value && !validateUsername(username.value)) {
         errors.push('Invalid username input');
     }

     // Validate password format
     if (password.value && !validatePassword(password.value)) {
        errors.push('Invalid password input');
    }

     // If there are errors, prevent form submission and show alert
     if (errors.length > 0) {
        event.preventDefault(); // Prevent form submission
        alert("Please address the following issues:\n- ${errors.join('\n- ')}");
    }

});

function showAlert() {
    var message = "Vul zowel gebruikersnaam als wachtwoord in.";
    alert(message);
}
