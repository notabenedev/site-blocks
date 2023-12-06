(function ($) {
    $(document).ready(function(){
        initAlertRemind();
    });

    function initAlertRemind() {

        var now = new Date().getTime();
        $(".blocks-alert__container").each( function (index){
            if (!sessionStorage.getItem('block-alert-close-'+index) || (now - sessionStorage.getItem('block-alert-close-'+index)) > 24*60*60*1000) {
                $(this).addClass('show');
                $(this).on('closed.bs.alert', function() {
                    setAlertCookie(index, now);
                })
            } else {
                $(this).alert('close');
            }
        })
    }

    function setAlertCookie(index, value) {
        sessionStorage.setItem('block-alert-close-'+index, value);
    }

})(jQuery);
