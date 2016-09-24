   function filterUsers(search, url) {  
        $('#' + search).autocomplete({

            source: function (request, response) {

                $.ajax({

                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: url + '?term=' + $('#' + search).val(),
                    //data: { type: $('#' + types).val(), term: $('#' + search).val() },
                    dataType: "json",
                    success: function (json) {
                        response($.map(json.data, function (item) {
                            return { value: item.first_name + ' ' + item.last_name, user_id: item.id};
                        }));

                    },

                    error: function (response) {

                        alert("Error"+response.responseText);

                    }

                });

            },

            select: function (event, ui) {
                $("#user_id").val(ui.item.user_id);
            }

        });

    }

 


