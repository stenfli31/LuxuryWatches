


// const hoverSrc = "./images/icons/heart-fill.svg"
// const favourite = document.querySelectorAll('.heart').forEach(img => 
//     {const originalSrc = img.src;
    
        
    
//     img.addEventListener('click', () => {
//         if(img.src == originalSrc){
//         img.src = hoverSrc;
//         }
//         else {
//             img.src = originalSrc;
//         }
//     });
// });

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