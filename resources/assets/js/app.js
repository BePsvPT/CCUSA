"use strict";

(function ($) {
    $(function() {
        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: 5
        });

        $('select').material_select();

        $.ajaxSetup({headers: {'X-XSRF-TOKEN': Cookies.get('XSRF-TOKEN')}});

        $(document).on('click', 'a[data-zinc-delete]', function () {
            if (confirm('確定要刪除？')) {
                var zinc = $(this);

                $.ajax('/zinc/manage/' + zinc.data('zinc-id'), {method: 'DELETE'})
                    .done(function () {
                        zinc.closest('tr')[0].remove();
                        Materialize.toast('刪除成功', 4000, 'green');
                    });
            }
        });

    });
})(jQuery);
