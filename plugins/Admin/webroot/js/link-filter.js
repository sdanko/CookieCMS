/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



   function filterLinks(types, search, url) {
       
        $('#' + types).append('<option value="content">Content</option>');
        $('#' + types).append('<option value="term">Term</option>');

           
        $('#' + search).autocomplete({

            source: function (request, response) {

                $.ajax({

                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: url + '?type=' + $('#' + types).val() + '&term=' + $('#' + search).val(),
                    //data: { type: $('#' + types).val(), term: $('#' + search).val() },
                    dataType: "json",
                    success: function (json) {
                        response($.map(json.data, function (item) {
                            return { label: item.title, value: item.slug };
                        }));

                    },

                    error: function (response) {

                    alert("Error"+response.responseText);

                    }

                });

            },

            select: function (event, ui) {
                $("#zaposlenikId").val(ui.item.id);
            }

        });

    }

 
