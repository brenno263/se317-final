<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Image Gallery

This is an image gallery website, where users can upload images and view others' images. It's jam-packed with fresh,
exciting features.

- Create an account
- Log into that account
- Upload images
- Give images a title, description, and privacy setting
- Inspect an image in a full-resolution view
- View an index of all publicly available images
- View an index of your own images, with handy controls
- View an index of someone else's images (only the publicly visible ones!)
- Edit one of your own images
- Delete one of your images (perish the thought!)

## Navigating the Repository

There are a number of important destinations in the repository, and if you're unfamiliar to Laravel they won't be
immediately obvious to you. Here's a guide to help you explore the project.

### Routes

`/routes/web.php`

Routes define what urls can be accessed, and what is displayed for those urls.

### Controllers

`/app/http/Controllers`

All of our routes point to controller actions. These controllers define exactly what happens when you visit a route.

### Models

`app/Models`

Models define objects to be stored in the database. We can access data using these models through Laravel's built-in
Eloquent ORM.

### Migrations

`database/migrations`

Migrations specify exactly how the database is structured. They are built with up/down methods, so that each one can be
built off the next, and rolled back if necessary.

### Views

`resources/views`

Views are perhaps the most essential part of the site, they define each individual page. Laravel uses Blade templates
for easy view composition. For instance, we have `layout.blade.php`, which defines a general site theme. All other pages
extend this and insert their relevant content in the `content` section. Blade helps us do a lot more useful tricks too,
like `error()` blocks, which display an element if the view is passed anything in its `$errors` array (validation
middleware sends these automatically on rule violations).

### Policies

`/app/Policies`

Policies provide a great abstraction for determining if an authenticated user is allowed to do something. We just have
one policy, `ImagePolicy.php`, which contains logic determining whether the user can view, update, or delete a given
image. These are checked using the `$this->authorize('<action>', <image>)` method on a Controller.

## Image Uploading

How do we handle our image uploading? Well, we use a PHP image manipulation library called Imagick to re-encode all
images into the jpg format for its great compression ratios to save on space. Additionally, we generate a 400x400, more
heavily compressed copy of every image to use as a thumbnail. This way loading and listing a large number of images can
be quick.

Interestingly, the images are named by their md5 hash, so if two users upload an identical image, we'll only really
store the one copy. Just the hash is stored in database, and we can generate all the related filepaths from just that.
Of course, because we're using hashes there *is* a risk of hash collision. But that's pretty negligible. With some
napkin math, we'd have about a 1-in-100-trillion chance of collision once we reach approximately
1_000_000_000_000_000 (1 quadrilllion) images. By that point, we'd easily overwhelm the 500G of storage on the server.
