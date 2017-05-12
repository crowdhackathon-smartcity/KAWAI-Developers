#symfonyAdminLTE

## What is symfonyAdminLTE?

A combination of AdminLTE template ( <https://almsaeedstudio.com/themes/AdminLTE/index2.html> ) with symfony (<http://symfony.com/>) and FosUserBundle (<https://github.com/FriendsOfSymfony/FOSUserBundle/>) including various usefull javascript and css Libraries such as:

1. jquery, jquery-ui
2. bootstrap
3. icheck
4. xeditable
5. fastclick
6. font-awesome

## Installation

Do the following with the order provided:
1. Run `git clone` the repository
2. Configue the parameters either by replacing the `getEnv()` functions in `app/config/parameters.php` with appropriate values or by exporting the correct enviromental variables that is passed as argument in `getEnv()` function. 
3. Run `composer update` in order to install the required php libraries
4. Run `sudo npm install -g gulp` (optional `sudo` command depending if you rn as root or not)
5. Run `npm install` to install the local needed gulp
6. Run `bower install` to install all the 3rd party asset libraries
7. Run `gulp` to put them into the correct folder
8. Run `php bin/console doctrine:database:create`
9. Run `php bin/console doctrine:schema:create`
10. Run `php bin/console server:start` Alternmatively you can use your own server

And you are ready to rock 'n' roll ;).

Also when using apache webserver for development you may need to fix the permissions to `./var` folder.

## Enviromental Varialbes

### Enviromental variables used
By default the following enviromental variables are used:

#### Enviromental variables for database setings

Name | Description
--- | ---
SYMFONY__database_host | The address where the application will communicate with the database
SYMFONY__database_port | The network port where the database will communicate with the database
SYMFONY__datrabase_name | The database that the application will use
SYMFONY__database_user | The user where the database will use
SYMFONY__database_password | The password where the database will use

#### Enviromental Variables for email settings

Name | Description
--- | ---
SYMFONY__smtp_host | The email sending service
SYMFONY__smtp_use_ssl | Takes values **true** or **false** and determins if ssl wil be used
SYMFONY__smtp_port | The port of smtp server
SYMFONY__smtp_user | The user of the smtp server
SYMFONY__smtp_password | The password of the smtp user

#### Enviromentaql VAriables for miscellanous settings 

Name | Description
--- | ---
SYMFONY__app_name | Sets the application name

### Tools for Enviromental varialbes

As you will see there is a file named `params.env.dist` that you can use it in order to export enviromental varialbes. In order to use it please follow theese steps:

1. Copy paste the `params.env.dist` into a new file names `params.env`
2. Edit the `params.env` file and replace the values in `#` with the appropriate text.
3. Run the following command:
   ```
   . ./bin/export.sh
   ```
   In order to export them as shell parameters.

## Questions

1. Where the installed libraries can be found?

   After you run `gulp` all the frontend libraries will be found on `./web/assets` folder

2. How can I install my own libraries?

   If the library ids a javascript one jut put into the `bower.json` file on `dependencies` section if thew library does not get provided via bower then try to use the github respository. Please have a look on `bower.json` in order to fidure out how to use it. If the library is a php one then use the composer as described [there](https://getcomposer.org/doc/01-basic-usage.md).
  
3. How I will search any authentication related issue?

   Anything for authentication registration and profile editing is resposneible the symfony's FosUserBundle. Also all the views and translations are ovveridden in `app/Resources/FOSUserBundle` in order to comply with AdminLte's view.

