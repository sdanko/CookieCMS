/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



   function filterContent(types, search) {
       
        $('#' + types).append('<option value="content">Content</option>');
        $('#' + types).append('<option value="term">Term</option>');

           
        $('#' + search).autocomplete({

            source: function (request, response) {

                $.ajax({

                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "SearchLinks",
                    data: { type: $('#' + types), term: $('#' + search).val() },
                    dataType: "json",
                    success: function (data) {
                        response($.map(data, function (item) {
                            return { label: item.label, value: item.label, id: item.id };
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

 
