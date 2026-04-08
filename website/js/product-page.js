//// Reviews
// Elements
var reviewsContainer = document.getElementById('reviews');
var reviewsLoadMoreButton = document.getElementById('load-more-reviews');

var reviewsCount = reviewsContainer.getElementsByClassName('review').length;

// Hide 'load more reviews' button if no more reviews can be loaded
if (reviewsCount >= totalReviewsCount) {
    reviewsLoadMoreButton.remove();
}
console.log(totalReviewsCount);