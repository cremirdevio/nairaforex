
let loader = '<div class="in-loader">'+
            '<div></div>'+
            '<div></div>'+
            '<div></div>'+
            '</div>';

function searchResult(response) {
    let tableData = $('#search-result');
    tableData.empty();
    tableData.html(response.user);
}

function showError(url) {
    let errorData;
    let errorMsg = '<center><i class="mt-5 fa fa-exclamation-triangle" aria-hidden="true"></i> Error in Network Connection<br>';

    errorData = {'user' : errorMsg + '<a href="#" class="rounded-circle btn btn-warning" onclick="reload(\''+url+'\')"><i class="fa fa-refresh" aria-hidden="true"></i></a></center>'};
    searchResult(errorData);
}

function fetchData(url) {

    let username = $('#search-input').val().trim();
    if (username === '') {
        Toast.fire({
            icon: 'error',
            title: 'Ensure you type in the username you want to search!'
        })
        return false;
    }
    showLoader()
    $.ajax({
        url: url,
        type: 'get',
        data: {'username':username},
        dataType: 'json',
        success: function(response) {
            searchResult(response);
            
            Toast.fire({
                icon: 'info',
                title: 'Search Completed!!'
            })
        },
        error: function(response, msg, x) {
            showError(url);
            Toast.fire({
                icon: 'error',
                title: 'An error occured, you can try again!'
            })
        }
    });
}

function showLoader(type) {
    let tableData = $('#search-result');
    tableData.empty();
    tableData.css('minHeight', '100');
    tableData.prepend(loader);
    $('.preloader').show();
}

function reload(link) {
    showLoader();
    fetchData(link);
}
