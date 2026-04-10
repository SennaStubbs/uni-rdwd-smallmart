function ToggleInputVisibility(button) {
    let input = button.parentElement.getElementsByTagName('input')[0];
    input.type = input.type == "password" ? "text" : "password";
    button.innerHTML = input.type == "password" ? "visibility" : "visibility_off";
}

var errorText = document.getElementById('error-message');
async function LogIn(event) {
    let form = event.currentTarget.form;
    let formData = new FormData(form);

    let formValidity = form.reportValidity();
    // let formValidity = true;

    if (formValidity) {
        await fetch(window.location.origin + "/smallmart/website/operations/user/log-in", {
            method: 'POST',
            body: formData,
        })
        .then((response) => response.text())
        .then((data) => {
            let errors = data.match(/error:/g) ? data.replace(/error:/g, '\n').trim().replace('\n', '<br>') : "";
            console.log(data);
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
}