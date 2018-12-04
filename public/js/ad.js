$( "#add-image" ).click(function() {
    
        //Récupérer le numéro
        const index = +$('#widgets-counter').val();
    
        //Récupérer le prototype
        const tmpl = $('#annonce_images').data('prototype').replace(/__name__/g,index);
    
        //injecter le code au sein de la div
        $('#annonce_images').append(tmpl);
     $('#widgets-counter').val(index+1);
        //je gère lt btn supp
        handleDeleteButtons();
    
    });
    function handleDeleteButtons(){
        $('.del-btn').click(function() {
             
    const target=this.dataset.target;
    $(target).remove();
             });
    }
     function updateCounter(){
        
  const count = +$('#annonce_images .form-group').length;
 
  $('#widgets-counter').val(count);
    }
    updateCounter();
    handleDeleteButtons();