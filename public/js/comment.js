document.addEventListener("DOMContentLoaded", function() {
    const allStars = document.querySelectorAll('.rating .star');
    const ratingValue = document.getElementById('ratingValue');
    const commentForm = document.getElementById('commentForm');
    const commentBox = document.getElementById('commentBox');
    const commentDisplay = document.querySelector('.comment-display');

    // Star rating click event
    allStars.forEach((star, idx) => {
        star.addEventListener('click', function () {
            ratingValue.value = idx + 1;

            allStars.forEach((s, i) => {
                if (i <= idx) {
                    s.classList.replace('bx-star', 'bxs-star');
                    s.classList.add('active');
                } else {
                    s.classList.replace('bxs-star', 'bx-star');
                    s.classList.remove('active');
                }
            });
        });
    });


    commentForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const rating = ratingValue.value;
        const commentText = commentBox.value.trim();

        if (!rating) {
            alert("Please select a rating before submitting!");
            return;
        }

        if (!commentText) {
            alert("Please enter a comment before submitting!");
            return;
        }


        const newComment = document.createElement('div');
        newComment.classList.add('comment-item');
        newComment.innerHTML = `<p><strong>Rating:</strong> ${rating} ⭐</p><p>${commentText}</p>`;

        commentDisplay.appendChild(newComment);


        commentForm.reset();
        ratingValue.value = "";
        allStars.forEach(star => {
            star.classList.replace('bxs-star', 'bx-star');
            star.classList.remove('active');
        });
    });
});


