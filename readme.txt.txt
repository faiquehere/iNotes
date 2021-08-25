PHP core project “iNotes”

User Functionalities:
{
1: User can register.
2: User can login.
3: User can create,delete,update notes. 
4: User can shorten the link.
5: User can manage the shorten link.
6: User can check clicks of the link.
7: User can contact to iNotes.
8: User can report Spam/Suspicious link.
}

Admin Functionalities 
{
1: Admin can login.
2: Admin can shorten the link.
3: Admin can block Spam/Suspicious link.
}
Guest Functionalities 
{
1: Guest can shorten the link.
2: Guest can report the link.
3: Guest can contact iNotes.
}
Database Name-> "inotes”

Table-> "users" -> for the user’s registration/login information.

Table-> "url" -> for storing the shorten URL.

Table-> "notes" -> for storing the user's notes.

Table-> "link_report" ->for reported URLs.

Table-> "contact" ->For storing the contact form details.

inotes folder files
{
header.php(header section)
index.php(index page+url shorten page)
about.php(about page)
registration.php(for user registration)
login.php(for user login)
logout.php(for logout)
dashboard.php(user dashboard for iNotes)
mylink.php(user's shorten link dashboard)
admin_dashboard.php(Admin dashboard)
report.php(link report page)
contact.php(contact page)
readme.txt(this file)
session.php(for generating session)
footer.php(footer section)

include folder->
->connection.php file
->insert.php file (for inotes dashboard)
->delete.php file (for inotes dashboard)
->update.php file (for inotes dashboard)
->status.php file (for showing messages)



}


database file-> inotes.sql 
Username & Password
for USER login
username=>user
password=>user
for ADMIN login
username=>admin
password=>admin