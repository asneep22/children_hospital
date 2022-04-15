import $ from 'jquery';
import 'select2';
import 'daterangepicker';
import 'bootstrap';

window.$ = window.jQuery = $;
window.$ = require('jquery');
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
        "locale": {
            "format": "DD.MM.YYYY",
            "separator": " - ",
            "applyLabel": "Применить",
            "cancelLabel": "Отмена",
            "fromLabel": "От",
            "toLabel": "До",
            "customRangeLabel": "-",
            "weekLabel": "W",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Сп",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        },
      opens: 'left',
      locale: {
        format: 'YYYY'
      },
      autoUpdateInput: false,
    });
  
    $('.filter').click(function(){
      $('input[name="sort_field"]').val($(this).data('filter'));
      $('#daterange').trigger("submit");
    })
  });
  