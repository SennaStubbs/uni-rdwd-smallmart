// Submitting a log in form
var errorText = document.getElementById('error-message');
async function LogIn(event) {
    let form = event.currentTarget.form;
    let formData = new FormData(form);

    let formValidity = form.reportValidity();
    if (formValidity) {
        await fetch(window.location.origin + "/smallmart/website/operations/user/log-in", {
            method: 'POST',
            body: formData,
        })
        .then((response) => response.text())
        .then((data) => {
            let errors = data.match(/error:/g) ? data.replace(/error:/g, '\n').trim().replace('\n', '<br>') : "";
            if (errors != "") {
                errorText.innerHTML = errors;
                errorText.classList.remove('hidden');
            }
            else if(data == "success") {
                errorText.classList.add('hidden');
                window.location.href = window.location.origin + "/smallmart/website/user";
            }
        });
    } else {
        // Focus on the entered input, if submitted with the 'ENTER' key
        if (event.target.tagName.toLowerCase() == "input") {
            event.target.focus();
        }
    }
}

// Submitting a sign up form
async function SignUp(event) {
    let form = event.currentTarget.form;
    let formData = new FormData(form);

    let formValidity = form.reportValidity();
    if (formValidity || true) {
        // Check if 'password' and 'confirm-password' and the same
        let password = document.getElementById('password').value;
        let confirmPassword = document.getElementById('confirm-password').value;

        if (password == confirmPassword || true) {
            // Client-side password validation
            let length = password.length;
            let lowercase = 0;
            let uppercase = 0;
            let numbers = 0;
            let symbols = 0;
            for (let char of password) {
                if (char.match(/[a-z]/))
                    lowercase++;
                else if (char.match(/[A-Z]/))
                    uppercase++;
                else if (char.match(/[\d]/))
                    numbers++;
                else if (char.match(/[^a-zA-Z\d]/))
                    symbols++;
            }
            if (length >= 8 && lowercase >= 1 && uppercase >= 1 && numbers >= 3 && symbols >=1 && length <= 30 || true) {
                console.log(window.location.origin + "/smallmart/website/operations/user/sign-up");
                await fetch(window.location.origin + "/smallmart/website/operations/user/sign-up", {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.text())
                .then((data) => {
                    console.log(data);
                    let errors = data.match(/error:/g) ? data.replace(/error:/g, '\n').trim().replace('\n', '<br>') : "";
                    if (errors != "") {
                        errorText.innerHTML = errors;
                        errorText.classList.remove('hidden');
                    }
                    else if(data == "success") {
                        errorText.classList.add('hidden');
                        window.location.href = window.location.origin + "/smallmart/website/user";
                    }
                });
            }
            else {
                let html = "Password must at least ";

                let errors = [];
                if (length < 8)
                    errors.push("be 8 characters long");
                if (lowercase < 1)
                    errors.push("have one lowercase letter");
                if (uppercase < 1)
                    errors.push("have one uppercase letter");
                if (numbers < 3)
                    errors.push("have three numbers");
                if (symbols < 1)
                    errors.push("have one symbol");
                if (length > 30) {
                    if (errors.length == 0)
                        html = "Password must ";
                    errors.push("be less than 30 characters long");
                }
                    

                console.log(errors, length, lowercase, uppercase, numbers, symbols);
                
                for (let i = 0; i < errors.length; i++) {
                    if (i > 0) {
                        if (i + 1 == errors.length)
                            html += ", and ";
                        else
                            html += ", ";
                    }
                    html += errors[i];
                }
                html += ".";
                errorText.innerHTML = html;
                errorText.classList.remove('hidden');

            }
        }
        else {
            errorText.innerHTML = "Inputted password and confirmed password do not match.";
            errorText.classList.remove('hidden');
        }
    } else {
        // Focus on the entered input, if submitted with the 'ENTER' key
        if (event.target.tagName.toLowerCase() == "input") {
            event.target.focus();
        }
    }
}

// Checking for 'ENTER' key inputs
var inputs = document.getElementsByTagName('main')[0].getElementsByTagName('input');
for (let input of inputs) {
    input.addEventListener('keypress', function(event) {
        if (event.key == "Enter") {
            event.preventDefault();
            LogIn(event);
        }
    });
}