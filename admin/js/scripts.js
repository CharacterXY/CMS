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

    
   
 var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    $("body").prepend(div_box);
    $('#load-screen').delay(500).fadeOut(800, function(){
        $($this).remove();
    }); 

    


});


$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkedComments').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkedComments').each(function(){
                this.checked = false;
            });
        }
    });
});


function loadUsersOnline(){

    $.get("functions.php?onlineusers=result", function(data){
        $(".usersonline").text(data);
    });
}

setInterval(function(){

loadUsersOnline();

}, 1000);






