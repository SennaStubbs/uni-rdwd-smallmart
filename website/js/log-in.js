function ToggleInputVisibility(button) {
    let input = button.parentElement.getElementsByTagName('input')[0];
    input.type = input.type == "password" ? "text" : "password";
    button.innerHTML = input.type == "password" ? "visibility" : "visibility_off";
}