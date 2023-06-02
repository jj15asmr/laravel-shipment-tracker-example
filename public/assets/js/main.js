const url_params = new URLSearchParams(location.search);
if (url_params.has('tn') && url_params.get('tn') != '') {
    document.getElementById('track-item-form').submit();
}