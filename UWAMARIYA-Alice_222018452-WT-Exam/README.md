
credentials for user access: username= Alice 
                             password= alice@05

credentials for loging in: email= uwamariyaalice644@gmail.com
                           password= uwama

Project name: A virtual robotics training platform system.

1. Project Structure: 

Database Structure

orders: Manages user orders for courses or resources.
certificates: Tracks certificates awarded to users upon course completion.
attendees: Lists users enrolled in specific workshops or training sessions.
instructors: Contains information about instructors conducting the workshops.
instructorworkshops: Links instructors to the workshops they are teaching.
roboticsresources: Manages the resources (like tools, software, etc.) available for the robotics courses.

Backend (PHP):

Controllers: Handle HTTP requests, perform actions on the data (CRUD operations), and return responses.
Models: Represent the database tables and contain methods for interacting with the database.
Views: Generate HTML output sent to the user's browser, displaying data and forms.
Frontend:

HTML/CSS: Structure and style the web pages.
JavaScript: Add interactivity and handle client-side logic.

2. Functionality

User Management: Users can register, log in, and manage their profiles.
Users can view available courses and enroll in them.

Course Management: Admins and instructors can create and manage courses.
Courses can include various resources, assignments, and assessments.

Workshop Management: Scheduling and managing workshops.
Tracking attendee registrations and progress.

Certificates: Issuing and managing certificates for course completion.
Users can download and view their certificates.

Resource Management: Managing the tools, software, and other resources required for the courses.
Ensuring resources are allocated efficiently.

3. Usage

Registration/Login: Users can sign up or log in to access the platform.

Course Enrollment: Browse available courses and enroll in them.

Participation: Attend workshops, complete assignments, and access resources.

Certification: Upon completing a course, users can download their certificates.

For Instructors:

Course Creation: Create new courses and workshops, specifying the curriculum and resources.

Manage Attendees: Track and manage attendees for workshops.

Grade Assignments: Review and grade assignments submitted by attendees.
For Admins:

User Management: Manage user roles, permissions, and profiles.

Resource Allocation: Ensure the right resources are available and assigned correctly.

Analytics: Generate reports on course participation, completion rates, and resource usage.
Example Workflow

User Registration:
A new user visits the platform, fills out the registration form, and creates an account.
The user logs in and browses available courses.

Course Enrollment:
The user selects a course, views its details, and enrolls.
The system updates the orders and attendees tables to reflect the enrollment.

Workshop Attendance:
The user signs up for a workshop linked to the course.
The system updates the instructorworkshops and attendees tables.




