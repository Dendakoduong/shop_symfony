<?php
namespace App\Service;

use Mailjet\Client;
use Mailjet\Resources;

class Mail 
{
    private $api_key = "a005516b1195a997bc6e46821de64c16";
    private $api_key_secret = "f4db8a2a0e83426085cdfd9641c01b10";

    public function send($toEmail, $toName, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);
        $body = 
        [
            'Messages' => 
            [
                [
                    'From' => 
                    [
                        'Email' => "tutabs00244@fpt.edu.vn",
                        'Name' => "Banazon Website"
                    ],
                    'To' => 
                    [
                        [
                            'Email' => $toEmail,
                            'Name' => $toName
                        ]
                    ],
                    'TemplateID' => 5814584,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => ['content' => $content]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
    }
}