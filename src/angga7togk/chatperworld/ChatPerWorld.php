<?php

namespace angga7togk\chatperworld;

use angga7togk\chatperworld\Listener\BlacklistChatListener;
use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use angga7togk\chatperworld\updater\ConfigUpdate;
use angga7togk\chatperworld\Listener\ChatListener;
use angga7togk\chatperworld\Listener\GlobalChatListener;

class ChatPerWorld extends PluginBase
{

    public Config $cfg;
    public $prefix;
    public $cu;
    public $cfgversion;
    public $GlobalChat;
    const cfgversion = "2.0";

    public function onEnable(): void
    {
        // Listener
        $this->getServer()->getPluginManager()->registerEvents(new ChatListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new GlobalChatListener($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new BlacklistChatListener($this), $this);

        // Config.yml
        $this->saveResource("config.yml");
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML, array());

        // Prefix
        $this->prefix = $this->cfg->get("Prefix") . " ";

        $this->GlobalChat;

        // Config Update
        $this->cu = new ConfigUpdate($this);
        $this->cu->ConfigUpdate();
    }

    public function onCommand(CommandSender $sender, Command $cmd, String $label, array $args): bool
    {   
        if($sender instanceof ConsoleCommandSender){
            $sender->sendMessage($this->prefix."Please Use Command In Game!");
            return false;
        }
        if ($cmd->getName() == "globalchat") {
            if(isset($this->GlobalChat[$sender->getName()])){
                unset($this->GlobalChat[$sender->getName()]);
                $sender->sendMessage($this->prefix.$this->cfg->get("Message")["GlobalChat"]["disable"]);
            }else{
                $this->GlobalChat[$sender->getName()] = true;
                $sender->sendMessage($this->prefix.$this->cfg->get("Message")["GlobalChat"]["enable"]);
            }
        }
        return true;
    }
}
