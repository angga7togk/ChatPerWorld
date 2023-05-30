<?php

namespace angga7togk\chatperworld\Listener;

use angga7togk\chatperworld\ChatPerWorld;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Server;

class GlobalChatListener implements Listener
{

    private ChatPerWorld $plugin;
    public function __construct(ChatPerWorld $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onChat(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        if (isset($this->plugin->GlobalChat[$player->getName()])) {
            $event->cancel();
            Server::getInstance()->broadcastMessage("" . str_replace(["{player}", "{msg}"], [$player->getName(), $event->getMessage()], $this->plugin->cfg->get("Format")));
        }
    }

    public function onQuit(PlayerQuitEvent $event){
        $player = $event->getPlayer();
        if (isset($this->plugin->GlobalChat[$player->getName()])) {
            unset($this->plugin->GlobalChat[$player->getName()]);
        }
    }

    public function Notification(PlayerMoveEvent $event)
    {
        $player = $event->getPlayer();
        if(isset($this->plugin->GlobalChat[$player->getName()])) {
            $player->sendActionBarMessage($this->plugin->cfg->get("Message")["GlobalChat"]["actionbar"]);
        }
    }
}
