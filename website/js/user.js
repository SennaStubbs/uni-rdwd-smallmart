var tabs = document.getElementById('tabs');
var currentTab = "account";
for (let tabButton of tabs.getElementsByTagName('button')) {
    let tab = tabButton.dataset.tab;
    tabButton.addEventListener('click', function() {
        // Unselect all tabs
        for (let _tabButton of tabs.getElementsByTagName('button')) {
            if (_tabButton.dataset.tab == currentTab) {
                _tabButton.classList.remove('selected');
            }
        }

        // Cancel all changing details
        for (let cancelButton of document.getElementById('tab-' + currentTab).getElementsByClassName('cancel')) {
            cancelButton.click();
        }

        document.getElementById('tab-' + currentTab).classList.add('hidden');

        // Select tab
        currentTab = tab;
        tabButton.classList.add('selected');

        document.getElementById('tab-' + currentTab).classList.remove('hidden');

        UpdateLabelWidths();
    });
}

// Changing user details
var changingDetail = false;
var currentForm;
function StartPasswordChange(changeButton) {
    if (changingDetail == true && currentForm) {
        currentForm.getElementsByClassName('cancel')[0].click();
    }

    changingDetail = true;

    // Getting form elements
    currentForm = changeButton.parentElement;
    let submitButton = currentForm.getElementsByClassName('submit')[0];
    let cancelButton = currentForm.getElementsByClassName('cancel')[0];
    let input = currentForm.getElementsByTagName('input')[0];

    let originalInputValue = input.value;

    changeButton.classList.add('hidden');
    submitButton.classList.remove('hidden');
    cancelButton.classList.remove('hidden');
    input.disabled = false;

    async function SubmitChange(event) {
        if (event)
            if (event.type == "keypress")
                if (event.key == "Enter")
                    event.preventDefault();
                else
                    return;
        
        if (input.value != originalInputValue) {
            if (currentForm.reportValidity()) {
                input.disabled = true;
                submitButton.disabled = true;
                cancelButton.disabled = true;

                let formData = new FormData();
                formData.append('target-detail', input.id);
                formData.append(input.id, input.value);
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }

                await fetch(window.location.origin + "/smallmart/website/operations/user/update-detail", {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.text())
                .then((data) => {
                    let errors = data.match(/error:/g) ? data.replace(/error:/g, '\n').trim().replace('\n', '<br>') : "";
                    console.log(data);
                    // if (errors != "") {
                    //     errorText.innerHTML = errors;
                    //     errorText.classList.remove('hidden');
                    // }
                    // else if(data == "success") {
                    //     errorText.classList.add('hidden');
                    //     window.location.href = window.location.origin + "/smallmart/website/user";
                    // }

                    if (data == 'success') {
                        window.location.reload();
                    }
                    else if (data == 'duplicate') {
                        input.disabled = false;
                        submitButton.disabled = false;
                        cancelButton.disabled = false;
                    }
                });
            }
        }
    }

    function CancelChange() {
        changeButton.classList.remove('hidden');
        submitButton.classList.add('hidden');
        cancelButton.classList.add('hidden');
        input.disabled = true;
        input.value = originalInputValue;

        changingDetail = false;

        cancelButton.removeEventListener('click', CancelChange)
    }

    submitButton.addEventListener('click', SubmitChange);
    input.addEventListener('keypress', SubmitChange)

    cancelButton.addEventListener('click', CancelChange);
}

// Password change
function StartChange(changeButton) {
    if (changingDetail == true && currentForm) {
        currentForm.getElementsByClassName('cancel')[0].click();
    }

    changingDetail = true;

    // Getting form elements
    currentForm = changeButton.parentElement;
    let submitButton = currentForm.getElementsByClassName('submit')[0];
    let cancelButton = currentForm.getElementsByClassName('cancel')[0];
    let input = currentForm.getElementsByTagName('input')[0];

    let originalInputValue = input.value;

    changeButton.classList.add('hidden');
    submitButton.classList.remove('hidden');
    cancelButton.classList.remove('hidden');
    input.disabled = false;

    async function SubmitChange(event) {
        if (event)
            if (event.type == "keypress")
                if (event.key == "Enter")
                    event.preventDefault();
                else
                    return;
        
        if (input.value != originalInputValue) {
            if (currentForm.reportValidity()) {
                input.disabled = true;
                submitButton.disabled = true;
                cancelButton.disabled = true;

                let formData = new FormData();
                formData.append('target-detail', input.id);
                formData.append(input.id, input.value);
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }

                await fetch(window.location.origin + "/smallmart/website/operations/user/update-detail", {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.text())
                .then((data) => {
                    let errors = data.match(/error:/g) ? data.replace(/error:/g, '\n').trim().replace('\n', '<br>') : "";
                    console.log(data);
                    // if (errors != "") {
                    //     errorText.innerHTML = errors;
                    //     errorText.classList.remove('hidden');
                    // }
                    // else if(data == "success") {
                    //     errorText.classList.add('hidden');
                    //     window.location.href = window.location.origin + "/smallmart/website/user";
                    // }

                    if (data == 'success') {
                        window.location.reload();
                    }
                    else if (data == 'duplicate') {
                        input.disabled = false;
                        submitButton.disabled = false;
                        cancelButton.disabled = false;
                    }
                });
            }
        }
    }

    function CancelChange() {
        changeButton.classList.remove('hidden');
        submitButton.classList.add('hidden');
        cancelButton.classList.add('hidden');
        input.disabled = true;
        input.value = originalInputValue;

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
        if (label.clientWidth > highestLabelWidth)
            highestLabelWidth = label.getBoundingClientRect().width;
    }

    for (let label of document.getElementById('tab-' + currentTab).getElementsByTagName('label')) {
        label.style.width = highestLabelWidth + "px";
    }
}
UpdateLabelWidths();
