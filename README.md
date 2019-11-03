# 42_web_Camagru
An Instagram-like web version of Snapchat with filters and picture gallery, from camera or upload

## Summary

- [Intro](#intro)
  - [Stack](#stack)
  - [Features](#features)
- [User account](#user-account)
  - [User creation and authentication](#user-creation-and-authentication)
  - [Forgot and change of password](#forgot-and-change-of-password)
  - [User profile](#user-profile)
- [Creating montages](#creating-montages)
  - [Camera upload](#camera-upload)
  - [Picture upload](#picture-upload)
  - [Montage](#montage)
- [User interactions](#user-interactions)
  - [Home/Feed](#homefeed)
  - [Interactions](#interactions)
- [Responsive design](#responsive-design)
- [Configuration and additionnal security](#configuration-and-additionnal-security)
  - [Database](#database)
  - [Security](#security)

## Intro

The goal of the project is to create a complete website that allows users to make picture montages with filters, from camera upload or file upload.

### Stack

* Vanilla PHP (no framework)
* Vanilla Javascript (no framework)
* HTML/CSS (no framework)
* MySQL
* Apache server

### Features

My Camagru project handles:
* DB creation PHP script
* User creation and authentication
* Camera and pictures upload
* Picture and filter montage processing
* User montages personal gallery
* Montage review page with Facebook sharing
* Email notifications for comments (with montage concerned link)
* User profile edition (password, details, notifications switch)
* Change and reset of email/forgot password with ID validation
* Profile, pictures deletion and user DB cleanup
* Responsive design from mobile to desktop/tablet
* User input and upload checks (front/backend)
* Password hashing (Whirlpool)
* HTML/Javascript/SQL injections prevention

Discover more details below.

## User account

### User creation and authentication

User input has been secured on front and back end with immediate feedback for front end input validation. Also password security has been taken seriously with multiple layers of complexity validated on the go, including:
* A lowercase letter
* A uppercase letter
* A number
* A minimum of 8 characters

Password will be hashed (whirlpool) first before being saved in the DB.

//picture
<p align=center><i>User creation screen with input errors</i></p>

Before saving user, several checks will also be runned in the background, including:
* Verifying if user already exists
* Verifying if email is already used
* Verifying (as said earlier) if input is in the right format required

Once user is created, he will be receive an email to verify his account, while account isn't validated, he will have limited access to app, like not being able to make montages for example.

//picture
<p align=center><i>User limited access</i></p>

### Forgot and change of password

If user has forgotten his password, he will be able to retrieve using his email, a password reset link will be sent to his email address entered.

//picture
<p align=center><i>Reset of password link</i></p>

The reset of password link will have a unique ID, which will be the latest link sent, others will be made deprecated. This provides security to prevent intruders from resetting someone else password.

### User profile

#### Edition

User will be able to manage completely his profile if he has validated his account with his email. For example, he will be able to edit his:
* Username
* Email
* Password

Or even delete his account (with a confirmation using his password) and manage his notifications (new comments on his pictures for example).

//picture
<p align=center><i>User account</i></p>

#### Gallery

He can also access his pictures in his own gallery.

//picture
<p align=center><i>User gallery</i></p>

If he doesn't have pictures yet, he will have a nice invitation to take a first one.

## Creating montages

### Camera upload

Using MediaDevices.getUserMedia() javascript method, I will access user's camera if he allowed it, then user will be able to take a picture if he selected a filter (following onboarding present on "Snap" page right).

//picture
<p align=center><i>Create a montage</i></p>

User will be able to move the filter using click or tap depending of the device used.

### Picture upload

If the user doesn't have a camera or didn't want to provide access to it, he will be able to upload pictures.

//picture
<p align=center><i>Upload a picture</i></p>

There will be some security checks running to avoid uploading an incorrect file:
* Checking the file format is an image (png, jpg, jpeg)
* Checking the file size to avoid having too big images (< 5mb)
* Checking the image isn't empty by verifying the image object size

### Montage

Montage will be processed by PHP with javascript helping by providing the images (picture, filter) data and specifications (base64, width, height...).

Montage will be temporarily saved, if user decides to save it to his gallery, it will saved permanently, otherwise, it will be removed.

//picture
<p align=center><i>Montage</i></p>

User can see a preview of his recently taken pictures or access his full list of pictures in his gallery.

## User interactions

### Home/Feed

From the homepage, if the user isn't logged in, he will have a presentation of the app and a look at the montages posted by users of the platform.

//picture
<p align=center><i>Logged out HP</i></p>

If the user is logged in, he will have access to the same montages feed but he will be able to comment and like montages.

//picture
<p align=center><i>Logged in HP</i></p>

Which brings us to user interactions.

### Interactions

User can interact with each by:
* Liking/Unliking pictures
* Commenting on pictures
* Sharing on Facebook

#### Like/Comments

//picture
<p align=center><i>Montage with like/comments</i></p>

Whenever a user comment on another user's picture, this user will receive a notification by email if he is subscribed to notifications. Users commenting on their own pictures won't get notification for themselves, only when it's another user.

The link sent on this email notification will lead to a preview of the montage commented so that the user can see in details what happenned on this picture.

#### Montage review link

As described above, user can review a specific montage in details, depending on whether the montage belongs to the user or not, he will have the option to delete it. When deleting his account, all user data and interactions will be removed from DB.

//picture
<p align=center><i>Montage link review</i></p>

Facebook sharing has been implemented as well so that user can share on Facebook this montage with his friends and see how many times the montage has been shared on Facebook.

## Responsive design

The platform has been completely designed with Responsive Design in mind with multiple breakpoints to accommodate most common screen sizes (from iPhone 5 range to desktop/tablet resolutions):
* 545px
* 680px
* 830px
* 920px
* 1200px

Difficulty has especially been on the montage functionality since the picture data changes from one device to another, so I made a smart Javascript logic that calculates a scaling to process the picture in order to have filter and picture aligned as per the montage preview.

*Depends of the page*

//picture
<p><i>Snap a picture view</i></p>

//picture
<p><i>User account</i></p>

//picture
<p><i>User gallery</i></p>

//picture
<p><i>Registration page</i></p>

## Configuration and additionnal security

### Database

Database is running on MySQL and I use PHPMyAdmin Web Interface to manage it, here is the structure:

//picture
<p align=center><i>Camagru DB structure</i></p>

And a focus on the user table:

//picture
<p align=center><i>User table example</i></p>

### Security

I added manually (no frameworks or ODM/ORM) checks in the front end and back end to protect the application from multiple attacks.

Application is protected against:
* HTML/Javascript injections -> using innerText and input checks
* SQL injections -> using try/catch method and bindParam
* Malware upload -> using upload checks
* Password breaches -> using Whirlpool hashing
* Cross-site request forgery -> using unique IDs with expiration (password reset, email validation)
* Cross-site resource sharing -> using authentication validation (logged out users limited)
