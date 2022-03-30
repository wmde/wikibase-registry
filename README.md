# Wikibase Registry

This repository contains some infrastructure for the [Wikibase Registry][],
which runs as a docker-compose setup in the `wbregistry-01` instance of the `wikibase-registry` Wikimedia Cloud VPS project.

## Initial configuration

- Copy `PrivateSettings.php.template` to `PrivateSettings.php`
- Copy `env.template` to `.env`
- Fill out with actual values

## Update instructions

To update the system:

- SSH into the host: `ssh wbregistry-01.wikibase-registry.eqiad1.wikimedia.cloud`
- Get a root shell: `sudo -i`
- Go to the setup directory: `cd ~/wikibase-registry`
- Pull latest changes: `git pull`
- Apply the update: `docker-compose up --detach --build`
- Check that the system looks okay (`docker-compose ps`, `docker ps`, visit the registry in the browser…)
- Log the change with a message like this in #wikimedia-cloud on Libera Chat: `!log wikibase-registry ...`

[Wikibase Registry]: https://wikibase-registry.wmflabs.org/
