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
        td {
            text-align: center;
            padding: 0 20px;
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
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Content</th>
                </tr>
                <?php
                    $total = 0;

                    foreach ($emailData as $emailIdent) {
                        // imap_fetch_body
                        // ()Root Message Part (multipart/related)
                        // (1) The text parts of the message (multipart/alternative)
                        // (1.1) Plain text version (text/plain)
                        // (1.2) HTML version (text/html)
                        // (2) The background stationary (image/gif)
                        $overview = imap_fetch_overview($connection, $emailIdent, 0);
                        $message = imap_fetchbody($connection, $emailIdent, '1');
                        $messageExcerpt = substr($message, 0, 150);
                        $date = date('d F, Y, H:i:s', strtotime($overview[0]->date));
                        $emailContent = quoted_printable_decode($messageExcerpt); 
                        $int = (int) filter_var($emailContent, FILTER_SANITIZE_NUMBER_INT);
                        $total += $int;
                        // $trimmed = substr($emailContent, 4, -1); 
                        // echo $emailIdent . '- ' . $trimmed  . '<br>';
                ?>
                <tr>
                    <td class="content-div">
                            <?php echo $overview[0]->subject; ?>
                    </td>
                    <td>
                        <?php echo $date; ?>
                    </td>
                    <td>
                        <?php echo $int;?>
                    </td>
                </tr>
            <?php
                } // End foreach
                ?>
        </table>
        <?php
            
            echo '<h2>Total sumado: ' . $total . '</h2>';

            } // end if
            
            imap_close($connection);
        }
        ?>
    </div>
</body>

</html>