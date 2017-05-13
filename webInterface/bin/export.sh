#!/bin/bash

SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do # resolve $SOURCE until the file is no longer a symlink
  DIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"
  SOURCE="$(readlink "$SOURCE")"
  [[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE" # if $SOURCE was a relative symlink, we need to resolve it relative to the path where the symlink file was located
done

SOURCE=$(dirname ${SOURCE})

# export $(cat "${SOURCE}/../params.env" | xargs)

while IFS='=' read -r name value; do
  export "$name=${value//\"/}"
done < "${SOURCE}/../params.env"