$(function() {
    var ajaxReq = null;
    var form = $('#search-suppliers');

    $('#med_catalog').on('click',function(e){
        var q = $('#top-catalog').val();
        if (!q && q != 0) {
            swal({
                type: 'error',
                html: '請先選擇大分類',
                timer: 3000
            });
        }
    });

    $('#top-catalog').change(function() {
        var id = $('#top-catalog').val();
        console.log(id);
        var q = $('#q').val();
        // console.log(window.urlPrefix); 
        $.ajax({
            method: 'GET',
            url:'/ajax/suppliers/get-subcategories', 
            // url: window.urlPrefix + '/ajax/suppliers/get-subcategories',
            data: {'id': id}, //data傳不進去
            dataType: 'json',
            success:function(res) {
                console.log(res['data']);
                console.log(data);
                $('#meddle_catalog').empty();
                console.log(res['data']);
                if(res['data']) {
                    $('#med_catalog').removeClass('unuse');
                    $('#meddle_catalog').removeAttr('disabled');
                    $("#meddle_catalog").append($("<option></option>").attr("value", '').text('全部'));
                    var data = JSON.parse(JSON.stringify(res['data']));
                    for (var i = 0; i < data.length; i++) {
                        $("#meddle_catalog").append($("<option></option>").attr("value", data[i].id).text(data[i].name));
                    }
                } else {
                    $('#med_catalog').attr('class', 'unuse');
                    // $("#meddle_catalog").append($("<option></option>").attr("value", '').text('全部'));
                    // $('#meddle_catalog').attr('disabled', 'disabled');
                }
            }
        })

        if (id == '') {
            id = $('#id').val();
        }

        // $.ajax({
        //     method: 'GET',
        //     url: window.urlPrefix + '/ajax/search-suppliers',
        //     data: {'id': id, 'q': q},
        //     dataType: 'json',
        //     success:function(res) {
        //         $('#list_partner').html(res['data']);
        //     }
        // })
    })

    $('#meddle_catalog').change(function() {
        var form = $('#search-suppliers');
        $.ajax({
            method: 'GET',
            url: window.urlPrefix + '/ajax/search-suppliers',
            data: form.serialize(),
            dataType: 'json',
            success:function(res) {
                $('#list_partner').html(res['data']);
            }
        })
    })

    $('#q').keyup(function() {
        ajaxReq = $.ajax({
            method: 'GET',
            url: window.urlPrefix + '/ajax/search-suppliers',
            data: form.serialize(),
            dataType: 'json',
            beforeSend : function() {
                if(ajaxReq) {
                    ajaxReq.abort();
                }
            },
        })
        .done(
            function (res) { 
                $('#list_partner').html(res['data']);
            }
        )
        .always(function (data, textStatus, jqXHR ) {
            ajaxReq = null;
        });

    });

});
