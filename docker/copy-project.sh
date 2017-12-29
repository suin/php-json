#!/usr/bin/env sh
set -eux
rm -rf /project-copy/*
cp -R /project/* /project-copy/
cd /project-copy
rm -rf vendor composer.lock
composer -n install
[[ $# -ne 0 ]] && $@
