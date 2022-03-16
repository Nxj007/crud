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
        var pass = document.contactForm.pass.value;
        var det = document.contactForm.det.value;
        var gender = document.contactForm.gender.value;
        var hob = document.contactForm.hob.value;
        var qua = [];

        var checkboxes = document.getElementsByName("qua[]");
        for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
        // Populate qua array with selected values
        qua.push(checkboxes[i].value);
        }
        }

        var nameErr = emailErr = passErr = detErr = genderErr = quaErr = hobErr = true;

        if (name == "") {
        printError("nameErr", "Please enter your name JS");
        } else {
        var regex = /^[0-9A-Z\d]+$/;
        if (regex.test(name) === false) {
        printError("nameErr", "Please enter a valid name JS");
        } else {
        printError("nameErr", "");
        nameErr = false;
        }
        }

        // Validate Details
        if (det == "") {
        printError("detErr", "Enter your details");
        } else {
        printError("detErr", "");
        detErr = false;
        }

        // Validate email address
        if (email == "") {
        printError("emailErr", "Please enter your email address");
        } else {
        // Regular expression for basic email validation
        var regex = /^\S+@\S+\.\S+$/;
        if (regex.test(email) === false) {
        printError("emailErr", "Please enter a valid email address");
        } else {
        printError("emailErr", "");
        emailErr = false;
        }
        }
        // Validate Pass
        if (pass == "") {
        printError("passErr", "**Fill the password please!");
        return false;  
        }
        if(pass.length < 6) {  
        printError("passErr", "**Password length must be atleast 6 characters");
        return false;
        }
        else {
        printError("passErr", "");
        passErr = false;
        }

        // Validate gender
        if (gender == "") {
        printError("genderErr", "Please select your gender");
        } else {
        printError("genderErr", "");
        genderErr = false;
        }

        // Validate hob
        if (hob == "") {
        printError("hobErr", "Please select your hob");
        } else {
        printError("hobErr", "");
        hobErr = false;
        }

        // Validate Qualificatiob
        if (qua == "") {
        printError("quaErr", "Select any one");
        } else {
        printError("quaErr", "");
        quaErr = false;
        }



        // Prevent the form from being submitted if there are any errors
        if ((nameErr || detErr || emailErr || passErr || genderErr || hobErr || quaErr) == true) {
        return false;
        } else {
        alert("Eee");
        }
        };
        function selectOnlyThis(id){
        var qa = document.getElementsByName("qa");
        Array.prototype.forEach.call(qa,function(el){
        el.checked = false;
        });
        id.checked = true;    
        }
        </script>