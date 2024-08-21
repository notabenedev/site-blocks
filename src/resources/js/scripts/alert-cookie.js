document.addEventListener('DOMContentLoaded', function(){
    // init Alert Remind
    var now =  Date.now();
    document.querySelectorAll('.blocks-alert__container').forEach(function(element,index) {
        if (!sessionStorage.getItem('block-alert-close-'+index) || (now - sessionStorage.getItem('block-alert-close-'+index)) > 24*60*60*1000) {
            element.classList.remove("d-none");
            element.addEventListener('closed.bs.alert', function (event) {
                setAlertCookie(index, now);
            })
        } else {
            element.classList.add('d-none');
            var alert = bootstrap.Alert.getInstance(element)
            if (alert) {
                alert.close()
            }
        }
    });

});
function setAlertCookie(index, value) {
    sessionStorage.setItem('block-alert-close-'+index, value);
}

