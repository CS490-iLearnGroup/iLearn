#!/bin/bash

# Start the first process
service mysql start
  
# Start the second process
apache2ctl -D FOREGROUND
  
# Wait for any process to exit
wait -n
wait -n
  
# Exit with status of process that exited first
exit $?