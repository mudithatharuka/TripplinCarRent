
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

### Home Screen :

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEg1TEB28kbiGFEfqmMWGE6l-Fx_FcPzIlcKhNkuuYMz4LsYx3CkK2OzNhg2PJiQiBs6NhlfG05ngSujjyDaXFIMy4teL24FDL3faTSPe1cxdne4eaJeQdeDT4SfkczyawIlV3JLEExMw-60MR9BEilkOFG6BH-aU2QZKo_uArFir3FvFNh9W8CcZ_L-3Q=s16000)

### Rent | Book :

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEisVWYopY5nQS6DhzAza04oB9uTxueES6RHolYSD2Wzwi862Gce3RjjJwi8w2rBAk5jCC_SBM6YaBybYXkDKE58FMfIvxcdjYabDfwZTrZn9L-Cz0yR5gY0M2YwbUA4djjZHwFgPjqAPEW3siE0VLcRED5PkY5UQ8J4tBzIhBNtqg4dwQeVMoUa6AU_GA=s16000)

### Admin Panel :

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEgadiZrfvlhYjK6NUwRyETFRQQmStCzO3O-dRwXuVIcGAPQvT__FuMm3rJn9s1gPoSFWMfLElc6N3v9Kmdgtn7HwbkMDgtEuXv0g5kWDSWUAgNx7vSEABDT-nRKMXsBMallkuZQUya0NSey3MLyPx_sT-SXX8JtHaohamS498yCPdb0Wpdco4iyGH26xg=s16000)
## Configure the project

- You should move the project folder into the "**htdocs**" folder if you are using Xampp Server.  

- Create a database (you can use any DBMS) called "**newtripplin**". 

 ![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEgaqDl3WqyMtSofppZ1dSvcESgiqwHIsM-wEz7-tufF0tci_Ij7FUNznuqGzO1WRmJUm6d9DRWO7tnCfGuGD4rVoFz5rBkk-_iUaG-sK1xxzbL-Yr1lepFO66Q8bIfORAfdrtSoHug7sRWrA7jICGB6EU8-vzFys6S8f3HLXrO9i9nZOENezQUW4mBOtw=s16000)

- Import the database file which is in the sql folder of the project to the "**newtripplin**" database.

- Open the project on your browser by pasting following link on the url bar if you are yousing the default port 80.
 
```bash
  http://localhost/TripplinCarRent/
```
- In order to rent or books vehicles you need to have an account on the web site. Either you van create a new account or you can use an existing account. Account credentials are as follows
  - To create a new account: 
 ```bash
     http://localhost/TripplinCarRent/reg.php
```
- To use existing account:
  - Email & password:
 ```bash
     workmine70@gmail.com
``` 
```bash
    asdf1234
```
- You can log into the admin panel by pasting the following url on the browser url bar.
```bash
  http://localhost/TripplinCarRent/adminlogin.php
```
- Email and Password for a default admin account are as follows. Even you can create a new admin account too. But if you want to check the admin list, youu have to use the default admin account.
  - Email & password:
```bash
     admin@gmail.com
``` 
```bash
     asdf1234
```
## Deployment

After successfuly configuring the project, the home page of the website can be seen. To check the available vehicles for booking user should go to the "**SHOWROOM**" or "**Book A Car**" page, by clicking those buttons on the home page. So the user doesn't want to create an account (register) or log into his account to check the available wehicles on the website.

### Register:

- In order to put a vehicle on the site for renting or book a vehicle, first of all user need to create an account if he/she hasn't. 

- Clicking the "**REGISTER**" button on the top header, user is able to create an account easily by providing the relevent required details. 

- The given **Username**, **Email address** & **Password** is requred to log into the created account. 

- After creating an account, user can log into his/her account using the provided account credential. 

- Then user is allowed to put an advertiesment on the website about his/her vehicle and/or make bookings as he/she want. 

### Rent A Vehicle:

- To post an advertiesment, user just needs to go to the "**Rent A Car**" page by clicking the "**Rent A Car**" button and submit an advertiesment by filling the all required information. 

- As soon as the details were submitted, the vehicle renting advertiesment is posted on the website. 

- User can check it in the "**Showroom**" page or it is alo displayed on the "**Rented Vehicles**" area of the user profilr page as below.

- If someone booked a vehicle rented by this user, he/she is informed by a notification as below and also an admin also can contact the renter. Also the notifications are displayed after an admin confirms that booking and after returning the vehicle.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEi3z4yKLpPRwhx28-dCtuZamPbHldRr1H-EVPJaC_nvzOUlkVPVkseQ2V51sQ7tsiOTcZsNYb-LsPrBbdqFIg6yxfaKylPTr3roff0n2q55rCbPnKTGdi6WHHRhJ7DdrGmoBpv-u-S34Xzajv2UNCjPYzXP8yBrHj33Ut94ONgOHgZxsyLYc4Duv8IGuA=s16000)

