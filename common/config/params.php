<?php
if ($_SERVER['SERVER_NAME'] == 'admin.pumpumpum.appstage.co') {

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'baseYear'  => '1970',
    'backendUrl'=>  'http://admin.pumpumpum.appstage.co/'
];
}else{
    return [
    'adminEmail' => 'pradeep@t9l.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'baseYear'  => '1970',
    'backendUrl'=>  'http://pumpum.loc/'
];
}