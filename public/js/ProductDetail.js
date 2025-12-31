document.addEventListener('DOMContentLoaded', () => {
    let colorInput = document.getElementById('colorInput');
    let sizeInput  = document.getElementById('sizeInput');
    document.querySelectorAll('.color-option').forEach(item => {
        item.addEventListener('click', () => {

            document.querySelectorAll('.color-option')
                .forEach(i => i.classList.remove('active'));

            item.classList.add('active');
            colorInput.value = item.dataset.color;
        });
    });
    document.querySelectorAll('.size-option').forEach(item => {
        item.addEventListener('click', () => {

            document.querySelectorAll('.size-option')
                .forEach(i => i.classList.remove('active'));

            item.classList.add('active');
            sizeInput.value = item.dataset.size;
        });
    });

});
$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
 });

