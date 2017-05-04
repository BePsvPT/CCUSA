$(function() {
  // form - date input tag
  $('.datepicker').pickadate({selectMonths: true, selectYears: 1})

  // form - select tag
  $('select').material_select()

  // side-nav
  $(".button-collapse").sideNav()

  // slider
  $('.slider').slider({
    height: 450
  })
})

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
  }
})

$(document).on('click', 'a[data-delete]', function () {
  if (confirm('確定要刪除？')) {
    const target = $(this)

    $.ajax(target.data('url'), { method: 'DELETE' })
      .done(function () {
        if (target.data('delete').length > 0) {
          target.closest(target.data('delete'))[0].remove()
        }

        Materialize.toast('刪除成功', 4000, 'green')
      })
  }
});

if (null !== document.querySelector('.tinymce-editor')) {
  tinymce.init({
    selector: '.tinymce-editor',
    language: 'zh_TW',
    height: 250,
    menubar: false,
    plugins: [
      'advlist autolink lists link charmap preview',
      'searchreplace fullscreen',
      'table paste'
    ],
    toolbar: 'searchreplace paste undo redo | styleselect | bold italic | bullist numlist outdent indent | table link charmap | preview fullscreen',
  });
}

// GA
(function(i, s, o, g, r, a, m) {
  i['GoogleAnalyticsObject'] = r
  i[r] = i[r] || function() {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date()
  a = s.createElement(o), m = s.getElementsByTagName(o)[0]
  a.async = 1
  a.src = g
  m.parentNode.insertBefore(a, m)
})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga')
ga('create', 'UA-65962475-3', 'auto')
ga('send', 'pageview')
