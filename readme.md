
Developed by: Gustavo Diniz da Corte
Email: gustavodacorte@gmail.com

# Overview

This is a generic purpose basic MVC framework built for personal uses. Also, this project makes use of middlewares to control user permissions.
The purpose of development was to have a better undertanding of the MVC architecture and to study its implementation.

# How to run:
First it is important to run composer, since its autoload and namespacing are sued to make the project function properly.
To run this project you must set it up on a apache webserver. The webserver must point to the public folder.
Inside the public folder .htaccess will redirect all incoming requests through a router and activate the controllers to return the Views. 
Plase note that since this is a very basic axample, the Model layer has not been done yet.

Please also note that it is possible to run in nginx. IN this scenario, please make a proper nginx configuration file to redirect all incoming requests to the public index.php file.

# How to develop using the framework:
In the Routes/router.php consturctor, all routes should be declared. The first part is the named route the user wishes to have and the second part is the mapping that translates this route to a controller/action route. Please note that the same route can be used for different methods as long as they map to different actinos and/or controllers.

Several controllers can and should be created. The controller, upon its contruction, should invoke a middleware, which in turn is responsible for the access-control.
Each controller action should perform its operations and render a web page. Because of the simplicity of this framework, any layer and modifications to the original architecture are possible. If you wish to return data as a service, it is possible to create a service layer for that purpose. 

There is some support for api calls through the use of tokens. Currently a token should be stablilished in a $_SESSION variable after the user is authenticated and this token should be sent along API or AJAX requests to enable its operation. please note that those should make use of a different controller than the traditional requests made through the browser due to the difference in the access control. Currently support for the communication of the API through tokens are restricted to users who have authenticated in the web version. To implement this functionality globally or to the use of a mobile app the user must implement a database where he will store a user ID and token associated to this user and a proper middleware that will check this information instead of using $_SESSION variable.

For convenience, a Modules and Common layer were created. Since a project usually tires to get the most out of reusability, the Common layer expects to hold all css, js, html and php services that will be shared across multiple modules. Please note that the Common layer can be divided in several common modules to better suit the user's needs. The Modules was designed to encompass closed modules capable of operating by themselves, with or without the Common layer. Each module will hold its own private css, js, html and php files. 

The View layer is supposed to hold the actual web page, which in turn can make use of several modules and also common modules to its operation. It is suggested that templating is done through the Common layer, since a template will be used in multiple views and to avoid code repetition.

# Final Regards:
Thank you for reading through this documentation and for your interest in this framework. Please note that since this framework is supposed to be a study case on how more robust frameworks work, this project will not be updated regularly. Please if you have any contribution you want to make to this framework, it would be more than welcome!
