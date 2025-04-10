
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


// img.addEventListener('mouseover', () => {
//     img.src = hoverSrc;
// });
// img.addEventListener('mouseout', () => {
//     img.src = originalSrc;
// });
