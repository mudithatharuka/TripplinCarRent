
# Tripplin Car Rent 

[![MIT License](https://img.shields.io/github/watchers/mudithatharuka/TripplinCarRent?style=social)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)
[![AGPL License](https://img.shields.io/github/languages/count/mudithatharuka/TripplinCarRent)](http://www.gnu.org/licenses/agpl-3.0)
[![AGPL License](https://img.shields.io/github/languages/top/mudithatharuka/TripplinCarRent)](http://www.gnu.org/licenses/agpl-3.0)
[![GPLv3 License](https://img.shields.io/github/issues/mudithatharuka/TripplinCarRent)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/github/last-commit/mudithatharuka/TripplinCarRent)](http://www.gnu.org/licenses/agpl-3.0)
[![AGPL License](https://img.shields.io/github/languages/code-size/mudithatharuka/TripplinCarRent)](http://www.gnu.org/licenses/agpl-3.0)


**Your number one source for all type of Car Renting and Car Booking.**

Tripplin Car Rent is a web-based system for renting and booking vehicles. People who has a vehcle in the home can earn some extra money by putting his/her vehicle on this website for rent. Also, people who need a vehicle for their picnic can book a vehicle as they need.

What is the main advantage of using this website for vehicle renters, rather than putting their vehicle in a car rental sale is that they can use their vehicle while renting on this website.


## Screenshots

Home Screen :

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEg1TEB28kbiGFEfqmMWGE6l-Fx_FcPzIlcKhNkuuYMz4LsYx3CkK2OzNhg2PJiQiBs6NhlfG05ngSujjyDaXFIMy4teL24FDL3faTSPe1cxdne4eaJeQdeDT4SfkczyawIlV3JLEExMw-60MR9BEilkOFG6BH-aU2QZKo_uArFir3FvFNh9W8CcZ_L-3Q=s16000)

Rent | Book :

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEisVWYopY5nQS6DhzAza04oB9uTxueES6RHolYSD2Wzwi862Gce3RjjJwi8w2rBAk5jCC_SBM6YaBybYXkDKE58FMfIvxcdjYabDfwZTrZn9L-Cz0yR5gY0M2YwbUA4djjZHwFgPjqAPEW3siE0VLcRED5PkY5UQ8J4tBzIhBNtqg4dwQeVMoUa6AU_GA=s16000)

Admin Panel :

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEgadiZrfvlhYjK6NUwRyETFRQQmStCzO3O-dRwXuVIcGAPQvT__FuMm3rJn9s1gPoSFWMfLElc6N3v9Kmdgtn7HwbkMDgtEuXv0g5kWDSWUAgNx7vSEABDT-nRKMXsBMallkuZQUya0NSey3MLyPx_sT-SXX8JtHaohamS498yCPdb0Wpdco4iyGH26xg=s16000)
## Configure the project

- You should move the project folder into the "htdocs" folder if you are using Xampp Server.  

- Create a database (you can use any DBMS) called "newtripplin". 

- ![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEgaqDl3WqyMtSofppZ1dSvcESgiqwHIsM-wEz7-tufF0tci_Ij7FUNznuqGzO1WRmJUm6d9DRWO7tnCfGuGD4rVoFz5rBkk-_iUaG-sK1xxzbL-Yr1lepFO66Q8bIfORAfdrtSoHug7sRWrA7jICGB6EU8-vzFys6S8f3HLXrO9i9nZOENezQUW4mBOtw=s16000)

- Import the database file which is in the sql folder of the project to the "newtripplin" database.

- Open the project on your browser by pasting following link on the url bar if you are yousing the default port 80.
 
```bash
  http://localhost/TripplinCarRent/
```
- In order to rent or books vehicles you need to have an account on the web site. Either you van create a new account or you can use an existing account. Account credentials are as follows
- To create a new account: 
 ```bash
  http://localhost:8080/MyRadProject/reg.php
```
- To use existing account:
  - Email: 
  
   ```bash
  workmine70@gmail.com
```
  - Password: 

  ```bash
  asdf1234
```
- You can log into the admin panel by pasting the following url on the browser url bar.
```bash
  http://localhost/TripplinCarRent/adminlogin.php
```
- Email and Password for a default admin account are as follows. Even you can create a new admin account too. But if you want to check the admin list, youu have to use the default admin account.
  - Email: 

 ```bash
  admin@gmail.com
```
  - Password:  

 ```bash
  asdf1234
```
## Security

- Even admint are not visible the user passwords of the accounts in the database
- Confidential credentials have been hashed and inserted to the database.
- Every action is take place under an admin's supervison.
- Admin's approvement is required to confirm a booking made by a customer.
- Customers can delete a bokking made by him or her self before an admin approves it. 


