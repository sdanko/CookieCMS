var urlComment = "/Content";
var contentId = window.location.search;


$(function () {
    var Comment = function (comment) {
        var self = this;

        self.ContentId = comment ? comment.ContentId : contentId;
        self.Body = comment ? comment.Body : '';
        self.Created = comment ? comment.Created : '';
        self.CreatedBy = comment ? comment.CreatedBy : '';
    };


     var CommentCollection = function () {
        var self = this;
        
        self.comment = ko.observable(new Comment());

        $.ajax({
            url: urlComment + '/GetComments' + '?contentId=' + contentId,
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




