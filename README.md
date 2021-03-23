# KidsLearn
A website that helps kids learn basics such as shapes, animals, and fruits. Depending on the subject that the user will pick it will show information about some of the items. They are also able to create objects by drawing or uploading a picture. If the user signs up/in they have the ability to see all the creations they have made. 
## Project Requirements
:heavy_check_mark: Separates all database/business logic using the MVC pattern.
  * Business logic and database under model folder
  * All HTML files under views folder
  * Routes to all the html files under the index.php
  * index.php calls function in Controller to get data from model and return views.
  * Classes under classes folder
  * JSON and JavaScripts under scripts

:heavy_check_mark: Routes all URLs and leverages a templating language using Fat-Free framework
  * All routes are in the index.php and leverages a templating language using Fat-Free Framework 

:heavy_check_mark: Has a clearly defined database layer using PDO and prepared statements. You should have at least two related tables.
  * All database layer is under model in data-layer.php. kidUser and creations are the related table(one to many relationship).
 
:heavy_check_mark: Data can be viewed and added.
  * Database layer uses PDO and prepared statements to add, retrieve, and delete from the database. 

:heavy_check_mark: Has a history of commits from both team members to a Git repository. Commits are clearly commented. 
  * True

:heavy_check_mark: Uses OOP, and defines multiple classes, including at least one inheritance relationship.
  * 3 classes. User, ProUser, and creation. User contains all fields such as name, grade, username, and password. ProUser extends User and contains all fields from user and subject. Creation contains fields such as name, description, type, and image to hold any creation made by user. 

:heavy_check_mark: Contains full Docblocks for all PHP files and follows PEAR standards. 
  * All PHP files contains DocBlock and Follows Pear Standards. 

:heavy_check_mark: Has full validation on the client side through JavaScript and server side through PHP.
  * User and ProUser sign up, and Creation form has full validation on client through JavaScript under scripts folder and server side through PHP.

:heavy_check_mark: All code is clean, clear, and well-commented. DRY (Don't Repeat Yourself) is practiced.
  * All functions and files are commented. 

## UML Class Diagram
  ![Screen Shot 2021-03-22 at 12 40 51 AM](https://user-images.githubusercontent.com/58874516/111955837-44994900-8aa7-11eb-9ecb-d9d7b9268365.png)

## ER Database Diagram
![Screen Shot 2021-03-22 at 12 49 32 AM](https://user-images.githubusercontent.com/58874516/111956834-7bbc2a00-8aa8-11eb-9ec7-e4c98bc3ce37.png)

