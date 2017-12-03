Social network

Intro 

You can see how the web site works: http://www.dragan-jankovic.info/

The main purpose of the site is to demonstrate my Laravel capabilities. It also proves that I can use Twitter Bootstrap framework as well as jQuery library with AJAX. I have also created the model of the database.

I have used a free template from https://w3layouts.com/ which I have modified only to add some functionalities to the site. The template is responsive, Bootstrap based.

Site functionalities 
The whole site is developed with Laravel 5.4 framework.
The site gives the following functionalities (the list is not exhaustive):
1.	It allows users to register and subsequently log in and out,
2.	After registration, a profile is created which is the possible to expand by providing a picture and additional info,
3.	The home page holds the wall with posts created by registered users,
4.	Registered users can comment on the posts thus developing active discussions, like, unlikec etc.
5.	Every posts shows the number of likes, date of creating post, comments,
6.	It gives the users possibilities to create interest groups,
7.	They can join groups- the creator of the group can exclude them,
8.	They can make friends by sending a request and accepting it. 

Site structure and my approach to building this site
I have used Laravel main features in developing the site:
1.	I have used Eloquent for most of the relations like User-Post (One-To-Many), User-Comment (One-To-Many), Post-Comment(One-To-Many), User-Group (Many-to-Many) which required a pivot table etc.
2.	Additionally, I have used DB Query Builder for some database manipulation actions to prove my competence it that segment too (so some relationships are intentinally not mapped by their respective models).
3.	I have used artisan CLI for making models, controllers, migrations etc.
4.	I have used the Blade template engine quite extensively for @if, @foreach, @include and many other actions, 
5.	I have used View Composer for providing the data for the sidebar (which is a part of every page),
6.	Routes are protected by middleware (‘auth’, ‘guest’),
7.	Some actions that are implemented with GET request are protected with a bit of logic in controllers requiring a user to be signed in and to be the right one for the action (e.g. if you accepting a friend, you must be the user whom the request was sent and many other)

jQuery and AJAX  usage:
Even though all functionalities could have been attained by using PHP and Laravel, I have intentionally used jQuery for some DOM manipulation like showing form for sending messages when clicked, traversing the DOM and displaying some alerts. 
I used jQuery with AJAX for storing the messages in the database.

This is in short what this project is about and how it was technically implemented.   
PS: I will shortly work out this site through a RESTfull concept with Angular 4 at the front and Laravel at the back-end.
