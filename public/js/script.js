$(document).ready(function () {

  $('.js-select').select2({
    tags: true,
    language: "ru",
    dropdownParent: document.body,
  });

  $('.modal').on('shown.bs.modal', function () {
    $(this).find('.js-select').select2({
      tags: true,
      dropdownParent: $(this).find('.modal-content'),
      language: "ru",
    });
  })

  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'));
    $('#daterange').trigger("submit");
    
  });

  $('input[name="daterange"]').on('cancel.daterangepicker', function() {
    $('input[name="daterange"]').val('');
    $('#daterange').trigger("submit");
  });

  $('input[name="daterange"]').daterangepicker({
    opens: 'left',
    locale: {
      format: 'DD.MM.YYYY'
    },
    autoUpdateInput: false,
  });

  $('.filter').click(function(){
    $('input[name="sort_field"]').val($(this).data('filter'));
    $('#daterange').trigger("submit");
  })
});
