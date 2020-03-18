var in_box = document.getElementById("sign-in");
var up_box = document.getElementById("sign-up");

function InOrUp(){
    if(in_box.style.display == "block"){
        in_box.style.display = "none";
        up_box.style.display = "block";
    } else {
        in_box.style.display = "block";
        up_box.style.display = "none";
    }
}