<?php

handleEmailSending();


function handleEmailSending() {
    $name 	= htmlspecialchars($_POST['name']);
    $email 	= htmlspecialchars($_POST['email']);
    $phone 	= htmlspecialchars($_POST['phone']);
    $txt 	= htmlspecialchars($_POST['msg']);

    // txt, name and email are required:
    // if (!(($txt && $txt !=="") && ($name && $name !=="") && ($email && $email !==""))) {
    //     die('Not enough data to send an email');
    // }

    // Prepare SMTP headers for mail sending
    
    $headers         = "MIME-Version: 1.0" . "\r\n";
    $headers        .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers        .= "From: {$email}" . "\r\n";

    $headersClient   = "MIME-Version: 1.0" . "\r\n";
    $headersClient  .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headersClient  .= "From: admin@misterbit.co.il, $" . "\r\n";
    
    $msgToAdmin     = buildMsgToAdmin($name,$email,$phone,$txt);
    $msgToClient    = buildMsgToClient();

    //TODO PROD
    //SEND MESSAGE TO Admin
    mail( 'vyaron@gmail.com','New Contact regarding Vue Workshop' , $msgToAdmin, $headers );
    mail( 'zohar@misterbit.co.il', 'New Contact regarding Vue Workshop' , $msgToAdmin, $headers );
    // mail( 'alondanoch@gmail.com', 'New Contact regarding Vue Workshop' , $msgToAdmin, $headers );
    mail( 'Assaf@misterbit.co.il', 'New Contact regarding Vue Workshop' , $msgToAdmin, $headers );    
    //  mail( 'okc.elad.35@gmail.com', 'New Contact regarding Vue Workshop' , $msgToAdmin, $headers);


    /****************************FOR TESTING ONLY***********************************/
    //TODO DEV
    // mail( 'reuthi1@gmail.com',  'New Contact regarding Angular Workshop' , $msgToAdmin, $headers );
    // mail( 'reut@misterbit.co.il',  'New Contact regarding Angular Workshop' , $msgToAdmin, $headers);

    //SEND MESSAGE TO CLIENT
    mail( $email,  'Message from misterBit' , $msgToClient, $headersClient);

}
 
function buildMsgToClient(){
    $file = file_get_contents('../email-templates/email.html');
    $msg = str_replace('{{HEADER}}','Message from misterBIT',$file);
    $msg = str_replace('{{NAME}}','Yaron Biton',$msg);
    $msg = str_replace('{{EMAIL}}','vyaron@gmail.com',$msg);
    $msg = str_replace('{{PHONE}}','',$msg); // ASK YARON ABOUT HIS PHONE
    $msg = str_replace('{{TITLE}}','Thanks for reaching out',$msg);
    $msg = str_replace('{{MESSAGE}}','we will be with you shortly.',$msg);
    $msg = str_replace('{{MSGFOOTER}}','',$msg);
    $date = getdate(date('U'));
    $msg = str_replace('{{DATE}}',$date['weekday']. ',' .$date['month']. ',' .$date['mday']. ',' .$date['year'],$msg);
    return $msg;
}

function buildMsgToAdmin($clientName, $clientEmail, $clientPhone, $txt){
    $file = file_get_contents('../email-templates/email.html');
    $msg = str_replace('{{HEADER}}',"New MisterBIT contact",$file);
    $msg = str_replace('{{NAME}}',$clientName,$msg);
    $msg = str_replace('{{EMAIL}}',$clientEmail,$msg);
    $msg = str_replace('{{PHONE}}',$clientPhone,$msg);
    $msg = str_replace('{{TITLE}}',"Message content",$msg);
    $msg = str_replace('{{MESSAGE}}',$txt,$msg);
    $msg = str_replace('{{MSGFOOTER}}','Please contact as soon as possible',$msg);
    $date = getdate(date('U'));
    $msg = str_replace('{{DATE}}',$date['weekday']. ',' .$date['month']. ',' .$date['mday']. ',' .$date['year'],$msg);
        // echo $msg;
    return $msg;
}

?>

