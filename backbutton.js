function backfunction(){
    window.open("http://localhost/myntra_folder/index.php");
}
function open_email(){
    
    var state=document.getElementById("share_email_box");
    
   if(state.style.display=='none'){
      state.style.display="block"
    }else{
      state.style.display="none";
    }
  }
   