#!/bin/sh

npm install
npm run dev

# Garder le conteneur actif en arrière-plan
tail -f /dev/null
