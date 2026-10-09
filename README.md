# Tasks for Today

A CodeIgniter 4 task management project with a daily task view, complete task list, demo profile, and project information page.

## Pages

- `/` shows only tasks scheduled for today.
- `/tasks` shows every task ordered by date.
- `/profile` shows the demo user's profile.
- `/about` describes the project and developer.

## Database setup

The app uses the existing MySQL `labtan` database configured in `app/Config/Database.php`. Keep this connection pointed at the database used for your activity.

For local browser testing with `php spark serve`, set `app.baseURL` in `.env` to `http://127.0.0.1:8080/`. Keep the deployed site's URL in its production configuration.

Run the demo seeder from the project directory:

```console
php spark db:seed TasksDemoSeeder
```

The seeder adds enough task examples to ensure at least eight tasks across today and two earlier dates, without deleting existing tasks. Before it replaces the live `users` rows with the single `demo_user` record, it copies existing rows into `users_archive` and verifies that they are archived. Existing `users_archive` rows are retained.

The application timezone is set to `Asia/Manila`; change `appTimezone` in `app/Config/App.php` if the activity uses a different local timezone.
