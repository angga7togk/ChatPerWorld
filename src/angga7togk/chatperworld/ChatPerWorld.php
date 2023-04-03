<?php

namespace angga7togk\chatperworld;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;

use angga7togk\chatperworld\Listener\ChatListener;
use angga7togk\chatperworld\updater\ConfigUpdate;

class ChatPerWorld extends PluginBase{

    public $cfg;
    public $prefix;
    public $cu;
    public $cfgversion;

    const cfgversion = "1.0";

    public function onEnable():void{
        // ChatListener
        $this->getServer()->getPluginManager()->registerEvents(new ChatListener($this), $this);

        // Config.yml
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());

        // Prefix
        $this->prefix = $this->cfg->get("Prefix")." ";

        // Config Version
        $this->cfgversion = self::cfgversion;

        // Config Update
        $this->cu = new ConfigUpdate($this);
        $this->cu->ConfigUpdate();
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
        }
        return true;
    }
}