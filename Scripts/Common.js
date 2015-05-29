function GetXMLHTTPObject() {
    var xmlHttp = null;
    if (window.ActiveXObject) {//IE
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if (window.XMLHttpRequest) {//Other than IE
        xmlHttp = new XMLHttpRequest();
    }
    return xmlHttp;
}