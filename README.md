🚀 BOS Mini Module – Project & Task Management (Laravel 12)

This is a mini-module built in Laravel 12 as part of a technical assessment.
It implements a small Project & Task Management module with:

Project View and Add (API)
Projects are assign to task
Authorization using Policies
Task creation notifications (Queued Email)
API Resources for clean API responses
Filtering, pagination, and eager loading


📦 Features Implemented
✅ Authentication
Login Endpoint
Logout Endpoint

✅ Project Management

Create project
List projects (filtered by logged-in user)
Show single project with tasks (eager loaded)

✅ Task Management
Add tasks to a project

Assign user to task
Load assigned user in API

✅ Policies / Authorization

Only project owners can:
View a project
Add tasks to their project

✅ Queued Email Notification
When a task is created, a queue job is dispatched
Job sends an email notification to the assigned user

✅ API Resources
Consistent formatting using:
ProjectResource
TaskResource

🛠️ Tech Stack

Laravel 12
MySQL
Laravel Policies
Laravel Notifications
Laravel Queue (database driver)
Mailtrap (SMTP)

📥 Installation Guide

1️⃣ Clone the Repository
git clone <your-repo-url>
cd bos-mini-module

2️⃣ Install Dependencies
composer install

3️⃣ Copy & Configure .env
cp .env.example .env
php artisan key:generate

Update the following values (Mailtrap example):

DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@example.com"
MAIL_FROM_NAME="BOS System"

4️⃣ Run Migrations
php artisan migrate:fresh --seed

Also create queue tables:
php artisan queue:table
php artisan migrate

5️⃣ Start Queue Worker
Required for sending emails.
php artisan queue:work

👤 Dummy Users (for Testing)

After installation, you will automatically get 4 test users seeded into the database.
email:- test@gmail.com, Password:- Password@123
email:- demo@gmail.com, Password:- Password@123
email:- john@gmail.com, Password:- Password@123
email:- doe@gmail.com, Password:- Password@123


📡 API Endpoints

All routes are protected using auth:sanctum.
Use a valid token in headers:

Authorization: Bearer <token>

🔹 Projects API
1. List Projects (filtered by logged-in user)
GET /api/projects

2. Create Project
POST /api/projects

3. Get Single Project with Tasks
GET /api/projects/{project}

🔹 Task API
POST /api/projects/{project}/tasks

🔐 Authorization Rules
Only owner can view the project
Any authenticated user can create Project
Only project owner can create task

✉️ Email Notification (Queued)

SendTaskNotificationJob is dispatched
Job loads assigned user
Sends mail using TaskCreatedNotification
Mail is sent via Mailtrap SMTP