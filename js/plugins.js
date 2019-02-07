// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/* simple-validate */
$.fn.validate = function(options) {
    var defaults = { 'errorclass':'error' }
    var opts = $.extend(defaults, options);
    var bool = true, finish = true;
    var parent = [];
    var inputs = this.find('*[data-valid]');

    inputs.each(function(){
        elem = $(this);
        parent = elem.parent();

        switch(elem.attr('data-valid')){
            case 'email': 		bool = validEmail(elem.val()); break;
            case 'required':	bool = validRequired(elem);  break;
            case 'integer': 	bool = validInt(elem.val());  break;
            case 'dni': 		bool = validDni(elem.val()); break;
            case 'ruc': 		bool = validRuc(elem.val()); break;
            case 'tel': 		bool = validTel(elem.val()); break;
            case 'number':		bool = !isNaN(parseFloat(elem.val())) && isFinite(elem.val());
        }

        if(!bool || elem.val() == elem.attr('data-holder')){
            if (elem.is('select')) {
                parent.addClass(opts.errorclass);
            } else {
                parent.addClass(opts.errorclass);
            }
            finish = false;
            bool = true;
        } else {
            if (elem.is('select')) {
                parent.removeClass(opts.errorclass);
            } else {
                parent.removeClass(opts.errorclass);
            }
        }
    });

    function validEmail(valor){ return (/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(valor)) ? true : false; }
    function validInt(valor){ return (/^\d+$/.test(valor)) ? true : false; }
    function validDni(valor){ return (/^\d+$/.test(valor) && valor.length == 8) ? true : false; }
    function validRuc(valor){ return (/^\d+$/.test(valor) && valor.length == 11) ? true : false; }
    function validTel(valor){ return (/^\d+$/.test(valor) && valor.length >= 7) ? true : false; }
    function validRequired(elem){
        if(elem.is('select')){ return ($.trim(elem.val()) != '') ? true : false;
        }else if(elem.is(':checkbox')){ return (elem.is(':checked')) ? true : false;
        }else{ return (/[^.*\s]/.test(elem.val())) ? true : false; }
    }

    return finish;
};
