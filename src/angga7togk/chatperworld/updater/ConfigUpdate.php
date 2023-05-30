<?php

namespace angga7togk\chatperworld\updater;

use angga7togk\chatperworld\ChatPerWorld;

class ConfigUpdate {

	public ChatPerWorld $plugin;

    public function __construct(ChatPerWorld $plugin) {
        $this->plugin = $plugin;
    }

    public function ConfigUpdate(){
        if($this->plugin->cfg->exists("Config-Version")){
            if($this->plugin->cfg->get("Config-Version") == ChatPerWorld::cfgversion){
                $this->plugin->saveResource("config.yml");
            }else{
                rename($this->plugin->getDataFolder(). "config.yml", $this->plugin->getDataFolder()."config_old.yml");
                $this->plugin->saveResource("config.yml");
            }
        }
    }
}