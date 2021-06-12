document.onkeydown = function(evt) {
    evt = evt || window.event;
    var isEscape = false;
    //alert(evt.keyCode);
    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc");
    } else {
        isEscape = (evt.keyCode === 27);
    }
    if (isEscape) {
        var r=confirm("กลับไปหน้าแรก");
        if(r==true)
        {
            location.href="menuPage.php";
        }
        
    }
};