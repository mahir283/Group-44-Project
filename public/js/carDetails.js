document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-rating input');
    stars.forEach(star => {
        star.addEventListener('change', function() {
            const ratingValue = this.value;
            const labels = this.parentElement.querySelectorAll('label');
            labels.forEach((label, index) => {
                if (index >= 5 - ratingValue) {
                    label.style.color = 'darkorange'; // Color stars when selected
                } else {
                    label.style.color = '#ddd'; // Reset unselected stars
                }
            });
        });
    });
});
