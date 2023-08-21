<!-- Start here -->

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>
    <form method="post" name="registrationForm" onsubmit="return validateRegistrationForm()" action="process_registration.php" >
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name"><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name"><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone"><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br>

        <label for="email">Email:</label>
        <input type="email" name="email"><br>

        <input type="submit" value="Register">
    </form>
</body>
<script>
    
    function isValidName(name) {
            const namePattern = /^[A-Z][a-z]*$/;

            return namePattern.test(name);
        }

    function containsOnlyNumbers(inputString) {
        // Regular expression pattern: Only numbers (0-9) allowed.
        const numberPattern = /^[0-9]+$/;

        return numberPattern.test(inputString);
    }
    function validateRegistrationForm() {
        
        const firstName = document.forms["registrationForm"]["first_name"].value;
        const lastName = document.forms["registrationForm"]["last_name"].value;
        const email = document.forms["registrationForm"]["email"].value;
        const phone = document.forms["registrationForm"]["phone"].value;
        const password = document.forms["registrationForm"]["password"].value;

        if (!isValidName(firstName) || !isValidName(lastName)) {
            alert("Invalid name.");
            return false;
        }

        if (!containsOnlyNumbers(phone)) {
            alert("Invalid phone number.");
            return false;
        }

        return true;
    }
</script>
</html>
