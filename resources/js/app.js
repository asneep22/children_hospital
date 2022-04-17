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
      dropdownParent: document.body,
    });
  
    $('.modal').on('shown.bs.modal', function () {
      $(this).find('.js-select').select2({
        tags: true,
        dropdownParent: $(this).find('.modal-content'),
        language: "ru",
      });
    });
  });
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
    });

    function Export2Word(element, filename = ''){
      let style= "<style>table{width:100%;border-collapse:collapse}th, td{border:1px solid #000;}</style>";
      let preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title>"+style+"</head><body>";
      let postHtml = "</body></html>";
      
      var html = preHtml+document.getElementById(element).innerHTML+postHtml;
  
      var blob = new Blob(['\ufeff', html], {
          type: 'application/msword'
      });
      
      var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
      
      filename = filename?filename+'.doc':'document.doc';
      
      var downloadLink = document.createElement("a");
  
      document.body.appendChild(downloadLink);
      
      if(navigator.msSaveOrOpenBlob ){
          navigator.msSaveOrOpenBlob(blob, filename);
      }else{
          downloadLink.href = url;
          downloadLink.download = filename;
          downloadLink.click();
      }
      
      document.body.removeChild(downloadLink);
  }
    $('.exportword').on("click",async function(){
      Export2Word(`lk${$(this).data('id')}`,$(this).data('name'));
      return false;
    });

    $(".collapse").on('show.bs.collapse', function () {
      
      console.log ($(this).data("id"));
      var id=$(this).data("id");
      axios.get(`/pacientone/${id}`)
      .then(function (response) {
        // let data=response.data.data;
        console.log(response);
        $(`#accordion${id} td .preload`).html(response.data);
      })
      .catch(function (error) {
        console.log(error);
      })
      .then(function () {
        // always executed
      });  
    

    })
  
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
  });

  $('.switch_tables_btn').on("click", function(){
    let all = $(".switch_tables_btn").map(function() {
      return this.name;
    }).get();
    all.forEach((item, i) => {
      $('#' + item).hide();
    });
    $('#' + this.name).toggle();
  })
});
