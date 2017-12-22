#!/bin/sh
helpmsg="\tUseage: $0 <absolute path of source_path>"
if [ "$#" -eq 1 ]
then
    if [ -d $1 ]
    then
        ln -s $1 ../webproj
    else
        echo $helpmsg
    fi
else
    echo $helpmsg
    exit 1;
fi