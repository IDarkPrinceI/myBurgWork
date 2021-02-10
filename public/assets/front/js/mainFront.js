//Кнопка минус
$("#singleMinus").on('click', function () {
        result('minus')
    }
)
//Кнопка плюс
$("#singlePlus").on('click', function () {
        result('plus')
    }
)

//Функция изменения количества твара, добавляемого в корзину
 function result(typeButton) {
    const result = document.querySelector("#singleResult")
    let i = parseInt(result.textContent)
    if (typeButton === 'plus' && i < 10) {
        i += 1
    }
    if (typeButton === 'minus' && i > 1) {
        i -= 1
    }
    result.textContent = i
}

//Задержка до исчезновения флеш сообщения об успехе
window.setTimeout(function () {
    $("#sessionSuccess").fadeOut()
}, 3500)

//Крестик для закрытия окна Alert
$("#buttonCloseAlert").on('click', function() {
    $("#alertWindow").hide();
});

//CheckBox для rememberMe
$("#rememberMe").on('change', function () {
    if ($(this).prop('checked') === true) {
        $(this).attr('checked', true)
    } else {
        $(this).attr('checked', false)
    }
})


