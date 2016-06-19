<script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            
            $('.navbar-toggle-sidebar').click(function () {
                    $('.navbar-nav').toggleClass('slide-in');
                    $('.side-body').toggleClass('body-slide-in');
                    $('#search').removeClass('in').addClass('collapse').slideUp(200);
            });

            $('#search-trigger').click(function () {
                    $('.navbar-nav').removeClass('slide-in');
                    $('.side-body').removeClass('body-slide-in');
                    $('.search-input').focus();
            });
            $('.tree-view ul:first').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});
        });
	
</script>