#!/bin/bash

echo "Let's get started!"

echo -n "Want to initialize a repository? [y|n] "
read -e INITIALIZE_REPOSITORY

if [ $INITIALIZE_REPOSITORY = 'y' ]
then
    echo -n "Enter username of the repository: "
    read -e REPOSITORY_USERNAME

    echo -n "Enter repository name: "
    read -e REPOSITORY_NAME

    echo "Initializing git repository..."
    #git init

    REPOSITORY_URL="https://github.com/$REPOSITORY_USERNAME/$REPOSITORY_NAME.git"

    echo Adding origin $REPOSITORY_URL ...
    #git remote add origin $REPOSITORY_URL

    echo "Pulling from master branch..."
    #git pull origin master
fi

