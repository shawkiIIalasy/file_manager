<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;

/**
 * Gmail component
 */
class GmailComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public function sentToGmail($name,$subject,$message)
    {
        $email=new Email('gmail');
        $email->addTo($name)->setSubject($subject)->send($message);
    }
}
