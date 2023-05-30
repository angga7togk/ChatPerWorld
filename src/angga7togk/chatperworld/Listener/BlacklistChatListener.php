<?php

namespace angga7togk\chatperworld\Listener;

use angga7togk\chatperworld\ChatPerWorld;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class BlacklistChatListener implements Listener
{

    public ChatPerWorld $plugin;

    public function __construct(ChatPerWorld $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onChat(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        $world = $player->getWorld()->getFolderName();
        if(in_array($world, $this->plugin->cfg->get("Blacklist-WorldChat"))){
            $event->cancel();
            $player->sendMessage($this->plugin->prefix.$this->plugin->cfg->get("Message")["Blacklist-WorldChat"]);
        }
    }
}
