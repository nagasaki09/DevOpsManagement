#!/bin/sh

expect -c "
set timeout 5
spawn ssh  atfworks@172.16.1.84
expect \"Password:\"
send \"yoikuuki\n\"
interact
"
docker ps --format "{{.Names}}: {{.Image}}: {{.CreatedAt}}: {{.RunningFor}}: {{.Status}}: {{.Labels}}"