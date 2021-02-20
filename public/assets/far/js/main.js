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
//Добавления класса active к выбранному элементу nav-sidebar'а

// Модальное окно
$('#myModal').modal('show')

// Модальное окно


function elementClassToggle(elem) {
    elem.parentElement.classList.toggle('text-danger')
}

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

// Передача параметров для удаления Категории
$('body').on('click', '#tableIndex', function (event) {
    if (event.target.tag === 'BUTTON' || 'I') {
        const dellForm = document.querySelector('#dellForm')
        const id = event.target.getAttribute('data-id')
        const img = event.target.getAttribute('data-img')
        const indexOnDell = document.querySelector('#indexOnDell')
        indexOnDell.classList.add('d-none')
        dellForm.setAttribute('data-id', id)
        dellForm.setAttribute('data-img', img)

        if (+dellForm.getAttribute('data-img') === 1) {
            indexOnDell.classList.remove('d-none')
        }
    }
})

// Удаление категории
$('#onDellCategory').on('click', {paramUrl: "categories/"}, dellItem)
// Удаление продукта
$('#onDellProduct').on('click', {paramUrl: "products/"}, dellItem)

function dellItem(event) {
    event.preventDefault();
    document.querySelector('#labelOnDellImg').setAttribute('data-target', '0')
    const dellForm = document.querySelector('#dellForm')
    const id = dellForm.getAttribute('data-id')
    let img = dellForm.getAttribute('data-img')
    if (document.querySelector('#onDellImg').checked === true) {
        img = 2
    }
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        url: event.data.paramUrl + id,
        type: 'delete',
        // dataType: 'json',
        data: {id: id,
            img: img},
        // contentType: false,
        // processData: false,
        success: function () {
            $('#modal-danger').modal('hide')
            $("#index").load(location.href + " #index")
            setTimeout(function () {
                $(".sessionFlash").fadeOut()
            }, 3500)
        },
        error: function () {
            alert('Ошибка')
        }
    })
}

//Изменение чекбокса при подтверждении удаления категории
$("#onDellImg").on('change', function () {
    const label = document.querySelector('#labelOnDellImg')
    if (label.getAttribute('data-target') === '1') {
        label.setAttribute('data-target', '0')
        label.textContent = 'Переместить изображение'
    } else {
        label.setAttribute('data-target', '1')
        label.textContent = 'Удалить изображение'
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
    } else if (location === "/far/categories/create") {
        if ($("#title").val()) {
            pack = [
                $(".descriptionInput"),
                $(".keywordsInput"),
                $(".imgInput"),
                $(".buttonAdd")
            ]
        }
    }
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






