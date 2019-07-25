// $('.datepicker').datepicker({
//     format: 'dd/MM/yyyy'
// });

$(document).ready(function() {
    $('.calendar').datepicker({
        format: "dd/mm/yyyy",
        language: "fr",
        orientation: "bottom auto",
        todayHighlight: true,
        datesDisabled: ['06/20/2019']
    });
});