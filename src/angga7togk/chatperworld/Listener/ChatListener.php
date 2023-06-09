<?php

namespace angga7togk\chatperworld\Listener;

use angga7togk\chatperworld\ChatPerWorld;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\player\Player;

class ChatListener implements Listener
{

    public ChatPerWorld $plugin;

    public function __construct(ChatPerWorld $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onChat(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        $recipients = $event->getRecipients();
        foreach ($recipients as $key => $recipient) {
            if ($recipient instanceof Player) {
                if ($recipient->getWorld() != $player->getWorld()) {
                    unset($recipients[$key]);
                }
            }
        }
        $event->setRecipients($recipients);
    }
}
