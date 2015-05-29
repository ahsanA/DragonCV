function ValidateSignUp() {
    var isValid = true;
    var emailExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    var nameExp = /[a-zA-Z]+$/;

    var email = document.getElementById('txtEmail').value;
    var pass = document.getElementById('txtPassword').value;
    var conPass = document.getElementById('txtConfirmPassword').value;
    var scrName = document.getElementById('txtScreenName').value;

    document.getElementById('txtEmail').style.borderColor = '';
    document.getElementById('txtPassword').style.borderColor = '';
    document.getElementById('txtConfirmPassword').style.borderColor = '';
    document.getElementById('txtScreenName').style.borderColor = '';

    document.getElementById('spnEmailErrMsg').innerHTML = '';
    document.getElementById('spnConfarmPaaErrMgs').innerHTML = '';
    document.getElementById('spnScrNameErrMsg').innerHTML = '';

    if (email == "") {
        document.getElementById('txtEmail').style.borderColor = 'red';
        isValid = false;
    }
    else if (!emailExp.test(email)) {
        document.getElementById('txtEmail').style.borderColor = 'red';
        document.getElementById('spnEmailErrMsg').innerHTML = 'Please enter a valid email';
        isValid = false;
    }

    if (pass == "") {
        document.getElementById('txtPassword').style.borderColor = 'red';
        isValid = false;
    }

    if (conPass == "") {
        document.getElementById('txtConfirmPassword').style.borderColor = 'red';
        isValid = false;
    }
    else if (pass != conPass) {
        document.getElementById('txtConfirmPassword').style.borderColor = 'red';
        document.getElementById('spnConfarmPaaErrMgs').innerHTML = 'Password mismatched';
        isValid = false;
    }

    if (scrName == "") {
        document.getElementById('txtScreenName').style.borderColor = 'red';
        isValid = false;
    }
    else if (!nameExp.test(scrName)) {
        document.getElementById('txtScreenName').style.borderColor = 'red';
        document.getElementById('spnScrNameErrMsg').innerHTML = 'Characters Only';
        isValid = false;
    }
    return isValid;
}

var xmlhttp = null;
var base_url=window.location.protocol+"//"+window.location.host;

function SignUp(){
    if(ValidateSignUp()){
        var email = document.getElementById('txtEmail').value;
        var pass = document.getElementById('txtPassword').value;
        var scrName = document.getElementById('txtScreenName').value;
    
        xmlhttp = GetXMLHTTPObject();
        //alert(base_url+"/signUp/" + email + "/" + pass + "/" + scrName);
        xmlhttp.open("POST", base_url+"/signUp/" + email + "/" + pass + "/" + scrName, true);
        xmlhttp.onreadystatechange = HandleSignUnResponse;
        xmlhttp.send(null);
    }
}

function HandleSignUnResponse(){
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
            if (xmlhttp.responseText != "" ) {                
                window.location = base_url + "/thankYou/system";
            }
            else {
                //alert('Problem Occured');
            }
        }
    }
}

function IsValidSigninInfo() {

    var isValid = true;
    var email = document.getElementById('txtLoginEmail').value;
    var pass = document.getElementById('txtLoginPassword').value;

    var emailExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;

    if (email == "") {
        massage += "email field required\n";
        isValid = false;
    }
    else if (!emailExp.test(email)) {
        massage += "invalid email\n";
        isValid = false;
    }

    if (pass == "") {
        massage += "Password field required\n";
        isValid = false;
    }

    return isValid;

}



function ProcessLogin() {

    if (IsValidSigninInfo()) {
        var email = document.getElementById('txtLoginEmail').value;
        var pass = document.getElementById('txtLoginPassword').value;

        xmlhttp = GetXMLHTTPObject();
        //xmlhttp.open("GET", "Ajax.aspx?func=login&email=" + email + "&pass=" + pass, true);
        xmlhttp.open("POST", base_url+"/signIn/" + email + "/" + pass, true);
        xmlhttp.onreadystatechange = HandleSignInResponse;
        xmlhttp.send(null);
    }
    else {
    //show alert
    }
}

function HandleSignInResponse() {
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
            if (xmlhttp.responseText == 1) {                
		window.location = base_url+"/rout/" ;
            }
            else {
                //alert('Access Denied');
            }
        }
    }
}
