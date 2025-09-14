# Bizadmin

this project is developed in Codeignitor 3, bootstrap 5 and tailwind css, using HMVC architecture of CI 3


Prerequisites :
Php 7.4
Mysql 8
Tailwindcss

=============================================

STEPS  FOR SETUP  :

-- clone the main branch
-- import database from refrence.sql file located at the root
-- make sure superadmin files can only be changed at the production level
-- run npm install 
-- composer install
-- setup tailwind css locally so UI doesn break
-- make sure proper env. is setup for windows/linux etc to run CI project
-- bizadmin.com.au/cjs will be the test tenant for any development work
-- please note :  we have different database for different tenant so changes in one table needs to done across all tenants database


================== Further improvements : ===========================
-- we need to merge bootstrap and tailwind css to work together without breaking any UI
-- need to setup some "PHPUnit" library for testing 
-- slowly we need to move all UI from bootstrap to tailwind css to make all bizadmin pages uniform
