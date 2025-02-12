
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll('.rating .star');
    const ratingValue = document.getElementById('ratingValue');

    stars.forEach((star, idx) => {
        star.addEventListener('click', function () {
            ratingValue.value = idx + 1;
            stars.forEach((s, i) => {
                s.classList.toggle('bxs-star', i <= idx);
                s.classList.toggle('bx-star', i > idx);
            });
        });
    });
});


