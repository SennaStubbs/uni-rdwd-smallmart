// Dropdown
function ToggleDropdown(dropdownBtn, dropdownMenu, relative) {
    let visible = dropdownMenu.classList.contains('hidden');

    // Toggle menu
    dropdownMenu.classList.toggle('hidden');

    // Change arrow rotation, if it exists
    let arrowElement = dropdownBtn.getElementsByClassName('material-symbols-outlined');
    console.log(visible);
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

// Prevent invalid message appearing on inputs with 'hide-validation-message' class
document.addEventListener('invalid', (function () {
  return function (e) {
    if (e.target.classList.contains('hide-validation-message')) {
        e.preventDefault();
        e.target.focus();
    }
  };
})(), true);