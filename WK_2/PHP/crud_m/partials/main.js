<script>
    // Defining a function to display error message
    function printError(elemId, hintMsg) {
        document.getElementById(elemId).innerHTML = hintMsg;
    }
// Defining a function to validate form 
function validateForm() {
    // Retrieving the values of form elements 
    var name = document.contactForm.name.value;
    var email = document.contactForm.email.value;
    var gender = document.contactForm.gender.value;
    var qua =  [];
    var hob =  document.contactForm.hob.value;

    var checkboxes = document.getElementsByName("qua[]");
    for(var i=0; i < checkboxes.length; i++) {
        if(checkboxes[i].checked) {
            // Populate qua array with selected values
            qua.push(checkboxes[i].value);
        }
    }

    var nameErr = emailErr = genderErr = quaErr = hobErr = true;

    if(name == "") {
        printError("nameErr", "Please enter your name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;                
        if(regex.test(name) === false) {
            printError("nameErr", "Please enter a valid name");
        } else {
            printError("nameErr", "");
            nameErr = false;
        }
    }


     // Validate email address
     if(email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if(regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else{
            printError("emailErr", "");
            emailErr = false;
        }
    }

     // Validate gender
     if(gender == "") {
        printError("genderErr", "Please select your gender");
    } else {
        printError("genderErr", "");
        genderErr = false;
    }

     // Validate gender
     if(qua == "") {
        printError("quaErr", "Please select your Qua");
    } else {
        printError("quaErr", "");
        quaErr = false;
    }
    
  // Validate hob
  if(hob == "") {
        printError("hobErr", "Please select your hob");
    } else {
        printError("hobErr", "");
        hobErr = false;
    }



// Prevent the form from being submitted if there are any errors
if((nameErr || emailErr || genderErr || quaErr || hobErr) == true) {
       return false;
    } else {
        // Creating a string from input data for preview
        var dataPreview = "You've entered the following details: \n" +
                          "Full Name: " + name + "\n" +
                          "Email Address: " + email + "\n" + 
                          "Gender: " + gender + "\n" +
                          "Hobbies: " + hob + "\n" ;
        if(qua.length) {
                dataPreview += "Qua: " + qua.join(", ");
        }
        // Display input data in a dialog box before submitting the form
        alert(dataPreview);
    }
};
</script>
