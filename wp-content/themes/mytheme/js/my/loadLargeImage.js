// div.container-preview
( function( $ ) {
    $.fn.loadLargeImage = function( image ) {
        $( this ).find( 'a' ).click( function() {
            var srcLarge = $(this).data('url-large');
            $(image).attr('src', srcLarge);
        } );

    };
} )( jQuery );

