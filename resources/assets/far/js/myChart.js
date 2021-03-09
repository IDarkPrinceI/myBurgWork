//Появление поля "Выберите дату "ДО":
$("#datePickerStart").on('change', function () {
    $("#dataPickerFinishDiv").removeClass('d-none')
})
//Появление кнопки "Сформировать график":
$("#datePickerFinish").on('change', function () {
    $("#chartBuild").removeClass('d-none')
})
//Построение графика
$("#chartBuild").on('click', function () {
    const dateStart = $("#datePickerStart").val()
    const dateFinish = $("#datePickerFinish").val()
    $.ajax({
        url: '/far/chart/' + dateStart + '/' + dateFinish,
        success: function (res) {
            const ctx = $("#myChart");
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: res[0], //date Х
                    datasets: [{
                        label: 'Уникальных пользователей:',
                        data: res[1], //usersCount Y
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        error: function () {
            alert('Ошибка')
        }
    })
})
