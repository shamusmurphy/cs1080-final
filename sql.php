<?php
include 'top.php';
?>
<main>
    <p>Create Table SQL</p>

<pre>
--Up here should be for table in index--



-- this is for the form --

CREATE TABLE tblSurvery(
	pmkSurveyID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fldFirstName VARCHAR(30),
    fldLastName VARCHAR(30),
    fldEmail VARCHAR(50),
    fldGroom TINYINT(1) DEFAULT 0,
    fldPowder TINYINT(1) DEFAULT 0,
    fldMogul TINYINT(1) DEFAULT 0,
    fldQuestion VARCHAR(30),
    fldNight VARCHAR(30)
)

</pre>

</main>
<?php include 'footer.php'; ?>
</body>
</html>