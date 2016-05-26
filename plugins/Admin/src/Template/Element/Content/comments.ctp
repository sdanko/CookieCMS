
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
                                <textarea class="form-control" rows="3" data-bind='value: Body'></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-reply"></i> <?=  __d('admin','Submit')?></button>
                        </form>
                    </div>

                    <hr/>

                    <!-- the comments -->
                    <div id="accordion" data-bind="foreach: comments">
                            <h3><i class="fa fa-comment"></i> <span data-bind="text:CreatedBy"></span>
                                <small data-bind="text:Created"></small>
                            </h3>
                          <p data-bind="text:Body"></p>
                    </div>
                    
                    <h3><i class="fa fa-comment"></i> User One says:
                        <small> 9:41 PM on August 24, 2014</small>
                    </h3>
                    <p>Excellent post! Thank You the great article, it was useful!</p>

                    <h3><i class="fa fa-comment"></i> User Two says:
                        <small> 9:47 PM on August 24, 2014</small>
                    </h3>
                    <p>Excellent post! Thank You the great article, it was useful!</p>
                    
                </div>
            </div>
          </div>
        </div>
    </div>


