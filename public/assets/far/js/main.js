//Добавления класса active к выбранному элементу nav-sidebar'а
$('.nav-sidebar a').each(function () {
    const location = window.location.protocol + '//' + window.location.host + window.location.pathname,
        link = this.href;
    if (link === location) {
        $(this).addClass('active');
        $(this).closest('.has-treeview').addClass('menu-open');
    } else if (location.includes(link)) {
        $(this).closest('.has-treeview').addClass('menu-open');
    }
})

// Показать модальное окно
$('#myModal').modal('show')

//Функция добавить/убрать класс
function elementClassToggle(elem) {
    elem.parentElement.classList.toggle('text-danger')
}

//Функция убрать класс и отметку
function elementClassRemove(elem) {
    elem.parentElement.classList.remove('text-danger')
    elem.checked = false
}

// Чек бокс для удаления старого изображения
$('#img').on('change', function (e) {
    // Добавление названия загружаемого файла в поле input
    const fileName = e.target.files[0].name;
    $('.custom-file-label').html(fileName);
    const move = document.querySelector('#onMove')
    const dell = document.querySelector('#onDell')
    if (dell) {
        dell.parentElement.classList.add('text-danger')
        dell.checked = true
        elementClassRemove(move)
    }
})

// Чек бокс для удаления или перемещения старого изображения
$('#oldImgBox').change(function (event) {
    const dell = document.querySelector('#onDell')
    const move = document.querySelector('#onMove')
    if (event.target === dell) {
        elementClassToggle(dell)
        elementClassRemove(move)
    } else {
        elementClassToggle(move)
        elementClassRemove(dell)
    }
})

// Передача параметров для удаления
$('body').on('click', '#tableIndex', function (event) {
    const click = event.target
    if (click.tag === 'BUTTON' || 'I') {
        const id = click.getAttribute('data-id')
        const img = click.getAttribute('data-img')
        $('#dellForm').attr({'data-img': img, 'data-id': id})
        const indexOnDell = $('#indexOnDell')
        if (indexOnDell.length > 0 && img > 0) {
            indexOnDell.removeClass('d-none')
        }
    }
})
// Удаление категории
$('#onDellCategory').on('click', {paramUrl: "categories/"}, dellItem)
// Удаление продукта
$('#onDellProduct').on('click', {paramUrl: "products/"}, dellItem)
//Удаление пользователя
$("#onDellUser").on('click', {paramUrl: "userDell/"}, dellItem)

//Функция удалить
function dellItem(event) {
    event.preventDefault();
    const dellForm = $('#dellForm')
    const id = dellForm.attr('data-id')
    const img = dellForm.attr('data-img')
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        url: event.data.paramUrl + id,
        type: 'delete',
        data: {id: id,
            img: img},
        success: function () {
            $('#modal-danger').modal('hide')
            //Перезагрузка отображения
            $("#index").load(location.href + " #index")
            //Исчезновение флеш
            setTimeout(function () {
                $(".sessionFlash").fadeOut()
            }, 3500)
        },
        error: function () {
            alert('Ошибка')
        }
    })
}

//Изменение чекбокса (переместить/удалить) при подтверждении удаления категории
$("#onDellImg").on('change', function () {
    const label = $("#labelOnDellImg")
    const form = $("#dellForm")
    if (parseInt(label.attr('data-target')) === 1) {
        label.attr('data-target', 0)
        form.attr('data-img', 1)
        label.text('Переместить изображение')
    } else {
        label.attr('data-target', 1)
        form.attr('data-img', 2)
        label.text('Удалить изображение')
    }
})

//Изменение новинка при изменении чекбокса
$('#is_new').on('change', function () {
    changeCheckBox($(this))
})

//Изменение хит при изменении чекбокса
$('#is_hit').on('change', function () {
    changeCheckBox($(this))
})

function changeCheckBox(place) {
    if (place.prop('checked') === true) {
        place.attr('checked', true)
        place.val(1)
    } else {
        place.attr('checked', false)
        place.val(0)
    }
}

//Задание параметра value значением category_id при создании товара
$('#category_id').on('change', function () {
    const category_id = $(this).val()
    $(this).attr('value', category_id)
})
//Задержка до исчезновения флеш сообщения об успехе
window.setTimeout(function () {
    $(".sessionFlash").fadeOut()
}, 3500)

//Имитация клика для открытия заполненных input'ов, после ошибок валидации
$(document).ready(function() {
    $(".content-wrapper").trigger('click');
});

//Плавное появление элементов input при добавлении товара или категории
$(".content-wrapper").on('click', function () {
    const location = window.location.pathname
    let pack = []
    if (location === "/far/products/create") {
        if ($("#title").val()) {
            $(".categoryInput").fadeIn()
        }
        if ($("#category_id").val()) {
            $(".priceInput").fadeIn()
        }
        if ($("#price").val()) {
            pack = [
                $(".oldPriceInput"),
                $(".is_newInput"),
                $(".is_hitInput"),
                $(".descriptionInput")
            ]
        }
        if ($("#description").val()) {
            pack = pack.concat([
                $(".contentInput"),
                $(".keywordsInput"),
                $(".imgInput"),
                $(".buttonAdd")
            ])
        }
    } else if (location.includes("categories") ) {
        if ($("#title").val()) {
            pack = [
                $(".descriptionInput"),
                $(".keywordsInput"),
                $(".imgInput"),
                $(".buttonAdd")
            ]
        }
    }
    //Появление элементов
    fadeIn(pack)
})

// Функция для появления объектов
function fadeIn(pack) {
    pack.forEach(function(key) {
        key.fadeIn()
        if (key.hasClass("buttonAdd")) {
            key.prop("disabled", false)
        }
    })
}

//Изменение Статуса заказа
$("#status").on('change', function () {
    if ($(this).val() === '1') {
        $(this).val(0)
        $(this).siblings('label').text('В работе')
    } else {
        $(this).val(1)
        $(this).siblings('label').text('Завершен')
    }
})

//yandexMapRegistration
if (window.location.pathname.includes('/userEdit')) {
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
// Календарь
$(function() {
    $("#datePickerStart").datepicker($.datepicker.regional["ru"]);
});
$(function() {
    $("#datePickerFinish").datepicker($.datepicker.regional["ru"]);
});







