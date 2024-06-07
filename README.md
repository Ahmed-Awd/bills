## Project Setup Instructions

1. **Clone the Project:**
   ```
   git clone https://github.com/Ahmed-Awd/bills
   ```

2. **Environment Setup:**
   - Copy `.env.example` to `.env`
   - Create an empty database and update database credentials in the `.env` file
   ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=bills
    DB_USERNAME=root
    DB_PASSWORD=
   ```

3. **Install Dependencies:**
   ```
   composer install
   ```

4. **Generate Laravel Application Key:**
   ```
   php artisan key:generate
   ```

5. **Run Database Migrations:**
   ```
   php artisan migrate
   ```

6. **Seed the Database:**
   ```
   php artisan db:seed
   ```

7. **Mail Configuration:**
   - Update `.env` with the following mail settings:
     ```
     MAIL_MAILER=smtp
     MAIL_HOST=sandbox.smtp.mailtrap.io
     MAIL_PORT=587
     MAIL_USERNAME=username
     MAIL_PASSWORD=password
     MAIL_ENCRYPTION=tls
     MAIL_FROM_ADDRESS=example@example.com
     MAIL_FROM_NAME=bills
     ```

8. **Set up Mail Queue Connection:**
   Update `.env` to use the database queue:
   ```
   QUEUE_CONNECTION=database
   ```

9. **Import Postman Collection:**
   Import the provided Postman collection included in the project files

10. **Start the Application:**
   Run the server:
   ```
   php artisan serve
   ```

These steps will guide you through setting up the project for seamless functionality.