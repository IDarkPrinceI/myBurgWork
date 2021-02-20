//Кнопка минус
$("body").on('click', ".singleMinus", function (e) {
    const result = $(this).closest(".singleResult")
    // console.log(result)
        resultOn('minus', result)
    }
)
//Кнопка плюс
$("body").on('click', ".singlePlus", function (e) {
// $("#singlePlus").on('click', function () {
        const result = $(this).closest(".singleResult").text()
        resultOn('plus', result)
    }
)
//Функция изменения количества твара, добавляемого в корзину
function resultOn(typeButton, result) {
    // const result = e.target.siblings("#singleResult")
    // const result = e.closest("#singleResult")
    // const result = document.querySelector("#singleResult")
    // const result = document.querySelector("#singleResult")
    // let i = parseInt(result.textContent)
    console.log(result)

    // let i = result.text()
    if (typeButton === 'plus' && i < 10) {
        const qtyRez = 1 //
        i += 1
        if (window.location.pathname.includes('/getOrder')) {
            $("#overlay").css({'display': 'block'})
            reCalc(qtyRez, i) //
        }
    }
    if (typeButton === 'minus' && i > 1) {
        const qtyRez = -1 //
        i -= 1
        if (window.location.pathname.includes('/getOrder')) {
            $("#overlay").css({'display': 'block'})
            reCalc(qtyRez, i) //
        }
    }
    result.textContent = i
}
//reCalcCart
function reCalc(qtyRez, qty) {
    const slug = $("#singleResult").attr('data-slug')
    $.ajax({
        url: '/cartReCalc/' + qty,
        data: {slug: slug,
               qtyRez: qtyRez},
        success: function (res) {
            $("#upOrderForm").load(document.URL + ' #orderForm')
            setTimeout(function () {
                $("#cartCheck").load(document.URL + ' #cartCheck')
            }, 50)
            $("#overlay").css({'display': 'none'})
        },
        error: function () {
            alert('Ошибка')
        }
    })
}

//Задержка до исчезновения флеш сообщения об успехе
window.setTimeout(function () {
    $("#sessionSuccess").fadeOut()
}, 3500)

//Крестик для закрытия окна Alert
$("#buttonCloseAlert").on('click', function () {
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

//yandexMapRegistration
if (window.location.pathname.includes('/register')) {
    let myMap
// Инициализация карты
    ymaps.ready(init);

    function init() {
        let myPlacemark,
            myMap = new ymaps.Map('map', {
                center: [47.422052, 40.093725],
                zoom: 17
            });
        myMap.controls
            //Геолокация
            .remove('geolocationControl')
            //Полноэкранный режим
            .remove('fullscreenControl')
            // Список типов карты
            .remove('typeSelector')
            //Пробки
            .remove('trafficControl')
            //Линейка
            .remove('rulerControl')

        // Событие клика на карте.
        myMap.events.add('click', function (e) {
            let coords = e.get('coords');
            // Если метка уже создана – передвигаем ее.
            if (myPlacemark) {
                myPlacemark.geometry.setCoordinates(coords);
            }
            // Если нет – создаем.
            else {
                myPlacemark = createPlacemark(coords);
                myMap.geoObjects.add(myPlacemark);
            }
            //Получаем адрес по координатам клика
            ymaps.geocode(coords).then(function (res) {
                let geoObject = res.geoObjects.get(0),
                    address = geoObject.getAddressLine(),
                    value = document.querySelector('#address')

                if (address.includes("Новочеркасск")) {
                    value.value = geoObject.getAddressLine()
                } else {
                    value.value = ''
                    alert('Укажите адрес в пределах города Новочеркасск')
                }
            });
        });

// Создание метки.
        function createPlacemark(coords) {
            return new ymaps.Placemark(coords, {
                iconContent: '!'
            });
        }
    }
}
// Показать корзину
$("#cartCheck").on('click', function () {
    showCart()
})
function showCart() {
    $("#modal-cart").fadeIn()
}

// Скрыть корзину
$(".cartClose").on('click', function () {
    hideCart()
})
function hideCart() {
    $("#modal-cart").fadeOut()
}

//reloadCart
function reloadCart() {
    $(".modal-body").load(document.URL + ' .modal-body')
    setTimeout(function () {
        $("#cartCheck").load(document.URL + ' #cartCheck')
    }, 50)
}

//addCart
$(".cartAdd").on('click', function (e) {
    e.preventDefault()
    const slug = $(this).attr('data-slug')
    let qty = $("#singleResult").text()
    if (qty === '') {
        qty = 1
    }
    $.ajax({
        url: '/cartAdd/' + slug,
        data: {qty: qty},
        type: 'GET',
        success: function () {
            reloadCart()
            showCart()
            if (window.location.pathname.includes('/menu')) {
                $("#singleResult").text(1)
            }
        },
        error: function () {
            alert('Ошибка')
        }
    })
})
//clearCart
$("#cartClean").on('click', function (e) {
    e.preventDefault()
    $.ajax({
        url: '/cartClear/',
        type: 'GET',
        success: function () {
            hideCart()
            reloadCart()
        },
        error: function () {
            alert('Ваша корзина пуста.')
        }
    })
})
//cartDell
$("#modal-cart .modal-body").on('click', '.del-item', function (e) {
    e.preventDefault()
    const slug = $(this).attr('data-slug')
    $.ajax({
        url: '/cartDell/' + slug,
        type: 'GET',
        success: function () {
            reloadCart()
        },
        error: function () {
            alert('Ошибка удаления товара')
        }
    })
})
//cartReCalc
// function cartReCalc(qty){
//     const slug = $("#singleResult").attr('data-slug')
//     $.ajax({
//         url: '/cartReCalc/' + qty,
//         data: {slug: slug},
//         success: function (res) {
//             console.log(res)
//             alert('Ура')
//         },
//         error: function () {
//             alert('Ошибка')
//         }
//     })
// }
//cartCheck
// $("#getOrder").on('click', function (e) {
//     e.preventDefault()
//     $.ajax({
//         url: '/getOrder',
//         success: function (res) {
//             console.log(res)
//             alert('Ура')
//         },
//         error: function () {
//             alert('Ошибка')
//         }
//
//     })
// })



