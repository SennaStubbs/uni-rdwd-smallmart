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

    await fetch(window.location.origin + "/smallmart/website/operations/get_reviews", {
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