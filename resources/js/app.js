import $ from 'jquery';
import 'select2';
import 'daterangepicker';
import 'bootstrap';
import toastr from 'toastr';
const axios = require('axios').default;

window.$ = window.jQuery = $;
window.$ = require('jquery');
$(function () {

    $('.js-select').select2({
        tags: true, theme: "bootstrap-5", language: "ru",
        // dropdownParent: document.body,
        dropdownParent: $('#home')
    });
    $('.js-select2').select2({
        tags: true, theme: "bootstrap-5", language: "ru",
        // dropdownParent: document.body,
        dropdownParent: $('#contact')
    });
    $('.js-select3').select2({
        tags: true, theme: "bootstrap-5", language: "ru",
        // dropdownParent: document.body,
        dropdownParent: $('#profile')
    });

    $("#reset").on("click", function(){
        window.location = window.location.href.split("?")[0];
    });

    $.date = function(dateObject) {
        var d = new Date(dateObject);
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = day + "." + month + "." + year;
    
        return date;
    };
    
    $("body").on("click",".ads",function(){
        $("#userid").val('');
    });

    $("#lastname,#pname,#surname").on("keyup", function() {

        var text = $(this).val(); 
        var new_text = text.charAt(0).toUpperCase() + text.substr(1);

        $(this).val(new_text);

    });

    $("body").on("click",".editpacient",function(){
    
        axios.get(`/fulldata/${$(this).data("id")}`).then(function (response) {
           let data=response.data;
           $("#lastname").val(data.lastname);
           $("#pname").val(data.pname);
           $("#surname").val(data.surname);
           $("#recommend").val(data.recommend);
           $("#rost").val(data.rost);
           $("#ves").val(data.ves);
           $("#gestaci").val(data.gestaci);
           $("#address").val(data.address);
           $("#userid").val(data.id);
           
           $("#birthday").val(data.birthday1);
           $("#date_add").val(data.date_add1);
           $("#uchastok_id").val(data.uchastok_id).trigger('change');
           $("#roddom_id").val(data.roddom_id).trigger('change');
           $("#vacines").val(data.vac).trigger('change');
           if(data.audio)
           $('input[name="audio"]').prop("checked",true);
           if(data.gepatitb)
           $('input[name="gepatitb"]').prop("checked",true);
           if(data.bcjm)
           $('input[name="bcjm"]').prop("checked",true);
           if(data.vich)
           $('input[name="vich"]').prop("checked",true);
           if(data.gepatit)
           $('input[name="gepatit"]').prop("checked",true);
           if(data.recepient)
           $('input[name="recepient"]').prop("checked",true);
           $('#skrinning option[value="'+data.skrinning+'"]').prop('selected', true);
        
           $('#pol option[value="'+data.pol+'"]').prop('selected', true);
           if(data.gruppasvs)
           $('input[name="gruppasvs"]').prop("checked",true);
           $("#tableforperiod #inp").html('');
           $("#tableforperiod tbody").html('');

           data.st.forEach(e=>{
            $("#tableforperiod #inp").append(`<input id="equal${$("#tableforperiod tbody tr").length}" type="hidden" name="di[]" value='${JSON.stringify(e)}'>`)
            $("#tableforperiod tbody").append(`<tr><td>${e.vid}</td><td>${e.pac_stacionar_id}</td><td>${e.date_in1} - ${e.date_ou1}</td><td>${e.pac_diagnoz.join(", ")}</td><td>${e.pac_recommends}</td><td><button type="button" class="btn btn-sm btn-danger removetr" data-line="${$("#tableforperiod tbody tr").length}">-</td></tr>`);
             

           })
            // console.log(response);
            console.log(response);
        }).catch(function (error) {
            console.log(error);
        }).then(function () { // always executed
        });
        // $("#tableforperiod #inp").find("#equal"+$(this).data("line")).remove();
        // $(this).parent().parent().remove();
    });

    $("#successaddperiod").on("click",function(){
        let vid=$("#profile #vid").val();
        let pac_stacionar_id=$("#profile #pac_stacionar_id").val();
        let pac_diagnoz=$("#profile #pac_diagnoz").val();
        let pac_recommends=$("#profile #pac_recommends").val();
        let items = [];
        items.push(pac_diagnoz);
        let pac_date_in=$("#profile #pac_date_in").val();
        let pac_date_ou=$("#profile #pac_date_ou").val();
        if(!vid||!pac_date_in||!pac_date_ou){
             
            toastr.warning('Заполните поля!');

            return false;
        }
        let obj={vid: vid,pac_stacionar_id:pac_stacionar_id,pac_diagnoz: items,pac_recommends:pac_recommends,pac_date_in:pac_date_in,pac_date_ou:pac_date_ou};
        $("#tableforperiod #inp").append(`<input id="equal${$("#tableforperiod tbody tr").length}" type="hidden" name="di[]" value='${JSON.stringify(obj)}'>`)
        $("#tableforperiod tbody").append(`<tr><td>${vid}</td><td>${pac_stacionar_id}</td><td>${$.date(pac_date_in)} - ${$.date(pac_date_ou)}</td><td>${items.join(", ")}</td><td>${pac_recommends}</td><td><button type="button" class="btn btn-sm btn-danger removetr" data-line="${$("#tableforperiod tbody tr").length}">-</td></tr>`);

    })
    $("body").on("click",".removetr",function(){
        $("#tableforperiod #inp").find("#equal"+$(this).data("line")).remove();
        $(this).parent().parent().remove();
    });
    $("body").on("click",".deletepacient",function(){
        if(confirm("Уверены???")){return true;}{return false;}
    });
    

    // удаляем поля которые пустые из GET
    $("#search").on("submit", function () {
        $(this).find(":input").filter(function () {
            return !this.value;
        }).attr("disabled", "disabled");
        return true;
    });

    $('.forlink').on("click", function () {
        window.location.href = $(this).prop("href");
    });
    $('.dateranger,.daterangerreport,.daterangerreport1').daterangepicker({
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
        drops: "auto",
        autoUpdateInput: false
    });

    $('.dateranger').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD.MM.YYYY') + ' - ' + picker.endDate.format('DD.MM.YYYY'))
        // $('#search').trigger("submit");
    });
    $('.daterangerreport').on('apply.daterangepicker', function (ev, picker) {
        window.open('/report_nedo/' + picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format('YYYY-MM-DD'), '_blank');
        $("#closewin").click();
    });
    $('.daterangerreport1').on('apply.daterangepicker', function (ev, picker) {
        window.open('/report_analiz/' + picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format('YYYY-MM-DD'), '_blank');
        $("#closewin1").click();
    });


    $('.dateranger').on('cancel.daterangepicker', function () {
        $('input[name="' + $(this).data("field") + '"]').val('');
        $('#search').trigger("submit");
    });

    $('.filter').on("click", function () {

        $('input[name="sort_field"]').val($(this).data('filter'));
        $('#search').trigger("submit");
        return false;
    });
    $(".deletespr").on("click", function () {
        let t = $(this).parent();
        axios.post(`/`+$(this).data("name"), {id: t.find('input[name="id"]').val()}).then(function (info) {

            if (info.data == "success") {
                toastr.success('Успешно удалено');
                t.remove();
            } else {
                toastr.warning('Ошибка удаления! Эта запись используется у пациентов');
            }
        }).catch(function (error) {
            toastr.warning('Ошибка удаления! Эта запись используется у пациентов');
            console.log(error);
        }).then(function () {});
        return false;
    });

    $(".uchastokSuccess,.roddomSuccess,.stacionarSuccess,.vacineSuccess,.boleznSuccess").on("submit", function () {
        axios.post(`/`+$(this).data("name"), $(this).serialize()).then(function () {
            toastr.success('Успешно обновлено');
        }).catch(function (error) {
            toastr.warning('Ошибка обновления');
            console.log(error);
        }).then(function () { // always executed
        });
        return false;
    });

    $("#formsavepoliclinic").on("submit", function () {

        axios.post(`/savepoliclinic`, $(this).serialize()).then(function (success) {
            toastr.success('Успешно обновлено');
            $("#closewin2").click();
        }).catch(function (error) {
            toastr.danger('Ошибка обновления');
            console.log(error);
        }).then(function () { // always executed
        });

        return false;
    });

    function Export2Word(element, filename = '') {
        let style = "<style>table{width:100%;border-collapse:collapse}th, td{border:1px solid #000;}</style>";
        let preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title>" + style + "</head><body>";
        let postHtml = "</body></html>";

        var html = preHtml + document.getElementById(element).innerHTML + postHtml;

        var blob = new Blob([
            '\ufeff', html
        ], {type: 'application/msword'});

        var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

        filename = filename ? filename + '.doc' : 'document.doc';

        var downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            downloadLink.href = url;
            downloadLink.download = filename;
            downloadLink.click();
        }

        document.body.removeChild(downloadLink);
    }
    $('.exportword').on("click", async function () {
        Export2Word(`lk${
            $(this).data('id')
        }`, $(this).data('name'));
        return false;
    });

    $(".collapse.pacient").on('show.bs.collapse', function () {

        console.log($(this).data("id"));
        var id = $(this).data("id");
        axios.get(`/pacientone/${id}`).then(function (response) {
            // let data=response.data.data;
            // console.log(response);
            $(`#accordion${id} td .preload`).html(response.data);
        }).catch(function (error) {
            console.log(error);
        }).then(function () { // always executed
        });


    })

    $('.selectform').on("change", function () {
        $('input[name="' + $(this).data("field") + '"]').val($(this).val());
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
        autoUpdateInput: false
    });

    $('.filter').on("click", function () {

        $('input[name="sort_field"]').val($(this).data('filter'));
        $('#search').trigger("submit");
        return false;
    });

    $('.switch_tables_btn').on("click", function () {
        let all = $(".switch_tables_btn").map(function () {
            return this.name;
        }).get();
        all.forEach((item, i) => {
            $('#' + item).hide();
        });
        $('#' + this.name).toggle();
    })
});
