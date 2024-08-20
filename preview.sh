#!/bin/bash

set -e

cd /src

# Install dependencies
composer install

# Set up db
service mariadb start
mysql < build/leaf_ota.sql

# Generate preview
echo "Linux4: $BASEURL"

bin/console -e prod stenope:build --base-url=/$BASEURL ./build/static && chmod a+rw -R .
