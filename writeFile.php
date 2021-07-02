<?php

    $txt = "user id date";
    $filenName = "newfile.txt";
    // using the FILE_APPEND flag to append the content to the end of the file
    // and the LOCK_EX flag to prevent anyone else writing to the file at the same time
    $myfile = file_put_contents($filenName, $txt.PHP_EOL , FILE_APPEND | LOCK_EX);



    // $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    // $txt = "John Doe\n";
    // fwrite($myfile, $txt);
    // $txt = "Jane Doe\n";
    // fwrite($myfile, $txt);
    // fclose($myfile);
?>