<?php
    include "top.php";

    $dataIsGood = false;
    $errorMessage = '';
    $message = '';

    $firstName = '';
    $lastName = '';
    $email = '';
    $groom = 1;
    $powder = 0;
    $mogul = 0;
    $question = '';
    $night = '';

    function getData($field) {
        if (!isset($_POST[$field])) {
            $data= "";
        } else {
            $data= trim($_POST[$field]);
            $data = htmlspecialchars($data);
        }
        return $data;
    }

    function verifyAlphaNum($testString) {
        // Check for letters, numbers and dash, period, space and single quote only.
        // added & ; and # as a single quote sanitized with html entities will have 
        // this in it bob's will be come bob's
        return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
    }

    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        print PHP_EOL . '<!-- Starting Sanitization -->' . PHP_EOL;

        $firstName = getData('txtFirstName');
        $lastName = getData('txtLastName');
        $email = getData('txtEmail');
        $groom = (int) getData('chkGroom');
        $powder = (int) getData('chkPowder');
        $mogul = (int) getData('chkMogul');
        $question = getData('radQuestion');
        $night = getData('radNight');

        print PHP_EOL . '<!-- Starting Validation -->' . PHP_EOL; 
        $dataIsGood = true;

        if ($firstName == ''){
            $errorMessage .= '<p class="mistake">Please type in your first name.</p>';
            $dataIsGood = false;
        } elseif(!verifyAlphaNum($firstName)){
            $errorMessage .= '<p class="mistake">Your first name includes invalid characters, only use letters please.</p>';
            $dataIsGood = false;
        }
        if ($lastName == ''){
            $errorMessage .= '<p class="mistake">Please type in your last name.</p>';
            $dataIsGood = false;
        } elseif(!verifyAlphaNum($lastName)){
            $errorMessage .= '<p class="mistake">Your last name includes invalid characters, only use letters please.</p>';
            $dataIsGood = false;
        }
         if ($email == ''){
            $errorMessage .= '<p class="mistake">Please type in your email address.</p>';
            $dataIsGood = false;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errorMessage .= '<p class="mistake">Your email address includes invalid characters.</p>';
            $dataIsGood = false;
        }

        $totalChecked = 0;
        
        if($groom != 1){ $groom = 0;}
        $totalChecked += $groom;

        if($powder != 1){$powder = 0;}
        $totalChecked += $powder;

        if($mogul != 1){$mogul = 0;}
        $totalChecked += $mogul;

        if($totalChecked == 0){
            $errorMessage .= '<p class="mistake">Please choose atleast one.</p>';
            $dataIsGood = false;
        }

        if ($question != "Ski" AND $question != "Board" AND $question != "Both") {
            $errorMessage .= '<p class="mistake">Please choose one.</p>';
            $dataIsGood = false;
        }
        if ($night != "Yes" AND $night != "No" AND $night != "Maybe") {
            $errorMessage .= '<p class="mistake">Please choose one.</p>';
            $dataIsGood = false;
        }

        print '<!-- Starting Saving -->';
        if ($dataIsGood) {
            $sql = 'INSERT INTO tblSurvey
            (fldFirstName, fldLastName, fldEmail, fldGroom, fldPowder, fldMogul, fldQuestion, fldNight)';


            $sql .= 'VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
            $data = array($firstName, $lastName, $email, $groom, $powder, $mogul, $question, $night);
            $statement = $pdo->prepare($sql);
    
            try{
                if($statement->execute($data)){
                    $message .= '<h2>Thank you</h2>';
                    $message .= '<p>Your information was successfully saved.</p>';
                } else {
                    $message .= '<p> Record was NOT successfully saved.</p>';
                }
            } catch (PDOException $e){
                $message .= '<p>Couldn\'t insert the record, please contact someone</p>';
            }

            $to = $email;
            $subject = 'Confirmation: Ski Survey Form Submission';
            $messageBody = 'Thank you for submitting the Ski Survey form!';
            $headers = 'From: tjsheeha@uvm.edu, smurph46@uvm.edu,msgoldsm@uvm.edu';

            if ($night == 'Yes'){
                $messageBody .= ' Due to your response, Killington is reccomended for you.';
            } elseif($night == 'Maybe'){
                $messageBody .= ' Due to your response, Killington and Stowe is recommended for you.';
            }else{
                $messageBody .= ' Due to your response, Sugarbush is recommended for you';
            }

            if (mail($to, $subject, $messageBody, $headers)){
                $message .= '<p>Confirmation email sent</p>';
            } else{
                $message .= '<p>Confirmation email was not sent.</p>';
            }
        }
    }
