#!/bin/bash
sudo mysql ruzky < otp10decrypt.sql
sudo mysql ruzky < rls_added.sql
sudo ./delete_users.sh ruzky
sudo ./create-anonymous-customer.sh
sudo ./auto-create-delete-customers_cron.sh
