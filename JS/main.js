
const hoverSrc = "./images/icons/heart-fill.svg"
const favourite = document.querySelectorAll('.heart').forEach(img => 
    {const originalSrc = img.src;
    
    img.addEventListener('mouseover', () => {
        img.src = hoverSrc;
    });
    img.addEventListener('mouseout', () => {
        img.src = originalSrc;
    });

    img.addEventListener('click', () => {
        img.src = hoverSrc;
    });
    img.addEventListener('click', () => {
        img.src = originalSrc;
    });
});

