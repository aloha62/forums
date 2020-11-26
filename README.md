# FORUMS API EXAMPLE

Forums API allows users to create, view, modify and delete posts.  
A user can post a post.  
A user can post many posts.  
A post can have many comments.  
A user can comment on many posts.  


# API Requirements

Public endpoints can be accessed by anyone consuming the API.  
Protected endpoints can only be accessed by an authenticated user.  
API endpoints must follow as close as possible, the JSON API specifications.  

# Notes

Authorization uses API tokens to keep things simple, since the application doesn't need a front-end I have avoided using Passport authentication and it's related views.    
The migrations, seeding and table design are kept simple with minimal constraints.  
Likewise the api is setup to run from localhost root.    

# Setup  
Create a database named forums and populate using:    
php artisan migrate  
php artisan db:seed


## API Endpoints

Test parameters are included with the endpoints to enable testing.  
Use an api_token from the users table to test authenticated endpoints.  
A 404 is thrown by default on all authentication errors.  

 
**POSTS**


_//List Posts Public_  
GET http://localhost/api/posts  

_//List Posts Protected_  
GET http://localhost/api/posts/private?api_token=SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV

_//View Post Public_  
GET http://localhost/api/posts/11  

_//View Post Protected_  
GET http://localhost/api/posts/private/11?api_token=SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV

_//Create Post_  
POST http://localhost/api/posts/create  
_(key:values)  
api_token:SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV  
title:A new post  
content:This is a new post  
published:1_  

_//Edit Post_  
PUT http://localhost/api/posts/update  
_(key:values)  
api_token:SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV  
title:An updated post  
content:This is an updated post  
published:0  
slug:an-updated-post_

_//Delete Post_  
DELETE http://localhost/api/posts/delete/11  
_(key:values)  
api_token:SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV_  




**COMMENTS**


_//List Comments for a given Post Public_  
GET http://localhost/api/comments/16  

_//List Comments for a given Post Protected_  
GET http://localhost/api/comments/private/11?api_token=SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV

_//List Comments for a given User Public_  
GET http://localhost/api/comments/user/5  

_//List Comments for a given User Protected_  
GET http://localhost/api/comments/private/user/5?api_token=SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV

_//Create Comment_  
POST http://localhost/api/comments/create  
_(key:values)  
api_token:SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV  
content:This is a new comment  
post_id:7  
published:1_  

_//Edit Comment_  
PUT http://localhost/api/comments/update  
_(key:values)  
api_token:SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV  
id:16  
content:This is an updated comment  
published:0_  

_//Delete Comment_  
DELETE http://localhost/api/comments/delete/16  
_(key:values)  
api_token:SMSXonIiH8tHsa5k5mn0EmadgnyLB8vacuVTPgHkYEYlzFipW0uMx5zItHCV_  