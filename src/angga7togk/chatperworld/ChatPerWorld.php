<?php

namespace angga7togk\chatperworld;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class ChatPerWorld extends PluginBase implements Listener{

    public $cfg;

    public function onEnable():void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onChat(PlayerChatEvent $event){
        $player = $event->getPlayer();
        $recipients = $event->getRecipients();
		foreach($recipients as $key => $recipient){
			if($recipient instanceof Player){
				if($recipient->getWorld() != $player->getWorld()){
					unset($recipients[$key]);
				}
			}
		}
		$event->setRecipients($recipients);
    }
}