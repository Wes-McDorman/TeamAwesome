// validator.js
//   An example of input validation using the change and submit 



//   events
// The event handler function for the name text box
function chkFName() {
  var myName = document.getElementById("fName");
// Test the format of the input name 
  var pos = myName.value.search(/^[A-z]$/);

if (pos === 0) {
    document.getElementById("errorFName").innerHTML = "";
    return true; 
  } else
      document.getElementById("errorFName").innerHTML = myName.value +
 
          " - Warning: Letters only.";
    return false;
}


function chkLName() {
  var myName = document.getElementById("lName");
// Test the format of the input name 
  var pos = myName.value.search(/^[A-z]$/);

if (pos === 0) {
    document.getElementById("errorLName").innerHTML = "";
    return true; 
  } else
      document.getElementById("errorLName").innerHTML =  myName.value +
            " - Warning: Letters only.";
    return false;
}




// The event handler function for the phone number text box
function chkPhone() {
  var myPhone = document.getElementById("inputPhone");
// Test the format of the input phone number
  var pos = myPhone.value.search(/^\d{3}-\d{3}-\d{4}$/);
  if (pos != 0) {
      document.getElementById("errorPhone").innerHTML = "The phone number you entered (" + myPhone.value +
          ") is not in the correct format." +
          "The expected format is: ddd-ddd-dddd. ";
    return false;
  } else
      document.getElementById("errorPhone").innerHTML = "";
    return true;
}


// The event handler function for the email text box
function chkEmail() {
  var myEmail = document.getElementById("email");
// Test the format of the input phone number
  var emailRegEx =  /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if (!(myEmail.value.match(emailRegEx))) {
      document.getElementById("errorEmail").innerHTML = myEmail.value +
          " - Error:\n" +
          "The correct form is: xxx@xxx.xxx \n";
    
    return false;
  } else
      document.getElementById("errorEmail").innerHTML = "";
    return true;
}

function chkEmailMatch() {
  var myEmail = document.getElementById("email");
  var myEmail2 = document.getElementById("email2");
  if (!(myEmail2.value.match(myEmail.value))) {
      document.getElementById("errorEmailMatch").innerHTML = "The email you entered (" + myEmail2.value +
          ") does not match  (" + myEmail.value +
          ")\n";
    document.getElementById("email2").focus();
    return false;
  } else
     document.getElementById("errorEmailMatch").innerHTML = "";
    return true;
}

function chkPasswordMatch() {
  var myPass = document.getElementById("password");
  var myPass2 = document.getElementById("password2");
  if (!(myPass2.value.match(myPass.value))) {
      document.getElementById("errorPassMatch").innerHTML = "Error: Password does not match.\n";
    document.getElementById("password").focus();
    return false;
  } else
      document.getElementById("errorPassMatch").innerHTML = "";
    return true;
}

function chkContactPhone() {
  var myPhone = document.getElementById("contactPhone");
// Test the format of the input phone number
  var pos = myPhone.value.search(/^\d{3}-\d{3}-\d{4}$/);
  if (pos != 0) {
      document.getElementById("errorContactPhone").innerHTML = myPhone.value +

          " - The expected form is: ddd-ddd-dddd. ";
    return false;
  } else
      document.getElementById("errorContactPhone").innerHTML = "";
    return true;
}

function chkZip() {
    var zip = document.getElementById("zip");
    var isValidZip = /(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip.value);
    
      if (isValidZip != 0) {
      document.getElementById("errorZip").innerHTML =  zip.value +" is not in the correct format." ;
    return false;
  } else
      document.getElementById("errorZip").innerHTML = "";
    return true;
}



/*function formValidation(){
    var submitValid = false;
    if (chkFName){
        if(chkEmail){
            if(chkEmailMatch){
                if(chkPhone){
                    if(chkPasswordMatch){
                        submitValid = true;
                    }
                }
            }
        }
    }
   return submitValid; 
}*/
