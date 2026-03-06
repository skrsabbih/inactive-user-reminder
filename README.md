# Inactive User Reminder System

A Laravel 12 application that automatically detects inactive users and dispatches reminder jobs using Laravel Scheduler and Queue.

---

## Setup Instructions

1. Clone the repository

git clone https://github.com/skrsabbih/inactive-user-reminder.git  
cd inactive-user-reminder

2. Install dependencies

composer install

3. Copy environment file

cp .env.example .env

For Windows PowerShell:

copy .env.example .env

4. Configure database in `.env`

Example configuration:

APP_NAME="Inactive User Reminder"  
APP_ENV=local  
APP_KEY=  
APP_DEBUG=true  
APP_URL=http://127.0.0.1:8000  

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=inactive_user_reminder  
DB_USERNAME=root  
DB_PASSWORD=root  

QUEUE_CONNECTION=database  

INACTIVE_USER_DAYS=7

5. Generate application key

php artisan key:generate

6. Run migrations

php artisan migrate

7. Seed test data (included for easy testing)

php artisan db:seed

The project already includes seed data so the system can be tested quickly.  
The seed creates example users including:

- An inactive user (last login more than 7 days ago)
- An active user (recent login)

This allows the reminder detection system to be tested immediately.

---

## How to Run the Scheduler

Run the Laravel scheduler locally:

php artisan schedule:work

You can also manually trigger the scheduler once:

php artisan schedule:run

---

## How to Run the Queue Worker

Start the queue worker to process reminder jobs:

php artisan queue:work

---

## How the System Works

1. A scheduled command runs daily.
2. It finds users who have not logged in for the configured number of days.
3. It checks if a reminder has already been sent to the user today.
4. If not, it dispatches a queued job.
5. The queued job simulates sending a reminder by logging the event in the `reminder_logs` table.

---

## Author

Md. Sabbih Sarker
