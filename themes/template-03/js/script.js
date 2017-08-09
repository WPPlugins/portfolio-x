jQuery(document).ready(function($){

$(function($){
    $.fn.qcPortfolio = function(params){
        var defaults = {
            itemsClass: 'qc-portfolio-x-item',
            columnClass: 'qcPorfolioColumn',
            columns: 3
        };

        var options = $.extend(defaults, params),
            container = this,
            items = container.children('.' + options.itemsClass),
            columns = $(Array(options.columns + 1).join('<div></div>')).addClass(options.columnClass).appendTo(container),
            smallest = 0;

        for(var c = 0; c < items.length; c++){
            items.eq(c).appendTo(columns.eq(smallestCol()));
            smallest = 0;
        }

        function smallestCol(){
            for(var i = 0; i < columns.length; i++){
                smallest = (columns.eq(i).height() < columns.eq(smallest).height()) ? i : smallest;
            }
            return smallest;
        }
    }
}(jQuery));

$(function(){
    $('.qc-portfolio-x-listing').qcPortfolio({
        columns: 3
    });
});

$(function(){
    var counter=1;
    $(".qc-portfolio-x-listing li .qc-portfolio-x-item-inner").each(function (i, elt) {
        var parentHeight=$(elt).parent().height();
        var parentWidth=$(elt).parent().width();
        var topPos=(parentHeight -$(elt).height())/2;
        var leftPos=(parentWidth -$(elt).width())/2;
        var randomSize=Math.random();
        if(randomSize<0.5){
            randomSize=0.6;
        }
        //if(counter==2){
        $(elt).css({
            position:'relative',
            left: Math.floor(leftPos*Math.random()),
            top: Math.floor(topPos*Math.random()),
            transform: 'scale('+randomSize+','+randomSize+')'
        });
        //}
        counter++;
    });
});
$(document).ready(function () {
    var $animation_elements = $('.qc-portfolio-x-item-inner');
    var $window = $(window);

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($animation_elements, function () {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) &&
                (element_top_position <= window_bottom_position)) {
                $element.addClass('animation');
            } else {
                $element.removeClass('animation');
            }
        });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');
});

});
