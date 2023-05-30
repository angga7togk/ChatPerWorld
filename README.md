# 💬ChatPerWorld
To Separate Messages In A Specific World

[![](https://poggit.pmmp.io/shield.state/ChatPerWorld)](https://poggit.pmmp.io/p/ChatPerWorld)
<a href="https://poggit.pmmp.io/p/ChatPerWorld"><img src="https://poggit.pmmp.io/shield.state/ChatPerWorld"></a>

</br>

# 🗨Commands
| Command | Description | Permission | Default |
| --- | --- | --- | --- |
| `/gchat` | enable or disable GlobalChat Mode | `chatperworld.globalchat.command` | op |

</br>

# 🛠Config
```
# Prefix
Prefix: "§6[CPW]§r"

# Format Global Chat
Format: "§d[Global] {player} > {msg}"

# Message
Message:
  GlobalChat:
    enable: "§aEnabled GlobalChat Mode!"
    disable: "§cDisabled GlobalChat Mode!"
    actionbar: "§aYour Enabled GlobalChat Mode!"
  Blacklist-WorldChat: "§cit is forbidden to send messages in this world"

# Forbids players from Sending Messages in this world
Blacklist-WorldChat:
- lobby1
- lobby2

# Config Version
Config-Version: "2.0"
```