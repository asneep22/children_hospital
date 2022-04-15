import $ from 'jquery';
import 'select2';
import 'daterangepicker';
import 'bootstrap';
const axios = require('axios').default;

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
    $('.forlink').on("click",function(){
      window.location.href=$(this).prop("href");
    });
  
    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      $('input[name="'+$(this).data("field")+'"]').val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'))
      $('#search').trigger("submit");
    });
    $('.daterange').on('cancel.daterangepicker', function() {
      $('input[name="'+$(this).data("field")+'"]').val('');
      $('#search').trigger("submit");
    });
    $('.selectform').on("change",function(){
        $('input[name="'+$(this).data("field")+'"]').val($(this).val());
      $('#search').trigger("submit");
    });
  
    $('.daterange').daterangepicker({
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
      autoUpdateInput: false,
    });
  
    $('.filter').on("click",function(){
        
      $('input[name="sort_field"]').val($(this).data('filter'));
      $('#search').trigger("submit");
      return false;
    })

    $(".collapse").on('show.bs.collapse', function () {
      // console.log ($(this).data("id"));
      var id=$(this).data("id");
      axios.post('/pacientone', {
          user_id: id
      })
      .then(function (response) {
        let data=response.data.data;
        console.log(data);
        $(`#accordion${id} td`).html(JSON.stringify(data));
      })
      .catch(function (error) {
        console.log(error);
      })
      .then(function () {
        // always executed
      });  
    

    })
  });
  