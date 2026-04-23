//// Reviews
// Elements
var reviewsContainer = document.getElementById('reviews');
var reviewsLoadMoreButton = document.getElementById('load-more-reviews');

var reviewsCount = reviewsContainer.getElementsByClassName('review').length;

// (INITIAL) Hide 'load more reviews' button if no more reviews can be loaded
if (reviewsCount >= totalReviewsCount) {
    reviewsLoadMoreButton.remove();
}

async function LoadMoreReviews() {
    const formData = new FormData();
    formData.append("product-id", productId);
    formData.append("offset", reviewsCount);

    await fetch(window.location.origin + "/smallmart/website/operations/product/get_reviews", {
        method: 'POST',
        body: formData,
    })
    .then((response) => response.text())
    .then((data) => {
        reviewsLoadMoreButton.remove();
        reviewsContainer.innerHTML += data;

        reviewsCount = reviewsContainer.getElementsByClassName('review').length

        if (reviewsCount < totalReviewsCount) {
            reviewsContainer.innerHTML += reviewsLoadMoreButton.outerHTML;
            reviewsLoadMoreButton = document.getElementById('load-more-reviews');
        }
    });
}

//// Image viewer
// Elements
var viewerContainer = document.getElementById('image-viewer');
var viewerMainImage = document.getElementById('viewer-main-image').getElementsByTagName('img')[0];
var viewerImages = document.getElementById('viewer-images');

var viewerZoomedIn = false;

// Image zoom
viewerMainImage.addEventListener('click', function (event) {
    let clickX = event.offsetX;
    let clickY = event.offsetY;

    viewerZoomedIn = !viewerZoomedIn;

    if (viewerZoomedIn == true) {
        viewerMainImage.style.transformOrigin = clickX + "px " + clickY + "px";
        viewerMainImage.style.transform = "scale(2.5)";
        viewerMainImage.style.cursor = "zoom-out";
    }
    else {
        viewerMainImage.style.transform = "scale(1)";
        viewerMainImage.style.cursor = "zoom-in";
    }
});

// Toggle viewer
var viewerVisible = false;
function CloseImageViewer() {
    viewerContainer.classList.add('hidden');

    viewerVisible = false;
}

var selectedImageIndex = 0;
function OpenImageViewer(imageIndex = 0) {
    viewerContainer.classList.remove('hidden');
    viewerImages.getElementsByTagName('button')[selectedImageIndex].classList.remove('selected');
    viewerImages.getElementsByTagName('button')[selectedImageIndex].classList.add('animate-button-6px');

    selectedImageIndex = imageIndex;
    viewerMainImage.src = imagesList[selectedImageIndex];

    viewerImagesCounter.innerHTML = (selectedImageIndex + 1) + " of " + imagesList.length;
    viewerImages.getElementsByTagName('button')[selectedImageIndex].classList.add('selected');
    viewerImages.getElementsByTagName('button')[selectedImageIndex].classList.remove('animate-button-6px');
}

// Load images into viewer
var imagesHtml = "";
for (let [key, image] of Object.entries(imagesList)) {
    imagesHtml += `<button class="animate-button-6px" onclick=OpenImageViewer(` + key + `)><div class="image" style="background-image: url('` + image + `')"></div></button>`;
}
viewerImages.innerHTML += imagesHtml;

var viewerImagesCounter = viewerImages.getElementsByClassName('counter')[0].getElementsByTagName('p')[0];
viewerImagesCounter.innerHTML = (selectedImageIndex + 1) + " of " + imagesList.length;