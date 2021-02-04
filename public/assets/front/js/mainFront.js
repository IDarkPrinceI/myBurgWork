$("#singleMinus").on('click', function () {
        result('minus')
    }
)

$("#singlePlus").on('click', function () {
        result('plus')
    }
)

// document.querySelector("#singleMinus").addEventListener('click', function () {
//     result('minus')
//     }
// )
// document.querySelector("#singlePlus").addEventListener('click', function () {
//     result('plus')
//     }
// )

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
