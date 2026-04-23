var reviewsContainer = document.getElementById('reviews-row-container');
var reviewsLoadMoreButton = document.getElementById('load-more-reviews');
var reviewsCount = 6;

async function LoadMoreRecentReviews() {
    const formData = new FormData();
    formData.append("offset", reviewsCount);

    await fetch(window.location.origin + "/smallmart/website/operations/product/home_get_reviews", {
        method: 'POST',
        body: formData,
    })
    .then((response) => response.text())
    .then((data) => {
        console.log(data);
        reviewsLoadMoreButton.remove();
        reviewsContainer.innerHTML += data;

        reviewsCount = reviewsContainer.getElementsByClassName('review').length

        if (reviewsCount % 6 == 0) {
            reviewsContainer.innerHTML += reviewsLoadMoreButton.outerHTML;
            reviewsLoadMoreButton = document.getElementById('load-more-reviews');
        }
    });
}

// Scrolling through collections
var collectionsContainer = document.getElementById('collections-container');
var currentId = 1;
function MoveCategorySlide(collectionId) {
    document.getElementById('collection-button-' + currentId).classList.remove('selected');
    currentId = collectionId;
    document.getElementById('collection-button-' + currentId).classList.add('selected');
    collectionsContainer.scrollLeft = document.getElementById('collection-' + currentId).offsetLeft - 22;
}