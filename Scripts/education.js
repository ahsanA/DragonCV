function ValidateEducationInfo() {

    var isValid = true;

    
    var degree = document.getElementById('sltDegree').value;
    var insName = document.getElementById('txtInstituteName').value;
    var pasYear = document.getElementById('txtPassingYear').value;
    var result = document.getElementById('txtResult').value;    

    var yearExp = /[1-3][0-9][0-9][0-9]$/;
    var resultExp = /[0-9]+\.[0-9]+$/;
    
    document.getElementById('spnDegreeErr').innerHTML = '';
    document.getElementById('spnResultErr').innerHTML = '';
    
    document.getElementById('txtInstituteName').style.borderColor = '';
    document.getElementById('txtPassingYear').style.borderColor = '';
    document.getElementById('txtResult').style.borderColor = '';

    if (degree == "0") {
        document.getElementById('spnDegreeErr').innerHTML = "Please Select A Degree";
        isValid = false;
    }

    if (insName == "") {
        document.getElementById('txtInstituteName').style.borderColor = 'red';
        isValid = false;
    }

    if (pasYear == "") {
        document.getElementById('txtPassingYear').style.borderColor = 'red';
        isValid = false;
    }
    else if (!yearExp.test(pasYear)) {
        document.getElementById('txtPassingYear').style.borderColor = 'red';
        isValid = false;
    }

    if (result == "") {
        document.getElementById('txtResult').style.borderColor = 'red';
        isValid = false;
    }
    else if (!resultExp.test(result)) {
        document.getElementById('txtResult').style.borderColor = 'red';
        document.getElementById('spnResultErr').innerHTML = 'Please type your result in 00.00 format';
        isValid = false;
    }  
    return isValid;
}

var xmlhttp = null;
var base_url=window.location.protocol+"//"+window.location.host;

function InputEducation() {
    
    if (ValidateEducationInfo()) {
        var degree = document.getElementById('sltDegree').value;
        var insName = document.getElementById('txtInstituteName').value;
        var pasYear = document.getElementById('txtPassingYear').value;
        var result = document.getElementById('txtResult').value;
        

        xmlhttp = GetXMLHTTPObject();
        xmlhttp.open("POST", base_url+"/AddEducation/" + degree + "/" + insName + "/" + pasYear + "/" + result, true);
        xmlhttp.onreadystatechange = HandleEduInfoResponse;
        xmlhttp.send(null);

    }
    else {
    }

    return false;
}

function HandleEduInfoResponse() {
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
            if (xmlhttp.responseText != "") {
                var myString = xmlhttp.responseText;
                var mySplitResult = myString.split("#");
                AddEducation(mySplitResult[0], mySplitResult[1]);
            }
            else {
                alert('You Cannot Have same Degree in Same year TWICE');
            }
        }
    }
}

function EditInfo(id) {
    window.location = base_url + "/Edit/editEduinfo/" + id;
}

function DeleteInfo(id, userId) {
    xmlhttp = GetXMLHTTPObject();
    xmlhttp.open("POST", base_url+"/Edit/deleteEducation/" + id + "/" + userId, true);
    xmlhttp.onreadystatechange = HandleEduInfoAdterDeleteResponse;
    xmlhttp.send(null);
}

function HandleEduInfoAdterDeleteResponse() {
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
            if(xmlhttp.responseText != ""){
                window.location = base_url + '/Edit/eduInfo';
            }
        }
    }
}

function AddEducation(id, userId) {
    var table = document.getElementById('tblDisplayEduInfo');
    var cls = "";
    if ((table.rows.length + 1) % 2 == 1) {
        cls = "trOddMember";
    }

    var row = table.insertRow(table.rows.length);
    row.setAttribute('class', cls);

    var cell1 = row.insertCell(0);
    cell1.innerHTML = document.getElementById('sltDegree').value;

    var cell2 = row.insertCell(1);
    cell2.innerHTML = document.getElementById('txtInstituteName').value;

    var cell3 = row.insertCell(2);
    cell3.innerHTML = document.getElementById('txtPassingYear').value;

    var cell4 = row.insertCell(3);
    cell4.innerHTML = document.getElementById('txtResult').value;

    var cell6 = row.insertCell(4);
    cell6.innerHTML = '<a href = "javascript:void(0)" onClick = "EditInfo(' + id + ')"  style="background-color:#C4CEC7; color:black; border:0px;">Edit</a>';

    var cell7 = row.insertCell(5);
    cell7.innerHTML = "<a href = " + "'javascript:void(0)'" + "onClick='DeleteInfo(" + id + "," + userId + ")' style='background-color:#C4CEC7; color:black; border:0px;'>Delete</a>";


    document.getElementById('sltDegree').value = "";
    document.getElementById('txtInstituteName').value = "";
    document.getElementById('txtPassingYear').value = "";
    document.getElementById('txtResult').value = "";
}

function goToNext(){
    window.location = base_url + '/Edit/techInfo';
}
