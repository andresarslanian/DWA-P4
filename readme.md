# Project 4

## by Andres Arslanian

In Buenos Aires, Argentina (city and country where I was born and live), there's an ongoing project of Philips to replace all the lights of the streets by LED lights, allowing to save more than 50% in energy consumption of the lights (to read more about the project here's a link http://www.newscenter.philips.com/main/standard/news/press/2013/20131016-philips-renews-the-street-lighting-system-of-buenos-aires-with-led-technology.wpd#.U-OJOIBdXIo).

Philips has two big jobs: one is the installation of the lights and the other one is the maintenance of them, replacing them when they break, etc.  For the maintenance, they sub-contract 6 different companies that are responsible of each zone of the city.

The challenge they have is documenting and tracking correctly which lights have been replaced, where they are installed, to know why they had to be substituted, etc.  Actually, they do this with Excel sheets, having with each of the 6 maintainers a different Excel sheet, each with their own style and information.

I was asked to make a web application for them, very similar to a ticketing system. The idea is to have a place where to report incidents, the action taken with those incidents and finally save if a light was replaced or not.

The application should have:
- Different access levels.
- Different scope of what each company can see, maintaining confidentiality between companies.
- Be able to assign a owner to an incident and send an email when the incident is created.
- When a replacement is created, allow the users to select the serial of a lamp of the available lamps in the warehouse and not any serial number, minimizing the error of the users.
- Have a centralized managing system of the incidents and replacements.

So I thought why not implement it in Laravel!

First I designed my UML according to the next image:

![Alt text](https://github.com/andresarslanian/DWA-P4/blob/master/public/assets/images/DWA_P4.png "UML")


The different permission levels I solved it with a package ('entrust') that added the tables shown in green and added functionality in the code such as checking if a user has a permission or not.

With this I created the following roles that have the following permissions:

Viewer Role:
----------
 * 'view_incidents'
 * 'view_replacements'
 * 'export_data'

User Role:
----------
 * 'create_incidents'
 * 'create_replacements'
 * 'modify_incident'
 * 'upload_lamps'				 	//* For Philips employees

Admin Role:
-----------
 * 'create_users_for_company'
 * 'modify_users_for_company'
 * 'view_users_for_company'
 * 'view_all_incidents' 			//* For Philips employees
 * 'view_all_replacements' 			//* For Philips employees

Super Admin Role:
-----------------
 * 'create_all_users'
 * 'create_companies'
 * 'view_companies'
 * 'view_all_users'
 * 'modify_companies'
 * 'modify_all_users'

The idea is that the lower roles inherit all the permissions of upper roles, so basically the Super Admin can do everything.

Considering these permission levels, different actions can be taken based in the permission assigned. The idea behind this is to give them a system that can be maintained and managed by them. So a Super Admin is intended to be only of Philips and allow him to manage users of every company and companies themselves. 

At the same time, give them the chance to give the Maintenance Companies the possibility of being administrators of their company.

Next, all the modules that appear in Orange are just reference tables.

Finally the blue modules that are the core of the application:

- Users create incidents and assign them to an owner (a company, that will receive a mail that the incident has been created).
- An incident can have many replacements, for example a whole block had a power problem and all the lights were burnt.


## User Access

For accessing the site, here are the credentials:
1)
Email: test@mydomain.com
Pass: test
Role: Super Admin
Company: Philips

2)
Email: robert.thompson@mycompany.com
Pass: test
Role: User
Company: Philips

3)
Email: test@company.com
Pass: test
Role: Admin
Company: Autotrol

4)
Email: mary.nice@mycompany.com
Pass: test
Role: Viewer
Company: Autotrol


Unless you find any bugs, the site is ready to be used (well, as soon as I solve some pending points), but the core at least is working.


I hope you enjoy it!.


### Pending

* Comments in the code are still very poor :(
* The lamps will be uploaded from a csv file. It is still not implemented since the columns have not been yet defined.
* When an incident is created, although the development includes working methods that send mails, I'm still not sending them since it hasn't been yet defined the actions that shoot an email.
* Minor improvements that haven't yet been defined as for example, when a Replacement is created, being able to write down the old and the new serial numbers of the lamps. This yet has to be defined.


