function getSelectedDate()
{
    if(localStorage.getItem('start_date') != null && localStorage.getItem('end_date') != null)
    {
        var start = localStorage.getItem("start_date");
        var end   = localStorage.getItem("end_date");

        return {'start_date' : start, 'end_date' : end};
    }
    else
    {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        return {'start_date' : '2020-01-01', 'end_date' : today};
    }
}

function getSelectedCity()
{
    if (localStorage.getItem('city') != null)
    {
        var city = localStorage.getItem('city');
        $('#city_holder').html(city);
    }
    else
    {
        var city = 'All Cities';
    }

    return city;
}
var _initDaterangepicker = function () {
    if ($('#kt_dashboard_daterangepicker').length == 0) {
        return;
    }

    var dateData = getSelectedDate();

    var picker = $('#kt_dashboard_daterangepicker');
    var start  = moment(dateData.start_date);
    var end    = moment(dateData.end_date);

    console.log('date range init');

    function cb(start, end, label) {
        var title = '';
        var range = '';

        if ((end - start) < 100 || label == 'Today') {
            title = 'Today:';
            range = start.format('MMM D');
        } else if (label == 'Yesterday') {
            title = 'Yesterday:';
            range = start.format('MMM D');
        } else {
            range = start.format('MMM D, YY') + ' - ' + end.format('MMM D, YY');
        }

        $('#kt_dashboard_daterangepicker_date').html(range);
        $('#kt_dashboard_daterangepicker_title').html(title);
    }


    picker.daterangepicker({
        // direction: KTUtil.isRTL(),
        // startDate: start,
        // endDate: end,
        applyClass: 'btn-primary',
        cancelClass: 'btn-light-primary',
        autoApply: true,
        autoUpdateInput: true,
        // locale: {
        //     cancelLabel: 'Clear'
        // },
        ranges: {
            'All Time': [moment('2020-01-01'), moment()],
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        }
    }, cb);

    cb(start, end, 'All Time');
}
$(function() {
    _initDaterangepicker();
});
