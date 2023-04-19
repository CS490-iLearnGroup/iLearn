#!/bin/bash

# Start the first process
apache2ctl -D FOREGROUND
  
# Start the second process
service mysql -u root
  
# Wait for any process to exit
wait -n
wait -n
  
# Exit with status of process that exited first
exit $?