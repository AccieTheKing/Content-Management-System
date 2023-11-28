const usernameField = document.querySelector("[name=txtfieldUsername]");
const passwordField = document.querySelector("[name=txtfieldPassword]");
const loginButton = document.querySelector(".loginButton");
const successColor = "#008000";
const errorColor = "#008000";

loginButton.addEventListener("click", function (e) {

  checkFields(usernameField);
  checkFields(passwordField);

});

usernameField.addEventListener("keyup", function () {
  checkFields(this);
});

passwordField.addEventListener("keyup", function () {
  checkFields(this);
});

/**
 * Gives the fields errorstyling
 * 
 * @param {*} field 
 * @param {*} boolean 
 */
function errorStyle(field, boolean) {

  if (boolean) {
    field.classList.add("is-invalid");
    loginButton.innerHTML = "Check all fields!";
  }
  else {
    field.classList.remove("is-invalid");
    loginButton.innerHTML = "Login";
  }

}

/**
 * checks if the field is empty 
 * 
 * @param {*} fieldObject 
 */
function checkFields(fieldObject) {

  if (fieldObject.value.length > 0 && fieldObject.value != "") {

    errorStyle(fieldObject, false);

    return true;
  }

  errorStyle(fieldObject, true);

  return false;
}