var tabs = document.getElementById('tabs');
var currentTab = new URLSearchParams(window.location.search).get("tab") || "account";

for (let tabButton of tabs.getElementsByTagName('button')) {
    // Get current tab to become visible
    let tab = tabButton.dataset.tab;

    // Unselect all tabs
    if (tabButton.dataset.tab != currentTab) {
        tabButton.classList.remove('selected');
        document.getElementById('tab-' + tab).classList.add('hidden');
    }
    // Select current tab
    else {
        tabButton.classList.add('selected');
        document.getElementById('tab-' + tab).classList.remove('hidden');
    }

    // Cancel all changing details
    for (let cancelButton of document.getElementById('tab-' + tab).getElementsByClassName('cancel')) {
        cancelButton.click();
    }

    UpdateLabelWidths();

    // Add event listeners to all tab buttons
    tabButton.addEventListener('click', function() {
        window.location.replace('/smallmart/website/user?tab=' + tab);
    });
}

// Changing user details
var changingDetail = false;
var currentForm;

function StartChange(changeButton) {
    // Getting form elements
    currentForm = changeButton.parentElement;
    let submitButton = currentForm.getElementsByClassName('submit')[0];
    let cancelButton = currentForm.getElementsByClassName('cancel')[0];
    let input = currentForm.getElementsByTagName('input')[0];
    let errorText = currentForm.getElementsByClassName('error-message')[0];

    // Password only elements
    if (currentForm.id == "password") {
        var currentVisibility = currentForm.getElementsByClassName('visibility')[0];

        var newPasswordForm = document.getElementById('new_password');
        var newInput = newPasswordForm.getElementsByTagName('input')[0];
        var newVisibility = newPasswordForm.getElementsByClassName('visibility')[0];

        var confirmPasswordForm = document.getElementById('confirm_password');
        var confirmInput = confirmPasswordForm.getElementsByTagName('input')[0];
        var confirmVisibility = confirmPasswordForm.getElementsByClassName('visibility')[0];
        submitButton = confirmPasswordForm.getElementsByClassName('submit')[0];
        cancelButton = confirmPasswordForm.getElementsByClassName('cancel')[0];
        errorText = confirmPasswordForm.getElementsByClassName('error-message')[0];

        currentForm.getElementsByTagName('label')[0].innerHTML = "Current password:";
        newPasswordForm.classList.remove('hidden');
        confirmPasswordForm.classList.remove('hidden');

        currentVisibility.classList.remove('hidden');
        if (input.type != "password")
            ToggleInputVisibility(currentVisibility);
        newVisibility.classList.remove('hidden');
        if (newInput.type != "password")
            ToggleInputVisibility(newVisibility);
        confirmVisibility.classList.remove('hidden');
        if (confirmInput.type != "password")
            ToggleInputVisibility(confirmVisibility);

        input.value = "";

        UpdateLabelWidths();
    }

    if (changingDetail == true && currentForm) {
        cancelButton.click();
    }

    changingDetail = true;

    let originalInputValue = input.value;

    changeButton.classList.add('hidden');
    submitButton.classList.remove('hidden');
    cancelButton.classList.remove('hidden');
    input.disabled = false;

    function ThrowError(text) {
        errorText.classList.remove('hidden');
        errorText.innerHTML = "Error: " + text;
    }

    async function SubmitChange(event) {
        if (event)
            if (event.type == "keypress")
                if (event.key == "Enter")
                    event.preventDefault();
                else
                    return;
        
        if (input.value != originalInputValue || currentForm.id == "password") {
            if (true || currentForm.reportValidity()) {
                let formData = new FormData();

                // Client-side validation
                if (input.id == "user_email") {
                    if (input.value.trim() == "") {
                        ThrowError("Email must not be empty.");
                        return;
                    }

                    let domain = false;
                    for (let char of input.value) {
                        if (domain == false ? char.match(/[a-zA-Z\d.!#$%&'*+-=?^_`\/{|}~@]/) == null : char.match(/[a-zA-Z\d.]/) == null) {
                            ThrowError("Email is invalid.");
                            return;
                        }
                        else if (domain == false && char == "@") {
                            domain = true;
                        }
                    }
                }
                else if (input.id == "user_display_name") {
                    if (input.value.trim() == "") {
                        ThrowError("Display name must not be empty.");
                        return;
                    }

                    if (input.value.length > 30) {
                        ThrowError("Display name must be less than 30 characters long.");
                        return;
                    }

                    if (input.value.match(/[^a-zA-Z\d ]/)) {
                        ThrowError("Display name can only include letters, numbers and spaces.");
                        return;
                    }
                }
                else if (input.id == "user_password") {
                    if (input.value.trim() == "" || newInput.value.trim() == "" || confirmInput.value.trim() == "") {
                        ThrowError("All inputs must not be empty.")
                        return;
                    }

                    formData.append(newInput.id, newInput.value);
                    formData.append(confirmInput.id, confirmInput.value);
                }

                input.disabled = true;
                submitButton.disabled = true;
                cancelButton.disabled = true;
                if (currentForm.id == "password") {
                    newInput.disabled = true;
                    confirmInput.disabled = true;
                }

                formData.append('target-detail', input.id);
                formData.append(input.id, input.value);

                await fetch(window.location.origin + "/smallmart/website/operations/user/update-detail", {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.text())
                .then((data) => {
                    let errors = data.match(/error:/g) ? data.replace(/error:/g, '\nError: ').trim().replace('\n', '<br>') : "";
                    console.log(data);
                    if (errors != "") {
                        errorText.innerHTML = errors;
                        errorText.classList.remove('hidden');

                        input.disabled = false;
                        submitButton.disabled = false;
                        cancelButton.disabled = false;
                        if (currentForm.id == "password") {
                            newInput.disabled = false;
                            confirmInput.disabled = false;
                        }
                    }
                    else if (data == 'success') {
                        errorText.classList.add('hidden');
                        window.location.reload();
                    }
                    else if (data == 'duplicate') {
                        input.disabled = false;
                        submitButton.disabled = false;
                        cancelButton.disabled = false;
                        if (currentForm.id == "password") {
                            newInput.disabled = false;
                            confirmInput.disabled = false;
                        }
                    }
                });
            }
        }
    }

    function CancelChange() {
        changeButton.classList.remove('hidden');
        submitButton.classList.add('hidden');
        cancelButton.classList.add('hidden');
        errorText.classList.add('hidden');
        errorText.innerHTML = "";
        input.disabled = true;
        input.value = originalInputValue;

        if (input.id == "user_password") {
            input.value = "#".repeat(100);
            currentForm.getElementsByTagName('label')[0].innerHTML = "Password:";
            currentVisibility.classList.add('hidden');
            if (input.type != "password")
                ToggleInputVisibility(currentVisibility);
        
            newInput.value = "";
            newPasswordForm.classList.add('hidden');
            if (newInput.type != "password")
                ToggleInputVisibility(newVisibility);

            confirmInput.value = "";
            confirmPasswordForm.classList.add('hidden');
            if (confirmInput.type != "password")
                ToggleInputVisibility(confirmVisibility);

        }

        UpdateLabelWidths();

        changingDetail = false;

        cancelButton.removeEventListener('click', CancelChange)
    }

    submitButton.addEventListener('click', SubmitChange);
    input.addEventListener('keypress', SubmitChange)

    cancelButton.addEventListener('click', CancelChange);
}

//// Resizing labels of tabs
function UpdateLabelWidths() {
    // Get highest width
    let highestLabelWidth = 0;
    for (let label of document.getElementById('tab-' + currentTab).getElementsByTagName('label')) {
        if (!label.parentElement.classList.contains('hidden'))
            label.style.width = "";
            if (label.clientWidth > highestLabelWidth)
                highestLabelWidth = label.getBoundingClientRect().width;
    }

    for (let label of document.getElementById('tab-' + currentTab).getElementsByTagName('label')) {
        if (!label.parentElement.classList.contains('hidden'))
            label.style.width = highestLabelWidth + "px";
    }
}
UpdateLabelWidths();
