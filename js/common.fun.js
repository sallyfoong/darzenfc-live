function isEmail(str) {
  var filter =
    /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/;
  return filter.test(str);
}
function isNumber(str) {
  var filter = /^[0-9]+$/;
  return filter.test(str);
}
function isNumberKey(evt) {
  var charCode = evt.which ? evt.which : event.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;

  return true;
}

function limitText(limitField, limitCount, limitNum) {
  if (limitField.value.length > limitNum)
    limitField.value = limitField.value.substring(0, limitNum);
  else limitCount.value = limitNum - limitField.value.length;
}

function gInputNumbersDotOnly(myfield, e) {
  var key;
  var keychar;
  if (window.event) key = window.event.keyCode;
  else if (e) key = e.which;
  else return true;
  keychar = String.fromCharCode(key);
  keychar = keychar.toLowerCase();
  // control keys
  if (key == null || key == 0 || key == 8 || key == 9 || key == 13 || key == 27)
    return true;
  // numbers
  else if ("0123456789.".indexOf(keychar) > -1) return true;
  else return false;
}
