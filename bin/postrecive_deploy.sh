#!/bin/bash
git --work-tree=/var/www/html --git-dir=/home/user/repo.git checkout -f
echo "Website deployed successfully!"