<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="PHP Mail App" />
    <meta charset="utf-8">
    <title>PHP Mail App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Out Studio Costa Rica 2021">

    <style>
        table, th, td {
            border: solid 1px #000;
        }
    </style>
</head>

<body>

    <h1>Email Inbox using PHP with IMAP</h1>
    <?php
        if (! function_exists('imap_open')) {
            echo "IMAP is not configured.";
            exit();
        } else {
            ?>
    <div id="listData" class="list-form-container">
        <?php
            $username = "lab_retail@outstudio.co";
            $password = "un1corN*2021";
            $mailbox = '{mail.outstudio.co:993/ssl/novalidate-cert}';
            
            $connection = imap_open($mailbox, $username, $password) or die('Cannot connect to Mailbox: ' . imap_last_error());
            
            /* Search Emails having the specified keyword in the email subject */
            // $emailData = imap_search($connection, 'SUBJECT "Article "');
            
            /* Get all e-mails */
            // imap_search https://www.php.net/manual/en/function.imap-search.php
            $emailData = imap_search($connection, 'ALL');
            // $emailData = imap_search($connection, 'NEW');
            // $emailData = imap_search($connection, 'SUBJECT "Airbnb"');


            if (! empty($emailData)) {
                ?>
        <table>
            <tr>
                <th>From</th>
                <th>Subject</th>
                <th>Date</th>
            </tr>
            <?php
                foreach ($emailData as $emailIdent) {
                    
                    $overview = imap_fetch_overview($connection, $emailIdent, 0);
                    $message = imap_fetchbody($connection, $emailIdent, '1.1');
                    $messageExcerpt = substr($message, 0, 150);
                    $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
                    $date = date("d F, Y", strtotime($overview[0]->date));
                    ?>
            <tr>
                <td>
                    <span class="column"><?php echo $overview[0]->from . "\n"; ?></span>
                </td>
                <td class="content-div"><span class="column">
                    <?php echo $overview[0]->subject; ?> - <?php echo $partialMessage; ?>
                    </span><span class="date">
                    <?php echo $date; ?>
                    </span>
                </td>
            </tr>
            <?php
                } // End foreach
                ?>
        </table>
        <?php
            } // end if
            
            imap_close($connection);
        }
        ?>
    </div>
</body>

</html>