- All the income and profit information are displayed as follows on the income tab.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEgi4wafzy-DvVxsUyoEFDcD4vmIdpSVhKxrMESHgpofMsL04L2rB_6T_Smk2uOINrUHo4Q9QDuZPdB_4GB23dNTOOmFZESV92V1V03L4wjBmfIT59etgwWVWXo0OpR1f_rFrgYlJ7KcwYvQlmqWwiq240zpJM5NMrYMS710QjCrVhdi5x6lUdeCT2bpYA=s16000)

### Book A Vehicle:

- Even though it is not required to log into the accout for searcing a vehicle, when booking the choosed vehicle, user must first log into his account in order to make the booking. 

- By clicking the "**BOOK**" button at the bottom of the vehicle description page, user should first fill the required informatin which are the "**Picking Date**", "**Returning date**", etc.

- Then the choosed vehicle can be booked by again clicking the "**BOOK**" button and the details of the booking is displayed on the user profile page under the "**Booked Vehicles**" area as below.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEi3xVS4OJY0RUmlscVzmyBCbOWa9zVJEQVMLwsVerNfzsrDL0Z_GRXOFIu180lz-15914F4WP1OQcDUHnkBVuwl4cqO4RC--59qFInTq7jvICsw4xc2_ltDGuIiVN0FCjNBIa4iLXjgxcwU3bow89Hip_-NgufTVX8IUiCn7gQcB72ZqKowEP0It59YFg=s16000)

- The blue color "**Your Booking is Pending**" message is apeared because the booking is still not approved by the admin. It means the booking is in the pending status. 

- An admin should confirm or delete the booking within a few hours of time.

- After confirming the booking by admins, it is displayed as "**Your Booking has been Confirmed**" with an orange background on the profile page, and also a notification will be arived.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEjG3SPDA8bEH-wOouIGj41i5yjhfqb37FKbgJq4lwc4t3acct3n8mgF_LrG68bpPyQv5-Vxnym9RcGKsajuhGE6CTB0MoTuzk1xvYBfRu2ILvFLebbdtqmCE9wpY1Wgs0i--wEeTifo6iTSIqNUTus0ddnzxKiuJrqD4hya9GzDZ_LfUIqm4BWV32OHOA=s16000)

- Then the user can collect the vehicle for his/her picnic.

- After the picnic, user should return the vehicle on or before the returning date. Then the admin confirm the return of the vehicle and the orange color message turns into green on the user profie page.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEgqaCRZW3c-Buq1xSYoQVCBBQc_gEBadyiYQxvHF1rQJR5aV2N9rrhhEOJMm1VMpZMG58Yja9F6tgFXq77WqI9cjz7rsMWNcg-GWEhuaVxG5cFtjf5TPVhIh0j2AypFTM0bgnanjb-u-vCcv0yKSqqaRBq6VX3WQN6W9f9bEMDEzF1vsqvMeYLddY2T-Q=s16000)


### Admins

- Admins can check the Rented & Booked vehicles on the "**Rented Vehicles**" & "**Booked Vehicles**" tabs respectively.

- Clicking the "**View**" button on each row, admin can view the details of the corresponding Booking or Rental and take relevent actions.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEhNzl8dj9E_7nMSg_bZm7HQVJ1wGm4EwfLFnpZjk2SKfjn6WwQ-uZNRkCSmdbV1V2YrP8Lg-SA3F_kxNWcHEHoppcjU_1pOyaM3Nd_z-o4y7zftymlYoLTchqzwbE6Sm1RQovJBO1K5wwH-HDjEMeoezpxAswnPBT43bnj5rwadzkfG65it2rsxMKUGxQ=s16000)

- To confirm a booking, admin should click the "**Confirm**" button and the background becomes orange.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEhResIb4E7dUaiVtyQM3__lvY9mDSgTOgWUB-3nz12PgGNFSjUt-mcq4JSW8q7mGAZER2eDYyGgzuAj_o3Ff1FXlFxMssmcHJL1wnTAbYScpYGK5UkFznxJ1hOdSvXQ6Tl365uL07vAvXpHSj8jAbd-5WY4R8cIDHx_RB8ZER5IyyJ_RA7_UpKoKpEpXw=s16000)

- To confirm a returning, admin should click the "**Return**" button and the background becomes green.

![App Screenshot](https://blogger.googleusercontent.com/img/a/AVvXsEgSOxa0YrGF3KeNFZVFf3P1S3P-NAGb6pIwkjW4J90Ld8xdyD-D5To_LcSpUEb84l5o16hhAASnTbRHhl7WIMLsv40op8oUFX2C2fYixUGRpNYfKizS0peKtPjreMhD9nLlK9e2lhmzAfO6LaVVboOCZkrKG9SFO8zKNHunQSiJFR85cOEZffnyyqLQaA=s16000)




## Security

- Even admint are not visible the user passwords of the accounts in the database
- Confidential credentials have been hashed and inserted to the database.
- Every action is take place under an admin's supervison.
- Admin's approvement is required to confirm a booking made by a customer.
- Customers can delete a bokking made by him or her self before an admin approves it. 


