document.addEventListener("DOMContentLoaded", function() {
    var carStock = [
        { name: "Hatchback", stock: 5 },
        { name: "SUV", stock: 12 },
        { name: "Saloon", stock: 3 },
        { name: "Coupe", stock: 8 },
        { name: "Van", stock: 8 }
    ];

    var notificationBox = document.getElementById('notifications-box');

    function addNotification(car) {
        var notification = document.createElement('div');
        notification.classList.add('notification');

        if (car.stock < 20) {
            notification.classList.add('low-stock');
            notification.innerHTML = `<strong>${car.name}</strong> is running low! Only ${car.stock} left.`;
        } else {
            notification.classList.add('success');
            notification.innerHTML = `<strong>${car.name}</strong> stock is sufficient (${car.stock} available).`;
        }

        notificationBox.appendChild(notification);
    }



});
