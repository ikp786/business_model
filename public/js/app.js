require('./bootstrap');

$(document).ready(function () {
    // Code to initialize date picker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });

    // Code to toggle branch availability on selected date
    $('.branch-availability-toggle').on('click', function () {
        var branchId = $(this).data('branch-id');
        var date = $(this).data('date');

        // Call the availability toggle route
        $.ajax({
            type: 'POST',
            url: '/branches/' + branchId + '/toggle-availability',
            data: {
                date: date,
            },
            success: function (data) {
                // Update the button text and color
                if (data.availability) {
                    $('.branch-availability-toggle[data-branch-id="' + branchId + '"][data-date="' + date + '"]').removeClass('btn-danger').addClass('btn-success').text('Open');
                } else {
                    $('.branch-availability-toggle[data-branch-id="' + branchId + '"][data-date="' + date + '"]').removeClass('btn-success').addClass('btn-danger').text('Closed');
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
});
