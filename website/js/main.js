// Scroll back to top
function BackToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

// Hide 'back to top' if screen too small
console.log(document.body.clientHeight);
if (document.body.clientHeight < 1500) {
    document.getElementById('back-to-top').classList.add('hidden');
}