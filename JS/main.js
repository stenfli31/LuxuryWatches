
function onSortChange(value) {
    const url = new URL(window.location.href);
    url.searchParams.set('sort', value);
    window.location.href = url.toString(); // перезагружает с новым параметром
}



document.addEventListener('DOMContentLoaded', function () {
document.querySelectorAll('.favorite-button').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.dataset.productId;
        let heartImg = this.querySelector('img');

        fetch('toggle_favorite.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'product_id=' + productId
        })
        .then(res => res.text())
        .then(status => {
            if (status === 'added') {
                heartImg.src = './images/icons/heart-fill.svg';
            } else if (status === 'removed') {
                heartImg.src = './images/icons/heart.svg';
            }
        });
    });
});

});
function resetCheckedCheckboxes() {
    // Получаем все чекбоксы
    const checkboxes = document.querySelectorAll('.tag-check');
    
    // Проходим по чекбоксам и сбрасываем те, которые отмечены
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checkbox.checked = false; 
             // Снимаем отметку
        }
    });
    window.location.href = 'catalog.php';
    document.getElementById('filterForm').submit();
}