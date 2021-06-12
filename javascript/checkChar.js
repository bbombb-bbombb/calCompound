function checkChar(evt) {
    var char = event.which || event.keyCode ;
  if(char==47 ||char==39 || char==92 || char==34 || char==96 || char==13){
    return false;
  }
}