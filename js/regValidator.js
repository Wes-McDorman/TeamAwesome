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
      document.getElementById("errorFName").innerHTML = "The name you entered (" + myName.value +
          ") is not in the correct form." +
          "There should only be letters.";
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
      document.getElementById("errorLName").innerHTML = "The name you entered (" + myName.value +
          ") is not in the correct form." +
          "There should only be letters.";
    return false;
}




// The event handler function for the phone number text box
function chkPhone() {
  var myPhone = document.getElementById("phone");
// Test the format of the input phone number
  var pos = myPhone.value.search(/^\d{3}-\d{3}-\d{4}$/);
  if (pos != 0) {
      document.getElementById("errorPhone").innerHTML = "The phone number you entered (" + myPhone.value +
          ") is not in the correct format." +
          "The correct form is: ddd-ddd-dddd. ";
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
      document.getElementById("errorEmail").innerHTML = "The email you entered (" + myEmail.value +
          ") is not in the correct form. \n" +
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
      document.getElementById("errorPassMatch").innerHTML = "Please check that your passwords match and try again.\n";
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
      document.getElementById("errorContactPhone").innerHTML = "The phone number you entered (" + myPhone.value +
          ") is not in the correct format." +
          "The correct form is: ddd-ddd-dddd. ";
    return false;
  } else
      document.getElementById("errorContactPhone").innerHTML = "";
    return true;
}

/*function formValidation(){
    var submitValid = false;
    if (chkName){
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
