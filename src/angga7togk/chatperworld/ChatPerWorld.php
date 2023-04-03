<?php

namespace angga7togk\chatperworld;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;

class ChatPerWorld extends PluginBase implements Listener{

    public $cfg;
    public $prefix;

    public function onEnable():void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());
        $this->prefix = $this->cfg->get("Prefix")." ";
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

    public function onCommand(CommandSender $player, Command $cmd, String $label, Array $args):bool{
        if($cmd->getName() == "globalchat"){
            if(isset($args[0])){
                $player->getServer()->broadcastMessage("".str_replace(["{player}", "{msg}"], [$player->getName(), implode(" ", $args)], $this->cfg->get("Format")));
                return true;
            }else{
                $player->sendMessage($this->prefix."Usage: /gchat <message>");
                return true;
            }
            return false;
        }
    }
}