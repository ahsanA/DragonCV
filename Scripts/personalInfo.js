function fieldValidate() {

    document.getElementById("dvNameErrCOl").innerHTML = "";
    document.getElementById("dvFatherNameErrCOl").innerHTML = "";
    document.getElementById("dvMotherNameErrCOl").innerHTML = "";
    document.getElementById("dvPermanentAddressErrCOl").innerHTML = "";
    document.getElementById("dvGenderErrCol").innerHTML = "";
    document.getElementById("dvReligionErrCol").innerHTML = "";
    document.getElementById("dvBldGrpErrCol").innerHTML = "";
    document.getElementById("dvPhnErrCol").innerHTML = "";
    document.getElementById("dvCrObjErrCol").innerHTML = "";
    document.getElementById("dvRef1ErrCol").innerHTML = "";
    document.getElementById("dvRef2ErrCol").innerHTML = "";

    var name = document.getElementById("txtName").value;
    var fatherName = document.getElementById("txtFatherName").value;
    var motherName = document.getElementById("txtMotherName").value;
    var permanentAddress = document.getElementById("txtPermanentAddress").value;
    var phone = document.getElementById("txtPhone").value;
    var radios = document.getElementsByName('gender');
    var religion = document.getElementById("relegion").value;
    var bGroup = document.getElementById("bloodGroup").value;
    var careerObj = document.getElementById("txtCrObj").value;
    var ref1 = document.getElementById("txtRef1").value;
    var ref2 = document.getElementById("txtRef2").value;
    var flag = 0;
    var isValid = true;

    var nameExp = /[a-zA-Z]+$/;
    var phoneExp = /[0-9]+$/;
    //var emailExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;


    if (name == "") {
        document.getElementById("dvNameErrCOl").innerHTML = "Please Enter Your Name";
        isValid = false;
    }
    else if (!nameExp.test(name)) {
        document.getElementById("dvNameErrCOl").innerHTML = "Please Enter Characters ONLY";
        isValid = false;
    }


    if (fatherName == "") {
        document.getElementById("dvFatherNameErrCOl").innerHTML = "Please Enter Your Father's Name";
        isValid = false;
    }
    else if (!nameExp.test(fatherName)) {
        document.getElementById("dvFatherNameErrCOl").innerHTML = "Please Enter Characters ONLY";
        isValid = false;
    }



    if (motherName == "") {
        document.getElementById("dvMotherNameErrCOl").innerHTML = "Please Enter Your Mother's Name";
        isValid = false;
    }
    else if (!nameExp.test(motherName)) {
        document.getElementById("dvMotherNameErrCOl").innerHTML = "Please Enter Characters ONLY";
        isValid = false;
    }

    if (religion == 0) {
        document.getElementById("dvReligionErrCol").innerHTML = "Please Select Your Religion";
        isValid = false;
    }


    if (bGroup == "null") {
        document.getElementById("dvBldGrpErrCol").innerHTML = "Please Select Your Blood Group";
        isValid = false;
    }


    if (permanentAddress == "") {
        document.getElementById("dvPermanentAddressErrCOl").innerHTML = "Please Enter Your Permanent Address";
        isValid = false;
    }

    if (phone == "") {
        document.getElementById("dvPhnErrCol").innerHTML = "Please Enter Your Phone";
        isValid = false;
    }
    else if (!phoneExp.test(phone)) {
        document.getElementById("dvPhnErrCol").innerHTML = "Please Enter numbers ONLY";
        isValid = false;
    }

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            flag = 1;
            break;
        }
    }
    if (flag == 0) {
        document.getElementById("dvGenderErrCol").innerHTML = "Please Select Your Gender";
        isValid = false;
    }

    if (careerObj == "") {
        document.getElementById("dvCrObjErrCol").innerHTML = "Please Write your Career Objective";
        isValid = false;
    }

    if (ref1 == "") {
        document.getElementById("dvRef1ErrCol").innerHTML = "Refference Required";
        isValid = false;
    }

    if (ref2 == "") {
        document.getElementById("dvRef2ErrCol").innerHTML = "Refference Required";
        isValid = false;
    }

    return isValid;
}