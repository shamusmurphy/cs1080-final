<nav>
        <a class="<?php
        if ($pathParts['filename'] == "index") {
            print 'activePage';
        }
        ?>"href="index.php"><span>Home</span></a>

        <a class="<?php
        if ($pathParts['filename'] == "killington") {
            print 'activePage';
        }
        ?>"href="killington.php"><span>Killington</span></a>

        <a class="<?php
        if ($pathParts['filename'] == "stowe") {
            print 'activePage';
        }
        ?>" href="stowe.php"><span>Stowe<span></a>

        <a class="<?php
        if ($pathParts['filename'] == "sugarbush") {
            print 'activePage';
        }
        ?>" href="sugarbush.php"><span>Sugarbush<span></a>

        <a class="<?php
        if ($pathParts['filename'] == "form") {
            print 'activePage';
        }
        ?>" href="form.php"><span>Form</span></a>
    </nav>