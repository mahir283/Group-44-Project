console.log("suck out");
document.getElementById('filterButton').addEventListener('click', function() {
    toggleFilter();
});

function toggleFilter() {
    var filter = document.getElementById('filter');
    console.log("hello world");
    if (filter.style.display === 'block') {
        filter.style.display = 'none';
    } else {
        filter.style.display = 'block';
    }
}

function resetForm() {
    document.querySelectorAll('.filter input').forEach(input => {
        input.checked = false;
        input.value = '';
    });
}
