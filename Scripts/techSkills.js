function  validateInput(){
    var isValid = true;

    var skillName = document.getElementById('txtSkillName').value;
    var experienceYear = document.getElementById('txtYearofExperience').value;

    var experienceExp = /[0-9]+\.[0-9]+$/;

    document.getElementById('spnNameErr').innerHTML = '';
    document.getElementById('spnYearOfExpErr').innerHTML = '';

    document.getElementById('txtSkillName').style.borderColor = '';
    document.getElementById('txtYearofExperience').style.borderColor = '';

    if (skillName == "") {
        document.getElementById('txtSkillName').style.borderColor = 'red';
        document.getElementById('spnNameErr').innerHTML = 'Inseart Name of Experience';
        isValid = false;
    }

    if (experienceYear == "") {
        document.getElementById('txtYearofExperience').style.borderColor = 'red';
        document.getElementById('spnYearOfExpErr').innerHTML = 'Year of Experience';
        isValid = false;
    }

    else if (!experienceExp.test(experienceYear)) {
        document.getElementById('txtYearofExperience').style.borderColor = 'red';
        document.getElementById('spnYearOfExpErr').innerHTML = 'Please type 00.00 foemate';
        isValid = false;
    }

    return isValid;
}

var xmlhttp = null;
var base_url=window.location.protocol+"//"+window.location.host;

function InputTechnicalSkillInfo(){

    if (validateInput()) {
        var skillName = document.getElementById('txtSkillName').value;
        var experienceYear = document.getElementById('txtYearofExperience').value;
        
        xmlhttp = GetXMLHTTPObject();
        xmlhttp.open("POST", base_url+"/AddTechnicalSkill/" + skillName + "/" + experienceYear, true);
        xmlhttp.onreadystatechange = HandleTechSkillInfoResponse;
        xmlhttp.send(null);
    }

    else {
    }

    return false;
}

function HandleTechSkillInfoResponse() {
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
            if (xmlhttp.responseText != "") {
                var myString = xmlhttp.responseText;
                var mySplitResult = myString.split("#");
                AddTechSkillInfo(mySplitResult[0], mySplitResult[1]);
            }
            else {
                alert('Inserted Same Skill Twice');
            }
        }
    }
}

function AddTechSkillInfo(id, userId) {
    var table = document.getElementById('tblTecnicalSkillInfo');
    var cls = "";
    if ((table.rows.length + 1) % 2 == 1) {
        cls = "trOddMember";
    }

    var row = table.insertRow(table.rows.length);
    row.setAttribute('class', cls);

    var cell1 = row.insertCell(0);
    cell1.innerHTML = document.getElementById('txtSkillName').value;

    var cell2 = row.insertCell(1);
    cell2.innerHTML = document.getElementById('txtYearofExperience').value;

    var cell3 = row.insertCell(2);
    cell3.innerHTML = "<a href = " + "'javascript:void(0)'" + "onClick='EditInfo(" + id + ")' style='background-color:#C4CEC7; color:black;'>Edit</a>";

    var cell4 = row.insertCell(3);
    cell4.innerHTML = "<a href = " + "'javascript:void(0)'" + "onClick='DeleteInfo(" + id + "," + userId + ")' style='background-color:#C4CEC7; color:black;'>Delete</a>";

    document.getElementById('txtSkillName').value = "";
    document.getElementById('txtYearofExperience').value = "";
}

function DeleteInfo(id, userId) {
    xmlhttp = GetXMLHTTPObject();
    xmlhttp.open("POST", base_url+"/Edit/deleteTechSkill/" + id + "/" + userId, true);
    xmlhttp.onreadystatechange = HandleTSInfoAdterDeleteResponse;
    xmlhttp.send(null);
}

function HandleTSInfoAdterDeleteResponse() { 
    if (xmlhttp.readyState == 4) {
        if (xmlhttp.status == 200) {
            if(xmlhttp.responseText != ""){
                window.location = base_url + '/Edit/techInfo';
            }
        }
    }
}

function EditInfo(id) {
    window.location = base_url + "/Edit/editTechSkillInfo/" + id;
}

function goToNext(){
    window.location = base_url + '/Edit/image';
}
