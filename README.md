# API-for-product-site
## Damazlle Task
### The required steps to setup the project:
* install Laravel
 ```
composer global require laravel/installer
 ```
* download code or clone it
```
 git clone https://github.com/MhdTa/API-for-product-site-Damazlle.git
```
* set database parameter in .env file
* run migrations
 ```php
 php artisan migrate
 ```
 * run the app
 ```
 php artisan serve
 ```
 ## Signin
After entering the required information, it will be verified and authenticated

![Screenshot](images/2.JPG)
## Log in
You can also login by entering phone number and password
![Screenshot](images/4.JPG)
## products page
after login you can show all products and add a new product

![Screenshot](images/5.JPG)
## show a product
if you click on any product you can show the details:
* Seller name
* Product Publication Date
* initial Price of product
* All bids of product
* product status (sold or not sold)
* and you can add an offer if you are logged-in
![Screenshot](images/6.JPG)
### if you are the owner of the project you can:
* edit the name or price of product
* delete the product
* sell the product if you are satisfied by the highest bid

![Screenshot](images/7.JPG)
## Search for a product offered by other users by part of its name
 using laravel-searchable repo link:
 https://github.com/spatie/laravel-searchable
 only un sold products shown
 
 ![Screenshot](images/9.JPG)
 ## Notes:
 * If you are not logged-in you can only show the products
  ![Screenshot](images/1.JPG)
 * if you are sold the product you can not edit or delete it
  ![Screenshot](images/8.JPG)
 ## DataBase:
 * User Table:
   ![Screenshot](images/12.JPG)
 * Product Table:
   ![Screenshot](images/10.JPG) 
 * BidOffer Table:
   ![Screenshot](images/11.JPG) 
     #
     # Hope you liked it (: (Mohamed Taha)
