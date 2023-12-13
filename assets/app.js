/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

function generateStarRating(rating) {
  let stars = '';
  for (let i = 1; i <= 5; i++) {
      if (i <= rating) {
          stars += '<img src="build/images/icons/star.svg" alt="icon star">';
      } else {
          stars += '<img src="build/images/icons/star-empty.svg" alt="Empty Star">';
      }
  }
  return stars;
}

// Update the rating display for each comment
document.addEventListener("DOMContentLoaded", function() {
  const comments = document.querySelectorAll('.comment-rating');
  comments.forEach(function(comment) {
      const rating = parseInt(comment.dataset.rating);
      comment.innerHTML = generateStarRating(rating);
  });
});