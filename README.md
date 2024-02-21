## Using the Postman Collection

To test the API endpoints, you can use the provided Postman collection.

1. Download the [Postman collection](postman-collection/JokerApi.postman_collection.json) file from this repository.

2. Import the collection into Postman:

   - Open Postman.
   - Click on the "Import" button.
   - Choose the downloaded JSON file.
   - The collection will be imported into Postman.

3. Once imported, you can see all the API requests in the collection. Make sure to set up the environment variables if necessary.

4. You can now send requests to the API endpoints and view the responses.


## SEQUENCE DIAGRAM
[seq-diagram.png](https://postimg.cc/3dm36pC3)


<h1> Project Setup Instructions👋 </h1>

<h4> These instructions will guide you through setting up and running the project locally on your machine. </h4>

<h5>Prerequisites</h5>
Before you begin, make sure you have the following installed on your machine:

- PHP >= 7.4
- Composer
- MySQL (or any other compatible database)
- Postman (optional, for API testing)


<h5>Installation</h5>
- Clone the repository to your local machine:
git clone https://github.com/your_username/your_project.git


-Navigate to the project directory:
cd swivt_test

-Install PHP dependencies using Composer:
composer install

-Copy the .env.example file to .env and configure your environment variables:


-Generate an application key:
php artisan key:generate

-Create an empty MySQL database for the project.


<h5>Configuration</h5>

-Open the .env file in your project root directory and update the following variables:

-DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD to match your MySQL database configuration.

-API_URL to specify the base URL of your API endpoints.

-Save and close the .env file.


<h5>Database Setup</h5>

-Run database migrations to create tables:

-php artisan migrate

<h5>Running the Application</h5>

-Start the development server:

php artisan serve

Your application should now be running locally at http://localhost:8000.

<h5>Testing</h5>

You can use Postman to test the API endpoints. Import the provided Postman collection and environment file for easy testing.

Additional Notes
If you encounter any issues during setup or usage, please reach out to me.
