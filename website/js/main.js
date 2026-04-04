// Dropdown
function ToggleDropdown(dropdownBtn, relative, visible) {
    let dropdownMenu = document.getElementById(dropdownBtn.dataset.dropdownId);

    // Hide other dropdown menus
    if (typeof(visible) != 'boolean') {
        for (let _dropdownBtn of document.getElementsByClassName('dropdown')) {
            if (_dropdownBtn.dataset.dropdownId != dropdownBtn.dataset.dropdownId) {
                ToggleDropdown(_dropdownBtn, false, false);
            }
        }
        visible = dropdownMenu.classList.contains('hidden');
    }

    // Toggle menu
    if (visible)
        dropdownMenu.classList.remove('hidden');
    else
        dropdownMenu.classList.add('hidden');

    // Change arrow rotation, if it exists
    let arrowElement = dropdownBtn.getElementsByClassName('material-symbols-outlined');
    if (arrowElement.length > 0)
        if (visible)
            arrowElement[0].innerHTML = 'keyboard_arrow_up';
        else
            arrowElement[0].innerHTML = 'keyboard_arrow_down';

    // Set menu position relative to button, if applicable
    if (relative == true) {
        let buttonRect = dropdownBtn.getBoundingClientRect();
        let menuRect = dropdownMenu.getBoundingClientRect();
        dropdownMenu.style.left = ((buttonRect.left + (buttonRect.width / 2)) - (menuRect.width / 2)) + 'px';
    }
}

// Scroll back to top
function BackToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// Hide 'back to top' if screen too small
if (document.body.clientHeight < 1500) {
    document.getElementById('back-to-top').classList.add('hidden');
}

// Button that behaviours like an anchor tag, with the option to open in a new tab
function ClickLink(event, url, openInNewTab = false) {

    // Make sure the user is not trying to press a different link
    if (event.target.tagName != "A" && [0, 1].includes(event.button)) {
        event.preventDefault();
        
        if (openInNewTab == true)
            window.open(url, '_blank').focus();
        else
            window.location.href = url
    }
}

// Prevent invalid message appearing on inputs with 'hide-validation-message' class
document.addEventListener('invalid', (function () {
  return function (e) {
    if (e.target.classList.contains('hide-validation-message')) {
        e.preventDefault();
        e.target.focus();
    }
  };
})(), true);