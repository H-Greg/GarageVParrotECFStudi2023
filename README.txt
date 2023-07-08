
				===== Procedure for retrieving and running a project from GitHub locally =====

This procedure will guide you through the steps to retrieve and run a project from GitHub locally on Windows.

	===== Prerequisites =====
XAMPP installed on your system (available at https://www.apachefriends.org/index.html)
	- Make sure to include Apache, MySQL, and PHP during the XAMPP installation.
Git installed on your system (available at https://git-scm.com/)
PHP installed on your system (available at https://www.php.net/downloads.php)

	===== Steps =====

1_ Install XAMPP, Git, and PHP by following the instructions provided on the official websites.
Make sure to select versions compatible with your operating system.

2_ Open XAMPP and start the Apache and MySQL modules.

3_ Open a web browser and go to the project page on GitHub: https://github.com/H-Greg/GarageVParrotECFStudi2023.
	- Click on the "Code" button (green or blue) to display the repository URL.
	- Copy the Git repository URL.

4_ Open the command prompt or Git Bash on your system or text editor.

5_ Execute the following command to clone the project (Replace <repository_URL> with the URL you copied):
git clone <repository_URL>

6_ Copy the project folder, 'GarageVParrotECFStudi2023', into the htdocs directory of your XAMPP installation.
The htdocs directory is usually located within the XAMPP installation folder (e.g., C:\xampp\htdocs).
	- (Open the XAMPP Control Panel and click on the "Explorer" button next to the Apache module.
This will open the File Explorer in the htdocs directory.)
	- Paste the project folder you previously copied.

7_ Open your web browser and access the URL http://localhost/GarageVParrotECFStudi2023.
	- Open the 'php' folder from your browser (if you're not automatically redirected, open the index.php file).

8_ Open your web browser and access the URL http://localhost/GarageVParrotECFStudi2023/php/createDatabase.
You can then close this tab.

9_ Open your web browser and access the URL http://localhost/phpmyadmin.


-------------------------------------------------------------------------------------------------------------------------------------

							//===== PHP FILE DESCRIPTIONS =====

			//===== index.php =====

	This code imports multiple PHP files to construct a web page with a header, an article, items for sale, comments, a footer, 
and a modal dialog box. The page's style is defined in an external CSS file, and interactive behaviors are defined in an external JavaScript file.

			//===== header.php =====

	This code creates a header with a logo represented by the <img> tag and a main title represented by the <h1> tag.

			//===== article.php =====

	This code displays a presentation of the garage's services and allows a logged-in administrator to edit the content 
of an article by displaying an edit button. When the button is clicked, a hidden form appears with the original content of the article. 
The administrator can modify the content in the text field and then save the changes by clicking a submit button. 
The modified content is saved in the "savedArticle.txt" file. The article itself is displayed with line breaks and escaped special characters, 
and a contact form is included at the bottom of the article.

			//===== contact.php =====

	This code displays a contact section on a web page with a phone number and an email address. 
When the user clicks on the email address, a contact form appears where the user can enter their information and send a message.

			//===== sendEmail.php =====

	This code handles sending a contact message via email. When the form is submitted, the form data is retrieved, 
and an email is sent to the specified destination address containing the form information. 
The result of sending the email is then displayed to the user.

			//===== toSell.php =====

	This code establishes a connection to a database, retrieves car data, displays the cars in a table with search filters (see main.js), 
allows an administrator or staff member to add or delete cars, and closes the database connection.

			//===== commentary.php =====

	This code allows users to submit comments and displays them on the page. 
The comments are stored in a text file and retrieved from a database. Administrators and staff members have the ability to moderate comments.

			//===== footer.php =====

	This code allows a logged-in administrator to edit the garage's opening hours. 
It displays the original content in a text field and allows the administrator to modify it. 
When the administrator submits the form, the modified content is saved in a text file.

			//===== modal.php =====

	This code creates a modal dialog box with different contents based on the user's login status and role. 
If the user is not logged in, it displays a login form. If the user is logged in as an administrator, 
it also displays a form for adding a new user. If the user is logged in as an administrator or staff member, it displays a logout button.

			//===== salary.php =====

	This code checks if the user has the "salary" role in the session. 
If they have the authorized role, it displays a complete HTML page with different imported parts. 
Otherwise, it redirects the user to the home page.

			//===== admin.php =====

	This code checks if the user has the "admin" role in the session. 
If they have the authorized role, it displays a complete HTML page with different imported parts. 
Otherwise, it redirects the user to the home page.

			//===== connexion.php =====

	This code handles connecting to a database, verifying the login credentials provided by the user, 
storing the employee's role in a session variable, and then redirecting to an appropriate page based on the employee's role. 
If the login credentials are incorrect, the user is redirected to the login page.

			//===== logout.php =====

	This code destroys the current session, resulting in the user's logout, and then redirects the user to the login page. 
This terminates the current session and ensures that the user must log in again to access protected features.

			//===== newUser.php =====

	This code handles adding a user to a database. When the form is submitted, the email is retrieved, 
a random password and unique ID are generated, and the user is added to the "employees" table in the database. 
If the addition is successful, the user is redirected to the administration page.

			//===== carModal.php =====

	This code defines a modal dialog box for adding a car. It contains a form where the user can enter car details, 
including an image, and submit them to the "newCar.php" page for further processing.

			//===== newCar.php =====

	This code handles uploading a car image from a form, moving it to a specified directory, 
saving the car information in a database, and then redirecting the user to the administration page.

			//===== commentaryModal.php =====

	This code defines a modal dialog box to display comments pending moderation. 
The comments are extracted from a text file and displayed in the modal box with options to approve or delete each comment.

			//===== validateComment.php =====

	This code retrieves a pending comment from a text file, inserts it into a MySQL database, removes the comment from the text file, 
and then redirects the user to a page with an open comment modal dialog box.

			//===== deleteComment.php =====

	This code deletes a pending comment from a text file, updates the file with the remaining comments, 
and then redirects the user to the previous page with an open comment modal dialog box.

			//===== createDatabase.php =====

	This code establishes a connection to a MySQL database, creates a database and several tables if they do not already exist, 
inserts initial data into the "employees" table, and then closes the database connection. 
It also provides a function to generate a random password.
