/*
 * This file is part of the Mosaic Platform.
 *
 * (c) Rommel M. Zamora <rommel.zamora@groupm.com>
 * (c) Andrew Aculana <andrew.aculana@movent.com>
 *
 * Copyright (c)  2017. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

function BrueryAjaxBlock(options) {
    this.settings = options.settings;
    this.init();
}

BrueryAjaxBlock.prototype = {

    init: function() {
        if(jQuery('.'+this.settings.id).length > 0) {
            this.execute(this);
        }
    },

    execute: function(obj) {
        jQuery.ajax({
            url: obj.settings.ajax.url,
            type: obj.settings.ajax.type,
            success: function(json) {
                if(json.status === "OK") {
                    var elm = jQuery(obj.settings.ajax.target);
                    elm.children().remove();
                    // fix issue with html comment ...
                    elm.html(jQuery(json.content.replace(/<!--[\s\S]*?-->/g, "")).html());
                } else {
                    // jQuery('#'+obj.settings.ajax.target).parent().effect("highlight", {'color' : '#C43C35'}, 2000);
                }
            }
        });
    }
}
