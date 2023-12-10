<?php
include 'top.php';
?>
<main>
    <p>Create Table SQL</p>

<pre>
CREATE TABLE tblSnowfall(
	pmkSnowfallID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fldyear YEAR,
    fldsnow INT(200)
)

INSERT INTO tblSnowfall(fldyear, fldsnow) VALUES
(2023, 50),
(2022, 126),
(2021, 188),
(2020, 133)


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

INSERT INTO tblSurvey
(pmkSurveyID, fldFirstName, fldLastName, fldEmail, fldGroom, fldPowder, fldMogul, fldQuestion, fldNight)
VALUES
(1, 'Tyler', 'Sheehan', 'tjsheeha@uvm.edu', 1, 1, 0, 'Ski', 'Maybe');


</pre>

</main>
<?php include 'footer.php'; ?>
</body>
</html>