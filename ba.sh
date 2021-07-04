#!/usr/bin/env /bin/bash

Green='\033[1;92m'    # Green
Blue='\033[1;34m'       # Blue
Reset='\033[0m'       # Text Reset

PROJECT_HOME=''

# Fix needed by macOS 10.15 Catalina
if [ "$(uname)" == "Darwin" ]; then
  OS_VERSION=`sw_vers -productVersion`

  if [[ $OS_VERSION == "10.15"* ]]; then
    PROJECT_HOME='/System/Volumes/Data'
  fi
fi

PROJECT_HOME="${PROJECT_HOME}$(cd -P -- "$(dirname -- "$0")" && pwd -P)"

DOCKER_COMPOSE_DEV=./docker/docker-compose.yml

while [[ $# -gt 0 ]]
do
  key="$1"

  case "$key" in
    up)
      if test -f "$DOCKER_COMPOSE_DEV"; then
        docker-compose -f "$DOCKER_COMPOSE_DEV" --env-file .env up -d --build --force-recreate
      else
          echo "$DOCKER_COMPOSE_DEV does not exists! Maybe you need create it."
      fi
      exit
    ;;

    down)
      if test -f "$DOCKER_COMPOSE_DEV"; then
        docker-compose -f "$DOCKER_COMPOSE_DEV" down
      else
          echo "$DOCKER_COMPOSE_DEV does not exists! Maybe you need create it."
      fi
      exit
    ;;

  esac

  shift
done

echo -en """
Commands:
  - ${Green}up${Reset}: execute docker-compose up
  - ${Green}down${Reset}: execute docker-compose down
"""
