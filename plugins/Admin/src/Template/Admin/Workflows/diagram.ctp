<?php
    echo $this->Html->script('/GraphMLViewer/GraphMLViewer.js');
?>


<script type="text/javascript" language="javascript">
<!--
    if (!RunPlayer(
        "width", "100%",
        "height", "500",  //Internet Explorer may interpret relative sizes in tables as 0
       //"graphURL", "http://cmscookie.azurewebsites.net/webroot/GraphMLViewer/graphs/news.graphml",
        "graphURL", "<?= $path; ?>",
        "overview", "true",
        "toolbar", "false",
        "tooltips", "true",
        "movable", "true",
        "links", "true",
        "linksInNewWindow", "true",
        "viewport", "full"
        )) {
        document.write("Cannot start GraphMLViewer!");
    }
//-->
</script>