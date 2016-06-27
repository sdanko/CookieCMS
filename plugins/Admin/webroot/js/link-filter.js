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
                            return { label: item.title, value: item.title, url: item.url };
                        }));

                    },

                    error: function (response) {

                    alert("Error"+response.responseText);

                    }

                });

            },

            select: function (event, ui) {
                $("#link").val(ui.item.url);
            }

        });

    }

 
