
## Set Up

Follow the instructions here: https://laravel.com/docs/10.x/sail#installing-composer-dependencies-for-existing-projects

Copy .env.example and enter the Wonde API credentials and a default admin email and password. 

Set up your sail alias if you haven't already: https://laravel.com/docs/10.x/sail#configuring-a-shell-alias

Start sail in detached mode `sail up -d`. Run `sail artisan migrate:fresh` to populate the database with a default user.

The front end uses vite, and can be started with the command `sail npm run dev`

## Usage

Go to http://localhost and enter your login details.

On the dashboard, you can select a teacher to view their upcoming timetables. Select a date tab, and then a class to see who the attendees are for that day. 


## About 

The system is build using Laravel 10 with the Jetstream start kit for Auth and basic scaffolding, and uses the InteriaJS library for the front end, along with Vue3.

Each lookup is cached for 1 hour to prevent excessive API calls. 