?>
<body>
<main>
    <h1 class="box1">Survey</h1>

    <section class="box2">
    <h2> Form</h2>
        <figure>
            <img src="images/skiTrick.jpeg" alt="Someone skiing">
            <figcaption><cite><a href="https://www.istockphoto.com/photos/ski-trick">Ski-trick</a></cite></figcaption>
        </figure>
    </section>

    <section class="box4">
        <h2>Results</h2>
        <?php
        print '<p>Post Array:</p><pre>';
        print_r($_POST);
        print '</pre>';
        ?>
    </section>
    <section class="box3">
        <h2>Answer each of the following.</h2>
        <?php
            print $message;
            print $errorMessage;
        ?>
        <form action="#"
              method="POST">
            <fieldset class="contact">
                <legend>Contact Information</legend>
                <p>
                    <label class="required" for="txtFirstName">First Name:</label>
                    <input type="text" placeholder="First Name" name="txtFirstName" id="txtFirstName" maxlength="20" onfocus="this.select()" tabindex="100" value= "<?php print $firstName; ?>" required>
                </p>
                <p>
                    <label class="required" for="txtLastName">Last Name:</label>
                    <input type="text" placeholder="Last Name" name="txtLastName" id="txtLastName" maxlength="20" onfocus="this.select()" tabindex="110" value= "<?php print $lastName; ?>" required>
                </p>
                <p>
                    <label class="required" for="txtEmail">Email:</label>
                    <input type="text" placeholder="ex: abc@xyz.com" name="txtEmail" id="txtEmail" maxlength="30" onfocus="this.select()" tabindex="120" value= "<?php print $email; ?>" required>
                </p>
            </fieldset>
            <fieldset class="checkbox">
                <legend>What is your favorite conditions for the mountain?</legend>
                <p>
                    <input type="checkbox" name="chkGroom" id="chkGroom" value="1" tabindex="200" <?php if($groom) print 'checked';?>>
                    <label for="chkGroom">Groomers</label>
                </p>
                <p>
                    <input type="checkbox" name="chkPowder" id="chkPowder" value="1" tabindex="200" <?php if($powder) print 'checked';?>>
                    <label for="chkPowder">Powder</label>
                </p>
                <p>
                    <input type="checkbox" name="chkMogul" id="chkMogul" value="1" tabindex="200" <?php if($mogul) print 'checked';?>>
                    <label for="chkMogul">Moguls</label>
                </p>
            </fieldset>
            <fieldset class="radio">
                <legend>Do you ski or snowboard?</legend>
                <p>
                    <input type="radio" name="radQuestion" value="Ski" id="radSki" tabindex="300" <?php if($question == "Ski") print 'checked'; ?> required>
                    <label for="radSki">Ski</label>
                </p>
                <p>
                    <input type="radio" name="radQuestion" value="Board" id="radBoard" tabindex="310" <?php if($question == "Board") print 'checked'; ?> required>
                    <label for="radBoard">Snowboard</label>
                </p>
                <p>
                    <input type="radio" name="radQuestion" value="Both" id="radBoth" tabindex="320" <?php if($question == "Both") print 'checked'; ?> required>
                    <label for="radBoth">Both</label>
                </p>
            </fieldset>
            <fieldset class="radio">
                <legend>Do you prefer nightlife near the mountain?</legend>
                <p>
                    <input type="radio" name="radNight" value="Yes" id="radYes" tabindex="300" <?php if($night == "Yes") print 'checked'; ?> required>
                    <label for="radYes">Yes</label>
                </p>
                <p>
                    <input type="radio" name="radNight" value="No" id="radNo" tabindex="310" <?php if($night == "No") print 'checked'; ?> required>
                    <label for="radNo">No</label>
                </p>
                <p>
                    <input type="radio" name="radNight" value="Maybe" id="radMaybe" tabindex="320" <?php if($night == "Maybe") print 'checked'; ?> required>
                    <label for="radMaybe">Maybe</label>
                </p>
            </fieldset>


            <fieldset class="buttons">
                <p>
                    <input type="submit" name="btnSubmit" value="register" id="btnSubmit" tabindex="500">
                </p>
            </fieldset>
        </form>
    </section>
</main>
<?php
include "footer.php";
?>
</body>
</html>