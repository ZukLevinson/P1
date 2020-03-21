const in_box = document.getElementById("sign-in");
const up_box = document.getElementById("sign-up");
const login = document.getElementById("login");
function InOrUp(){
    sessionStorage.removeItem('Errors');
    if(in_box.style.display !== "block"){
        in_box.style.display = "none";
        up_box.style.display = "block";
    } else {
        in_box.style.display = "block";
        up_box.style.display = "none";
    }
}

login.onclick = function(){
    if (login.innerText === 'LOGIN') {
        return window.location.href = '../account/sign.php';
    } else {
        return window.location.href = '../account/account.php'
        // window.location += '?logout=yes';
    }
};

function colorRed(id){
    document.getElementById(id).style.color="Red";
}