# SynapsePM
Synapse client for PocketMine like server software. Supports multiple connections.

## Warning
Please, don't use loading screen, because it works so bad sometimes.

# SPP
Synapse Proxy Version: `10`

# Config
 - `enable` - if false, plugin and all other options will be disabled;
 - `disable-rak`  - if true, disables server`s raknet and players will not able to join to server not thought proxy;
 - `entries` - list of synapse server to connect:
   - `enabled` - if false, current synapse client will be disabled;
   - `server-ip` - ip of synapse server;
   - `server-port` - port of synapse server;
   - `isMainServer` - if true, players will connect after to current server joining to synapse server;
   - `isLobbyServer` - if true, server will be used as a fallback server
   - `transferOnShutdown` - if true, all the players will be transferred to one of fallback servers on shutdown
   - `password` - password of synapse server;
   - `description` - name of current synapse client.

# API
If you want to get synapse for given player use `synapse\Player::getSynapse()`:
```
$synapse = $player->getSynapse();
```

Also you can get list of all synapse clients using `synapsepm\SynapsePM::getSynapses()`:
```
$synapses = $this->getServer()->getPlugin('SynapsePM')->getSynapses();
```
