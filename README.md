# Smallmart - A responsive website for 'Responsive Dynamic Web Development'
A responsive dynamic website for a catalogue of (real) miniature items. Every product, and their associated images, are sourced from [Miniatures Shop](https://miniaturesshop.com/). All reviews and user accounts were generated using [Microsoft Copilot](https://copilot.microsoft.com/).

This project was developed for the **Responsive Dynamic Web Development** module of a foundation degree in **Computer Science and Digital Technologies**.

## Set up
1. Install **XAMPP Control Panel**
2. Start modules **'Apache'** and **'MySQL'**
3. Import the **'smallmart.sql'** database into **phpMyAdmin** (the version of the SQL being imported may need to be changed to an earlier version than what is currently listed)
4. Place the **'smallmart'** folder (the root of this project) into **'htdocs'** in your **'xampp'** directory (e.g. ***C:\\xampp\\htdocs***)
5. Go to **'http://localhost/smallmart/website/'** in your browser (renaming any folders will break the website)

All accounts except for '**testingaccount@example.com**' use the password '*bleh*'. The **testingaccount@example.com** account uses the password '*this I5 4 VAL1D PASSWORD!!*'.

---

# Tasks that were not completed
- Category / search sorting (featured, newest, oldest)
- Review sorting (highest, lowest, newest, oldest)
- User management

# Things to note
These are notes that were taken during development to address certain issues that would/should be addressed in a real development setting.

- When signing up, there is not an option to set your display name. This is something that can be done after sign up in the user settings, redirected to after signing up and/or logging in, but should be an input field when signing up.
- The icons rely on [Google's Material Icons](https://fonts.google.com/icons), meaning that if their system went down this website would be unable to load their icons and create an ugly frontend. The necessary icons should, ideally, be stored on the web server to be loaded from for a both quick and reliable source of icons.
- User is not logged out automatically after a certain time period, only when the current session ends.
- When changing a user detail on the user page, there is no message to state whether the update was successful or not. The most obvious way of knowing if it was is when changing the display name, where the page is reloaded and the personalised welcome message is updated with the new display name.
- In my opinion, the 'wishlist_product' join table is not necessary, with a 'wishlist' column in the 'user' table with comma-separated product ids being viable enough. On top of this, someone spam adding and removing product from their wishlist can increment the 'wishlish_prod_id' to extreme values, and could end up failing when reaching the possible maximum while there is a scaling user-base. A cooldown for this function should also be put in place for each user, checking when their last change was and preventing it in the case of spam. Although using this JOIN table does allow for the possibility of an 'added datetime' as a column, which can be good for properly sorting the wishlist for the user (which should've been implemented).
- The **select** element for sorting products on a category page uses an experimental feature that is only available on newer version of **Chrome** and **Microsoft Edge**. This sorting also does not work.
- With the 'user_access_level' column, an administrator dashboard can easily be implemented to manage all users, products, and reviews.
- The pagination on any page is not properly scalable, easily going off the screen on devices with smaller screens.
- There is no system for when a user forgets their password.
- No testing for common web attacks was performed.
- The category details leaves room for custom images as the header background for each category.
