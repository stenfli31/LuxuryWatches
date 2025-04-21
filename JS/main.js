


const hoverSrc = "./images/icons/heart-fill.svg"
const favourite = document.querySelectorAll('.heart').forEach(img => 
    {const originalSrc = img.src;
    
        
    
    img.addEventListener('click', () => {
        if(img.src == originalSrc){
        img.src = hoverSrc;
        }
        else {
            img.src = originalSrc;
        }
    });
});

function onSortChange(value) {
    const url = new URL(window.location.href);
    url.searchParams.set('sort', value);
    window.location.href = url.toString(); // перезагружает с новым параметром
}



console.log(typeof onSortChange);