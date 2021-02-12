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
