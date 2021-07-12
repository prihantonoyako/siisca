jQuery(function () {
    jQuery('#from').datetimepicker({
        format: 'Y-m-d H:i',
        onShow: function (ct) {
            this.setOptions({
                maxDate: jQuery('#to').val() ? jQuery('#to').val() : false
            })
        },
        timepicker: true
    });
    jQuery('#to').datetimepicker({
        format: 'Y-m-d H:i',
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#from').val() ? jQuery('#from').val() : false
            })
        },
        timepicker: true
    });
});
