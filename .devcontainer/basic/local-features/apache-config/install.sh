#!/usr/bin/env bash
#-------------------------------------------------------------------------------------------------------------
# Copyright (c) Microsoft Corporation. All rights reserved.
# Licensed under the MIT License. See https://go.microsoft.com/fwlink/?linkid=2090316 for license information.
#-------------------------------------------------------------------------------------------------------------

USERNAME="vscode"

set -e

if [ "$(id -u)" -ne 0 ]; then
    echo -e 'Script must be run as root. Use sudo, su, or add "USER root" to your Dockerfile before running this script.'
    exit 1
fi

# Install needed packages and setup non-root user. Use a separate RUN statement to add your own dependencies.
export DEBIAN_FRONTEND=noninteractive

apt-get update && apt-get -y install --no-install-recommends lynx
usermod -aG www-data ${USERNAME}
sed -i -e "s/Listen 80/Listen 8080/g" /etc/apache2/ports.conf
sed -i -e "s/80/8080/" /etc/apache2/sites-enabled/000-default.conf
sed -i -e "s/DocumentRoot \\/var\\/www\\/html/DocumentRoot \\/var\\/www\\/html\\/public/" /etc/apache2/sites-enabled/000-default.conf
apt-get clean -y && rm -rf /var/lib/apt/lists/*

echo "Done!"