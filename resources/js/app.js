/**
 * Created by Lukas on 19.02.2015.
 */
$(function() {
    $(".rest").restfulizer({
        parse: true
    });
});


(function ($) {
    $(document).on('ready', function () {
        var sortable = $('[data-uk-sortable]');
        sortable.on('stop.uk.sortable', function (e, el, type) {
            setOrdering(sortable, el);
        });
        setOrdering(sortable);
    });
    function setOrdering(sortable, activeEl) {
        var formordering = 1;
        sortable.find('>div').each(function () {
            var ele = $(this);
            ele.find('input#sort').val(formordering);
            ele.find('div.uk-badge').text(formordering);
            formordering++;
        });
        if (activeEl) {
            activeEl.find('div.uk-badge').addClass('uk-animation-scale-down');
        }
    }
})(jQuery);