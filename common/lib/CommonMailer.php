<?php

namespace common\lib;

use yii;
use Aws\Ses\SesClient;

class CommonMailer {

    const MAX_ATTACHMENT_NAME_LEN = 60;

    public function __construct($email, $subject, $body,$cc=array(), $attachment = null) {
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
        $this->attachment = $attachment;
        $this->cc = $cc;
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail() {
        if (!empty($this->attachment)) {
            $client = SesClient::factory(array(
                        'credentials' => array(
                            'key' => \Yii::$app->params['AWSAccessKeyId'],
                            'secret' => \Yii::$app->params['AWSSecretKey'],
                        ),
                        'version' => 'latest',
                        'region' => 'us-west-2'
            ));
            
            
            $body = $this->body;
            $subject = $this->subject; 
            $to_str = $this->email;
            $from = Yii::$app->params['supportEmail'];
            $msg = "To: $to_str\n";
            $msg .= "From: $from\n";
            $msg .= "Reply-To: updates@farmeruncle.com";
            
            $subject = mb_encode_mimeheader($this->subject, 'UTF-8');
            $msg .= "Subject: $subject\n";
            $msg .= "MIME-Version: 1.0\n";
            $msg .= "Content-Type: multipart/alternative;\n";
            $boundary = uniqid("_Part_" . time(), true); //random unique string
            $msg .= " boundary=\"$boundary\"\n";
            $msg .= "\n";

            // now the actual message
            $msg .= "--$boundary\n";

            // first, the plain text
            $msg .= "Content-Type: text/plain; charset=utf-8\n";
            $msg .= "Content-Transfer-Encoding: 7bit\n";
            $msg .= "\n";
            $msg .= $body;
            $msg .= "\n";

            $msg .= "--$boundary\n";
            $msg .= "Content-Type: text/html; charset=utf-8\n";
            $msg .= "Content-Transfer-Encoding: 7bit\n";
            $msg .= "\n";
            $msg .= $body;
            $msg .= "\n";

            $msg .= "--$boundary\n";
            $msg .= "Content-Transfer-Encoding: base64\n";
            $clean_filename = mb_substr($this->attachment, 0, self::MAX_ATTACHMENT_NAME_LEN);
            $msg .= "Content-Type: {application/pdf}; name=$clean_filename;\n";
            $msg .= "Content-Disposition: attachment; filename=$clean_filename;\n";
            $msg .= "\n";
            $msg .= base64_encode(file_get_contents($this->attachment));
            //echo $msg;die;

            $request = array();
            $request['Source'] = Yii::$app->params['supportEmail'];
            $request['Destination']['ToAddresses'] = array($this->email);
            if($this->cc){ $request['Destination']['CcAddresses'] = $this->cc; }
            $request['Message']['Subject']['Data'] = $this->subject;
            $request['Message']['Body']['Html']['Data'] = $this->body;
            $msg .= "==\n";
            $msg .= "--$boundary";
            $msg .= "--\n";
            //
            try {
                //file_put_contents("log.txt", $msg);
                //echo $msg;die;
                $ses_result = $client->sendRawEmail(
                        array(
                    'RawMessage' => array(
                        'Data' => base64_encode($msg)
                    )
                        ), array(
                    'Source' => Yii::$app->params['supportEmail'],
                    'Destinations' => array($this->email),
                    'From' => array(Yii::$app->params['supportEmail']),
                        )
                );
                if ($ses_result) {
                    $ses_result->message_id = $ses_result->get('MessageId');
                }
//			$result = $client->sendEmail($request);
//			$messageId = $result->get('MessageId');
//			return true;
                //echo("Email sent! Message ID: $messageId" . "\n");
            } catch (Exception $e) {
                $d = $e->getMessage().
                " - To: $to_str, Sender: $from, Subject: $subject";
                //echo "<pre>";print_r($d);die;
            }
        } else {
            $client = SesClient::factory(array(
                        'credentials' => array(
                            'key' => \Yii::$app->params['AWSAccessKeyId'],
                            'secret' => \Yii::$app->params['AWSSecretKey'],
                        ),
                        'version' => 'latest',
                        'region' => 'us-west-2'
            ));
            $request = array();
            $request['Source'] = Yii::$app->params['supportEmail'];
            $request['Destination']['ToAddresses'] = array($this->email);
            if($this->cc){ $request['Destination']['CcAddresses'] = $this->cc; }
            $request['Message']['Subject']['Data'] = $this->subject;
            $request['Message']['Body']['Html']['Data'] = $this->body;

            try {
                $result = $client->sendEmail($request);
                $messageId = $result->get('MessageId');
                return true;
                //echo("Email sent! Message ID: $messageId" . "\n");
            } catch (Exception $e) {
                return false;
                //echo("The email was not sent. Error message: ");
                //echo($e->getMessage() . "\n");
            }
        }
    }
    
    
    public function sendattachmentmail(){
            try {
                  $value = \Yii::$app->mailer->compose('invoicemailer',['content'=>$this->body])
                    ->setFrom(['updates@farmeruncle.com' => 'Farmer Uncle'])
                    ->setTo($this->email)
                    ->setSubject($this->subject)
                    ->setHtmlBody($this->body)
                    ->attach($this->attachment)
                    ->send();
                return true;
            } catch (Exception $e) {
                return false;
            }
         
       
            
            
    }

}