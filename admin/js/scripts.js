  $(document).ready(function(){

    //EDITOR
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .then( editor => {
        console.log( editor );
    })
    .catch( error => {
        console.error( error );
    });

    //REST OF CODE

}); 
 
  $(document).ready(function(){

    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });

        }
    });
});  