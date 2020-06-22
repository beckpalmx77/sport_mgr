function chkDigitPid(p_iPID) {
    var total = 0;
    var iPID;
    var chk;
    var Validchk;    iPID = p_iPID.replace(/-/g, "");
    Validchk = iPID.substr(12, 1);
    var j = 0;
    var pidcut;    for (var n = 0; n < 12; n++) {
        pidcut = parseInt(iPID.substr(j, 1));
        total = (total + ((pidcut) * (13 - n)));
        j++;
    }

    chk = 11 - (total % 11);

    if (chk == 10) {
        chk = 0;
    } else if (chk == 11) {
        chk = 1;
    }
    if (chk == Validchk) {
        alert("ระบุหมายเลขประจำตัวประชาชนถูกต้อง");
        return true;
    } else {
        alert("ระบุหมายเลขประจำตัวประชาชนไม่ถูกต้อง");
        return false;
    }

}