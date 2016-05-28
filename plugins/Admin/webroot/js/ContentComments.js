var urlComment = "/Content";
var contentId = window.location.search;console.log(contentId);


$(function () {
    var Comment = function (comment) {
        var self = this;

        self.id = comment ? comment.id : 0;
        self.model = comment ? comment.model : '';
        self.foreign_key = comment ? comment.foreign_key : 0;
        self.title = comment ? comment.title : '';
        self.body = comment ? comment.body : '';
        self.status = comment ? comment.status : 0;
        self.created = comment ? comment.created : '';
        self.created_by = comment ? comment.created_by : 0;
        self.created = comment ? comment.modified : '';
        self.modified_by = comment ? comment.modified_by : 0;
    };


     var CommentCollection = function () {
        var self = this;
        
        self.comment = ko.observable(new Comment());

        $.ajax({
            url: url + '?contentId=' + contentId,
            async: false,
            dataType: 'json',
            success: function (json) {
                self.comments = ko.observableArray(ko.utils.arrayMap(json, function (comment) {
                    return new Comment(comment);
                }));
            }
        });


        self.submitComment = function () {

            $.ajax({
                type: 'POST',
                cache: false,
                url: urlContact + '/SubmitComment',
                data: JSON.stringify(ko.toJS(self.comment())),
                contentType: 'application/json; charset=utf-8',
                async: false,
                error: function (err) {
                    alert(err.responseText);
                    var err = JSON.parse(err.responseText);
                    $("<div></div>").html(errors).dialog({ modal: true, title: JSON.parse(err.responseText).Message, buttons: { "Ok": function () { $(this).dialog("close"); } } }).show();
                },
                complete: function () {
                }
            });
        };
    };

    ko.applyBindings(new CommentCollection());
});




