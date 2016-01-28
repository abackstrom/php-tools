(function($) {

var prev_expression,
    $solution = $('.math-solution');

$(document).on('focus', '.math-expression', function(e) {
    $solution.slideDown();
});

$(document).on('keyup', '.math-expression', function(e) {
    var expression = $(this).val().trim();

    $solution.removeClass('error');

    try {
        $solution.val(math.eval(expression));
    } catch (e) {
        $solution.addClass('error');
        $solution.val("Error: " + e.message);
    }
});

})(jQuery);
