jQuery(document).ready(function() {
    "use strict";
	/* If there are required actions, add an icon with the number of required actions in the About themotion page -> Actions required tab */
    var themotion_nr_actions_required = themotionLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof themotion_nr_actions_required != 'undefined') && (themotion_nr_actions_required != '0') ) {
        jQuery('li.themotion-w-red-tab a').append('<span class="themotion-actions-count">' + themotion_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".themotion-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'themotion_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : themotionLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.themotion-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + themotionLiteWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var themotion_actions_count = jQuery('.themotion-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof themotion_actions_count != 'undefined' ) {
                    if( themotion_actions_count == '1' ) {
                        jQuery('.themotion-actions-count').remove();
                        jQuery('.themotion-tab-pane#actions_required').append('<p>' + themotionLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.themotion-actions-count').text(parseInt(themotion_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

	/* Tabs in welcome page */
	function themotion_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".themotion-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var themotion_actions_anchor = location.hash;

	if( (typeof themotion_actions_anchor != 'undefined') && (themotion_actions_anchor != '') ) {
		themotion_welcome_page_tabs('a[href="'+ themotion_actions_anchor +'"]');
	}

    jQuery(".themotion-nav-tabs a").click(function(event) {
        event.preventDefault();
		themotion_welcome_page_tabs(this);
    });

		/* Tab Content height matches admin menu height for scrolling purpouses */
	 var tab = jQuery('.themotion-tab-content > div');
	 var admin_menu_height = jQuery('#adminmenu').height();
	 if( (typeof tab != 'undefined') && (typeof admin_menu_height != 'undefined') )
	 {
		 var newheight = admin_menu_height - 180;
         tab.css('min-height',newheight);
	 }

});
