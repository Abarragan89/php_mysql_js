<?php
    $forename = $surname = $username = $password = $age = $email = "";
    if (isset($_POST['forename']))
        $forename = fix_string($_POST['forname']);
    if (isset($_POST['surname']))
        $surname = fix_string($_POST['surname']);
    if (isset($_POST['username']))
        $username = fix_string($_POST['username']);
    if (isset($_POST['password']))
        $password = fix_string($_POST['password']);
    if (isset($_POST['age']))
        $age = fix_string($_POST['age']);
    if (isset($_POST['email']))
        $email = fix_string($_POST['email']);

    $fail = validate_forename($forename);
    $fail .= validate_surname($surename);
    $fail .= validate_username($username);
    $fail .= validate_password($password);
    $fail .= validate_age($age);
    $fail .= validate_email($email);

    echo "<!DOCTYPE html>\n<html><head><title>An Example Form</title>";

    if ($fail == "") {
        echo "</head><body>Form data successfully validated:
            $forename, $surname, $username, $password, $age, $email.</body></html>";
    }
    //THE HTML AND JS
    echo <<<_END
    <style>
    .signup {
        border: 1px solid #999999;
        font: normal 14px helvetica;
        color: #444444;
    }
    </style>
    <script>
    //main function for validation
    function validate(form)//function that calls on other functions
    {
        fail = validateForename(form.forename.value)
        fail += validateSurname(form.surname.value)
        fail += validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
        fail += validateAge(form.age.value)
        fail += validateEmail(form.email.value)

        if (fail == "") return true
        else { alert(fail); return false }
    }
    //validate forename
    function validateForename (field) {
        return (field == "") ? "No Forename was entered" : ""
    }
    function validateSurname (field) {
        return (field == "") ? "No Forename was entered" : ""
    }
    function validateUsername(field){
        if(field == "") return "No Username Entered \n"
        else if (feild.length < 5) return "User names must be at least 5 characters \n"
        else if(/[^a-zA-Z0-9_-]/.test(feild))
            return "Only a-z, A-Z, 0-9, - and _ allwed in Usernames.\n"
        return ""
    } 
    function validatePassword(field) {
        if (field == "") return "No Password was entered \n"
        else if(field.length < 6) return "Password must be at least 6 characters.\n"
        else if(!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
            return "Passwords require one each of a-z, A-Z, and 0-9\n"
        return ""
    }
    function validateAge(field) {
        if (field == "") return "No age was entered\n"
        else if(field < 18 || field > 110) return "Age must be in between 18 and 110"
        return ""
    }
    function validateEmail(field){
        if (field == "") return "No Email was entered"
        else if (!((field.indexOf(".") > 0) && (field.indexOf("@")> 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
            return "The Email address is invalid\n"
        return ""
    }
    </script>
    </head>
    <body>
    <table class="signup" border="0" cellpadding="2" cellspaceing="5" bgcolor="#eeeeee">
    <th colspan="2" align="center">Signup Form</th>
    <form method="post" action="adduser.php" onsubmit="return validate(this)">
    <tr>
        <td>Forename</td>
        <td><input type="text" maxlength="32" name="forename" value="$forename"></td>
    </tr>
    <tr>
        <td>Surname</td>
        <td><input type="text" maxlength="32" name="surname" value="$surname"></td>
    </tr>
    <tr>
        <td>Username</td>
        <td><input type="text" maxlength="16" name="username" value="$username"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="text" maxlength="12" name="password" value="$password"></td>
    </tr>
    <tr>
        <td>Age</td>
        <td><input type="text" maxlength="3" name="age" value="$age"></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><input type="text" maxlength="64" name="email" value="$email"></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" value="Signup"></td>
    </tr>
</form>
</table>
</body>
</html>
_END;

//The PHP functions
function validate_forename($field) 
{
    return($field == "") ? "No forename was entered<br>" : "";
}
function validate_surname($field)
{
    return($field == "") ? "No surname was entered<br>" : "";
}
function validate_username($field)
{
    if ($field == "") return "No username was entered.<br>";
    else if(strlen($field) < 5) return "Username must be at least 5 characters";
    else if(preg_match("/[^a-zA-z0-9_-]/", $field))
        return "Only letters, numbers, - and _ in usernames<br>";
    return "";
}
function validate_password($field)
{
    if ($field == "") return "No password was entered";
    else if (strlen($field) < 6)
        return "Passwords must be at least 6 characters<br>";
    else if (!preg_match("/[a-z]/", $field) || !preg_match("/[A-Z]/", $field) || !preg_match("/[0-9]/", $field));
        return "Password requre 1 each of a-z, A-Z, and 0-9<br>";
    return "";
}
function validate_age($field)
{
    if ($field == "") return "No age was entered<br>";
    else if ($field < 18 || $field > 110) 
        return "Age must be between 18 and 110<br>";
    return "";
}
function validate_email($field)
{
    if ($field == "") return "No Email was entered<br>";
 //if the position of a period or @ sign is not greater than one OR a theres a character that isn't a word character...
        else if (!((strpos($field, ".") > 0) && (strpos($field, "@") > 0)) || preg_match("/[^a-zA-Z0-9.@_-]/", $field))
            return "The Email address is invalid<br>";
        return "";
}
function fix_string($string) 
{
    $string = stripslashes($string);
    return htmlentities($string);
}
?>