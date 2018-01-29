# PHP-Application-To-Get-Github-Information
This is a project for REALTRUCK  ``https://www.realtruck.com/``.<br />
<br />
I made a PHP application which can take any github username as an argument and provide all the public repositories of that user along with the respective Stargazers it has in a tabular format.

# Installation
1. Check if you have PHP using ``php -v``. If you do not have PHP, install it using ``sudo apt-get install php7.0`` 
2. Download  both RealTruck.php & Table.php files from this repository into your local system. <br />
3. Place both of them in the same directory. <br />
4. Install curl using ``sudo apt-get install php-curl``, curl is a library that allows you to connect and communicate to many different types of servers with many different types of protocols. We need it to make HTTP requests. <br />
# How To Run The Application
1. Open terminal & go to the directory which has the downloaded files. <br />
2. Type ``php RealTruck.php tensorflow asc`` to run the program. <br />
<br />
You can now see all the public repositories of tensorflow (insert any other username here) in ascending order of stargazers. <br />

# What Else Can It Do ?
Type ``php RealTruck.php --help`` for all the functionalities & usage directions. <br />
<br />

### You can use the following command line arguments.
   #### Argument-1 : Github_Username <br />
   Usage: `php RealTruck.php tensorflow` <br />
   
   This prints all the public repositories of the user (tensorflow in this case) & their respective stargazers.<br />
   #### Argument-2 : Sorting Order: 'asc' or 'ascending' or 'des' or 'descending' <br />
   Usage: `php RealTruck.php tensorflow asc` <br />
   
   This prints all the public repositories of tensorflow (insert any other username here) & their respective stargazers in the ascending or descending order, in an aestheticaly pleasant table. <br />
   
   If second argument is not given, program prints repositories in alphabetical order.<br />
