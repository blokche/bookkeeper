(function(){
    var select = document.querySelector('select') || null;
    var authorArea = document.querySelector('#author').parentNode;

    if (select !== null)
    {
        if (select.selectedIndex != 0) {
            authorArea.style.display = "none"
        }

        select.addEventListener('change', function(event)
        {
            if (event.target.selectedIndex != 0) {
                authorArea.style.display = 'none'
            } else {
                authorArea.style.display = "block"
            }
        })
    }
})()