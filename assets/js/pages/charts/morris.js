$(function () {
    getMorris('line', 'line_chart');
    // getMorris('bar', 'bar_chart');
    // getMorris('area', 'area_chart');
    // getMorris('donut', 'donut_chart');
});


function getMorris(type, element) {
    if (type === 'line') {
        Morris.Line({
            element: element,
            data: kuota_line_chart,
            xkey: 'tahun_rekap',
            ykeys: ['kuota'],
            labels: ['Kuota'],
            lineColors: ['rgb(233, 30, 99)'],
            lineWidth: 3
        });
    }
}