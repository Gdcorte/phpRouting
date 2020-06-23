
Developed by: Gustavo Diniz da Corte
Email: gustavodacorte@gmail.com

This is a generic purpose basic MVC framework built for personal uses. Also, this project makes use of middlewares to help control user permissions.
The purpose of development was to have a better undertanding of the MVC architecture and to study its implementation.

How to run:
First it is important to run composer, since its autoload and namespacing are sued to make the project function properly.
To run this project you must set it up on a apache webserver. The webserver must point to the public folder.
Inside the public folder .htaccess will redirect all incoming requests through a router and activate the controllers to return the Views. 
Plase note that since this is a very basic axample, the Model layer has not been done yet.

Please also note that it is possible to run in nginx. IN this scenario, please make a proper nginx configuration file to redirect all incoming requests to the public index.php file.
