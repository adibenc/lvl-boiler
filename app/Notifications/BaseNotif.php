<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// use Benwilkins\FCM\FcmMessage;

abstract class BaseNotif extends Notification{
    use Queueable;

    protected $vias = ['database'];
    public $data = null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data = null){
        $this->setData($data);
    }

    /**
     * @inherit
     */
    public function via($notifiable)
    {
        $this->setViaByNotifiable($notifiable);

        return $this->getVia();
    }

    /**
     * @inherit
     */
    public function toMail($notifiable)
    {
        $this->setDBContentByNotifiable($notifiable);
        $dbcontent = $this->getDBContent();

        $mailMsg = $this->parentMail($dbcontent);
        return $mailMsg;
    }

    /**
     * @inherit
     */
    public function toArray($notifiable)
    {
        $this->setDBContentByNotifiable($notifiable);

        return $this->getDBContent();
    }

    public function toFcm($notifiable)
    {
        $this->setDBContentByNotifiable($notifiable);
        $content = $this->getDBContent();

        $message = new FcmMessage();
        $message->content([
            'title'        => $content['msg'],
            'body'         => $content['msg_long'],
            'sound'        => '', // Optional
            'icon'         => config('view.ui.icon'), // Optional
            'click_action' => $content['link'] // Optional
        ])->data([
            'param1' => 'dummy' // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.

        return $message;
    }

    public function setMailSubject($mailSubject){
        $this->mailSubject = $mailSubject;
    }

    public function getMailSubject(){
        return $this->mailSubject;
    }

    public function parentMail($dbcontent)
    {
        return (new MailMessage)
            ->subject($this->getMailSubject())
            ->line($dbcontent['msg_long'])
            ->action('Cek', $dbcontent['msg_long'])
            ->line('Thank you for using our application!');
    }

    public function setDBContent($msg, $msgLong, $link){
        $this->dbcontent = [
            'msg' => $msg,
            'msg_long' => $msgLong,
            'link' => $link,
        ];
    }

    public function getDBContent(){
        return $this->dbcontent;
    }

    abstract function setDBContentByNotifiable($notifiable);

    public function preferredVia($notifiable){
        $prefers = [];
        // $notifiable

        if($notifiable->prefer_email){

        }

        return;
    }

    public function getVia(){
        return $this->via;
    }

    protected function setViaByNotifiable($notifiable){
        $via = ['database'];
        // 'mail'

        // return $notifiable->prefers_sms ? ['nexmo'] : ['mail', 'database']; // from example
        // check if user prefer notify

        if($notifiable->isSuperadmin()){
            $via[] = "telegram";
        }

        if($notifiable->isManager()){

        }

        $this->via = $via;
    }

    public function toTelegram($notifiable){
        return "Test telegram";
    }

	public function getData(){
		return $this->data;
	}

	public function setData($data){
		$this->data = $data;

		return $this;
	}
}
