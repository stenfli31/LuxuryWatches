


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






function setMask(event) {
    let formattedValue = '';
            for (let i = 0; i < value.length; i += 3) {
                formattedValue += value.slice(i, i + 3) + ' ';
            }

            // Убираем последний пробел, если он есть
            input.value = formattedValue.trim();
    input.value = value;
}

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