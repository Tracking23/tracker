Project Setup

1.  **Database Creation:**
    * Create a MySQL database named "tracker".

2.  **Environment Configuration:**
    * Rename the file ".env.example" to ".env".
    * Configure the database settings within the ".env" file.

3.  **Dependency Installation and Migration:**
    * Execute the command: `composer update`
    * Execute the command: `php artisan migrate`

4.  **Client Seed Data:**
    * Open the file "database/seeders/ClientSeeder.php" and populate it with sample client data.
    * Execute the command: `php artisan db:seed ClientSeeder`

5.  **Website Seed Data:**
    * Open the file "database/seeders/WebsiteSeeder.php" and add the URLs of the websites you wish to track.
    * Ensure to correctly assign the "client_id" values based on the clients created in the previous step.
    * Execute the command: `php artisan db:seed WebsiteSeeder`

Website Tracker Integration

1.  **Embed Tracking Script:**
    * Insert the following script into the HTML of every page you want to track:
        ```
        <script id="tracker_script" src="<your_website_url>/tracker.js" data-client-id="2"></script>
        ```
    * Replace `<your_website_url>` with the URL of your client website.
    * Set the `data-client-id` attribute to the correct client ID (the "id" column value from the "clients" table) that corresponds to the website being tracked.

Database Information

* Database dumps and schema files are provided within the project:
    * "tracker_dump.sql"
    * "tracker_schema.sql"

Tracking Details User Interface

* After completing the setup, the application's primary function is to display tracking information.
* You can select a date range and a specific website to view visit details.
* The interface will display a list of visited pages and the number of unique visits within the chosen date range.