jQuery(function($){

    // Set all variables to be used in scope
    var frame,
        container = $('.xcorts-carousel-input-container'),
        imageContainer = $('.xcorts-carousel-image-container'),
        addImgButton = $('.xcorts-carousel-change-images');
    
        var ids = [];

        container.find('input[name="xcorts_carousel[]"]').each(function(key, item){
            var id = $(item).val();
            ids.push(id);
        })


    // ADD IMAGE LINK
    addImgButton.on( 'click', function( event ){
      
      event.preventDefault();
      
      // If the media frame already exists, reopen it.
      if ( frame ) {
        frame.open();
        return;
      }
      
      // Create a new media frame
      frame = wp.media({
        title: 'Select or Upload Media Of Your Chosen Persuasion',
        button: {
          text: 'Use this media'
        },
        multiple: true  // Set to true to allow multiple files to be selected
      });


      frame.on('open',function() {

            var selections = frame.state().get('selection');
            
            ids.forEach(function(id) {
                attachment = wp.media.attachment(id);
                attachment.fetch();
                selections.add( attachment ? [ attachment ] : [] );
            });
      });
  
      
      // When an image is selected in the media frame...
      frame.on( 'select', function() {
        
        $('input[name="xcorts_carousel[]"]').remove();
        $('.xcorts-carousel-image-container > div').remove();

        var selections = frame.state().get('selection').toJSON();

       
       
        $.each(selections, function(key, selection){

            var template = $('.xcorts-caption-template > div').clone();
            
            template.children().attr('id', selection.id);
            template.find('summary').text('Imagen #'+(key+1));
            template.find('button').attr('data-id', selection.id)
            template.find('img').attr('src', selection.url)

            imageContainer.append(template);


            container.append('<input type="hidden" name="xcorts_carousel[]" value="'+selection.id+'">');
        })

      });
  
      // Finally, open the modal on click
      frame.open();
    });


    $( ".xcorts-carousel-image-container" ).on( "click", ".delete-image", function() {
        var id = $( this ).data("id");

        $("#"+id).remove();
        $(".xcorts-carousel-input-container input[value="+id+"]").remove();
    });
    
    /*
    // DELETE IMAGE LINK
    delImgLink.on( 'click', function( event ){
  
      event.preventDefault();
  
      // Clear out the preview image
      imgContainer.html( '' );
  
      // Un-hide the add image link
      addImgLink.removeClass( 'hidden' );
  
      // Hide the delete image link
      delImgLink.addClass( 'hidden' );
  
      // Delete the image id from the hidden input
      imgIdInput.val( '' );
  
    });
  */
  });