/*
 * This file is part of the Mosaic Platform.
 *
 * (c) Rommel M. Zamora <rommel.zamora@groupm.com>
 * (c) Andrew Aculana <andrew.aculana@movent.com>
 *
 * Copyright (c)  2017. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

jQuery(document).ready(function() {
    CoreAjax.log(document);
    CoreAjax.init(document);

    jQuery(document).ajaxStart(function() {
        jQuery.blockUI({ message: '<div class="load-container"><div class="loader">Loading...</div></div>',
            css: {
                border: 'none',
                padding: '0px',
                width:   'auto',
                left:     '50%',
                backgroundColor: 'transparent',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity:.4,
                color: '#fff'
            }});
    });

    jQuery(document).ajaxError(function(){
        jQuery.unblockUI();
    });

    jQuery(document).ajaxComplete(function(){
        jQuery.unblockUI();
    });
});

jQuery(document).on('core-ajax-fetch-data', function(e) {
    CoreAjax.log('[CoreAjax|event|fetchData|trigger] on', e);
    CoreAjax.fetchData(e.target);
});

var CoreAjax = {
    setup: function(subject) {
        CoreAjax.log("[ajax|setup] Register services on", subject);
    },

    /**
     * render log message
     * @param mixed
     */
    init: function(subject) {
        CoreAjax.log('[CoreAjax|init] on', subject);
        if (jQuery('.core-ajax-btn', subject).length > 0) {
            jQuery(subject).on('click', '.core-ajax-trigger', function(event) {
                CoreAjax.stopEvent(event);
                jQuery(this).trigger('core-ajax-fetch-data');
            });
        }
    },

    stopEvent: function(event) {
        if(event.preventDefault) {
            event.preventDefault();
        } else {
            event.returnValue = false;
        }

        //if it is a standard browser get target otherwise it is IE then adapt syntax and get target
        if (typeof event.target != 'undefined') {
            targetElement = event.target;
        } else {
            targetElement = event.srcElement;
        }

        return targetElement;
    },

    /**
     * render log message
     * @param mixed
     */
    log: function() {
        var msg = '[CoreAjax] ' + Array.prototype.join.call(arguments,', ');
        if (window.console && window.console.log) {
            window.console.log(msg);
        } else if (window.opera && window.opera.postError) {
            window.opera.postError(msg);
        }
    },

    /**
     * Change object field value
     * @param subject
     */
    fetchData: function(subject) {
        CoreAjax.log('[CoreAjax|fetchData] on', subject);

        var url = jQuery(subject).is('[data-href]') ? jQuery(subject).attr('data-href') : null;
        var targetClass = jQuery(subject).is('[data-target-class]') ? jQuery(subject).attr('data-target-class') : null;
        var targetId = jQuery(subject).is('[data-target-id]') ? jQuery(subject).attr('data-target-id') : null;

        if(url !== null && (targetClass !== null || targetId !== null)) {
            jQuery.ajax({
                url: url,
                type: 'GET'
            })
            .done(function(data) {
                if('KO' === data.status) {
                    CoreAjax.log('[CoreAjax|fetch_data] message', data.message);
                    return data.message;
                }

                if(targetClass) {
                    jQuery('.'+targetClass).append(data.content);
                } else if(targetId) {
                    jQuery('#'+targetId).append(data.content);
                }

                if(data.url !== null) {
                    jQuery(subject).attr('data-href', data.url);
                } else {
                    jQuery(subject).hide();
                }

                CoreAjax.log('[CoreAjax|fetch_data] done');
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                CoreAjax.log('[CoreAjax|fetch_data]:', jqXHR.status, textStatus, errorThrown);
            });
        }
    }
};