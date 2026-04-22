let urlSearchParams = new URLSearchParams(window.location.search);

// Dropdown
let currentDropdown = "";
function ToggleDropdown(dropdownBtn, relative, visible) {
    let dropdownMenu = document.getElementById(dropdownBtn.dataset.dropdownId);
    if (typeof(visible) != 'boolean')
        currentDropdown = dropdownBtn.dataset.dropdownId;

    // Set menu position relative to button, if applicable
    function RelativeResize() {
        let buttonRect = dropdownBtn.getBoundingClientRect();
        let menuRect = dropdownMenu.getBoundingClientRect();
        dropdownMenu.style.left = ((buttonRect.left + (buttonRect.width / 2)) - (menuRect.width / 2)) + 'px';

        if (currentDropdown != dropdownBtn.dataset.dropdownId)
            window.removeEventListener('resize', RelativeResize, true);

    }

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
    if (visible) {
        dropdownMenu.classList.remove('hidden');
        currentDropdown = dropdownBtn.dataset.dropdownId;
    }
    else {
        dropdownMenu.classList.add('hidden');
        if (currentDropdown == dropdownBtn.dataset.dropdownId)
            currentDropdown = "";
    }

    // Change arrow rotation, if it exists
    let arrowElement = dropdownBtn.getElementsByClassName('material-symbols-outlined');
    if (['keyboard_arrow_up', 'keyboard_arrow_down'].includes(arrowElement[0].innerHTML) && arrowElement.length > 0)
        if (visible)
            arrowElement[0].innerHTML = 'keyboard_arrow_up';
        else
            arrowElement[0].innerHTML = 'keyboard_arrow_down';

    if (relative == true && visible) {
        RelativeResize();

        window.addEventListener('resize', RelativeResize, true);
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
    if (event.target.tagName != "A" && event.button != 2 && !event.target.classList.contains('favourite')) {
        event.preventDefault();
        
        if (openInNewTab == true || event.button == 1)
            window.open(url, '_blank').focus();
        else
            window.location.href = url
    }
}

// Prevent middle click scroll on clickable objects
document.addEventListener('mousedown', function (event) {
    if (event.button == 1) {
        let parent = event.target;
        for (let i = 0; i < 10; i++) {
            if (parent.onauxclick) {
                if (parent.onauxclick.toString().match(/ClickLink(.*?)/g) != null) {
                    event.preventDefault();
                    return false;
                }
            }
            
            if (parent.tagName.toLowerCase() == "button") {
                event.preventDefault();
                return false;
            } else {
                if (parent.parentElement)
                    parent = parent.parentElement;
                else
                    return true;
            }
        }
    }
});

// Prevent invalid message appearing on inputs with 'hide-validation-message' class
document.addEventListener('invalid', (function () {
  return function (e) {
    if (e.target.classList.contains('hide-validation-message')) {
        e.preventDefault();
        e.target.focus();
    }
  };
})(), true);

// Password visibility toggle
function ToggleInputVisibility(button, event) {
    if (event)
        event.preventDefault();
    let input = button.parentElement.getElementsByTagName('input')[0];
    input.type = input.type == "password" ? "text" : "password";
    button.innerHTML = input.type == "password" ? "visibility" : "visibility_off";
}

// Add item to wishlist
async function AddToWishlist(event, productId, reload) {
    let button = event.target;

    let formData = new FormData();
    formData.append('product-id', productId);

    await fetch(window.location.origin + "/smallmart/website/operations/product/add-to-wishlist", {
        method: 'POST',
        body: formData,
    })
    .then((response) => response.text())
    .then((data) => {
        console.log(data);
        if (data == "added") {
            if (!button.classList.contains('favourite')) {
                button.innerHTML = '<span class="material-symbols-outlined filled">favorite</span>Remove from wishlist';
            }
            if (reload)
                window.location.reload();

            // Go through every product on the page and update to identical products
            for (let product of document.getElementsByClassName('product')) {
                if (product.id.match(new RegExp('product-' + productId + '-'))) {
                    product.getElementsByClassName('favourite')[0].classList.add('filled');
                }
            }
        }
        else if (data == "removed") {
            if (!button.classList.contains('favourite')) {
                button.innerHTML = '<span class="material-symbols-outlined">favorite</span>Add to wishlist';
            }
            if (reload)
                window.location.reload();
            
            // Go through every product on the page and update to identical products
            for (let product of document.getElementsByClassName('product')) {
                if (product.id.match(new RegExp('product-' + productId + '-'))) {
                    product.getElementsByClassName('favourite')[0].classList.remove('filled');
                }
            }
        }
        else if (data == "log-out") {
            window.location.replace('/smallmart/website/operations/user/log-out');
        }
        else if (data == "log-in") {
            window.location.href = '/smallmart/website/log-in?redirect=' + window.location.href.replace(/.*?\/smallmart\/website\/(.*)/, '$1%20');
        }
    });
}