<h1>Gmail Email Inbox using PHP with IMAP</h1>
<?php
    if (! function_exists('imap_open')) {
        echo "IMAP is not configured.";
        exit();
    } else {
        ?>
<div id="listData" class="list-form-container">
    <?php
        /* Connecting Gmail server with IMAP */
        $username = 'juulio@hotmail.com';

        $hotmailbox = '{imap-mail.outlook.com:993/ssl}'; 
        $hotmailPassword = 'alfredo2010';
        
        $gmailbox = '{imap.gmail.com:993/imap/ssl}INBOX';
        $gmailPassword = 'santaFe.2016';
        
        // $connection = imap_open($gmailbox, $username, $gmailPassword) or die('Cannot connect to Gmail: ' . imap_last_error());
        
        $connection = imap_open($hotmailbox, $username, $hotmailPassword) or die('Cannot connect to Gmail: ' . imap_last_error());
        
        // $connection = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'juulio', 'santaFe.2016') or die('Cannot connect to Gmail: ' . imap_last_error());
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
            <td>From</td>
            <td>Subject</td>
            <td>Date</td>
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