<?php

namespace AppBundle;

class SendMail
{
	public function send(){
		$message = new \Swift_Message('First Mail');
		$message->SetFrom('cos@gmail.com')
		        ->setTo('cosiek@op.pl')
		        ->setBody('Hello My Name Is COs');
		
		$mailer = new \Swift_Mailer;
		$mailer->send($message);
	}
}