Taskforce API Library for PHP
=============================

Use Taskforce to convert emails into tasks, so you can save time and stay organized. Taskforce integrates into your Gmail inbox using a browser extension so you can manage all your tasks from within your emails.

Taskforce, as well as providing extensions for browsers, allows developers to integrate the service into their applications with the [Taskforce API](http://www.taskforceapp.com/api). 

This library is a work in progress, and will allow you to quickly access methods of the Taskforce API from within your scripts written in [PHP](http://php.net). 

### API Methods

To use the methods, you need to create a new Taskforce object. This takes two parameters, the user's username and their password. Save this object to a variable, and then you can call the methods on that user. **The only exception to this is the createUser() method, which is a static function called through Taskforce::createUser("username", "password").** If you're confused, take a look at test.php to see how things work.

All the methods in the [Taskforce API](http://www.taskforceapp.com/api) are available, except for the Reorder Tasks method which is yet to be implemented due to some weird problem that I'm having with it.

All the method names for the library are pretty much as you would expected **(except for a few exceptions which I will tell you below)** - take a look at the [API page](http://www.taskforceapp.com/api) and use the names there, but instead of using spaces, change the names into camelCase. For example, for the method called **Create User**, you would use the method **createUser()**. The parameters are then as you would expect, in the order that they are shown in the documentation - so just follow that. 

**Anyway, as I said, a few methods have different names to what you would expect where there are two methods named the same on the API documentation. For the "Get Tasks", "Add Collaborator" and "Remove Collaborator" methods for Lists, the method names are "listGetTasks", "listAddCollaborator" and "listRemoveCollaborator" respectively.**

If the method worked out satisfactorily, which it should do providing you didn't get any parameters wrong, you will receive the JSON object returned back, in the form of a JSON object, not a string. If there's a problem, the method will return false. The only exception to this is the createUser() method, which returns true if everything went okay, and false if it didn't.



---
Released under the [Apache License Version 2.0](http://www.apache.org/licenses/LICENSE-2.0). The full license text is included in the "LICENSE" file. **Created by [Tim Rogers](http://www.twitter.com/timrogers), an employee of Tyrant Inc, the creators of [Taskforce](http://www.taskforceapp.com).**