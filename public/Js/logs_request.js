function ajax_request($fetch, $url){

    if(!$url) return null;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: $url,
        method: 'get',
        success: function (result) {

            if (result.hasOwnProperty('status') && result.status === 200) {

                if (!result.hasOwnProperty('no_changes') && result.hasOwnProperty('latest_activities')) {

                    $('.no-new-updates').hide();
                    $('.updating').show();

                    $('.ticket-logs').prepend(result.latest_activities);

                    localStorage.setItem('log_count', result.counts);
                    localStorage.setItem('last_id', result.latest_id);

                    $('.updating').hide();
                    $('.no-new-updates').show();
                }
                else if (!result.hasOwnProperty('no_changes') && !result.hasOwnProperty('is_old_activity')) {

                    localStorage.setItem('log_count', result.counts);
                    localStorage.setItem('last_id', result.latest_id);
                    localStorage.setItem('nextPageUrl', result.nextPageUrl);
                    console.log(localStorage.getItem('nextPageUrl'));

                    if ($fetch === 'first_load') {
                        $('.logs').html(result.view);
                        $('.no-new-updates').hide();
                        $('ul.pagination').hide();
                        $('.updating').hide();
                        $('.load_data').show();
                    }
                }
                else if (result.hasOwnProperty('is_old_activity') && result.is_old_activity){
                    $('.ticket-logs').append(result.old_activities);
                    localStorage.setItem('nextPageUrl', result.nextPageUrl);
                }
                else $('.no-new-updates').show();
            }
        }
    });
}
function logs_request($fetch = null, $url = '') {
    let count = localStorage.getItem('log_count');
    let last_id = localStorage.getItem('last_id');

    if (!count) count = 0;
    if (!last_id) last_id = 0;

    let data = {
        'count': count,
        'last_id': last_id,
    };

    if ($fetch) data.fetch = $fetch;
    if (!$url) $url += '/ticket-logs/' + JSON.stringify(data);

    ajax_request($fetch, $url);
}

$(window).on('unload', function () {
    localStorage.removeItem('log_count');
    localStorage.removeItem('last_id');
    localStorage.removeItem('nextPageUrl')
});

$(document).ready(function () {

    $('.load_data').hide();

    logs_request('first_load');

    setInterval(function () {
        logs_request('fetch_latest');
    }, 20000);

    $('.load_data').on("click", function() {
        if (localStorage.getItem('nextPageUrl'))
            ajax_request(null, localStorage.getItem('nextPageUrl'));
    });
});

