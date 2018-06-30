<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

    $to = 'B031510298@student.utem.edu.my';
    $subject = "Project 1 Presentation Details";

    $organizer          = 'Syafiqah Yahayah';
    $organizer_email    = 'B031510298@student.utem.edu.my';

    $participant_name_1 = 'Syafiqah';
    $participant_email_1= 'B031510298@student.utem.edu.my';

    $participant_name_2 = 'Sarah';
    $participant_email_2= 'B031510277@student.utem.edu.my';  

    $location           = "MKP 2";
    $date               = '20180501';
    $startTime          = '0800';
    $endTime            = '0900';
    $subject            = 'Project 1 Presentation Details';
    $desc               = 'The purpose of the email is to test.';

    $headers = 'Content-Type:text/calendar; Content-Disposition: inline; charset=utf-8;\r\n';
    $headers .= "Content-Type: text/plain;charset=\"utf-8\"\r\n"; #EDIT: TYPO

    $message = "BEGIN:VCALENDAR\r\n
    VERSION:2.0\r\n
    PRODID:-//Deathstar-mailer//theforce/NONSGML v1.0//EN\r\n
    METHOD:REQUEST\r\n
    BEGIN:VEVENT\r\n
    UID:" . md5(uniqid(mt_rand(), true)) . "example.com\r\n
    DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z\r\n
    DTSTART:".$date."T".$startTime."00Z\r\n
    DTEND:".$date."T".$endTime."00Z\r\n
    SUMMARY:".$subject."\r\n
    ORGANIZER;CN=".$organizer.":mailto:".$organizer_email."\r\n
    LOCATION:".$location."\r\n
    DESCRIPTION:".$desc."\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN".$participant_name_1.";X-NUM-GUESTS=0:MAILTO:".$participant_email_1."\r\n
    ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=TRUE;CN".$participant_name_2.";X-NUM-GUESTS=0:MAILTO:".$participant_email_2."\r\n
    END:VEVENT\r\n
    END:VCALENDAR\r\n";

    $headers .= $message;
    mail($to, $subject, $message, $headers);    
?>
</body>
</html>