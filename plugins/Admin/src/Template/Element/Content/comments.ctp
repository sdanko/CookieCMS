
    <div class="row">
        
        <hr/>
        
        <div class="panel-group">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse-comments">Comments</a>
              </h4>
            </div>
            <div id="collapse-comments" class="panel-collapse collapse">
                <div class="panel-body">
                    <!-- the comment box -->
                    <div class="well">
                        <h4><i class="fa fa-paper-plane-o"></i> <?=  __d('admin','Leave a Comment')?>:</h4>
                        <form role="form">
                            <div class="form-group" data-bind='with: comment'>
<!--                                <textarea class="form-control" rows="3" data-bind='value: body'></textarea>-->
                                <input class="form-control" data-bind='wysiwyg : body' />
                            </div>
                            <button type="button" class="btn btn-primary" data-bind='click: submitComment'><i class="fa fa-reply"></i> <?=  __d('admin','Submit')?></button>
                        </form>
                    </div>

                    <hr/>

                    <!-- the comments -->
                    <div id="accordion" data-bind="foreach: comments">
                            <h3><i class="fa fa-comment"></i> 
                                <span data-bind="text:first_name"></span>
                                <span data-bind="text:last_name"></span>:
                                <small data-bind="text:created"></small>
                            </h3>
                          <p data-bind="text:body"></p>
                    </div>
                    
                </div>
            </div>
          </div>
        </div>
    </div>


