(function ($) {

    "use strict";
    var tbody = $("body.post-type-portfolio tbody#the-list");
    var data = {
        'action': 'sort-posts', //Set an action for our ajax function
    };

    tbody.sortable({
        cursor: "move",
        update: function (event, ui) {
            //grabs all of the ids of the post rows and pushes them into an array
            data.sort = $(this).sortable('toArray');

            $.post(ajaxurl, data)
                .done(function (response) {
                    console.log(response);
                    //alert("Sorting Successful.");
                }).fail(function () {
                alert("Uh Oh! You tried to divide by zero.");
            });
        }
    });

})(jQuery);