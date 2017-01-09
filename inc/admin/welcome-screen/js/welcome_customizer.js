jQuery(document).ready(function() {
    "use strict";
    var themotion_aboutpage = themotionWelcomeScreenCustomizerObject.aboutpage;
    var themotion_nr_actions_required = themotionWelcomeScreenCustomizerObject.nr_actions_required;


    var themotion_themeinfo = themotionWelcomeScreenCustomizerObject.themeinfo;
    var themotion_themeinfo_link = themotionWelcomeScreenCustomizerObject.themeinfo_link;
    var themotion_documentation = themotionWelcomeScreenCustomizerObject.documentation;
    var themotion_documentation_link = themotionWelcomeScreenCustomizerObject.documentation_link;

    /* Number of required actions */
    if ((typeof themotion_aboutpage != 'undefined') && (typeof themotion_nr_actions_required != 'undefined') && (themotion_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + themotion_aboutpage + '"><span class="themotion-actions-count">' + themotion_nr_actions_required + '</span></a>');
    }
});