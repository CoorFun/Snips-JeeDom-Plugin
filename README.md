<img align="right" src="/docs/AI_devices.png" width="350">

[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/snipsco/snips-jeedom-plugin/blob/master/LICENSE)
[![Version](https://img.shields.io/badge/version-0.1.6-brightgreen.svg)](https://github.com/snipsco/snips-jeedom-plugin/blob/master/CHANGE_LOG.md)

# snips-jeedom-plugin

This is the official Snips plugin designed for [Jeedom](https://www.jeedom.com/) home automation platform.

This plugin comes with an user-friendly visual interface, which allows Jeedom user to bind their connected device action with Snips voice assistant.

## User Guide

Please reach ***[Snips Dev Center](https://docs.snips.ai/)*** for the user documentation.

- ***[English Version](https://docs.snips.ai/articles/raspberrypi/jeedom/en)***

## Installation

### From Jeedom Plugin Market

<p align="center">
    <img src="docs/snips_jeedom_market.png" width="650">
</p>

### Manual Installation

**Step 1**

Clone this repository onto your target device holding Jeedom platform:

```bash
git clone https://github.com/snipsco/snips-jeedom-plugin.git
```

**Step 2**

Move plugin to Jeedom plugin directory:

```bash
sudo mv snips-jeedom-plugin/ /var/www/html/plugins/snips/
```

**Step 3**

Change permission to `775`:

```bash
sudo chmod -R 775 /var/www/html/plugins/snips/
```

Change user group to `www-data`:

```bash
sudo chgrp -R www-data /var/www/html/plugins/snips/
```

Change ownership to `www-data`:

```bash
sudo chown -R www-data /var/www/html/plugins/snips/
```

**Step 4**

Open Jeedom plugin management page, select `snips`. Then activate plugin and install dependancy.

Once the daemon is successfully launched, Snips plugin is ready to fly.

## Setup Jeedom Developing Environment

**Pré-requis**

`Docker` need to be installed on your OS.

> ***Note: setp 1-2 can be done by the script [`dev_script/docker_setup.sh`](https://github.com/snipsco/Snips-Jeedom-Plugin/blob/master/dev_script/docker_setup.sh)***

**Step 1**

Get the mariadb image at tag 10.1.37 (Not the latest):

```bash
docker pull mariadb:10.1.37
```

Create the local container for mysql:

```bash
sudo docker run \
    --name jeedom-mysql \
    -v ${SHELL_FOLDER}/../.docker/mysql:/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=root \
    -d mariadb:10.1.37
```

> `--name`: container name.
> `-v`: mount host volume to a container directory.
> `-e`: set environment variable (root password).
> `-d`: run the container as a daemon.

**Step 2**

Get the latest jeedom image:

```bash
docker pull jeedom/jeedom
```

Create the local container for jeedom:

```bash
sudo docker run \
    --name jeedom-server \
    --link jeedom-mysql:mysql \
    --privileged \
    -v ${SHELL_FOLDER}/../.docker/server:/var/www/html \
    -e ROOT_PASSWORD=root \
    -p 9080:80 \
    -p 9022:22 jeedom/jeedom
```

> `--name`: container name.
> `--link`: link to jeedom database container.
> `--privileged`: assign real root permission to root user.
> `-v`: mount a host directory to a container directory.
> `-e`: set environment variable (root password).
> `-p`: map host port to a contain port.

**Step 3**

Access `localhost:9080` to install.

| DB Parameters |  Value          |
| :---:         |  :---:          |
| host          | See comment [1] |
| port          | `3306`          |
| user          | `root`          |
| pass          | `root`          |
| name          | `jeedom`        |

> [1]
>
> To get the database ip address, looking into the MariaDB container
>
> `docker exec -it jeedom-mysql /bin/bash`
>
> Check the hosts binding
>
> `more /etc/hosts`

## Working Mechanism

<p align="center">
    <img src="docs/flow_chart.png" width="780">
</p>

## Contributing

Please see the [Contribution Guidelines](https://github.com/snipsco/Snips-Jeedom-Plugin/blob/master/CONTRIBUTING.md).

## Copyright

This library is provided by [Snips](https://www.snips.ai) as Open Source software. See [LICENSE](https://github.com/snipsco/Snips-Jeedom-Plugin/blob/master/LICENSE) for more information.
