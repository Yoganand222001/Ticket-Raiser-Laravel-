function ajax_request($url = null){

    let status = [] ;

    let priority = [];

    let categories = [];

    $.each($("input[name='status']:checked"), function () {
        status.push($(this).val());
    });

    $.each($("input[name='priority']:checked"), function () {
        priority.push($(this).val());
    });

    $.each($("input[name='categories']:checked"), function () {
        categories.push($(this).val());
    });

    let data = {
        'status' : status,
        'priority': priority
    };

    if(categories.length > 0) data.categories = categories;
    console.log(JSON.stringify(data));

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if(!$url) $url = '/Tickets/' + JSON.stringify(data);

    $.ajax({
        url: $url,
        method: 'get',
        success: function (result) {
            paginate_data(result)
        },
    });
}
function paginate_data(result){
    if (result.hasOwnProperty('status')) {

        if (result.status === 200) {
            if (result.hasOwnProperty('view')) {
                $('.tickets').html(result.view);
            }
        }
        else if (result.status === 204) {
            $('.dropdown-empty-error').innerText = result.error;
        }
    }
}

$(document).ready(function () {

    ajax_request()

    $('#filters').on('click', function () {
        ajax_request();
    });

});
